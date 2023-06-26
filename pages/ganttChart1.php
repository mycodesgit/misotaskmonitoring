<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-users"></i> Gantt Chart</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Gantt Chart</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-gantt" style="background-color: #3c8dbc;">
                                            <i class="fas fa-plus"></i> Add New
                                        </button>
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <?= show_message(); ?>
                                <!-- Modal -->
                                <?php include 'pages/modal/add-ganttChart-modal.php';?>
                                <!-- /End Modal -->
                                
                                <div class="card-body">
                                    <div id="chart_div" ></div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

<?php include 'pages/script/user.php';?>

<?= element( 'footer' ); ?>


<script src="assets/js/addGanttValidation.js"></script>



<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Task ID');
    data.addColumn('string', 'Task Name');
    data.addColumn('string', 'Resource');
    data.addColumn('date', 'Start Date');
    data.addColumn('date', 'End Date');
    data.addColumn('number', 'Duration');
    data.addColumn('number', 'Percent Complete');
    data.addColumn('string', 'Dependencies');
    data.addColumn('number', 'User ID');

    data.addRows([
        <?php  
        $sql = "SELECT * FROM ganttchart";
        $stmt = $DB->query($sql);
        while ($datarows = mysqli_fetch_assoc($stmt)){
            $id = $datarows['id'];
            $userid = $datarows['user_id'];

            $sel=mysqli_query($DB, "SELECT * FROM users WHERE id='$userid'");
            $rw=mysqli_fetch_assoc($sel);
            $fullname = $rw['fname'].' '.$rw['lname'];

            $task = $datarows['task'];
            $start_date = date('Y, m, d', strtotime($datarows['start_date']));
            $end_date = date('Y, m, d', strtotime($datarows['end_date']));

            $start_date_obj = new DateTime($datarows['start_date']);
            $end_date_obj = new DateTime($datarows['end_date']);

            $current_date = new DateTime();
            
            $total_days = $start_date_obj->diff($end_date_obj)->days;
            $completed_days = $end_date_obj->diff($current_date)->days;

            $remaining_days = $end_date_obj->diff($current_date)->days;
            $progress_percentage = ($total_days - $remaining_days) / $total_days * 100;
            $progress_percentage = min(max($progress_percentage, 0), 100);
            $progress_percentage = round($progress_percentage, 2);
            
            ?>
            ['<?php echo $id; ?>', '<?php echo $task; ?>', '<?php echo $fullname; ?>', new Date('<?php echo $start_date; ?>'), new Date('<?php echo $end_date; ?>'), null, <?php echo $progress_percentage; ?>, null, <?php echo $userid; ?>],
            <?php
        }
        ?>
    ]);

    var options = {
        height: 400,
        gantt: {
            trackHeight: 30
        }
    };

    var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

    google.visualization.events.addListener(chart, 'select', function() {
        var selection = chart.getSelection();
        if (selection.length > 0) {
            var row = selection[0].row;
            var taskId = data.getValue(row, 0);
            var userid = data.getValue(row, 8);
            document.getElementById("task-id").value = taskId;

            if (<?php echo $_SESSION['id']; ?> == userid) {
                // Check for double-click event using jQuery's dblclick event
                var doubleClickTimer = null;
                $(chart.getContainer()).off('dblclick').on('dblclick', function() {
                    clearTimeout(doubleClickTimer);
                    $("#modal-gantt-stat").modal('show'); // Open modal with ID "modal-gantt-stat" for double-click
                });

                // Set a timer to detect single-click event
                doubleClickTimer = setTimeout(function() {
                    $("#modal-gantt-progress").modal('show'); // Open modal with ID "modal-gantt-progress" for single click
                    $(chart.getContainer()).off('dblclick'); // Remove the double-click event listener
                }, 300);
            } else {
                alert("This is not your task!");
            }
        }
    });

    chart.draw(data, options);
}

</script>

<script>
    function calculateDuration() {
        var startDate = new Date(document.getElementById('start_date').value);
        var endDate = new Date(document.getElementById('end_date').value);

        if (startDate && endDate && startDate <= endDate) {
            var diffInMilliseconds = endDate - startDate;
            var diffInDays = Math.ceil(diffInMilliseconds / (1000 * 60 * 60 * 24));

            var months = Math.floor(diffInDays / 30);
            var days = diffInDays % 30;

            var durationText = '';

            if (months > 0) {
                durationText += months + ' months';
                if (days > 0) {
                    durationText += ', ';
                }
            }

            if (days > 0) {
                durationText += days + ' days';
            }
            document.getElementById('duration').value = durationText;
        } else {
            document.getElementById('duration').value = '';
        }
    }
    document.getElementById('start_date').addEventListener('change', calculateDuration);
    document.getElementById('end_date').addEventListener('change', calculateDuration);

</script>