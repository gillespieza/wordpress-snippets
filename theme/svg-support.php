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



/**
 *
 * `wp_check_filetype_and_ext` attemps to determine the real file type of a file.
 * If unable to, the file name extension will be used to determine type.
 */
function apway_verify_filetype( $data, $file, $filename, $mimes ) {
	$filetype = wp_check_filetype( $filename, $mimes );

	return array(
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename'],
	);

}
add_filter( 'wp_check_filetype_and_ext', 'apway_verify_filetype', 10, 4 );
