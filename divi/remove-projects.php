/**
 * Removes Divi "Project" custom post type from admin menu.
 *
 * Hides the the Divi "Project" post type by making it non-public, and removing
 * the custom post type from menus, searches and UIs.
 *
 * @author georgiee
 * @link https://gist.github.com/EngageWP/062edef103469b1177bc#gistcomment-1801080
 * @param array $args An array of arguments that defines the custom post type.
 * @return array A new array with new custom post type args merged in.
 */
function apway_et_project_posttype_args( $args ) {
	return array_merge(
		$args,
		array(
			'public'              => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => false,
			'show_in_nav_menus'   => false,
			'show_ui'             => false,
		)
	);
}
add_filter( 'et_project_posttype_args', 'apway_et_project_posttype_args', 10, 1 );

