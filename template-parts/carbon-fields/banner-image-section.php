<?php


use Carbon_Fields\Block;
use Carbon_Fields\Field;




    add_action( 'carbon_fields_register_fields', 'crb_add_test_block' );
    function crb_add_test_block() {
        Block::make( __( 'Banner section' ) )
	->add_fields( array(
		Field::make( 'text', 'button_url', __( 'URL for Button' ) ),
		Field::make( 'image', 'image', __( 'Block Image' ) ),
		Field::make( 'rich_text', 'heading', __( 'Block Content' ) ),
	) )
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		?>
          <section class="banner__section">
            <div class="container">

                <div class="banner__wrapper">
                    <div class="banner__image">
                     <?php echo wp_get_attachment_image( $fields['image'], 'full') ?>
                        
                    </div>
                    <div class="banner__info">
                        <h1 class="banner__title text-blue"><?php echo apply_filters( 'the_content', $fields['heading'] ); ?></h1>
                        <?php  
                            $buton_field = $fields['button_url'];
                           
                            if (isset($buton_field)) {
                                $link = get_permalink( get_page_by_path( esc_html( $buton_field) ) );
                            } else {
                                $link = get_home_url();
                            }
                        ?>
                        
                        <a href="<?php echo $link ?>" class="button__rounded button-blue">Про
                            федерацію</a>
                       
                       
                    </div>
                </div>

            </div>

        </section>


		<?php
	} );
    }