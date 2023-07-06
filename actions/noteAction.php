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



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!defined('ACCESS')) {
        die('DIRECT ACCESS NOT ALLOWED');
    }
    validate_csrf_token();

    if (isset($_POST['btn-submit'])) {
        $note_title = $_POST['note_title'];
        $note_content = $_POST['note_content'];
        $note_color = $_POST['note_color'];
        $user_id = $_SESSION[AUTH_ID]; 
        $created_at = date("Y-m-d");

        createNotes($note_title, $note_content, $note_color, $user_id,  $created_at);
    }

    if (isset($_POST['btn-update'])) {
        $note_name = $_POST['note_name'];
        $token = $_GET['token'];

        updateNotes($note_name, $token);
    }

}

// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     if (isset($_GET['btnDelete'])) {
//         $id = $_GET['id'];
//         include("../init.php");
    
//         $sql = "DELETE FROM accomplishment WHERE id=?";
//         $stmt = $DB->prepare($sql);
//         $stmt->bind_param("i", $id);
        
//         if ($stmt->execute()) {
//              echo "deleted";
//         } else {
//             echo "deleted";
//         }
//     }

// }
?>