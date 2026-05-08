<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_Disable_Image_Duplicates {

	/**
	 * Constructor
	 */
	public function __construct() {

		/**
		 * Stop if feature disabled.
		 */
		if ( ! wpce_get_performance_option( 'disable_image_duplicates', false ) ) {
			return;
		}

		/**
		 * Disable generated image sizes.
		 */
		add_filter(
			'intermediate_image_sizes_advanced',
			array( $this, 'disable_image_sizes' )
		);

		/**
		 * Disable big image scaling.
		 */
		add_filter(
			'big_image_size_threshold',
			'__return_false'
		);
	}

	/**
	 * Disable image sizes generation.
	 *
	 * @param array $sizes Generated image sizes.
	 *
	 * @return array
	 */
	public function disable_image_sizes( $sizes ) {

		return array();
	}
}