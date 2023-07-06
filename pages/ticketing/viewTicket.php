<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>
<style>
.ticket-number {
  display: inline-block;
  width: 110px; /* Fixed width */
  text-align: center; /* Center the text */
  padding: 2px 8px; /* Adjust padding to your preference */
  background: linear-gradient(135deg, #00CC66, #33CC33); /* Gradient background */
  color: #fff; /* Text color */
  font-weight: bold;
  border: 2px solid #FFC107; /* Border color */
  border-radius: 10px; /* Increased border radius for a rounded shape */
  text-transform: uppercase;
  font-size: 14px; /* Adjust font size to your preference */
  letter-spacing: 2px;
  position: relative;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15); /* Added box shadow for depth */
}

.ticket-number::before {
  content: "";
  position: absolute;
  top: -4px; /* Adjust top position to align with the card */
  left: 0;
  width: 100%;
  height: 4px; /* Increased height for a larger perforation */
  background: linear-gradient(135deg, #00CC66, #33CC33); /* Gradient background */
  border-top-left-radius: 10px; /* Increased border radius for a rounded shape */
  border-top-right-radius: 10px; /* Increased border radius for a rounded shape */
}

.ticket-number::after {
  content: "";
  position: absolute;
  bottom: -4px; /* Adjust bottom position to align with the card */
  left: 0;
  width: 100%;
  height: 4px; /* Increased height for a larger perforation */
  background: linear-gradient(135deg, #00CC66, #33CC33); /* Gradient background */
  border-bottom-left-radius: 10px; /* Increased border radius for a rounded shape */
  border-bottom-right-radius: 10px; /* Increased border radius for a rounded shape */
}
.status {
      position: relative;
      padding-right: 30px; /* Adjust this value to position the button properly */
    }
    .status-button {
      position: absolute;
      top: 0;
      right: 0;
    }
    .status-message {
      display: none;
      margin-top: 10px;
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-ticket-alt"></i> Ticket Request List
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-hover text-sm">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Full Name</th>
                                                    <th>Ticket No.</th>
                                                    <th>Office</th>
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

<?php include 'pages/ticketing/modal.php';?>
<?= element( 'footer' ); ?>

<script>
    $(document).ready(function() {
    var dataTable = $('#example').DataTable({
        ajax: {
            url: "../pages/ticketing/ticketsViewTable.php",
            dataSrc: "data"
        },        
        columns: [
            { data: 'no' },
            { data: 'fullname' },
            { data: 'ticket_no' },
            { data: 'office' },
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
    });

    // Refresh the DataTable every 5 seconds
    setInterval(function() {
        dataTable.ajax.reload(null, false);
    }, 5000);
});
</script>
<script>
  // Get all the badges with class "toggle-badge"
  const badges = document.querySelectorAll('.toggle-badge');

  // Add a click event listener to each badge
  badges.forEach(badge => {
    badge.addEventListener('click', () => {
      // Find the next sibling element with the class "hidden-message"
      const hiddenMessage = badge.nextElementSibling;

      // Toggle the visibility of the hidden message
      if (hiddenMessage.style.display === 'none') {
        hiddenMessage.style.display = 'block';
      } else {
        hiddenMessage.style.display = 'none';
      }
    });
  });
</script>

<script>
function toggleHiddenDiv(icon) {
    var hiddenDiv = icon.parentElement.nextElementSibling;
    hiddenDiv.style.display = hiddenDiv.style.display === 'none' ? 'block' : 'none';
}
</script>