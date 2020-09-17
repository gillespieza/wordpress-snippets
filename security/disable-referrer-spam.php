/* Filters the array of parsed query variables. */
add_filter( 'request', 'apway_filter_referral_spam_requests', 0 );
/** Serve 404 to referrers on the current Blacklist */
function apway_filter_referral_spam_requests( $request ) {
	global $wp_query;

	/* Retrieve referer from ‘_wp_http_referer’ or HTTP referer. */
	$referrer = wp_get_referer() !== false ? wp_get_referer() : ( isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : '' );  // Input var okay.

	if ( empty( $referrer ) ) {
		return $request;
	}

	/* Parses a URL and returns an associative array containing its components.
	 * The values of the array elements are not URL decoded
	 */
	$referrer = parse_url( $referrer, PHP_URL_HOST );

	/* Get the blacklist */
	$referrers_blacklist = apway_referrals_blacklist();

	if ( empty( $referrers_blacklist ) ) {
		return $request;
	}

	$is_blacklisted = false;

	/* check the referrer against the blacklist */
	foreach ( $referrers_blacklist as $blist_ref ) {
		if ( false !== stripos( $referrer, $blist_ref ) ) {
			$is_blacklisted = true;
			break;
		}
	}

	/* if they are blacklisted, serve them a 404 */
	if ( $is_blacklisted ) {
		/* Set HTTP status header. */
		status_header( 404 );
		$wp_query->set_404();
			get_template_part( 404 );
			exit();
	}
		return $request;
}


/**
 * Gets a list of blacklisted referals from the JSON file of the plugin
 * Stop Referrer Spam by Krzysztof Wielogórski
 *
 * @see https://wordpress.org/plugins/stop-referrer-spam/
 */
function apway_referrals_blacklist() {

	/* Retrieves the value of a transient. */
	$ret = get_transient( '_referalls_spam_blacklist' );

	/* If the transient does not exist/no value/expired, then return = false. */
	if ( false === $ret ) {

		/* Performs an HTTP request using the GET method and returns its response. */
		$response = wp_remote_get( 'https://srs.wielo.co/blacklist.json' );

		if ( $response instanceof WP_Error ) {
			return;
		}

		$ret = $response['body'];

		if ( empty( $ret ) ) {
			return;
		}

		/* Decodes a JSON string for use in PHP */
		$ret = json_decode( $ret, true );

		if ( null === $ret ) {
			return;
		}

		set_transient( '_referalls_spam_blacklist', $ret, DAY_IN_SECONDS );    // Refresh daily.
	}

	return $ret;
}
