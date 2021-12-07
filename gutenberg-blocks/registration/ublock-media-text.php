<?php 

function ublock_media_text_registration() {

// automatically load dependencies and version


	wp_register_script('ublock-media-text-js', get_template_directory_uri() . '/gutenberg-blocks/ublock-media-text/ublock-media-text.js');
 
	register_block_type('ublock/media-text', [
		'editor_script' => 'ublock-media-text-js',
	]);

	

}

add_action( 'init', 'ublock_media_text_registration' );

function ublock_column_registration() {

	// automatically load dependencies and version
	
	
		wp_register_script('ublock-column-js', get_template_directory_uri() . '/gutenberg-blocks/ublock-column/ublock-column.js');
	 
		register_block_type('ublock/column', [
			'editor_script' => 'ublock-column-js',
		]);
	
		
	
	}
	
add_action( 'init', 'ublock_column_registration' );