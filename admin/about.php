<?php 
$title = "SimpleGIS | About";
error_reporting(0);
header("Cache-Control: no-store, no-cache, must-revalidate");
require_once("cek_login.inc.php"); 
require_once("connection.inc.php");
require_once("header.inc.php"); 

$str="select * from tb_informasi where id_info = 1";
$res=$mysqli->query($str) or die ("query gagal dijalankan: ".$mysqli->error);
if ($res->num_rows == 1){	
	$data= $res->fetch_object();
	//----
	$idinfo = $data->id_info;
	$infoku = $data->content;
	$lastupdate = $data->last_update;
	//----
	$action="update";
}else{ ?>
	<div class="well">
		Maaf, Data tersebut tidak ditemukan. Mohon di-cek kembali!
	</div>	
<?php 
	exit;
}?>
    
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="mod_ajax/mod_info/info.js"></script>

<script type="text/javascript">
    tinymce.init({
		selector: "textarea#infoku",
		mode : "exact",
		theme: "modern",
      
      // ===========================================
      // INCLUDE THE PLUGIN
      // ===========================================
    	
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste responsivefilemanager"
      ],
	  
	  image_advtab: true,
    	
      // ===========================================
      // PUT PLUGIN'S BUTTON on the toolbar
      // ===========================================
    	
      //toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",
      //toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink image ",
      
	   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
	   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
		image_advtab: true ,
		
		
      // ===========================================
      // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
      // ===========================================
		external_filemanager_path:"/gmap-new/simplegis-gmap/admin/filemanager/",
		filemanager_title:"Responsive Filemanager" ,
		external_plugins: { "filemanager" : "/gmap-new/simplegis-gmap/admin/filemanager/plugin.min.js"},
		filemanager_access_key:"myPrivateKey",
		relative_urls: false
    });
     
    </script>
    <!-- /TinyMCE -->
	
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">About</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					About
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<form method="post" name="formInfo" action="" id="formInfo" role="form">
								<div class="form-group">
									<textarea id="infoku" name="infoku" class="form-control" rows="20"><?php echo $infoku;?></textarea>
								</div>								
								<input type="submit" value="Simpan" class="btn btn-primary">
								<input type="hidden" name="action" value="<?php echo $action;?>" />
								<input type="hidden" name="idinfo" value="<?php echo $idinfo;?>" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="divLoading"></div>
</div>

<?php include("footer.inc.php"); ?> 

