( function ( document, $, undefined ) {
	
	$(document).ready(function(){
		// console.log("This is a test");
		if ($('.print-sidebar').length){
			// $(".textwidget").text("holy shit");
			$('.textwidget').append('<ul id="contents-list"></ul>');

			// var someList = $(".component-title");
			// console.log(someList);
			// for (i = 0; i < someList.length; i++) {
			//   // $("#contents-list").append("<li>" +  someList[i]+ "</li>");
			//   // var parentId = someList[i].parent().parent().attr('id');
			//   var parentId = someList[i].parent();
			//   console.log(parentId);
			// }
			$( ".component-title" ).each(function( index ) {
			  // console.log( index + ": " + $( this ).text() );
			  	var theText = $( this ).text();
			  	var theId = $(this).parent().attr('id');
			   $("#contents-list").append('<li><a href="#'+theId+'">'  + theText + '</a></li>');
			});
		}

		$('#genesis-footer-widgets .footer-widgets-1').wrapInner('<div class="dls-container"></div>');

		var dlsWidgetWrappers = $('<div class="dls-widget-outer-wrapper"><div class="dls-widget-inner-wrapper"></div></div>');

		// dlsWidgetWrappers.appendTo('#genesis-footer-widgets .wrap');
		$('#genesis-footer-widgets .wrap').append(dlsWidgetWrappers);

		var widgies = $(".footer-widgets-2, .footer-widgets-3 ").detach();

		$('.dls-widget-inner-wrapper').append(widgies);
		console.log("check");
	});

})( document, jQuery );