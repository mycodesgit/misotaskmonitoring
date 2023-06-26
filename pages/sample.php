<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'headerForm' ); ?>
<!-- Gantt Chart-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0"></h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#"></a></li>
							<!-- <li class="breadcrumb-item"><a href="#">Layout</a></li>
							<li class="breadcrumb-item active">Top Navigation</li> -->
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<div class="card">
			              	<div class="card-header">
			                	<h5 class="card-title m-0">
			                		<i class="fas fa-chart-bar"></i> Gantt Chart
			                	</h5>
			              	</div>
			              	<div class="card-body">
			                	<h6 class="card-title text-dark">
			                	</h6>
			                	<div id="chart_div"></div>
			              	</div>
			            </div>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content -->
	</div>

<script type="text/javascript">
    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = new google.visualization.DataTable();
            data.addColumn('string', 'Task ID');
            data.addColumn('string', 'Task Name');
            data.addColumn('string', 'Resource');
            data.addColumn('date', 'Start Date');
            data.addColumn('date', 'End Date');
            data.addColumn('number', 'Duration');
            data.addColumn('number', 'Percent Complete');
            data.addColumn('string', 'Dependencies');
            
            data.addRows([
                <?php  
                $sql = "SELECT * FROM ganttchart";
                $stmt = $DB->query($sql);
                while ($datarows = mysqli_fetch_assoc($stmt)){
                    $id = $datarows['id'];
                    $task = $datarows['task'];
                    $user_id = $datarows['user_id'];
                    $start_date = date('Y, m, d', strtotime($datarows['start_date']));
                    $end_date = date('Y, m, d', strtotime($datarows['end_date']));

                    $start_date_obj = new DateTime($datarows['start_date']);
                    $end_date_obj = new DateTime($datarows['end_date']);

                    $current_date = new DateTime();
                    
                    $total_days = $start_date_obj->diff($end_date_obj)->days;
                    $completed_days = $end_date_obj->diff($current_date)->days;

                    // Deduct the current date from the end date to calculate progress as 100%
                    $remaining_days = $end_date_obj->diff($current_date)->days;
                    $progress_percentage = ($total_days - $remaining_days) / $total_days * 100;
                    $progress_percentage = min(max($progress_percentage, 0), 100); // Ensure the percentage is within 0 to 100
                    $progress_percentage = round($progress_percentage, 2);
                    
                    ?>
                    ['<?php echo $id; ?>', '<?php echo $task; ?>', '<?php echo $user_id; ?>', new Date('<?php echo $start_date; ?>'), new Date('<?php echo $end_date; ?>'), null, <?php echo $progress_percentage; ?>, null],
                    <?php
                }
                ?>
            ]);


        var options = {
            height: 400,
            gantt: {
                trackHeight: 30
            }
        };

        var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

        chart.draw(data, options);

    }
</script>

<?= element( 'footerForm' ); ?>