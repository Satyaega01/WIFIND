<?php
    require_once("../../connection.inc.php");
	require_once("../../function.inc.php");
	
    if((isset($_POST[passwordbaru]) AND !empty($_POST[passwordbaru])) AND (isset($_POST[passwordlama]) AND !empty($_POST[passwordlama]))){
        $hasil = $mysqli->query("SELECT password FROM tb_users WHERE username = '$_POST[uname]'"); 
        $data=$hasil->fetch_object();
        
        $passlama = cleanall(trim($_POST[passwordlama]));
		$pengacak = "ABFJDH4857HDGG635JFK";
		$passlamaEnkrip = md5($pengacak . md5($passlama) . $pengacak );
          
        if ($data->password == $passlamaEnkrip){
			
			$passbaru = cleanall(trim($_POST[passwordbaru]));
			$pengacak = "ABFJDH4857HDGG635JFK";
			$passbaruEnkrip = md5($pengacak . md5($passbaru) . $pengacak );
			$eksekusi = $mysqli->query("UPDATE tb_users SET password = '$passbaruEnkrip' WHERE username = '$_POST[uname]'");
			if ($eksekusi){
				echo '{"status":"1"}';
			}else{
				echo '{"status":"0"}';
			}
        }
        else{
			echo '{"status":"2","pesan":"Maaf, Password lama anda salah!"}';
        }
        exit;
    }
?>
