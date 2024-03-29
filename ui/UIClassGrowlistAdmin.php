<?php

class UIClassGrowlistAdmin {

    public static function run() {

        add_action('admin_menu', 'growlist_menu');

        function growlist_menu() {

            add_menu_page(
                    __('Poszukiwane', 'k3e'), //Title
                    __('Poszukiwane', 'k3e'), //Name
                    'manage_options',
                    'wishlist',
                    'wishlist_content',
                    'dashicons-code-standards',
                    8
            );

            add_submenu_page(
                    'edit.php?post_type=species',
                    __('Lista roślin', 'k3e'),
                    __('Lista roślin', 'k3e'),
                    'manage_options',
                    'growlist',
                    'growlist_content'
            );

            add_submenu_page(
                    'edit.php?post_type=species',
                    __('Statystyki', 'k3e'),
                    __('Statystyki', 'k3e'),
                    'manage_options',
                    'growlist_stats',
                    'growlist_stats_content'
            );

            add_submenu_page(
                    'edit.php?post_type=species',
                    __('Eksport danych', 'k3e'),
                    __('Eksport danych', 'k3e'),
                    'manage_options',
                    'growlist_export',
                    'growlist_export_content'
            );

            add_submenu_page(
                    'edit.php?post_type=species',
                    __('PDF', 'k3e'),
                    __('PDF', 'k3e'),
                    'manage_options',
                    'growlist_pdf',
                    'growlist_pdf_content'
            );

            add_submenu_page(
                    'edit.php?post_type=species',
                    __('Albumy', 'k3e'),
                    __('Albumy', 'k3e'),
                    'manage_options',
                    'growlist_photos',
                    'growlist_photos_content'
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

        UIClassGrowlistAdmin::GrowlistBox();
        UIClassGrowlistAdmin::GrowlistPhotos();
        UIClassGrowlistAdmin::Wishlist();
        UIClassGrowlistAdmin::GeneratePDF();
        UIClassGrowlistAdmin::GenerateCSV();
        UIClassGrowlistAdmin::IconInTaxonomy();
        UIClassGrowlistAdmin::PhotoPackages();

        UIClassGrowlistAdmin::AlterTableList();

        UIClassGrowlistAdmin::ajaxFunctions();

        add_action('admin_enqueue_scripts', 'k3e_growlist_admin_enqueue');

        function k3e_growlist_admin_enqueue() {
            wp_enqueue_style('k3e', plugin_dir_url(__FILE__) . '../assets/k3e.css');

            $screen = get_current_screen();

            if ('species_page_growlist_photos' === $screen->base && $_GET['page'] === 'growlist_photos') {
                wp_enqueue_style('K3e-Growlist-Photos', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-photos.css');
                wp_enqueue_style('K3e-Buttons', plugin_dir_url(__FILE__) . '../assets/k3e-buttons.css');
                wp_enqueue_style('K3e-Table', plugin_dir_url(__FILE__) . '../assets/k3e-table.css');
                wp_enqueue_style('Font-Awesome', plugin_dir_url(__FILE__) . "../node_modules/font-awesome/css/font-awesome.min.css");
                wp_register_script('K3e-Growlist-Photos', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-photos.js', array('jquery'), '0.1');
                wp_localize_script('K3e-Growlist-Photos', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax-nonce')));
                wp_enqueue_script('K3e-Growlist-Photos');
            }
            if ('species_page_growlist_export' === $screen->base && $_GET['page'] === 'growlist_export') {
                wp_enqueue_style('K3e-Growlist-Export', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-export.css');
                wp_enqueue_style('K3e-Buttons', plugin_dir_url(__FILE__) . '../assets/k3e-buttons.css');
                wp_enqueue_style('K3e-Table', plugin_dir_url(__FILE__) . '../assets/k3e-table.css');
                wp_enqueue_style('Font-Awesome', plugin_dir_url(__FILE__) . "../node_modules/font-awesome/css/font-awesome.min.css");
                wp_register_script('K3e-Growlist-Export', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-export.js', array('jquery'), '0.1');
                wp_localize_script('K3e-Growlist-Export', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax-nonce')));
                wp_enqueue_script('K3e-Growlist-Export');
            }
            if ('species_page_growlist_pdf' === $screen->base && $_GET['page'] === 'growlist_pdf') {
                wp_enqueue_style('K3e-Growlist-Pdf', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-pdf.css');
                wp_enqueue_style('K3e-Buttons', plugin_dir_url(__FILE__) . '../assets/k3e-buttons.css');
                wp_enqueue_style('K3e-Table', plugin_dir_url(__FILE__) . '../assets/k3e-table.css');
                wp_enqueue_style('Font-Awesome', plugin_dir_url(__FILE__) . "../node_modules/font-awesome/css/font-awesome.min.css");
                wp_register_script('K3e-Growlist-Pdf', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-pdf.js', array('jquery'), '0.1');
                wp_localize_script('K3e-Growlist-Pdf', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax-nonce')));
                wp_enqueue_script('K3e-Growlist-Pdf');
            }
        }

        function growlist_content() {

            UIClassGrowlistAdmin::List();
            include plugin_dir_path(__FILE__) . 'templates/growlist.php';
        }

        function spare_content() {

            UIClassGrowlistAdmin::List();
            include plugin_dir_path(__FILE__) . 'templates/spare.php';
        }

        function seedlist_content() {

            UIClassGrowlistAdmin::List();
            include plugin_dir_path(__FILE__) . 'templates/seedlist.php';
        }

        function wishlist_content() {

            include plugin_dir_path(__FILE__) . 'templates/wishlist.php';
        }

        function growlist_stats_content() {

            include plugin_dir_path(__FILE__) . 'templates/growlist/stats.php';
        }

        function growlist_export_content() {

            include plugin_dir_path(__FILE__) . 'templates/growlist/export.php';
        }

        function growlist_pdf_content() {

            include plugin_dir_path(__FILE__) . 'templates/growlist/pdf.php';
        }

        function growlist_photos_content() {

            include plugin_dir_path(__FILE__) . 'templates/growlist/photos.php';
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
                'species_own',
            ];
            foreach ($fields as $field) {
                if (array_key_exists($field, $_POST)) {
                    update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
                }
            }
            if (!isset($_POST['species_own'])) {
                update_post_meta($post_id, 'species_own', 0);
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
                    update_post_meta($post_id, $field, serialize(sanitize_text_field($_POST[$field])));
                }
            }
        }

        add_action('save_post', 'k3e_growlist_photos_save_meta_box');

        add_action('wp_ajax_postimage_get_files', 'postimage_get_files');

        function postimage_get_files() {
            if (isset($_GET['id'])) {

                $ids = explode(",", $_GET['id']);
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

    public static function Wishlist() {
        if (isset($_POST['Growlist'])) {
            $wishlist = ($_POST['Growlist']['wishlist']);
            update_option('wishlist', serialize($wishlist));
            wp_redirect('admin.php?page=' . $_GET['page']);
        }
    }

    public static function GeneratePDF() {
        if (isset($_POST['Growlist']['PDF'])) {
            $growlist = [];

            if ($_POST['Growlist']['species_status'] != -1) {
                $post_status = $_POST['Growlist']['species_status'];
            } else {
                $post_status = NULL;
            }

            $i = 1;
            foreach (get_terms('groups', array('hide_empty' => false,)) as $group) {

                if ($post_status) {
                    $args = array(
                        'post_type' => 'species',
                        'order' => 'ASC',
                        'orderby' => 'title',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'groups',
                                'field' => 'slug',
                                'terms' => $group->slug
                            ),
                        ),
                        'meta_query' => array(
                            array(
                                'key' => 'species_state',
                                'value' => $post_status,
                                'compare' => '='
                            )
                        )
                    );
                } else {
                    $args = array(
                        'post_type' => 'species',
                        'order' => 'ASC',
                        'orderby' => 'title',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'groups',
                                'field' => 'slug',
                                'terms' => $group->slug
                            )
                        )
                    );
                }

                $species = new WP_Query($args);
                if ($species->have_posts()) {
                    while ($species->have_posts()) : $species->the_post();
                        $growlist[$i]['i'] = $i;
                        $growlist[$i]['code'] = get_post_meta(get_the_ID(), 'species_code', true) ?: '';
                        $growlist[$i]['name'] = get_the_title();
                        $growlist[$i]['mininame'] = get_post_meta(get_the_ID(), 'species_name', true);
                        $groups = "";
                        foreach (get_the_terms(get_the_ID(), 'groups') as $group) {
                            $groups .= $group->name . " ";
                        }
                        $growlist[$i]['group'] = $groups;
                        switch (get_post_meta(get_the_ID(), 'species_state', true)) {
                            case 1:
                                $growlist[$i]['state'] = __('Ok', 'k3e');
                                break;
                            case 2:
                                $growlist[$i]['state'] = __('Wysiew', 'k3e');
                                break;
                            case 4:
                                $growlist[$i]['state'] = __('Nie przetrwał', 'k3e');
                                break;
                        }
                        $growlist[$i]['comment'] = get_post_meta(get_the_ID(), 'species_comment', true) ?: '';

                        $post_images = explode(",", unserialize(get_post_meta(get_the_ID(), "species_photos", true)));
                        $growlist[$i]['images'] = count($post_images) - 1;
                        $growlist[$i]['thumbnail'] = has_post_thumbnail(get_the_ID());
                        $i++;
                    endwhile;
                }
            }
            update_option('_pdf_growlist', json_encode($growlist));

            include plugin_dir_path(__FILE__) . 'templates/growlist/document_pdf.php';

            wp_redirect('admin.php?page=' . $_GET['page']);
        }
    }

    public static function GenerateCSV() {
        if (isset($_POST['Growlist']['CSV'])) {
            $growlist = [];

            $i = 1;
            foreach (get_terms('groups', array('hide_empty' => false,)) as $group) {

                $args = array(
                    'post_type' => 'species',
                    'order' => 'ASC',
                    'orderby' => 'title',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'groups',
                            'field' => 'slug',
                            'terms' => $group->slug
                        )
                    )
                );

                $species = new WP_Query($args);
                if ($species->have_posts()) {
                    while ($species->have_posts()) : $species->the_post();
                        $growlist[$i]['i'] = $i;
                        $growlist[$i]['code'] = get_post_meta(get_the_ID(), 'species_code', true) ?: '';
                        $growlist[$i]['name'] = get_the_title();
                        $growlist[$i]['mininame'] = get_post_meta(get_the_ID(), 'species_name', true);
                        $groups = "";
                        foreach (get_the_terms(get_the_ID(), 'groups') as $group) {
                            $groups .= $group->name . " ";
                        }
                        $growlist[$i]['group'] = $groups;
                        switch (get_post_meta(get_the_ID(), 'species_state', true)) {
                            case 1:
                                $growlist[$i]['state'] = __('Ok', 'k3e');
                                break;
                            case 2:
                                $growlist[$i]['state'] = __('Wysiew', 'k3e');
                                break;
                            case 4:
                                $growlist[$i]['state'] = __('Nie przetrwał', 'k3e');
                                break;
                        }
                        $growlist[$i]['comment'] = get_post_meta(get_the_ID(), 'species_comment', true) ?: '';

                        $post_images = explode(",", unserialize(get_post_meta(get_the_ID(), "species_photos", true)));
                        $growlist[$i]['images'] = count($post_images) - 1;
                        $growlist[$i]['thumbnail'] = has_post_thumbnail(get_the_ID());
                        $i++;
                    endwhile;
                }
            }
            update_option('_csv_growlist', json_encode($growlist));

            include plugin_dir_path(__FILE__) . 'templates/growlist/document_csv.php';

            wp_redirect('admin.php?page=' . $_GET['page']);
        }
    }

    public static function AlterTableList() {
        add_filter('manage_species_posts_columns', 'rename_first_column');

        function rename_first_column($columns) {
            foreach ($columns as $k => $column) {
                if ($column == 'Tytuł') {
                    $columns[$k] = __('Nazwa', 'k3e');
                }
            }
            return $columns;
        }

        add_filter('manage_species_posts_columns', 'add_new_columns');

        function add_new_columns($columns) {
            $column_meta = array('species_state' => __('Status okazu', 'k3e'));
            $columns = array_slice($columns, 0, 2, true) + $column_meta + array_slice($columns, 2, NULL, true);
            $column_meta = array('species_name' => __('Szczegóły', 'k3e'));
            $columns = array_slice($columns, 0, 2, true) + $column_meta + array_slice($columns, 2, NULL, true);
            return $columns;
        }

        add_action('manage_species_posts_custom_column', 'custom_species_columns');

        function custom_species_columns($column) {
            global $post;
            switch ($column) {
                case 'species_name':
                    $metaData = get_post_meta($post->ID, 'species_name', true);
                    echo "<small>" . $metaData . "</small>";
                    break;
                case 'species_state':
                    $metaData = get_post_meta($post->ID, 'species_state', true);
                    switch ($metaData) {
                        case '1':
                            echo __('Ok', 'k3e');
                            break;
                        case '2':
                            echo __('Wysiew', 'k3e');
                            break;
                        case '4':
                            echo __('Nie przetrwał', 'k3e');
                            break;
                    }
                    break;
            }
        }

        add_filter('manage_species_posts_columns', function ($columns) {
            unset($columns['date']);
            return $columns;
        });

        add_filter('posts_join', 'species_search_join');

        function species_search_join($join) {
            global $pagenow, $wpdb;

            if (is_admin() && 'edit.php' === $pagenow && 'species' === $_GET['post_type'] && !empty($_GET['s'])) {
                $join .= 'LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
            }
            return $join;
        }

        add_filter('posts_where', 'species_search_where');

        function species_search_where($where) {
            global $pagenow, $wpdb;

            if (is_admin() && 'edit.php' === $pagenow && 'species' === $_GET['post_type'] && !empty($_GET['s'])) {
                $where = preg_replace(
                        "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
                        "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where);
                $where .= " GROUP BY {$wpdb->posts}.id";
            }
            return $where;
        }

    }

    public static function PhotoPackages() {
        if (isset($_POST['PhotoAlbum']['checksum'])) {
            if (!empty($_POST['PhotoAlbum']['start_date'])) {
                $start_date = $_POST['PhotoAlbum']['start_date'];
                $comment = $_POST['PhotoAlbum']['comment'];

                $query_images_args = array(
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'post_status' => 'inherit',
                    'posts_per_page' => - 1,
                    'date_query' => array(
                        array(
                            'after' => $start_date,
                            'before' => date('Y-m-d H:i:s'),
                            'inclusive' => true,
                        ),
                    ),
                );

                $query_images = new WP_Query($query_images_args);

                $post_id = wp_insert_post(array(
                    'post_type' => 'photo_album',
                    'post_title' => 'Album zdjęć od ' . $start_date . ' do ' . date('Y-m-d'),
                    'post_status' => 'publish',
                    'comment_status' => 'closed', // if you prefer
                    'ping_status' => 'closed', // if you prefer
                ));

                if ($post_id) {
                    // insert post meta
                    add_post_meta($post_id, 'ready_photos', 0);
                    add_post_meta($post_id, 'package_photos', $query_images->found_posts);
                    add_post_meta($post_id, 'start_date', $start_date);
                    add_post_meta($post_id, 'document_comment', $comment);
                }
            }



            if (isset($_POST['PhotoAlbum']['pack'])) {
                manuallyPackPhotos();
            }

            wp_redirect('admin.php?page=' . $_GET['page']);
        }
    }

    public static function IconInTaxonomy() {

        add_action('groups_add_form_fields', 'groups_add_term_fields');

        function groups_add_term_fields($taxonomy) {
            include plugin_dir_path(__FILE__) . 'templates/taxonomy/add.php';
        }

        add_action('admin_enqueue_scripts', 'k3e_groups_js');

        function k3e_groups_js() {

            if (!did_action('wp_enqueue_media')) {
                wp_enqueue_media();
            }
            wp_enqueue_script(
                    'K3e-Groups',
                    plugin_dir_url(__FILE__) . '../assets/k3e-groups.js',
                    array('jquery')
            );
        }

        add_action('groups_edit_form_fields', 'groups_edit_term_fields', 10, 2);

        function groups_edit_term_fields($term, $taxonomy) {
            include plugin_dir_path(__FILE__) . 'templates/taxonomy/edit.php';
        }

        add_action('created_groups', 'k3e_groups_save_term_fields');
        add_action('edited_groups', 'k3e_groups_save_term_fields');

        function k3e_groups_save_term_fields($term_id) {

            update_term_meta(
                    $term_id,
                    'k3e_groups_img',
                    absint($_POST['k3e_groups_img'])
            );
        }

    }

    public static function ajaxFunctions() {

        function k3e_export_no_logged() {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }

        add_action("wp_ajax_k3e_export_remove", "k3e_export_remove");
        add_action("wp_ajax_nopriv_k3e_export_remove", "k3e_export_no_logged");

        function k3e_export_remove() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-export-nonce")) {
                exit("Brak dostępu");
            }

            $comment = delete_post_meta($_REQUEST["id"], "_growlist_export");

            if ($comment === false) {
                $result['type'] = "error";
            } else {
                $result['type'] = "success";
            }

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $result = json_encode($result);
                echo $result;
            } else {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

            die();
        }

        //Photos
        add_action("wp_ajax_k3e_photos_comment", "k3e_photos_comment");
        add_action("wp_ajax_nopriv_k3e_photos_comment", "k3e_photos_no_logged");

        function k3e_photos_comment() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-photos-nonce")) {
                exit("Brak dostępu");
            }

            $comment = get_post_meta($_REQUEST["id"], "document_comment", true);
            $newComment = update_post_meta($_REQUEST["id"], "document_comment", $_REQUEST["comment"]);

            if ($newComment === false) {
                $result['type'] = "error";
                $result['comment'] = $comment;
            } else {
                $result['type'] = "success";
                $result['comment'] = $_REQUEST["comment"];
            }

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $result = json_encode($result);
                echo $result;
            } else {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

            die();
        }

        function k3e_photos_no_logged() {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }

        add_action("wp_ajax_k3e_photos_old_comment", "k3e_photos_old_comment");
        add_action("wp_ajax_nopriv_k3e_photos_old_comment", "k3e_photos_no_logged");

        function k3e_photos_old_comment() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-photos-nonce")) {
                exit("Brak dostępu");
            }

            $comment = get_post_meta($_REQUEST["id"], "document_comment", true);

            $result['type'] = "success";
            $result['comment'] = $comment;

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $result = json_encode($result);
                echo $result;
            } else {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

            die();
        }

        add_action("wp_ajax_k3e_photos_remove", "k3e_photos_remove");
        add_action("wp_ajax_nopriv_photos_remove", "k3e_photos_no_logged");

        function k3e_photos_remove() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-photos-nonce")) {
                exit("Brak dostępu");
            }

            $comment = wp_delete_post($_REQUEST["id"], "photo_album");

            if ($comment === false) {
                $result['type'] = "error";
            } else {
                $result['type'] = "success";
            }

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $result = json_encode($result);
                echo $result;
            } else {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

            die();
        }

