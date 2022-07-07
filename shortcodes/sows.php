<?php
// The shortcode function
function k3e_sows_shortcode() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'templates/sows.php';
    $string = ob_get_clean();
    return $string;
}

// Register shortcode
add_shortcode('sows', 'k3e_sows_shortcode');