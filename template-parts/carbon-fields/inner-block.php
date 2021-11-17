<?php


use Carbon_Fields\Block;
use Carbon_Fields\Field;


add_action('carbon_fields_register_fields', 'crb_add_inner');
function crb_add_inner(){

    Block::make( __( 'Content section block' ) )
    ->set_inner_blocks( true )
    ->set_render_callback( function ($fields, $attributes, $inner_blocks) {
    ?>
<?php echo '<section>';

echo $inner_blocks;

echo '</section>'; ?>



<?php
});
}