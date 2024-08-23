<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title" content="<?php the_title(); ?>" />
	<meta property="og:description" content="<?php echo wp_trim_words(get_the_excerpt(), 30); ?>" />
	<meta property="og:image" content="<?php echo get_the_post_thumbnail_url(); ?>" />
	<meta property="og:url" content="<?php the_permalink(); ?>" />
	<meta property="og:type" content="article" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary small custom-nav fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo bloginfo('url'); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/img/nav-logo.svg" alt="Logo">
        </a>
        <div class="d-flex justify-content-end align-items-center gap-1">

            <div class="dropstart">
                <button class="btn d-flex text-end d-xl-none d-lg-none" data-bs-toggle="dropdown">
                    <i class="fa fa-search"></i>
                </button>
                <ul class="dropdown-menu">
                    <li class="dropdown-item">
                        <form class="d-flex dropdown" id="searchForm" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                            <div class="input-group dropdown-items input-group-merge input-group-sm">
                                <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Cari …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>">
                                <button class="input-group-text" type="submit">
                                    <i class="fa-solid fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon small"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end gap-3" id="navbarSupportedContent">
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'container' => false,
                    'menu_class' => '',
                    'fallback_cb' => '__return_false',
                    'items_wrap' => '<ul id="%1$s" class="navbar-nav mb-2 mb-md-0 %2$s">%3$s</ul>',
                    'depth' => 2,
                    'walker' => new bootstrap_5_wp_nav_menu_walker()
                ));
            ?>
            <form class="d-flex d-none d-sm-block d-md-none d-lg-block" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                <div class="input-group input-group-merge input-group-sm">
                    <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Cari …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>">
                    <button class="input-group-text" type="submit">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</nav>
<!-- Navbar -->