<?php get_header(); ?>

<div class="container">
    <h4 class="mb-0"><?php single_cat_title(); ?></h4>
    <div class="list-group">
        <?php
        if (is_category()) {
            $category = get_queried_object();
            $args = array(
                'posts_per_page' => 6,
                'meta_key' => 'post_views_count',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'cat' => $category->term_id,
            );
        } else {
            $args = array(
                'posts_per_page' => 6,
                'meta_key' => 'post_views_count',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
            );
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        ?>
            <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action border-0 small">
                <div class="row align-items-center my-2">
                    <div class="col-sm-6 col-md-3 col-xl-3">
                        <div class="thumbnail">
                            <?php
                            if (has_post_thumbnail()) { ?>
                                <img class="img-fluid rounded" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                            <?php } else { ?>
                                <img class="img-fluid rounded" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.svg" alt="<?php echo get_the_title(); ?>">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-9 col-xl-9">
                        <h5> <?php echo get_the_title(); ?> </h5>
                        <p class="fs-6"> <?php the_excerpt(); ?> </p>
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
<?php get_footer(); ?>
