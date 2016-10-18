( function ( document, $, undefined ) {
	
	// # Contents
	// - Smooth scroll sidebar
	// - Searchbar toggle 

	$(document).ready(function(){
		// if ($('.elements-sidebar').length){
			// $(".textwidget").text("holy shit");
			// $('.textwidget').append('<ul id="contents-list"></ul>');

			// var someList = $(".component-title");
			// console.log(someList);
			// for (i = 0; i < someList.length; i++) {
			//   // $("#contents-list").append("<li>" +  someList[i]+ "</li>");
			//   // var parentId = someList[i].parent().parent().attr('id');
			//   var parentId = someList[i].parent();
			//   console.log(parentId);
			// }
			// $( ".component-title" ).each(function( index ) {
			  // console.log( index + ": " + $( this ).text() );
			//   	var theText = $( this ).text();
			//   	var theId = $(this).parent().attr('id');
			//    $("#contents-list").append('<li><a href="#'+theId+'">'  + theText + '</a></li>');
			// });
		// }

		if ($('.dls-sidebar').length){
			$('.textwidget').append('<ul id="rendered-sections-list"></ul>');

			$( ".article-title" ).each(function( index ) {
		  	var theText = $(this).text();
		  	var theId = $(this).parent().attr('id');
		  	var theSbt = $(this).parent().data('sidebarText');

		  	
		  	if (theSbt){
		  		
		  		if (!$(this).parent().hasClass('article-list-item')){
		  			$("#rendered-sections-list").append('<li><a href="#'+theId+'" class="ancestor">'  + theSbt + '</a></li>');
			  		// console.log(this, "shit dick");
			  	} else {
			  		$("#rendered-sections-list").append('<li><a href="#'+theId+'">'  + theSbt + '</a></li>');
			  	}
		  	} 
		  	// else {
		  		
		  	// 	if (!$(this).parent().hasClass('article-list-item')){
		  	// 		$("#rendered-sections-list").append('<li><a href="#'+theId+'" class="ancestor">'  + theId + '</a></li>');
			  // 		// console.log(this, "shit dick");
			  // 	} else {
			  // 		$("#rendered-sections-list").append('<li><a href="#'+theId+'">'  + theId + '</a></li>');
			  // 	}
		  	// }
			});
		}

		$('#genesis-footer-widgets .footer-widgets-1').wrapInner('<div class="dls-container"></div>');

		var dlsWidgetWrappers = $('<div class="dls-widget-outer-wrapper"><div class="dls-widget-inner-wrapper"></div></div>');

		// dlsWidgetWrappers.appendTo('#genesis-footer-widgets .wrap');
		$('#genesis-footer-widgets .wrap').append(dlsWidgetWrappers);

		var widgies = $(".footer-widgets-2, .footer-widgets-3 ").detach();

		$('.dls-widget-inner-wrapper').append(widgies);

		// calculating some values
		var header_height = $('.site-header').outerHeight(),
		  dls_menu = $('.dls-menu').outerHeight(),
		  scroll_top_icon = $('#scroll-to-top'),
		  nav = $('.dls-sidebar');
		  sections = $('.article-list-item'),
		  sipt = parseInt($('.site-inner').css('padding-top'), 10), 
		  combined_height = header_height + dls_menu;

		// Scroll to top function 1/2
		$(window).scroll(function(){
		  var $scrollTop = $(window).scrollTop();

		  // if( $scrollTop > header_height ){
		  //     scroll_top_icon.fadeIn();
		  // } else {
		  //     scroll_top_icon.fadeOut();
		  // }
		  
		  if( $scrollTop > combined_height + sipt ){
		    nav.addClass( 'sticky-sidebar' );
		  } else {
		    nav.removeClass( 'sticky-sidebar' );
		  }
		});

		$(window).scroll(function () {
		  var cur_pos = $(this).scrollTop();

		  sections.each(function() {
		    var top = $(this).offset().top,
		        bottom = top + $(this).outerHeight();

		    if (cur_pos >= top && cur_pos <= bottom) {
		      nav.find('a').removeClass('active-nav');
		      // nav.find('a').classList.add('active-nav');
		      sections.removeClass('active-nav');
		      
		      $(this).addClass('active-nav');
		      nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active-nav');
		    }
		    if (cur_pos < combined_height) {
		      nav.find('a').removeClass('active-nav');
		    }

		  });

		  $('.title-slide-alt').each(function(){
		  	var top = $(this).offset().top,
		        bottom = top + $(this).outerHeight();
        if (cur_pos >= top && cur_pos <= bottom) {
		      nav.find('a').removeClass('active-nav');
		      sections.removeClass('active-nav');
		      
		      $(this).addClass('active-nav');
		      nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active-nav');
		    }
		    if (cur_pos < combined_height) {
		      nav.find('a').removeClass('active-nav');
		    }
		  });

		});

		// - Smooth scroll sidebar
		nav.find('a').on('click', function () {
		  var $el = $(this), 
		       id = $el.attr('href');
		  
		  $('html, body').animate({
		    scrollTop: $(id).offset().top + 1
		  }, 500);
		  
		  return false;
		});

		// - Searchbar toggle
		$(".searchbar-toggle").click(function(){
		  $("#searchbar-collapse").slideToggle(180, "swing");
		});

	});
})( document, jQuery );