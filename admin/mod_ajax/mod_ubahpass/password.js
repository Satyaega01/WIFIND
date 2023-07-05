$(document).ready(function(){
  $("input#passwordlama").focus();
   
	$('#loading').ajaxStart(function(){
		$(this).fadeIn();
		$(this).html("<img src='img/ajax-loader.gif' /> ");
	}).ajaxStop(function(){
		$(this).fadeOut();
	});
	
	//menangkap error dan menset parameter global (timeout, dll)
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
  
  function clear(){
    $("input#passwordlama").val("");
    $("input#passwordbaru").val("");
    $("input#passwordconfirm").val("");
    $("input#passwordlama").focus();
  }
  
  // $('input:radio[name=bar]:checked').val(); // get the value from a set of radio buttons
  // var test = $('input:text[name=nama]').val(); //mendapatkan input text value (dengan name=nama)
  
  $("form#formUbahPassword").submit(function(){ 
    var vPassLama = $("input#passwordlama").val();
    var vPassBaru = $("input#passwordbaru").val();
    var vPassConfirm = $("input#passwordconfirm").val();
    var objcheckPassword = /^([0-9a-zA-Z])+$/;
    
    if ((vPassLama.replace(/\s/g,"") == "") || (vPassBaru.replace(/\s/g,"") == "") || (vPassConfirm.replace(/\s/g,"") == "") ){ 
    	alert("Mohon lengkapi semua field yang ada!");
    	$("input#passwordlama").focus();
    }
    else if (vPassBaru.length < 6 ){
      alert("Minimal panjang password adalah 6 karakter!");
      $("input#passwordbaru").focus();
    }
    else if (!objcheckPassword.test(vPassBaru)){
      alert("Password Baru yang diijinkan hanya mengandung karakter : a-z 0-9!");
      $("input#passwordbaru").focus();
    }
    else if(vPassBaru != vPassConfirm){
      alert("Password Baru dan Password Verifikasi tidak cocok!");
      $("input#passwordbaru").focus();
    }
    else{
		if (confirm("Apakah benar anda akan melakukan perubahan password?")){
			$.ajax({
				url: "mod_ajax/mod_ubahpass/password_proses.php",
				type:$(this).attr("method"),
				dataType: 'json',
				data:$(this).serialize(),
				success:function(response)
				{
					if(response.status == 1) // return data dari hasil proses
					{
						alert("Perubahan password berhasil dilakukan!");
						clear();
					}
					else if(response.status == 0){
						alert("Data gagal di simpan!");
						$("input#passwordlama").focus();
					}
					else if(response.status == 2){
						alert(response.pesan);
						$("input#passwordlama").focus();
					}
				}
			});
    	}
    }
    return false;
  });
});
