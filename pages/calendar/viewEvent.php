<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
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
                <!-- Default box -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-event" style="background-color: #3c8dbc;">
                                            <i class="fas fa-plus"></i> Add New Event/Activity
                                        </button>
                                    </h3>
                                </div>
                                <!-- /.card-header -->`
                                
                                <div class="card-body">
                                    <div id="external-events">
                                        <div class="external-event bg-success">Lunch</div>
                                        <div class="external-event bg-warning">Go home</div>
                                        <div class="external-event bg-info">Do homework</div>
                                        <div class="external-event bg-primary">Work on UI design</div>
                                        <div class="external-event bg-danger">Sleep tight</div>
                                        <div class="checkbox">
                                            <label for="drop-remove">
                                                <input type="checkbox" id="drop-remove">
                                                    remove after drop
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
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
<?php include './pages/calendar/modal.php';?>

<?= element( 'footer' ); ?>



<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>

