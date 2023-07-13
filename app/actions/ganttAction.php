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

if (!defined('ACCESS')) {
    die('DIRECT ACCESS NOT ALLOWED');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    validate_csrf_token();

    if (isset($_POST['btn-submit'])) {
        $task = $_POST['task'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $duration = $_POST['duration'];
        $user_id = $_POST['user_id'];

        createGantt($task, $start_date, $end_date, $duration, $user_id);
        // Redirect or perform additional actions as needed
    }

    if (isset($_POST['btn-update'])) {

        updateganttAction();
        // Redirect or perform additional actions as needed
    }

    if (isset($_POST['btn-delete'])) {
        $token = $_GET['token'];

        deleteganttAction();
        // Redirect or perform additional actions as needed
    }
}
