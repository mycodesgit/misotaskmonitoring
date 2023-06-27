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
        text-align: left;
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
    .footer-logo-container {
        position: absolute;
        left: 10;
        bottom: -10;
        width: 100%;
        text-align: center;
    }

    .footer-logo {
        max-width: 80%;
        max-height: 20%;
        display: inline-block;
        vertical-align: bottom;
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

                $query = $DB->prepare("SELECT * FROM accomplishment WHERE created_at >= ? AND created_at <= ? AND user_id = ?");
                $query->bind_param("sss", $start_date, $end_date, $_SESSION[AUTH_ID]);
                $query->execute();
                $result = $query->get_result();

                if ($result->num_rows > 0) {
                    $cnt = 1;
                    while ($item = $result->fetch_object()) { 
                        ?>
                        <tr>
                            <td><?php echo $cnt ?></td>
                            <td><?php echo $item->task ?></td>
                            <td><?php echo str_replace(',', '<br>', $item->no_accom); ?></td>
                        </tr>
                        <?php
                        $cnt++;
                    }
                } else {
                    echo "<tr><td colspan='3'>No records found within the Date range you selected.</td></tr>";
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

<div class="footer-logo-container">
    <img src="assets/img/logo/footerLogo.png" class="footer-logo">
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