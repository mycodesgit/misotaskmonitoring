<?php
/*
|--------------------------------------------------------------------------
| Actions Management
|--------------------------------------------------------------------------
|
| Here is where you can add all the actions for your application. These
| actions are connected by the corresponding functions within your "app/functions" folder which
| is assigned in every "pages" group. Enjoy building your Actions!
|
*/

session_destroy();

session_start();
set_message( "<i class='fas fa-check'></i> Logout Successfully." . $DB->error, "success" );
header( "Location: " .  "./login" );
exit;