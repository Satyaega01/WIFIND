<?php 
$title = "SimpleGIS | Data User";
error_reporting(0);
header("Cache-Control: no-store, no-cache, must-revalidate");
require_once("cek_login.inc.php"); 
require_once("connection.inc.php");
if ($_SESSION['mytype'] != "admin"){
	header("location:main.php");
	exit;
}

//echo $_SESSION['mytype'];
require_once("header.inc.php"); 
?>       
<script src="mod_ajax/mod_user/user.js"></script>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">Data User</h3>
		</div>
	</div>
	<div id="divFormContent"></div>
	<input type="button" id="btnreset" value="Reset Form" class="btn btn-success"><br /><br />
	<div id="divLoading"></div>
	<div id="divPageData"></div>
</div>

<?php include("footer.inc.php"); ?> 

