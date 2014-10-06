<?php

$bb_strings = array("url","u","i","b","img","limg","rimg","left","center","right","youtube","delim");
$bb_replace = array("<a target=\"_blank\" href=\"!!\">??</a>","<div class=\"u\">!!</div>","<div class=\"i\">!!</div>","<div class=\"b\">!!</div>","<img src=\"!!\"/>","<img class=\"fleft\" src=\"!!\"/>","<img class=\"fright\" src=\"!!\"/>","<div class=\"left\">!!</div>","<div class=\"center\">!!</div>","<div class=\"right\">!!</div>","<div class=\"center\"><iframe width=\"640\" height=\"360\" src=\"//www.youtube.com/embed/!!?rel=0&amp;showinfo=0\" frameborder=\"0\" allowfullscreen></iframe></div>","<div class=\"delim\"></div>");

function bb_resolve($text) {
	global $bb_strings,$bb_replace;
	
	for($i=0;$i<count($bb_strings);$i++) {
		$matches = bb_private_get_matches($text, $bb_strings[$i]);
		
		$keys=$matches[0];
		$vals=$matches[1];
		
		for($k=0;$k<count($keys);$k++) {			
			if($bb_strings[$i]=='url') {
				$split = explode(";",$vals[$k]);
				
				if(count($split)==2) {
					$replacement = str_replace("!!",$split[0],$bb_replace[$i]);
					$replacement = str_replace("??",$split[1],$replacement);
				} else {
					$replacement = str_replace("!!",$vals[$k],$bb_replace[$i]);
					$replacement = str_replace("??",$vals[$k],$replacement);
				}
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
?>