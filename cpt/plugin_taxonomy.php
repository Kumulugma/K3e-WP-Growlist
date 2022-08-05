<?php

// Register Custom Taxonomy
function groups() {

    $labels = array(
        'name' => _x('Grupy', 'Taxonomy General Name', 'k3e'),
        'singular_name' => _x('Grupa', 'Taxonomy Singular Name', 'k3e'),
        'menu_name' => __('Grupa', 'k3e'),
        'all_items' => __('Wszystkie grupy', 'k3e'),
        'parent_item' => __('Nadrzędny grupa', 'k3e'),
        'parent_item_colon' => __('Nadrzędny grupa:', 'k3e'),
        'new_item_name' => __('Nazwa nowej grupy', 'k3e'),
        'add_new_item' => __('Dodaj nową grupę', 'k3e'),
        'edit_item' => __('Edytuj grupę', 'k3e'),
        'update_item' => __('Aktualizuj grupę', 'k3e'),
        'view_item' => __('Zobacz grupę', 'k3e'),
        'separate_items_with_commas' => __('Grupy oddzielaj przecinkiem', 'k3e'),
        'add_or_remove_items' => __('Dodaj lub usuń grupę', 'k3e'),
        'choose_from_most_used' => __('Wybierz z najczęściej używanych', 'k3e'),
        'popular_items' => __('Popularne grupy', 'k3e'),
        'search_items' => __('Szukaj grupy', 'k3e'),
        'not_found' => __('Brak grupy', 'k3e'),
        'no_terms' => __('Brak grupy', 'k3e'),
        'items_list' => __('Lista grup', 'k3e'),
        'items_list_navigation' => __('Nawigacja listy grup', 'k3e'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => false,
        'show_in_rest' => false,
    );
    register_taxonomy('groups', array('species'), $args);
}

add_action('init', 'groups', 0);

// Register Custom Taxonomy
function provider() {

    $labels = array(
        'name' => _x('Dostawcy', 'Taxonomy General Name', 'k3e'),
        'singular_name' => _x('Dostawca', 'Taxonomy Singular Name', 'k3e'),
        'menu_name' => __('Dostawcy', 'k3e'),
        'all_items' => __('Wszyscy dostawcy', 'k3e'),
        'parent_item' => __('Nadrzędny dostawca', 'k3e'),
        'parent_item_colon' => __('Nadrzędny dostawca:', 'k3e'),
        'new_item_name' => __('Nazwa nowego dostawcy', 'k3e'),
        'add_new_item' => __('Dodaj nowego dostawcę', 'k3e'),
        'edit_item' => __('Edytuj dostawcę', 'k3e'),
        'update_item' => __('Aktualizuj dostawcę', 'k3e'),
        'view_item' => __('Zobacz dostawcę', 'k3e'),
        'separate_items_with_commas' => __('Dostawców oddzielaj przecinkiem', 'k3e'),
        'add_or_remove_items' => __('Dodaj lub usuń dostawcę', 'k3e'),
        'choose_from_most_used' => __('Wybierz z najczęściej używanych', 'k3e'),
        'popular_items' => __('Popularni dostawcy', 'k3e'),
        'search_items' => __('Szukaj dostawcy', 'k3e'),
        'not_found' => __('Brak dostawcy', 'k3e'),
        'no_terms' => __('Brak dostawcy', 'k3e'),
        'items_list' => __('Lista dostawców', 'k3e'),
        'items_list_navigation' => __('Nawigacja listy dostawców', 'k3e'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => false,
        'show_in_rest' => false,
    );
    register_taxonomy('provider', array('species'), $args);
}

add_action('init', 'provider', 0);

// Register Custom Taxonomy
function volume() {

    $labels = array(
        'name' => _x('Roczniki', 'Taxonomy General Name', 'k3e'),
        'singular_name' => _x('Rocznik', 'Taxonomy Singular Name', 'k3e'),
        'menu_name' => __('Roczniki', 'k3e'),
        'all_items' => __('Wszystkie roczniki', 'k3e'),
        'parent_item' => __('rocznik nadrzędny', 'k3e'),
        'parent_item_colon' => __('rocznik nadrzędny:', 'k3e'),
        'new_item_name' => __('Nazwa nowego rocznika', 'k3e'),
        'add_new_item' => __('Dodaj nowy rocznik', 'k3e'),
        'edit_item' => __('Edytuj rocznik', 'k3e'),
        'update_item' => __('Aktualizuj rocznik', 'k3e'),
        'view_item' => __('Zobacz rocznik', 'k3e'),
        'separate_items_with_commas' => __('Oddziel roczniki przecinkami', 'k3e'),
        'add_or_remove_items' => __('Dodaj lub usuń rocznik', 'k3e'),
        'choose_from_most_used' => __('Wybierz z najczęściej używanych', 'k3e'),
        'popular_items' => __('Popularne roczniki', 'k3e'),
        'search_items' => __('Szukaj rocznika', 'k3e'),
        'not_found' => __('Brak roczników', 'k3e'),
        'no_terms' => __('Brak roczników', 'k3e'),
        'items_list' => __('Lista roczników', 'k3e'),
        'items_list_navigation' => __('Lista roczników', 'k3e'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => false,
    );
    register_taxonomy('volume', array('species'), $args);
}

add_action('init', 'volume', 0);
