$(document).ready(function(){
	slike_initCover();
	slika_potvrda();
	if(typeof slike_msg_init_var!=="undefined") slike_msg_init();
});
function slike_msg_init(){
	var divs= '';
	if(typeof slike_msg_init_var['profile']!=='undefined'){
		var klasa="msggreen"; if(slike_msg_init_var['profile_err']) klasa="msgred";
		divs+="<div class=\"slika_msg "+klasa+"\">[PROFIL SLIKA]: "+slike_msg_init_var['profile']+"</div>";
	} if(typeof slike_msg_init_var['back']!=='undefined'){
		var klasa="msggreen"; if(slike_msg_init_var['back_err']) klasa="msgred";
		divs+="<div class=\"slika_msg "+klasa+"\">[POZADINSKA SLIKA]: "+slike_msg_init_var['back']+"</div>";
	} if(typeof slike_msg_init_var['cover']!=='undefined'){
		var klasa="msggreen"; if(slike_msg_init_var['cover_err']) klasa="msgred";
		divs+="<div class=\"slika_msg "+klasa+"\">[COVER SLIKA]: "+slike_msg_init_var['cover']+"</div>";
	}

	$('#slika_msg_div').html(divs);
	$('#s_slike').css({'height':'auto'});
	window.location.hash = '#s_slike';
}
function slike_initCover(){
	var x = ($('.slika_cover').height()/2)-($('.slika_cover_close_text').height()/2)
	var y = ($('.slika_cover').width() /2)-($('.slika_cover_close_text').width() /2)
	$('.slika_cover_close_text').css({'top':x+'px','left':y+'px'});

	$('.slika_cover').hover(function(){ $(this).children('.slika_cover_close').stop().fadeIn(500);  }, 
						    function(){ $(this).children('.slika_cover_close').stop().fadeOut(200); });

	{ // SMANJIVANJE VELICINE HOLDERA AKO JE COVER SAKRIVEN
		$('.slika_holder .slika_cover').each(function(){
			if($(this).css('display')=='none') $(this).parent().css({'height':'180px'});
		});
	}
	$('.slika_cover').click(function(){
		$(this).fadeOut(500);
		$(this).parent().children('.slika_tabs').fadeIn(500);
		$(this).parent().css({'height':'180px'});
	});
	$('.slika_tab_option').click(function(){
		if($(this).hasClass('.slika_tab_selected')) return;
		$(this).parent().children('.slika_tab_selected').removeClass('slika_tab_selected'); $(this).addClass('slika_tab_selected');
		var parent = $(this).parent().parent();
		switch($(this).attr('data')){
			case "slika_comp": parent.find('.slika_url').fadeOut(50); parent.find('.slika_comp').fadeIn(50); break;
			case "slika_url": parent.find('.slika_comp').fadeOut(50); parent.find('.slika_url').fadeIn(50); break;
			case "vrati_sliku": 
				var otac=$(this).parent().parent().parent(); 
				if(otac.children('.slika_cover').css('background-image')=="") return;
				otac.children('.slika_tabs').fadeOut(500); 
				otac.css({'height':'250px'});
				otac.children('.slika_cover').fadeIn(500);
		} 
	});

	//Cover checkboxs
	$('.pccheckbox_cover').click(function(){
		if($(this).attr('ok')=='da') return;
		$('.pccheckbox_cover .pgreen').each(function(){
			$(this).parent().attr('ok','ne'); 
			$(this).removeClass('pgreen'); $(this).addClass('pred');
		});
		$(this).attr('ok', 'da');
		$(this).children('.pchechbox_box').removeClass('pred'); $(this).children('.pchechbox_box').addClass('pgreen');
	});
}
function slika_potvrda(){
	$('#btn_s_slike').click(function(){
		var msg = $(this).children('.sekcija_msg'); msg.text("");

		// profile setup
		var profile = slika_provjeri_unos('profile', false);
		if(profile['greska']=='da') { msg.text(profile['greska_txt']+" (Profil slika)"); return; }

		var back = slika_provjeri_unos('back', false);
		if(back['greska']=='da') { msg.text(back['greska_txt']+" (Pozadinska slika)"); return; }

		var cover = slika_provjeri_unos('cover', true);
		if(cover['greska']=='da') { msg.text(cover['greska_txt']+" (Cover slika)"); return; }

		if(profile['upload']=='none' && cover['upload']=='none' && back['upload']=='none') { msg.text("Ništa niste promjenili!"); return; }
		var upload = false;
		if(profile['upload']=='da'||cover['upload']=='da'||back['upload']=='da') upload = true;

		var dugme = $(this); dugme.attr('disabled', true); 
		var mem = dugme.children('.sekcija_potvrdi').text(); dugme.children('.sekcija_potvrdi').text("Sačekajte...");
		$.ajax({
			url:'komunikator.php',
			data:'&akcija=s_slika&profile_upload='+profile['upload']+"&profile_url="+profile['url']+
								 "&back_upload="+back['upload']+"&back_url="+back['url']+
								 "&cover_upload="+cover['upload']+"&cover_url="+cover['url']+"&cover_copy="+cover['cover_copy'],
			type:'POST',
			success: function(o){ 
				if(upload){ $('#slika_upload').submit(); }
				else{
					msg.text(o); dugme.attr('disabled', false); dugme.children('.sekcija_potvrdi').text(mem);
				}
			}
		});

	});
}
function slika_provjeri_unos(klasa, cover){
	var back = new Array();
	back['klasa'] = klasa;
	back['greska'] = 'ne';
	back['greska_txt'] = '';
	back['url'] = '';
	back['cover_copy'] = '';

	var div = $('#slika_tab_'+klasa);
	if(div.css('display')=='none'){
		// Korisnik ne mijenja sliku
		back['upload'] = "none";
		return back;
	}
	if(div.find('.slika_comp').css('display')!='none'){
		// KORISTI SE UPLOAD
		back['upload']='da';
		if($('#fileid_'+klasa).val()=="") { back['greska']='da'; back['greska_txt']='Niste odabrali sliku sa računara!'; }
	} else {
		// NE KRISTI SE UPLOAD
		back['upload']='ne';
		if($('#slika_url_'+klasa).val()=="")  { back['greska']='da'; back['greska_txt']='Niste odabrali adresu sliku!'; }
		if(back['greska']=='ne' && !s_slika_getData_provjeraZnakova($('#slika_url_'+klasa).val()))
			{ back['greska']='da'; back['greska_txt']='U adresi slike ste unijeli ne dozvoljeni znak!'; }
		back['url'] = $('#slika_url_'+klasa).val();
		$('#fildeid_'+klasa).attr('value', '');
	}

	if(cover==true){
		var cupload = $('#cover_check_upload').attr('ok');
		var cback = $('#cover_check_back').attr('ok');
		var cprofile = $('#cover_check_cover').attr('ok');

		if(cupload=='ne'){
			if(back['greska']=='da') { back['greska']='ne'; back['greska_txt']=''; }
			back['upload']='ne';
			if(cback=='da') back['cover_copy'] = "back";
			else if(cprofile=='da') back['cover_copy'] = 'profile';
		}

		if(!slika_cover_check(cupload, cback, cprofile)) { back['greska']='da'; back['greska_txt']='Greška sa podešavanjima cover slike. Molimo vas ponovo učitajte stranicu!'; }
	}

	return back;
}
function slika_cover_check(cupload, cback, cprofile){
	var br = 0;
	if(cupload=='da')br++;
	if(cback=='da')br++;
	if(cprofile=='da')br++;
	if(br!=1) return false;
	return true;
}
function s_slika_getData_provjeraZnakova(unos, dodatak){
	if(unos=="") return false;
	var greske = "|'\"#" + dodatak;
	for(var i = 0; i < unos.length; i++){
		for(var j=0;j<greske.length;j++){
			if(unos[i]==greske[j]) return true;
		}
	}
	return false;
}