$(document).ready(function(){

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
	
	$('#divLoading').ajaxStart(function(){
		$(this).fadeIn();
		$(this).html("<img src='img/ajax-loader.gif' /> ");
	}).ajaxStop(function(){
		$(this).fadeOut();
	});
	
	//submit form
	$("form#formInfo").submit(function(){
		var vInfo = $("textarea#infoku").val();
		//var vHidden = $("input[name=action]").val();
		
		if (vInfo.replace(/\s/g,"") == ""){
			alert("Mohon melengkapi content informasi!");
			$("textarea#infoku").focus();
		}
		else{  
			if (confirm("Apakah benar akan menyimpan informasi ini?")){
				$.ajax({
					url: "mod_ajax/mod_info/proses_info.php",
					type:$(this).attr("method"), 
					data:$(this).serialize(),
					dataType: 'json',
					success:function(response){
						if(response.status == 1){
							alert("Informasi berhasil diupdate!");
						}
						else if(response.status == 0){
							alert("Informasi gagal diupdate!");
						}
					}
				});
			}
		}
		return false;
	});
	
});
