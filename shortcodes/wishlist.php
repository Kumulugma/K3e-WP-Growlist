<?php

// The shortcode function
function k3e_wishlist_shortcode() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'templates/wishlist.php';
    $string = ob_get_clean();
    return $string;
}

// Register shortcode
add_shortcode('wishlist', 'k3e_wishlist_shortcode');
