<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-calendar-alt"></i> Todo</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= $home_link ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Todo</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Add New Event/Activity
                                    </h3>
                                </div>
                                
                                <div class="card-body">
                                    <form class="form-horizontal" method="post" id="addCalendarEvent" enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="calendarEventAction">
                                        <input type="hidden" name="user_id" value="<?php echo $_SESSION[AUTH_ID]?>">

                                        <?= csrf_token(); ?>
                                        <?= show_message(); ?>
                                        
                                        <div class="form-group">
                                            <div class="form-row">  
                                                <div class="col-md-12">
                                                    <label for="inputName" class="">Title/Topic:</label>
                                                    <textarea name="title" class="form-control" rows="4" required autofocus></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">  
                                                <div class="col-md-12">
                                                    <label for="inputName" class="">Date Start:</label>
                                                    <input type="date" name="start_date" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="inputName" class="">Date End:</label>
                                                    <input type="date" name="end_date" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-sm-12">
                                                    <button type="submit" name="btn-submit" class="btn btn-primary">
                                                        <i class="fas fa-save"></i> SAVE
                                                    </button>

                                                    <button type="reset" class="btn btn-info">
                                                        <i class="fas fa-refresh"></i> Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->
        
<?php include './pages/script/load.php';?>
<?php include './pages/modal/view-event-modal.php';?>

<?= element( 'footer' ); ?>

<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/js/addCalendarValidation.js"></script>

<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>

