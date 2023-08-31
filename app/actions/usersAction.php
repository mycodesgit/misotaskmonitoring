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
    if (!defined('ACCESS')) {
        die('DIRECT ACCESS NOT ALLOWED');
    }
    validate_csrf_token();

    if (isset($_POST['btn-submit'])) {
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $off_id = $_POST['off_id'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $photoFile = $_FILES["profile_image"]["name"];
        $emp_gender = $_POST['emp_gender'];
        $usertype = $_POST['usertype'];

        userCreate($fname, $mname, $lname, $username, $off_id, $password, $photoFile, $emp_gender, $usertype);
    }

    if (isset($_POST['btn-update'])) {
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $emp_gender = $_POST['emp_gender'];
        $usertype = $_POST['usertype'];
        $token = $_SESSION[AUTH_TOKEN];

        userUpdate($fname, $mname, $lname, $username, $emp_gender, $usertype, $token);
    }

    if (isset($_POST['btn-updatePassword'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = $_SESSION[AUTH_TOKEN];

        passUpdate($password, $token);
    }

    if (isset($_POST['btn-updatePhoto'])) {
        $photoFile = $_FILES["profile_image"]["name"];
        $updated_at = date("Y-m-d");
        $token = $_SESSION[AUTH_TOKEN];

        userUpdatePhoto($photoFile, $updated_at, $token);
    }
    
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') { 

    if (isset($_GET['btn_delete'])) {
        $id = $_GET['id'];

        include ("../../init.php");
        $file_sql = "SELECT profile_image FROM users WHERE id=?";
        $stmt_file = $DB->prepare($file_sql);
        $stmt_file->bind_param("i", $id);
        $stmt_file->execute();
        $stmt_file->bind_result($photoName);
        $stmt_file->fetch();

        $target_file = "../../assets/img/profile/" . $photoName;

        if ($stmt_file->execute()) {
        include ("../../init.php"); 

            $sql_delete = "DELETE FROM users WHERE id=?";
            $stmt_delete = $DB->prepare($sql_delete);
            $stmt_delete->bind_param("i", $id);
            $stmt_delete->execute();

            unlink($target_file);

            echo "$photoName";
        } else {
            echo "error";
        }
    }
}
?>