<?php get_header(); ?>

<section class="default-holder">
    <div class="container">

        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        <div class="mt-4 mb-4">
                            <img class="rounded-pill" src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), ['size' => 32] ); ?>" alt="">
                            <span class="text-muted">by </span>
                            <span class="text-danger"><?php echo __('', 'textdomain'); ?><?php the_author_posts_link(); ?></span>
                            <span><?php echo get_the_author_meta( 'description' ); ?></span>
                            <span><?php echo __('-', 'textdomain'); ?><?php echo get_the_date(); ?></span>
                        </div>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer">
                        <?php
                            edit_post_link(
                                sprintf(
                                    wp_kses(
                                        __( 'Edit <span class="screen-reader-text">%s</span>', 'textdomain' ),
                                        array( 'span' => array( 'class' => array() ) )
                                    ),
                                    get_the_title()
                                ),
                                '<span class="edit-link">',
                                '</span>'
                            );
                        ?>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->

                <?php
            endwhile;
        endif;
        ?>
		<span class="text-decoration-none"><?php the_tags( __(' in ', 'textdomain'), ', ', '<br />' ); ?></span>
    </div>
</section>


<?php get_footer(); ?>
