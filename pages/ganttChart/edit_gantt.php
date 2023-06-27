<?php include("../../init.php"); ?>
<?php 
    $id = $_POST['id'];
    $query = $DB->prepare( "SELECT * FROM ganttchart WHERE id=$id");
    $query->execute();
    $result = $query->get_result();
    $data = $result->fetch_object();
?>
<form class="form-horizontal" method="post" id="addGantt" enctype="multipart/form-data">  
    <input type="hidden" name="action" value="update_gantt"> 
    <input type="hidden" name="id" value="<?php echo $id; ?>"> 
    <div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <label for="exampleInputName">Task:</label>
                <input type="text" id="task" name="task" value="<?php echo  $data->task; ?>" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter Task" class="form-control">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <label for="exampleInputName">Date Start:</label>
                <input type="date" id="start_date1" name="start_date" value="<?php echo  $data->start_date; ?>" class="form-control"  onchange="updateEndDateMin1()">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <label for="exampleInputName">Date End:</label>
                <input type="date" id="end_date1" name="end_date" value="<?php echo  $data->end_date; ?>" class="form-control" onchange="updateEndDateMin1()">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <label for="exampleInputName">Duration:</label>
                <input type="text" id="duration1" name="duration" value="<?php echo  $data->duration; ?>" class="form-control" readonly>
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
            while ($user = $result->fetch_object()) {
                $selected = '';
                $user_ids = explode(',', $data->user_id); // Convert the comma-separated string to an array of user IDs
                if (in_array($user->id, $user_ids)) {
                    $selected = 'selected';
                }
                ?>
                <option value="<?php echo $user->id ?>" <?php echo $selected ?>><?php echo $user->fname . ' ' . $user->lname; ?></option>
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

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
</script>

<script>
  function updateEndDateMin1() {
    var startDate = document.getElementById("start_date1").value;
    document.getElementById("end_date1").min = startDate;
    
    calculateDuration1();
  }
  
  function calculateDuration1() {
    var startDate = document.getElementById("start_date1").value;
    var endDate = document.getElementById("end_date1").value;

    if (startDate && endDate) {
      var start = new Date(startDate);
      var end = new Date(endDate);
      var duration = Math.ceil((end - start) / (1000 * 60 * 60 * 24)); // Calculate the difference in days

      // Adjust the duration if the start and end dates are the same
      if (duration === 0) {
        duration = 1;
      } else {
        duration += 1;
      }

      document.getElementById("duration1").value = duration + " days";
    }
  }
</script>