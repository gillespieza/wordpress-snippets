/**
 * Disable oEmbeds.
 *
 * Since WP 4.4 oEmbed was merged into WP core. This feature allows you to embed
 * YouTube videos, tweets. It creates an additional HTTP request with wp-embed.min.js
 * which loads on every page. It also allows others to embed your post on their blog
 * by simply pasting a URL.
 */
function swm_stop_loading_wp_embed() {
	if ( ! is_admin() ) {
		/* only do this on the front end. */
		wp_deregister_script( 'wp-embed' );
	}
}
add_action( 'init', 'swm_stop_loading_wp_embed' );

