<?php include("../init.php"); ?>
<form class="form-horizontal" method="post" id="addGantt" enctype="multipart/form-data">  
    <input type="hidden" name="action" value="add_gantt"> 

    <div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <label for="exampleInputName">Task:</label>
                <input type="text" id="task" name="task" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter Task" class="form-control">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <label for="exampleInputName">Date Start:</label>
                <input type="date" id="start_date" name="start_date" class="form-control">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <label for="exampleInputName">Date End:</label>
                <input type="date" id="end_date" name="end_date" class="form-control">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <label for="exampleInputName">Duration:</label>
                <input type="text" id="duration" name="duration" class="form-control" readonly>
            </div>
        </div>
    </div>

    <div class="form-group">
    <label for="exampleInputName">Select User:</label>
        <select name="user_id[]" class="form-control select2" style="width: 100%;" multiple>
            <?php  
            $query = $DB->prepare("SELECT * FROM users");
            $query->execute();
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                $cnt = 1;
                while ($user = $result->fetch_object()) { 
                    ?>
                    <option value="<?php echo $user->id ?>"><?php echo $user->fname . ' ' . $user->lname; ?></option>
                    <?php
                }
            }
            ?>
        </select>
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