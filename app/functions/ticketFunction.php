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
    ");

    $query->execute();
    $result = $query->get_result();

    $tickets = array();
    while ($ticket = $result->fetch_object()) {
        $tickets[] = $ticket;
    }
    return $tickets;
}

function ticketRead() {
    include '../../init.php';

    $query = $DB->prepare("
        SELECT t.*, u.*, o.*, c.*
        FROM ticketing AS t
        JOIN users AS u ON u.id = t.user_id
        JOIN category AS c ON c.id = t.cat_id
        JOIN offices AS o ON o.id = t.off_id
    ");

    $query->execute();
    $result = $query->get_result();

    $tickets = array();
    while ($ticket = $result->fetch_object()) {
        $tickets[] = $ticket;
    }
    return $tickets;
}

function ticketCreate($data){
    global $DB;
    $sql_insert = "INSERT INTO ticketing (user_id, ticket_no, cat_id, off_id, concern, urg_lvl, status, acc_by, created_at) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt_insert = $DB->prepare($sql_insert);
    $stmt_insert->bind_param("iiiisisi", ...array_values($data));

    if ($stmt_insert->execute()) {
    set_message("<i class='fa fa-check'></i> Ticket Added Successfully", 'success');
        header("Location: ../ticketing/viewContent");
        exit();
    } else {
        set_message("<i class='fa fa-times'></i> Failed to Add Ticket: " . $DB->error, 'danger');
        return false;
    }
    unset($_POST['btn-submit']);  
}

?>