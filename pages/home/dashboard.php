<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fa fa-grip-horizontal"></i> Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">Dashboard</li>
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
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner" id="usersCountContainer">
                                    <h3></h3>
                                    <p>Users</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="<?= $users_link ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner" id="taskNowCountContainer">
                                    <h3></h3>
                                    <p>Ongoing Task</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-chart-bar"></i>
                                </div>
                                <a href="<?= $gantt_chart_link ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner" id="taskNowDoneContainer">
                                    <h3></h3>
                                    <p>Task Done this Month</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-check"></i>
                                </div>
                                <a href="<?= $gantt_chart_link ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner" id="taskNowStuckContainer">
                                    <h3></h3>
                                    <p>Task Stuck this Month</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-times"></i>
                                </div>
                                <a href="<?= $gantt_chart_link ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
<script>
    window.onload = function () {
        // Fetch response data from the server
        fetch('../pages/script/graphAjax.php')
            .then(response => response.json())
            .then(data => {
                var chartData = data.map(response => {
                    return { y: response.count, label: response.pursue_study };
                });

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "light2",
                    title: {
                        text: "Responses of Pursue Study and Not Pursue"
                    },
                    axisY: {
                        title: "Count"
                    },
                    data: [{
                        type: "column",
                        showInLegend: true,
                        legendMarkerColor: "grey",
                        legendText: "Count",
                        dataPoints: chartData
                    }]
                });

                chart.render();
            })
            .catch(error => {
                console.log(error);
            });
    }
</script>

<script>
    function updatePursueStudyCount() {
        $.ajax({
            url: '../pages/script/countAjax.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#usersCountContainer h3').text(data.users_count_total);
                $('#taskNowCountContainer h3').text(data.task_count_total); 
                $('#taskNowDoneContainer h3').text(data.taskdone_count_total); 
                $('#taskNowStuckContainer h3').text(data.taskstuck_count_total); 
            },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}
setInterval(updatePursueStudyCount, 2000);
</script>

<?= element( 'footer' ); ?>