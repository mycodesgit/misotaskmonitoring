<?php
// Include the init.php file to establish the database connection
include '../../init.php';

try {
    // Fetch response data from the database
    $query = "SELECT pursue_study, COUNT(*) AS count FROM responses GROUP BY pursue_study";
    $stmt = $DB->prepare($query);
    $stmt->execute();
    $response_data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Return the response data as JSON
    header('Content-Type: application/json');
    echo json_encode($response_data);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
