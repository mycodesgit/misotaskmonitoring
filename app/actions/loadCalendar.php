<?php

include '../../init.php';
$data = array();

$query = "SELECT * FROM events ORDER BY id";
$result = $DB->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'start' => $row['start_date'],
            'end' => $row['end_date']
        );
    }
}

echo json_encode($data);
?>