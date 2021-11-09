<?php


use Carbon_Fields\Block;
use Carbon_Fields\Field;
add_action('carbon_fields_register_fields', 'crb_add_gallery');
    function crb_add_gallery()
    {

        $menu_list = array();

        if( $menu_items = wp_get_nav_menu_items('menu-1') ) { 
                        
            foreach ( (array) $menu_items as $key => $menu_item ) {
                $id = $menu_item->ID;
                $title = $menu_item->title;
                $menu_list[$id] = $title;
            }          
        }

Block::make( __( 'My shiny gutenberg block' ) )
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
            ) ),
        Field::make('select', 'crb_gallery_button', __('Select a section for a link'))
            ->set_options($menu_list),
        Field::make('text', 'crb_gallery_header', __('Gallery heading text'))
            ->set_default_value( __('Gallery heading text') ),
           
	))
    ->set_inner_blocks( true )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		?>

<?php                   $post_count = $fields['crb_gallery_button'];
                        $link = get_home_url();
                        $button_text;
                        if( $menu_items = wp_get_nav_menu_items('menu-1') ) { 
                            foreach ( (array) $menu_items as $key => $menu_item ) {
                                $menu_id = $menu_item->ID;
                                $menu_url = $menu_item->url;
                                $menu_text = $menu_item->title;
                                    if($menu_id == $post_count) {
                                        $link = $menu_url;
                                        $button_text = $menu_text;
                                    }
                            }          
                        } ?>
<section class="gallery section">
    <!-- fix section name-->
    <div class="heading__block">
        <?php
       
       if (!empty($fields['crb_gallery_header']) ) {
           echo '<h2 class="main-title">' . esc_html($fields['crb_gallery_header']) . '</h2>'; 
       } 
   ?>
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
    <?php if (!empty($fields['crb_gallery_button'])) {

 
    $link_id = $fields['crb_gallery_button'];
    $menu_items = wp_get_nav_menu_items($link_id);

    echo '<div class="button__wrapper"><a class="button__rounded button-blue" href="' . esc_url($link) . '">' . esc_html($button_text) . '</a>'; 
    }?>

</section>



<?php
	});
}