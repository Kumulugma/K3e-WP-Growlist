<?php
// The shortcode function
function k3e_growlist_shortcode() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'templates/growlist.php';
    $string = ob_get_clean();
    return $string;
}

// Register shortcode
add_shortcode('growlist', 'k3e_growlist_shortcode');