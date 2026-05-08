<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_Assets {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );
	}

	/**
	 * Load Admin Assets
	 *
	 * @return void
	 */
	public function admin_assets() {

		wp_enqueue_style(
			'wpce-admin-style',
			WPCE_PLUGIN_URL . 'assets/css/admin.css',
			array(),
			WPCE_VERSION
		);

		wp_enqueue_script(
			'wpce-admin-script',
			WPCE_PLUGIN_URL . 'assets/js/admin.js',
			array( 'jquery' ),
			WPCE_VERSION,
			true
		);
	}
}