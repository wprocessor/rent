<?php

function rent_list_ajax_enqueue_styles() {
  wp_enqueue_script( 'current-script', wp_custom_path_to_url(get_stylesheet_directory_uri()) . '/property-list.js', ['jquery'], 1.1, true );
}

add_action( 'wp_enqueue_scripts', 'rent_list_ajax_enqueue_styles');

function rent_list_init_ajax_data() {
  $script_url = wp_custom_path_to_url( __FILE__ );

  wp_localize_script(
    'current-script',
    'property_ajax_data',
    [
      'url' => admin_url('admin-ajax.php'),
    ]
  );
}

add_action( 'wp_enqueue_scripts', 'rent_list_init_ajax_data', 99 );

function property_filter_action_callback() {
  $term_id = intval($_POST['term_id']);

  $query_options = [
    'post_type' => 'rent_object',
    'posts_per_page' => 5,
  ];

  if ($term_id) {
    $query_options['tax_query'] = [
      [
        'taxonomy' => 'rent_city',
        'field' => 'term_id',
        'terms' => [$term_id],
      ]
    ];
  }

  $items = "<div id='property-items-list' class='property-items-list'>";

  $query = new WP_Query($query_options);
  while ($query->have_posts()) {
    $post = $query->next_post();
    $link =  get_permalink($post);
    $titleAttr = the_title_attribute([
      'echo' => FALSE,
      'post' => $post,
    ]);

    $title = '<h2 class="entry-title"><a href="' . $link . '" title="' . $titleAttr . '" rel="bookmark">' . get_the_title($post) . '</a></h2>';
    $content = get_the_content( null, false, $post );
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );
    $items .= "<div class='property-items-list-item'>" . $title . "<div class='entry-content'>" . $content . "</div></div>";
  }

  $items .= "</div>";
  
  $return = [
    'items' => $items,
  ];

  wp_send_json($return);
}

add_action('wp_ajax_property_filter_action', 'property_filter_action_callback');
add_action('wp_ajax_nopriv_property_filter_action', 'property_filter_action_callback');
