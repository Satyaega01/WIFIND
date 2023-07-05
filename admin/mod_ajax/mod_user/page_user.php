<script type="text/javascript">

$('#datauser').DataTable({
	responsive: true,
	 "lengthMenu": [5, 10, 25, 50, "All"]
});	

function editme(url){
	page=url;
	$("#divFormContent").load(page); 
	return false;
}

function loadData(){
	page="mod_ajax/mod_user/page_user.php";
	$('#divPageData').load(page);
}

function deleteData(username){
	if(confirm("Apakah benar akan menghapus data user: "+username+" ini?\nPerhatian: Penghapusan user menyebabkan user bersangkutan tidak dapat login!")){
		
		var datastring = 'action=delete&kode='+username;
		$.ajax({
			url: "mod_ajax/mod_user/proses_user.php",
			data: datastring,
			type: "POST",
			dataType: 'json',
			success:function(response)
			{
				if(response.status == 1){
					loadData();
					$("#divFormContent").load("mod_ajax/mod_user/formuser.php");
					alert("Data berhasil di hapus!");
				}
				else{
					alert("Data gagal di hapus!");
				}
			}
		});
	}
	return false;
}
</script>

<?php
// class pagination
require_once("../../connection.inc.php");
session_start();

//if ($_SESSION['mytype'] == 'admin'){
	
$sql = "select * from tb_users order by type";
$res=$mysqli->query($sql)
//echo $sql;
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				List Data User
			</div>
		
			<div class="panel-body">
				<?php if($res->num_rows!=0){ ?>
				
				<table id="datauser" width="100%" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Username</th>
							<th>Nama</th>
							<th>Password</th>
							<th>Tipe User</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php while($row = $res->fetch_object()){ ?>
						<tr>
							<td ><?php echo $row->username;?></td>
							<!-- <td align="center" onclick='editme("mod_ajax/mod_user/formuser.php?act=update&kode=<?php echo $row->username;?>");' style="cursor:pointer;"><?php echo $row->username;?></td> -->
							<td ><?php echo $row->name;?></td>
							<td ><?php echo "********"; ?></td>
							<td ><?php echo $row->type;?></td>
							<?php if($row->status_blok == 1){ ?>
								<td style='color:green;'><b>Aktif</b></td>
							<?php }else{ ?>
								<td style='color:red;'><b>Non-Aktif</b></td>
							<?php } ?>
							<td >
								<button type="button" class="btn btn-warning" onclick='editme("mod_ajax/mod_user/formuser.php?act=update&kode=<?php echo $row->username;?>");' style="cursor:pointer;">Edit</button>
                                <button type="button" class="btn btn-danger" onclick='deleteData("<?php echo $row->username;?>");' style="cursor:pointer;">Delete</button> 
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
				<?php } else { ?>
				<div class="well">
					Data User tidak ditemukan..
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php mysqli_free_result($res); ?>

	
