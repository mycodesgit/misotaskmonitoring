<?php
if (!defined('ACCESS')) die('DIRECT ACCESS NOT ALLOWED');

if (isset($_POST['btn-submit'])) {
    $option_name = $_POST['option_name'];
    $created_at = date("Y-m-d");

    // generate a token
    $token = bin2hex(random_bytes(16));

    if (!empty($option_name)) {

        $sql_insert = "INSERT INTO option_task SET option_name=?, created_at=? , token=? ";

        $stmt_insert = $DB->prepare($sql_insert);
        $stmt_insert->bind_param("sss", $option_name, $created_at, $token);

        if ($stmt_insert->execute()) {
            set_message("Task option Added Successfully.", 'success');
            header("Location: ../option/view");
            exit();
        } else {
            set_message("<i class='fa fa-times'></i> Failed to add" . $DB->error, 'danger');
            header("Location: ../option/view");
            exit();
        }
    }

    unset($_POST['btn-submit']);
}
?>
