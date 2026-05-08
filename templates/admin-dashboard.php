<?php

if (! defined('ABSPATH')) {
	exit;
}

$active_tab = isset($_GET['tab'])
	? sanitize_text_field($_GET['tab'])
	: 'general';

?>

<div class="wrap wpce-admin-wrap">

	<div class="wpce-header">


		<h1>WP Core Enhancement</h1>

		<p>
			Professional WordPress Core Optimization Toolkit
		</p>

	</div>

	<nav class="nav-tab-wrapper">

		<a href="?page=wp-core-enhancement&tab=general"
			class="nav-tab <?php echo ('general' === $active_tab) ? 'nav-tab-active' : ''; ?>">
			General
		</a>

		<a href="?page=wp-core-enhancement&tab=performance"
			class="nav-tab <?php echo ('performance' === $active_tab) ? 'nav-tab-active' : ''; ?>">
			Performance
		</a>

		<a href="?page=wp-core-enhancement&tab=security"
			class="nav-tab <?php echo ('security' === $active_tab) ? 'nav-tab-active' : ''; ?>">
			Security
		</a>

		<a href="?page=wp-core-enhancement&tab=about"
			class="nav-tab <?php echo ('about' === $active_tab) ? 'nav-tab-active' : ''; ?>">
			About
		</a>

	</nav>

	<div class="wpce-content">

	<form method="post" action="options.php">

		<?php

		/**
		 * Settings Fields
		 */
		switch ($active_tab) {

			case 'performance':
				settings_fields('wpce_performance_group');
				break;

			case 'security':
				settings_fields('wpce_security_group');
				break;

			default:
				settings_fields('wpce_general_group');
				break;
		}

		/**
		 * Load Tab Templates
		 */
		switch ($active_tab) {

			case 'performance':
				require_once WPCE_PLUGIN_PATH . 'templates/settings/performance-tab.php';
				break;

			case 'security':
				require_once WPCE_PLUGIN_PATH . 'templates/settings/security-tab.php';
				break;

			case 'about':
				require_once WPCE_PLUGIN_PATH . 'templates/settings/about-tab.php';
				break;

			default:
				require_once WPCE_PLUGIN_PATH . 'templates/settings/general-tab.php';
				break;
		}

		/**
		 * Hide Save Button on About Tab
		 */
		if ('about' !== $active_tab) {

			submit_button();
		}
		?>

	</form>

	</div>

</div>