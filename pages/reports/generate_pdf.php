<?php 
// (A) LOAD MPDF
require "vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf([
    'default_font_size' => 9,
    'default_font' => 'Times New Roman',
    'format' => 'Letter',
    'orientation' => 'P' // set orientation to landscape
]);

//$id = 123; 
ob_start();
?>

<?php
    $id = $_SESSION[AUTH_ID];
    $stmt = $DB->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_object();
?>

<style>
    .title_task{
        font-size: 12pt;
        font-family: Arial, sans-serif;
        font-weight: bold;
        text-align: center;
    }
    .date_task{
        padding-top: -25px;
        font-size: 11pt;
        font-family: Arial, sans-serif;
        text-align: center;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        font-family: Arial, sans-serif;
        font-size: 12px;
    }
    th, td {
        padding: 8px;
        text-align: center;
        border: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    tfoot td {
        font-weight: bold;
    }
    .name_person{
        padding-right: 50px;
        padding-top: 30px;
        font-size: 11pt;
        font-weight: bold;
        font-family: Arial, sans-serif;
        text-align: right;
    }
    .position_person{
        padding-right: 100px;
        padding-top: -34px;
        font-size: 11pt;
        font-family: Arial, sans-serif;
        text-align: right;
    }
    .supervisor_person{
        padding-left: 30px;
        padding-top: 30px;
        font-size: 11pt;
        font-weight: bold;
        font-family: Arial, sans-serif;
        text-align: left;
    }
    .supervisor_position{
        padding-left: 35px;
        padding-top: -34px;
        font-size: 11pt;
        font-family: Arial, sans-serif;
        text-align: left;
    }
</style>

<div>
    <center>
        <img src="assets/img/logo/headerLogo.png" width="100%" height="25%" style="margin-top: -20px;">
    </center>
</div>

<div>
    <p class="title_task">Accomplishment Report</p>
</div>
<div>
    <p class="date_task">
        <?php
            if (isset($_GET['generate'])) {
                $start_date = $_GET['start_date'];
                $end_date = $_GET['end_date'];
                $formatted_from_date = date('F d', strtotime($start_date));
                $formatted_to_date = date(' d, Y', strtotime($end_date));
                echo "<p class='date_task'>$formatted_from_date - $formatted_to_date</p>";
            }
        ?>
    </p>
</div>

<div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Task</th>
                <th>Accommodation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['generate'])) {
                $start_date = $_GET['start_date'];
                $end_date = $_GET['end_date']; 

                $query = $DB->prepare("SELECT * FROM ganttchart WHERE status = 'Complete' AND start_date >= ? AND end_date <= ? AND user_id=".$_SESSION[AUTH_ID]);
                $query->bind_param("ss", $start_date, $end_date);
                $query->execute();
                $result = $query->get_result();

                if ($result->num_rows > 0) {
                    $cnt = 1;
                    while ($item = $result->fetch_object()) { ?>
                        <tr>
                            <td><?php echo $cnt ?></td>
                            <td><?php echo $item->task ?></td>
                            <td>1 Local System</td>
                        </tr>
                        <?php
                        $cnt++;
                    }
                } else {
                    //echo "<tr><td colspan='3'>No records found.</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<div class="name_person">
    <p><?php echo $user->fname ?> <?php echo $user->mname?>. <?php echo $user->lname?></p>
</div>

<div class="position_person">
    <p>MIS Staff</p>
</div>

<div class="supervisor_person">
    <p>RYAN B. ESCORIAL, DIT</p>
</div>

<div class="supervisor_position">
    <p>MIS Officer</p>
</div>





<?php 
$table_html = ob_get_clean();

// (D) THE HTML
$html = $table_html;

// (E) WRITE HTML TO PDF
$mpdf->WriteHTML($html);

// (F) OUTPUT PDF
$mpdf->Output();
?>