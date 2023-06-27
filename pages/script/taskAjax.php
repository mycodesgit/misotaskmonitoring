<?php
//session_start();

include '../../init.php';

$query = $DB->prepare("SELECT * FROM ganttchart");
$query->execute();
$result = $query->get_result();

$data = array();
if ($result->num_rows > 0) {
    $cnt = 1;
    while ($data = $result->fetch_object()) {
        $userIds = explode(',', $data->user_id);

        $userQuery = $DB->prepare("SELECT * FROM users WHERE id IN (" . implode(',', $userIds) . ")");
        $userQuery->execute();
        $userResult = $userQuery->get_result();

        // Create an array to store the image URLs
        $imageUrls = array();

        while ($userData = $userResult->fetch_object()) {
            $imageUrls[] = dirname($_SERVER['PHP_SELF']) . "/assets/img/profile/" . $userData->profile_image;
        }

        $no = $cnt;

        $tasksmall = "
            $data->task
            <small>
                $formattedStartDate = date('F j, Y', strtotime($data->start_date));
                $formattedEndDate = date('F j, Y', strtotime($data->end_date));
            </small>
        ";
        
        $data[] = array(
            'no' => $no,
            'task' => $tasksmall,
            'imageUrls' => $imageUrls,
            'percentCompleted' => $data->percent_completed,
            'status' => $data->status,
            'id' => $data->id
        );
        $cnt++;
    }
}

// Close the database connection
mysqli_close($DB);

// Prepare the response in JSON format
$response = array(
    'data' => $data
);

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);


?>

