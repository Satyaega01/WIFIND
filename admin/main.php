<?php 
$title = "SimpleGIS | Home";
header("Cache-Control: no-store, no-cache, must-revalidate");
require_once("cek_login.inc.php"); 
require_once("connection.inc.php");
require_once("function.inc.php"); 
require_once("header.inc.php"); 
?>       

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">Dashboard</h3>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Selamat Datang
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<p align="justify">Halaman ini merupakan halaman administrasi untuk mengelola data-data terkait GIS. Data-data yang dikelola berupa data spasial dan data informasi terkait lokasi. Pada bagian sebelah kiri terdapat menu-menu yang dapat diakses untuk mengelola data-data tersebut.</p>
						</div>
						
					</div>
					<!-- /.row (nested) -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	
	<!--<div class="row">
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-support fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?php //echo sum_datafromsurveyor(); ?></div>
							<div>Tempat Aman Berkumpul</div>
						</div>
					</div>
				</div>
				<a href="formsurvey.php">
					<div class="panel-footer">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<!--<div class="col-lg-3 col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-tasks fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?php //echo sum_alldatasurvey(); ?></div>
							<div>All Data Survey</div>
						</div>
					</div>
				</div>
				<a href="datasurvey.php">
					<div class="panel-footer">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
	</div>-->
			
</div>



<?php include("footer.inc.php"); ?> 