<?php


use Carbon_Fields\Block;
use Carbon_Fields\Field;
add_action('carbon_fields_register_fields', 'crb_add_gallery');
    function crb_add_gallery()
    {
Block::make( __( 'My Shiny Gutenberg Block' ) )
	->add_fields( array(
        Field::make( 'complex', 'crb_media_item' )
            ->set_layout('tabbed-horizontal')
            ->add_fields( 'left', array(
                Field::make( 'media_gallery', 'crb_media_gallery_left', __( 'Media Gallery' ) )
                ->set_duplicates_allowed( true )
                ->set_width( 50 )
                ->set_type( array( 'image', 'crb_image' ) )
            ) )
            ->add_fields( 'center', array(
                Field::make( 'media_gallery', 'crb_media_gallery_center', __( 'Media Gallery' ) )
                ->set_duplicates_allowed( true )
                ->set_width( 50 )
                ->set_type( array( 'image', 'crb_image' ) )
            ) )
            ->add_fields( 'right', array(
                Field::make( 'media_gallery', 'crb_media_gallery_right', __( 'Media Gallery' ) )
                ->set_duplicates_allowed( true )
                ->set_width( 50 )
                ->set_type( array( 'image', 'crb_image' ) )
            ) )
           
	))
    ->set_inner_blocks( true )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		?>

<section class="gallery section">
    <!-- fix section name-->
    <div class="heading__block">
        <h2 class="main-title">Новини</h2>
    </div>
    <div id="imageGallery" class="swiper__container">
        <div class="swiper__row swiper__gallery">
            <div class="swiper__left">
                <?php          
                                foreach ($fields['crb_media_item'] as $item) {
                                    
                                    if (isset($item['crb_media_gallery_left'])) {
                                            $num = 1;
                                            foreach($item['crb_media_gallery_left'] as $id) {
                                                
                                                if (($num % 2) == 0) {
                                                    $image = wp_get_attachment_image_sizes( $id, 'gallery-square' );
                                                    ?>
                <div class="swiper__card"> <img
                        src="<?php echo wp_get_attachment_image_url( $id, 'gallery-square' ); ?>"
                        srcset="<?php echo wp_get_attachment_image_srcset( $id, 'gallery-square' ); ?>"
                        sizes="<?php echo wp_get_attachment_image_sizes( $id, 'gallery-square' ); ?>"></div>
                <?php
                                                } 
                                                else {
                                                    ?>
                <div class="swiper__card"><img
                        src="<?php echo wp_get_attachment_image_url( $id, 'gallery-horizontal' ) ?>"
                        srcset="<?php echo wp_get_attachment_image_srcset( $id, 'gallery-horizontal' ) ?>"
                        sizes="<?php echo wp_get_attachment_image_sizes( $id, 'gallery-horizontal' ) ?>"></div>
                <?php
                                                }
                                                $num++;
                                            }
                                    }
                                }
                            ?>
            </div>
            <div class="swiper__center">

                <?php  foreach ($fields['crb_media_item'] as $item) {
                        if (isset($item['crb_media_gallery_center'])) {
                            foreach($item['crb_media_gallery_center'] as $id) {
                                ?>
                <div class="swiper__card"><img
                        src="<?php echo wp_get_attachment_image_url( $id, 'gallery-vertical' ) ?>"
                        srcset="<?php echo wp_get_attachment_image_srcset( $id, 'gallery-vertical' ) ?>"
                        sizes="<?php echo wp_get_attachment_image_sizes( $id, 'gallery-vertical' ) ?>"></div>
                <?php
                            }
                        }
                    }?>

            </div>
            <div class="swiper__right">

                <?php          
                                foreach ($fields['crb_media_item'] as $item) {
                                    
                                    if (isset($item['crb_media_gallery_right'])) {
                                            $num = 1;
                                            foreach($item['crb_media_gallery_right'] as $id) {
                                                
                                                if (($num % 2) == 0) {
                                                    $image = wp_get_attachment_image_sizes( $id, 'gallery-square' );
                                                    ?>
                <div class="swiper__card"> <img
                        src="<?php echo wp_get_attachment_image_url( $id, 'gallery-square' ); ?>"
                        srcset="<?php echo wp_get_attachment_image_srcset( $id, 'gallery-square' ); ?>"
                        sizes="<?php echo wp_get_attachment_image_sizes( $id, 'gallery-square' ); ?>"></div>
                <?php
                                                } 
                                                else {
                                                    ?>
                <div class="swiper__card"><img
                        src="<?php echo wp_get_attachment_image_url( $id, 'gallery-horizontal' ) ?>"
                        srcset="<?php echo wp_get_attachment_image_srcset( $id, 'gallery-horizontal' ) ?>"
                        sizes="<?php echo wp_get_attachment_image_sizes( $id, 'gallery-horizontal' ) ?>"></div>
                <?php
                                                }
                                                $num++;
                                            }
                                    }
                                }
                            ?>
            </div>
        </div>
    </div>
    <div class="button__wrapper">
        <a href="" class="button__rounded button-blue">Бiльше</a>
    </div>

</section>


</div><!-- /.block -->

<?php
	});
}