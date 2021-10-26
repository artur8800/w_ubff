<?php
/**
 * wp-ubff functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wp-ubff
 */


use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;


add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}


if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'wp_ubff_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wp_ubff_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wp-ubff, use a find and replace
		 * to change 'wp-ubff' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wp-ubff', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'wp-ubff' ),
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
				'wp_ubff_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);


		  
		 add_action( 'after_setup_theme', 'wpse_setup_theme' );

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
add_action( 'after_setup_theme', 'wp_ubff_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
// function wp_ubff_content_width() {
// 	$GLOBALS['content_width'] = apply_filters( 'wp_ubff_content_width', 1200 );
// }
// add_action( 'after_setup_theme', 'wp_ubff_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_ubff_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wp-ubff' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wp-ubff' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wp_ubff_widgets_init' );



/**
 * Enqueue scripts and styles.
 */

function wp_ubff_scripts() {
	
	wp_enqueue_style( 'wp-ubff-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'wp-ubff-style', 'rtl', 'replace' );

	$str = file_get_contents(get_template_directory_uri() . '/assets/dist/paths/assets.json');
	$json = json_decode($str, true);
	
	if (is_home()) {
		wp_enqueue_style('wp-ubff-style-index', get_template_directory_uri() . '/assets/dist/' . $json['index']['css']);
	}

	wp_enqueue_style('wp-ubff-style-index', get_template_directory_uri() . '/assets/dist/' . $json['index']['css']);
	
	

		
	
	// wp_enqueu_style('wp-ubff-main', get_template_directory_uri() . '')

	// wp_enqueue_script( 'wp-ubff-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
add_action( 'wp_enqueue_scripts', 'wp_ubff_scripts' );

function prefix_footer_code() {
	$str = file_get_contents(get_template_directory_uri() . '/assets/dist/paths/assets.json');
	$json = json_decode($str, true);
	// Add your code here.
	wp_enqueue_script('wp-ubff-index',  get_template_directory_uri() . '/assets/dist/' . $json['index']['js'][0]);
	wp_enqueue_script('wp-ubff-index-chunk',  get_template_directory_uri() . '/assets/dist/' . $json['index']['js'][1]);
}
add_action( 'wp_footer', 'prefix_footer_code' );



function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );





require get_template_directory() . '/template-parts/template-functions/template-functions.php';

require get_template_directory() . '/template-parts/carbon-fields/banner-image-section.php';

require get_template_directory() . '/template-parts/carbon-fields/latest-posts.php';



require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}