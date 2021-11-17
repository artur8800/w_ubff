<?php


use Carbon_Fields\Block;
use Carbon_Fields\Field;


add_action('carbon_fields_register_fields', 'crb_heading_block');
function crb_heading_block(){

    Block::make( __( 'Heading block' ) )
    ->add_fields( array(
        Field::make( 'text', 'heading', __( 'Block Heading' ) )
    ))
    ->set_render_callback( function ($fields, $attributes, $inner_blocks) {
        <div class="heading__block clearfix">
            <h2 class="main-title"><?php echo esc_html( $fields['heading'] ); ?></h2>
</div>

?>

<?php
});
}