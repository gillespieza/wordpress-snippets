
add_action( 'after_setup_theme', 'swm_html5_support' );

/** Switch default core markup for search form, comment form, and comments
  * to output valid HTML5.
  */
function swm_html5_support() {
	add_theme_support(
        	'html5',
		array(
		  'search-form',
		  'comment-form',
		  'comment-list',
		  'gallery',
		  'caption',
		  'style',
		  'script',
		)
	);
}
