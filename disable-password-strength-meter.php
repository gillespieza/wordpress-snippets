
/**
 * Remove the password strength meter check on unrelated pages
 */
function apway_remove_password_strength_meter() {
	$valid_pages =
		isset( $wp->query_vars['lost-password'] )
		|| ( isset( $_GET['action'] ) && 'lostpassword' === $_GET['action'] )
		|| is_page( 'lost_password' );

	$wc_valid_pages =
		is_woocommerce_activated() // true or false.
		|| $valid_pages // lost-password.
		|| is_account_page()
		|| is_checkout();

	/*
	 * if woocommerce is enabled, don't do it on the valid pages, ie:
	 * lost_password, checkout, account page.
	 * If it is not any of these pages, then dequeue the script.
	 */
	if ( ! $wc_valid_pages ) {
		if ( wp_script_is( 'zxcvbn-async', 'enqueued' ) ) {
			wp_dequeue_script( 'zxcvbn-async' );
		}

		if ( wp_script_is( 'password-strength-meter', 'enqueued' ) ) {
			wp_dequeue_script( 'password-strength-meter' );
		}

		if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
			wp_dequeue_script( 'wc-password-strength-meter' );
		}
	}

	/* else if woocommerce is not active, still dequeue the scripts on other pages */
	if ( $valid_pages ) {
		if ( wp_script_is( 'zxcvbn-async', 'enqueued' ) ) {
			wp_dequeue_script( 'zxcvbn-async' );
		}

		if ( wp_script_is( 'password-strength-meter', 'enqueued' ) ) {
			wp_dequeue_script( 'password-strength-meter' );
		}
	}

}
add_action( 'wp_print_scripts', 'apway_remove_password_strength_meter', 100 );



/**
 * Utility function to check if WooCommerce is activated
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) {
			return true;
		} else {
			return false;
		}
	}
}
