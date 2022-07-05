<?php

// Register Custom Post Type
function species() {

	$labels = array(
		'name'                  => _x( 'Okazy', 'Post Type General Name', 'k3e' ),
		'singular_name'         => _x( 'Okaz', 'Post Type Singular Name', 'k3e' ),
		'menu_name'             => __( 'Okazy', 'k3e' ),
		'name_admin_bar'        => __( 'Okazy', 'k3e' ),
		'archives'              => __( 'Archiwum okazów', 'k3e' ),
		'attributes'            => __( 'Atrybuty okazu', 'k3e' ),
		'parent_item_colon'     => __( 'Okaz nadrzędny:', 'k3e' ),
		'all_items'             => __( 'Wszystkie okazy', 'k3e' ),
		'add_new_item'          => __( 'Dodaj nowy okaz', 'k3e' ),
		'add_new'               => __( 'Dodaj nowy', 'k3e' ),
		'new_item'              => __( 'Nowy okaz', 'k3e' ),
		'edit_item'             => __( 'Edytuj okaz', 'k3e' ),
		'update_item'           => __( 'Aktualizuj okaz', 'k3e' ),
		'view_item'             => __( 'Zobacz okaz', 'k3e' ),
		'view_items'            => __( 'Zabacz okazy', 'k3e' ),
		'search_items'          => __( 'Szukaj okazu', 'k3e' ),
		'not_found'             => __( 'Brak okazów', 'k3e' ),
		'not_found_in_trash'    => __( 'Brak w koszu', 'k3e' ),
		'featured_image'        => __( 'Obrazek powiązany', 'k3e' ),
		'set_featured_image'    => __( 'Ustaw obrazek powiązany', 'k3e' ),
		'remove_featured_image' => __( 'Usuń obrazek powiązany', 'k3e' ),
		'use_featured_image'    => __( 'Uzyj jako obrazek powiązany', 'k3e' ),
		'insert_into_item'      => __( 'Wstaw do okazu', 'k3e' ),
		'uploaded_to_this_item' => __( 'Wgrano do tego okazu', 'k3e' ),
		'items_list'            => __( 'Lista okazów', 'k3e' ),
		'items_list_navigation' => __( 'Nawigacja listy okazów', 'k3e' ),
		'filter_items_list'     => __( 'Filtruj okazy na liście', 'k3e' ),
	);
	$args = array(
		'label'                 => __( 'Okazy', 'k3e' ),
		'description'           => __( 'Wpisy zawierający informacje na temat okazu', 'k3e' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'taxonomies'            => array( 'groups', 'provider', 'volume' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-clipboard',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'rewrite'               => false,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
	);
	register_post_type( 'species', $args );

}
add_action( 'init', 'species', 0 );

