<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_REST_Security {

	/**
	 * Constructor
	 */
	public function __construct() {

		if ( wpce_get_security_option( 'disable_rest_api', 0 ) ) {

			add_filter(
				'rest_authentication_errors',
				array( $this, 'disable_rest_api_for_guests' )
			);
		}
	}

	/**
	 * Disable REST API For Guests
	 *
	 * @param mixed $result Current result.
	 *
	 * @return mixed
	 */
	public function disable_rest_api_for_guests( $result ) {

		if ( ! empty( $result ) ) {
			return $result;
		}

		if ( ! is_user_logged_in() ) {

			return new WP_Error(
				'rest_disabled',
				__( 'REST API restricted.', 'wp-core-enhancement' ),
				array( 'status' => 403 )
			);
		}

		return $result;
	}
}