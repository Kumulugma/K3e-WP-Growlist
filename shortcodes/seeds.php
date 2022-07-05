<?php

// The shortcode function
function k3e_seeds_shortcode() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'templates/seeds.php';
    $string = ob_get_clean();
    return $string;
}

// Register shortcode
add_shortcode('seeds', 'k3e_seeds_shortcode');
