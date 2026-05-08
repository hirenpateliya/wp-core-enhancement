<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_SVG_Upload {

	/**
	 * Constructor
	 */
	public function __construct() {

		if ( wpce_get_general_option( 'enable_svg_upload', true ) ) {

			add_filter( 'upload_mimes', array( $this, 'allow_svg_upload' ) );
		}
	}

	/**
	 * Allow SVG Upload
	 *
	 * @param array $mimes Mime types.
	 *
	 * @return array
	 */
	public function allow_svg_upload( $mimes ) {

		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}
}