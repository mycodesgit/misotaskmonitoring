<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'headerForm' ); ?>

<body class="hold-transition layout-top-nav layout-navbar-fixed text-sm">

<div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <a href="" class="navbar-brand">
                <img src="assets/adminLTE-3/img/mislogoNoBG.png" alt="AdminLTE Logo" class="brand-image img-square">
                <span class="brand-text font-weight-light">
                    <strong> MONITORING</strong>
                </span>
            </a>
            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="" class="nav-link"></a>
                    </li>
                </ul>
            </div>
            
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item">
                    <a href="./" class="btn btn-primary btn-sm">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
        </div>
                       
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Task Monitoring</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-hover projects">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">#</th>
                                            <th>Project Name</th>
                                            <th>Team Members</th>
                                            <th>Project Progress</th>
                                            <th style="width: 8%" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $query = $DB->prepare( "SELECT * FROM ganttchart" );
                                            $query->execute();
                                            $result = $query->get_result();
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
                                                        $imageUrls[] = dirname($_SERVER['PHP_SELF'])."/assets/img/profile/" . $userData->profile_image;
                                                    }
                                                    ?>
                                                <tr id="task-<?php echo $data->id; ?>">
                                                    <td><?php echo $cnt++; ?></td>
                                                    <td>
                                                        <a>
                                                        <?php echo $data->task; ?>
                                                        </a>
                                                        <br/>
                                                        <small>
                                                            <?php  
                                                                $date = $data->start_date;
                                                                $dateTime = new DateTime($date);
                                                                echo $formattedDate = $dateTime->format('F j, Y').' -';
                                                            ?>
                                                            <?php  
                                                                $date = $data->end_date;
                                                                $dateTime = new DateTime($date);
                                                                echo $formattedDate = $dateTime->format('F j, Y');
                                                            ?>
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <ul class="list-inline">
                                                            <?php foreach ($imageUrls as $imageUrl) { ?>
                                                                <li class="list-inline-item">
                                                                    <img alt="Avatar" class="table-avatar" src="<?php echo $imageUrl; ?>">
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </td>
                                                    <td class="project_progress">
                                                        <div id="progress-container" class="progress progress-sm">
                                                            <div id="progress-bar" class="progress-bar bg-green" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $data->percent_completed; ?>%">
                                                            </div>
                                                        </div>
                                                        <small id="progress-label">
                                                        <?php echo $data->percent_completed; ?>% Complete
                                                        </small>
                                                    </td>
                                                    <td class="project-state">
                                                        <?php
                                                            $status = $data->status;
                                                            if ($status === 'Working on it') {
                                                                $bg='warning';
                                                            } 
                                                            if ($status === 'Stuck') {
                                                                $bg='danger';   
                                                            } 
                                                            if ($status === 'Complete') {
                                                                $bg='success';
                                                            }
                                                        ?>
                                                        <div id="row<?php echo $data->id; ?>">
                                                            <span class="badge badge-<?php echo $bg; ?>">
                                                            <?php
                                                                $status = $data->status;
                                                                if ($status === 'Working on it') {
                                                                echo 'Working on it';
                                                                } elseif ($status === 'Stuck') {
                                                                echo 'Stuck';
                                                                } elseif ($status === 'Complete') {
                                                                echo 'Complete';
                                                                } else {
                                                                echo 'Select an option';
                                                                }
                                                            ?>
                                                            </span>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $data->id; ?>" <?php if(strpos(','.$data->user_id.',', ','.$_SESSION['id'].',') === false) { echo 'style="display: none;"'; } ?>>
                                                                <a class="dropdown-item text-dark" data-id="<?php echo $data->id; ?>" href="#" onclick="selectOption(event, 'Working on it', '<?php echo $data->id; ?>')" style="background-color: #ffc107;">Working on it</a>
                                                                <a class="dropdown-item text-light" data-id="<?php echo $data->id; ?>" href="#" onclick="selectOption(event, 'Stuck', '<?php echo $data->id; ?>')" style="background-color: #dc3545;">Stuck</a>
                                                                <a class="dropdown-item text-light" data-id="<?php echo $data->id; ?>" href="#" onclick="selectOption(event, 'Complete', '<?php echo $data->id; ?>')" style="background-color: #28a745;">Complete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Ticketing</h3>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <table id="example2" class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $query = $DB->prepare( "SELECT * FROM ticketing" );
                                            $query->execute();
                                            $result = $query->get_result();
                                            if ($result->num_rows > 0) {
                                                $cnt = 1;
                                                while ($item = $result->fetch_object()) { ?>
                                            <tr>
                                                <td>
                                                    <span class="badge bg-primary float-left align-middle">New</span>
                                                </td>
                                                <td class="mailbox-name">
                                                    <a href="#"><?php echo $item->assign_to ?></a>
                                                </td>
                                                <td class="mailbox-subject">
                                                    <b><?php echo $item->subject ?></b>
                                                </td>
                                                <td class="mailbox-date">5 mins ago</td>
                                            </tr>
                                            <?php
                                                    //$cnt++;
                                                }
                                            } else {
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner" id="taskNowCountContainer">
                                <h3></h3>
                                <p>Ongoing Task</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-chart-bar"></i>
                            </div>
                            <a href="<?= $gantt_chart_link ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner" id="taskNowDoneContainer">
                                <h3></h3>
                                <p>Task Done this Month</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <a href="<?= $gantt_chart_link ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner" id="taskNowStuckContainer">
                                <h3></h3>
                                <p>Task Stuck this Month</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-times"></i>
                            </div>
                            <a href="<?= $gantt_chart_link ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= element ('footerForm'); ?>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="assets/adminLTE-3/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/adminLTE-3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/adminLTE-3/dist/js/adminlte.min.js"></script>


<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": false, 
            "autoWidth": false,
            "searching": false,
            "pageLength": 5,
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $("#example2").DataTable({
            "responsive": false,
            "lengthChange": false, 
            "autoWidth": false,
            "searching": false,
            "pageLength": 5,
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script> 

<script>
    function updatePursueStudyCount() {
        $.ajax({
            url: 'pages/script/countAjax.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#usersCountContainer h3').text(data.users_count_total);
                $('#taskNowCountContainer h3').text(data.task_count_total); 
                $('#taskNowDoneContainer h3').text(data.taskdone_count_total); 
                $('#taskNowStuckContainer h3').text(data.taskstuck_count_total); 
            },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}
setInterval(updatePursueStudyCount, 2000);
</script>  

<!-- DataTables  & Plugins -->
<script src="assets/adminLTE-3/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/adminLTE-3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/adminLTE-3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/adminLTE-3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/adminLTE-3/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/adminLTE-3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/adminLTE-3/plugins/jszip/jszip.min.js"></script>
<script src="assets/adminLTE-3/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets/adminLTE-3/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets/adminLTE-3/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/adminLTE-3/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/adminLTE-3/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
function handleProgressBar(progressContainer, progressBar, progressHandle, progressLabel) {
    var isDragging = false;

    progressHandle.on("mousedown", function (event) {
        event.preventDefault();
        isDragging = true;
    });

    progressContainer.on("mousemove", function (event) {
        if (isDragging) {
            var containerWidth = progressContainer.width();
            var containerOffset = progressContainer.offset().left;
            var mouseX = event.pageX - containerOffset;
            var progress = (mouseX / containerWidth) * 100;
            progress = Math.min(Math.max(progress, 0), 100);
            progressBar.css("width", progress + "%");
            progressHandle.css("left", progress + "%");
            progressLabel.text(Math.round(progress) + "% Complete")
        }
    });

    progressHandle.on("mouseup", function () {                
        isDragging = false;
        var rowId = progressHandle.data("idd");
        var progress = progressLabel.text().split(" ")[0].replace("%", ""); // Remove the % sign
        
        // AJAX request to update the ganttchart table
        $.ajax({
            url: "../actions/update_progress.php",
            method: "POST",
            data: { id: rowId, progress: progress },
            success: function (response) {
            document.getElementById("task-data").value=response;
            $('#modal-gantt-accomplish').modal('show');
            },
            error: function (xhr, status, error) {
                //console.error(xhr.responseText);
            }
        });
    });


    $(document).on("mouseup", function () {
        isDragging = false;
    });
}

$(function () {
    $(".project_progress").each(function () {
        var progressContainer = $(this).find("#progress-container");
        var progressBar = $(this).find("#progress-bar");
        var progressHandle = $(this).find("#progress-handle");
        var progressLabel = $(this).find("#progress-label");

        handleProgressBar(progressContainer, progressBar, progressHandle, progressLabel);
    });
});
</script>
