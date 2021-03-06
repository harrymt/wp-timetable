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
function timetable_add_caps() {
    $role = get_role('administrator');
    $role->add_cap('timetable_config');

    $role = get_role('editor');
    $role->add_cap('timetable_config');
}

add_action( 'admin_init', 'timetable_add_caps' );


/**
 * Outputs information on the 'Timetable Plugin' Page in WordPress Admin
 *
 * @since 1.0.0
 */
function timetable_options_html() {
    require_once( plugin_dir_path( __FILE__ ) . 'timetable-options.php' );
}

function timetable_settings_init() {
    register_setting( 'pluginPage', 'timetable_settings' );

    // Section Header and callback Description
    add_settings_section(
        'timetable_pluginPage_section',
        __( 'Configure Timetable', 'timetable_widget_domain' ),
        'timetable_settings_section_callback',
        'pluginPage'
    );

    // Header 1
    add_settings_field(
        'timetable_text_field_headers_1',
        __( 'Heading 1 Labels (comma separated)', 'timetable_widget_domain' ),
        'timetable_text_field_headers_1_render',
        'pluginPage',
        'timetable_pluginPage_section'
    );

    // Header 2
    add_settings_field(
        'timetable_text_field_headers_2',
        __( 'Heading 2 Labels (comma separated)', 'timetable_widget_domain' ),
        'timetable_text_field_headers_2_render',
        'pluginPage',
        'timetable_pluginPage_section'
    );

    // Times
    add_settings_field(
        'timetable_textarea_field_times',
        __( 'Timetable, each event separated by new line, e.g. <pre>Time,Color:Name,Color:Name,Color:Name</pre>', 'timetable_widget_domain' ),
        'timetable_textarea_field_times_render',
        'pluginPage',
        'timetable_pluginPage_section'
    );
}
add_action( 'admin_init', 'timetable_settings_init' );


function timetable_text_field_headers_1_render() {
    $options = get_option( 'timetable_settings' );
    $value = $options['timetable_text_field_headers_1'];
    ?>
    <textarea cols='100' rows='2' type='text' name='timetable_settings[timetable_text_field_headers_1]'><?= $value ?></textarea>
    <?php
}


function timetable_text_field_headers_2_render() {
    $options = get_option( 'timetable_settings' );
    $value = $options['timetable_text_field_headers_2'];
    ?>
    <textarea cols='100' rows='2' type='text' name='timetable_settings[timetable_text_field_headers_2]'><?= $value ?></textarea>
    <?php
}


function timetable_textarea_field_times_render() {

    $options = get_option( 'timetable_settings' );
    $value = $options['timetable_textarea_field_times'];
    ?>
    <textarea cols='100' rows='20' name='timetable_settings[timetable_textarea_field_times]'><?= $value; ?></textarea>
    <?php

}


function timetable_settings_section_callback() {
    ?>
    <p>Enter your timetable details here.</p>
    <a class="js-show-csv-data" href="">(show code behind)</a>
    <?php
}

?>
