<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://192.168.0.28
 * @since      1.0.0
 *
 * @package    And_everywhere_recipes
 * @subpackage And_everywhere_recipes/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    And_everywhere_recipes
 * @subpackage And_everywhere_recipes/includes
 * @author     Ronak <ronak.lodhari@iflair.com>
 */
class And_everywhere_recipes_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'and_everywhere_recipes',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
