$(function() {
	$( "#winenot-menu li:first-of-type" ).on('click', function() {
		$(this).children('ul').toggle();
	});	
}); 