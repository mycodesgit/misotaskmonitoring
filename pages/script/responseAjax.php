<?php
//session_start();

include '../../init.php';

$query = $DB->prepare("SELECT * FROM responses");

$query->execute();

$result = $query->get_result();
$data = array();
if ($result->num_rows > 0) {
    $cnt = 1;
    while ($response = $result->fetch_object()) {
        $genderResponse = '';
            if ($response->gender == "Male") {
                $genderResponse = '<td class=""><div class="badge badge-success">Male</div></td>';
            } elseif ($response->gender == "Female") {
                $genderResponse = '<td class=""><div class="badge badge-warning" data-id="'.$response->id.'">Female</div></td>';
            }

        $no = $cnt;
        $data[] = array(
            'no' => $no,
            'lname' => $response->lname,
            'fname' => $response->fname,
            'mname' => $response->mname,
            'genderResponse' => $genderResponse,
            'stem_track' => $response->stem_track,
            'year_grad' => $response->year_grad,
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

