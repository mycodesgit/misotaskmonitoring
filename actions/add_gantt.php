<?php
if (!defined('ACCESS')) die('DIRECT ACCESS NOT ALLOWED');

if (isset($_POST['btn-submit'])) {
    $task = $_POST['task'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $duration = $_POST['duration'];
    $user_ids = $_POST['user_id']; // Assuming $_POST['user_id'] is an array

    // generate a token
    $token = bin2hex(random_bytes(16));

    if (!empty($task)) {
        // Convert user_ids array to comma-separated string
        $user_id = implode(',', $user_ids);

        $sql_insert = "INSERT INTO ganttchart (task, start_date, end_date, duration, user_id, token) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt_insert = $DB->prepare($sql_insert);
        $stmt_insert->bind_param("ssssss", $task, $start_date, $end_date, $duration, $user_id, $token);

        if ($stmt_insert->execute()) {
            set_message("Your Task Added Successfully. Complete it as soon as possible", 'success');
            header("Location: ../ganttChart/list");
        } else {
            set_message("<i class='fa fa-times'></i> Failed to add" . $DB->error, 'danger');
            header("Location: ../ganttChart/list");
        }
    }

    unset($_POST['btn-submit']);
}
?>
