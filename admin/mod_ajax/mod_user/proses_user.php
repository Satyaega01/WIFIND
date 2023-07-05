<?php 
	session_start();
	require_once("../../connection.inc.php");
	require_once("../../function.inc.php");
	
	$from =  $_SERVER['REMOTE_ADDR'];
	$action= $_POST['action'];
	$uname = cleanall($_POST['uname']);
	$nama = cleanall($_POST['nama']);
	$ktrole = cleanall($_POST['ktrole']);
	$pass = cleanall($_POST['pass']);
	$ktstatus = cleanall($_POST['ktstatus']);
	
	//add data
	if($action=="add") 
	{
		$cekkode = $mysqli->query("SELECT username FROM tb_users WHERE username='$uname'") or die ("query gagal dijalankan: ".$mysqli->error);
		if($cekkode && $cekkode->num_rows == 1){
			echo '{"status":"3"}';
		}else{
			
			$password = trim($pass);
			$pengacak = "ABFJDH4857HDGG635JFK";
			$passEnkrip = md5($pengacak . md5($password) . $pengacak );
			
			$cekq = $mysqli->query("INSERT INTO tb_users(username,password,name,type,status_blok) VALUES('$uname','$passEnkrip','$nama','$ktrole','$ktstatus')") or die ("query gagal dijalankan: ".$mysqli->error);
			//$sqlactivity = "Insert into tb_useractivity (user,tanggal,activity,ip) values ('".$_SESSION['myusername']."',NOW(),'Tambah Data User: $uname $ktrole','$from')";
			//if (!$mysqli->query($sqlactivity)) echo "Error : ".$mysqli->error();
			
			if ($cekq) {
				echo '{"status":"1"}';
			} else {
				echo '{"status":"0"}';
			}	
		}
		exit;
	}
	
	//update data
	else if($action=="update") 
	{
		if (isset($pass) && !empty($pass)) {
			$password = trim($pass);
			$pengacak = "ABFJDH4857HDGG635JFK";
			$passEnkrip = md5($pengacak . md5($password) . $pengacak );
		
			$cekq = $mysqli->query("UPDATE tb_users SET password='$passEnkrip',name='$nama',type='$ktrole',status_blok='$ktstatus' where username='$uname'") or die ("query gagal dijalankan: ".$mysqli->error);
		}else{
			$cekq = $mysqli->query("UPDATE tb_users SET name='$nama',type='$ktrole',status_blok='$ktstatus' where username='$uname'") or die ("query gagal dijalankan: ".$mysqli->error);
		}
		//$sqlactivity = "Insert into tb_useractivity (user,tanggal,activity,ip) values ('".$_SESSION['myusername']."',NOW(),'Edit Data User: $uname $ktrole','$from')";
		//if (!$mysqli->query($sqlactivity)) echo "Error : ".$mysqli->error;
			
		if ($cekq) {
			echo '{"status":"1"}';
		} else {
			echo '{"status":"0"}';
		}		
		exit;
	}
	
	//delete data 
	else if($action=="delete") 
	{
		$kode = $_POST['kode'];
		$test1 = $mysqli->query("delete from tb_users where username='$kode'") or die ("query gagal dijalankan: ".$mysqli->error);		
		
		//$sqlactivity = "Insert into tb_useractivity (user,tanggal,activity,ip) values ('".$_SESSION['myusername']."',NOW(),'Hapus Data User: $kode[$i]','$from')";
		//if (!$mysqli->query($sqlactivity)) echo "Error : ".$mysqli->error;
		
		if ($test1){
			echo '{"status":"1"}';
		}else{
			echo '{"status":"0"}';
		}
		exit;
	}
?>
