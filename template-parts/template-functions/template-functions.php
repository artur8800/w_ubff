<?php
/**
 * wp-ubff functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wp-ubff
 */


function add_menuclass($ulclass) {
	return preg_replace('/<a /', '<a class="header__navigation__links"', $ulclass);
 }
add_filter('wp_nav_menu','add_menuclass');





function change_logo_class( $html ) {

  
    $html = str_replace( 'custom-logo-link', 'header__logo__img', $html );
    return $html;
}

add_filter( 'get_custom_logo', 'change_logo_class' );


add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'testimonial',
            'title'             => __('Testimonial'),
            'description'       => __('A custom testimonial block.'),
            'render_template'   => 'template-parts/testimonial.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'testimonial', 'quote' ),
        ));
    }
}


// function remove_all_image_sizes() {
//     foreach ( get_intermediate_image_sizes() as $size ) {
//             remove_image_size( $size );
//     }
// }
// add_action('init', 'remove_all_image_sizes');

add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup() {
    //add_theme_support( 'post-thumbnails' );
    add_image_size( 'post-thumbnail', 360, 208, true);
    
}