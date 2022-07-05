<?php

// The shortcode function
function k3e_spare_shortcode() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'templates/spare.php';
    $string = ob_get_clean();
    return $string;
}

// Register shortcode
add_shortcode('spare', 'k3e_spare_shortcode');
