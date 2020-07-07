/**
 * Remove the WordPress generator number from the RSS feed as this is a security
 * risk. Appears as <meta name="generator" content="WordPress 4.9.2"> in the head.
 *
 * @return empty string.
 */
function apc_remove_generator_version() {
	return '';
}
add_filter( 'the_generator', 'apc_remove_generator_version' );
