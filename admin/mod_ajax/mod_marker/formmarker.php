<?php 
error_reporting(0);
require_once("../../connection.inc.php");
session_start();

$action="add";
$judul="Penambahan Data Marker";
$status="New";
if(isset($_GET['act']) and $_GET['act']=="update" and !empty($_GET['kode']))
{	
	$str="select * from tb_markers where id = '$_GET[kode]'";
	$res=$mysqli->query($str) or die ("query gagal dijalankan: ".$mysqli->error);
	if ($res->num_rows == 1){	
		$data= $res->fetch_object();
		//----
		$idmarker = $data->id;
		$namalokasi = $data->name;
		$alamat = $data->address;
		$statcat = $data->category;
		$lat = $data->lat;
		$lng = $data->lng;
		$img=$data->foto;
		//----
		$action="update";
		$status="Update";
		$judul="Update Data Marker";
	}else{ ?>
		<div class="well">
			Maaf, Data tersebut tidak ditemukan. Mohon di-cek kembali!
		</div>	
	<?php 
		exit;
    }
}
?>
<script type="text/javascript">

	var map, infoWindow;
	
	$(function(){
		$("input#namalokasi").focus();
		//alert(1);
		
		//mengatasi multiple load Google Maps API
		if(!window.google||!window.google.maps){
			//alert(1);
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAAgY3Vew0LpTLCBR_Sg98TKXrW_8Yk_4o&callback=initMap';
			document.body.appendChild(script);
		}
		else{
			//alert(2);
			initMap();
		}
		
		function loadData(){
			page="mod_ajax/mod_marker/page_marker.php";
			$("#divPageData").load(page);
		}
		
		//cek range latitude dan longitude
		function inrange(min,number,max){
			if ( !isNaN(number) && (number >= min) && (number <= max) ){
				return true;
			} else {
				return false;
			};
		}
		
		/*
		untuk form menggunakan 'jQuery Form Plugin' (http://jquery.malsup.com/form/)
		*/	
		var options = { 
		  dataType: 'json',
		  url: 'mod_ajax/mod_marker/proses_marker.php',
		  beforeSubmit: validate,  // pre-submit callback 
		  success: showResponse  // post-submit callback 

		  // other available options: 
		  //url:       url         // override for form's 'action' attribute 
		  //type:      type        // 'get' or 'post', override for form's 'method' attribute 
		  //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
		  //clearForm: true        // clear all form fields after successful submit 
		  //resetForm: true        // reset the form after successful submit 

		  // $.ajax options can be used here too, for example: 
		  //timeout:   3000 
		};
		
		// pre-submit callback 
		function validate(formData, jqForm, options) { 
			// fieldValue is a Form Plugin method that can be invoked to find the current value of a field 
			// To validate, we can capture the values of fields and return true only if evaluate to true 
			var vNamaLokasi = $("input#namalokasi").fieldValue();
			var vAlamat = $("textarea#alamat").fieldValue();
			var vLat = $("input#lat").fieldValue();
			var vLng = $("input#long").fieldValue();
			
			var objcheckNilai = /^([0-9])+$/;
			
			if (!vNamaLokasi[0]){
				alert("Mohon melengkapi field: Nama Lokasi!");
				$("input#namalokasi").focus();
				return false;
			}
			else if (!vAlamat[0]){
				alert("Mohon melengkapi field: Alamat!");
				$("textarea#alamat").focus();
				return false;
			}
			else if (!vLat[0]){
				alert("Mohon melengkapi field: Latitude!");
				$("input#lat").focus();
				return false;
			} 
			else if (inrange(-90,vLat[0],90) == false){
				alert("Nilai latitude salah!");
				$("input#lat").focus();
				return false;
			}	
			else if (!vLng[0]) {
				alert("Mohon melengkapi field: Longitude!");
				$("input#long").focus();
				return false;
			}
			else if (inrange(-180,vLng[0],180) == false){
				alert("Nilai longitude salah!");
				$("input#long").focus();
				return false;
			}	
		}
		
		// post-submit callback 
		function showResponse(responseText, statusText, xhr, $form)  {  
			if (statusText == 'success') {
				if(responseText.status == 1) // return nilai dari hasil proses
				{ 
					alert("Data Marker berhasil disimpan!");
					loadData(); //reload list data
					page="mod_ajax/mod_marker/formmarker.php";
					$("#divFormContent").load(page);
					$("#divFormContent").show();
				}
				else if (responseText.status == 2)
				{
					alert("Maaf, Pastikan image yg di-upload bertipe jpg/jpeg dan\nukuran image maksimal 250 Kb!");
				}
				return false;
			}
			else
			{
				alert("Data Marker gagal disimpan!");
				return false;
			}
		} 
		
		$("form#formMarker").submit(function(){
			if (confirm("Apakah benar akan menyimpan data Marker ini?")){
			  // inside event callbacks 'this' is the DOM element so we first 
			  // wrap it in a jQuery object and then invoke ajaxSubmit 
			  $(this).ajaxSubmit(options); 

			  // !!! Important !!! 
			  // always return false to prevent standard browser submit and page navigation 
			  //return false; 
			}
			return false; 
		});
		
	});
