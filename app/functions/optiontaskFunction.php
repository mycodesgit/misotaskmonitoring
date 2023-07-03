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

function getOptionTasks() {
    global $DB;

    $query = $DB->prepare("SELECT * FROM option_task ORDER by option_name ASC");
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $tasks = array();
        while ($item = $result->fetch_object()) {
            $tasks[] = $item;
        }
        return $tasks;
    } else {
        return array();
    }
}

function createOptionTask() {

    global $DB;

    // $token = bin2hex(random_bytes(16));

    // $sql_insert = "INSERT INTO accomplishment SET task=?, no_accom=?, user_id=?, token=?, created_at=? ";

    // $stmt_insert = $DB->prepare($sql_insert);
    // $stmt_insert->bind_param("sssss", $task, $no_accom, $user_id, $token, $created_at);

    // if ($stmt_insert->execute()) {
    //     set_message("Your Task Added Successfully.", 'success');
    //     return true;
    // } else {
    //     set_message("<i class='fa fa-times'></i> Failed to add" . $DB->error, 'danger');
    //     return false;
    // }
}


function updateOptionTask() {
    
    global $DB;

    // $sql_update = "UPDATE accomplishment SET task=?, no_accom=?, WHERE token=?";
    // $stmt_update = $DB->prepare($sql_update);
    // $stmt_update->bind_param("sssssss", $task, $no_accom, $token);

    // if ($stmt_update->execute()) {
    //     set_message("<i class='fa fa-check'></i> Daily Task Updated Successfully", 'success');
    //     return true;
    // } else {
    //     set_message("<i class='fa fa-times'></i> Failed to Update Daily Task" . $DB->error, 'danger');
    //     return false;
    // }
}