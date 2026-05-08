<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_Auto_Update {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_filter(
			'auto_update_plugin',
			array( $this, 'enable_auto_update' ),
			10,
			2
		);
	}

	/**
	 * Enable Plugin Auto Updates
	 *
	 * @param bool   $update Update status.
	 * @param object $item Plugin data.
	 *
	 * @return bool
	 */
	public function enable_auto_update( $update, $item ) {

		if ( isset( $item->plugin ) && WPCE_PLUGIN_BASENAME === $item->plugin ) {
			return true;
		}

		return $update;
	}
}