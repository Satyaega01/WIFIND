<?php
	error_reporting(0);
	session_start();
	require_once("../../connection.inc.php");
	require_once("../../function.inc.php");
	$from =  $_SERVER['REMOTE_ADDR'];
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = strtolower(cleanall(trim($_POST["uname"])));
		$password = cleanall(trim($_POST["passwd"]));
		$pengacak = "ABFJDH4857HDGG635JFK";
		$passEnkrip = md5($pengacak . md5($password) . $pengacak);

		if (ctype_alnum($username) OR ctype_alnum($password)){
			$res = $mysqli->query("SELECT * FROM `tb_users` WHERE `username` = '$username'
								AND `password` = '$passEnkrip' AND `status_blok` = 1");
			$ketemu = $res->num_rows;
			$r      = $res->fetch_object();						 
		
			if ($ketemu == 1){				
				$_SESSION['myusername'] = $r->username;
				$_SESSION['myname'] = $r->name;
				$_SESSION['mytype'] = $r->type;
				mysqli_free_result($res);
				echo '{"status":"1"}';
				
			}else{
				echo '{"status":"0"}';
			}
		}else{
			echo '{"status":"0"}';
		}		
	}
?>