<?php

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
|
| Here is where you can register all the pages you want to allow for your web application. These
| page authentication giving you access in all "pages" which
| depends in every "Usertype". Now create more authentication pages!
|
*/

/*
|--------------------------------------------------------------------------
| TO USE:
|--------------------------------------------------------------------------
|
| To add restricted pages, just uncomment the variable $restricted_pages,
| each array elements are page names found in your pages folder.
| When added, these pages will not be accessible unless the SESSION AUTH_ID
| is assigned with a value.
|
*/

/*
|--------------------------------------------------------------------------
| NOTE:
|--------------------------------------------------------------------------
|
| ONLY SET THESE IF YOU WANT TO ALLOW AUTHENTICATION. IF NOT THEN JUST COMMENT THEM OUT
|	
*/	

	if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

	define( 'AUTH_ID', 'id' );
	define( 'AUTH_NAME', 'username' );
	define( 'AUTH_TYPE', 'usertype' );
	define( 'AUTH_TOKEN', 'token' );
	define( 'AUTH_OFF', 'off_id' );

	// default page to login, name of the file found in /pages
	define( 'LOGIN_REDIRECT', 'login' ); 
	define( 'PAGE_REDIRECT', 'home/dashboard' );
	
    $st = $DB->prepare("SELECT * FROM users WHERE id = ?");
    $st->bind_param("s", $_SESSION[AUTH_ID]);
    $st->execute();
    $res = $st->get_result();
    $auth = $res->fetch_object();

	$restricted_pages[ 'Administrator' ]
		['access'] = [ "home/dashboard", 
						"profile/info", 
						"ganttChart/list",
						"accomplishment/daily",
						"accomplishment/edit",
						"ticketing/viewTicket",
						"notes/nlist",
						"calendar/viewEvent",   
						"users/ulist",
						"option/view", 
						"users/edit-user",  
						"reports/generate",
						"reports/generate_pdf",
						"error/404"
					];
	$restricted_pages[ 'Administrator' ][ 'default_page' ] = "home/dashboard";

	$restricted_pages[ 'MIS Officer' ]
		['access'] = [ "home/dashboard", 
						"profile/info", 
						"ganttChart/list",
						"accomplishment/daily",
						"accomplishment/edit",
						"ticketing/viewTicket",
						"notes/nlist",
						"calendar/viewEvent",   
						"users/ulist",
						"option/view", 
						"users/edit-user",  
						"reports/generate",
						"reports/generate_pdf",
						"error/404"
					];
	$restricted_pages[ 'MIS Officer' ][ 'default_page' ] = "home/dashboard";

	$restricted_pages[ 'Staff' ]
		['access'] = [ "home/dashboard", 
						"profile/info", 
						"ganttChart/list",
						"accomplishment/daily",
						"accomplishment/edit",
						"ticketing/viewTicket",
						"notes/nlist",
						"calendar/viewEvent",  
						"reports/generate",
						"reports/generate_pdf",
						"error/404"
					];
	$restricted_pages[ 'Staff' ][ 'default_page' ] = "home/dashboard";

	$restricted_pages[ 'User' ]
		['access'] = [ "home/dashboard", 
						"profile/info",
						"ticketing/viewContent",
						"error/404"
					];
	$restricted_pages[ 'User' ][ 'default_page' ] = "home/dashboard";
	
	
	$restricted_pages[ 'default' ]['access'] = [ "login", "register" ];
	$restricted_pages[ 'default' ][ 'default_page' ] = "default"; 

	has_access( true );
