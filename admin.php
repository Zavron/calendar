<?php
include './php/config.php';
include './php/mysql.php';
include './php/functions_admin.php';

db_connect();
date_default_timezone_set($cfg['prop_time_default']);

if($cfg['mode_admin']) {
	session_start();

	$session = isset($_SESSION['userdata']);

	if(!$session) {
		if(isset($_POST['do'])) {
			$user = db_escape($_POST['username']);
			$pass = $_POST['pass'];
			
			if(admin_check_login($user,$pass)) {
				$_SESSION['userdata'] = admin_store_session($user);
			}
			
			admin_redirect_home();
		} else {
			include './html/admin_login.html';		
		}		
	} else {
		$userdata = $_SESSION['userdata'];
		
		$action = isset($_GET['action'])?$_GET['action']:'home';
		$view = isset($_GET['view'])?$_GET['view']:'';
		
		if($action=='day') {
			if($userdata['access_day']<1) {
				admin_redirect_home();
			}
			
			if($view=='add') {
				$do = isset($_POST['do']);
				
				if($userdata['access_day']<2) {
					admin_redirect_home();
				}
				
				if($do) {
					$data_day = $_POST['day'];
					$data_top_x = $_POST['top_x'];
					$data_top_y = $_POST['top_y'];
					$data_bot_x = $_POST['bot_x'];
					$data_bot_y = $_POST['bot_y'];
					
					if(admin_check_empty($data_day,true) AND admin_check_empty($data_top_x,true) AND admin_check_empty($data_top_y,true) AND admin_check_empty($data_bot_x,true) AND admin_check_empty($data_bot_y,true)) {
						if(admin_day_available($data_day)) {
							admin_day_insert($data_day,$data_top_x,$data_top_y,$data_bot_x,$data_bot_y);
							admin_redirect("?action=day&view=home");
						} else {
							admin_page_day_add_error("ERROR_DAY");
						}
					} else {
						admin_page_day_add_error("ERROR_FILL");
					}
				} else {				
					admin_page_day_add();
				}
			} else if($view == 'edit') {
				$day = (isset($_GET['day']))?$_GET['day']:-1;
				$do = isset($_POST['do']);
				
				if($userdata['access_day']<2 OR $day == -1 OR !is_numeric($day)) {
					admin_redirect_home();
				}
				
				if($do) {
					$data_day = $_POST['day'];
					$data_top_x = $_POST['top_x'];
					$data_top_y = $_POST['top_y'];
					$data_bot_x = $_POST['bot_x'];
					$data_bot_y = $_POST['bot_y'];
					
					if(admin_check_empty($data_day,true) AND admin_check_empty($data_top_x,true) AND admin_check_empty($data_top_y,true) AND admin_check_empty($data_bot_x,true) AND admin_check_empty($data_bot_y,true)) {
						if($day==$data_day OR admin_day_available($data_day)) {
							admin_day_update($day, $data_day,$data_top_x,$data_top_y,$data_bot_x,$data_bot_y);
							admin_redirect("?action=day&view=home");
						} else {
							admin_page_day_edit_error($day,"ERROR_DAY");
						}
					} else {
						admin_page_day_edit_error($day,"ERROR_FILL");
					}					
				} else {
					admin_page_day_edit($day);
				}
			} else if($view == 'delete') {
				$day = (isset($_GET['day']))?$_GET['day']:-1;
				$do = isset($_GET['do']);
				
				if($userdata['access_day']<2 OR $day == -1 OR !is_numeric($day)) {
					admin_redirect_home();
				}
				
				if($do) {
					admin_day_delete($day);
					admin_redirect("?action=day&view=home");
				} else {
					admin_page_day_delete($day);
				}
			} else {
				admin_page_day_home();
			}
		} else if($action=='content') {
			if($userdata['access_day']<1) {
				admin_redirect_home();
			}
			
			if($view == 'add') {
				$do = isset($_POST['do']);
			
				if($userdata['access_day']<2) {
					admin_redirect_home();
				}
			
				if($do) {
					$data_day = $_POST['day'];
					$data_unlock_day = $_POST['unlock_day'];
					$data_unlock_month = $_POST['unlock_month'];
					$data_unlock_year = $_POST['unlock_year'];
					$data_unlock_hour = $_POST['unlock_hour'];
					$data_unlock_min = $_POST['unlock_min'];
					$data_title = $_POST['title'];
					$data_text = $_POST['text'];
					
					if(admin_check_empty($data_day, true) AND admin_check_empty($data_unlock_day, true) AND admin_check_empty($data_unlock_month, true) AND admin_check_empty($data_unlock_year, true) AND admin_check_empty($data_unlock_hour, true) AND admin_check_empty($data_unlock_min, true) AND admin_check_empty($data_title)) {
						if(admin_check_date($data_unlock_day, $data_unlock_month, $data_unlock_year, $data_unlock_hour, $data_unlock_min)) {
							if(admin_content_available($data_day)) {
								admin_content_insert($data_day, $data_title, $data_text, admin_create_date($data_unlock_day, $data_unlock_month, $data_unlock_year, $data_unlock_hour, $data_unlock_min));
								admin_redirect("?action=content&view=home");
							} else {
								admin_page_content_add_error("ERROR_DAY");
							}
						} else {
							admin_page_content_add_error("ERROR_DATE");
						}
					} else {
						admin_page_content_add_error("ERROR_FILL");
					}
				} else {
					admin_page_content_add();
				}				
			} else if($view == 'edit') {
				$do = isset($_POST['do']);
				$day = (isset($_GET['day']))?$_GET['day']:-1;

			
				if($userdata['access_day']<2) {
					admin_redirect_home();
				}
				
				if($do) {
					$data_day = $_POST['day'];
					$data_unlock_day = $_POST['unlock_day'];
					$data_unlock_month = $_POST['unlock_month'];
					$data_unlock_year = $_POST['unlock_year'];
					$data_unlock_hour = $_POST['unlock_hour'];
					$data_unlock_min = $_POST['unlock_min'];
					$data_title = $_POST['title'];
					$data_text = $_POST['text'];
					
					if(admin_check_empty($data_day, true) AND admin_check_empty($data_unlock_day, true) AND admin_check_empty($data_unlock_month, true) AND admin_check_empty($data_unlock_year, true) AND admin_check_empty($data_unlock_hour, true) AND admin_check_empty($data_unlock_min, true) AND admin_check_empty($data_title)) {
						if(admin_check_date($data_unlock_day, $data_unlock_month, $data_unlock_year, $data_unlock_hour, $data_unlock_min)) {
							if($day==$data_day OR admin_content_available($data_day)) {
								admin_content_update($day, $data_day, $data_title, $data_text, admin_create_date($data_unlock_day, $data_unlock_month, $data_unlock_year, $data_unlock_hour, $data_unlock_min));
								admin_redirect("?action=content&view=home");
							} else {
								admin_page_content_edit_error($day, "ERROR_DAY");
							}
						} else {
							admin_page_content_edit_error($day, "ERROR_DATE");
						}
					} else {
						admin_page_content_edit_error($day, "ERROR_FILL");
					}
					
				} else {
					admin_page_content_edit($day);
				}
			} else if($view == 'delete') {
				$day = (isset($_GET['day']))?$_GET['day']:-1;
				$do = isset($_GET['do']);
				
				if($userdata['access_day']<2 OR $day == -1 OR !is_numeric($day)) {
					admin_redirect_home();
				}
				
				if($do) {
					admin_content_delete($day);
					admin_redirect("?action=content&view=home");
				} else {
					admin_page_content_delete($day);
				}
			} else {
				admin_page_content_home();
			}
			
		} else if($action=='logout') {
			session_destroy();
			admin_redirect_home();
		} else {
			admin_page_home();
		}
	}
} else {
	include './html/admin_disabled.html';
}
?>