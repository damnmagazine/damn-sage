jQuery(document).ready(function($) {

	/*$('.offside-users-alphabet-menu ul li a').hide();

	$('.offside-users-alphabet-menu ul li a').click(function(event) {

		event.preventDefault();
		var target = $(this).attr('href');

		$('html,body').animate( {scrollTop: $(target).offset().top - 92 }, 'slow' );

	});


	$('.offside-users-alphabet-menu ul li').each(function(index, el) {
		$(this).hover(function() {
			$(this).find('a').show();
			$(this).stop().animate( {
				'width': '55px',
				'height': '30px'
			}, 'fast');
		
		}, function() {
			
			$(this).stop().animate( {
				'width': '25px',
				'height': '15px'
			}, 'fast');
			$(this).find('a').hide();
		});


	});*/

	/*
	* Homepage slider
	 
	 $("#slides").slidesjs({

		navigation: {
			active: true,
			effect: "slide"

		},
		 play: {
			active: false,
			effect: "slide",
			interval: 4000,
			auto: true,
			swap: true,
			pauseOnHover: false,
			restartDelay: 2500
		},
		 pagination: {
		  active: true
		},
		 callback: {
		  loaded: function() {
			$('.width-pusher').remove();
		  },
		}
	});*/


	/** 
	 * Index pop up windwow
	
	setTimeout(function(){

		// check localstorage
		var current = new Date().getTime();

		if( localStorage.popupStarter !== 'true' || localStorage.popupTime < current ){

			var popupTime = new Date().getTime() + 60 * 60 * 24 * 1000;

			if( $(window).width() >= 1030 ){

				$('#popup-bg').fadeIn('fast');
				$('#popup-content').fadeIn('fast');
				
				$('#popup-bg').click(function(event) {
					$(this).hide();
					$('#popup-content').hide();

					//set localstorage
					localStorage.popupStarter = true;
					localStorage.popupTime = popupTime;

				});

				$('.close-popup').click(function(event) {
					event.preventDefault();
					$('#popup-bg').hide();
					$('#popup-content').hide();

					//set localstorage
					localStorage.popupStarter = true;
					localStorage.popupTime = popupTime;

				});

			} else if( $(window).width() < 1030 ){

				$('#popup-bg').fadeIn('fast');
				$('#popup-content-mobile').fadeIn('fast');
				
				$('#popup-bg').click(function(event) {
					$(this).hide();
					$('#popup-content-mobile').hide();

					//set localstorage
					localStorage.popupStarter = true;
					localStorage.popupTime = popupTime;
				});

				$('.close-popup').click(function(event) {
					event.preventDefault();
					$('#popup-bg').hide();
					$('#popup-content-mobile').hide();

					//set localstorage
					localStorage.popupStarter = true;
					localStorage.popupTime = popupTime;
				});

			}

		}

	}, 5000); */

});