<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    validate_csrf_token();

    if (isset($_POST['btn-submit'])) {
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $emp_gender = $_POST['emp_gender'];
        $usertype = $_POST['usertype'];

        $sql_check = "SELECT COUNT(*) AS count FROM users WHERE username = ? OR password = ?";
        $stmt_check = $DB->prepare($sql_check);
        $stmt_check->bind_param("ss", $username, $password);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_count = $result_check->fetch_assoc()['count'];

        if ($row_count > 0) {
            set_message("<i class='fa fa-times'></i> Username or Password Already Exists", 'danger');
        }

        $profile_image = $_FILES['profile_image'];
        $image_name = $profile_image['name'];
        $image_tmp = $profile_image['tmp_name'];
        $image_size = $profile_image['size'];
        $image_error = $profile_image['error'];

        if ($image_error === UPLOAD_ERR_OK) {
            $upload_dir = 'assets/img/profile/';
            $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_filename = uniqid() . '.' . $image_extension;

            if (move_uploaded_file($image_tmp, $upload_dir . $image_filename)) {
                $token = bin2hex(random_bytes(16));

                $sql_insert = "INSERT INTO users SET fname=?, mname=?, lname=?, username=?, password=?, emp_gender=?, usertype=?, token=?, profile_image=?";
                $stmt_insert = $DB->prepare($sql_insert);
                $stmt_insert->bind_param("sssssssss", $fname, $mname, $lname, $username, $password, $emp_gender, $usertype, $token, $image_filename);
                
                if($stmt_insert->execute()){
                    set_message("<i class='fa fa-check'></i> User Added Successfully",  'success');
                } else {
                    set_message("<i class='fa fa-times'></i> User Failed to Add" .$DB->error, 'danger');
                }
            } else {
                set_message("<i class='fa fa-times'></i> Failed to upload the profile image.", 'danger');
            }
        } elseif ($image_error === UPLOAD_ERR_NO_FILE) {

        } else {
            set_message("<i class='fa fa-times'></i> Error occurred while uploading the profile image.", 'danger');
        }
    }
}

?>