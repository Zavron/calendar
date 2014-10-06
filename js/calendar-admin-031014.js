var area;
var selecttext=function() {
	var start = area[0].selectionStart;
	var end = area[0].selectionEnd;
	return area.val().substring(start, end);
}
var doWrap=function(open, close) {
    var len = area.val().length;
	var start = area[0].selectionStart;
	var end = area[0].selectionEnd;
    var selectedText = selecttext();
    var replacement = open + selectedText + close;
    area.val(area.val().substring(0, start) + replacement + area.val().substring(end, len));
}
var extendWrap=function(open, close, content) {
	var len = area.val().length;
	var start = area[0].selectionStart;
	var end = area[0].selectionEnd;
	var selectedText = selecttext();
	var text = open + content + selectedText + close;
	area.val(area.val().substring(0, start) + text + area.val().substring(end, len));
}
var promptname = function() {
	var text = prompt(unescape("Name f%FCr den Link eingeben.%28Leer f%FCr keinen Text%29"),"");
	
	if(text==null) {
		return "";
	}
	
	return text;
}
var prompturl = function() {
	var text = prompt("Link eingeben","");
	
	if(text==null) {
		return "";
	}
	
	return text;
}
var createurl = function() {
	if(selecttext()=="") {
		var url = prompturl();
		
		if(url!="") {
			extendWrap('[url]','[/url]',url);
		}		
	} else {
		var text = promptname();
		
		if(text=="") {
			doWrap('[url]','[/url]');
		} else {
			extendWrap('[url]','[/url]',text+";");
		}
	}
}
var editorclick=function(event) {
	event.preventDefault();
	var tag = $(this).attr('shortcut');
	
	if(tag=='url') {
		createurl();
	} else {
		doWrap('['+tag+']','[/'+tag+']');
	}
	
}
var previewclick=function(event) {
	event.preventDefault();
	ajaxpreview();
}
var ajaxpreview=function() {
	$.ajax({
		type: "POST",
		url: "ajax.php?action=preview",
		data: {content: area.html(), title: $('input[name=title]').val()},
		cache: false
	})
	.done(function(data) {
		previewtext(data);		
	}).fail(function(data) {
		$('#wrap_preview').hide();
	});
}
var previewtext=function(data) {
	$('#preview').html(data);
	$('#wrap_preview').show();
}
var hideclick=function(event) {
	event.preventDefault();
	$('#wrap_preview').hide();
}
$(document).ready(function() {
	area = $('#area');
	$('.b_editor').click(editorclick);
	$('#b_preview').click(previewclick);
	$('#b_hide').click(hideclick);
});