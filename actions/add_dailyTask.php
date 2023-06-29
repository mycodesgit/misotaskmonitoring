<?php
if (!defined('ACCESS')) die('DIRECT ACCESS NOT ALLOWED');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    validate_csrf_token();

    if (isset($_POST['btn-submit'])) {
        $task = $_POST['task'];
        $no_accom = $_POST['no_accom'];
        $user_id = $_SESSION[AUTH_ID]; 
        $created_at = $updated_at = date("Y-m-d");

        // generate a token
        $token = bin2hex(random_bytes(16));

        if (!empty($task)) {

            $sql_insert = "INSERT INTO accomplishment (task, no_accom, user_id, token, created_at ) VALUES (?, ?, ?, ?, ?)";

            $stmt_insert = $DB->prepare($sql_insert);
            $stmt_insert->bind_param("sssss", $task, $no_accom, $user_id, $token, $created_at);

            if ($stmt_insert->execute()) {
                set_message("Your Task Added Successfully.", 'success');
                header("Location: ../accomplishment/daily");
                exit();
            } else {
                set_message("<i class='fa fa-times'></i> Failed to add" . $DB->error, 'danger');
                header("Location: ../accomplishment/daily");
                exit();
            }
        }

        unset($_POST['btn-submit']);
    }
}
?>
