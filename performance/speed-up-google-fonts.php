/**
 * Speeds up Google Fonts.
 *
 * Inserts elements into the beginning of the `<head>` before
 * any styles or scripts. In this case, we preemptively warm up the fonts' origin
 * by using `preconnect`. Then initiate a high-priority, asynchronous fetch for
 * the CSS file using `preload`. Then initiate a low-priority, asynchronous fetch
 * that gets applied to the page only _after_ it’s arrived. Works in all browsers
 * with JavaScript enabled. Finally, we enable a fallback in case the user has
 * javascript disabled.
 *
 * _Note:_ This action fires in the head, before `wp_head()` is called.
 *
 * @link https://csswizardry.com/2020/05/the-fastest-google-fonts/
 */
function apway_lightning_fast_google_fonts() {
	echo "
	<!-- 0. Lightning fast Google Fonts: https://csswizardry.com/2020/05/the-fastest-google-fonts/ -->
	<!-- 1. Preemptively warm up the fonts' origin. -->
	<link rel='preconnect' href='//fonts.gstatic.com/' crossorigin>
	<link rel='preconnect' href='//fonts.googleapis.com/' crossorigin>

	<!-- 2. Initiate a high-priority, asynchronous fetch for the CSS file. -->
	<!-- Works in most modern browsers. -->
	<link rel='preload'
		as='style'
		href='https://fonts.googleapis.com/css?family=Permanent+Marker:regular&#124;Nunito+Sans:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic&display=swap' />

	<!-- 3. Initiate a low-priority, asynchronous fetch that gets applied to
			the page - only after it’s arrived. Works in all browsers with
			JavaScript enabled. -->
	<link rel='stylesheet'
			href='https://fonts.googleapis.com/css?family=Permanent+Marker:regular&#124;Nunito+Sans:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic&display=swap'
			media='print' onload='this.media=&#34;all&#34;' />

	<!-- 4. In the unlikely event that a visitor has intentionally disabled
			JavaScript, fall back to the original method. The good news is that,
			although this is a render-blocking request, it can still make use of the
			preconnect which makes it marginally faster than the default. -->
	<noscript>
		<link rel='stylesheet'
			href='https://fonts.googleapis.com/css?family=Permanent+Marker:regular&#124;Nunito+Sans:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,800,800italic,900,900italic&display=swap' />
	</noscript>

	";
}
add_action( 'et_head_meta', 'apway_lightning_fast_google_fonts' );

