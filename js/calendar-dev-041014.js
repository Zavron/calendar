var error="";
$.fn.maphilight.defaults = {
	fill: true,
	fillColor: '000000',
	fillOpacity: 0.2,
	stroke: true,
	strokeColor: 'ff0000',
	strokeOpacity: 1,
	strokeWidth: 1,
	fade: true,
	alwaysOn: true,
	neverOn: false,
	groupBy: false,
	wrapClass: true,
	shadow: false,
	shadowX: 0,
	shadowY: 0,
	shadowRadius: 6,
	shadowColor: '000000',
	shadowOpacity: 0.8,
	shadowPosition: 'outside',
	shadowFrom: false
}
var areaklick=function(event) {
	event.preventDefault();
	ajaxday($(this).attr('day'));
};
var ajaxday=function(day) {
	$.ajax({
		type: "GET",
		url: "ajax.php",
		data: {action: "show", day: day},
		cache: false
	})
	.done(function(data) {
		dialogtext(data);
	}).fail(function(data) {
		dialogtext(error);		
	});
};
var dialogtext=function(text) {
	$('#dialog').html("<p>"+text+"</p>");
	$( "#dialog" ).dialog( "open" );
}
$(document).ready(function() {
	error=$('#dialog').html();
	$("#dialog").dialog({
		autoOpen: false,
		resizeable: false,
		draggable: false,
		position: {of: '.map'},
		width: pop_w,
		height: pop_h,
		buttons: [
		{
			text: unescape("Schlie%DFen"),
			click: function() {
				$( this ).dialog( "close" );
			}
		}]
	});
	$('.map').maphilight();
	$('map area').click(areaklick);
});