<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_Disable_Gutenberg {

	/**
	 * Constructor
	 */
	public function __construct() {

		if ( wpce_get_general_option( 'disable_gutenberg', true ) ) {

			add_filter( 'use_block_editor_for_post', '__return_false', 10 );
			add_filter( 'use_widgets_block_editor', '__return_false' );

			// Remove Gutenberg block CSS
			wp_dequeue_style('wp-block-library');
			wp_deregister_style('wp-block-library');

			// Remove WooCommerce block CSS (if WooCommerce installed)
			wp_dequeue_style('wc-blocks-style');
			wp_deregister_style('wc-blocks-style');

			// Remove global styles
			wp_dequeue_style('global-styles');
			wp_deregister_style('global-styles');

			// Remove classic theme styles
			wp_dequeue_style('classic-theme-styles');
			wp_deregister_style('classic-theme-styles');

			remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
			remove_action('wp_footer', 'wp_enqueue_global_styles', 1);

		}
	}
}