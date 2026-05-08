<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPCE_Duplicate_Post {

	/**
	 * Constructor
	 */
	public function __construct() {

		/**
		 * Stop if feature disabled.
		 */
		if ( ! wpce_get_general_option( 'enable_duplicate_post', false ) ) {
			return;
		}

		/**
		 * Add duplicate actions.
		 */
		add_filter(
			'post_row_actions',
			array( $this, 'duplicate_link' ),
			10,
			2
		);

		add_filter(
			'page_row_actions',
			array( $this, 'duplicate_link' ),
			10,
			2
		);

		/**
		 * Duplicate handler.
		 */
		add_action(
			'admin_action_wpce_duplicate_post',
			array( $this, 'duplicate_post' )
		);
	}

	/**
	 * Add Duplicate Link
	 *
	 * @param array   $actions Existing actions.
	 * @param WP_Post $post Current post object.
	 *
	 * @return array
	 */
	public function duplicate_link( $actions, $post ) {

		/**
		 * Check permissions.
		 */
		if ( ! current_user_can( 'edit_posts' ) ) {
			return $actions;
		}

		$url = wp_nonce_url(
			admin_url(
				'admin.php?action=wpce_duplicate_post&post=' . $post->ID
			),
			'wpce_duplicate_post_' . $post->ID
		);

		$actions['wpce_duplicate'] =
			'<a href="' . esc_url( $url ) . '">Duplicate</a>';

		return $actions;
	}

	/**
	 * Duplicate Post
	 *
	 * @return void
	 */
	public function duplicate_post() {

		/**
		 * Validate post ID.
		 */
		if ( ! isset( $_GET['post'] ) ) {
			wp_die( esc_html__( 'No post found.', 'wp-core-enhancement' ) );
		}

		$post_id = absint( $_GET['post'] );

		/**
		 * Security check.
		 */
		check_admin_referer( 'wpce_duplicate_post_' . $post_id );

		$post = get_post( $post_id );

		/**
		 * Validate post.
		 */
		if ( ! $post ) {
			wp_die( esc_html__( 'Invalid post.', 'wp-core-enhancement' ) );
		}

		/**
		 * Create duplicated post.
		 */
		$new_post = array(
			'post_title'   => $post->post_title . ' Copy',
			'post_content' => $post->post_content,
			'post_excerpt' => $post->post_excerpt,
			'post_status'  => 'draft',
			'post_type'    => $post->post_type,
			'post_author'  => get_current_user_id(),
		);

		$new_post_id = wp_insert_post( $new_post );

		/**
		 * Copy taxonomies.
		 */
		$taxonomies = get_object_taxonomies( $post->post_type );

		if ( ! empty( $taxonomies ) ) {

			foreach ( $taxonomies as $taxonomy ) {

				$post_terms = wp_get_object_terms(
					$post_id,
					$taxonomy,
					array(
						'fields' => 'ids',
					)
				);

				wp_set_object_terms(
					$new_post_id,
					$post_terms,
					$taxonomy
				);
			}
		}

		/**
		 * Copy post meta.
		 */
		$post_meta = get_post_meta( $post_id );

		if ( ! empty( $post_meta ) ) {

			foreach ( $post_meta as $meta_key => $meta_values ) {

				/**
				 * Skip protected meta.
				 */
				if ( '_wp_old_slug' === $meta_key ) {
					continue;
				}

				foreach ( $meta_values as $meta_value ) {

					add_post_meta(
						$new_post_id,
						$meta_key,
						maybe_unserialize( $meta_value )
					);
				}
			}
		}

		/**
		 * Redirect to edit page.
		 */
		wp_safe_redirect(
			admin_url(
				'edit.php?post_type=' . $post->post_type
			)
		);

		exit;
	}
}