<?php
include 'bbcodes.php';

function ajax_encode($text, $allow_bb = false, $do_encode = true) {
	global $input_from,$input_to;
	
	$text =str_replace("\n","<br>",$text);
	
	if($allow_bb) {
		$text=bb_resolve($text);
	}
	
	if($do_encode) {
		$text = utf8_encode($text);
	}

	return $text;
}

function ajax_check_access() {
	global $_SESSION;
	
	if(!isset($_SESSION['userdata'])) {
		return false;
	} else {
		return $_SESSION['userdata']['access_content']>=1;
	}
}
?>