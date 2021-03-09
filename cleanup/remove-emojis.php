<?php
/**
 * Removes emojis from front-end, back-end, RSS feeds, embeds, emails, etc.
 *
 * Removes the emoji support injected into various places, for supporting
 * _Japanese_ characters and emojis.
 *
 * __Note:__ This function is added to the
 * {@link https://developer.wordpress.org/reference/hooks/init/ `init` hook},
 * which fires after WordPress has finished loading but before any headers are sent.
 *
 * @uses apway_disable_emojis_tinymce()
 * @uses apway_disable_emojis_remove_dns_prefetch()
 * @return void
 */
function apway_disable_emojis() {
	// Prevent Emoji from loading on the front-end.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	// Remove from admin area also.
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	// Remove from RSS feeds also.
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// Remove from Embeds.
	remove_filter( 'embed_head', 'print_emoji_detection_script' );

	// Remove from emails.
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Disable from TinyMCE editor. Currently disabled in block editor by default.
	add_filter( 'tiny_mce_plugins', 'apway_disable_emojis_tinymce' );

	// Don't bother prefetching DNS for this.
	add_filter( 'wp_resource_hints', 'apway_disable_emojis_remove_dns_prefetch', 10, 2 );

	// Finally, prevent character conversion (otherwise emojis still work if available on user's device).
	add_filter( 'option_use_smilies', '__return_false' );
}
add_action( 'init', 'apway_disable_emojis' );


/**
 * Removes the emoji plugin from TinyMCE.
 *
 * @used-by apway_disable_emojis()
 * @param array $plugins The array of current plugins.
 * @return array         The difference betwen the two arrays.
 */
function apway_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}


/**
 * Removes the emoji CDN hostname from DNS prefetching hints.
 *
 * @used-by apway_disable_emojis()
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array $urls          The difference betwen the two arrays.
 */
function apway_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' ); // phpcs:ignore.
		$urls          = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}
add_filter( 'emoji_svg_url', '__return_false' );
