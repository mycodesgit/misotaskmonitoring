<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<?php
    $token = $_GET['t0K3n'];
    $data = getUserByToken($token);
?>

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-user"></i> User Account</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $home_link ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= $users_link ?>">Users</a></li>
                            <li class="breadcrumb-item active">User Account</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?= show_message(); ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-lock"></i> Change Password
                                </h3>
                            </div>
                             
                            <div class="card-body">
                                <form class="form-horizontal" method="post" id="updateUser">  
                                    <input type="hidden" name="action" value="usersAction">
                                    <?= csrf_token(); ?>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label for="exampleInputName">New Password:</label>
                                                <input type="text" name="password" placeholder="Enter New Password"class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="reset" class="btn btn-outline-danger">
                                                    Clear
                                                </button>
                                                <button type="submit" name="btn-updatePassword" class="btn btn-info">
                                                    <i class="fas fa-save"></i> Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>   
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-image"></i> Change Profile
                                </h3>
                            </div>
                             
                            <div class="card-body">
                                <form class="form-horizontal" method="post" id="updatePass" enctype="multipart/form-data">  
                                    <input type="hidden" name="action" value="usersAction">
                                    <?= csrf_token(); ?>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label for="exampleInputName">Upload New Photo:</label>
                                                <input type="file" name="profile_image" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="reset" class="btn btn-outline-danger">
                                                    Clear
                                                </button>
                                                <button type="submit" name="btn-updatePhoto" class="btn btn-info">
                                                    <i class="fas fa-save"></i> Upload
                                                </button>
                                            </div>
                                        </div>
                                    </div>   
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-exclamation-circle"></i> User Information
                                </h3>
                            </div>
                            
                            <div class="card-body">                               
                                <form class="form-horizontal" method="post" enctype="multipart/form-data" id="addUser">  
                                    <input type="hidden" name="action" value="usersAction">
                                    <?= csrf_token(); ?>
                                    
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="exampleInputName">First Name:</label>
                                                <input type="text" name="fname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter First Name" value="<?php echo $data->fname ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Middle Name:</label>
                                                <input type="text" name="mname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Middle Name" value="<?php echo $data->mname ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Last Name:</label>
                                                <input type="text" name="lname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Last Name" value="<?php echo $data->lname ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="exampleInputName">Username:</label>
                                                <input type="text" name="username" placeholder="Enter Username" value="<?php echo $data->username ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Gender:</label>
                                                <select name="emp_gender" class="form-control">
                                                    <option value=""> --- Select --- </option>
                                                    <option value="Male" <?php echo ($data->emp_gender == 'Male') ? 'selected="selected"' : '' ?>>Male</option>
                                                    <option value="Female" <?php echo ($data->emp_gender == 'Female') ? 'selected="selected"' : '' ?>>Female</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Usertype:</label>
                                                <select name="usertype" class="form-control">
                                                    <option value=""> --- Select --- </option>
                                                    <option value="Administrator" <?php echo ($data->usertype == 'Administrator') ? 'selected="selected"' : '' ?>>Administrator</option>
                                                    <option value="MIS Officer" <?php echo ($data->usertype == 'MIS Officer') ? 'selected="selected"' : '' ?>>MIS Officer</option>
                                                    <option value="Staff" <?php echo ($data->usertype == 'Staff') ? 'selected="selected"' : '' ?>>Staff</option>
                                                    <option value="User" <?php echo ($data->usertype == 'User') ? 'selected="selected"' : '' ?>>User</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <a href="<?= $users_link ?>" class="btn btn-outline-danger">
                                                    Cancel
                                                </a>
                                                <button type="submit" name="btn-update" class="btn btn-info">
                                                    <i class="fas fa-save"></i> Update
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

<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/js/addUserValidation.js"></script>



<script>
    setTimeout(function() {
        $('#alert').delay(2500).fadeOut(5000);
    },);
</script>