<?php


use Carbon_Fields\Block;
use Carbon_Fields\Field;
add_action('carbon_fields_register_fields', 'crb_partners_block');
    function crb_partners_block()
    {

        

Block::make( __( 'Partners Block' ) )
	->add_fields( array(
        Field::make( 'complex', 'crb_media_item' )
        ->set_layout('tabbed-horizontal')
        ->add_fields('partner-images', array(
            Field::make( 'media_gallery', 'crb_media_gallery', __( 'Media Gallery' ) )
            ->set_type( array( 'image' ) ),
        )),
        Field::make('text', 'crb_partners_header', __('Partners heading text'))
	))
    
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
?>

<section class="partners section bg-gray-6">
    <div class="heading__block">
        <?php echo '<h2 class="main-title"></h2>';  ?>
    </div>
    <div class="container">
        <div class="row">
            <?php
            $slides = $fields['crb_media_item' ];
            echo '<ul class="partners__list clearfix">';
            foreach ($fields['crb_media_item'] as $item) {
                                    
                if (isset($item['crb_media_gallery'])) {

                    foreach($item['crb_media_gallery'] as $id) {
                        
                        echo '<li  class="col s2 m4 l2 xl2">';
                        $attachment_link = wp_get_attachment_caption( $id );
                        echo '<a class="partners__item" href="'. $attachment_link .'">';
                       
                        $image_src = wp_get_attachment_image_url( $id, 'promo-image' );
                        $image_srcset = wp_get_attachment_image_srcset( $id, 'promo-image' );
                        $image_sizes = wp_get_attachment_image_sizes( $id, 'promo-image' );

                        echo '<div class="partners__item">
                        <img src="'. $image_src . '" 
                        srcset="'. $image_srcset .'"
                        sizes="'. $image_sizes .'"
                        alt="'. get_the_title($id) .'">
                        </div>';
                        echo '</a>';
                        echo '</li>';
                    }  
                }
            }
            echo '</ul>'
        ?>





        </div>
    </div>


</section>



<?php
	} );
    }