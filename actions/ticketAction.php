<?php

if (!defined('ACCESS')) {
    die('DIRECT ACCESS NOT ALLOWED');
}
global $DB;

validate_csrf_token();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['btn-create'])) {

        $token = bin2hex(random_bytes(16));
        $data = [
            'user_id' => $auth->id,
            'ticket_no' => rand(),
            'cat_id' => $_POST['cat_id'],
            'off_id' => $auth->off_id,
            'concern' => $_POST['concern'],
            'urg_lvl' => $_POST['urg_lvl'],
            'status' => 1,
            'acc_by' => 99999,
        ];
        ticketCreate($data);
    }

    
    
}

?>