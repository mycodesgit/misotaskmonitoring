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
        $emp_gender = $_POST['emp_gender'];
        $usertype = $_POST['usertype'];

        userCreate($fname, $mname, $lname, $username, $off_id, $password, $emp_gender, $usertype);
    }

    if (isset($_POST['btn-update'])) {
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $emp_gender = $_POST['emp_gender'];
        $usertype = $_POST['usertype'];
        $token = $_GET['token'];

        userUpdate($fname, $mname, $lname, $username, $emp_gender, $usertype, $token);
    }

    if (isset($_POST['btn-updatePassword'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = $_GET['token'];

        passUpdate($password, $token);
    }

    if (isset($_POST['btn-delete'])) {
        $token = $_GET['token'];

        userDelete($token);
    }
    
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['btnDeleteUser'])) {
        $id = $_GET['id'];
        include("../init.php");
    
        $sql_delete = "DELETE FROM users WHERE id=?";
        $stmt_delete = $DB->prepare($sql_delete);
        $stmt_delete->bind_param("s", $id);
    
        if ($stmt_delete->execute()) {
            set_message("<i class='fa fa-check'></i> User Deleted Successfully", 'success');
            return true;
        } else {
            set_message("<i class='fa fa-times'></i> Failed to Delete User" . $DB->error, 'danger');
            return false;
        }
    }

}
?>