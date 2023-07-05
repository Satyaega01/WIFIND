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
	
	
	
	showform();
	
	function showform(){
		page="mod_ajax/mod_user/formuser.php";
		$("#divFormContent").load(page);
		$("#divFormContent").show();
	}
	
	$("#btnreset").click(function(){
		showform();
		return false;
	});
	
	loadData();
	
	function loadData(){
		page="mod_ajax/mod_user/page_user.php";
		$("#divPageData").load(page);
	}
});
