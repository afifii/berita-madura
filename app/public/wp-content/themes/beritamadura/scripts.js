function sharePost(event, url) {
    event.preventDefault();
    if (navigator.share) {
        navigator.share({
            title: document.title,
            url: url
        }).then(() => {
            updateShareCount(url);
        }).catch((error) => console.log('Error sharing', error));
    } else {
        // Fallback for browsers that do not support the Web Share API
        document.getElementById('shareButton').style.display = 'block';

        document.getElementById('copyLinkBtn').addEventListener('click', function() {
            copyToClipboard(url);
        });

        document.getElementById('shareWhatsAppBtn').addEventListener('click', function() {
            shareViaWhatsApp(url);
        });

        document.getElementById('shareFacebookBtn').addEventListener('click', function() {
            shareViaFacebook(url);
        });

        document.getElementById('shareTwitterBtn').addEventListener('click', function() {
            shareViaTwitter(url);
        });
    }
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Link copied to clipboard!');
    }).catch(function(error) {
        alert('Failed to copy link: ' + error);
    });
}

function shareViaWhatsApp(url) {
    const whatsappUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(url)}`;
    window.open(whatsappUrl, '_blank');
    updateShareCount(url);
}

function shareViaFacebook(url) {
    const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
    window.open(facebookUrl, '_blank');
    updateShareCount(url);
}

function shareViaTwitter(url) {
    const twitterUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}`;
    window.open(twitterUrl, '_blank');
    updateShareCount(url);
}

function updateShareCount(url) {
    fetch('<?php echo admin_url("admin-ajax.php"); ?>?action=increment_share_count&url=' + encodeURIComponent(url))
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
}

document.addEventListener('DOMContentLoaded', function() {
    let offset = 7;
    const loadMoreBtn = document.getElementById('load-more');
    
    loadMoreBtn.addEventListener('click', function() {
        fetch('<?php echo admin_url("admin-ajax.php"); ?>?action=load_more_posts&offset=' + offset)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('post-list').insertAdjacentHTML('beforeend', data.data);
                offset += 5;
            } else {
                loadMoreBtn.style.display = 'none';
            }
        });
    });
});