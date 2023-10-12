<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://zeya888.com
 * @since      1.0.0
 *
 * @package    Vh2zeya4eve
 * @subpackage Vh2zeya4eve/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Vh2zeya4eve
 * @subpackage Vh2zeya4eve/includes
 * @author     Skoryk Dmytro <skorikdeveloper@gmail.com>
 */
class Vh2zeya4eve_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'vh2zeya4eve',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
