<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'headerForm' ); ?>

<body class="hold-transition hold-transition login-page">
<div id="particles-js"></div>
<div class="box">
    <div class="card">
        <div class="card-body login-card-body">
        	<div class="row">
                <div class="col-md-7">
                    <p style="font-size: 19pt; font-family: 'Oxygen',sans-serif;" class="card-body">
                        Monitoring System for the University Frontline Services.
                    </p>

                    <br><br>
                    <p style="font-size: 9pt; font-family: 'Oxygen',sans-serif;" class="card-footer">
                        Develop and maintain by: Management Information System Office
                    </p>
                </div>

                <div class="col-md-5 pr-4 pl-4 pt-4" style="background-color: #d9d9d9">
                    <center>
                        <img src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/img/mislogoNoBG.png" width="60%">
                    </center>
                    <p>
                        <a href="./viewMonitoring" class="btn btn-primary btn-flat btn-block">Monitoring</a>
                    </p>
                    <p>
                        <a href="./login" class="btn btn-primary btn-flat btn-block">Login</a>
                    </p>
                </div>   
            </div>
        </div>
    </div>
</div>

<?= element ('footerForm'); ?>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/particles/particles.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/particles/app.js"></script>