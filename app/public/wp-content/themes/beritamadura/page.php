<?php
/*
Template Name: About Us
*/
get_header(); ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <?php
            // Start the Loop.
            while ( have_posts() ) :
                the_post();
                ?>
                <h1 class="mb-4"><?php the_title(); ?></h1>
                <?php the_content(); ?>
                <?php
            // End the Loop.
            endwhile;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
