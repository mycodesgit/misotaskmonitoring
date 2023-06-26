<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-file"></i> Notes</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= $home_link ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Notes</li>
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
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-file"></i>
                                    </h3>
                                </div>
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form-horizontal" method="post" id="addNotes" enctype="multipart/form-data">  
                                                <input type="hidden" name="action" value="add_user"> 

                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <label for="exampleInputName">Notes:</label>
                                                            <textarea id="compose-textarea" class="form-control" rows="4" name="" style="height: 300px"></textarea>
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
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-file"></i>
                                    </h3>
                                </div>
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                                $query = $DB->prepare( "SELECT * FROM notes" );
                                                $query->execute();
                                                $result = $query->get_result();
                                                if ($result->num_rows > 0) {
                                                    $cnt = 1;
                                                    while ($item = $result->fetch_object()) { ?>
                                                        <div class="card card-secondary card-outline">
                                                            <div class="card-header">
                                                                <h5 class="card-title">
                                                                    <?php echo $item->note_name ?>
                                                                </h5>
                                                                <div class="card-tools">
                                                                    <a href="#" class="btn btn-tool">
                                                                        <i class="fas fa-pen"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="">
                                                                    <i class="fas fa-exclamation-circle" style="color: #337ab7"></i>
                                                                    <label for="" class="">Bug Report</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php
                                                    
                                                    }
                                                } else {
                                                }
                                            ?>
                                        </div>
                                    </div>
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


<script src="assets/js/addNotesValidation.js"></script>




<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>

