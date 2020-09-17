/**
 * Remove superfluous meta from the head.
 */
function apc_remove_header_info() {
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // for WordPress >= 3.0 adjacent posts.
	remove_action( 'wp_head', 'feed_links_extra', 3 );           // Category feeds.
	remove_action( 'wp_head', 'feed_links', 2 );                 // Post and Comment Feed.
	remove_action( 'wp_head', 'index_rel_link' );                 // index link..
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );   // prev link.
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 ); // remove REST API link.
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 ); // removes the REST API from HTTP headers.
	remove_action( 'wp_head', 'rsd_link' ); // EditURI link/Weblog Client Link.
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );    // start link.
	remove_action( 'wp_head', 'wlwmanifest_link' ); // Windows Live Writer Manifest.
	remove_action( 'wp_head', 'wp_generator' ); // WordPress Version - security risk.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 ); // removes api.w.org relation link.
	remove_action( 'wp_head', 'wp_shortlink_wp_head' ); // remove shortlinks.
};

/*
 * We'll add this `after_setup_theme - hook called during each page load after
 * the theme is initialized. This ensures that the callback we are removing has
 * been added before you try to remove it.
 */
add_action( 'after_setup_theme', 'apc_remove_header_info' );