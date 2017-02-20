jQuery(document).ready(function($) {

	$('.ajax-load-more').click(function(event) {
		event.preventDefault();

		$.ajax({
			url: click_object.ajax_url,
			type: 'post',
			data: {
				action: 'ajax_load'
			},
			success: function( result ) {

				$('.ajax-loaded').append(result);
				$('.ajax-load-more').hide();
			}
		})

	});


});