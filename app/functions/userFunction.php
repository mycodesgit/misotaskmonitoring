<?php

/*
|--------------------------------------------------------------------------
| Function Management
|--------------------------------------------------------------------------
|
| Here is where you can add all the functions for your application. These
| functions are connected by the corresponding table within your Database which
| is assigned in every "pages" group. Enjoy building your Functions!
|
*/

if (!defined('ACCESS')) {
    die('DIRECT ACCESS NOT ALLOWED');
}

function getUserLogData($id) {
    global $DB;

    $id = $_SESSION[AUTH_ID];

    $userQuery = $DB->prepare("SELECT * FROM users WHERE id = ?");
    $userQuery->bind_param("i", $id);
    $userQuery->execute();
    $userResult = $userQuery->get_result();

    if ($userResult->num_rows > 0) {
        $userData = $userResult->fetch_object();
        
        if ($userData->profile_image !== null) {
            $profileImageUrl = dirname($_SERVER['PHP_SELF']) .  "/assets/img/profile/" . $userData->profile_image;
        } else {
            $profileImageUrl = dirname($_SERVER['PHP_SELF']) .  "/assets/adminLTE-3/img/user.png";
        }
    } else {
        $profileImageUrl = dirname($_SERVER['PHP_SELF']) .  "/assets/adminLTE-3/img/user.png";
    }

    return [
        'userData' => $userData,
        'profileImageUrl' => $profileImageUrl
    ];
}



function userRead() {
    global $DB;

    $query = $DB->prepare("SELECT users.*, users.id AS userid, offices.office_name, offices.office_abbr
                      FROM users 
                      INNER JOIN offices ON users.off_id = offices.id");

    $query->execute();
    $result = $query->get_result();

    $users = array();
    while ($user = $result->fetch_object()) {
        $users[] = $user;
    }

    return $users;
}

function getUserByToken($token) {
    global $DB;

    $token = $_GET[AUTH_TOKEN];
    $stmt = $DB->prepare("SELECT * FROM users INNER JOIN offices ON users.off_id = offices.id WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_object();
    
    return $user;
}


function userCreate($fname, $mname, $lname, $username, $off_id, $password, $emp_gender, $usertype) {
    global $DB;

    $token = bin2hex(random_bytes(16));

    $sql_check = "SELECT COUNT(*) AS count FROM users WHERE username = ? OR password = ?";
    $stmt_check = $DB->prepare($sql_check);
    $stmt_check->bind_param("ss", $username, $password);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_count = $result_check->fetch_assoc()['count'];

    if ($row_count > 0) {
        set_message("<i class='fa fa-times'></i> Username or Password Already Exists", 'danger');
        return false;
    }

    $sql_insert = "INSERT INTO users SET fname=?, mname=?, lname=?, username=?, off_id=?, password=?, emp_gender=?, usertype=?, token=?";
    $stmt_insert = $DB->prepare($sql_insert);
    $stmt_insert->bind_param("sssssssss", $fname, $mname, $lname, $username, $off_id, $password, $emp_gender, $usertype, $token);

    if ($stmt_insert->execute()) {
        set_message("<i class='fa fa-check'></i> User Added Successfully", 'success');
        return true;
    } else {
        set_message("<i class='fa fa-times'></i> User Failed to Add" . $DB->error, 'danger');
        return false;
    }
}


function userUpdate($fname, $mname, $lname, $username, $emp_gender, $usertype, $token) {
    global $DB;

    $sql_check = "SELECT COUNT(*) AS count FROM users WHERE username = ? AND token <> ?";
    $stmt_check = $DB->prepare($sql_check);
    $stmt_check->bind_param("ss", $username, $token);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_count = $result_check->fetch_assoc()['count'];

    if ($row_count > 0) {
        set_message("<i class='fa fa-times'></i> Username Already Exists", 'danger');
        return false;
    }

    
    $sql_update = "UPDATE users SET fname=?, mname=?, lname=?, username=?, emp_gender=?, usertype=? WHERE token=?";
    $stmt_update = $DB->prepare($sql_update);
    $stmt_update->bind_param("sssssss", $fname, $mname, $lname, $username, $emp_gender, $usertype, $token);

    if ($stmt_update->execute()) {
        set_message("<i class='fa fa-check'></i> User Updated Successfully", 'success');
        return true;
    } else {
        set_message("<i class='fa fa-times'></i> Failed to Update User" . $DB->error, 'danger');
        return false;
    }
}


function passUpdate($password, $token) {
    global $DB;

    $sql_update = "UPDATE users SET password=? WHERE token=?";
    $stmt_update = $DB->prepare($sql_update);
    $stmt_update->bind_param("ss", $password, $token);

    if ($stmt_update->execute()) {
        set_message("<i class='fa fa-check'></i> User Password Updated Successfully", 'success');
        return true;
    } else {
        set_message("<i class='fa fa-times'></i> Failed to Update User Password" . $DB->error, 'danger');
        return false;
    }
}


// function userDelete($token) {
//     global $DB;

//     $sql_delete = "DELETE FROM users WHERE token=?";
//     $stmt_delete = $DB->prepare($sql_delete);
//     $stmt_delete->bind_param("s", $token);

//     if ($stmt_delete->execute()) {
//         set_message("<i class='fa fa-check'></i> User Deleted Successfully", 'success');
//         return true;
//     } else {
//         set_message("<i class='fa fa-times'></i> Failed to Delete User" . $DB->error, 'danger');
//         return false;
//     }
// }