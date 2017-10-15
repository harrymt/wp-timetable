<?php
/**
 * The Timetable widget that can be configured in Appearance/Widgets
 *
 * @since 0.0.1
 */

/**
 * Load the timetable widget.
 */
function wp_load_widgets() {
    register_widget( 'wp_timetable_widget' );
}
add_action( 'widgets_init', 'wp_load_widgets' );

/*
 * Timetable
 */
class wp_timetable_widget extends WP_Widget {

  function __construct() {
    parent::__construct (

      // Base ID of your widget
      'wp_timetable_widget',

      // Widget name will appear in UI
      __('Timetable Widget', 'timetable_wp_widget_domain'),

      // Widget description
      array( 'description' => __( 'Display a custom timetable.', 'timetable_wp_widget_domain' ), )
    );
  }

  // Creating widget front-end
  public function widget( $args, $instance ) {
    $number = 1;
    if(!empty($instance['number'])) {
      $number = $instance['number'];
    }

    // before and after widget arguments are defined by themes
    echo $args['before_widget'];
    echo __("The number is ($number)");
    echo $args['after_widget'];
  }

  // Widget Backend
  public function form( $instance ) {
    if ( isset( $instance[ 'number' ] ) ) {
      $number = $instance[ 'number' ];
    } else {
      $number = 1;
    }
    // Widget admin form
    ?>
      <p>
        <label for="<?php echo $this->get_field_id( 'number' ); ?>">
          <?php _e( 'Number of ...:' ); ?>
        </label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
      </p>
    <?php
  }

  // Updating widget replacing old instances with new
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
    return $instance;
  }
} // Class wp_timetable_widget ends here
