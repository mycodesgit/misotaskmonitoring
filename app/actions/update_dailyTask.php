<?php
if (!defined('ACCESS')) die('DIRECT ACCESS NOT ALLOWED');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    validate_csrf_token();

    if (isset($_POST['btn-update'])) {
        $token = $_GET['token'];
        $task = $_POST['task'];
        $no_accom = $_POST['no_accom'];

        if (!empty($task)) {

            $sql_update = "UPDATE accomplishment SET task=?, no_accom=? WHERE token=?";

            $stmt_update = $DB->prepare($sql_update);
            $stmt_update->bind_param("sss", $task, $no_accom, $token);

            if ($stmt_update->execute()) {
                set_message("Your Task is Updated Successfully.", 'success');
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            } else {
                set_message("<i class='fa fa-times'></i> Failed to updated" . $DB->error, 'danger');
                header("Location:"  . $_SERVER['REQUEST_URI']);
                exit();
            }
        }

        unset($_POST['btn-update']);
    }
}
?>
