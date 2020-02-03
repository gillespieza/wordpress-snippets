/**	
 * -----------------------------------------------------------------
 * ACTIVATE WORDPRESS MAINTENANCE MODE
 *
 * https://mhthemes.com/support/knb/how-put-wordpress-in-maintenance-mode/#custom-code-maintenance-page
 * ----------------------------------------------------------------- 
 */
function wp_maintenance_mode() {
  if (!current_user_can('edit_themes') || !is_user_logged_in()) {
      wp_die('<h1>Under Maintenance</h1><br />We are making things awesome and will be back soon.');
  }
}
add_action('get_header', 'wp_maintenance_mode');
