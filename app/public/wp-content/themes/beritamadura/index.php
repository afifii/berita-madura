<?php get_header(); ?>

<section class="default-holder mt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 mb-4">
                <?php
                // Query untuk mengambil 7 post terbaru untuk carousel
                $args = array(
                    'posts_per_page' => 7,
                );
                $query = new WP_Query($args);
                ?>
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner rounded">
                        <?php
                        if ($query->have_posts()) :
                            $i = 0;
                            while ($query->have_posts()) : $query->the_post();
                                $active_class = ($i == 0) ? 'active' : '';
                        ?>
                                <div class="carousel-item <?php echo $active_class; ?>" data-bs-interval="10000">
                                    <a href="<?php the_permalink(); ?>" class="carousel-img">
                                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                                        <div class="overlay"></div>
                                        <div class="carousel-caption captcontainer text-start">
                                            <h5 class="badge bg-danger">
                                                <span href="#" class="text-decoration-none text-white">
                                                    <?php
                                                    $categories = get_the_category();
                                                    if (!empty($categories)) {
                                                        echo esc_html($categories[0]->name);
                                                    }
                                                    ?>
                                                </span>
                                            </h5><br>
                                            <h3><?php echo get_the_title(); ?></h3>
                                        </div>
                                    </a>
                                </div>
                        <?php
                                $i++;
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="row mt-4">
                    <?php
                    // Query untuk mengambil 2 post dengan traffic tertinggi
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 2,
                        'meta_key' => 'post_views_count',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                    );
                    $query = new WP_Query($args);

                    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                    ?>
                        <div class="col-6 mb-4">
                            <a href="<?php the_permalink(); ?>">
                                <div class="card h-100">
                                    <?php
                                    if (has_post_thumbnail()) { ?>
                                        <div class="img-thumb-card">
                                            <img class="card-img-top img-fluid" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                                        </div>
                                        <?php } else { ?>
                                            <img class="card-img-top img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.svg" alt="<?php echo get_the_title(); ?>">
                                        
                                    <?php } ?>
                                    <div class="card-body">
                                        <h6 class="card-title"><?php echo get_the_title(); ?></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <h3 class="mb-0">Berita Populer</h3>
                <div class="list-group">
                    <?php
                    // Query untuk mengambil 5 post dengan traffic tertinggi
                    $args = array(
                        'posts_per_page' => 5,
                        'meta_key' => 'post_views_count',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                    );
                    $query = new WP_Query($args);

                    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                    ?>
                        <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action border-0 small">
                            <div class="row align-items-center my-2">
                                <div class="col-4 img-thumb-list">
                                    <?php
                                    if (has_post_thumbnail()) { ?>
                                        <img class="w-100" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                                    <?php } else { ?>
                                        <img class="w-100" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.svg" alt="<?php echo get_the_title(); ?>">
                                    <?php } ?>
                                </div>
                                <div class="col-7">
                                    <h6> <?php echo get_the_title(); ?> </h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small> <?php echo get_the_date(); ?> </small>
                                        <div class="d-flex justify-content-end align-items-center">
                                            <div class="btn-group">
                                                <!-- Tombol Share -->
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#shareButton" class="btn btn-sm me-1" onclick="sharePost(event, '<?php the_permalink(); ?>')">
                                                    <i class="fa fa-share fa-xs"></i>
                                                </button>
                                            </div>
                                            <small class="text-muted"><?php echo get_post_meta(get_the_ID(), 'post_shares_count', true) ?: '0'; ?> Shares</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endwhile;
                        wp_reset_postdata();
                    else : ?>
                        <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
                    <?php endif; ?>
                </div>
            </div>


            <!-- Berita Terbaru -->
            <div class="col-md-12 col-lg-12">
                <h3>Berita Terbaru</h3>
                <?php
                // Query the latest 9 posts
                $args = array(
                    'posts_per_page' => 9,
                    'post_status' => 'publish',
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) : ?>
                    <div class="container">
                        <div class="row">
                            <?php
                            $counter = 0;
                            while ($query->have_posts()) : $query->the_post();
                                $counter++;
                                ?>
                                <div class="col-md-4 mb-2">
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-action border-0 small">
                                            <a href="<?php the_permalink(); ?>">
                                                <div class="row">
                                                    <div class="col-4 img-thumb-list">
                                                        <?php
                                                        if (has_post_thumbnail()) { ?>
                                                            <img class="w-100" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
                                                        <?php } else { ?>
                                                            <img class="w-100" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.svg" alt="<?php the_title(); ?>">
                                                        <?php } ?>
                                                    </div>
                                                    <!-- <div class="col-4 img-thumb-list">
                                                        <?php
                                                        if (has_post_thumbnail()) : ?>
                                                            <img src="<?php the_post_thumbnail_url('medium'); ?>" class="img-fluid mb-2" alt="<?php the_title(); ?>">
                                                        <?php
                                                    
                                                        endif; ?>
                                                    </div> -->
                                                    <div class="col-8">
                                                        <h6 class="mb-1"><?php the_title(); ?></h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 text-center">
                                <button id="load-more" class="btn btn-outline-secondary border-0 btn-sm">Load More</button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>


        </div>
    </div>
</section>

<div class="modal" id="shareButton" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bagikan ke</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <button class="btn btn-outline-secondary" id="copyLinkBtn">
            <i class="fa fa-link"></i>
        </button>
        <button class="btn btn-outline-success" id="shareWhatsAppBtn">
            <i class="fa fa-whatsapp"></i>
        </button>
        <button class="btn btn-outline-primary" id="shareFacebookBtn">
            <i class="fa fa-facebook"></i>
        </button>
        <button class="btn btn-outline-dark" id="shareTwitterBtn">
            <i class="fa-brands fa-x-twitter"></i>
        </button>
      </div>
    </div>
  </div>
</div>

<script>
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
    fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=increment_share_count&url=' + encodeURIComponent(url))
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
}
</script>

<?php get_footer(); ?>
