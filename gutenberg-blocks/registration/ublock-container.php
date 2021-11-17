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



// $str = file_get_contents(get_template_directory_uri() . '/assets/dist/paths/assets.json');
// $json = json_decode($str, true);


// wp_register_script(
//     'ublock-container-block-editor',
//     plugins_url(get_template_directory_uri() . '/assets/dist/' . $json['ublock_container']['js'][1])
// );

// wp_register_style(
//     'ublock-container-block-editor',
//     plugins_url(get_template_directory_uri() . '/assets/dist/' . $json['ublock_container']['css'])
// );


// register_block_type( 'ublock-container/ublock-container', array(
//     'editor_script' => 'ublock-container-block-editor-script',
//     'editor_style'  => 'ublock-container-block-editor-style'
// ) );
}

add_action( 'init', 'ublock_container_registration' );