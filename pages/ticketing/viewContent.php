<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>
<style>
    .ticket-number {
      display: inline-block;
      width: 110px; 
      text-align: center; 
      padding: 2px 8px; 
      background: linear-gradient(135deg, #00CC66, #33CC33); 
      color: #fff; 
      font-weight: bold;
      border: 2px solid #FFC107; 
      border-radius: 10px; 
      text-transform: uppercase;
      font-size: 14px; 
      letter-spacing: 2px;
      position: relative;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15); 
    }

    .ticket-number::before {
      content: "";
      position: absolute;
      top: -4px; 
      left: 0;
      width: 100%;
      height: 4px; 
      background: linear-gradient(135deg, #00CC66, #33CC33); 
      border-top-left-radius: 10px; 
      border-top-right-radius: 10px; 
    }

    .ticket-number::after {
      content: "";
      position: absolute;
      bottom: -4px; 
      left: 0;
      width: 100%;
      height: 4px; 
      background: linear-gradient(135deg, #00CC66, #33CC33); 
      border-bottom-left-radius: 10px; 
      border-bottom-right-radius: 10px; 
    }
    .floating-chat {
        position: fixed;
        bottom: 20px; 
        right: 2px; 
        z-index: 9999;
    }

</style>
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
                            <?php if($_GET['id'] == ""){?>
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
                                                    <select id="cat-id" name="cat_id" class="form-control select2" style="width: 100%;" required>
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
                                                    <label>Ticket Number</label>
                                                    <input class="form-control" id="ticket_no" name="ticket_no" placeholder="Ticket Number" readonly required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label>Urgency Level:</label>
                                                    <select name="urg_lvl" class="form-control select2" style="width: 100%;" required>
                                                        <option value="">--- Select ---</option>
                                                        <option value="1">CRITICAL</option>
                                                        <option value="2">HIGH</option>
                                                        <option value="3">MEDIUM</option>
                                                        <option value="4">LOW</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label>Concern</label>
                                                    <textarea class="form-control" rows="4" id="no_accom" name="concern" required></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <a href="viewContent?id=">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    </a>
                                                    <button type="submit" name="btn-create" class="btn btn-primary">
                                                        <i class="fas fa-save"></i> Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>   
                                    </form>
                                </div>
                            </div>
                            <?php } else {?>
                            <?php
                                $tickets = ticketReadData($_GET['id']);
                                foreach($tickets as $tick){
                            ?>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-plus"></i> Edit
                                    </h3>
                                </div>
                                <?= show_message(); ?>
                                <div class="card-body">
                                    <form method="post" id="addDailyTask">
                                        <input type="hidden" name="action" value="ticketAction"> 
                                        <input type="hidden" name="ticket_id" value="<?php echo $_GET['id']; ?>"> 
                                        <?= csrf_token(); ?>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label>Category: </label>
                                                    <select id="cat-id-no" name="cat_id" class="form-control select2" style="width: 100%;" required>
                                                        <option value="">--- Select ---</option>
                                                        <?php  
                                                            $query = $DB->prepare("SELECT * FROM category");
                                                            $query->execute();
                                                            $result = $query->get_result();
                                                            if ($result->num_rows > 0) {
                                                                $cnt = 1;
                                                                while ($item = $result->fetch_object()) { 
                                                                    ?>
                                                                    <option value="<?php echo $item->id ?>" <?php if($tick->cat_id == $item->id){echo"selected";}?>><?php echo $item->cat_name ?></option>
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
                                                    <label>Ticket Number</label>
                                                    <input class="form-control" id="ticket_no_edit" name="ticket_no" value="<?php echo $tick->code.'-'.$tick->ticket_no ?>" placeholder="Ticket Number" readonly required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label>Urgency Level:</label>
                                                    <select name="urg_lvl" class="form-control select2" style="width: 100%;" required>
                                                        <option value="">--- Select ---</option>
                                                        <option value="1" <?php if($tick->urg_lvl == 1){ echo "selected"; }?>>CRITICAL</option>
                                                        <option value="2" <?php if($tick->urg_lvl == 2){ echo "selected"; }?>>HIGH</option>
                                                        <option value="3" <?php if($tick->urg_lvl == 3){ echo "selected"; }?>>MEDIUM</option>
                                                        <option value="4" <?php if($tick->urg_lvl == 4){ echo "selected"; }?>>LOW</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label>Concern</label>
                                                    <textarea class="form-control" rows="4" id="no_accom" name="concern" required><?php echo $tick->concern ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <a href="viewContent?id=">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    </a>
                                                    <button type="submit" name="btn-update" class="btn btn-primary">
                                                        <i class="fas fa-save"></i> Update
                                                    </button>
                                                </div>
                                            </div>
                                        </div>   
                                    </form>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
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
                                                    <th>Ticket No.</th>
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
                        <div class="floating-chat">
                            <div class="col-md-10">
                                <div class="card direct-chat direct-chat-primary">
                                    <div class="card-header card-outline card-success">
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool expand-button" data-card-widget="">
                                                <i class="fas fa-comment" style="color: #28a745"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body" style="display: none;">
                                        <div class="direct-chat-messages">
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-left">Alexander Pierce</span>
                                                    <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                                </div>
                                                <img class="direct-chat-img" src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/dist/img/user1-128x128.jpg" alt="message user image">
                                                <div class="direct-chat-text">
                                                    Is this template really for free? That's unbelievable!
                                                </div>
                                            </div>
                                            <div class="direct-chat-msg right">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-right">Sarah Bullock</span>
                                                    <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                                </div>
                                                <img class="direct-chat-img" src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/dist/img/user3-128x128.jpg" alt="message user image">
                                                <div class="direct-chat-text">
                                                    You better believe it!
                                                </div>
                                            </div>
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-left">Alexander Pierce</span>
                                                    <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                                                </div>
                                                <img class="direct-chat-img" src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/dist/img/user1-128x128.jpg" alt="message user image">
                                                <div class="direct-chat-text">
                                                    Working with AdminLTE on a great new app! Wanna join?
                                                </div>
                                            </div>
                                            <div class="direct-chat-msg right">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-right">Sarah Bullock</span>
                                                    <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                                                </div>
                                                <img class="direct-chat-img" src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/dist/img/user3-128x128.jpg" alt="message user image">
                                                <div class="direct-chat-text">
                                                    I would love to.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer" style="display: none">
                                        <form action="#" method="post">
                                            <div class="input-group">
                                                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-warning">Send</button>
                                                </span>
                                            </div>
                                        </form>
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
<script>
    $(document).ready(function() {
    var dataTable = $('#example').DataTable({
        ajax: {
            url: "../pages/ticketing/ticketsAjaxTable.php",
            data: {
                sid: <?php echo $auth->id; ?> // Use the session value 'id'
            },
            dataSrc: "data"
        },        
        columns: [
            { data: 'no' },
            { data: 'ticket_no' },
            { data: 'cat_id' },
            { data: 'concern' },
            { data: 'urgency_level' },
            { data: 'status' },
            { data: 'actions' }
        ],
        responsive: false,
        lengthChange: false,
        searching: false,
        ordering: false,
        paging: false,
        createdRow: function(row, data, dataIndex) {
            var id = data.ticketId; 
            $(row).attr('id', 'ticket-' + id); 
            $(row).addClass('my-row-class'); 
        }
    });

    // Refresh the DataTable every 5 seconds
    setInterval(function() {
        dataTable.ajax.reload(null, false);
    }, 5000);
});
</script>

<script>
    $(document).ready(function() {
        $('.expand-button').click(function() {
            var cardBody = $(this).closest('.card').find('.card-body');
            var cardFooter = $(this).closest('.card').find('.card-footer');
            cardBody.slideToggle();
            cardFooter.slideToggle();
            scrollToBottom(cardBody);
        });

        function scrollToBottom(element) {
            element.scrollTop(element.prop("scrollHeight"));
        }
    });
</script>

<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/pages/ticketing/script.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/js/addDailyTaskValidation.js"></script>