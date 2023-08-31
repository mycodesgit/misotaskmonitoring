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
        $user_id = $_POST['user_id'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST[''];

        createcalendarEvent($title, $user_id, $start_date, $end_date);
        // Redirect or perform additional actions as needed
    }

    if (isset($_POST['btn-update'])) {

        // $eventId = $_POST['id'];
        $title = $_POST['title'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        updatecalendarEvent($title, $start_date, $end_date);
        // Redirect or perform additional actions as needed
    }

    if (isset($_POST['btn-delete'])) {
        $token = $_GET['token'];

        deletecalendarEvent();
        // Redirect or perform additional actions as needed
    }
}
?>


