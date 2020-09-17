/**
 * Add DNS Prefetching and Preconnecting Resource Hints to the <head>
 *
 * Preload: fetch high priority resource used in current route
 * Preconnect: resolves DNS and TCP handshaking
 * Prefetch: fetches resources probably needed for next page load (low priority)
 */
function swm_dns_prefetch_preconnect() {
	echo "
	<meta https-equiv='x-dns-prefetch-control' content='on'>
	<link rel='dns-prefetch' href='//s.gravatar.com/' />
	<link rel='dns-prefetch' href='//0.gravatar.com/' />
	<link rel='dns-prefetch' href='//1.gravatar.com/' />
	<link rel='dns-prefetch' href='//2.gravatar.com/' />

	<link rel='dns-prefetch' href='//maps.googleapis.com/' />
	<link rel='dns-prefetch' href='//maps.gstatic.com/' />

	<link rel='dns-prefetch' href='//ajax.googleapis.com/' />

	<link rel='dns-prefetch' href='//fonts.gstatic.com/' />
	<link rel='preconnect'   href='//fonts.gstatic.com/' crossorigin>
   <link rel='dns-prefetch' href='//fonts.googleapis.com' />
	<link rel='preconnect'   href='//fonts.googleapis.com/' crossorigin>

	<link rel='dns-prefetch' href='//apis.google.com/' />

	<link rel='dns-prefetch' href='//youtube.com/' />

	<link rel='dns-prefetch' href='//s0.wp.com/' />
	<link rel='dns-prefetch' href='//s1.wp.com/' />
	<link rel='dns-prefetch' href='//s2.wp.com/' />

	<link rel='dns-prefetch' href='//stats.wp.com/' />

	";
	/*
<link rel='dns-prefetch' href='//api.pinterest.com/' />
<link rel='dns-prefetch' href='//google-analytics.com/' />
<link rel='dns-prefetch' href='//www.google-analytics.com/' />
<link rel='dns-prefetch' href='//ssl.google-analytics.com/' />
//cdnjs.cloudflare.com
//pixel.wp.com
//connect.facebook.net
//platform.twitter.com
//syndication.twitter.com
//platform.instagram.com
//disqus.com
//sitename.disqus.com
//s7.addthis.com
//platform.linkedin.com
//w.sharethis.com
	Not needed because it is included with DIVI:

	*/
}
add_action( 'wp_head', 'swm_dns_prefetch_preconnect', 0 );
