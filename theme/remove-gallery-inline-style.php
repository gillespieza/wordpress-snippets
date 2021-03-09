/*
 * Remove the inline CSS that the gallery shortcode outputs - this is invalid
 * HTML, and we've put that CSS in the stylesheet anyway.
 */
add_filter( 'use_default_gallery_style', '__return_false' );
