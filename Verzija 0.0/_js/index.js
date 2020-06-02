$(document).ready(function(){
	$('#indx_body').fadeOut(0);
	indx_preloader_relocate();
});
function indx_preloader_relocate(){
	var x = ($(window).width()/2)-($('#indx_preloader').width()/2);
	var y = ($(window).height()/2)-($('#indx_preloader').height()/2);
	$('#indx_preloader').css({'top':y+'px','left':x+'px'});
}
function indx_load(reg, arg){
	if(reg=='da')   indx_loadPage('registrovan.php'); 
	else indx_loadPage('ne_registrovan.php'); 
}

function indx_loadPage(page){
	$.ajax({
		type:"POST",
		url:"index/"+page,
		success:function(o){
			$('#indx_body').html(o);
			$('#indx_body').fadeIn(2000);
			$('#indx_preloader').fadeOut(2000);
			// Init nove stranice
			if(page=='ne_registrovan.php'){ lgn_init(); lgn_init_once(); }
		}
	});
}
