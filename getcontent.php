<?php
	require_once("admin/connection.inc.php");
	
	if(!empty($_GET['id'])){
		$str="select * from tb_informasi where id_info = {$_GET['id']}";
		$res=$mysqli->query($str) or die ("query gagal dijalankan: ".$mysqli->error);
		if ($res->num_rows == 1){	
			$data= $res->fetch_object();
			//----
			$idinfo = $data->id_info;
			$info = $data->content;
			$lastupdate = $data->last_update;
			echo html_entity_decode($info);
			//----
		}else{ ?>
			<div class="well">
				Maaf, Content tersebut tidak ditemukan..
			</div>	
		<?php 
			exit;
		}
	}else{?>
		<div class="well">
			Maaf, Content tersebut tidak ditemukan..
		</div>
	<?php 
	}
?>