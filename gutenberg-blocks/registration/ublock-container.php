<?php 

function ublock_container_registration() {

// automatically load dependencies and version


	wp_register_script('ublock-container-js', get_template_directory_uri() . '/gutenberg-blocks/ublock-container/ublock-container.js');
 
	register_block_type('ublock/container', [
		'editor_script' => 'ublock-container-js',
		'editor_style' => 'ublock-container-block-editor',
	]);

	wp_register_style(
    'ublock-container-block-editor', get_template_directory_uri() . '/gutenberg-blocks/ublock-container/ublock-container.css');

}

add_action( 'init', 'ublock_container_registration' );