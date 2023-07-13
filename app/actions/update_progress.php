<?php

include("../init.php");

if (isset($_POST['id']) && isset($_POST['progress'])) {
    $id = $_POST['id'];
    $progress = $_POST['progress'];

    $query = $DB->prepare( "SELECT * FROM ganttchart WHERE id=$id");
    $query->execute();
    $result = $query->get_result();
    $data = $result->fetch_object();

    $sql_update = "UPDATE ganttchart SET percent_completed=? WHERE id=?";
    $stmt_update = $DB->prepare($sql_update);
    $stmt_update->bind_param("si", $progress, $id);

    if ($stmt_update->execute()) {
        echo $data->task;
    } else {
        echo "Failed to update progress: " . $stmt_update->error;
    }
} else {
    echo "Invalid request.";
}
?>
