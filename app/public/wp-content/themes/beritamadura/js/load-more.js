jQuery(document).ready(function($) {
    var page = 2; // Start from the second page

    $('#load-more').click(function() {
        $.ajax({
            url: ajax_params.ajax_url,
            type: 'post',
            data: {
                action: 'load_more_posts',
                page: page,
            },
            success: function(response) {
                // Check if there are no more posts to show
                try {
                    var data = JSON.parse(response);
                    if (data.no_more_posts) {
                        $('#load-more').hide(); // Hide the button
                    }
                } catch (e) {
                    // Append new posts if they exist
                    $('#load-more').closest('.row').prev('.row').append(response);
                    page++;
                }
            }
        });
    });
});
