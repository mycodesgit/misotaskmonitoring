<?php

/*
|--------------------------------------------------------------------------
| Function Management
|--------------------------------------------------------------------------
|
| Here is where you can add all the functions for your application. These
| functions are connected by the corresponding table within your Database which
| is assigned in every "pages" group. Enjoy building your Functions!
|
*/

if (!defined('ACCESS')) {
    die('DIRECT ACCESS NOT ALLOWED');
}
 
function viewcalendarEvent() {
    
}

function createcalendarEvent($title, $user_id, $start_date, $end_date) {
    global $DB;

    $token = bin2hex(random_bytes(16));

    $sql_insert = "INSERT INTO events SET title=?, user_id=?, start_date=?, end_date=?, token=? ";

    $stmt_insert = $DB->prepare($sql_insert);
    $stmt_insert->bind_param("sssss", $title, $user_id, $start_date, $end_date, $token);

    if ($stmt_insert->execute()) {
        set_message("Added Successfully.", 'success');
        return true;
    } else {
        set_message("<i class='fa fa-times'></i> Failed to add" . $DB->error, 'danger');
        return false;
    }
}

function updatecalendarEvent($title, $start_date, $end_date) {
    global $DB;

    $sql_update = "UPDATE events SET title=?, start_date=?, end_date=?, WHERE id=?";
    $stmt_update = $DB->prepare($sql_update);
    $stmt_update->bind_param("ssss", $title, $start_date, $end_date, $id,);

    if ($stmt_update->execute()) {
        set_message("<i class='fa fa-check'></i> Updated Successfully", 'success');
        return true;
    } else {
        set_message("<i class='fa fa-times'></i> Failed to Update" . $DB->error, 'danger');
        return false;
    }
}

function deletecalendarEvent($token) {
    global $DB;

    $sql_delete = "DELETE FROM table_name WHERE token=?";
    $stmt_delete = $DB->prepare($sql_delete);
    $stmt_delete->bind_param("s", $token);

    if ($stmt_delete->execute()) {
        set_message("<i class='fa fa-check'></i> Deleted Successfully", 'success');
        return true;
    } else {
        set_message("<i class='fa fa-times'></i> Failed to Delete" . $DB->error, 'danger');
        return false;
    }
}
