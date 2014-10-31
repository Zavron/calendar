var error="";
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
	$('map area').click(areaklick);
});