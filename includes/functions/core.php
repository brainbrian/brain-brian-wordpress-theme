<?php
namespace BrainBrian\Core;

/**
 * Set up theme defaults and register supported WordPress features.
 *
 * @since 0.1.0
 *
 * @uses add_action()
 *
 * @return void
 */

function setup() {
  $n = function( $function ) {
    return __NAMESPACE__ . "\\$function";
  };

  add_action('after_setup_theme', $n('i18n'));
  add_action('after_setup_theme', $n('initTheme'));
  add_action('wp_enqueue_scripts', $n('scripts'));
  add_action('wp_enqueue_scripts', $n('styles'));
  add_action('wp_head', $n('header_meta'));
  add_action('init', $n('register_custom_post_types'));
  add_action('init', $n('toolbox_widgets_init'));
}

/**
 * Makes WP Theme available for translation.
 *
 * Translations can be added to the /lang directory.
 * If you're building a theme based on WP Theme, use a find and replace
 * to change 'wptheme' to the name of your theme in all template files.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 *
 * @since 0.1.0
 *
 * @return void
 */
function i18n() {
    load_theme_textdomain( 'bb', BB_PATH . '/languages' );
}

/**
 * Enqueue scripts for front-end.
 *
 * @uses wp_enqueue_script() to load front end scripts.
 *
 * @since 0.1.0
 *
 * @return void
 */
function scripts() {
  /**
   * Flag whether to enable loading uncompressed/debugging assets. Default false.
   *
   * @param bool bb_script_debug
   */
  $debug = apply_filters( 'bb_script_debug', false );
  $min = ( $debug || defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

  wp_enqueue_script(
    'bb',
    BB_TEMPLATE_URL . "/assets/js/brain-brian{$min}.js",
    array(),
    BB_VERSION,
    true
  );
}

/**
 * Enqueue styles for front-end.
 *
 * @uses wp_enqueue_style() to load front end styles.
 *
 * @since 0.1.0
 *
 * @return void
 */
function styles() {
	/**
	 * Flag whether to enable loading uncompressed/debugging assets. Default false.
	 *
	 * @param bool bb_style_debug
	 */
  $debug = apply_filters( 'bb_style_debug', false );
  $min = ( $debug || defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

  wp_enqueue_style(
    'bb',
    BB_URL . "/assets/css/brain-brian{$min}.css",
    array(),
    BB_VERSION
  );
}

/**
 * Add humans.txt to the <head> element.
 *
 * @uses apply_filters()
 *
 * @since 0.1.0
 *
 * @return void
 */
function header_meta() {
  /**
   * Filter the path used for the site's humans.txt attribution file
   *
   * @param string $humanstxt
   */
  $humanstxt = apply_filters( 'bb_humans', BB_TEMPLATE_URL . '/humans.txt' );

  echo '<link type="text/plain" rel="author" href="' . esc_url( $humanstxt ) . '" />';
}




function initTheme() {
  /**
   * Set the content width based on the theme's design and stylesheet.
   */
  if (! isset( $content_width))
    $content_width = 640; /* pixels */

  /**
   * This theme uses wp_nav_menu() in one location.
   */
  register_nav_menus(array(
    'primary' => __('Primary Menu', 'brainbrian'),
  ) );

  /**
   * Add default posts and comments RSS feed links to head
   */
  add_theme_support('automatic-feed-links');

  /**
   * Add support for the Aside and Gallery Post Formats
   */
  add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

  add_theme_support('post-thumbnails');

  /**
   * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
   */
  function toolbox_page_menu_args($args) {
    $args['show_home'] = true;
    return $args;
  }
  add_filter( 'wp_page_menu_args', 'toolbox_page_menu_args' );
}

/* SET UP NEW PROJECTS CUSTOM POST TYPE */
function register_custom_post_types() {
  $labels = array(
    'name' => _x('Projects', 'post type general name'),
    'singular_name' => _x('Project', 'post type singular name'),
    'add_new' => _x('Add New', 'bb_projects'),
    'add_new_item' => __('Add New Project'),
    'edit_item' => __('Edit Project'),
    'new_item' => __('New Project'),
    'all_items' => __('All Projects'),
    'view_item' => __('View Project'),
    'search_items' => __('Search Projects'),
    'not_found' =>  __('No projects found'),
    'not_found_in_trash' => __('No projects found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'My Projects'
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array("slug" => "projects"),
    'capability_type' => 'page',
    'has_archive' => false,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'comments' )
  );
  register_post_type('bb_projects', $args);
  // start taxonamy for Testimonials
  $labels = array(
    'name'                          => 'Skills',
    'singular_name'                 => 'Skill',
    'search_items'                  => 'Search Skills',
    'popular_items'                 => 'Popular Skills',
    'all_items'                     => 'All Skills',
    'parent_item'                   => 'Parent Skill',
    'edit_item'                     => 'Edit Skill',
    'update_item'                   => 'Update Skill',
    'add_new_item'                  => 'Add New Skill',
    'new_item_name'                 => 'New Skill',
    'separate_items_with_commas'    => 'Separate skills with commas',
    'add_or_remove_items'           => 'Add or remove skills',
    'choose_from_most_used'         => 'Choose from most used skills'
  );
  $args = array(
    'label'                         => 'Skills',
    'labels'                        => $labels,
    'public'                        => true,
    'hierarchical'                  => true,
    'show_ui'                       => true,
    'show_in_nav_menus'             => true,
    'args'                          => array( 'orderby' => 'term_order' ),
    //'rewrite'                       => array( 'slug' => 'cameras/brands', 'with_front' => false ),
    'query_var'                     => true
  );
  register_taxonomy( 'bb_projects_skills', 'bb_projects', $args );
}

/**
 * Register widgetized area and update sidebar with default widgets
 */
function toolbox_widgets_init() {
  register_sidebar(array(
    'name' => __('Homepage', 'brainbrian'),
    'id' => 'sidebar-homepage',
    'description' => __('An optional second sidebar area', 'brainbrian'),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>',
  ));

  register_sidebar(array(
    'name' => __('Blog', 'brainbrian'),
    'id' => 'sidebar-blog',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>',
  ));
}
