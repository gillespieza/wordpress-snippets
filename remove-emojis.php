<?php
/**
 * Remove emojis from front and back-end, including from TinyMCE
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Disable emojis
 *
 * @return void
 */
function apc_disable_emojis() {
	// Let's remove a bunch of actions & filters.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// We also take care of Tiny MCE.
	add_filter( 'tiny_mce_plugins', 'apc_disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'apc_disable_emojis_remove_dns_prefetch', 10, 2 );
}

// Let's do this at the init.
add_action( 'init', 'apc_disable_emojis' );


/**
 * Filter funcion to remove the emoji plugin from TinyMCE.
 *
 * This function is called in the filter function apc_disable_emojis().
 *
 * @param array $plugins The array of current plugins.
 * @return array Difference betwen the two arrays.
 */
function apc_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}


/**
 * Removing emoji CDN hostname from DNS prefetching hints.
 *
 * This function is called in the filter function apc_disable_emojis().
 *
 * @param array  $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function apc_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' ); // phpcs:ignore.
		$urls          = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}
add_filter( 'emoji_svg_url', '__return_false' );
