/**
 * Dequeue the Dashicons on the front end if Admin Toolbar is not in use.
 */
function apway_dequeue_dashicons() {
	if (
		! is_admin() && // only do this on the front end.
		! is_admin_bar_showing() && // admin bar is not enabled.
		! is_customize_preview() // we're not on the customiser page.
	) {
		wp_deregister_style( 'dashicons' );
	}
}
add_action( 'wp_print_styles', 'apway_dequeue_dashicons', -1 );
