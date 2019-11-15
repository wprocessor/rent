<?php

class WidgetPropertyList extends WP_Widget {

  /**
   * {@inheritdoc}
   */
  function __construct() {
    $id_base = 'property_list';
    $name = __('Property list');
    $widget_options = [
      'classname' => 'property-list',
      'description' => __('Shows property items'),
    ];
    $control_options = [];

    parent::__construct($id_base, $name, $widget_options, $control_options);
  }

  /**
   * {@inheritdoc}
   */
  public function widget( $args, $instance ) {
    $title = isset($instance['title']) ? apply_filters( 'widget_title', $instance['title'] ) : NULL;

    echo $args['before_widget'];

    if ( ! empty( $title ) ) {
      echo $args['before_title'];
      echo $title;
      echo $args['after_title'];
    }

    $this->propertyCities();
    $this->propertyList();

    echo $args['after_widget'];
  }

  /**
   * {@inheritdoc}
   */
  public function form( $instance ) {
    $title = $instance[ 'title' ] ?? esc_html__( 'New title' );
    $field_title_id = esc_attr($this->get_field_id( 'title' ));
    $field_title_name = esc_attr($this->get_field_id( 'name' ));
    $field_title_label = esc_attr_e( 'Title:' );
    $field_title_value = esc_attr($title);

?>

<p>
  <label for="<?php echo $field_title_id; ?>">
    <?php echo $field_title_label; ?>
  </label>
  <input
    type="text"
    class="widefat"
    id="<?php echo $field_title_id; ?>"
    name="<?php echo $field_title_name; ?>"
    value="<?php echo $field_title_value; ?>"
  />
</p>

<?php

  }

  /**
   * {@inheritdoc}
   */
	public function update( $new_instance, $old_instance ) {
    $instance = [];
    
    if (!empty($new_instance['title'])) {
      $instance['title'] = strip_tags($new_instance['title']);
    }

		return $instance;
	}

  protected function propertyCities() {
    $args = [
      'taxonomy' => 'rent_city',
      'hide_empty' => TRUE,
    ];

    $taxonomy_items = get_terms($args);

?>

<div class="property-items">

  <a
    class="property-city-item"
    data-term-id="0"
    href="#"
    ><?php echo __('All'); ?></a>
<?php
    
    foreach ($taxonomy_items as $next_item):

      $term_id = $next_item->term_id;
      $term_name = $next_item->name;
      $term_link = get_term_link($next_item);
?>

<a
  class="property-city-item"
  data-term-id="<?php echo $term_id; ?>"
  href="<?php echo $term_link; ?>">
    <?php echo $term_name; ?>
</a>

<?php

    endforeach;

?>

</div>

<?php
    
  }

    protected function propertyList() {
    $query_options = [
      'post_type' => 'rent_object',
      'posts_per_page' => 5,
    ];

    $query = new WP_Query($query_options);

?>

<div id="property-items-list" class="property-items-list">

<?php

    while ($query->have_posts()):

?>

<div class="property-items-list-item">

<?php
      
      $query->the_post();
      $link = get_permalink();
      $title = the_title_attribute( 'echo=0' );
      the_title( '<h2 class="entry-title"><a href="' . $link . '" title="' . $title . '" rel="bookmark">', '</a></h2>' );
?>

  <div class="entry-content">

    <?php the_content(); ?>

  </div>
</div>

<?php

    endwhile;

?>

</div>

<?php

  }
}

/**
 * Register and load property widget.
 */
function property_property_list_widget_init() {
  register_widget( 'WidgetPropertyList' );
}

add_action( 'widgets_init', 'property_property_list_widget_init' );
