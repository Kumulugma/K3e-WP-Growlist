<?php

/*
  Plugin name: K3e - Lista roślin
  Plugin URI:
  Description: Obsługa funkcjonalności listy roślin.
  Author: K3e
  Author URI: https://www.k3e.pl/
  Text Domain:
  Domain Path:
  Version: 0.1.7
 */
require_once 'cpt/species.php';
require_once 'cpt/plugin_taxonomy.php';
require_once 'cpt/photo_album.php';
require_once 'cron/growlist_photo_albums.php';

add_action('init', 'k3e_growlist_plugin_init');

function k3e_growlist_plugin_init() {
    do_action('k3e_growlist_plugin_init');

    require_once 'ui/UIClassGrowlist.php';
    require_once 'ui/UIClassGrowlistAdmin.php';
    require_once 'ui/UIClassGrowlistFront.php';
    require_once 'ui/UIFunctions.php';

    UIClassGrowlist::init();

    if (is_admin()) {
        require_once 'widgets/GrowlistWidget.php';
        require_once(plugin_dir_path(__FILE__) . '/vendor/autoload.php');
        GrowlistWidget::run();

        UIClassGrowlistAdmin::run();
    } else {
        UIClassGrowlistFront::run();
        require_once 'shortcodes/growlist.php';
        require_once 'shortcodes/wishlist.php';
        require_once 'shortcodes/sows.php';
        require_once 'shortcodes/gallery.php';
    }
}

function k3e_growlist_plugin_activate() {
    
}

register_activation_hook(__FILE__, 'k3e_growlist_plugin_activate');

function k3e_growlist_plugin_deactivate() {
    
}

register_deactivation_hook(__FILE__, 'k3e_growlist_plugin_deactivate');
