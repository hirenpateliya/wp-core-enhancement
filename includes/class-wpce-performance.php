<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_Performance {

	/**
	 * Constructor
	 */
	public function __construct() {

		if ( wpce_get_performance_option( 'disable_emojis', 1 ) ) {

			add_action( 'init', array( $this, 'disable_emojis' ) );
		}
	}

	/**
	 * Disable Emojis
	 *
	 * @return void
	 */
	public function disable_emojis() {

		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
	}
}