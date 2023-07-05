<?php 
$title = "SimpleGIS | Data Marker";
error_reporting(0);
header("Cache-Control: no-store, no-cache, must-revalidate");
require_once("cek_login.inc.php"); 
require_once("connection.inc.php");
require_once("header.inc.php"); 

//echo $_SESSION['mytype'];
?>       
	<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 350px;
      }
    </style>
	<script type="text/javascript" src="js/jquery.form.js"></script>
	<script type="text/javascript" src="mod_ajax/mod_marker/marker.js"></script>
	
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">Form Data Marker</h3>
		</div>
	</div>
	<div id="divFormContent"></div>
	<input type="button" id="btnreset" value="Reset Form" class="btn btn-success"><br /><br />
	<div id="divLoading"></div>
	<div id="divPageData"></div>
</div>

<?php include("footer.inc.php"); ?> 

