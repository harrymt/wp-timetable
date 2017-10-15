<?php
/**
 * This file should contain all of your functions that you need to fire off when in
 * the WordPress back-end. Please ensure you remember to sanitize your variables if
 * handling $_POST or $_GET data.
 * @see https://developer.wordpress.org/plugins/security/data-validation/
 * @see https://developer.wordpress.org/plugins/security/securing-input/
 */


/**
 * Set up permissions for Administrators and Editors to access the configuration Page
 * of this plugin
 *
 * @since 1.0.0
 */
function timetable_wp_add_caps() {

    $role = get_role('administrator');
    $role->add_cap('timetable_wp_config');

    $role = get_role('editor');
    $role->add_cap('timetable_wp_config');
}

add_action( 'admin_init', 'timetable_wp_add_caps' );



/**
 * Add a sub menu page underneath the existing Timetable Plugins Page
 *
 * @since 1.0.0
 */
function timetable_wp_options_page() {

    add_submenu_page(
        'timetable-wp-plugin',        // $parent_slug
        'Timetable Plugin',           // $page_title
        timetable_wp_options_title(), // $menu_title
        'timetable_wp_config',        // $capability
        'timetable_wp_options',       // $menu_slug
        'timetable_wp_options_html'        // $callback
    );

}

add_action( 'admin_menu', 'timetable_wp_options_page' );


/**
 * Outputs information on the 'Timetable Plugin' Page in WordPress Admin
 *
 * @since 1.0.0
 */
function timetable_wp_options_html() {
    require_once( plugin_dir_path( __FILE__ ) . 'timetable-wp-options.php' );
}


// $headings = array(
//   "Tutor",
//   "Mr A",
//   "Mrs B"
// );

// $second_headings = array(
//   "Room",
//   "Location 1",
//   "Location 2"
// );


// $times = array(
//   '0900' => array(
//     "red" => "Chamber Orchestra",
//     "pink" => "COSYJO"
//   ),
//   '0915' => array(
//     "red" => "Chamber Orchestra",
//     "pink" => "COSYJO"
//   ),
//   '0930' => array(
//     "green" => "Intermediate Strings",
//     "pink" => "COSYJO"
//   ),
//   '0945' => array(
//     "" => "",
//     "pink" => "COSYJO"
//   )
// );

function timetable_wp_settings_init() {
    register_setting( 'pluginPage', 'timetable_wp_settings' );

    // Section Header and callback Description
    add_settings_section(
        'timetable_wp_pluginPage_section',
        __( 'Configure Timetable', 'timetable_wp_widget_domain' ),
        'timetable_wp_settings_section_callback',
        'pluginPage'
    );

    // Header 1
    add_settings_field(
        'timetable_wp_text_field_headers',
        __( 'Heading Labels comma separated', 'timetable_wp_widget_domain' ),
        'timetable_wp_text_field_headers_render',
        'pluginPage',
        'timetable_wp_pluginPage_section'
    );

    // Header 2
    add_settings_field(
        'timetable_wp_text_field_headers_2',
        __( 'Heading Labels comma separated', 'timetable_wp_widget_domain' ),
        'timetable_wp_text_field_headers_2_render',
        'pluginPage',
        'timetable_wp_pluginPage_section'
    );

    // Times
    add_settings_field(
        'timetable_wp_textarea_field_times',
        __( 'Each event separated by new line, e.g. <pre>Time,Color:Name,Color:Name,Color:Name</pre>', 'timetable_wp_widget_domain' ),
        'timetable_wp_textarea_field_times_render',
        'pluginPage',
        'timetable_wp_pluginPage_section'
    );
}
add_action( 'admin_init', 'timetable_wp_settings_init' );


function timetable_wp_text_field_headers_render() {
    $options = get_option( 'timetable_wp_settings' );
    $value = $options['timetable_wp_text_field_headers'];
    ?>
    <input type='text' name='timetable_wp_settings[timetable_wp_text_field_headers]' value='<?= $value ?>'>
    <?php
}


function timetable_wp_text_field_headers_2_render() {
    $options = get_option( 'timetable_wp_settings' );
    $value = $options['timetable_wp_text_field_headers_2'];
    ?>
    <input type='text' name='timetable_wp_settings[timetable_wp_text_field_headers_2]' value='<?= $value ?>'>
    <?php
}


function timetable_wp_textarea_field_times_render() {

    $options = get_option( 'timetable_wp_settings' );
    ?>
    <textarea cols='80' rows='10' name='timetable_wp_settings[timetable_wp_textarea_field_times]'><?= $options['timetable_wp_textarea_field_times']; ?></textarea>
    <?php

}



function timetable_wp_settings_section_callback() {
    echo __( 'Enter your timetable details here.', 'timetable_wp_widget_domain' );
}


?>

