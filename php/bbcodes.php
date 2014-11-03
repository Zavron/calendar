<?php

$bb_strings = array("url","u","i","b","img","limg","rimg","left","center","right","youtube","delim");
$bb_replace = array("<a target=\"_blank\" href=\"!!\">??</a>","<div class=\"u\">!!</div>","<div class=\"i\">!!</div>","<div class=\"b\">!!</div>","<img src=\"!!\"/>","<img class=\"fleft\" src=\"!!\"/>","<img class=\"fright\" src=\"!!\"/>","<div class=\"left\">!!</div>","<div class=\"center\">!!</div>","<div class=\"right\">!!</div>","<div class=\"center\"><iframe width=\"640\" height=\"360\" src=\"//www.youtube.com/embed/!!?rel=0&amp;showinfo=0\" frameborder=\"0\" allowfullscreen></iframe></div>","<div class=\"delim\"></div>");
$bb_advanced = array("url","img","limg","rimg");

function bb_resolve($text) {
	global $bb_strings,$bb_replace,$bb_advanced;
	
	for($i=0;$i<count($bb_strings);$i++) {
		$matches = bb_private_get_matches($text, $bb_strings[$i]);
		
		$keys=$matches[0];
		$vals=$matches[1];
		
		for($k=0;$k<count($keys);$k++) {
			if(in_array($bb_strings[$i],$bb_advanced)) {
				$replacement = bb_private_resolve_advanced($vals[$k],$bb_strings[$i],$bb_replace[$i]);
			} else {
				$replacement = str_replace("!!",$vals[$k],$bb_replace[$i]);
			}
			
			$text=str_replace($keys[$k],$replacement,$text);			
		}
	}
	
	return $text;
}

function bb_private_get_matches($text, $bbstring) {
	$delimiter = '#';
	$startTag = '['.$bbstring.']';
	$endTag = '[/'.$bbstring.']';
	$regex = $delimiter . preg_quote($startTag, $delimiter) 
                    . '(.*?)' 
                    . preg_quote($endTag, $delimiter) 
                    . $delimiter 
                    . 's';
	preg_match_all($regex,$text,$matches);
	
	return $matches;
}

function bb_private_resolve_advanced($value,$tag,$default) {
	if(bb_private_is_image_tag($tag)) {
		return bb_private_advanced_image($value,$tag,$default);
	} else if($tag=='url') {
		return bb_private_advanced_url($value,$default);
	} else {
		return "Unhandled advanced case. No handler for \"".$tag."\"";
	}
}

function bb_private_is_image_tag($tag) {
	return (strpos($tag, 'img') !== FALSE);
}

function bb_private_advanced_image($value, $tag, $default) {
	global $cfg;
	
	$split = explode(";",$value);
	
	$replacement = $value;
	
	if(count($split)==3) {
		$replacement = bb_private_advanced_image_get_replacement($split, $value);
	}
	
	return str_replace("!!",$replacement,$default);
}

function bb_private_advanced_image_get_replacement($split, $default) {
	global $cfg;

	$url = $split[0];
	$width = $split[1];
	$height = $split[2];
	
	$valid_w = (is_numeric($width))?true:(($width=='max')?true:false);
	$valid_h = (is_numeric($height))?true:(($height=='max')?true:false);
	
	if($valid_w && $valid_h) {
		$width = str_replace('max',($cfg['prop_pop_w']-30),$width);
		$height = str_replace('max',($cfg['prop_pop_h']-80),$height);
		
		return $url."\" width=\"".$width."\" height=\"".$height;
	} else {
		return $default;
	}
}

function bb_private_advanced_url($value,$default) {
	$split = explode(";",$value);
	
	$url = $text = $value;
	
	if(count($split)==2) {
		$url = $split[0];
		$text = $split[1];
	}
	
	$ret = str_replace("!!",$url,$default);
	$ret = str_replace("??",$text,$ret);
	
	return $ret;
}
?>