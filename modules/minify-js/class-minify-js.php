<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_Minify_JS {

	/**
	 * Constructor
	 */
	public function __construct() {

		/**
		 * Restore original JS if disabled.
		 */
		if ( ! wpce_get_performance_option( 'enable_js_minify', false ) ) {

			add_action(
				'init',
				array( $this, 'restore_original_js' )
			);

			return;
		}

		/**
		 * Only frontend guest users.
		 */
		if ( is_admin() || is_user_logged_in() ) {
			return;
		}

		add_action(
			'wp_enqueue_scripts',
			array( $this, 'minify_js_files' ),
			999
		);
	}

	/**
	 * Minify JS Files
	 *
	 * @return void
	 */
	public function minify_js_files() {

		global $wp_scripts;

		if ( empty( $wp_scripts->queue ) ) {
			return;
		}

		/**
		 * Excluded handles.
		 */
		$excluded_handles = array(
			'jquery',
			'jquery-core',
			'jquery-migrate',
		);

		foreach ( $wp_scripts->queue as $handle ) {

			/**
			 * Skip excluded scripts.
			 */
			if ( in_array( $handle, $excluded_handles, true ) ) {
				continue;
			}

			if ( empty( $wp_scripts->registered[ $handle ] ) ) {
				continue;
			}

			$script = $wp_scripts->registered[ $handle ];

			if ( empty( $script->src ) ) {
				continue;
			}

			/**
			 * Skip external files.
			 */
			if ( false === strpos( $script->src, site_url() ) ) {
				continue;
			}

			/**
			 * Convert URL to file path.
			 */
			$file_path = str_replace(
				site_url(),
				ABSPATH,
				$script->src
			);

			$file_path = strtok( $file_path, '?' );

			/**
			 * Validate JS file.
			 */
			if ( ! file_exists( $file_path ) ) {
				continue;
			}

			if ( 'js' !== pathinfo( $file_path, PATHINFO_EXTENSION ) ) {
				continue;
			}

			/**
			 * Skip already minified files.
			 */
			if ( false !== strpos( $file_path, '.min.js' ) ) {
				continue;
			}

			/**
			 * Backup original file.
			 */
			$backup_file = $file_path . '.wpce-backup';

			if ( ! file_exists( $backup_file ) ) {

				copy( $file_path, $backup_file );
			}

			/**
			 * Get JS content.
			 */
			$js = file_get_contents( $file_path );

			if ( empty( $js ) ) {
				continue;
			}

			/**
			 * Remove multiline comments.
			 */
			$js = preg_replace( '!/\*.*?\*/!s', '', $js );

			/**
			 * Remove single line comments.
			 */
			$js = preg_replace( '/\/\/(.*)/', '', $js );

			/**
			 * Remove spaces/newlines/tabs.
			 */
			$js = preg_replace( '/\s+/', ' ', $js );

			/**
			 * Remove unnecessary spaces.
			 */
			$js = str_replace(
				array(
					' = ',
					' == ',
					' === ',
					' + ',
					' - ',
					' * ',
					' / ',
					' ;',
					'; ',
					'{ ',
					' {',
					'} ',
					'( ',
					' )',
					', ',
				),
				array(
					'=',
					'==',
					'===',
					'+',
					'-',
					'*',
					'/',
					';',
					';',
					'{',
					'{',
					'}',
					'(',
					')',
					',',
				),
				$js
			);

			/**
			 * Save minified JS back to original file.
			 */
			file_put_contents( $file_path, trim( $js ) );
		}
	}

	/**
	 * Restore Original JS
	 *
	 * @return void
	 */
	public function restore_original_js() {

		$this->restore_backup_files(
			WP_CONTENT_DIR,
			'js'
		);
	}

	/**
	 * Restore Backup Files
	 *
	 * @param string $directory Directory path.
	 * @param string $extension File extension.
	 *
	 * @return void
	 */
	private function restore_backup_files( $directory, $extension ) {

		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( $directory )
		);

		foreach ( $files as $file ) {

			if ( $file->isDir() ) {
				continue;
			}

			$file_path = $file->getPathname();

			if ( false === strpos( $file_path, '.wpce-backup' ) ) {
				continue;
			}

			/**
			 * Restore only JS backups.
			 */
			if ( '.' . $extension . '.wpce-backup' !== substr( $file_path, -( strlen( $extension ) + 13 ) ) ) {
				continue;
			}

			$original_file = str_replace(
				'.wpce-backup',
				'',
				$file_path
			);

			copy( $file_path, $original_file );

			unlink( $file_path );
		}
	}
}