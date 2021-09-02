<?php

function apway_mute_jquery_migrator() {
	echo '<script>jQuery.migrateMute = true;</script>';
}
add_action( 'wp_head', 'apway_mute_jquery_migrator' );
add_action( 'admin_head', 'apway_mute_jquery_migrator' );
