<?php

require_once ( dirname(__FILE__) . '/property.php' );
require_once ( dirname(__FILE__) . '/property-list.php' );
require_once ( dirname(__FILE__) . '/property-list-ajax.php' );

/**
 * Appends exists parent styles to re-use it.
 */
function rent_enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
   wp_enqueue_style( 'current-style', wp_custom_path_to_url(get_stylesheet_directory_uri()) . '/style.css' );
   wp_dequeue_style('twentynineteen-style');
}

add_action( 'wp_enqueue_scripts', 'rent_enqueue_parent_styles', 99 );


