<?php
/**
 * Debugging functions
 *
 * @package pathway_2020
 */

// Security Check: Prevent this file being executed outside the WordPress context.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

if ( ! function_exists( 'print_r_hidden' ) ) {
	/**
	 * Wraps the print_r function in a hidden comment tag.
	 *
	 * @param mixed $argument Whatever you want printed out.
	 */
	function print_r_hidden( $argument ) {
		echo '<!-- FOOBAR GREP ';
		print_r( $argument ); // phpcs:ignore
		echo ' -->';
	}
}


if ( ! function_exists( 'print_r_pre' ) ) {
	/**
	 * Wraps the print_r function in a styled `<pre>` tag.
	 *
	 * @param mixed $argument Whatever you want printed out.
	 */
	function print_r_pre( $argument ) {
		echo "<pre style='color: steelblue; background: #eee; border: 1px dashed #bbb; padding: 10px'>";
		print_r( $argument );
		echo '</pre>';
	}
}

if ( ! function_exists( 'print_filters_for' ) ) {
	/**
	 * Pretty prints a list of all the functions/filters applied to a filter.
	 *
	 * For example `print_filters_for( 'the_content' );`
	 *
	 * @param string $hook Whatever you want printed out. Default is empty.
	 */
	function print_filters_for( $hook = '' ) {
		global $wp_filter;
		if ( empty( $hook ) || ! isset( $wp_filter[ $hook ] ) ) {
			return;
		}
		print '<pre>';
		print_r( $wp_filter[ $hook ] );
		print '</pre>';
	}
}
