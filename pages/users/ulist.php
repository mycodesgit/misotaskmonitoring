<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-users"></i> Users</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= $home_link ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Users</li>
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
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-user" style="background-color: #3c8dbc;">
                                            <i class="fas fa-user-plus"></i> Add User
                                        </button>
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <?= show_message(); ?>
                                <!-- Modal -->
                                <?php include 'pages/modal/add-user-modal.php';?>
                                <!-- /End Modal -->
                                
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-hover text-sm">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Profile</th>
                                                    <th>First Name</th>
                                                    <th>Middle Name</th>
                                                    <th>Last Name</th>
                                                    <th>Username</th>
                                                    <th>Office</th>
                                                    <th>Position</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $users = userRead();
                                                    
                                                    foreach ($users as $cnt => $user) {
                                                        $imageUrl = $user->profile_image ? dirname($_SERVER['PHP_SELF']) . "/assets/img/profile/" . $user->profile_image : dirname($_SERVER['PHP_SELF']) . "/assets/adminLTE-3/img/user.png";
                                                        ?>
                                                        <tr id="user-<?php echo $user->userid; ?>">
                                                            <td><?php echo $cnt + 1; ?></td>
                                                            <th>
                                                                <img alt="Avatar" class="img-circle" src="<?php echo $imageUrl; ?>" width="30px">
                                                            </th>
                                                            <td><?php echo $user->fname; ?></td>
                                                            <td><?php echo $user->mname; ?></td>
                                                            <td><?php echo $user->lname; ?></td>
                                                            <td><?php echo $user->username; ?></td>
                                                            <td><?php echo $user->office_abbr; ?></td>
                                                            <td><?php echo $user->usertype; ?></td>
                                                            <td>
                                                                <a href="<?= $userEditLink ?>?token=<?php echo $user->token; ?>" class="btn btn-info btn-xs" title="Edit">
                                                                    <i class="fas fa-info-circle"></i>
                                                                </a>
                                                                <a id="<?php echo $user->userid; ?>" onclick="deleteItem(this.id)" class="btn btn-danger btn-xs" title="Delete">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                <button data-id="<?php echo $user->id; ?>" class="btn btn-success btn-xs" value="0" onclick="updateUserStat(this)">
                                                                    <i class="fas fa-power-off"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
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

<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/js/addUserValidation.js"></script>

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
                    url: "../actions/usersAction.php",
                    data: { id:id, btnDeleteUser:true},
                    success: function(response) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000 
                        }).then(function() {
                            $('#user-' + id).fadeOut(1000, function() {
                                $(this).remove(); 
                            });
                        });
                    }
                });
            }
        });
    }
</script>

<script>
    function updateUserStat(element) {
        var id = element.getAttribute("data-id");
        var stat = element.value;

        // Alert verification message before making the AJAX request
        Swal.fire({
            title: 'Confirmation',
            text: 'Are you sure you want to logout this account?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with the AJAX request
                $.ajax({
                    type: "GET",
                    url: "../actions/update_userstat.php",
                    data: { id: id, stat: stat },
                    success: function (response) {
                        if (response === "success") {
                            Swal.fire(
                                'Logout this account!',
                                'The account has been successfully logout.',
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to logout.',
                                'error'
                            );
                        }
                    },
                    error: function () {
                        Swal.fire(
                            'Error!',
                            'An error occurred.',
                            'error'
                        );
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

