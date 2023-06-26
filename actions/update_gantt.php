<?php
if (!defined('ACCESS')) die('DIRECT ACCESS NOT ALLOWED');

if (isset($_POST['btn-submit'])) {
    $id = $_POST['id'];
    $task = $_POST['task'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $duration = $_POST['duration'];
    $user_ids = $_POST['user_id']; // Assuming $_POST['user_id'] is an array


    if (!empty($task)) {
        // Convert user_ids array to comma-separated string
        $user_id = implode(',', $user_ids);

        $sql_update = "UPDATE ganttchart SET task = ?, start_date = ?, end_date = ?, duration = ?, user_id = ? WHERE id = ?";

        $stmt_update = $DB->prepare($sql_update);
        $stmt_update->bind_param("sssssi", $task, $start_date, $end_date, $duration, $user_id, $id); // Assuming $id is the ID of the record to update

        if ($stmt_update->execute()) {
            set_message("Your Task Updated Successfully", 'success');
            header("Location: ../ganttChart/list");
            exit;
        } else {
            set_message("<i class='fa fa-times'></i> Failed to update" . $DB->error, 'danger');
            header("Location: ../ganttChart/list");
            exit;
        }
        
    }

}
?>
