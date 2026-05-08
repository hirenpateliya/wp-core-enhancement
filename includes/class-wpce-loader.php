<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_Loader {

	/**
	 * Run Plugin
	 *
	 * @return void
	 */
	public function run() {

		$this->includes();
		$this->init_classes();
	}

	/**
	 * Load Required Files
	 *
	 * @return void
	 */
	private function includes() {

		/**
		 * Core Includes
		 */
		require_once WPCE_PLUGIN_PATH . 'includes/helper-functions.php';
		require_once WPCE_PLUGIN_PATH . 'includes/class-wpce-assets.php';
		require_once WPCE_PLUGIN_PATH . 'includes/class-wpce-admin-menu.php';
		require_once WPCE_PLUGIN_PATH . 'includes/class-wpce-settings.php';
		require_once WPCE_PLUGIN_PATH . 'includes/class-wpce-security.php';
		require_once WPCE_PLUGIN_PATH . 'includes/class-wpce-admin-notices.php';
		require_once WPCE_PLUGIN_PATH . 'includes/class-wpce-performance.php';
		require_once WPCE_PLUGIN_PATH . 'includes/class-wpce-rest-security.php';
		require_once WPCE_PLUGIN_PATH . 'includes/class-wpce-auto-update.php';

		/**
		 * Modules
		 */
		require_once WPCE_PLUGIN_PATH . 'modules/disable-gutenberg/class-disable-gutenberg.php';
		require_once WPCE_PLUGIN_PATH . 'modules/svg-upload/class-svg-upload.php';
		require_once WPCE_PLUGIN_PATH . 'modules/duplicate-post/class-duplicate-post.php';
		require_once WPCE_PLUGIN_PATH . 'modules/disable-image-duplicates/class-disable-image-duplicates.php';
		require_once WPCE_PLUGIN_PATH . 'modules/minify-css/class-minify-css.php';
		require_once WPCE_PLUGIN_PATH . 'modules/minify-js/class-minify-js.php';

		/**
		 * Settings
		 */

	}

	/**
	 * Initialize Classes
	 *
	 * @return void
	 */
	private function init_classes() {

		new WPCE_Assets();
		new WPCE_Admin_Menu();
		new WPCE_Settings();
		new WPCE_Security();
		new WPCE_Admin_Notices();
		new WPCE_Performance();
		new WPCE_REST_Security();
		new WPCE_Auto_Update();

		/**
		 * Modules
		 */
		new WPCE_Disable_Gutenberg();
		new WPCE_SVG_Upload();
		new WPCE_Duplicate_Post();
		new WPCE_Disable_Image_Duplicates();
		new WPCE_Minify_CSS();
		new WPCE_Minify_JS();
	}
}