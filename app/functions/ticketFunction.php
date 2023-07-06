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

// if (!defined('ACCESS')) {
//     die('DIRECT ACCESS NOT ALLOWED');
// }


function ticketReadMonitoring() {
    include '../init.php';

    $query = $DB->prepare("
        SELECT t.*, u.*, o.*, c.*
        FROM ticketing AS t
        JOIN users AS u ON u.id = t.user_id
        JOIN category AS c ON c.id = t.cat_id
        JOIN offices AS o ON o.id = t.off_id
        WHERE t.del_status=1
    ");

    $query->execute();
    $result = $query->get_result();

    $tickets = array();
    while ($ticket = $result->fetch_object()) {
        $tickets[] = $ticket;
    }
    return $tickets;
}

function ticketConfirm() {
    include '../../init.php';

    $query = $DB->prepare("
        SELECT t.*, u.*, o.*, c.*
        FROM ticketing AS t
        JOIN users AS u ON u.id = t.user_id
        JOIN category AS c ON c.id = t.cat_id
        JOIN offices AS o ON o.id = t.off_id
        WHERE t.del_status=1
    ");

    $query->execute();
    $result = $query->get_result();

    $tickets = array();
    while ($ticket = $result->fetch_object()) {
        $tickets[] = $ticket;
    }
    return $tickets;
}

function ticketRead($sid) {
    include '../../init.php';
    $query = $DB->prepare("
        SELECT t.*, t.id AS ticketId, u.*, o.*, c.*
        FROM ticketing AS t
        JOIN users AS u ON u.id = t.user_id
        JOIN category AS c ON c.id = t.cat_id
        JOIN offices AS o ON o.id = t.off_id
        WHERE t.user_id=$sid AND t.del_status=1
    ");

    $query->execute();
    $result = $query->get_result();

    $tickets = array();
    while ($ticket = $result->fetch_object()) {
        $tickets[] = $ticket;
    }
    return $tickets;
}

function ticketReadData($id) {
    global $DB;
    $query = $DB->prepare("
        SELECT t.*, t.id AS ticketId, u.*, o.*, c.*
        FROM ticketing AS t
        JOIN users AS u ON u.id = t.user_id
        JOIN category AS c ON c.id = t.cat_id
        JOIN offices AS o ON o.id = t.off_id
        WHERE t.id=$id AND t.del_status=1
    ");

    $query->execute();
    $result = $query->get_result();

    $ticketsdata = array();
    while ($ticket = $result->fetch_object()) {
        $ticketsdata[] = $ticket;
    }
    return $ticketsdata;
}


function ticketCreate($data){
    global $DB;
    $sql_insert = "INSERT INTO ticketing (user_id, ticket_no, cat_id, off_id, concern, urg_lvl, req_status, acc_by, created_at) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt_insert = $DB->prepare($sql_insert);
    $stmt_insert->bind_param("isiisisi", ...array_values($data));

    if ($stmt_insert->execute()) {
    set_message("<i class='fa fa-check'></i> Ticket Added Successfully", 'success');
        header("Location: ../ticketing/viewContent?id");
        exit();
    } else {
        set_message("<i class='fa fa-times'></i> Failed to Add Ticket: " . $DB->error, 'danger');
        return false;
    }
    unset($_POST['btn-submit']);  
}

function ticketUpdate($data) {
    global $DB;
    $ticketId = $data['ticket_id'];

    $sql_update = "UPDATE ticketing 
                   SET user_id = ?, ticket_no = ?, cat_id = ?, off_id = ?, concern = ?, urg_lvl = ?, req_status = ?, acc_by = ?, created_at = NOW()
                   WHERE id = ?";
    $stmt_update = $DB->prepare($sql_update);

    $bind_params = array(
        $data['user_id'],
        $data['ticket_no'],
        $data['cat_id'],
        $data['off_id'],
        $data['concern'],
        $data['urg_lvl'],
        $data['req_status'],
        $data['acc_by'],
        $ticketId
    );

    $types = "isiisisii";
    $stmt_update->bind_param($types, ...$bind_params);

    if ($stmt_update->execute()) {
        set_message("<i class='fa fa-check'></i> Ticket Updated Successfully", 'success');
        header("Location: ../ticketing/viewContent?id");
        exit();
    } else {
        set_message("<i class='fa fa-times'></i> Failed to Update Ticket: " . $DB->error, 'danger');
        return false;
    }
    unset($_POST['btn-update']);  
}

?>