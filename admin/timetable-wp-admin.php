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
        'timetable_wp_options'        // $callback
    );

}

add_action( 'admin_menu', 'timetable_wp_options_page' );



/**
 * Outputs information on the 'Timetable Plugin' Page in WordPress Admin
 *
 * @since 1.0.0
 */
function timetable_wp_options() {
    require_once( plugin_dir_path( __FILE__ ) . 'timetable-wp-options.php' );
}
