<?php

// Register Custom Post Type
function photo_album() {

    $labels = array(
        'name' => _x('Albumy zdjęć', 'Post Type General Name', 'k3e'),
        'singular_name' => _x('Album Zdjęć', 'Post Type Singular Name', 'k3e'),
        'menu_name' => __('Post Types', 'k3e'),
        'name_admin_bar' => __('Post Type', 'k3e'),
        'archives' => __('Item Archives', 'k3e'),
        'attributes' => __('Item Attributes', 'k3e'),
        'parent_item_colon' => __('Parent Item:', 'k3e'),
        'all_items' => __('All Items', 'k3e'),
        'add_new_item' => __('Add New Item', 'k3e'),
        'add_new' => __('Add New', 'k3e'),
        'new_item' => __('New Item', 'k3e'),
        'edit_item' => __('Edit Item', 'k3e'),
        'update_item' => __('Update Item', 'k3e'),
        'view_item' => __('View Item', 'k3e'),
        'view_items' => __('View Items', 'k3e'),
        'search_items' => __('Search Item', 'k3e'),
        'not_found' => __('Not found', 'k3e'),
        'not_found_in_trash' => __('Not found in Trash', 'k3e'),
        'featured_image' => __('Featured Image', 'k3e'),
        'set_featured_image' => __('Set featured image', 'k3e'),
        'remove_featured_image' => __('Remove featured image', 'k3e'),
        'use_featured_image' => __('Use as featured image', 'k3e'),
        'insert_into_item' => __('Insert into item', 'k3e'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'k3e'),
        'items_list' => __('Items list', 'k3e'),
        'items_list_navigation' => __('Items list navigation', 'k3e'),
        'filter_items_list' => __('Filter items list', 'k3e'),
    );
    $args = array(
        'label' => __('Album Zdjęć', 'k3e'),
        'description' => __('Album zdjęć', 'k3e'),
        'labels' => $labels,
        'supports' => array('title', 'editor'),
        'hierarchical' => false,
        'public' => false,
        'show_ui' => false,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => false,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'rewrite' => false,
        'capability_type' => 'post',
        'show_in_rest' => true,
    );
    register_post_type('photo_album', $args);
}

add_action('init', 'photo_album', 0);
