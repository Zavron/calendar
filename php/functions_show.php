<?php
include 'bbcodes.php';

function show_encode($text, $allow_bb = false) {
	global $input_from,$input_to;
	
	$text =str_replace("\n","<br>",$text);
	
	if($allow_bb) {
		$text=bb_resolve($text);
	}

	return $text;
}

function show_check_access() {
	global $_SESSION;
	
	if(!isset($_SESSION['userdata'])) {
		return false;
	} else {
		return $_SESSION['userdata']['access_content']>=1;
	}
}
?>