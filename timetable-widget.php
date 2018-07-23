<?php
/**
 * The Timetable widget that can be configured in Appearance/Widgets
 *
 * @since 0.0.1
 */

/**
 * Load the timetable widget.
 */
function timetable_setup_widgets() {
    register_widget( 'timetable_widget' );
}
add_action( 'widgets_init', 'timetable_setup_widgets' );

/**
 * Include timetable stylesheet
 *
 * @since 1.0.0
*/
function timetable_styles() {
  $css = plugins_url( 'assets/css/timetable.css', __FILE__ );
  wp_register_style(
    'timetable-styles',
    $css,
    false,
    '0.0.1'
  );
  wp_enqueue_style( 'timetable-styles' );
}

add_action( 'wp_enqueue_scripts', 'timetable_styles' );


/*
 * Timetable
 */
class timetable_widget extends WP_Widget {

  function __construct() {
    parent::__construct (

      // Base ID of your widget
      'timetable_widget',

      // Widget name will appear in UI
      __('Timetable Widget', 'timetable_widget_domain'),

      // Widget description
      array( 'description' => __( 'Display a custom timetable.', 'timetable_widget_domain' ), )
    );
  }

  // Creating widget front-end
  public function widget( $args, $instance ) {
    // Load saved plugin data
    $options = get_option( 'timetable_settings' );
    $headings = $options['timetable_text_field_headers_1'];
    $second_headings = $options['timetable_text_field_headers_2'];
    $events = $options['timetable_textarea_field_times'];

    $headings = explode(",", $headings);
    $second_headings = explode(",", $second_headings);
    $events = explode("\n", $events);
    $times = array();

    foreach($events as $event_row) {
        $row = explode(",", $event_row);
        $time = array_shift($row); // Remove the time
        $event_row_enriched = [];
        for($e = 0; $e < count($row); $e++) {
            $event = explode(":", $row[$e]);

            $event_row_enriched[$e] = Array(
                "colour" => $event[0],
                "text" => $event[1]
            );
        }
        $times[$time] = $event_row_enriched;
    }

    // before and after widget arguments are defined by themes
    echo $args['before_widget'];
    require_once( plugin_dir_path( __FILE__ ) . 'timetable-widget.html.php' );
    echo $args['after_widget'];
  }

  // Widget Backend
  public function form( $instance ) {
    // Widget admin form
    ?>
      <p>Configure the timetable in <a href="<?= get_admin_url() ?>admin.php?page=timetable_options">Timetable/Settings</a></p>
    <?php
  }

} // Class timetable_widget ends here
