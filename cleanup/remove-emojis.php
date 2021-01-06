<?php
/**
 * Cleanup and optimise WordPress.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

// Security Check: Prevent this file being executed outside the WordPress context.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

/*
 * -----------------------------------------------------------------------------
 * TABLE OF CONTENTS:
 * - Disable Emojis: apway_disable_emojis()
 * - Remove Emojis from TinyMCE: apway_disable_emojis_tinymce()
 * - Disable emoji DNS prefetch: apway_disable_emojis_remove_dns_prefetch()
 * - Remove superfluous meta info from head: apway_remove_header_meta()
 * - Remove generator version number from head: apway_remove_generator_version()
 * - Remove inline gallery CSS
 * - Remove DIVI Project CPT
 * - Disable Admin Bar
 * - Remove Divi's viewport declaration
 * - Fix empty paragraph tags
 * -----------------------------------------------------------------------------
 */


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



/**
 * Removes superfluous meta from the head.
 *
 * Removes meta tags such as adjacent post links, various RSS feed links, the
 * Windows Live Writer Manifest meta tag, the WordPress version number tag, and
 * various other unneeded tags from the `<head>` of the HTML document.
 *
 * __Note:__ We hook this into {@link https://developer.wordpress.org/reference/hooks/after_setup_theme/ `after_setup_theme`}
 * action which is called during each page load after the theme is initialized.
 * This ensures that the callback we are removing has actually been added before
 * you try to remove it.
 */
function apway_remove_header_meta() {
	// for WordPress >= 3.0 adjacent posts.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	// Category feeds.
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	// Post and Comment Feed.
	remove_action( 'wp_head', 'feed_links', 2 );

	// index link.
	remove_action( 'wp_head', 'index_rel_link' );

	// prev link.
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

	// remove REST API link.
	// note, this is only removed from the front end. It does not disable the REST API entirely.
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );

	// removes the REST API from HTTP headers.
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

	// EditURI link/Weblog Client Link.
	remove_action( 'wp_head', 'rsd_link' );

	// start link.
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

	// Windows Live Writer Manifest.
	// WLW is a blog publishing application developed by Microsoft.
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// WordPress Version - security risk.
	remove_action( 'wp_head', 'wp_generator' );

	// removes api.w.org relation link.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

	// remove shortlinks.
	// does anybody even use these any more?
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
};
add_action( 'after_setup_theme', 'apway_remove_header_meta' );



/**
 * Removes the WordPress generator number.
 *
 * Removes the WordPress generator number from the RSS feed as this is a security
 * risk. Appears as `<meta name="generator" content="WordPress 4.9.2">` in the head.
 *
 * @return empty string.
 */
function apway_remove_generator_version() {
	return '';
}
add_filter( 'the_generator', 'apway_remove_generator_version' );



/*
 * Remove the inline CSS that the gallery shortcode outputs - this is invalid
 * HTML, and we've put that CSS in the stylesheet anyway.
 */
add_filter( 'use_default_gallery_style', '__return_false' );


/**
 * Removes Divi "Project" custom post type from admin menu.
 *
 * Hides the the Divi "Project" post type by making it non-public, and removing
 * the custom post type from menus, searches and UIs.
 *
 * @author georgiee
 * @link https://gist.github.com/EngageWP/062edef103469b1177bc#gistcomment-1801080
 * @param array $args An array of arguments that defines the custom post type.
 * @return array A new array with new custom post type args merged in.
 */
function apway_et_project_posttype_args( $args ) {
	return array_merge(
		$args,
		array(
			'public'              => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => false,
			'show_in_nav_menus'   => false,
			'show_ui'             => false,
		)
	);
}
add_filter( 'et_project_posttype_args', 'apway_et_project_posttype_args', 10, 1 );





/* Disable WordPress Admin Bar for all users */
add_filter( 'show_admin_bar', '__return_false' );


/**
 * Speeds up Google Fonts.
 *
 * Inserts elements into the beginning of the `<head>` before
 * any styles or scripts. In this case, we preemptively warm up the fonts' origin
 * by using `preconnect`. Then initiate a high-priority, asynchronous fetch for
 * the CSS file using `preload`. Then initiate a low-priority, asynchronous fetch
 * that gets applied to the page only _after_ it’s arrived. Works in all browsers
 * with JavaScript enabled. Finally, we enable a fallback in case the user has
 * javascript disabled.
 *
 * _Note:_ This action fires in the head, before `wp_head()` is called.
 *
 * @link https://csswizardry.com/2020/05/the-fastest-google-fonts/
 */
function apway_lightning_fast_google_fonts() {
	echo "
	<!-- 0. Lightning fast Google Fonts: https://csswizardry.com/2020/05/the-fastest-google-fonts/ -->
	<!-- 1. Preemptively warm up the fonts' origin. -->
	<link rel='preconnect' href='//fonts.gstatic.com/' crossorigin>
	<link rel='preconnect' href='//fonts.googleapis.com/' crossorigin>

	<!-- 2. Initiate a high-priority, asynchronous fetch for the CSS file. -->
	<!-- Works in most modern browsers. -->
	<link rel='preload'
		as='style'
		href='https://fonts.googleapis.com/css?family=Permanent+Marker:regular&#124;Nunito+Sans:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic&display=swap' />

	<!-- 3. Initiate a low-priority, asynchronous fetch that gets applied to
			the page - only after it’s arrived. Works in all browsers with
			JavaScript enabled. -->
	<link rel='stylesheet'
			href='https://fonts.googleapis.com/css?family=Permanent+Marker:regular&#124;Nunito+Sans:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic&display=swap'
			media='print' onload='this.media=&#34;all&#34;' />

	<!-- 4. In the unlikely event that a visitor has intentionally disabled
			JavaScript, fall back to the original method. The good news is that,
			although this is a render-blocking request, it can still make use of the
			preconnect which makes it marginally faster than the default. -->
	<noscript>
		<link rel='stylesheet'
			href='https://fonts.googleapis.com/css?family=Permanent+Marker:regular&#124;Nunito+Sans:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic&display=swap' />
	</noscript>

	";
}
add_action( 'et_head_meta', 'apway_lightning_fast_google_fonts' );



/**
 * Fixes empty paragraph tags.
 *
 * Stop WP auto-inserting blank <p> tags in shortcodes and empty <p> tags in general.
 * Remove various filters and add them back with a different priority.
 *
 * shortcode_unautop() Don’t auto-p wrap shortcodes that stand alone
 * `the_content`includes the filter for `do_shortcode`. So we need to remove the
 * shortcode autop wrapper, and add it to the content BEFORE wpautop runs.
 * Default priority is 10. Lower numbers == executed earlier.
 */
remove_filter( 'the_content', 'shortcode_unautop' );
add_filter( 'the_content', 'shortcode_unautop', 9 );
