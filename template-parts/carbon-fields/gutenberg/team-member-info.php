<?php


use Carbon_Fields\Field;
use Carbon_Fields\Block;

add_action( 'carbon_fields_register_fields', 'crb_team_member_info' );
function crb_team_member_info() {
    Block::make( __( 'Team members block' ) )
    ->add_tab( __('Leadership'), array(
        Field::make( 'association', 'crb_association_leadership', __( 'Leadership query' ) )
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'team-members',
            )
        ))
    ))
    ->add_tab( __('Trainers'), array(
        Field::make( 'association', 'crb_association_trainers', __( 'Trainers query' ) )
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'team-members',
            )
        ))
    ))
    ->add_tab( __('Athletes'), array(
        Field::make( 'association', 'crb_association_athletes', __( 'Athletes query' ) )
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'team-members',
            )
        ))
    ))
            
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		?>

<div class="block">
    <div class="block__heading">
        <h1><?php echo esc_html( $fields['heading'] ); ?></h1>
    </div><!-- /.block__heading -->

    <div class="block__image">
        <?php echo wp_get_attachment_image( $fields['image'], 'full' ); ?>
    </div><!-- /.block__image -->

    <div class="block__content">
        <?php echo apply_filters( 'the_content', $fields['content'] ); ?>
    </div><!-- /.block__content -->
</div><!-- /.block -->

<?php
	} );
}