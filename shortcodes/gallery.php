<?php

// The shortcode function
function k3e_growlist_gallery_shortcode($atts) {
    wp_enqueue_script('Lightbox2', plugin_dir_url(__FILE__) . "../node_modules/lightbox2/src/js/lightbox.js", ['jquery']);
    wp_enqueue_style('Lightbox2', plugin_dir_url(__FILE__) . "../node_modules/lightbox2/src/css/lightbox.css");
    wp_enqueue_style('Lightbox2-config', plugin_dir_url(__FILE__) . "../assets/lightbox.css");
    $photos = [];
    if (isset($atts['id'])) {
        $post_images = explode(",", unserialize(get_post_meta($atts['id'], "species_photos", true)));
        if (count($post_images) > 0 && $post_images[0] != "") {
            foreach ($post_images as $item) {
                $photos[] = [
                    'title' => get_post_meta($item, '_wp_attachment_image_alt', TRUE),
                    'lightbox' => "image-".$atts['id'],
                    'src' => wp_get_attachment_image_url( $item, 'blog' ),
                    'thumb' => wp_get_attachment_image_url( $item, 'lightbox' )
                ];
            }
        }
    }
    ob_start();
    include plugin_dir_path(__FILE__) . 'templates/gallery.php';
    $string = ob_get_clean();

    return $string;
}

// Register shortcode
add_shortcode('growlist-gallery', 'k3e_growlist_gallery_shortcode');
