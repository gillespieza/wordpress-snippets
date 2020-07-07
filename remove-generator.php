/**
 * Remove the WordPress generator number from the RSS feed as this is a security risk.
 *
 * @return empty string.
 */
function apc_remove_generator_version() {
	return '';
}
add_filter( 'the_generator', 'apc_remove_generator_version' );
