<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://192.168.0.28
 * @since             1.0.0
 * @package           And_everywhere_recipes
 *
 * @wordpress-plugin
 * Plugin Name:       and Everywhere Recipes
 * Plugin URI:        https://and_everywhere_recipes
 * Description:       Wordpress best create recipe plugin
 * Version:           1.0.0
 * Author:            Ronak
 * Author URI:        https://192.168.0.28
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       and_everywhere_recipes
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
define( 'AND_EVERYWHERE_RECIPES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-and_everywhere_recipes-activator.php
 */
function activate_and_everywhere_recipes() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-and_everywhere_recipes-activator.php';
	And_everywhere_recipes_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-and_everywhere_recipes-deactivator.php
 */
function deactivate_and_everywhere_recipes() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-and_everywhere_recipes-deactivator.php';
	And_everywhere_recipes_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_and_everywhere_recipes' );
register_deactivation_hook( __FILE__, 'deactivate_and_everywhere_recipes' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-and_everywhere_recipes.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_and_everywhere_recipes() {

	$plugin = new And_everywhere_recipes();
	$plugin->run();

}
run_and_everywhere_recipes();
