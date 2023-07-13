<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!defined('ACCESS')) {
        die('DIRECT ACCESS NOT ALLOWED');
    }
    global $DB;
    
    validate_csrf_token();

    if (isset($_POST['btn-create'])) {
        $ticketNo = $_POST['ticket_no'];
        $ticketNumber = preg_replace("/[^0-9]/", "", $ticketNo);
        $token = bin2hex(random_bytes(16));
        $data = [
            'user_id' => $auth->id,
            'ticket_no' => $ticketNumber,
            'cat_id' => $_POST['cat_id'],
            'off_id' => $auth->off_id,
            'concern' => $_POST['concern'],
            'urg_lvl' => $_POST['urg_lvl'],
            'req_status' => 1,
            'acc_by' => 99999,
        ];
        ticketCreate($data);
    } 

    if (isset($_POST['btn-update'])) {
        $ticketNo = $_POST['ticket_no'];
        $ticketNumber = preg_replace("/[^0-9]/", "", $ticketNo);
        $token = bin2hex(random_bytes(16));
        $data = [
            'ticket_id' => $_POST['ticket_id'],
            'user_id' => $auth->id,
            'ticket_no' => $ticketNumber,
            'cat_id' => $_POST['cat_id'],
            'off_id' => $auth->off_id,
            'concern' => $_POST['concern'],
            'urg_lvl' => $_POST['urg_lvl'],
            'req_status' => 1,
            'acc_by' => 99999,
        ];
        ticketUpdate($data);
    } 
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include("../init.php");
    if (isset($_GET['btnDelete'])) {
        $id = $_GET['id'];
    
        $sql = "UPDATE ticketing SET del_status=2 WHERE id=?";
        $stmt = $DB->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
             echo "deleted";
        } else {
            echo "deleted";
        }
    }
    
    if (isset($_GET['ticketCode'])) {
        $catid = $_GET['catid'];
    
        $sql = "SELECT * FROM category WHERE id=?";
        $stmt = $DB->prepare($sql);
        $stmt->bind_param("i", $catid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        $sql1 = "SELECT * FROM ticketing";
        $stmt1 = $DB->prepare($sql1);
        $stmt1->execute();
    
        $result1 = $stmt1->get_result();
        $count = $result1->num_rows;
    
        // Increment the count by 1 and format it with leading zeros
        $ticket_no = str_pad($count + 1, 4, "0", STR_PAD_LEFT);
    
        echo $row['code'].'-'.$ticket_no;
    }

    if (isset($_GET['updateIdnum'])) {
        // Get the duplicate ticket numbers
        $sqlDuplicates = "SELECT ticket_no FROM ticketing GROUP BY ticket_no HAVING COUNT(*) > 1";
        $stmtDuplicates = $DB->prepare($sqlDuplicates);
        $stmtDuplicates->execute();
        $resultDuplicates = $stmtDuplicates->get_result();
    
        while ($row = $resultDuplicates->fetch_assoc()) {
            $ticketNo = $row['ticket_no'];
    
            // Get the last ticket_no for the records with the same ticket_no
            $sqlLastTicketNo = "SELECT id, ticket_no FROM ticketing WHERE ticket_no = ? ORDER BY id DESC LIMIT 1";
            $stmtLastTicketNo = $DB->prepare($sqlLastTicketNo);
            $stmtLastTicketNo->bind_param("s", $ticketNo);
            $stmtLastTicketNo->execute();
            $resultLastTicketNo = $stmtLastTicketNo->get_result();
    
            if ($rowLastTicketNo = $resultLastTicketNo->fetch_assoc()) {
                $id = $rowLastTicketNo['id'];
                $lastTicketNo = $rowLastTicketNo['ticket_no'];
    
                // Update the ticket numbers by incrementing the last ticket_no
                $newTicketNo = str_pad((int)$lastTicketNo + 1, 4, '0', STR_PAD_LEFT);
                $sqlUpdate = "UPDATE ticketing SET ticket_no = ? WHERE id = ?";
                $stmtUpdate = $DB->prepare($sqlUpdate);
                $stmtUpdate->bind_param("ss", $newTicketNo, $id);
                $stmtUpdate->execute();
    
                if ($stmtUpdate->affected_rows > 0) {
                    echo "Ticket numbers updated successfully.";
                } else {
                    echo "No records were updated.";
                }
            }
        }
    }    

}


?>