<?php
include '../app/functions/ticketFunction.php';

$data = array();
$tickets = ticketReadMonitoring();

foreach ($tickets as $ticket) {
    $id = $ticket->id;
    $officeAbbr = $ticket->office_abbr;
    $officeAbbrParts = explode('-', $officeAbbr);
    $officeName = trim(end($officeAbbrParts));

    $urgencyLevel = '';
    if ($ticket->urg_lvl == '1') {
        $urgencyLevel = '<div class="badge badge-danger">Critical</div>';
    } elseif ($ticket->urg_lvl == '2') {
        $urgencyLevel = '<div class="badge badge-warning">Hard</div>';
    } elseif ($ticket->urg_lvl == '3') {
        $urgencyLevel = '<div class="badge badge-info">Medium</div>';
    } elseif ($ticket->urg_lvl == '4') {
        $urgencyLevel = '<div class="badge badge-default update_default" data-id="' . $ticket->id . '">Low</div>';
    }

    $stat = '';
    if ($ticket->req_status == '1') {
        $stat = '<div class="badge badge-danger">Pending</div>';
    } elseif ($ticket->req_status == '2') {
        $stat = '<div class="badge badge-warning">Reject</div>';
    } elseif ($ticket->req_status == '3') {
        $stat = '<div class="badge badge-info">Approved</div>';
    } elseif ($ticket->req_status == '4') {
        $stat = '<div class="badge badge-success update_stat" data-id="' . $ticket->id . '">Completed</div>';
    }

    $data[] = array(
        'ticket_no' => $ticket->ticket_no,
        'category' => $ticket->cat_name,
        'office' => $officeName,
        'urgency_level' => $urgencyLevel,
        'status' => $stat,
    );
}

// Prepare the response in JSON format
$response = array(
    'data' => $data
);

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>