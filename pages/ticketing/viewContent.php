<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-ticket-alt"></i> Ticketing</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= $home_link ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Ticketing</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            

            <!-- Main content -->
            <section class="content">
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
                                        <input type="hidden" name="action" value="ticketAction"> 
                                        <?= csrf_token(); ?>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label>Category:</label>
                                                    <select name="cat_id" class="form-control select2" style="width: 100%;">
                                                        <option value="">--- Select ---</option>
                                                        <?php  
                                                            $query = $DB->prepare("SELECT * FROM category");
                                                            $query->execute();
                                                            $result = $query->get_result();
                                                            if ($result->num_rows > 0) {
                                                                $cnt = 1;
                                                                while ($item = $result->fetch_object()) { 
                                                                    ?>
                                                                    <option value="<?php echo $item->id ?>"><?php echo $item->cat_name ?></option>
                                                                    <?php
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
                                                    <label>Urgency Level:</label>
                                                    <select name="urg_lvl" class="form-control select2" style="width: 100%;">
                                                        <option value="">--- Select ---</option>
                                                        <option>CRITICAL</option>
                                                        <option>HARD</option>
                                                        <option>MEDIUM</option>
                                                        <option>LOW</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label>Concern</label>
                                                    <textarea class="form-control" rows="4" id="no_accom" name="concern"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" name="btn-create" class="btn btn-primary">
                                                        <i class="fas fa-save"></i> Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>   
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-info-circle"></i> 
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-hover text-sm">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Ticket ID</th>
                                                    <th>Category</th>
                                                    <th>Concern</th>
                                                    <th>Urgency Level</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
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

<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/pages/ticketing/ticketsAjax.js"></script>

<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/js/addDailyTaskValidation.js"></script>

<script>
    function editTicket(id) {
        $.ajax({
            url: "../pages/accomplishment/edit-ticket.php",
            method: "POST",
            data: { id: id },
                success: function (data) {
                    $('#editTicket').html(data);
                },
                error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
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
                    url: "../actions/delete_ticket.php",
                    data: { id },
                    success: function(response) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000 
                        }).then(function() {
                            $('#ticket-'+id).fadeOut(1000, function() {
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

