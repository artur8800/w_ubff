<?php


use Carbon_Fields\Container;
use Carbon_Fields\Field;


add_action('carbon_fields_register_fields', 'crb_team_members_options');
function crb_team_members_options(){

    Container::make( 'post_meta', 'Custom Data' )
    ->where( 'post_type', '=', 'team-members' )
    ->add_fields( array(
        Field::make( 'text', 'crb_team_member_role' ),
        Field::make( 'text', 'crb_team_facebook_link' )
        ->set_help_text( 'Enter team member Facebook page url' ),
        Field::make( 'text', 'crb_team_instagram_link' )
        ->set_help_text( 'Enter team member Instagram page url' ),
        Field::make( 'text', 'crb_team_youtube_link' )
        ->set_help_text( 'Enter team member Youtube page url' )
    ));

}