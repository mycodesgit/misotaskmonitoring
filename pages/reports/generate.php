<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>
<style>
    .alert.alert-outline-warning {
        border: 1px solid #ffc107 !important;
        background-color: #ffdc72 !important;
        color: #ffc107 !important;
    }
    .alert.alert-outline-warning h5 {
        color: #000 !important;
    }
    .alert.alert-outline-warning .icon {
        color: #000 !important;
    }
    .text-muted{
        color: #000 !important;
    }
</style>
<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-file-pdf"></i> Reports</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= $home_link ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Reports</li>
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
                                        <i class="fas fa-file-pdf"></i> Accomplishment Reports
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <?= show_message(); ?>
                                
                                <div class="card-body">
                                    <div class="alert alert-outline-warning alert-dismissible">
                                        <h5><i class="icon fas fa-exclamation-triangle"></i> Note!</h5>
                                        <div class="text-muted">Please check if you've completed your task within this month or within the range you've set to finish it before generating your <strong>Accomplishment Reports</strong>.</div>
                                    </div>

                                    <form class="form-horizontal" action="<?= $reportPDF_link ?>" method="get" enctype="multipart/form-data" id="generateReport" target="_blank">  

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-5">
                                                    <label>From:</label>
                                                    <input type="date" name="start_date" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>To:</label>
                                                    <input type="date" name="end_date" class="form-control">
                                                </div>
                                                <div class="col-md-1">
                                                    <label>&emsp;&emsp;Group:</label>
                                                    <input type="checkbox" name="group" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <button type="submit" name="generate" class="btn btn-primary"> 
                                                       <i class="fas fa-file-pdf"></i> Generate
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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

<?= element( 'footer' ); ?>

<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/js/generateReportValidation.js"></script>

<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>

