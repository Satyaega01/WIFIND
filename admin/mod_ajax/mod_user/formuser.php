<?php 
error_reporting(0);
require_once("../../connection.inc.php");
session_start();

$action="add";
$judul="Penambahan Data User";
$status="New";
if(isset($_GET['act']) and $_GET['act']=="update" and !empty($_GET['kode']))
{
	$str="select * from tb_users where username = '$_GET[kode]'";
	$res=$mysqli->query($str) or die ("query gagal dijalankan: ".$mysqli->error);
	if ($res->num_rows == 1){	
		$data= $res->fetch_object();
		//----
		$user = $data->username;
		$nama = $data->name;
		$tipeuser = $data->type;
		$stat = $data->status_blok;
		//----
		$action="update";
		$status="Update";
		$judul="Update Data User";
	}else{ ?>
		<div class="well">
			Maaf, Data tersebut tidak ditemukan. Mohon di-cek kembali!
		</div>	
	<?php 
		exit;
    }
}
?>
<script type="text/javascript">

$(function(){
	$("input#nama").focus();
	
	function loadData(){
		page="mod_ajax/mod_user/page_user.php";
		$("#divPageData").load(page);
	}
	
	$("form#formUser").submit(function(){
		var vUsername = $("input#uname").val();
		var vNama = $("input#nama").val();
		var vPassword = $("input#pass").val();
		var vPassConfirm = $("input#passconfirm").val();
		var vHidden = $("input[name=action]").val();
		var objcheckPassword = /^([0-9a-zA-Z])+$/;
		
		//alert (vHidden);
	  
		if (((vUsername.replace(/\s/g,"") == "") || (vNama.replace(/\s/g,"") == "") || (vPassword.replace(/\s/g,"") == "") || (vPassConfirm.replace(/\s/g,"") == "")) && vHidden == "add") {
			alert("Mohon melengkapi semua field data!");
			$("input#uname").focus();
		}
		else if (((vPassword.replace(/\s/g,"") != "") && (vPassConfirm.replace(/\s/g,"") == "") || (vPassword.replace(/\s/g,"") == "") && (vPassConfirm.replace(/\s/g,"") != "") || (vUsername.replace(/\s/g,"") == "") || (vNama.replace(/\s/g,"") == ""))  && vHidden == "update"){
			alert("Apabila akan melakukan update data pengguna atau password,\nlengkapi semua field dengan benar.");
			$("input#nama").focus();
		}
		else if (vPassword.length < 6 && vHidden == "add"){
		  alert("Minimal panjang password adalah 6 karakter!");
		  $("input#pass").focus();
		}
		else if (((vPassword.replace(/\s/g,"") != "") && (vPassConfirm.replace(/\s/g,"") != "")) && vPassword.length < 6 && vHidden == "update"){ 
			alert("Minimal panjang password adalah 6 karakter!");
		  $("input#pass").focus();
		}
		else if (!objcheckPassword.test(vPassword) && vHidden == "add"){
		  alert("Password yang diijinkan hanya mengandung karakter : a-z 0-9!");
		  $("input#pass").focus();
		}
		else if (((vPassword.replace(/\s/g,"") != "") && (vPassConfirm.replace(/\s/g,"") != "")) && !objcheckPassword.test(vPassword) && vHidden == "update"){
		  alert("Password Baru yang diijinkan hanya mengandung karakter : a-z 0-9!");
		  $("input#pass").focus();
		}
		else if(vPassword != vPassConfirm && vHidden == "add"){
		  alert("Password dan Password Verifikasi tidak cocok!");
		  $("input#pass").focus();
		}
		else if (((vPassword.replace(/\s/g,"") != "") && (vPassConfirm.replace(/\s/g,"") != "")) && vPassword != vPassConfirm && vHidden == "update"){
		  alert("Password Baru dan Password Verifikasi tidak cocok!");
		  $("input#pass").focus();
		}
		else{  
			if (confirm("Apakah benar akan menyimpan data user ini?")){
				$.ajax({
					url: "mod_ajax/mod_user/proses_user.php",
					type:$(this).attr("method"), 
					data:$(this).serialize(),
					dataType: 'json',
					success:function(response){
						if(response.status == 1){
							alert("Data berhasil disimpan!");
							loadData(); //reload list data	
							page="mod_ajax/mod_user/formuser.php";
							$("#divFormContent").load(page);
							$("#divFormContent").show();
						}
						else if(response.status == 0){
							alert("Data gagal di simpan!");
						}
						else if(response.status == 3){
							alert("Maaf, username tersebut telah terdaftar!");
							$("input[name=uname]").focus();
						}
					}
				});
			}
		}
		return false;
	});
});
</script>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $judul; ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6">
						<form method="post" name="formUser" action="" id="formUser" role="form">
							<?php if ($action == "update"){?>
							<div class="form-group">
								<label>Username</label>
								<input type="text" id="uname" name="uname" size="20" maxlength="10" readonly value="<?php echo $user; ?>" class="form-control" placeholder="Username">
							</div>
							<?php }else { ?>
							<div class="form-group">
								<label>Username</label>
								<input type="text" id="uname" name="uname" size="20" maxlength="10" class="form-control" placeholder="Username">
							</div>
							<?php } ?>
							<div class="form-group">
								<label>Nama</label>
								<input type="text" id="nama" name="nama" size="30" maxlength="30" value="<?php echo $nama; ?>" class="form-control" placeholder="Nama Lengkap">
							</div>
							<div class="form-group">
								<label>Tipe User</label>
								<select id="ktrole" name="ktrole" class="form-control">
									<option value='admin'<?php if ($tipeuser == 'admin') echo " selected";?>>Administrator</option>
									<option value='operator'<?php if ($tipeuser == 'operator') echo " selected";?>>Operator</option>
								</select>
							</div>
							<div class="form-group">
								<label>Status</label>
								<select id="ktstatus" name="ktstatus" class="form-control">
									<option value='1'<?php if ($stat == 1) echo " selected";?>>Aktif</option>
									<option value='0'<?php if ($stat == 0) echo " selected";?>>Non-Aktif</option>
								</select>
							</div>
							<div class="form-group">
								<label>Password*</label>
								<input type="password" id="pass" name="pass" size="15" maxlength="15" class="form-control" placeholder="Password">
							</div>
							<div class="form-group">
								<label>Password confirm*</label>
								<input type="password" id="passconfirm" name="passconfirm" size="15" maxlength="15" class="form-control" placeholder="Password confirm">
							</div>
							<?php if ($action == "update"){ ?>
							<div class="form-group">
								<p class="help-block">*Apabila password tidak diubah, dikosongkan saja. <br /> *) Panjang password minimal 6 karakter.</p>
							</div>
							<?php }else{ ?>
							<div class="form-group">
								<p class="help-block">*Panjang password minimal 6 karakter.</p>
							</div>
							<?php } ?>
							<input type="submit" value="<?php echo $status;?>" class="btn btn-primary">
							<input type="hidden" name="action" value="<?php echo $action;?>" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



