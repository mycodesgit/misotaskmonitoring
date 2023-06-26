<?php
$servername = "localhost";
$username = "root";
$password = "r@@t";
$dbname = "db_stem";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
mysqli_set_charset($conn, 'utf8mb4');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "CREATE DATABASE $dbname";
if (mysqli_query($conn, $sql)) {
    echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>HNHS | Tracer Study</title>

            <!-- Google Font: Source Sans Pro -->
            <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'>
            <!-- Font Awesome -->
            <link rel='stylesheet' href='assets/adminLTE-3/plugins/fontawesome-free/css/all.min.css'>
            <!-- Theme style -->
            <link rel='stylesheet' href='assets/adminLTE-3/dist/css/adminlte.min.css'>
            <!-- Logo -->
            <link rel='shortcut icon' type='' href='assets/adminLTE-3/img/logo.png'>

        </head>
        <body class='hold-transition login-page'>
            <div class='login-box'>
                <div class='card'>
                    <div class='card-body login-card-body'>
                        <center>
                            <img src='assets/img/logo/server.png' width='103px' height='100px'><br><br>
                            <h4 class='headline text-success'>
                                <i class='fas fa-check'></i> Database Created Successfully
                            </h4>
                            <a href='./login' class='btn btn-success btn-sm'>Done</a>
                        </center>
                    </div>
                </div>
            </div>
            <!-- jQuery -->
            <script src='assets/adminLTE-3/plugins/jquery/jquery.min.js'></script>
            <!-- Bootstrap 4 -->
            <script src='assets/adminLTE-3/plugins/bootstrap/js/bootstrap.bundle.min.js'></script>
            <!-- AdminLTE App -->
            <script src='assets/adminLTE-3/dist/js/adminlte.min.js'></script>
           
        </body>
        </html>
    ";
} else {
    echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>HNHS | Tracer Study</title>

            <!-- Google Font: Source Sans Pro -->
            <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'>
            <!-- Font Awesome -->
            <link rel='stylesheet' href='assets/adminLTE-3/plugins/fontawesome-free/css/all.min.css'>
            <!-- Theme style -->
            <link rel='stylesheet' href='assets/adminLTE-3/dist/css/adminlte.min.css'>
            <!-- Logo -->
            <link rel='shortcut icon' type='' href='assets/adminLTE-3/img/logo.png'>

        </head>
        <body class='hold-transition login-page'>
            <div class='login-box'>
                <div class='card'>
                    <div class='card-body login-card-body'>
                        <center>
                            <img src='assets/img/logo/server.png' width='103px' height='100px'><br><br>
                            <h4 class='headline text-danger'>
                                <i class='fas fa-exclamation-triangle'></i> Error Creating Database:
                            </h4>
                        </center>
                        <h6 class='headline'>
                            <center>
                                <a href='./login' class='btn btn-success btn-sm'>Go Back</a>
                            </center>
                        </h6>
                    </div>
                </div>
            </div>
            <!-- jQuery -->
            <script src='assets/adminLTE-3/plugins/jquery/jquery.min.js'></script>
            <!-- Bootstrap 4 -->
            <script src='assets/adminLTE-3/plugins/bootstrap/js/bootstrap.bundle.min.js'></script>
            <!-- AdminLTE App -->
            <script src='assets/adminLTE-3/dist/js/adminlte.min.js'></script>
           
        </body>
        </html>
     " . mysqli_error($conn);
}

// Select the database
mysqli_select_db($conn, $dbname);

$password = mysqli_real_escape_string($conn, '$2y$10$XVG96XAkEaMFRPgoCKDLneCps21.cCO3Yg95XIukDtR/nGRxmtCWq');
// SQL queries to create database, tables and insert data
$sql = "
        CREATE TABLE users (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `username` varchar(30) NOT NULL,
            `password` varchar(255) NOT NULL,
            `fname` varchar(30) NOT NULL,
            `mname` varchar(30) NOT NULL,
            `lname` varchar(20) NOT NULL,
            `emp_gender` varchar(30) NOT NULL,
            `usertype` varchar(50) NOT NULL,
            `token` varchar(200) NOT NULL,
            `status` varchar(2) NOT NULL DEFAULT '1',
            `log_status` int(11) NOT NULL DEFAULT 0,
            `created_at` datetime NOT NULL DEFAULT current_timestamp(),
            `updated_at` varchar(100) DEFAULT NULL
        );
        INSERT INTO users (`id`, `username`, `password`, `fname`, `mname`, `lname`, `emp_gender`, `usertype`, `token`, `status`, `log_status`, `created_at`, `updated_at`) 
        VALUES (1, 'admin', '$password', 'JOHN', 'C', 'WICK', 'Male', 'Administrator', 'bc73da01222532f6c7adbc57483200d3', '1', 0, '2023-05-02 13:38:36', NULL);

        CREATE TABLE responses (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `lname` varchar(30) NOT NULL,
            `fname` varchar(30) NOT NULL,
            `mname` varchar(30) NOT NULL,
            `gender` varchar(50) NOT NULL,
            `stem_track` text NOT NULL,
            `year_grad` varchar(50) NOT NULL,
            `pursue_study` varchar(50) NOT NULL,
            `course` text DEFAULT NULL,
            `school` text DEFAULT NULL,
            `job_status` text DEFAULT NULL,
            `name_job` text DEFAULT NULL,
            `instcom_name` text DEFAULT NULL,
            `token` varchar(200) NOT NULL,
            `created_at` date NOT NULL DEFAULT current_timestamp()
        );

        ";

// Create SQL file
//file_put_contents('db_biometric.sql', $sql);

//Execute SQL queries
if (mysqli_multi_query($conn, $sql)) {
    echo "";
} else {
    echo "";
}

// Close connection
mysqli_close($conn);
?>



