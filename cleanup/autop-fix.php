/**
 * Fixes empty paragraph tags.
 *
 * Stop WP auto-inserting blank <p> tags in shortcodes and empty <p> tags in general.
 * Remove various filters and add them back with a different priority.
 *
 * shortcode_unautop() Don’t auto-p wrap shortcodes that stand alone
 * `the_content`includes the filter for `do_shortcode`. So we need to remove the
 * shortcode autop wrapper, and add it to the content BEFORE wpautop runs.
 * Default priority is 10. Lower numbers == executed earlier.
 */
remove_filter( 'the_content', 'shortcode_unautop' );
add_filter( 'the_content', 'shortcode_unautop', 9 );
