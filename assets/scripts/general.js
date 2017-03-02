jQuery(document).ready(function($) {
	
	$('.fancybox').fancybox();

	$('img.carousel').each(function(index, el) {
		$(this).click(function(event) {
			$($('.fancybox')[index]).trigger('click');
		});
	});


});