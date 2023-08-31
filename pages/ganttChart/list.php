<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>
<style>
    #progress-container {
    position: relative;
    height: 15px;
    background-color: #f2f2f2;
    border-radius: 4px;
    overflow: hidden;
    }

    #progress-bar {
        height: 100%;
        background-color: #28a745;
        transition: width 0.3s ease;
    }

    #progress-handle {
        position: absolute;
        top: 0;
        left: 0%;
        width: 10px;
        height: 100%;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        cursor: pointer;
    }

    .status-cell-component {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 4px;
        color: #fff;
        font-weight: bold;
        border-radius: 3px;
        font-size: 12px;
        line-height: 1;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .status-cell-component .status-note-wrapper {
        display: flex;
        align-items: center;
    }

    .status-cell-component .add-status-note {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #fff;
        margin-right: 4px;
    }

    .status-cell-component i {
        margin-left: 4px;
    }

    .status-cell-component[data-status="working"] {
        background-color: #fdae61;
    }

    .status-cell-component[data-status="done"] {
        background-color: #5b8f29;
    }

    .status-cell-component[data-status="stuck"] {
        background-color: #ff4d4f;
    }
    .table-avatar{
        width: 35px !important;
    }
</style>
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
                                <li class="breadcrumb-item"><a href="<?= $home_link ?>">Dashboard</a></li>
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
                           <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-gantt" style="background-color: #3c8dbc;">
                                            <i class="fas fa-plus"></i> Add New
                                        </button>
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>

                                <?= show_message(); ?>
                                
                                <div class="card-body">
                                    <table id="example1" class="table table-hover projects">
                                        <thead>
                                            <tr>
                                                <th style="width: 1%">#</th>
                                                <th>Project Name</th>
                                                <th>Team Members</th>
                                                <th>Project Progress</th>
                                                <th style="width: 8%" class="text-center">Status</th>
                                                <th style="width: 10%" class="text-center">Actions</th>
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
                                                                <div id="progress-bar" class="progress-bar bg-green" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $data->percent_completed; ?>%"></div>
                                                                <div <?php if(strpos(','.$data->user_id.',', ','.$_SESSION['id'].',') !== false) { echo 'id="progress-handle"'; } ?> class="progress-handle" data-idd="<?php echo $data->id; ?>" style="left: <?php echo $data->percent_completed; ?>%;" draggable="true" ondragstart="dragStart(event)" ondragend="dragEnd(event)"></div>
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
                                                                <button class="btn btn-<?php echo $bg; ?> btn-sm dropdown-toggle w-100" type="button" id="dropdownMenuButton<?php echo $data->id; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $data->id; ?>" <?php if(strpos(','.$data->user_id.',', ','.$_SESSION['id'].',') === false) { echo 'style="display: none;"'; } ?>>
                                                                    <a class="dropdown-item text-dark" data-id="<?php echo $data->id; ?>" href="#" onclick="selectOption(event, 'Working on it', '<?php echo $data->id; ?>')" style="background-color: #ffc107;">Working on it</a>
                                                                    <a class="dropdown-item text-light" data-id="<?php echo $data->id; ?>" href="#" onclick="selectOption(event, 'Stuck', '<?php echo $data->id; ?>')" style="background-color: #dc3545;">Stuck</a>
                                                                    <a class="dropdown-item text-light" data-id="<?php echo $data->id; ?>" href="#" onclick="selectOption(event, 'Complete', '<?php echo $data->id; ?>')" style="background-color: #28a745;">Complete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="project-actions text-center">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-cog"></i></button>
                                                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                                </button>
                                                                <?php if(strpos(','.$data->user_id.',', ','.$_SESSION['id'].',') !== false) { ?>
                                                                <div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(68px, -166px, 0px);">
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-gantt-edit" onclick="editGantt(<?php echo $data->id; ?>)"><i class="fas fa-pen"></i>  Edit</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#" onclick="deleteTask(<?php echo $data->id; ?>)"><i class="fas fa-trash"></i> Delete</a>
                                                                </div>
                                                                <?php } ?>
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

<?php include 'pages/modal/add-ganttChart-modal.php';?>

<?= element( 'footer' ); ?>

<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>


<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/js/addGanttValidation.js"></script>

<script>
  function updateEndDateMin() {
    var startDate = document.getElementById("start_date").value;
    document.getElementById("end_date").min = startDate;
    
    calculateDuration();
  }
  
  function calculateDuration() {
    var startDate = document.getElementById("start_date").value;
    var endDate = document.getElementById("end_date").value;

    if (startDate && endDate) {
      var start = new Date(startDate);
      var end = new Date(endDate);
      var duration = Math.ceil((end - start) / (1000 * 60 * 60 * 24)); // Calculate the difference in days

      // Adjust the duration if the start and end dates are the same
      if (duration === 0) {
        duration = 1;
      } else {
        duration += 1;
      }

      document.getElementById("duration").value = duration + " days";
    }
  }
</script>

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
            url: "../app/actions/update_progress.php",
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

<script>
    function selectOption(event, option, rowId) {
        event.preventDefault(); // Prevent the default link behavior
        var dropdownButton = document.getElementById('dropdownMenuButton' + rowId);
        dropdownButton.textContent = option;

        // Remove existing classes
        dropdownButton.classList.remove("btn-warning", "btn-danger", "btn-success");

        // Add class based on selected option
        if (option === "Working on it") {
            dropdownButton.classList.add("btn-warning");
        } else if (option === "Stuck") {
            dropdownButton.classList.add("btn-danger");
        } else if (option === "Complete") {
            dropdownButton.classList.add("btn-success");
        }

        var dataId = event.target.getAttribute("data-id");
        $.ajax({
            url: "../app/actions/update_stat.php",
            method: "POST",
            data: { id: dataId, status: option },
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
<script>
    function editGantt(id) {
        $.ajax({
            url: "../pages/ganttChart/edit_gantt.php",
            method: "POST",
            data: { id: id },
                success: function (data) {
                    $('#edit-gantt').html(data);
                },
                error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

</script>

<script>
    function deleteTask(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "../actions/delete_task.php",
                    data: { id },
                    success: function(response) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000 
                        }).then(function() {
                            $('#task-'+id).fadeOut(1000, function() {
                                $(this).remove(); 
                            });
                        });
                    }
                });
            }
        });
    }
</script>






