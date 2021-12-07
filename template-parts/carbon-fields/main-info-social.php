<?php


use Carbon_Fields\Container;
use Carbon_Fields\Field;


add_action('carbon_fields_register_fields', 'crb_main_info_social');
function crb_main_info_social(){
    Container::make( 'theme_options', __( 'Social links', 'crb' ) )
    ->add_fields( 'Social', array(
        Field::make( 'text', 'crb_social_url_facebook', 'Facebook URL' )
            ->set_help_text( 'Enter your Facebook page url' ),
        Field::make( 'text', 'crb_social_url_twitter', 'Twitter URL' )
            ->set_help_text( 'Enter your Twitter profile url' ),
    ) );
};