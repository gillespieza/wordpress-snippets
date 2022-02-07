<?php

/**
 * Change the duration of consent for the CookieYes plugin.
 *
 * @link https://www.webtoffee.com/how-to-modify-duration-of-cookie-consent/
 */

function cli_set_expire() { 
  
  // First time visit and class exists.
	if ( class_exists( 'Cookie_Law_Info_Public' ) ) {
	?>
	<script type="text/javascript">

		CLI_ACCEPT_COOKIE_EXPIRE = 182;
		
	</script>
	<?php
	}
}
add_action( 'wp_footer', 'cli_set_expire', 20 );
