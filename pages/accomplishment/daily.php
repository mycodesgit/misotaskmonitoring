<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-calendar-alt"></i> Daily Task</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= $home_link ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Daily Task</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-plus"></i> Add
                                    </h3>
                                </div>
                                <?= show_message(); ?>
                                <div class="card-body">
                                    <form method="post" id="addDailyTask">
                                        <input type="hidden" name="action" value="dailyTaskAction"> 

                                        <?= csrf_token(); ?>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label>Task:</label>
                                                    <select name="task" class="form-control select2" style="width: 100%;">
                                                        <option value="">--- Select ---</option>
                                                        <?php
                                                            $tasks = getOptionTasks();
                                                            foreach ($tasks as $cnt => $data) { ?>
                                                                <option value="<?php echo $data->option_name ?>">
                                                                    <?php echo $data->option_name ?>    
                                                                </option>
                                                            <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label>No. of Accommodation:</label>
                                                    <textarea class="form-control" rows="4" id="no_accom" name="no_accom"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" name="btn-submit" class="btn btn-primary">
                                                        <i class="fas fa-save"></i> Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>   
                                    </form>
                                </div>
                            </div>
                            <div class="card bg-gradient-default">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i>
                                    Calendar
                                    </h3>
                                    <div class="card-tools">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                            <i class="fas fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a href="#" class="dropdown-item">Add new event</a>
                                                <a href="#" class="dropdown-item">Clear events</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item">View calendar</a>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-default btn-sm" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div id="calendar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="">
                                            <?php
                                                $selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('m');
                                                $selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
                                            ?>

                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col-md-4">
                                                        <label for="yearSelect">Select Year:</label>
                                                        <select class="form-control" id="yearSelect">
                                                            <?php
                                                            $currentYear = date('Y');
                                                            $years = array($currentYear);
                                                            for ($i = 1; $i <= 10; $i++) {
                                                                $prevYear = $currentYear - $i;
                                                                $years[] = $prevYear;
                                                            }

                                                            foreach ($years as $year) {
                                                                $selected = ($year == $selectedYear) ? 'selected' : '';
                                                                echo "<option value=\"$year\" $selected>$year</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="monthSelect">Select Month:</label>
                                                        <select class="form-control" id="monthSelect">
                                                            <?php
                                                            $months = array(
                                                                array('value' => '01', 'name' => 'January'),
                                                                array('value' => '02', 'name' => 'February'),
                                                                array('value' => '03', 'name' => 'March'),
                                                                array('value' => '04', 'name' => 'April'),
                                                                array('value' => '05', 'name' => 'May'),
                                                                array('value' => '06', 'name' => 'June'),
                                                                array('value' => '07', 'name' => 'July'),
                                                                array('value' => '08', 'name' => 'August'),
                                                                array('value' => '09', 'name' => 'September'),
                                                                array('value' => '10', 'name' => 'October'),
                                                                array('value' => '11', 'name' => 'November'),
                                                                array('value' => '12', 'name' => 'December')
                                                            );

                                                            foreach ($months as $month) {
                                                                $selected = ($month['value'] == $selectedMonth) ? 'selected' : '';
                                                                echo "<option value=\"{$month['value']}\" $selected>{$month['name']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="monthSelect">&nbsp;</label>
                                                        <button type="button" class="btn btn-secondary btn-block" onclick="filterTasks()">Filter</button>
                                                    </div>
                                                </div>
                                            </div>

                                        <table id="example4" class="table table-hover text-sm">
                                            <thead>
                                                <tr>
                                                    <th>Task</th>
                                                    <th>Accommodation</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $tasks = getDailyTasks($auth->id);
                                                foreach ($tasks as $cnt => $item) {
                                                    $taskMonth = date('m', strtotime($item->created_at));
                                                    $taskYear = date('Y', strtotime($item->created_at));
                                                    if ($taskYear == $selectedYear && $taskMonth == $selectedMonth) {
                                                ?>

                                                <tr id="daily-<?php echo $item->id; ?>">
                                                    <td><?php echo $item->task ?></td>
                                                    <td><?php echo $item->no_accom ?></td>
                                                    <td>
                                                        <a href="<?= $daily_taskEdit_link ?>?token=<?php echo $item->token ?>" class="btn btn-info btn-xs" title="Edit">
                                                            <i class="fas fa-info-circle"></i>
                                                        </a>
                                                        <a id="<?php echo $item->id ?>" onclick="deleteItem(this.id)" class="btn btn-danger btn-xs" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
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
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->
        
<?php include 'pages/accomplishment/modal.php';?>

<?= element( 'footer' ); ?>


<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/js/addDailyTaskValidation.js"></script>

<script>
    function filterTasks() {
        var month = document.getElementById("monthSelect").value;
        var year = document.getElementById("yearSelect").value;
        window.location.href = '?month=' + month + '&year=' + year;
    }
</script>


<script>
    function deleteItem(id) {
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
                    url: "../actions/dailyTaskAction.php",
                    data: { id:id, btnDelete:true},
                    success: function(response) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000 
                        }).then(function() {
                            $('#daily-' + id).fadeOut(1000, function() {
                                $(this).remove(); 
                            });
                        });
                    }
                });
            }
        });
    }
</script>


<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>