        //Pdf
        add_action("wp_ajax_k3e_list_comment", "k3e_list_comment");
        add_action("wp_ajax_nopriv_k3e_list_comment", "k3e_list_no_logged");

        function k3e_list_comment() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-list-nonce")) {
                exit("Brak dostępu");
            }

            $comment = get_post_meta($_REQUEST["id"], "document_comment", true);
            $newComment = update_post_meta($_REQUEST["id"], "document_comment", $_REQUEST["comment"]);

            if ($newComment === false) {
                $result['type'] = "error";
                $result['comment'] = $comment;
            } else {
                $result['type'] = "success";
                $result['comment'] = $_REQUEST["comment"];
            }

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $result = json_encode($result);
                echo $result;
            } else {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

            die();
        }

        function k3e_list_no_logged() {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }

        add_action("wp_ajax_k3e_list_old_comment", "k3e_list_old_comment");
        add_action("wp_ajax_nopriv_k3e_list_old_comment", "k3e_list_no_logged");

        function k3e_list_old_comment() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-list-nonce")) {
                exit("Brak dostępu");
            }

            $comment = get_post_meta($_REQUEST["id"], "document_comment", true);

            $result['type'] = "success";
            $result['comment'] = $comment;

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $result = json_encode($result);
                echo $result;
            } else {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

            die();
        }

        add_action("wp_ajax_k3e_list_remove", "k3e_list_remove");
        add_action("wp_ajax_nopriv_list_remove", "k3e_list_no_logged");

        function k3e_list_remove() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-list-nonce")) {
                exit("Brak dostępu");
            }

            $comment = wp_delete_post($_REQUEST["id"], "photo_album");

            if ($comment === false) {
                $result['type'] = "error";
            } else {
                $result['type'] = "success";
            }

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $result = json_encode($result);
                echo $result;
            } else {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

            die();
        }

    }

}
