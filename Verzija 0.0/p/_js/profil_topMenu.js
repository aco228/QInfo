$(document).ready(function(){
	ptm_realokacija();
	ptm_over_effect();
});

function ptm_realokacija(){
	var lokacija = ($(window).width()/2)-($('#profile_top_menu').width()/2);
	$('#profile_top_menu').css({'left':lokacija+'px'});
}
function ptm_over_effect(){
	$('.btn_topMenu').hover(function(){
		$(this).stop().animate({'top':'-5px'}, 500);
	}, function(){
		$(this).stop().animate({'top':'-25px'}, 500);
	});
}