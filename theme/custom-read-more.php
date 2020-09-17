<?php
/**
 * Filter the except length to 20 words.
 *
 * By default, the excerpt length is 50 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function apway_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'apway_custom_excerpt_length', 999 );




/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function apway_excerpt_readmore( $more ) {
	if ( ! is_single() ) {
		$more = sprintf(
			'<div class="view-full-post"><a class="read-more" href="%1$s" class="view-full-post-btn">&hellip; %2$s &raquo;</a></div>',
			get_permalink( get_the_ID() ),
			__( 'Read More', 'textdomain' )
		);
	}
	return $more;
}
add_filter( 'excerpt_more', 'apway_excerpt_readmore' );
