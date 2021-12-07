<?php 

function ublock_section_registration() {

// automatically load dependencies and version


	wp_register_script('ublock-section-js', get_template_directory_uri() . '/gutenberg-blocks/ublock-section/ublock-section.js');
 
	register_block_type('ublock/section', [
		'editor_script' => 'ublock-section-js',
		'editor_style' => 'ublock-section-block-editor',
	]);

	wp_register_style(
    'ublock-section-block-editor', get_template_directory_uri() . '/gutenberg-blocks/ublock-section/ublock-section.css');

}

add_action( 'init', 'ublock_section_registration' );