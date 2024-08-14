<?php

function theme_files()
{
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' );

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'theme_files' );

function load_more_posts() {
  $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
  $args = array(
      'posts_per_page' => 5,
      'offset' => $offset,
  );
  $query = new WP_Query($args);

  if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
      <div class="col-md-6 mb-4">
          <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action border-0 small">
              <div class="row align-items-center my-2">
                  <div class="col-5 img-thumb">
                      <?php
                      if (has_post_thumbnail()) { ?>
                          <img class="w-100" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                      <?php } else { ?>
                          <img class="w-100" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.svg" alt="<?php echo get_the_title(); ?>">
                      <?php } ?>
                  </div>
                  <div class="col-7">
                      <h6><?php echo get_the_title(); ?></h6>
                      <small><?php echo get_the_date(); ?></small>
                  </div>
              </div>
          </a>
      </div>
  <?php endwhile;
      wp_reset_postdata();
  endif;

  wp_die();
}


//Title Tag Support
add_theme_support( 'title-tag' );

function your_theme_name_widgets_init() {
  register_sidebar( array(
      'name'          => 'Footer 1',
      'id'            => 'footer-1',
      'before_widget' => '<div class="footer-widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
  ) );

  register_sidebar( array(
      'name'          => 'Footer 2',
      'id'            => 'footer-2',
      'before_widget' => '<div class="footer-widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
  ) );

  register_sidebar( array(
      'name'          => 'Footer 3',
      'id'            => 'footer-3',
      'before_widget' => '<div class="footer-widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
  ) );
}
add_action( 'widgets_init', 'your_theme_name_widgets_init' );


/**
 * Add HTML5 theme support.
 */
function wpdocs_after_setup_theme() {
	add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );

//Excerpt Length
function mytheme_custom_excerpt_length( $length ) {
  return 30;
  }
  add_filter( 'excerpt_length', 'mytheme_custom_excerpt_length', 999 );

//Post Thumbnail
add_theme_support( 'post-thumbnails' );

// Fungsi untuk mencatat jumlah view
if (!function_exists('set_post_views')) {
    function set_post_views($postID) {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count == ''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        } else {
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}

// Fungsi untuk menampilkan jumlah view
function get_post_views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

// Tambahkan views ketika post dilihat
function track_post_views($post_id) {
    if (!is_single()) return;
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    set_post_views($post_id);
}
add_action('wp_head', 'track_post_views');

// Tambahkan kolom views di admin post list
function add_views_column($columns) {
    $columns['post_views'] = 'Views';
    return $columns;
}
add_filter('manage_posts_columns', 'add_views_column');

function display_views_column($column_name, $postID) {
    if ($column_name === 'post_views') {
        echo get_post_views($postID);
    }
}
add_action('manage_posts_custom_column', 'display_views_column', 10, 2);

// Fungsi untuk mencatat jumlah share
function increment_share_count() {
    if (!isset($_GET['url'])) {
        wp_send_json_error('URL tidak disediakan.');
        return;
    }

    $url = esc_url_raw($_GET['url']);
    $post_id = url_to_postid($url);

    if ($post_id) {
        $count_key = 'post_shares_count';
        $count = get_post_meta($post_id, $count_key, true);
        if ($count === '') {
            $count = 0;
            delete_post_meta($post_id, $count_key);
            add_post_meta($post_id, $count_key, '0');
        } else {
            $count++;
            update_post_meta($post_id, $count_key, $count);
        }
        wp_send_json_success(array('count' => $count));
    } else {
        wp_send_json_error('ID post tidak ditemukan untuk URL yang diberikan.');
    }
}
add_action('wp_ajax_increment_share_count', 'increment_share_count');
add_action('wp_ajax_nopriv_increment_share_count', 'increment_share_count');

// bootstrap 5 wp_nav_menu walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
    $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}
// register a new menu
register_nav_menu('main-menu', 'Main menu');

//font awesome
if (! function_exists('fa_custom_setup_kit') ) {
  function fa_custom_setup_kit($kit_url = '') {
    foreach ( [ 'wp_enqueue_scripts', 'admin_enqueue_scripts', 'login_enqueue_scripts' ] as $action ) {
      add_action(
        $action,
        function () use ( $kit_url ) {
          wp_enqueue_script( 'font-awesome-kit', $kit_url, [], null );
        }
      );
    }
  }
}

fa_custom_setup_kit('https://kit.fontawesome.com/4a7c8791e7.js');

function theme_enqueue_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . './scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

?>