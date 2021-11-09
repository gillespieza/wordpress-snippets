<?php

// Removes et_add_viewport_meta from the wp_head.
function swm_remove_divi_viewport_meta() {
	remove_action( 'wp_head', 'et_add_viewport_meta' );
}
// Call 'remove_divi_actions' during WP initialization.
add_action( 'init', 'swm_remove_divi_viewport_meta' );

// Replace with new meta.
function swm_et_new_viewport_meta() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=1" />';
}
add_action( 'wp_head', 'swm_et_new_viewport_meta', 15 );
