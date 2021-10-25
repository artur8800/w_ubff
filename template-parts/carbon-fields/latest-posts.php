<?php


use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_add_latest_block');
    function crb_add_latest_block()
    {
        Block::make(__('Latest posts'))
        ->add_fields(array(
            Field::make('text', 'crb_recent_post_title', __('Heading text')),
            Field::make('select', 'crb_recent_post_count', __('Choose Post count'))
            ->set_options(array(
                '1' => 1,
                '2' => 2,
                '3' => 3,
                '4' => 4,
                '5' => 5,
            ))
        ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        ?>
<section class="news section bg-gray-6">
    <div class="heading__block">
        <h2 class="main-title">Новини</h2>
    </div>
    <div class="news__wrapper">
        <div class="container">
            <div class="row">
                <?php
                $post_count = $fields['crb_select'];
                $args = array(
                        'post_status' => 'publish',
                        'numberposts' => $post_count,
                );

        $result = wp_get_recent_posts($args);

        foreach ($result as $p) {
            ?>
                <a href="<?php echo get_permalink($p['ID']) ?>"><?php echo $p['post_title'] ?></a><br />
                <?php
        } ?>

                <!-- <div class="heading__block">
            <h2 class="main-title">Новини</h2>
        </div>
        <div class="news__wrapper">
            <div class="container">

                <div class="row">
                    <div class="col s4 m4 l4 xl4">
                        <div class="news__item">
                            <a class="news__link">
                                <div class="news__image">
                                    <img src="../img/news1.jpg" alt="">
                                </div>
                                <h3 class="news__title post-title">
                                    Назва новини може бути дуже довгою, на два, на три або навіть на чотири рядка що дуже великою новиною
                                </h3>
                                <span class="news__date">
                                    1 січня 2021
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="col s4 m4 l4 xl4">
                        <div class="news__item">
                            <a class="news__link">
                                <div class="news__image">
                                    <img src="../img/news1.jpg" alt="">
                                </div>
                                <h3 class="news__title post-title">
                                    Назва новини може бути дуже довгою, на два, на три або навіть на чотири рядка що дуже великою новиною
                                </h3>
                                <span class="news__date">
                                    1 січня 2021
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="col s4 m4 l4 xl4">
                        <div class="news__item">
                            <a class="news__link">
                                <div class="news__image">
                                    <img src="../img/news1.jpg" alt="">
                                </div>
                                <h3 class="news__title post-title">
                                    Назва новини може бути дуже довгою, на два, на три або навіть на чотири рядка що дуже великою новиною
                                </h3>
                                <span class="news__date">
                                    1 січня 2021
                                </span>
                            </a>
                        </div>
                    </div>


                </div>
                <div class="button__wrapper">
                    <a href="" class="button__rounded button-blue">Всі Новини</a>
                </div>

            </div>
        </div> -->

</section>


<?php
    });
    }