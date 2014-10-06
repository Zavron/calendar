<?php
session_start();

include './php/config.php';
include './php/mysql.php';
include './php/functions_ajax.php';

db_connect();
date_default_timezone_set($cfg['prop_time_default']);

$action = (isset($_GET['action']))?$_GET['action']:(isset($_POST['action'])?$_POST['action']:'');
$day = (isset($_GET['day']))?db_escape($_GET['day']):-1;

if($action=='show') {
	$qy = "SELECT Title, Time, Data FROM content WHERE Day=".$day;
	
	$result = db_get($qy);
	if($result!=null) {
		$result = db_get_row($result);
	}
	
	if($result==null) {
		include './html/ajax_notyet.html';
	} else {
		$time_cur = time();
		$time_unlock = date_create_from_format($cfg['prop_sql_time_conversion'], $result->Time)->getTimestamp();
		
		if($time_cur < $time_unlock) {
			if(ajax_check_access()) {
				$title = ajax_encode($result->Title, false);
				$text = ajax_encode($result->Data, true);
				include './html/admin_ajax.html';
			} else {
				include './html/ajax_notyet.html';
			}
		} else {
			$title = ajax_encode($result->Title, false);
			$text = ajax_encode($result->Data, true);
			include './html/ajax_content.html';
		}
	}
} else if($action=='preview') {
	$title = $_POST['title'];
	$content = $_POST['content'];
	
	$title = ajax_encode($title, false, false);
	$text = ajax_encode($content, true, false);
	include './html/ajax_content.html';
}
?>