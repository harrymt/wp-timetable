<?php
/**
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * and registers the activation and deactivation functions.
 *
 * @link              http://github.com/harrymt
 * @author            Harry Mumford-Turner
 * @version           1.0.0
 * @package           wp-timetable
 *
 * @wordpress-plugin
 * Plugin Name:       Timetable Plugin
 * Plugin URI:        https://github.com/harrymt/wp-timetable
 * Description:       Create and control a timetable.
 * Version:           0.0.1
 * Author:            Harry Mumford-Turner
 * Author URI:        https://www.harrymt.com
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       timetable-wp
*/



/**
 * If we're not being loaded by WordPress, abort now
 */
if ( !defined( 'WPINC' ) ) { die; }



/**
 * Load the Timetable Plugin foundation
 *
 * @since 1.0.0
 */
require_once( 'timetable-wp-foundation.php' );


/**
 * Load the Timetable Widget
 *
 * @since 1.0.0
 */
require_once( 'timetable-wp-widget.php' );


/**
 * Define a short description to display in the plugin's admin Page
 *
 * @since 1.0.0
 * @return string
 */
function timetable_wp_description() {
    return __("Change the settings to configure the timetable.", "timetable-wp");
}

/**
 * Define a short description to display in the plugin's admin Page
 *
 * @since 1.0.0
 * @return string
 */
function timetable_wp_options_title() {
    return __("Settings");
}



/**
 * Load the relevant scripts dependant on if the plugin is being loaded on the
 * frontend or the backend
 *
 * @since 1.0.0
 */
if( is_admin() ) {
    require_once( plugin_dir_path(__FILE__) . 'admin/timetable-wp-admin.php' );
} else {
    require_once( plugin_dir_path(__FILE__) . 'public/timetable-wp-public.php' );
}



/**
 * Do something when the plugin is activated from within WordPress
 * - Generally used to set up a new CPT and flush permalinks
 *
 * @since 1.0.0
 */
function timetable_wp_activation() {
    // flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'timetable_wp_activation' );



/**
 * Do something when the plugin is de-activated from within WordPress
 * - Generally used to remove a previously set up CPT and flush permalinks
 *
 * @since 1.0.0
 */
function timetable_wp_deactivation() {
    // flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'timetable_wp_deactivation' );



/**
 * Do something when the plugin is uninstalled from within WordPress
 *
 * @since 1.0.0
 */
function timetable_wp_uninstall() {
    //
}

register_uninstall_hook( __FILE__, 'timetable_wp_uninstall' );
