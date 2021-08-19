<?php
/**
 * @package disable-email-notifications
 * @version 1.0
 *
 * Plugin Name: Disable Email Notifications
 * Description: Disable notifications for core updates, theme updates and plugin updates.
 * Author: Amanda Dominy
 * Version: 1.0
 */



/**
 * Disable successful update notices.
 *
 * Adds a filter to disable email notifications after updates.
 */
function itc_stop_update_emails( $send, $type, $core_update, $result ) {
	if ( ! empty( $type ) && $type == 'success' ) {
		return false;
	}
	return true;
}
add_filter( 'auto_core_update_send_email', 'itc_stop_update_emails', 10, 4 ); // after core updates.
add_filter( 'auto_plugin_update_send_email', '__return_false' ); // after plugin updates.
add_filter( 'auto_theme_update_send_email', '__return_false' ); // after theme updates.
