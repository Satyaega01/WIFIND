
<script type="text/javascript">

$('#datamarker').DataTable({
	responsive: true,
	 "lengthMenu": [5, 10, 25, 50, "All"]
});	

function editme(url){
	page=url;
	$("#divFormContent").load(page); 
	return false;
}

function loadData(){
	page="mod_ajax/mod_marker/page_marker.php";
	$('#divPageData').load(page);
}

function deleteData(idmarker){
	if(confirm("Apakah benar akan menghapus data Marker dengan ID: "+idmarker+" ini?")){
		
		var datastring = 'action=delete&kode='+idmarker;
		$.ajax({
			url: "mod_ajax/mod_marker/proses_marker.php",
			data: datastring,
			type: "POST",
			dataType: 'json',
			success:function(response)
			{
				if(response.status == 1){
					loadData();
					$("#divFormContent").load("mod_ajax/mod_marker/formmarker.php");
					alert("Data berhasil dihapus!");
				}
				else{
					alert("Data gagal dihapus!");
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
	
$sql = "select * from tb_markers order by id asc";
$res=$mysqli->query($sql);
//echo $sql;
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				List Data Marker
			</div>
		
			<div class="panel-body">
				<?php if($res->num_rows!=0){ ?>
				
				<table id="datamarker" width="100%" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nama Lokasi</th>
							<th>Latitude</th>
							<th>Longitude</th>
							<th>Kategori</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php while($row = $res->fetch_object()){ ?>
						<tr>
							<td align="center"><?php echo $row->id;?></td>
							<td ><?php echo $row->name;?></td>
							<td ><?php echo $row->lat; ?></td>
							<td ><?php echo $row->lng; ?></td>
							<td ><?php echo $row->category; ?></td>
							<td >
								<button type="button" class="btn btn-warning" onclick='editme("mod_ajax/mod_marker/formmarker.php?act=update&kode=<?php echo $row->id;?>");' style="cursor:pointer;">Edit</button>
                                <button type="button" class="btn btn-danger" onclick='deleteData("<?php echo $row->id;?>");' style="cursor:pointer;">Delete</button> 
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
				<?php } else { ?>
				<div class="well">
					Data Marker tidak ditemukan..
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php mysqli_free_result($res); ?>
	
