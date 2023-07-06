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

if (!defined('ACCESS')) {
    die('DIRECT ACCESS NOT ALLOWED');
}

function getOffices() {
    global $DB;

    $query = $DB->prepare("SELECT * FROM offices");
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $offices = array();
        while ($office = $result->fetch_object()) {
            $offices[] = $office;
        }
        return $offices;
    } else {
        return array();
    }
}

// function deleteDailyTasks($id) {
//     $DB= new mysqli('localhost','root','r@@t','db_cpsumiso-monitoring');

//     $sql = "DELETE FROM accomplishment WHERE id=?";
//     $stmt = $DB->prepare($sql);
//     $stmt->bind_param("i", $id);
    
//     if ($stmt->execute()) {
//          echo "deleted";
//     } else {
//         echo "deleted";
//     }
// }

?>