<?php
session_start();

include './php/config.php';
include './php/mysql.php';
include './php/functions_show.php';

db_connect();
date_default_timezone_set($cfg['prop_time_default']);

$day = db_escape($_GET['day']);

$qy = "SELECT Title, Time, Data FROM content WHERE Day=".$day;
	
$result = db_get($qy);
if($result!=null) {
	$result = db_get_row($result);
}
	
if($result==null) {
	include './html/show_notyet.html';
} else {
	$time_cur = time();
	$time_unlock = date_create_from_format($cfg['prop_sql_time_conversion'], $result->Time)->getTimestamp();
		
	if($time_cur < $time_unlock) {
		if(show_check_access()) {
			$title = show_encode($result->Title, false);
			$text = show_encode($result->Data, true);
			include './html/admin_show.html';
		} else {
			include './html/show_notyet.html';
		}
	} else {
		$title = show_encode($result->Title, false);
		$text = show_encode($result->Data, true);
		include './html/show_content.html';
	}
}
?>