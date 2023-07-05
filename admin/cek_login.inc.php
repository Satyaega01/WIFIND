<?php
	//error_reporting(0);
	session_start();
	//echo $_SESSION['mytype'];
	if (strlen($_SESSION['myusername']) == 0 && strlen($_SESSION['myname']) == 0 && strlen($_SESSION['mytype']) == 0)  { 
		echo "<script language=javascript>window.location.href = 'index.php';</script>";
		exit;
	}
?>