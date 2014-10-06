<?php
/* Development Mode includes maphighlight.js and uses 'path_script-dev' instead of 'path_script' */
$cfg['mode_dev'] = false;
/* Admin Mode enables login via 'admin.php' and allows modification */
$cfg['mode_admin'] = true;

/* The Page's HTML Title*/
$cfg['str_title'] = "Seitentitel";
/* The message shown if access was denied (too early or not available) */
$cfg['str_notyet'] = "Noch ist es nicht soweit, habe noch etwas Geduld!";
/* The message shown if an error occured during content load */
$cfg['str_error'] = "Beim Abrufen des Inhalts ist ein Fehler aufgetreten, bitte versuche es sp&auml;ter noch einmal.";
/* The string for any button with value 'yes' */
$cfg['str_yes'] = "Ja";
/* The string for any button with value 'no' */
$cfg['str_no'] = "Nein";
/* The string for any submit button */
$cfg['str_submit'] = "Daten absenden'";
/* The string for any reset button */
$cfg['str_reset'] = "Zur&uuml;cksetzen";
/* The string for any logout form */
$cfg['str_logout'] = "Ausloggen";
/* The string for any add entry form */
$cfg['str_entry_add'] = "Eintrag hinzuf&uuml;gen";
/* The string for any back form */
$cfg['str_back'] = "Zur&uuml;ck";
/* The string for any preview form */
$cfg['str_preview'] = "Vorschau";
/* The string for any hide form */
$cfg['str_hide'] = "Verbergen";
/* The string for "Day" values */
$cfg['str_day'] = "Tag";
/* The string for "Top X" values */
$cfg['str_top_x'] = "X oben";
/* The string for "Top Y" values */
$cfg['str_top_y'] = "Y oben";
/* The string for "Bot X" values */
$cfg['str_bot_x'] = "X unten";
/* The string for "Bot Y" values */
$cfg['str_bot_y'] = "Y unten";
/* The string for "Unlock Time" values */
$cfg['str_unlock'] = "Entsperrt am";
/* The string for "Title" values */
$cfg['str_hl'] = "&Uuml;berschrift";
/* The string for "Text" values */
$cfg['str_text'] = "Text";
/* The admin surface HTML Title */
$cfg['str_admin'] = "Administration";
/* The message shown if admin page is called but disabled by config */
$cfg['str_admin_disabled'] = "Administration deaktiviert!";
/* The message shown on admin start page to welcome them */
$cfg['str_admin_welcome'] = "Willkommen, !!.";
/* The string for admins to switch to day admin home */
$cfg['str_admin_day'] = "Ausw&auml;hlbare Felder bearbeiten";
/* The string for admins to switch to content admin home */
$cfg['str_admin_content'] = "Inhalte bearbeiten";
/* The message shown if admin tries to use a corrupt date */
$cfg['str_admin_content_error_date'] = "Das angegebene Datum ist ung&uuml;ltig";
/* The message shown if admin tries to submit multiple entries for a single day */
$cfg['str_admin_content_error_day'] = "F&uuml;r diesen Tag existiert bereits ein Eintrag.";
/* The message shown if admin tries to submit a form with invalid or empty values */
$cfg['str_admin_content_error_fill'] = "Bitte alle Felder mit g&uuml;ltigen Werten f&uuml;llen.<br\> F&uuml;r alle Felder au&szlig;er '&Uuml;berschrift' und 'Text' sind ausschlie&szlig;lich Zahlen erlaubt.";
/* The message shown if admin tries to delete a day entry */
$cfg['str_admin_day_delete'] = "Eintrag f&uuml;r Tag !! wirklich l&ouml;schen?";
/* The message shown if admin tries to submit multiple entries for a single day */
$cfg['str_admin_day_error_day'] = "F&uuml;r diesen Tag existiert bereits ein Eintrag.";
/* The message shown if admin tries to submit a day form with invalid or empty values */
$cfg['str_admin_day_error_fill'] = "Bitte alle Felder mit g&uuml;ltigen Werten f&uuml;llen.<br\> F&uuml;r alle Felder sind ausschlie&szlig;lich Zahlen erlaubt.";
/* The message shown if admin tries to delete a content entry */
$cfg['str_admin_content_delete'] = "Eintrag f&uuml;r Tag !! wirklich l&ouml;schen?";

/* Path to background image */
$cfg['path_img_bg'] = 'img/background.png';
/* Path to error image */
$cfg['path_img_error'] = 'img/error.png';
/* Path to access denied image (too early or not available) */
$cfg['path_img_notyet'] = 'img/notyet.png';
/* Path for default script */
$cfg['path_script'] = 'js/calendar-041014.js';
/* Path for development javascript */
$cfg['path_script-dev'] ='js/calendar-dev-041014.js';
/* Path for admin javascript */
$cfg['path_script-admin'] = 'js/calendar-admin-031014.js';

/* Image Width property (in px) */
$cfg['prop_img_w'] = 720;
/* Image Height property (in px) */
$cfg['prop_img_h'] = 600;
/* Minimum allowed input for 'Month' property */
$cfg['prop_date_month_min'] = 1;
/* Maximum allowed input for 'Month' property */
$cfg['prop_date_month_max'] = 12;
/* Minimum allowed count for 'Day' */
$cfg['prop_date_day_min'] = 1;
/* Maximum allowed count for 'Day' in Month */
$cfg['prop_date_day_max'] = array(1 => 30, 2 => 28, 3 => 31, 4 => 30, 5 => 31, 6 => 30, 7 => 31, 8 => 31, 9 => 30, 10 => 31, 11 => 30, 12 => 31);
/* Minimum allowed input for 'Year' property */
$cfg['prop_date_year_min'] = 2010;
/* Minimum allowed input for 'Hour' property */
$cfg['prop_date_hour_min'] = 0;
/* Maximum allowed input for 'Hour' property */
$cfg['prop_date_hour_max'] = 23;
/* Minimum allowed input for 'Minutes' property */
$cfg['prop_date_min_min'] = 0;
/* Maximum allowed input for 'Minutes' property */
$cfg['prop_date_min_max'] = 59;
/* Conversion property to insert time into database */
$cfg['prop_sql_time_conversion'] = 'Y-m-d H:i:s';
/* Conversion property to retrieve time from database */
$cfg['prop_unix_time_conversion'] = 'Y-m-d H:i';
/* The TimeZone for all time related calculations */
$cfg['prop_time_default'] = "Europe/Berlin";
?>