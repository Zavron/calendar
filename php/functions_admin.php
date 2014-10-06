<?php
include './php/pages/admin.php';

function admin_check_login($user,$pass) {
	$qy = "SELECT Password FROM user WHERE Username LIKE '".$user."'";
	
	$result = db_get_row(db_get($qy));
	
	if($result==null) {
		return false;
	} else {
		return ($result->Password==sha1($pass));
	}
}

function admin_store_session($user) {
	$qy = "SELECT Username, access_day, access_content FROM user WHERE Username LIKE '".$user."'";
	
	$result = db_get_row(db_get($qy));
	
	if($result != null) {
		$sessiondata = array();
		
		$sessiondata['user'] = $result->Username;
		$sessiondata['access_day'] = $result->access_day;
		$sessiondata['access_content'] = $result->access_content;
	}
	
	return $sessiondata;
}

function admin_print_content_row($day, $time, $title, $show_edit, $show_delete) {
	echo "\t\t\t<tr>\n";
	echo "\t\t\t\t<td class=\"table\">".$day."</td>\n";
	echo "\t\t\t\t<td class=\"table\">".$time."</td>\n";
	echo "\t\t\t\t<td class=\"table\"><a target=\"_blank\" href=\"ajax.php?action=show&amp;day=".$day."\">".$title."</a></td>\n";
	echo "\t\t\t\t<td>".(($show_edit)?"<a href=\"?action=content&amp;view=edit&amp;day=".$day."\"><img src=\"img/edit.png\" alt=\"Bearbeiten\"></a>":"")."</td>\n";
	echo "\t\t\t\t<td>".(($show_delete)?"<a href=\"?action=content&amp;view=delete&amp;day=".$day."\"><img src=\"img/remove.png\" alt=\"L&ouml;schen\"></a>":"")."</td>\n";
	echo "\t\t\t</tr>\n";
}

function admin_print_day_row($day,$top_x,$top_y,$bot_x,$bot_y,$show_edit,$show_delete) {
	echo "\t\t\t<tr>\n";
	echo "\t\t\t\t<td class=\"table\">".$day."</td>\n";
	echo "\t\t\t\t<td class=\"table\">".$top_x."</td>\n";
	echo "\t\t\t\t<td class=\"table\">".$top_y."</td>\n";
	echo "\t\t\t\t<td class=\"table\">".$bot_x."</td>\n";
	echo "\t\t\t\t<td class=\"table\">".$bot_y."</td>\n";
	echo "\t\t\t\t<td>".(($show_edit)?"<a href=\"?action=day&amp;view=edit&amp;day=".$day."\"><img src=\"img/edit.png\" alt=\"Bearbeiten\"></a>":"")."</td>\n";
	echo "\t\t\t\t<td>".(($show_delete)?"<a href=\"?action=day&amp;view=delete&amp;day=".$day."\"><img src=\"img/remove.png\" alt=\"L&ouml;schen\"></a>":"")."</td>\n";
	echo "\t\t\t</tr>\n";
}

function admin_content_available($day) {
	$qy = "SELECT count(*) as Num FROM content WHERE Day=".$day;
	
	$result = db_get($qy);
	
	if($result == null) {
		return false;
	} else {
		$count = db_get_row($result)->Num;
		
		return ($count==0);
	}
}

function admin_content_insert($day, $title, $text, $time) {
	global $cfg;

	$time = date($cfg['prop_sql_time_conversion'],$time);
	$qy = "INSERT INTO content (Day, Time, Title, Data) VALUES(".$day.",'".$time."','".$title."','".$text."')";
	
	db_insert($qy);
}

function admin_content_update($day, $data_day, $title, $text, $time) {
	global $cfg;

	$time = date($cfg['prop_sql_time_conversion'],$time);
	$qy = "UPDATE content SET Day=".$data_day.", Time='".$time."', Title='".$title."', Data='".$text."' WHERE Day=".$day;
	
	db_insert($qy);
}

function admin_content_delete($day) {
	$qy = "DELETE FROM content WHERE Day=".$day;
	
	db_insert($qy);
}

function admin_day_available($day) {
	$qy = "SELECT count(*) as Num FROM cal WHERE Day=".$day;
	
	$result = db_get($qy);
	
	if($result == null) {
		return false;
	} else {
		$count = db_get_row($result)->Num;
		
		return ($count==0);
	}
}

function admin_day_insert($day, $top_x, $top_y, $bot_x, $bot_y) {
	$qy = "INSERT INTO cal (Day, top_x, top_y, bot_x, bot_y) VALUES (".$day.",".$top_x.",".$top_y.",".$bot_x.",".$bot_y.")";
	
	db_insert($qy);
}

function admin_day_update($day, $data_day, $top_x, $top_y, $bot_x, $bot_y) {
	$qy = "UPDATE cal SET Day=".$data_day.", top_x=".$top_x.", top_y=".$top_y.", bot_x=".$bot_x.", bot_y=".$bot_y." WHERE Day = ".$day;
	
	db_insert($qy);
}

function admin_day_delete($day) {
	$qy = "DELETE FROM cal WHERE Day=".$day;
	
	db_insert($qy);
}

function admin_check_empty($value, $numeric=false) {
	if(empty($value) || $value=="")
		return false;
	
	if($numeric) {
		if(!is_numeric($value)) {
			return false;
		}
	}
	
	return true;
}

function admin_check_date($day, $month, $year, $hour, $min) {
	global $cfg;

	if($cfg['prop_date_month_min']>$month) {
		return false;
	}
	if($cfg['prop_date_month_max']<$month) {
		return false;
	}
	if($cfg['prop_date_day_min']>$day) {
		return false;
	}
	if($cfg['prop_date_day_max'][$month]<$day) {
		return false;
	}
	if($cfg['prop_date_year_min']>$year) {
		return false;
	}
	if($cfg['prop_date_hour_min']>$hour) {
		return false;
	}
	if($cfg['prop_date_hour_max']<$hour) {
		return false;
	}
	if($cfg['prop_date_min_min']>$min) {
		return false;
	}
	if($cfg['prop_date_min_max']<$min) {
		return false;
	}
	
	return true;
}

function admin_create_date($day, $month, $year, $hour, $min) {
	$time = mktime($hour, $min, 0, $month, $day, $year);
		
	return $time;
}

function admin_redirect($path) {
	header('Location: admin.php'.$path);
}

function admin_redirect_home() {
	admin_redirect("?action=home");
}
?>