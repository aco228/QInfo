$(document).ready(function(){
	proz_init();
});
function proz_init(){
	$('#__menu_prozor_content').on('click', '.proz_lft_itm_kat', function(){
		var element = $('#kat_box_'+$(this).text());
		//alert(element.css('display'));
		if(element.css('display')!='none') element.css({'display':'none'});
		else element.css({'display':'block'});
	});	
	// ITEM //
	$('#__menu_prozor_content').on('mouseenter', '.proz_lft_itm', function(){
		if($(this).hasClass('proz_lft_itm_kat')) return;
		$(this).css({'background-color':'#DBDBDB'});
		$(this).children('.proz_lft_itm_btn').stop().animate({'opacity':'1'}, 500);
	}).on('mouseleave', '.proz_lft_itm', function(){
		if($(this).hasClass('proz_lft_itm_kat')) return;
		$(this).css({'background-color':'#C7C7C7'});
		$(this).children('.proz_lft_itm_btn').stop().animate({'opacity':'.2'}, 500);
	});	
}

function proz_load(url, append_url, data){
	url =  _m_lokacija_sajta+"/_includes/menu/prozori/" + url; 
	$('#_prozor_preloader').fadeIn(500); $('.prozor_right').fadeOut(0);
	if(append_url) url += '_right.php';
	$.ajax({
		data:data,
		url:url,
		type:'POST',
		success: function(o) { 
			$('.prozor_right').html(o);
			$('#_prozor_preloader').fadeOut(500); $('.prozor_right').fadeIn(500);
		}
	});
}