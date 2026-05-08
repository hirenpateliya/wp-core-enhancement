<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_Admin_Notices {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
	}

	/**
	 * Welcome Notice
	 *
	 * @return void
	 */
	public function welcome_notice() {

		if ( get_transient( 'wpce_activation_notice' ) ) {

			?>

			<div class="notice notice-success is-dismissible">

				<p>
					<strong>
						WP Core Enhancement Activated Successfully.
					</strong>
				</p>

			</div>

			<?php

			delete_transient( 'wpce_activation_notice' );
		}
	}
}