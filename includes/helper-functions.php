<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get General Setting
 *
 * @param string $key Setting key.
 * @param mixed  $default Default value.
 *
 * @return mixed
 */
function wpce_get_general_option( $key, $default = false ) {

	$options = get_option(
		'wpce_general_settings',
		array()
	);

	return isset( $options[ $key ] )
		? $options[ $key ]
		: $default;
}

/**
 * Get Performance Setting
 *
 * @param string $key Setting key.
 * @param mixed  $default Default value.
 *
 * @return mixed
 */
function wpce_get_performance_option( $key, $default = false ) {

	$options = get_option(
		'wpce_performance_settings',
		array()
	);

	return isset( $options[ $key ] )
		? $options[ $key ]
		: $default;
}

/**
 * Get Security Setting
 *
 * @param string $key Setting key.
 * @param mixed  $default Default value.
 *
 * @return mixed
 */
function wpce_get_security_option( $key, $default = false ) {

	$options = get_option(
		'wpce_security_settings',
		array()
	);

	return isset( $options[ $key ] )
		? $options[ $key ]
		: $default;
}