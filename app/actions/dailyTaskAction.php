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
        $task = $_POST['task'];
        $no_accom = $_POST['no_accom'];
        $user_id = $_SESSION[AUTH_ID]; 
        $created_at = date("Y-m-d");

        createDailyTasks($task, $no_accom, $user_id, $created_at);
    }

    if (isset($_POST['btn-update'])) {
        $task = $_POST['task'];
        $no_accom = $_POST['no_accom'];
        $token = $_GET['token'];

        updateDailyTasks($task, $no_accom, $token);
    }

}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    include("../init.php");
    
    if (isset($_GET['btnDelete'])) {
        $id = $_GET['id'];
    
        $sql = "DELETE FROM accomplishment WHERE id=?";
        $stmt = $DB->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
             echo "deleted";
        } else {
            echo "deleted";
        }
    }

}
?>