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

function getNotes() {
    global $DB;

    $query = $DB->prepare("SELECT * FROM notes");
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $notes = array();
        while ($note = $result->fetch_object()) {
            $notes[] = $note;
        }
        return $notes;
    } else {
        return array();
    }
}

function createNotes($note_title, $note_content, $note_color, $user_id, $created_at) {

    global $DB;

    $token = bin2hex(random_bytes(16));

    $sql_insert = "INSERT INTO notes SET note_title=?, note_content=?, note_color=?, user_id=?, token=?, created_at=? ";

    $stmt_insert = $DB->prepare($sql_insert);
    $stmt_insert->bind_param("ssssss", $note_title, $note_content, $note_color, $user_id, $token, $created_at);

    if ($stmt_insert->execute()) {
        set_message("Your Note Added Successfully.", 'success');
        return true;
    } else {
        set_message("<i class='fa fa-times'></i> Failed to add" . $DB->error, 'danger');
        return false;
    }
}


// function deleteDailyTasks($id) {
//     $DB= new mysqli('localhost','root','r@@t','db_cpsumiso-monitoring');

//     $sql = "DELETE FROM accomplishment WHERE id=?";
//     $stmt = $DB->prepare($sql);
//     $stmt->bind_param("i", $id);
    
//     if ($stmt->execute()) {
//          echo "deleted";
//     } else {
//         echo "deleted";
//     }
// }

?>