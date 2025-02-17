<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              blog.unreleasedme.com
 * @since             1.0.0
 * @package           Slider_Spider
 *
 * @wordpress-plugin
 * Plugin Name:       Slider Spider
 * Plugin URI:        127.o.o.1
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            unreleased01
 * Author URI:        blog.unreleasedme.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       slider-spider
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
define( 'slider-spider', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-slider-spider-activator.php
 */
function activate_slider_spider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-slider-spider-activator.php';
	Slider_Spider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-slider-spider-deactivator.php
 */
function deactivate_slider_spider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-slider-spider-deactivator.php';
	Slider_Spider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_slider_spider' );
register_deactivation_hook( __FILE__, 'deactivate_slider_spider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-slider-spider.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_slider_spider() {

	$plugin = new Slider_Spider();
	$plugin->run();

}
run_slider_spider();
