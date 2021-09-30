/** 
 * -----------------------------------------------------------------
 * FIX BACKWPUP TIMEOUT PATCH
 * ----------------------------------------------------------------- 
 */  
function __extend_http_request_timeout( $timeout ) {
    return 60;
}
add_filter( 'http_request_timeout', '__extend_http_request_timeout' );
