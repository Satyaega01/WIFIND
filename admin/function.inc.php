<?php
	function cleanall($data){
		global $mysqli;
		$filter = $mysqli->real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		return $filter;
	}

	function cleaninput($data){
		$filter = trim(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		return $filter;
	}
?>	