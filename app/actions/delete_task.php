<?php
	include '../init.php';

	$id = $_GET['id'];

	$sql = "DELETE FROM ganttchart WHERE id=?";
	$stmt = $DB->prepare($sql);
	$stmt->bind_param("s", $id);
	if ($stmt->execute()) {
	    //echo "deleted";
	} else {
	    //echo "error";
	}
?>
