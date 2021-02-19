# wordpress-snippets
A collection of code snippets for functions.php for WordPress

## Table of Contents
- Miscellaneous
  - Activate WordPress maintenance mode
  - PrettyPrint debugging statements
  - Disable WP Admin Bar for everyone
- Cleanup
  - Remove Emojis
    - Remove emojis from front-end, back-end, RSS feeds, embeds, emails, etc.
    - Removes the emoji plugin from TinyMCE
    - Removes the emoji CDN hostname from DNS prefetching hints.
  - Remove redundant meta tags
  - Remove the WP generator tag
- Divi
  - Remove Project CPT
- Performance
  - Dequeue the Dashicons on the front end if Admin Toolbar is not in use.
  - Add DNS Prefetching and Preconnecting Resource Hints to the <head>
  - Remove query strings from resources.
  - Speed up Google Fonts
- Security
  - Disable oEmbeds 
  - Serve 404 to referrers on the current Blacklist
- Theme Snippets
  - Filter the except length to 20 words
  - Filter the "read more" excerpt string link to the post
  - Change the `Read More` text after the trimmed excerpt
  - Javascript detection
  - Remove inline gallery CSS 
  - Add SVG to the allowed mime types in the Media Library
  - Fix empty paragraph tags
  - Add theme support for loads of things, including adding async/defer to javascript
