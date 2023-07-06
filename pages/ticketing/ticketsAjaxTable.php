<?php
include '../../app/functions/ticketFunction.php';

$data = array();
$tickets = ticketRead($_GET['sid']);
$cnt = 1;
foreach ($tickets as $ticket) {
    $id = $ticket->ticketId;
    $urgencyLevel = '';
    if ($ticket->urg_lvl == '1') {
        $urgencyLevel = '<div class="badge badge-danger">Critical</div>';
    } elseif ($ticket->urg_lvl == '2') {
        $urgencyLevel = '<div class="badge badge-warning">High</div>';
    } elseif ($ticket->urg_lvl == '3') {
        $urgencyLevel = '<div class="badge badge-info">Medium</div>';
    } elseif ($ticket->urg_lvl == '4') {
        $urgencyLevel = '<div class="badge badge-default update_default" data-id="' . $ticket->ticketId . '">Low</div>';
    }

    $id = $ticket->ticketId;
    $stat = '';
    if ($ticket->req_status == '1') {
        $stat = '<div class="badge badge-danger">Pending</div>';
    } elseif ($ticket->req_status == '2') {
        $stat = '<div class="badge badge-warning">Reject</div>';
    } elseif ($ticket->req_status == '3') {
        $stat = '<div class="badge badge-info">Approved</div>';
    } elseif ($ticket->req_status == '4') {
        $stat = '<div class="badge badge-success update_stat" data-id="' . $ticket->ticketId . '">Completed</div>';
    }

    $action = '
        <a href="viewContent?id=' . $ticket->ticketId . '" class="btn btn-info btn-xs" title="Edit">
            <i class="fas fa-info-circle"></i>
        </a>
        <a id="' . $ticket->ticketId . '" onclick="deleteItem(this.id)" class="btn btn-danger btn-xs" title="Delete">
            <i class="fas fa-trash"></i>
        </a>
    ';
    
    $no = $cnt;
    $data[] = array(
        'ticketId' => $ticket->ticketId,
        'no' => $no,
        'ticket_no' => '<span class="ticket-number">'.$ticket->code.'-'.$ticket->ticket_no.'</span>',
        'cat_id' => $ticket->cat_name,
        'concern' => $ticket->concern,
        'urgency_level' => $urgencyLevel,
        'status' => $stat,
        'actions' => $action,
    );
    $cnt++;
}

// Prepare the response in JSON format
$response = array(
    'data' => $data
);

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
