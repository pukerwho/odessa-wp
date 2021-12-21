<?php
/**
 * G-Info functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package G-Info
 */

if ( ! defined( 'TAILWINDWP_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'TAILWINDWP_VERSION', '1.0.0' );
}

if ( ! function_exists( 'tailwind_wp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tailwind_wp_setup() {
		load_theme_textdomain( 'odessa', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		// add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'header' => esc_html__( 'Header', 'odessa' ),
        'mobile' => esc_html__( 'Mobile', 'odessa' ),
        'footer_info' => esc_html__( 'Footer info', 'odessa' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'ginfo_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'tailwind_wp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tarakan_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tarakan_content_width', 640 );
}
add_action( 'after_setup_theme', 'tarakan_content_width', 0 );

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once __DIR__ . '/vendor/autoload.php';
    \Carbon_Fields\Carbon_Fields::boot();
    require_once get_template_directory() . '/inc/carbon-fields/carbon-fields-plugin.php';
    require_once get_template_directory() . '/inc/custom-fields/settings-meta.php';
    require_once get_template_directory() . '/inc/custom-fields/post-meta.php';
    require_once get_template_directory() . '/inc/custom-fields/page-meta.php';
    require_once get_template_directory() . '/inc/custom-fields/term-meta.php';
}

require_once get_template_directory() . '/inc/share-buttons.php';

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

function itsme_disable_feed() {
 wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
}

add_action('do_feed', 'itsme_disable_feed', 1);
add_action('do_feed_rdf', 'itsme_disable_feed', 1);
add_action('do_feed_rss', 'itsme_disable_feed', 1);
add_action('do_feed_rss2', 'itsme_disable_feed', 1);
add_action('do_feed_atom', 'itsme_disable_feed', 1);
add_action('do_feed_rss2_comments', 'itsme_disable_feed', 1);
add_action('do_feed_atom_comments', 'itsme_disable_feed', 1);
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tarakan_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'tarakan' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'tarakan' ),
			'before_widget' => '<section id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'tarakan_widgets_init' );

include('inc/enqueues.php');

/**
 * Enqueue scripts and styles.
 */
function tailwindwp_scripts() {
	wp_enqueue_style( 'tailwind', get_stylesheet_directory_uri() . '/build/css/tailwind.css', false, time() );
	wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/build/css/styles.css', false, time() );
	wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'all-scripts', get_template_directory_uri() . '/build/js/all.js', '','',true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tailwindwp_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/comments-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


// Создаем новый тип записи - объявления
function create_post_type() {
  register_post_type( 'hotels',
    array(
      'labels' => array(
          'name' => __( 'Отели' ),
          'singular_name' => __( 'Отель' )
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical' => true,
      'show_in_rest' => false,
      'menu_icon' => 'dashicons-megaphone',
      'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions' ),
    )
  );
}
add_action( 'init', 'create_post_type' );

function region_register_taxonomy() {
  
  $args = array (
    'label' => 'Регионы',
    'labels' => array(
      'menu_name' => 'Регион',
      'all_items' => esc_html__( 'All Регионы', 'text-domain' ),
      'edit_item' => esc_html__( 'Edit Регион', 'text-domain' ),
      'view_item' => esc_html__( 'View Регион', 'text-domain' ),
      'update_item' => esc_html__( 'Update Регион', 'text-domain' ),
      'add_new_item' => esc_html__( 'Add new Регион', 'text-domain' ),
      'new_item_name' => esc_html__( 'New Регион', 'text-domain' ),
      'parent_item' => esc_html__( 'Parent Регион', 'text-domain' ),
      'parent_item_colon' => esc_html__( 'Parent Регион:', 'text-domain' ),
      'search_items' => esc_html__( 'Search Регион', 'text-domain' ),
      'popular_items' => esc_html__( 'Popular Регион', 'text-domain' ),
      'separate_items_with_commas' => esc_html__( 'Separate Регион with commas', 'text-domain' ),
      'add_or_remove_items' => esc_html__( 'Add or remove Регион', 'text-domain' ),
      'choose_from_most_used' => esc_html__( 'Choose most used Регион', 'text-domain' ),
      'not_found' => esc_html__( 'No Регион found', 'text-domain' ),
      'name' => 'Регионы',
      'singular_name' => 'Регион',
    ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'show_tagcloud' => true,
    'show_in_quick_edit' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'hierarchical' => true,
    'query_var' => true,
    'has_archive' => true,
    'sort' => true,
    'rewrite' => array(
      'slug' => 'region',
      'with_front'    => true,
      'hierarchical' => true,
    ),
  );

  register_taxonomy( 'region', array( 'hotels' ), $args );
}
add_action( 'init', 'region_register_taxonomy');

add_action('init', 'create_taxonomy');
function create_taxonomy(){
  register_taxonomy('city', array('hotels'), array(
    'label'                 => '', // определяется параметром $labels->name
    'labels'                => array(
      'name'              => 'Города',
      'singular_name'     => 'Город',
      'search_items'      => 'Поиск Города',
      'all_items'         => 'Все Города',
      'view_item '        => 'Посмотреть Город',
      'parent_item'       => 'Родительский Город',
      'parent_item_colon' => 'Родительский Город:',
      'edit_item'         => 'Редактировать Город',
      'update_item'       => 'Одновить Город',
      'add_new_item'      => 'Добавить',
      'new_item_name'     => 'Новая',
      'menu_name'         => 'Города',
    ),
    'description'           => '', // описание таксономии
    'public'                => true,
    'publicly_queryable'    => null, // равен аргументу public
    'show_in_nav_menus'     => true, // равен аргументу public
    'show_ui'               => true, // равен аргументу public
    'show_in_menu'          => true, // равен аргументу show_ui
    'show_tagcloud'         => true, // равен аргументу show_ui
    'show_in_rest'          => true, // добавить в REST API
    'rest_base'             => null, // $taxonomy
    'hierarchical'          => true,
    'update_count_callback' => '',
    //'query_var'             => $taxonomy, // название параметра запроса
    'capabilities'          => array(),
    'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
    'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    '_builtin'              => false,
    'show_in_quick_edit'    => null, // по умолчанию значение show_ui
  ) );
}

// Создаем счетчик для записей
function tutCount($id) {
  
  if ( metadata_exists( 'post', $id, 'place_count' ) ) {
    $count_value = get_post_meta( $id, 'place_count', true );
    $count_value = $count_value + 1;
    update_post_meta( $id, 'place_count', $count_value );
  } else {
    add_post_meta( $id, 'place_count', '200', true);
  }
  $place_count = get_post_meta( $id, 'place_count', true );
  return $place_count;
  
}

// Создаем скриншот (shortcode)
add_shortcode( 'snapshot', function ( $atts ) {
  $atts = shortcode_atts( array(
    'alt'    => '',
    'url'    => 'http://www.wordpress.org',
    'width'  => '400',
    'height' => '300'
  ), $atts );
  $params = array(
    'w' => $atts['width'],
    'h' => $atts['height'],
  );
  $url = urlencode( $atts['url'] );
  $src = 'http://s.wordpress.com/mshots/v1/' . $url . '?' . http_build_query( $params, null, '&' );

  $cache_key = 'snapshot_' . md5( $src );
  $data_uri = get_transient( $cache_key );
  if ( ! $data_uri ) {
    $response = wp_remote_get( $src );
    if ( 200 === wp_remote_retrieve_response_code( $response ) ) {
      $image_data = wp_remote_retrieve_body( $response );
      if ( $image_data && is_string( $image_data ) ) {
        $src = $data_uri = 'data:image/jpeg;base64,' . base64_encode( $image_data );
        set_transient( $cache_key, $data_uri, DAY_IN_SECONDS );
      }
    }
  }

  return '<img src="' . esc_attr( $src ) . '" alt="' . esc_attr( $atts['alt'] ) . '" class="w-full h-56 lg:h-full object-cover object-top rounded-lg"/>';
} );