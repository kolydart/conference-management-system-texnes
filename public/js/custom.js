jQuery(document).ready(function($) {
	$("#app").css(
		{'min-height': $(window).height() - $("#gw-nav").height() - $("#gw-footer").height() -40}
	);
});