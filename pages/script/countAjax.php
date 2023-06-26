<?php
include '../../init.php';

// Prepare the statement to get the total count
$stmtTotal = $DB->prepare("SELECT COUNT(*) AS users_count FROM users");
$stmtTotal->execute();
$resultTotal = $stmtTotal->get_result()->fetch_array();

// Prepare the statement to get the count for 'CurrentMonth'
$stmtNow = $DB->prepare("SELECT COUNT(*) AS task_count FROM ganttchart WHERE MONTH(start_date) = MONTH(CURDATE()) AND MONTH(end_date) = MONTH(CURDATE())");
$stmtNow->execute();
$resultTask = $stmtNow->get_result()->fetch_array();


// Prepare the statement to get the count for 'Done'
$stmtNowTaskDone = $DB->prepare("SELECT COUNT(*) AS taskdone_count FROM ganttchart WHERE MONTH(start_date) = MONTH(CURRENT_DATE()) AND MONTH(end_date) = MONTH(CURRENT_DATE()) AND status = 'Complete'");
$stmtNowTaskDone->execute();
$resultTaskDone = $stmtNowTaskDone->get_result()->fetch_array();

// Prepare the statement to get the count for 'Stuck'
$stmtNowTaskStuck = $DB->prepare("SELECT COUNT(*) AS taskstuck_count FROM ganttchart WHERE MONTH(start_date) = MONTH(CURRENT_DATE()) AND MONTH(end_date) = MONTH(CURRENT_DATE()) AND status = 'Stuck'");
$stmtNowTaskStuck->execute();
$resultTaskStuck = $stmtNowTaskStuck->get_result()->fetch_array();




$response = array(
  'users_count_total' => $resultTotal['users_count'],
  'task_count_total' => $resultTask['task_count'],
  'taskdone_count_total' => $resultTaskDone['taskdone_count'],
  'taskstuck_count_total' => $resultTaskStuck['taskstuck_count']
);

header('Content-Type: application/json');
echo json_encode($response);
?>
