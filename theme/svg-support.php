/**
 * Add SVG to the allowed mime types in the Media Library.
 *
 * Uses the filter `upload_mimes` to filter the list of allowed mime types and
 * file extensions.
 *
 * @link https://developer.wordpress.org/reference/hooks/upload_mimes/
 *
 * @param array $mimes Mime types keyed by the file extension regex corresponding to those types.
 */
function apway_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'apway_mime_types' );
