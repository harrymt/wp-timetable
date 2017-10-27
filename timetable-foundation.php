<?php
/**
 * Timetable WordPress Plugin Foundation
 * - Sets the defaults permissions for Admin & Editor
 * - Adds a Page into WordPress Admin sidebar
 * - Enqueues Timetable plugin stylesheet (sidebar icon)
 *
 * @author      Harry Mumford-Turner
 * @version     0.0.1
 *
 */



/**
 * If we're not being loaded by WordPress, abort now
 */
if ( !defined( 'WPINC' ) ) { die; }



/**
 * Set 'Administrator' and 'Editor' roles to have access to Plugin config by default
 *
 * @since 1.0.0
 */
function timetable_plugin_add_caps() {

    $role = get_role('administrator');
    $role->add_cap('timetable_plugin');

    $role = get_role('editor');
    $role->add_cap('timetable_plugin');

}

add_action('admin_init', 'timetable_plugin_add_caps');



/**
 * Check to make sure that another plugin has not already registered the plugin
 * splash page. If it does not exist, add a top level Page into the WordPress admin
 * sidebar
 *
 * @var $page_title  string  This is the heading for the page.
 * @var $menu_title  string  This is the title that will appear in the menu.
 * @var $capability  string  Only users with this capability can see this menu page.
 * @var $menu_slug   string  Unique slug to refer to this menu page.
 * @var $callback    string  Name of the function called to render the menu page.
 * @var $icon_url    string  Icon file that is rendered in the menu for this menu page.
 * @var $position    string  This is the position of the menu in the menu hierarchy.
 *
 * @since 1.0.0
 */
if ( empty( $GLOBALS['admin_page_hooks']['timetable-plugin'] ) ) {
    if ( !function_exists( 'timetable_plugin_options_page' ) ) {
        function timetable_plugin_options_page() {
            add_menu_page(
                'Timetable Plugin',     // $page_title
                'Timetable',            // $menu_title
                'timetable_plugin',  // $capability
                'timetable-plugin',  // $menu_slug
                'timetable_splash',  // $callback
                'dashicons-timetable',  // $icon
                '10'                    // $position
            );
        }

        add_action( 'admin_menu', 'timetable_plugin_options_page' );
    }
}


/**
 * Outputs information on the timetable Plugin Landing Page in WordPress Admin
 *
 * @since 1.0.0
 */
function timetable_splash() {
    require_once( plugin_dir_path( __FILE__ ) . 'admin/' . 'timetable-splash.php' );
}



/**
 * Include admin stylesheet
 *
 * @since 1.0.0
 */
function timetable_menu_styles() {
    $css = plugins_url( 'assets/css/timetable.css', __FILE__ );
    wp_register_style(
        'timetable-timetable-styles',
        $css,
        false,
        '1.0.0'
    );
    wp_enqueue_style( 'timetable-timetable-styles' );
}

add_action( 'admin_enqueue_scripts', 'timetable_menu_styles' );
