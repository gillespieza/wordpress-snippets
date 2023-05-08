/**
 * -----------------------------------------------------------------
 * ADD LOGIN/OUT LINK TO TOP MENU
 * -----------------------------------------------------------------
 */
function sweb_add_login_logout_link( $items, $args ) {
	if ( $args->theme_location == 'account' ) {
		if ( is_user_logged_in() ) {
			$items .= "
			<li class='nav-item'>
				<a class='nav-link' href='" . wp_logout_url( home_url() ) . "' title='Logout'>
					<i class='fas fa-fw fa-sign-out-alt'></i>&nbsp;Logout
				</a>
			</li>
			";
		} else {
			$items .= "
			<li class='nav-item'>
				<a class='nav-link' href='/my-account/' title='Login'>
					<i class='fas fa-fw fa-sign-in-alt' aria-hidden=true></i>&nbsp;Login
				</a>
			</li>
			";
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'sweb_add_login_logout_link', 10, 2 );
