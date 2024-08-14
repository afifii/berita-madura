<?php get_header(); ?>

<section class="default-holder mt-4">
    <div class="container">
        <div class="row border-bottom">
            <div class="col-lg-8 col-md-8 mb-4">
                <?php
                // Query untuk mengambil 5 post terbaru untuk carousel
                $args = array(
                    'posts_per_page' => 5,
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
                                        <img class="card-img-top img-fluid" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                                    <?php } else { ?>
                                        <img class="card-img-top" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.svg" alt="<?php echo get_the_title(); ?>">
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
            <div class="col-lg-4 col-md-4 mb-4">
                <h3 class="mb-0 subtitle">Berita Populer</h3>
                <div class="list-group">
                    <?php
                    // Query untuk mengambil 5 post dengan traffic tertinggi
                    $args = array(
                        'posts_per_page' => 6,
                        'meta_key' => 'post_views_count',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                    );
                    $query = new WP_Query($args);

                    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                    ?>
                        <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action border-0 small">
                            <div class="row align-items-center my-2">
                                <div class="col-5 img-thumb ">
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
        </div>
        <div class="col-lg-8 col-md-8 mb-4">
            <h3 class="mt-4 mb-0 subtitle">Postingan Terbaru</h3>
            <div class="row mx-1" id="post-list">
                <?php
                // Query untuk mengambil 8 post terbaru
                $args = array(
                    'posts_per_page' => 2,
                );
                $query = new WP_Query($args);

                if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                ?>
                    <div class="col-md-6 mb-4">
                        <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action border-0 small">
                            <div class="row align-items-center my-2">
                                <div class="col-4 img-thumb">
                                    <?php
                                    if (has_post_thumbnail()) { ?>
                                        <img class="w-100" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                                    <?php } else { ?>
                                        <img class="w-100" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.svg" alt="<?php echo get_the_title(); ?>">
                                    <?php } ?>
                                </div>
                                <div class="col-8">
                                    <h6><?php echo get_the_title(); ?></h6>
                                    <small><?php echo get_the_date(); ?></small>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
                <?php endif; ?>
                <div class="text-center">
                    <button id="load-more" class="btn btn-outline-secondary btn-sm">Load More</button>
                </div>
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

<?php get_footer(); ?>