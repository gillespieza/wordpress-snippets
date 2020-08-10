if ( ! function_exists( 'print_r_pre' ) ) {
	function print_r_hidden($argument) {
		echo  "<!-- FOOBAR GREP ";		
		//echo "<pre style='color: steelblue; background: #ddd; border: 1px dashed #bbb; padding: 10px'>";
		echo "<pre>";
		print_r($argument);
		echo "</pre>";
		echo " -->";
	}
	function print_r_pre($argument) {
		echo "<pre style='color: steelblue; background: #ddd; border: 1px dashed #bbb; padding: 10px'>";
		print_r($argument);
		echo "</pre>";
	}	
}

// Call it where you need it: print_filters_for( 'the_content' );
function print_filters_for( $hook = '' ) {
    global $wp_filter;
    if( empty( $hook ) || !isset( $wp_filter[$hook] ) )
        return;
	print "<!-- ";
    print '<pre>';
    print_r( $wp_filter[$hook] );
    print '</pre>';
	print "< -->";
}
