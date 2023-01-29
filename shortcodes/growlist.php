<?php

// The shortcode function
function k3e_growlist_shortcode() {

    wp_enqueue_script(
            'Tippy',
            plugin_dir_url(__FILE__) . "../node_modules/tippy.js/dist/tippy-bundle.umd.min.js",
            ['Popper']
    );

    wp_enqueue_script(
            'Popper',
            plugin_dir_url(__FILE__) . "../node_modules/@popperjs/core/dist/umd/popper.min.js",
            ['jquery', 'Bootstrap']
    );

    wp_enqueue_script(
            'K3e-Tooltip',
            plugin_dir_url(__FILE__) . '../assets/k3e-tooltip.js',
            array('jquery', 'Popper', 'Tippy')
    );
    
    wp_enqueue_style(
            'K3e-Growlist',
            plugin_dir_url(__FILE__) . '../assets/k3e-growlist.css'
    );
    ob_start();
    include plugin_dir_path(__FILE__) . 'templates/growlist.php';
    $string = ob_get_clean();
    return $string;
}

// Register shortcode
add_shortcode('growlist', 'k3e_growlist_shortcode');
