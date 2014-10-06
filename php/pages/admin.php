<?php
$content_error=array("ERROR_DAY" => $cfg['str_admin_content_error_day'], "ERROR_DATE" => $cfg['str_admin_content_error_date'], "ERROR_FILL" => $cfg['str_admin_content_error_fill']);
$day_error=array("ERROR_DAY" => $cfg['str_admin_day_error_day'], "ERROR_FILL" => $cfg['str_admin_day_error_fill']);

function admin_page_home() {
	global $cfg, $userdata;
	
	$user = $userdata['user'];
	
	include './html/admin_home_header.html';
		if($userdata['access_day']>=1) {
			echo "<li><a href=\"?action=day&amp;view=home\">".$cfg['str_admin_day']."</a></li>\n";
		}
		if($userdata['access_content']>=1) {
			echo "\t\t\t<li><a href=\"?action=content&amp;view=home\">".$cfg['str_admin_content']."</a></li>\n";
		}
	include './html/admin_home_footer.html';
}

function admin_page_day_home() {
	global $cfg, $userdata;
	
	$advanced = $userdata['access_day']>=2;
	
	$qy = "SELECT Day, top_x, top_y, bot_x, bot_y FROM cal ORDER BY Day ASC";
		
	$result = db_get($qy);
	
	include './html/admin_day_home_header.html';
	
	while($row=db_get_row($result)) {
		admin_print_day_row($row->Day,$row->top_x,$row->top_y,$row->bot_x,$row->bot_y,$advanced,$advanced);
	}
	
	include './html/admin_day_home_tableend.html';
	
	if($advanced) {
		echo "<a href=\"?action=day&amp;view=add\">".$cfg['str_entry_add']."</a>\n";
	}
	
	include './html/admin_day_home_footer.html';
}

function admin_page_day_add() {
	global $cfg, $userdata;
	
	$day = "";
	$top_x = "";
	$top_y = "";
	$bot_x = "";
	$bot_y = "";
	
	include './html/admin_day_modify.html';
}

function admin_page_day_add_error($error) {
	global $cfg, $day_error;
	
	$text = $day_error[$error];
	$back = "?action=day&amp;view=add";
	
	include './html/admin_error.html';
}

function admin_page_day_edit($day) {
	global $cfg;
	
	$qy = "SELECT top_x, top_y, bot_x, bot_y FROM cal WHERE Day = ".$day;
	
	$result = db_get($qy);
	
	if($result!=null) {
		$row = db_get_row($result);
		
		if($row==null) {
			admin_redirect_home();
		}
		
		$top_x = $row->top_x;
		$top_y = $row->top_y;
		$bot_x = $row->bot_x;
		$bot_y = $row->bot_y;
		
		include './html/admin_day_modify.html';
	} else {
		admin_redirect_home();
	}
}

function admin_page_day_edit_error($day,  $error) {
	global $cfg, $day_error;
	
	$text = $day_error[$error];
	$back = "?action=day&amp;view=edit&amp;day=".$day;
	
	include './html/admin_error.html';
}

function admin_page_day_delete($day) {
	global $cfg;
	
	include './html/admin_day_delete.html';
}

function admin_page_content_home() {
	global $cfg, $userdata;
	
	$advanced = $userdata['access_content']>=2;
	
	$qy = "SELECT Day, Time, Title FROM content ORDER BY Day ASC";
	
	$result = db_get($qy);
	
	include './html/admin_content_home_header.html';
	
	while($row = db_get_row($result)) {
		admin_print_content_row($row->Day,$row->Time,$row->Title,$advanced,$advanced);
	}
	
	include './html/admin_content_home_tableend.html';
	
	if($advanced) {
		echo "<a href=\"?action=content&amp;view=add\">".$cfg['str_entry_add']."</a>";
	}
	
	include './html/admin_content_home_footer.html';
}

function admin_page_content_add() {
	global $cfg;
	
	$day = "";
	$unlock_day = "";
	$unlock_month = "";
	$unlock_year = "";
	$unlock_hour = "";
	$unlock_min = "";
	$title = "";
	$text = "";
	
	include './html/admin_content_modify.html';
}

function admin_page_content_add_error($error) {
	global $cfg, $content_error;
	
	$text = $content_error[$error];
	$back = "?action=content&amp;view=add";
	
	include './html/admin_error.html';
}

function admin_page_content_edit($day) {
	global $cfg;
	
	$qy = "Select Day, Time, Title, Data FROM content WHERE Day=".$day;
	
	$result = db_get($qy);
	
	if($result==null) {
		admin_redirect_home();
	}
	
	$row = db_get_row($result);
	
	if($row == null) {
		admin_redirect_home();
	}
	
	$time = date_create_from_format($cfg['prop_sql_time_conversion'], $row->Time)->getTimestamp();
	
	$day = $row->Day;
	$title = $row->Title;
	$text = $row->Data;
	$unlock_day = date("d", $time);
	$unlock_month = date("m", $time);
	$unlock_year = date("Y", $time);
	$unlock_hour = date("H", $time);
	$unlock_min = date("i", $time);
		
	include './html/admin_content_modify.html';	
}

function admin_page_content_edit_error($day, $error) {
	global $cfg, $content_error;
	
	$text = $content_error[$error];
	$back = "?action=content&amp;view=edit&amp;day=".$day;
	
	include './html/admin_error.html';
}

function admin_page_content_delete($day) {
	global $cfg;
	
	include './html/admin_content_delete.html';
}
?>