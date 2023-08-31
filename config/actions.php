<?php

if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
    
    if (file_exists("./app/actions/{$action}.php")) {
        include "./app/actions/{$action}.php";
    } elseif (file_exists("../actions/{$action}.php")) {
        include "../app/actions/{$action}.php";
    } else {
        // Handle the case when the action file doesn't exist
        // ...
    }
}
