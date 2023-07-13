<?php

/*
|--------------------------------------------------------------------------
| Actions Management
|--------------------------------------------------------------------------
|
| Here is where you can add all the actions for your application. These
| actions are connected by the corresponding functions within your "app/functions" folder which
| is assigned in every "pages" group. Enjoy building your Actions!
|
*/


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    validate_csrf_token();

    if (isset($_POST['btn-submit'])) {
        $title = $_POST['title'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        createcalendarEvent($title,  $start_date, $end_date);
        // Redirect or perform additional actions as needed
    }

    if (isset($_POST['btn-update'])) {

        updatecalendarEvent();
        // Redirect or perform additional actions as needed
    }

    if (isset($_POST['btn-delete'])) {
        $token = $_GET['token'];

        deletecalendarEvent();
        // Redirect or perform additional actions as needed
    }
}
?>

<?php
include '../../init.php';

$data = array();

$query = "SELECT * FROM events ORDER BY id";
$result = $DB->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'start' => $row['start_date'],
            'end' => $row['end_date'],
        );
    }
}

echo json_encode($data);
