<?php 
$title = "SimpleGIS | Ubah Password";
error_reporting(0);
header("Cache-Control: no-store, no-cache, must-revalidate");
require_once("cek_login.inc.php"); 
require_once("connection.inc.php");
require_once("header.inc.php"); 
?>       
<script type="text/javascript" src="mod_ajax/mod_ubahpass/password.js"></script>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">Ubah Password</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Data User</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6">
							<form method="post" name="formUbahPassword" action="" id="formUbahPassword" role="form">
								<div class="form-group">
									<label>Username</label>
									<input type="text" id="uname" name="uname" size="20" maxlength="10" readonly value="<?php echo $_SESSION[myusername];?>" class="form-control" >
								</div>
								<div class="form-group">
									<label>Nama Lengkap</label>
									<input type="text" id="namauser" name="namauser" size="30" maxlength="30" readonly value="<?php echo $_SESSION[myname];?>" class="form-control" >
								</div>
								<div class="form-group">
									<label>Password Lama</label>
									<input type="password" id="passwordlama" name="passwordlama" size="15" maxlength="15" class="form-control" placeholder="Password">
								</div>
								<div class="form-group">
									<label>Password Baru*</label>
									<input type="password" id="passwordbaru" name="passwordbaru" size="15" maxlength="15" class="form-control" placeholder="Password">
								</div>
								<div class="form-group">
									<label>Password Confirm*</label>
									<input type="password" id="passwordconfirm" name="passwordconfirm" size="15" maxlength="15" class="form-control" placeholder="Password Confirm">
								</div>
								<div class="form-group">
									<p class="help-block">*Panjang password minimal 6 karakter.</p>
								</div>
								<input type="submit" value="Update" class="btn btn-primary">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="divLoading"></div>
</div>

<?php include("footer.inc.php"); ?> 

