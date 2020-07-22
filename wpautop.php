<?php 
/** 
 * -----------------------------------------------------------------
 * AUTOP
 * Stop WP auto-inserting blank <p> tags in shortcodes and empty <p> tags in general
 * ----------------------------------------------------------------- 
 */  
function empty_paragraph_fix( $content ) {
   $array = array (
       "<p><!--"                => "<!--",
       "<p> <!-- close"         => "<!-- close",
       "<p><!-- close "         => "<!-- close",   
       "<p> <!-- close row --> </div>"    => "<!-- close row--> </div>",   
       "<p><!-- close row --> </div>"    => "<!-- close row--> </div>",   
       "<p> <!-- close group --> </div>" => "<!-- close group --> </div>",      
       "<p> <!-- close group --></p>"    => "<!-- close group -->",      
       "<p><!-- close group --></p>"    => "<!-- close group -->",      
       "<p><!-- "               => "<!-- ",
       "--></p>"                => "-->",
       " --></p>"               => " -->",
       "<p></p>"                => "",
       "<p><script>"            => "<script>",
       "</script></p>"          => "</script>",
       "<p>["                   => "[",
       "]</p>"                  => "]",
       "]<br />"                => "]",
       "<p>\t"                  => "",
       "<p>   "                 => "",   
       "--><br />"              => "-->",   
       "-->  </p>"              => "-->",   
       "</script><br />"       => "</script>",
       //"<p><em>!</em></p>"      => "<!-- Pinpoint error -->", 
       //'<strong style="color: #252525">!</strong>'      => "<!-- Pinpoint error -->",   
    );
   $content = strtr($content, $array);
   return $content;
  }


//remove_all_filters( 'the_content' );
//add_filter( 'the_content', 'wpautop' , 100 );
//add_filter( 'the_content', 'empty_paragraph_fix', 99 );


//add_filter( 'woocommerce_content', 'wpautop', 100 );
//remove_all_filters( 'woocommerce_content' );
//add_filter( 'woocommerce_content', 'empty_paragraph_fix', 99 );
//add_filter( 'woocommerce_content', 'parse_shortcode_content' );


//move wpautop filter to AFTER shortcode is processed
//add_filter( 'the_content', 'shortcode_unautop' );


//remove_filter( 'the_content', 'wpautop' );
//remove_filter( 'the_content', 'wpsc_products_page' );

//remove_filter( 'woocommerce_content', 'wpautop' );
//remove_filter( 'woocommerce_content', 'wpsc_products_page' );

//remove_filter( 'woocommerce_short_description', 'wpautop' );

//remove_filter( 'the_content', 'do_shortcode' );


