<?php


use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_add_latest_block');
    function crb_add_latest_block()
    {

        $menu_list = array();

            if( $menu_items = wp_get_nav_menu_items('menu-1') ) { 
                            
                foreach ( (array) $menu_items as $key => $menu_item ) {
                    $id = $menu_item->ID;
                    $title = $menu_item->title;
                    $menu_list[$id] = $title;
                }          
            }

        Block::make(__('Latest posts'))
        ->add_fields(array(
            Field::make('text', 'crb_recent_post_title', __('Heading text'))
            ->set_default_value( __('Heading text') ),
            Field::make('select', 'crb_recent_post_count', __('Choose Post count'))
            ->set_options($menu_list)
        ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        ?>
<section class="news section bg-gray-6">
    <div class="heading__block">
        <?php
       
                        if (!empty($fields['crb_recent_post_title']) ) {
                            echo '<h2 class="main-title">' . esc_html($fields['crb_recent_post_title']) . '</h2>'; 
                        } 
                    ?>
    </div>
    <div class="news__wrapper">
        <div class="container">
            <div class="row">
                <?php

                        $args = array(
                                'post_status' => 'publish',
                                'numberposts' => 3,
                        );

                        $result = wp_get_recent_posts($args);


                        $post_count = $fields['crb_recent_post_count'];
                        $link = get_home_url();

                        if( $menu_items = wp_get_nav_menu_items('menu-1') ) { 
                            foreach ( (array) $menu_items as $key => $menu_item ) {
                                $id = $menu_item->ID;
                                $url = $menu_item->url;
                                    if($id == $post_count) {
                                        $link = $url;
                                    }
                            }          
                        }

                        foreach ($result as $p) {
                            ?>

                <div class="col s4 m4 l4 xl4">
                    <div class="news__item">
                        <a class="news__link"
                            href="<?php echo esc_url( apply_filters( 'the_permalink', get_permalink( $p['ID'] ), $p['ID'] ) ); ?>">

                            <div class="news__image">
                                <?php echo get_the_post_thumbnail( $p['ID'], 'post-thumbnail' ); ?>

                            </div>
                            <h3 class="news__title post-title">
                                <?php echo $p['post_title'] ?>
                            </h3>
                            <span class="news__date">
                                <?php echo get_the_date(); ?>
                            </span>
                        </a>
                    </div>
                </div>
                <?php 
                            } ?>

            </div>

        </div>
        <a href="<?php echo esc_url($link) ?>">BUTTON</a>
    </div>
</section>


<?php
    });
    }