<?php

class Growlist {

    public static function run() {

        add_action('admin_menu', 'growlist_menu');

        function growlist_menu() {
            add_menu_page(
                    __('Lista roślin', 'k3e'), //Title
                    __('Lista roślin', 'k3e'), //Name
                    'manage_options',
                    'growlist',
                    'growlist_content',
                    'dashicons-list-view',
                    6
            );

            add_menu_page(
                    __('Nadmiarowe', 'k3e'), //Title
                    __('Nadmiarowe', 'k3e'), //Name
                    'manage_options',
                    'spare',
                    'spare_content',
                    'dashicons-products',
                    7
            );

            add_menu_page(
                    __('Nasiona', 'k3e'), //Title
                    __('Nasiona', 'k3e'), //Name
                    'manage_options',
                    'seedlist',
                    'seedlist_content',
                    'dashicons-email-alt2',
                    7
            );

            add_menu_page(
                    __('Poszukiwane', 'k3e'), //Title
                    __('Poszukiwane', 'k3e'), //Name
                    'manage_options',
                    'wishlist',
                    'wishlist_content',
                    'dashicons-code-standards',
                    8
            );

            /* Dostępne pozycje
              2 – Dashboard
              4 – Separator
              5 – Posts
              10 – Media
              15 – Links
              20 – Pages
              25 – Comments
              59 – Separator
              60 – Appearance
              65 – Plugins
              70 – Users
              75 – Tools
              80 – Settings
              99 – Separator
             */
        }

        Growlist::GrowlistBox();
        Growlist::GrowlistPhotos();
        Growlist::GrowlistSpare();
        Growlist::GrowlistSeeds();
        Growlist::Wishlist();

        function growlist_content() {

            Growlist::List();
            include plugin_dir_path(__FILE__) . 'templates/growlist.php';
        }

        function spare_content() {

            Growlist::List();
            include plugin_dir_path(__FILE__) . 'templates/spare.php';
        }

        function seedlist_content() {

            Growlist::List();
            include plugin_dir_path(__FILE__) . 'templates/seedlist.php';
        }

        function wishlist_content() {

            include plugin_dir_path(__FILE__) . 'templates/wishlist.php';
        }

    }

    public static function List() {
        wp_enqueue_script('dataTable', plugin_dir_url(__FILE__) . "../node_modules/datatables.net/js/jquery.dataTables.min.js", ['jquery']);
        wp_enqueue_style('dataTable-css', "https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css");
        wp_enqueue_script('dataTable-config', plugin_dir_url(__FILE__) . "../assets/dataTable.js");
    }

    public static function GrowlistBox() {

        function growlist_meta_box() {
            add_meta_box("growlist-data-meta-box", "Dodatkowe parametry", "growlist_box_markup", "species", "normal", "high", null);
        }

        add_action("add_meta_boxes", "growlist_meta_box");

        function growlist_box_markup($object) {
            include plugin_dir_path(__FILE__) . 'templates/meta/form.php';
        }

        function k3e_growlist_save_meta_box($post_id) {
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return;
            if ($parent_id = wp_is_post_revision($post_id)) {
                $post_id = $parent_id;
            }
            $fields = [
                'species_code',
                'species_name',
                'species_state',
                'species_comment',
            ];
            foreach ($fields as $field) {
                if (array_key_exists($field, $_POST)) {
                    update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
                }
            }
        }

        add_action('save_post', 'k3e_growlist_save_meta_box');
    }

    public static function GrowlistPhotos() {

        add_action("add_meta_boxes", "growlist_photos_meta_box");

        function growlist_photos_meta_box() {
            add_meta_box("growlist-photos-meta-box", "Zdjecia gatunku", "growlist_photos_box_markup", "species", "normal", "high", null);
        }

        function growlist_photos_box_markup($object) {
            wp_enqueue_media();
            wp_enqueue_script('K3e-Media', plugin_dir_url(__FILE__) . '../assets/k3e-media.js', array('jquery'), '0.1');

            include plugin_dir_path(__FILE__) . 'templates/photos/form.php';
        }

        function k3e_growlist_photos_save_meta_box($post_id) {
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return;
            if ($parent_id = wp_is_post_revision($post_id)) {
                $post_id = $parent_id;
            }

            $fields = [
                'species_photos',
            ];
            foreach ($fields as $field) {
                if (array_key_exists($field, $_POST)) {
//                    $photos = explode(",", $_POST[$field]);
//                    foreach ($photos as $photo) {
//                        $args = [
//                            'post_parent' => $post_id,
//                            'post_mime_type' => 'image/jpeg',
//                            'post_type' => 'attachment',
//                            'post_status' => 'inherit'
//                        ];
//                        wp_insert_post($args);
//                    }
                    update_post_meta($post_id, $field, serialize(sanitize_text_field($_POST[$field])));
                }
            }
        }

        add_action('save_post', 'k3e_growlist_photos_save_meta_box');

        add_action('wp_ajax_myprefix_get_image', 'myprefix_get_image');

        function myprefix_get_image() {
            if (isset($_GET['id'])) {

                $ids = explode(",", $_GET['id']);
                array_shift($ids);
                $images = [];

                foreach ($ids as $id) {
                    $images[] = wp_get_attachment_image($id, 'big-icons', false, array('id' => 'preview-images', 'style' => 'margin-left: 5px;'));
                }
                $data = array(
                    'images' => $images
                );
                wp_send_json_success($data);
            } else {
                wp_send_json_error();
            }
        }

    }

    public static function GrowlistSpare() {

        add_action("add_meta_boxes", "growlist_spare_meta_box");

        function growlist_spare_meta_box() {
            add_meta_box("growlist-spare-meta-box", "Dostępność nadmiarowych", "growlist_spare_box_markup", "species", "normal", "high", null);
        }

        function growlist_spare_box_markup($object) {
            include plugin_dir_path(__FILE__) . 'templates/spare/form.php';
        }

        function k3e_growlist_spare_save_meta_box($post_id) {
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return;
            if ($parent_id = wp_is_post_revision($post_id)) {
                $post_id = $parent_id;
            }
            $fields = [
                'species_spare',
                'species_spare_price',
            ];
            foreach ($fields as $field) {
                if (array_key_exists($field, $_POST)) {
                    update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
                }
            }
        }

        add_action('save_post', 'k3e_growlist_spare_save_meta_box');
    }

    public static function GrowlistSeeds() {

        add_action("add_meta_boxes", "growlist_seeds_meta_box");

        function growlist_seeds_meta_box() {
            add_meta_box("growlist-seeds-meta-box", "Dostępność nasion", "growlist_seeds_box_markup", "species", "normal", "high", null);
        }

        function growlist_seeds_box_markup($object) {
            include plugin_dir_path(__FILE__) . 'templates/seeds/form.php';
        }

        function k3e_growlist_seeds_save_meta_box($post_id) {
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return;
            if ($parent_id = wp_is_post_revision($post_id)) {
                $post_id = $parent_id;
            }
            $fields = [
                'species_seeds',
                'species_seeds_amount',
                'species_seeds_price',
            ];
            foreach ($fields as $field) {
                if (array_key_exists($field, $_POST)) {
                    update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
                }
            }
        }

        add_action('save_post', 'k3e_growlist_seeds_save_meta_box');
    }

    public static function Wishlist() {
        if (isset($_POST['Growlist'])) {
            $wishlist = htmlentities($_POST['Growlist']['wishlist']);
            update_option('wishlist', serialize($wishlist));
            wp_redirect('admin.php?page=' . $_GET['page']);
        }
    }

}
