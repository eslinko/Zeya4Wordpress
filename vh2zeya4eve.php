<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://zeya888.com
 * @since             1.0.0
 * @package           Vh2zeya4eve
 *
 * @wordpress-plugin
 * Plugin Name:       VH2Zeya4Eve
 * Plugin URI:        https://zeya4eve.io
 * Description:       This is a description of the plugin.
 * Version:           1.0.0
 * Author:            Skoryk Dmytro
 * Author URI:        https://zeya888.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       vh2zeya4eve
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
define( 'VH2ZEYA4EVE_VERSION', '1.0.0' );
define( 'VH2ZEYA4EVE_TEXTDOMAIN', 'vh2zeya4eve' );
define( 'VH2ZEYA4EVE_ENVIRONMENT', 'DEV' ); // DEV, STAGING, PROD

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-vh2zeya4eve-activator.php
 */
function activate_vh2zeya4eve() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vh2zeya4eve-activator.php';
	Vh2zeya4eve_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-vh2zeya4eve-deactivator.php
 */
function deactivate_vh2zeya4eve() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vh2zeya4eve-deactivator.php';
	Vh2zeya4eve_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_vh2zeya4eve' );
register_deactivation_hook( __FILE__, 'deactivate_vh2zeya4eve' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-vh2zeya4eve.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_vh2zeya4eve() {

	$plugin = new Vh2zeya4eve();
	$plugin->run();

}
run_vh2zeya4eve();
