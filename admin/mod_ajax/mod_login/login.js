$(document).ready(function(){

	$('#loading').ajaxStart(function(){

		$(this).show();

		$(this).html("<img src='img/ajax-loader.gif' /> ");

	}).ajaxStop(function(){

		$(this).hide();

	});

	

	$.ajaxSetup({

	  timeout: 35000,

	  cache: false,

		error:function(x,e){

			if(x.status==0){

			alert('Anda sedang offline!\nSilahkan cek koneksi anda!');

			}else if(x.status==404){

			alert('Permintaan URL tidak ditemukan!');

			}else if(x.status==500){

			alert('Internal Server Error!');

			}else if(e=='parsererror'){

			alert('Error.\nParsing JSON Request failed!');

			}else if(e=='timeout'){

			alert('Request Time out!');

			}else {

			alert('Error tidak diketahui: \n'+x.responseText);

			}

		}

	});

	$("#frmLogin").submit(function(){

		var vUname  = $("#uname").val();

		var vPasswd = $("#passwd").val();

		var myRegExp=/^\+62[0-9]+$/;

		var objcheckPassword = /^([0-9a-zA-Z])+$/;

		

		if (vUname.replace(/\s/g,"") == ""){

			alert("Masukkan username anda!");

			$("#uname").focus();

			return false;

		}else if (vPasswd.replace(/\s/g,"") == ""){

			alert("Masukkan password anda!");

			$("#passwd").focus();

			return false;

		}else if (!objcheckPassword.test(vPasswd)){

			alert("Password hanya mengandung karakter : a-z 0-9!");

			$("#passwd").focus();

			return false;

		}else{

			$.ajax({

				url: "mod_ajax/mod_login/login.php",

				type:$(this).attr("method"),

				data:$(this).serialize(),

				dataType: 'json',

				success:function(response){

					if(response.status == 1){

						window.location.href = "main.php";

					}

					else if (response.status == 0)

					{

						alert("Login Gagal..\nUsername atau Password salah!\nMohon dicek kembali.");

						window.location.href = "index.php";

						$("#uname").focus();

					}

				}

			});

			return false;

		}

		

	});

});          

