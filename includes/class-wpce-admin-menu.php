<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_Admin_Menu {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
	}

	/**
	 * Register Admin Menu
	 *
	 * @return void
	 */
	public function register_admin_menu() {

		add_menu_page(
			__( 'WP Core Enhancement', 'wp-core-enhancement' ),
			__( 'WP Enhancement', 'wp-core-enhancement' ),
			'manage_options',
			'wp-core-enhancement',
			array( $this, 'dashboard_page' ),
			'dashicons-admin-tools',
			80
		);
	}

	/**
	 * Dashboard Page
	 *
	 * @return void
	 */
	public function dashboard_page() {

		require_once WPCE_PLUGIN_PATH . 'templates/admin-dashboard.php';
	}
}