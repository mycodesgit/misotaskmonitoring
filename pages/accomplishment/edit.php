<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<?php
    $token = $_GET['token'];
    $stmt = $DB->prepare("SELECT * FROM accomplishment WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_object();
?>
<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-pen"></i> Edit</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= $home_link ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?= $daily_task_link ?>">Daily Task</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                         
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
                                                            $query = $DB->prepare("SELECT option_name FROM option_task");
                                                            $query->execute();
                                                            $result = $query->get_result();
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_object()) {
                                                                    $selected = ($row->option_name == $item->task) ? 'selected' : '';
                                                                    echo '<option value="' . $row->option_name . '" ' . $selected . '>' . $row->option_name . '</option>';
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label>No. of Accommodation:</label>
                                                    <textarea id="" class="form-control" rows="4" id="no_accom" name="no_accom"><?php echo $item->no_accom?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label>Date:</label>
                                                    <input type="date" id="" value="<?php echo $item->created_at; ?>" class="form-control" rows="4" id="created_at" name="created_at">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <a href="../accomplishment/daily" class="btn btn-danger">
                                                        Cancel
                                                    </a>
                                                    <button type="submit" name="btn-update" class="btn btn-primary">
                                                        <i class="fas fa-save"></i> Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>   
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->

<?= element( 'footer' ); ?>


<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/js/addDailyTaskValidation.js"></script>

<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>

