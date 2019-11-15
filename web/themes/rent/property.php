<?php

/**
 * Creates new city taxonomy type.
 */
function property_rent_city_init() {
  $taxonomy_type = 'rent_city';
  $related_object_types = [
    'rent_object',
  ];
  $labels = [
    'name' => __('Cities'),
    'singular_name' => __('City'),
    'search_items' => __('Search Cities'),
    'all_items' => __('All Cities'),
    'view_item' => __('View City'),
    'edit_item' => __('Edit City'),
    'update_item' => __('Update City'),
    'add_new_item' => __('Add New City'),
    'menu_name' => __('Cities'),
  ];
  $taxonomy_type_options = [
    'label' => __('Cities'),
    'labels' => $labels,
    'description' => __("Allowed city list for type `rent_object`."),
    'public' => TRUE,
    'publicly_queryable' => TRUE,
    'show_ui' => TRUE,
    'show_in_menu' => TRUE,
    'show_in_nav_menus' => TRUE,
  ];

  register_taxonomy(
    $taxonomy_type,
    $related_object_types,
    $taxonomy_type_options
  );
}

add_action( 'init', 'property_rent_city_init' );

/**
 * Creates new rent object type.
 */
function property_rent_object_init() {
  $post_type = 'rent_object';
  $labels = [
    'name' => __('Rent Objects'),
    'singular_name' => __('Rent Object'),
    'search_items' => __('Search Rent Objects'),
    'all_items' => __('All Rent Objects'),
    'view_item' => __('View Rent Object'),
    'edit_item' => __('Edit Rent Object'),
    'update_item' => __('Update Rent Object'),
    'add_new_item' => __('Add New Rent Object'),
    'new_item' => __('New Rent Object'),
    'menu_name' => __('Rent'),
  ];
  $supports = [
    'title',
    'editor',
    'author',
    'thumbnail',
    'revisions',
    'custom-fields',
  ];
  $taxonomies = [
    'rent_city',
  ];
  $post_type_options = [
    'label' => __('Rent Object'),
    'labels' => $labels,
    'description' => __('Rent object to save and manage property.'),
    'public' => TRUE,
    'publicly_queryable'=> TRUE,
    'show_ui' => TRUE,
    'show_in_menu' => TRUE,
    'show_in_nav_menus' => TRUE,
    'show_in_admin_bar' => TRUE,
    'can_export' => TRUE,
    'exclude_from_search' => FALSE,
    'capability_type' => 'page',
    'supports' => $supports,
    'taxonomies' => $taxonomies,
  ];

  register_post_type($post_type, $post_type_options);
}

add_action( 'init', 'property_rent_object_init' );
