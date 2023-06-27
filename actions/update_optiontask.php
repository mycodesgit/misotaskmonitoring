<?php
if (!defined('ACCESS')) die('DIRECT ACCESS NOT ALLOWED');

if (isset($_POST['btn-update'])) {
    $id = $_POST['id'];
    $option_name = $_POST['option_name'];

    if (!empty($option_name)) {

        $sql_update = "UPDATE option_task SET option_name=? WHERE id=?";

        $stmt_update = $DB->prepare($sql_update);
        $stmt_update->bind_param("si", $option_name, $id);

        if ($stmt_update->execute()) {
            set_message("Task option Updated Successfully.", 'success');
            header("Location: ../option/view");
            exit();
        } else {
            set_message("<i class='fa fa-times'></i> Failed to update" . $DB->error, 'danger');
            header("Location: ../option/view");
            exit();
        }
    }

    unset($_POST['btn-update']);
}
?>
