/**
 * Remove query strings from resources.
 *
 * @param string $src The link from which to remove the version query string.
 */
function apc_cleanup_query_string( $src ) {
	$parts = explode( '?ver', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', 'apc_cleanup_query_string', 15, 1 );
add_filter( 'style_loader_src', 'apc_cleanup_query_string', 15, 1 );
