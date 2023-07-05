<?php 
	session_start();
	require_once("../../connection.inc.php");
	require_once("../../function.inc.php");
	
	$from =  $_SERVER['REMOTE_ADDR'];
	$action= $_POST['action'];
	
	$idinfo = cleanall($_POST['idinfo']);
	$content = cleanall($_POST['infoku']);
		
	//update data
	if($action=="update") 
	{
		$cekq = $mysqli->query("UPDATE tb_informasi SET content = '$content',
													 last_update = now()
						WHERE id_info = '$idinfo'") or die ("query gagal dijalankan: ".$mysqli->error);
		
		if ($cekq) {
			echo '{"status":"1"}';
		} else {
			echo '{"status":"0"}';
		}	
		exit;
	}
?>
