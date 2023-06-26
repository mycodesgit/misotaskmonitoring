<?php
include("../init.php");

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $updated_at = date("Y-m-d");

    // Validate and sanitize the input values if needed

    // Update the status in the ganttchart table
    $sql_update = "UPDATE ganttchart SET status=?, updated_at=? WHERE id=?";
    $stmt_update = $DB->prepare($sql_update);
    $stmt_update->bind_param("ssi", $status, $updated_at, $id);

    if ($stmt_update->execute()) {
        echo "Status updated successfully.";
    } else {
        echo "Failed to update status: " . $DB->error;
    }
} else {
    echo "Invalid request.";
}
?>




