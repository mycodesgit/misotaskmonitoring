<?php

include("../init.php");

if (isset($_POST['id']) && isset($_POST['progress'])) {
    $id = $_POST['id'];
    $progress = $_POST['progress'];

    // Validate and sanitize the input values if needed

    // Update the progress in the ganttchart table
    $sql_update = "UPDATE ganttchart SET percent_completed=? WHERE id=?";
    $stmt_update = $DB->prepare($sql_update);
    $stmt_update->bind_param("si", $progress, $id);

    if ($stmt_update->execute()) {
        echo "Progress updated successfully.";
    } else {
        echo "Failed to update progress: " . $DB->error;
    }
} else {
    echo "Invalid request.";
}
?>
