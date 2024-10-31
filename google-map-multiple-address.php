<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://aliashiquemohammad.com
 * @since             1.2
 * @package           Google_Map_Multiple_Address
 *
 * @wordpress-plugin
 * Plugin Name:       Google Map with Multiple Address
 * Plugin URI:        https://aliashiquemohammad.com/plugins
 * Description:       This plugin is used for displaying multiple address in a map with a marker and other useful stuffs. 
 * Version:           1.2
 * Author:            Mohammad Ashique Ali
 * Author URI:        https://aliashiquemohammad.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       google-map-multiple-address
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-google-map-multiple-address-activator.php
 */
function activate_google_map_multiple_address() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-google-map-multiple-address-activator.php';
	Google_Map_Multiple_Address_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-google-map-multiple-address-deactivator.php
 */
function deactivate_google_map_multiple_address() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-google-map-multiple-address-deactivator.php';
	Google_Map_Multiple_Address_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_google_map_multiple_address' );
register_deactivation_hook( __FILE__, 'deactivate_google_map_multiple_address' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-google-map-multiple-address.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_google_map_multiple_address() {

	$plugin = new Google_Map_Multiple_Address();
	$plugin->run();

}
run_google_map_multiple_address();
