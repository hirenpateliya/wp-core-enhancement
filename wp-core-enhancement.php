<?php
/**
 * Plugin Name:       WP Core Enhancement
 * Plugin URI:        https://hirenpateliya.com
 * Description:       Enhance your WordPress dashboard with useful core enhancements and productivity features.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Hiren Pateliya
 * Author URI:        https://hirenpateliya.com
 * License:           GPL v2 or later
 * Text Domain:       wp-core-enhancement
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin Constants
 */
define( 'WPCE_VERSION', '1.0.0' );
define( 'WPCE_PLUGIN_FILE', __FILE__ );
define( 'WPCE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPCE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WPCE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * Load Core Loader
 */
require_once WPCE_PLUGIN_PATH . 'includes/class-wpce-loader.php';

/**
 * Initialize Plugin
 */
function wpce_init() {

	$wpce_loader = new WPCE_Loader();
	$wpce_loader->run();
}

add_action( 'plugins_loaded', 'wpce_init' );


register_activation_hook(
	__FILE__,
	'wpce_activate_plugin'
);

function wpce_activate_plugin() {

	set_transient(
		'wpce_activation_notice',
		true,
		30
	);
}