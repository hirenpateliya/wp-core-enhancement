<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_Settings {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action(
			'admin_init',
			array( $this, 'register_settings' )
		);
	}

	/**
	 * Register Settings
	 *
	 * @return void
	 */
	public function register_settings() {

		/**
		 * General Settings
		 */
		register_setting(
			'wpce_general_group',
			'wpce_general_settings',
			array(
				'sanitize_callback' => array( $this, 'sanitize_general_settings' ),
			)
		);

		/**
		 * Performance Settings
		 */
		register_setting(
			'wpce_performance_group',
			'wpce_performance_settings',
			array(
				'sanitize_callback' => array( $this, 'sanitize_performance_settings' ),
			)
		);

		/**
		 * Security Settings
		 */
		register_setting(
			'wpce_security_group',
			'wpce_security_settings',
			array(
				'sanitize_callback' => array( $this, 'sanitize_security_settings' ),
			)
		);
	}

	/**
	 * Sanitize General Settings
	 *
	 * @param array $input Raw input.
	 *
	 * @return array
	 */
	public function sanitize_general_settings( $input ) {

		add_settings_error(
			'wpce_messages',
			'wpce_general_message',
			__( 'General settings saved successfully.', 'wp-core-enhancement' ),
			'updated'
		);

		return $input;
	}

	/**
	 * Sanitize Performance Settings
	 *
	 * @param array $input Raw input.
	 *
	 * @return array
	 */
	public function sanitize_performance_settings( $input ) {

		add_settings_error(
			'wpce_messages',
			'wpce_performance_message',
			__( 'Performance settings saved successfully.', 'wp-core-enhancement' ),
			'updated'
		);

		return $input;
	}

	/**
	 * Sanitize Security Settings
	 *
	 * @param array $input Raw input.
	 *
	 * @return array
	 */
	public function sanitize_security_settings( $input ) {

		add_settings_error(
			'wpce_messages',
			'wpce_security_message',
			__( 'Security settings saved successfully.', 'wp-core-enhancement' ),
			'updated'
		);

		return $input;
	}
}