<?php 

include get_template_directory() . './template-parts/utils/utils.php';
$id = block_value('imagefield', false);


$text = block_value('inner');




?>


<div class="container">
    <div class="row">
        <?php
        if (block_value( 'direction' )) {
            ?>

        <div class="post__image__block col s4 m8 l5 xl5">

            <?php  

                echo wp_image_with_srcset_and_meta($id, 'blog-image', 'post__image');
            ?>
        </div>
        <div class="post__text__block col s4 m6 l7 xl7 offset-m1">

        </div>

        <?php  
        } elseif (!block_value('direction')) {
        
        ?>

        <div class="post__text__block col s4 m6 l7 xl7 offset-m1">

            <?php echo  wp_return_post__text($text) ?>

        </div>
        <div class="post__image__block col s4 m8 l5 xl5">
            <?php  
           echo wp_image_with_srcset_and_meta($id, 'blog-image', 'post__image');
        ?>
        </div>

        <?php } ?>
    </div>
</div>