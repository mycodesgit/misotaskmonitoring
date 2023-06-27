<?php
if (!defined('ACCESS')) die('DIRECT ACCESS NOT ALLOWED');

if (isset($_POST['btn-update'])) {
    $id = $_POST['id'];
    $task = $_POST['task'];
    $no_accom = $_POST['no_accom'];
    $user_id = $_SESSION[AUTH_ID]; 

    if (!empty($task)) {

        $sql_update = "UPDATE accomplishment SET task=?, no_accom=?, user_id=? WHERE id=?";

        $stmt_update = $DB->prepare($sql_update);
        $stmt_update->bind_param("sssi", $task, $no_accom, $user_id, $id);

        if ($stmt_update->execute()) {
            set_message("Your Task is Updated Successfully.", 'success');
            header("Location: ../accomplishment/daily");
            exit();
        } else {
            set_message("<i class='fa fa-times'></i> Failed to updated" . $DB->error, 'danger');
            header("Location: ../accomplishment/daily");
            exit();
        }
    }

    unset($_POST['btn-update']);
}
?>