</script>

<script>
  
	function createMap(){
		map = new google.maps.Map(document.getElementById('map'), {
		   center: new google.maps.LatLng(-8.676488,115.211177),
		   zoom: 15,
		   mapTypeId: google.maps.MapTypeId.ROADMAP
		});
		
		return map;
	}
  
	function initMap(){
		
		infoWindow = new google.maps.InfoWindow;
		
		if ($("input[name=action]").val() == "update"){ //edit marker
			
			var point = new google.maps.LatLng(parseFloat($("#lat").val()), parseFloat($("#long").val()));
			map = createMap();
			
			var myMarker = new google.maps.Marker({
			  position: point,
			  draggable: true,
			  map: map
			}); 
			
			google.maps.event.addListener(myMarker, 'dragend', function(event){
				$("#lat").val(event.latLng.lat());
				$("#long").val(event.latLng.lng());
				infoWindow.setContent('Lat:'+ event.latLng.lat() +', Lng:'+ event.latLng.lng());
				infoWindow.open(map, myMarker);
			});
			 
			infoWindow.setContent('');
			infoWindow.setContent('Lat:'+ $("#lat").val() +', Lng:'+ $("#long").val());
			infoWindow.open(map, myMarker);		
		
		}else{ //add marker
			
			var point = new google.maps.LatLng(-8.676488,115.211177);
			map = createMap();
			
			var myMarker = new google.maps.Marker({
			  position: point,
			  draggable: true,
			  map: map
			}); 			
			
			google.maps.event.addListener(myMarker, 'dragend', function(event){
				$("#lat").val(event.latLng.lat());
				$("#long").val(event.latLng.lng());
				infoWindow.setContent('Lat:'+ event.latLng.lat() +', Lng:'+ event.latLng.lng());
				infoWindow.open(map, myMarker);
			});
			 
			infoWindow.setContent('');
			infoWindow.setContent('Lat:'+ point.lat() +', Lng:'+ point.lng());
			infoWindow.open(map, myMarker);	
		}
	} //akhir initMap()	

</script>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $judul; ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<form method="post" enctype="multipart/form-data" name="formMarker" action="" id="formMarker" role="form">
							<?php if ($action == "update"){?>
							<div class="form-group">
								<label>ID Marker</label>
								<input type="text" id="idmarker" name="idmarker" size="20" maxlength="10" readonly value="<?php echo $idmarker ; ?>" class="form-control" placeholder="ID Marker">
							</div>
							<?php } ?>
							<div class="form-group">
								<label>Nama Lokasi</label>
								<input type="text" id="namalokasi" name="namalokasi" size="30" maxlength="100" value="<?php echo $namalokasi; ?>" class="form-control" placeholder="Nama Lokasi">
							</div>
							<div class="form-group">
								<label>Alamat</label>
								<textarea id="alamat" name="alamat" maxlength="100" class="form-control" rows="3" placeholder="Alamat"><?php echo $alamat;?></textarea>
							</div>
							<div class="form-group">
								<label>Peta</label>
								<div id="map"></div>
							</div>
							<div class="form-group">
								<label>Latitude</label>
								<input type="input" id="lat" name="lat" size="30" maxlength="30" value="<?php echo $lat; ?>" class="form-control" placeholder="Latitude">
							</div>
							<div class="form-group">
								<label>Longitude</label>
								<input type="input" id="long" name="long" size="30" maxlength="30" value="<?php echo $lng; ?>" class="form-control" placeholder="Longitude">
							</div>
							<?php if ($action == "update"){?>
								<?php 
								if ($img != ''){
									echo "<div class=\"form-group\"><label>Image</label><br><img src='../admin/imgloc/$img'></div>";  
								} else {
									echo "<div class=\"form-group\"><label>Image</label><br><img src='../admin/img/noimage.gif'></div>";  
								}
								
								echo "<div class=\"form-group\"><label>Ganti Image</label><input type=\"file\" id=\"upload\" name=\"upload\" size=\"30\" /><br><i>Apabila image tidak diubah, dikosongkan saja.</i></div>";
							?>
							
							<?php } else { ?>
							<div class="form-group">
								<label>Image</label>
								<input type="file" id="upload" name="upload" size="30" /><br><i>Tipe image harus JPG/JPEG dan ukuran maks: 250 Kb</i>
							</div>
							<?php } ?>
							<div class="form-group">
								<label>Kategori Lokasi</label>
								<select id="ktstatcat" name="ktstatcat" class="form-control">
									<option value='university'<?php if ($statcat == "university") echo " selected";?>>University</option>
									<option value='hotel'<?php if ($statcat == "hotel") echo " selected";?>>Hotel</option>
									<option value='hospital'<?php if ($statcat == "hospital") echo " selected";?>>Hospital</option>
								</select>
							</div>
							<input type="submit" value="<?php echo $status;?>" class="btn btn-primary">
							<input type="hidden" name="action" value="<?php echo $action;?>" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



