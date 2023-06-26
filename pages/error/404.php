<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?php element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-exclamation-triangle"></i> 404</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= $home_link ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">404</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            

            <!-- Main content -->
            <section class="content">
                <div class="error-page">
					<h2 class="headline text-warning"> 404</h2>
					<div class="error-content">
						<h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
						<p>
							We could not find the page you were looking for.
							Meanwhile, you may <a href="<?= $home_link?>">return to dashboard</a> or try using the search form.
						</p>
					</div>
				</div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



<?= element( 'footer' ); ?>