/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

 // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

  // MIKEY custom

  // Sticky Kit for sidebar stick
  var browserWidth = $(window).width();
  if ((browserWidth > 1024)) {
    $('.sidebar').stick_in_parent({offset_top: 80})
    .on('sticky_kit:bottom', function(e) {
        $(this).parent().css('position', 'static');
    })
    .on('sticky_kit:unbottom', function(e) {
        $(this).parent().css('position', 'relative');
    });
  } else {
    $(".sidebar").trigger("sticky_kit:detach");
  }


  // Setup Headheasive for sticky navigation

  // Set options
  /*var options = {
    offset: '.fixed-nav-activator',
    classes: {
      // Cloned elem class
      clone: 'headhesive',

      // Stick class
      stick: 'headhesive--stick',

      // Unstick class
      unstick: 'headhesive--unstick'
    },
    // Throttle scroll event to fire every 250ms to improve performace
    throttle: 250,
  };

  // Sticky header courtesy of Headhesive.js, Create a new instance of Headhesive
  var header = new Headhesive('.white-wrapper', options);*/

  // Fitvids
  $(".featured-video").fitVids();
  $(".entry-content").fitVids();
  $(".featured-video-plus").fitVids();

  // BX Slider - product image pages

/*  $('.bxslider').bxSlider({
    mode: 'vertical',
    autoStart: 'false',
    infiniteLoop: 'true',
    controls: 'true',
    preloadImage: 'visible',
    pager: ($(".bxslider li").length > 1) ? true: false,
    onSliderLoad: function(currentIndex){
      $(".feature-slider").css("visibility", "visible");
      $(".pre-loader").css("display", "none");
    },
    onSlideAfter: function($el, oldIndex, newIndex){
        var iSrc = $( slider[oldIndex] ).find('iframe').attr('src');
        $( slider[oldIndex] ).find('iframe').attr('src', iSrc);
    }
  });*/
 /*
  // MMenu
  $("#my-menu").mmenu({
     "extensions": [
        "border-full",
        "effect-slide-menu",
        null,
        "pageshadow",
        "theme-dark"
     ],
     "navbar": {
        "title": "MENU"
     },
     "navbars": [
        {
           "position": "top",
           "content": [
              "prev",
              "title",
              "close"
           ]
        },
        {
           "position": "bottom",
           "content": [
              "<a class='fa fa-facebook' href='http://www.facebook.com/pages/DAMNmagazine/27113480473'></a>",
              "<a class='fa fa-twitter' href='https://twitter.com/DAMNtwice'></a>",
              "<a class='fa fa-vimeo' href='https://vimeo.com/damnmagazine/videos'></a>",
              "<a class='fa fa-instagram' href='https://instagram.com/damn_magazine'></a>",
              "<a class='fa fa-linkedin' href='http://www.linkedin.com/company/damn-magazine'></a>",
              "<a class='fa fa-pinterest href='http://pinterest.com/damnmagazine/'></a>"
           ]
        }
     ]
  });
*/
	// Simple Lightbox for galleries
	var lightbox = $('.gallery-wrapper a').simpleLightbox({
		captionsData: 'alt',
		closeText: '<i class="fa fa-times-circle fa-2x"></i>'
	});
	
	
	/**
	 *	Issue Selector
	 *	Select a recent issue in the header
	 */
	$('.issue-selector').on('click', function ()
	{
		$('header').toggleClass ('issued');
		
		return !$('header').hasClass ('issued');
	});
	
	
	
})(jQuery); // Fully reference jQuery after this point.

