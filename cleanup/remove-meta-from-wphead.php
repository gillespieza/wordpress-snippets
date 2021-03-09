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

/*
 * We'll add this `after_setup_theme - hook called during each page load after
 * the theme is initialized. This ensures that the callback we are removing has
 * been added before you try to remove it.
 */
add_action( 'after_setup_theme', 'apway_remove_header_meta' );
