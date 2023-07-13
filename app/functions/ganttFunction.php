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
 
function viewganttFunction() {
    global $DB;

    $query = $DB->prepare("SELECT * FROM ganttchart");
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $items = array();
        while ($item = $result->fetch_object()) {
            $items[] = $item;
        }
        return $items;
    } else {
        return array();
    }
}

function createGantt($task, $start_date, $end_date, $duration, $user_id) {
    global $DB;

    $token = bin2hex(random_bytes(16));
    $user_id = implode(',', $user_id);

    $sql_insert = "INSERT INTO ganttchart SET task=?, start_date=?, end_date=?, duration=?, user_id=?, token=? ";

    $stmt_insert = $DB->prepare($sql_insert);
    $stmt_insert->bind_param("ssssss", $task, $start_date, $end_date, $duration, $user_id, $token);

    if ($stmt_insert->execute()) {
        set_message("Your Task Added Successfully. Complete it as soon as possible.", 'success');
        return true;
    } else {
        set_message("<i class='fa fa-times'></i> Failed to add" . $DB->error, 'danger');
        return false;
    }
}

function updateGantt($item, $token) {
    global $DB;

    $sql_update = "UPDATE ganttchart SET item=? WHERE token=?";
    $stmt_update = $DB->prepare($sql_update);
    $stmt_update->bind_param("ss", $item, $token);

    if ($stmt_update->execute()) {
        set_message("<i class='fa fa-check'></i> Updated Successfully", 'success');
        return true;
    } else {
        set_message("<i class='fa fa-times'></i> Failed to Update" . $DB->error, 'danger');
        return false;
    }
}

function deleteGantt($token) {
    global $DB;

    $sql_delete = "DELETE FROM ganttchart WHERE token=?";
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
