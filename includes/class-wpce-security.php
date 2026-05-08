<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_Security {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_filter( 'upload_mimes', array( $this, 'secure_upload_mimes' ) );
	}

	/**
	 * Secure Upload Types
	 *
	 * @param array $mimes Allowed mime types.
	 *
	 * @return array
	 */
	public function secure_upload_mimes( $mimes ) {

		unset( $mimes['exe'] );

		return $mimes;
	}
}