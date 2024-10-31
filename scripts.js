/* add wrapper to embeds */
jQuery(document).ready(function($) {
	$('iframe,object,embed,.wp-video,.mejs-container,video,.mejs-layer').wrap( '<div class="iframe-container"></div>' );
});
