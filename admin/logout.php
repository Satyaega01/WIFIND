<?php
	//error_reporting(0);
	require_once("cek_login.inc.php"); 
	require_once("connection.inc.php");
	require_once("function.inc.php");
	
	//$from =  $_SERVER['REMOTE_ADDR'];
	//$opr = $_SESSION['myusername'];
	//insActivity($opr,"Logout",$from);
	session_destroy();
	echo "<script language=javascript>window.location.href = 'index.php';</script>";
	exit;
?>