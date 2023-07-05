<?php 
	session_start();
	error_reporting(0);
	require_once("../../connection.inc.php");
	require_once("../../function.inc.php");
	
	$from =  $_SERVER['REMOTE_ADDR'];
	$action= $_POST['action'];
	
	$idmarker = cleanall($_POST['idmarker']);
	$namalokasi = cleanall($_POST['namalokasi']);
	$alamat = cleanall($_POST['alamat']);
	$latitude = cleanall($_POST['lat']);
	$longitude = cleanall($_POST['long']);
	$category = cleanall($_POST['ktstatcat']);
	
	//add data
	if($action=="add") 
	{	
		$max = 256000; //250 Kb
		$file_location = $_FILES['upload']['tmp_name'];
		$file_type = $_FILES['upload']['type'];
		$file_name = $_FILES['upload']['name'];
		$file_size = $_FILES['upload']['size'];
		
		// Apabila image kosong/tidak dipilih..
		if (empty($file_location)){
			$cekq = $mysqli->query("INSERT INTO tb_markers(name,
													 address,
													 lat,
													 lng,
													 category) 
								VALUES('$namalokasi',
									   '$alamat',
									   $latitude,
									   $longitude,
									   '$category')") or die ("query gagal dijalankan: ".$mysqli->error);
			if ($cekq) {
				echo '{"status":"1"}';
			} else {
				echo '{"status":"0"}';
			}	
		}else{
			if (($file_type != "image/jpg" || $file_type != "image/jpeg") && ($file_size > $max)){
				echo '{"status":"2"}'; //apabila syarat image tidak sesuai..
			}else{
				$namafile = "img-$idmarker.jpg";
				$simpan = "../../../admin/imgloc/$namafile"; //upload ke folder imgtab
				
				$cekq = $mysqli->query("INSERT INTO tb_markers(name,
													 address,
													 lat,
													 lng,
													 category,
													 foto) 
								VALUES('$namalokasi',
									   '$alamat',
									   $latitude,
									   $longitude,
									   '$jenistab',
									   '$namafile')") or die ("query gagal dijalankan: ".$mysqli->error);
				
				if ($cekq) {
					move_uploaded_file($file_location, $simpan);
					echo '{"status":"1"}';
				} else {
					echo '{"status":"0"}';
				}	
			}
		}
		exit;
	}
	
	//update data
	else if($action=="update") 
	{
		$max = 256000; //250 Kb
		$file_location = $_FILES['upload']['tmp_name'];
		$file_type = $_FILES['upload']['type'];
		$file_name = $_FILES['upload']['name'];
		$file_size = $_FILES['upload']['size'];
		
		 // Apabila gambar tidak diganti
		if (empty($file_location)){
		
			$cekq = $mysqli->query("UPDATE tb_markers SET id = '$idmarker',
													 name = '$namalokasi',
													 address = '$alamat',
													 lat = $latitude,
													 lng = $longitude,
													 category = '$category'
						WHERE id = '$idmarker'") or die ("query gagal dijalankan: ".$mysqli->error);
		
			if ($cekq) {
				echo '{"status":"1"}';
			} else {
				echo '{"status":"0"}';
			}	
			
		} else{
			if (($file_type != "image/jpg" || $file_type != "image/jpeg") && ($file_size > $max)){
				echo '{"status":"2"}';
			}else{
				$namafile = "img-$idmarker.jpg";
				$simpan = "../../../admin/imgloc/$namafile"; //upload ke folder imgtab
				$cekq = $mysqli->query("UPDATE tb_markers SET id = '$idmarker',
													 name = '$namalokasi',
													 address = '$alamat',
													 lat = $latitude,
													 lng = $longitude,
													 category = '$category',
													 foto = '$namafile'
						WHERE id = '$idmarker'") or die ("query gagal dijalankan: ".$mysqli->error);
		
				if ($cekq) {
					move_uploaded_file($file_location, $simpan);
					echo '{"status":"1"}';
				} else {
					echo '{"status":"0"}';
				}	
			}
		}
		exit;
	}
	
	//delete data 
	else if($action == "delete") 
	{
		$kode = $_POST['kode'];
		$cekimg = $mysqli->query("SELECT foto FROM tb_markers WHERE id = '$kode'") or die ("query gagal dijalankan: ".$mysqli->error);
		$data= $cekimg->fetch_object();
		if (!empty($data->foto)){
			$test = $mysqli->query("delete from tb_markers where id = '$kode'") or die ("query gagal dijalankan: ".$mysqli->error);
			if($mysqli->affected_rows == 1){ //jika jumlah baris data yang dikenai operasi delete == 1
				if (file_exists("admin/imgloc/$data->foto")){ //jika file image ada pada folder tersebut..
				  unlink("../../../admin/imgloc/$data->foto"); //delete image file..
				  echo '{"status":"1"}';
				}
				else{
				  echo '{"status":"1"}';
				}
			}else{
				echo '{"status":"0"}';
			} 
		}else{
			$test = $mysqli->query("delete from tb_markers where id = '$kode'") or die ("query gagal dijalankan: ".$mysqli->error);		
			if($mysqli->affected_rows == 1){ 
				echo '{"status":"1"}';
			}else{
				echo '{"status":"0"}';
			} 
		}
		exit;
	}
?>
