<?php	

	// table columns found in your 'users' table
	define( 'AUTH_ID', 'id' );
	define( 'AUTH_NAME', 'username' );
	define( 'AUTH_TYPE', 'usertype' );
	define( 'AUTH_TOKEN', 'token' );

	// default page to login, name of the file found in /pages
	define( 'LOGIN_REDIRECT', 'login' ); 
	
    $st = $DB->prepare("SELECT * FROM users WHERE id = ?");
    $st->bind_param("s", $_SESSION[AUTH_ID]);
    $st->execute();
    $res = $st->get_result();
    $auth = $res->fetch_object();
	
	if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

	/* 
	NOTE:
	ONLY SET THESE IF YOU WANT TO ALLOW AUTHENTICATION 
	IF NOT THEN JUST COMMENT THEM OUT 
	*/

	/*
		TO USE:
			To add restricted pages, just uncomment the variable $restricted_pages,
			each array elements are page names found in your pages folder.
			When added, these pages will not be accessible unless the SESSION AUTH_ID
			is assigned with a value.
	*/

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
	
	
	$restricted_pages[ 'default' ]['access'] = [ "default", "viewMonitoring", "viewMonitoringTicketsTable", "login", "register" ];
	$restricted_pages[ 'default' ][ 'default_page' ] = "default"; 

	has_access( true );
