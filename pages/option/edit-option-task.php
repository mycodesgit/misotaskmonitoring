<?php include("../../init.php"); ?>

<?php 
    $id = $_POST['id'];
    $query = $DB->prepare( "SELECT * FROM option_task WHERE id=$id");
    $query->execute();
    $result = $query->get_result();
    $task = $result->fetch_object();
?>
<form class="form-horizontal" method="post" id="addGantt" enctype="multipart/form-data">  
    <input type="hidden" name="action" value="update_optiontask"> 
    <input type="hidden" name="id" value="<?php echo $id; ?>"> 

    <div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <label for="exampleInputName">Task:</label>
                <input type="text" id="option_name" name="option_name" value="<?php echo  $task->option_name; ?>" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter Task" class="form-control">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Close
                </button>
                <button type="submit" name="btn-update" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save
                </button>
            </div>
        </div>
    </div>   
</form>

