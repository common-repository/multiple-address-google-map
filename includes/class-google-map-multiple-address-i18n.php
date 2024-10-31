<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://aliashiquemohammad.com
 * @since      1.0.0
 *
 * @package    Google_Map_Multiple_Address
 * @subpackage Google_Map_Multiple_Address/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Google_Map_Multiple_Address
 * @subpackage Google_Map_Multiple_Address/includes
 * @author     Mohammad Ashique Ali <aliashiquemohammad@gmail.com>
 */
class Google_Map_Multiple_Address_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'google-map-multiple-address',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
