<?php

$db_host="";
$db_user="";
$db_pass="";
$db_name="";
$db;

function db_connect() {
	global $db_host,$db_user,$db_pass,$db_name,$db;
	
	$db=new mysqli($db_host,$db_user,$db_pass,$db_name);
	
	if(mysqli_connect_errno()) {
		printf("Verbindung fehlgeschlagen: %s\n",mysqli_connect_errno());
		exit();
	}
}

function db_insert($qystring) {
	global $db;
	
	$db->query($qystring);
}

function db_get($qystring) {
	global $db;

	$result = $db->query($qystring);
	
	return $result;
}

function db_get_row($result) {
	$row = $result->fetch_object();
	
	return $row;
}

function db_escape($string) {
	global $db;
	
	$escaped = $db->real_escape_string($string);
	
	return $escaped;
}