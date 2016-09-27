( function ( document, $, undefined ) {
	
	$(document).ready(function(){
		if ($(".print-sidebar").length){
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
	});

})( document, jQuery );