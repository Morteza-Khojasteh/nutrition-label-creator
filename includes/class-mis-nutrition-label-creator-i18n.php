<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       makeitso.digital
 * @since      1.0.0
 *
 * @package    Mis_Nutrition_Label_Creator
 * @subpackage Mis_Nutrition_Label_Creator/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mis_Nutrition_Label_Creator
 * @subpackage Mis_Nutrition_Label_Creator/includes
 * @author     Make It So <sushama@makeitso.digital>
 */
class Mis_Nutrition_Label_Creator_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mis-nutrition-label-creator',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
