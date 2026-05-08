<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_Minify_CSS {

	/**
	 * Constructor
	 */
	public function __construct() {

		/**
		 * Restore original CSS if disabled.
		 */
		if ( ! wpce_get_performance_option( 'enable_css_minify', false ) ) {

			add_action(
				'init',
				array( $this, 'restore_original_css' )
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
			array( $this, 'minify_css_files' ),
			999
		);
	}

	/**
	 * Minify CSS Files
	 */
	public function minify_css_files() {

		global $wp_styles;

		if ( empty( $wp_styles->queue ) ) {
			return;
		}

		foreach ( $wp_styles->queue as $handle ) {

			if ( empty( $wp_styles->registered[ $handle ] ) ) {
				continue;
			}

			$style = $wp_styles->registered[ $handle ];

			if ( empty( $style->src ) ) {
				continue;
			}

			if ( false === strpos( $style->src, site_url() ) ) {
				continue;
			}

			$file_path = str_replace(
				site_url(),
				ABSPATH,
				$style->src
			);

			$file_path = strtok( $file_path, '?' );

			if ( ! file_exists( $file_path ) ) {
				continue;
			}

			if ( 'css' !== pathinfo( $file_path, PATHINFO_EXTENSION ) ) {
				continue;
			}

			/**
			 * Backup original file.
			 */
			$backup_file = $file_path . '.wpce-backup';

			if ( ! file_exists( $backup_file ) ) {

				copy( $file_path, $backup_file );
			}

			$css = file_get_contents( $file_path );

			if ( empty( $css ) ) {
				continue;
			}

			/**
			 * Minify CSS.
			 */
			$css = preg_replace( '!/\*.*?\*/!s', '', $css );
			$css = preg_replace( '/\s+/', ' ', $css );

			$css = str_replace(
				array(
					'; ',
					': ',
					' {',
					'{ ',
					', ',
					'} ',
					';}',
				),
				array(
					';',
					':',
					'{',
					'{',
					',',
					'}',
					'}',
				),
				$css
			);

			file_put_contents( $file_path, trim( $css ) );
		}
	}

	/**
	 * Restore Original CSS
	 */
	public function restore_original_css() {

		$this->restore_backup_files(
			ABSPATH,
			'css'
		);
	}

	/**
	 * Restore Backup Files
	 *
	 * @param string $directory Directory path.
	 * @param string $extension File extension.
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