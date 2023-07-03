<div class="modal fade" id="modal-user">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus"></i> Add User
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
               <form class="form-horizontal" method="post" id="addUser" enctype="multipart/form-data">  
                    <input type="hidden" name="action" value="usersAction"> 

                    <?= csrf_token(); ?>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>First Name:</label>
                                <input type="text" name="fname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter First Name" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Middle Name:</label>
                                <input type="text" name="mname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Middle Name" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Last Name:</label>
                                <input type="text" name="lname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Last Name" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Username:</label>
                                <input type="text" id="username" name="username" placeholder="Enter Username" class="form-control">
                                <!-- <span id="usernameStatus" style="font-size: 9pt"></span> -->
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Password:</label>
                                <input type="password" name="password" placeholder="Enter Password" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Usertype:</label>
                                <select name="usertype" class="form-control">
                                    <option value=""> --- Select ---</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="MIS Officer">MIS Officer</option>
                                    <option value="Staff">Staff</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                    <label>Select Office:</label>
                        <select name="off_id" class="form-control select2" style="width: 100%;">
                            <option value="">-- Select --</option>
                            <?php  
                            $query = $DB->prepare("SELECT * FROM offices");
                            $query->execute();
                            $result = $query->get_result();
                            if ($result->num_rows > 0) {
                                $cnt = 1;
                                while ($office = $result->fetch_object()) { 
                                    ?>
                                    <option value="<?php echo $office->id ?>"><?php echo $office->office_abbr . ' ' . $office->office_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Gender:</label>
                                <select name="emp_gender" class="form-control">
                                    <option value=""> --- Select ---</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Profile:</label>
                                <input type="file" name="profile_image" id="profile_image" class="form-control">
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
            
            <div class="modal-footer justify-content-between">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>