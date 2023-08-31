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

function getUserLogData($token) {
    global $DB;

    $token = $_SESSION[AUTH_TOKEN];

    $userQuery = $DB->prepare("SELECT * FROM users WHERE token = ?");
    $userQuery->bind_param("s", $token);
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

    $query = $DB->prepare("SELECT users.*, users.id AS userid, offices.office_name, offices.office_abbr FROM users INNER JOIN offices ON users.off_id = offices.id");
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

    $token = $_GET['t0K3n'];
    $stmt = $DB->prepare("SELECT * FROM users INNER JOIN offices ON users.off_id = offices.id WHERE users.token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_object();
    
    return $user;
}


function userCreate($fname, $mname, $lname, $username, $off_id, $password, $photoFile, $emp_gender, $usertype) {
    global $DB;

    $token = token_hash();

    $sql_check = "SELECT COUNT(*) AS count FROM users WHERE username = ? OR password = ?";
    $stmt_check = $DB->prepare($sql_check);
    $stmt_check->bind_param("ss", $username, $password);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_count = $result_check->fetch_assoc()['count'];

    if ($row_count > 0) {
        set_message("<i class='fa fa-times'></i> Username and Password Already Exists", 'danger');
        return false;
    }

    $photoFile = $_FILES["profile_image"]["name"];
    $target_dir = "assets/img/profile/";
    $target_file = $target_dir . basename($photoFile);
    if ($_FILES['profile_image']['size'] > 200000000) {
        set_message("Image size should not be greater than 200Kb", 'danger');
        return false;
    }
    if (file_exists($target_file)) {
        set_message("File already exists", 'danger');
        return false;
    }
    if (empty($error)) {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $sql_insert = "INSERT INTO users SET fname=?, mname=?, lname=?, username=?, off_id=?, password=?, profile_image=?, emp_gender=?, usertype=?, token=?";
            $stmt_insert = $DB->prepare($sql_insert);
            $stmt_insert->bind_param("ssssssssss", $fname, $mname, $lname, $username, $off_id, $password, $photoFile, $emp_gender, $usertype, $token);

            if ($stmt_insert->execute()) {
                set_message("Added Successfully.", 'success');
                return true;
            } else {
                set_message("<i class='fa fa-times'></i> Failed to add" . $DB->error, 'danger');
                return false;
            }
        } else {
            set_message("There was an error uploading the file", 'danger');
            return false;
        }
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


function userUpdatePhoto($photoFile, $updated_at, $token) {
    global $DB;

    $photoFile = $_FILES["profile_image"]["name"];
    $target_dir = "assets/img/profile/";
    $target_file = $target_dir . basename($photoFile);

    if (!empty($photoFile)) {
        if ($_FILES['profile_image']['size'] > 200000000) {
            set_message("PDF size should not be greater than 200Kb", 'danger');
            return false;
        }
        if (file_exists($target_file)) {
            set_message("File already exists", 'danger');
            return false;
        }
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $sql_select = "SELECT profile_image FROM users WHERE token=?";
            $stmt_select = $DB->prepare($sql_select);
            $stmt_select->bind_param("s", $token);
            $stmt_select->execute();
            $stmt_select->bind_result($oldPhotoName);
            $stmt_select->fetch();
            $stmt_select->close();

            if (!empty($oldPhotoName)) {
                $oldFilePath = $target_dir . $oldPhotoName;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        } else {
            set_message("There was an error uploading the file", 'danger');
            return false;
        }
    }

    $sql_update = "UPDATE users SET profile_image=?, updated_at=? WHERE token=?";
    $stmt_update = $DB->prepare($sql_update);
    $stmt_update->bind_param("sss", $photoFile, $updated_at, $token);

    if ($stmt_update->execute()) {
        set_message("File Updated Successfully.", 'success');
        return true;
    } else {
        set_message("<i class='fa fa-times'></i> Failed to update" . $DB->error, 'danger');
        return false;
    }
}