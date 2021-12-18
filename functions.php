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

		add_image_size( 'banner-size', 760, 496, true );

		add_image_size( 'gallery-square', 160, 160, true );

		add_image_size( 'gallery-horizontal', 260, 160, true );

		add_image_size( 'gallery-vertical', 260, 360, true );

		add_image_size( 'promo-image', 160, 140, true );

		add_image_size( 'blog-image', 460, 286, true );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'wp-ubff' ),
				'footer-menu' => esc_html__( 'Footer', 'wp-ubff' )
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

add_filter( 'image_size_names_choose', 'my_custom_sizes' );
 
function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'gallery-square' => __( 'Square' ),
		'gallery-horizontal' => __( 'Horizontal' ),
		'gallery-vertical' => __( 'Vertical' ),
    ) );
}


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

function register_crb_style() {
	wp_register_style(
		'crb-my-shiny-gutenberg-block-stylesheet',
		get_stylesheet_directory_uri() . '/template-parts/carbon-fields/style.css'
	);
}

add_action('wp_enqueue_scripts', 'register_crb_style');


add_filter( 'max_srcset_image_width', 'max_srcset_image_width', 10 , 2 );
function max_srcset_image_width() {
    return 2048;
}
// function gutenberg_examples_01_register_block() {
 
//     // automatically load dependencies and version
// 	var_dump(plugin_dir_path( __FILE__ ));
//     $asset_file = include( plugin_dir_path( __FILE__ ) . 'custom/awp-myfirstblock.asset.php');
 
//     wp_register_script(
//         'gutenberg-examples-01-esnext',
//         plugins_url( 'custom/myfirstblock.js', __FILE__ ),
//         $asset_file['dependencies'],
//         $asset_file['version']
//     );
 
 
// }
// add_action( 'init', 'gutenberg_examples_01_register_block' );




// function include_ad_before_heading($block_content, $block)
// {

//     if ($block['blockName'] === 'core/media-text') {
// 		print_r($block_content);
//       ///  return '<div class="my-ad"></div>' . $block_content;

//     } else {

//         return $block_content;

//     }

// }

// add_filter( 'render_block', 'include_ad_before_heading', 10, 2 );



// Register Custom Post Type
function create_team_members() {

	$labels = array(
		'name'                  => _x( 'Team Members', 'Post Type General Name', 'cw-custom-post-types' ),
		'singular_name'         => _x( 'Team Member', 'Post Type Singular Name', 'cw-custom-post-types' ),
		'menu_name'             => __( 'Team Members', 'cw-custom-post-types' ),
		'name_admin_bar'        => __( 'Team Members', 'cw-custom-post-types' ),
		'archives'              => __( 'Team Member Archives', 'cw-custom-post-types' ),
		'parent_item_colon'     => __( 'Parent Team Member:', 'cw-custom-post-types' ),
		'all_items'             => __( 'All Team Members', 'cw-custom-post-types' ),
		'add_new_item'          => __( 'Add New Team Member', 'cw-custom-post-types' ),
		'add_new'               => __( 'Add New', 'cw-custom-post-types' ),
		'new_item'              => __( 'New Team Member', 'cw-custom-post-types' ),
		'edit_item'             => __( 'Edit Team Member', 'cw-custom-post-types' ),
		'update_item'           => __( 'Update Team Member', 'cw-custom-post-types' ),
		'view_item'             => __( 'View Team Member', 'cw-custom-post-types' ),
		'search_items'          => __( 'Search Team Member', 'cw-custom-post-types' ),
		'not_found'             => __( 'Not found', 'cw-custom-post-types' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'cw-custom-post-types' ),
		'featured_image'        => __( 'Featured Image', 'cw-custom-post-types' ),
		'set_featured_image'    => __( 'Set featured image', 'cw-custom-post-types' ),
		'remove_featured_image' => __( 'Remove featured image', 'cw-custom-post-types' ),
		'use_featured_image'    => __( 'Use as featured image', 'cw-custom-post-types' ),
		'insert_into_item'      => __( 'Insert into Team Member', 'cw-custom-post-types' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Team Member', 'cw-custom-post-types' ),
		'items_list'            => __( 'Team Members list', 'cw-custom-post-types' ),
		'items_list_navigation' => __( 'Team Members list navigation', 'cw-custom-post-types' ),
		'filter_items_list'     => __( 'Filter Team Members list', 'cw-custom-post-types' ),
	);
	$args = array(
		'label'                 => __( 'Team Member', 'cw-custom-post-types' ),
		'description'           => __( 'Chalk and Ward Team Members', 'cw-custom-post-types' ),
		'labels'                => $labels,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'excerp',
			'page-attributes',
			'custom-fields'
		),
		'taxonomies'            => array( 'category' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'template' 				=> true,
		'rewrite'   => array( 'slug' => 'team' ),
		'capability_type'       => 'page',
	);
	register_post_type( 'team-members', $args );

}
add_action( 'init', 'create_team_members', 0 );




require get_template_directory() . '/template-parts/template-functions/template-functions.php';

require get_template_directory() . '/template-parts/carbon-fields/gutenberg/banner-image-section.php';

require get_template_directory() . '/template-parts/carbon-fields/gutenberg/latest-posts.php';

require get_template_directory() . '/template-parts/carbon-fields/gutenberg/main-page-gallery.php';

require get_template_directory() . '/template-parts/carbon-fields/gutenberg/partners.php';

require get_template_directory() . '/template-parts/carbon-fields/page-containers/team-members.php';
// require get_template_directory() . '/template-parts/carbon-fields/main-info-social.php';
require get_template_directory() . '/template-parts/carbon-fields/gutenberg/team-member-info.php';

require get_template_directory() . '/inc/custom-header.php';

require  get_template_directory() . '/gutenberg-blocks/registration/ublock-section.php';

require  get_template_directory() . '/gutenberg-blocks/registration/ublock-media-text.php';
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