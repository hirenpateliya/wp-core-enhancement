<?php
/**
 * Uninstall WP Core Enhancement
 *
 * @package WPCoreEnhancement
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Delete plugin options.
delete_option( 'wpce_plugin_version' );