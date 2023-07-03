<?php

if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

function csrf() {
    if (!isset($_SESSION[AUTH_TOKEN])) {
        $_SESSION[AUTH_TOKEN] = bin2hex(random_bytes(32));
    }
    $token = base64_encode($_SESSION[AUTH_TOKEN]);
    echo '<input type="hidden" class="form-control" name="token" value="' . $token . '">';
}

function validate_csrf() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION[AUTH_TOKEN]) {
        $token = $_POST['token'];
        $decodedToken = base64_decode($token);
        
        if ($decodedToken !== $_SESSION[AUTH_TOKEN]) {
            set_message("Invalid CSRF token", 'danger');
            redirect(LOGIN_REDIRECT);
        }
    }
}

function csrf_token() {
    if (!isset($_SESSION[AUTH_TOKEN])) {
        $_SESSION[AUTH_TOKEN] = bin2hex(random_bytes(16));
    }
    $token = base64_encode($_SESSION[AUTH_TOKEN]);
    
    echo '<input type="hidden" class="form-control" name="token" value="' . $token . '">';
}

function validate_csrf_token() {
    if (isset($_POST['token'])) {
        $token = $_POST['token'];
        $decodedToken = base64_decode($token);

        if ($decodedToken !== $_SESSION[AUTH_TOKEN]) {
            set_message("Invalid CSRF token", 'danger');
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        }
    } else {
        set_message("CSRF token not found", 'danger');
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}


function includePhpFilesInDirectory($directory) {
    $filePaths = glob($directory . '*.php');
    foreach ($filePaths as $filePath) {
        require_once $filePath;
    }
}
$functionsDir = 'app/functions/';
includePhpFilesInDirectory($functionsDir);





