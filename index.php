<?php
include './php/mysql.php';
include './php/config.php';
include './php/functions.php';

db_connect();
date_default_timezone_set($cfg['prop_time_default']);

include './html/header.html';

$qy = "SELECT Day, top_x, top_y, bot_x, bot_y FROM cal";

$result = db_get($qy);

while($row=db_get_row($result)) {
	display_area($row->Day,$row->top_x,$row->top_y,$row->bot_x,$row->bot_y);
}

include './html/footer.html';
?>