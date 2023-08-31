<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<style type="text/css">
    .pin-icon {
        position: absolute;
        top: -5px;
        left: -5px;
        transform: rotate(-45deg);
        color: red;
    }
</style>
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
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-thumbtack"></i>
                                    </h3>
                                </div>
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form-horizontal" method="post" id="addNotes" enctype="multipart/form-data">  
                                                <input type="hidden" name="action" value="noteAction"> 

                                                <?= csrf_token(); ?>

                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <label for="exampleInputName">Note Title:</label>
                                                            <input type="text" name="note_title" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <label for="exampleInputName">Note Content:</label>
                                                            <textarea id="" class="form-control" rows="4" name="note_content"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <label for="exampleInputColor"></label>
                                                            <input type="hidden" name="note_color" value="#f5e961" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <button type="reset" class="btn btn-danger">
                                                                Clear
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

                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title col-md-12">
                                        <?= show_message(); ?>
                                    </h3>
                                </div>
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                                $notes = getNotes();
                                                foreach ($notes as $cnt => $data) {
                                                    $noteColor = isset($data->note_color) ? $data->note_color : '';
                                                    ?>
                                                    <div class="card col-md-4" style="background-color: <?= $noteColor; ?>; display: inline-block;">
                                                        <i class="fas fa-thumbtack pin-icon"></i>
                                                        <div class="card-header">
                                                            <h3 class="card-title">
                                                                <strong><?php echo $data->note_title ?></strong>
                                                            </h3>
                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool expand-button" data-card-widget=""  title="Expand">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="card-body" style="display: none;">
                                                            <?php echo $data->note_content ?>
                                                        </div>
                                                    </div>&nbsp;&nbsp;&nbsp;
                                                <?php
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


<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/js/addNotesValidation.js"></script>


<script>
    $(document).ready(function() {
        $('.expand-button').click(function() {
            $(this).closest('.card').find('.card-body').slideToggle();
        });
    });
</script>

<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>

