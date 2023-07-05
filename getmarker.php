<?php
header('Content-Type: application/json');

require_once("admin/connection.inc.php");
 
$sql = "SELECT * FROM tb_markers";
$data=$mysqli->query($sql) or die ("query gagal dijalankan: ".$mysqli->error);
 
$json   = array();
 
if (!empty($data)) {
    $json = '{"data": {';
    $json .= '"marker":[ ';
	while($x = $data->fetch_object()){
        $json .= '{';
        $json .= '"id":"'.$x->id.'",
                 "name":"'.htmlspecialchars_decode($x->name).'",
                 "address":"'.htmlspecialchars_decode($x->address).'",
                 "lat":"'.$x->lat.'",
                 "lng":"'.$x->lng.'",
				 "category":"'.$x->category.'"
                 },';
    }
    $json = substr($json,0,strlen($json)-1);
    $json .= ']';
    $json .= '}}';
    
    echo $json;
}