<?php
include '../../app/functions/ticketFunction.php';

$data = array();
$tickets = ticketConfirm();
$cnt = 1;
foreach ($tickets as $ticket) {
    $id = $ticket->id;

    $officeAbbr = $ticket->office_abbr;
    $officeAbbrParts = explode('-', $officeAbbr);
    $officeName = trim(end($officeAbbrParts));

    $urgencyLevel = '';
    switch ($ticket->urg_lvl) {
        case '1': $urgencyLevel = '<div class="badge badge-danger">Critical</div>'; break;
        case '2': $urgencyLevel = '<div class="badge badge-warning">High</div>';break;
        case '3': $urgencyLevel = '<div class="badge badge-info">Medium</div>';break;
        case '4': $urgencyLevel = '<div class="badge badge-default update_default" data-id="' . $ticket->id . '">Low</div>';break;
    }    

    $stat = '';
    switch ($ticket->req_status) {
        case '1': $stat = '<div class="badge badge-warning">Pending</div>'; break;
        case '2': $stat = '<div class="badge badge-warning">Reject</div>'; break;
        case '3': $stat = '<div class="badge badge-info">Approved</div>'; break;
        case '4': $stat = '<div class="badge badge-success update_stat" data-id="' . $ticket->id . '">Completed</div>';break;
    }    

    $action = '
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-check"></i> Approved
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-times"></i> Reject
                </a>
            </div>
        </div>
    ';

    $no = $cnt;
    $data[] = array(
        'no' => $no,
        'fullname' => $ticket->fname.' '.$ticket->mname.' '.$ticket->lname,
        'ticket_no' => '<span class="ticket-number">'.$ticket->code.'-'.$ticket->ticket_no.'</span>',
        'office' => $officeName,
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
