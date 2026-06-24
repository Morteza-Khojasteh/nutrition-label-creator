<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              makeitso.digital
 * @since             1.0.0
 * @package           Mis_Nutrition_Label_Creator
 *
 * @wordpress-plugin
 * Plugin Name:       Mis Nutrition Label Creator
 * Plugin URI:        makeitso.digital
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Make It So
 * Author URI:        makeitso.digital
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mis-nutrition-label-creator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MIS_NUTRITION_LABEL_CREATOR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mis-nutrition-label-creator-activator.php
 */
function activate_mis_nutrition_label_creator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mis-nutrition-label-creator-activator.php';
	Mis_Nutrition_Label_Creator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mis-nutrition-label-creator-deactivator.php
 */
function deactivate_mis_nutrition_label_creator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mis-nutrition-label-creator-deactivator.php';
	Mis_Nutrition_Label_Creator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mis_nutrition_label_creator' );
register_deactivation_hook( __FILE__, 'deactivate_mis_nutrition_label_creator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mis-nutrition-label-creator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mis_nutrition_label_creator() {

	$plugin = new Mis_Nutrition_Label_Creator();
	$plugin->run();

}
run_mis_nutrition_label_creator();
