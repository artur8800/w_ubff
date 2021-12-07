<?php 
function wp_image_with_srcset_and_meta($image_id, $image_size, $css_class) {

    if (!empty($image_id)) {

        $image_sizes = wp_get_attachment_image_sizes($image_id, $image_size);
        $srcset = wp_get_attachment_image_srcset($image_id, $image_size);
        $image = wp_get_attachment_image_src( $image_id, $image_size, FALSE );
        $image_title = get_the_title($image_id);


        $image_string = '<img class="'. $css_class . '" src="' . $image[0] . '" srcset="' . $srcset . '"
            sizes="' . $image_sizes . '" title="' . $image_title . '" />';

        return $image_string;
    }
}

function wp_return_post__text($text) {
    if (isset($text)) {
        return preg_replace('/<p([^>]*)>/', '<p class="post__text" $1>', $text);
    }
}