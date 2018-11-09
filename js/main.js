// JavaScript Document
jQuery(function($) {'use strict',

	//#main-slider
	
	
	//Animated WOW JS
	new WOW().init();
	
	//Fancybox Popup
	$(document).ready(function() {
		$('.fancybox').fancybox({
			wrapCSS    : 'fancybox-custom',
			closeClick : true,
			openEffect : 'none',
			helpers : {
				title : {
					type : 'inside'
				},
				overlay : {
					css : {
						'background' : 'rgba(238,238,238,0.85)'
					}
				}
			}
		});

			/*for fixed size*/
			/*$('a.fxsize').fancybox({
			autoDimensions: false,
			height: 300,
			width: 400
			});*/
		
			
		});
		
		
	

		
	
	/* Responsive Fade Gallery */
	
      // Banner Gallery
      $("#banner").responsiveSlides({
        maxwidth: 1170,
        speed: 800,
		auto: true,
        pager: false,
        nav: true,
        namespace: "callbacks"
      });
	  
	  // Slideshow simple fade (slider1)
      $("#slider1").responsiveSlides({
        maxwidth: 800,
        speed: 800,
		 auto: true
	 });
	 
	 // Slideshow with bullet
      $("#slider2").responsiveSlides({
        maxwidth: 800,
        speed: 800,
		 auto: true,             // Boolean: Animate automatically, true or false
		 pager: true,           // Boolean: Show pager, true or false
		 pauseControls: true    // Boolean: Pause when hovering controls, true or false

	 });
	
	
	
	// Owl Slider
	 $(document).ready(function() {
      $("#owl-news").owlCarousel({
        autoPlay: 3000,
        items : 3,
		pagination : false,
		navigation : false,
		singleItem:false,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,2]
      });
	  
	  $("#owl-news-inner").owlCarousel({
        autoPlay: 3000,
        items : 1,
		pagination : false,
		navigation : true,
		singleItem:true
      });
	  
	  
	  
	  $("#owl-missing").owlCarousel({
        autoPlay: 8000,
		pagination : false,
		navigation : false,
		singleItem:true,
      });
	  $("#owl-wanted").owlCarousel({
        autoPlay: 8000,
		pagination : false,
		navigation : false,
		singleItem:true
      });
	  $("#owl-lost").owlCarousel({
        autoPlay: 8000,
		pagination : false,
		navigation : false,
		singleItem:true
      });
	  
	  $("#owl-events").owlCarousel({
        autoPlay: 3000,
		pagination : false,
		navigation : false,
		singleItem:true
      });
	  $("#owl-events-inner").owlCarousel({
        autoPlay: 3000,
		pagination : false,
		navigation : false,
		singleItem:true
      });
	  
	  $("#owl-service").owlCarousel({
        autoPlay: 3000,
        items : 4,
		pagination : false,
		navigation : true,
        itemsDesktop : [1199,4],
        itemsDesktopSmall : [979,3]
      });
	  
	});
		
	
	// Responsive tab
	      $( '#myTab a' ).click( function ( e ) {
        e.preventDefault();
        $( this ).tab( 'show' );
      } );

      $( '#moreTabs a' ).click( function ( e ) {
        e.preventDefault();
        $( this ).tab( 'show' );
      } );

      ( function( $ ) {
          // Test for making sure event are maintained
          $( '.js-alert-test' ).click( function () {
            alert( 'Button Clicked: Event was maintained' );
          } );
          fakewaffle.responsiveTabs( [ 'xs', 'sm' ] );
      } )( jQuery );

	
	
	// Date Picker
	$(document).ready(function () {

		$('.datetimepicker').datepicker({
			format: "dd-mm-yyyy"
		});  
	
	});		
	
});