<?php
/**
 * ----------------------------------------------------------------- 
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Salamander Bootstrap 2.0
 * ----------------------------------------------------------------- 
 */
function sbs_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'sbs_javascript_detection', 0 );
