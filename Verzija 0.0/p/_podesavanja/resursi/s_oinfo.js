$(document).ready(function(){
	osnovne_informacije_init();
	s_oinfo_potvrdi();
});

	/* OSNOVNE INFORMACIJE */
	function osnovne_informacije_init(){
		/* HOVER FUNKCIJE */
		$('body').on('mouseenter', '.info_btn', function(){ $(this).stop().animate({'background-color':'rgb(124, 176, 223)'},200); })
					   .on('mouseleave', '.info_btn', function(){ $(this).stop().animate({'background-color':'rgb(172, 195, 216)'},500);});
		$('body').on('mouseenter','.pcheckbox', function(){ $(this).stop().animate({'background-color':'rgb(230, 230, 230)'},200); }) 
				      .on('mouseleave','.pcheckbox', function(){ $(this).stop().animate({'background-color':'rgba(124, 176, 223,0)'},500);});
		$('body').on('click', '.pcheckbox', function(){
			if($(this).hasClass('pccheckbox_cover')) return; // dodatak za checkboxove za slike
			if($(this).attr('ok')=='da'){
				$(this).children('.pchechbox_box').removeClass('pgreen');
				$(this).children('.pchechbox_box').addClass('pred');
				$(this).attr('ok', 'ne');
			} else if ($(this).attr('ok')=='ne'){
				$(this).children('.pchechbox_box').removeClass('pred');
				$(this).children('.pchechbox_box').addClass('pgreen');
				$(this).attr('ok', 'da');
			}
		});
		$('body').on('mouseenter','.info_option', function(){ $(this).stop().animate({'background-color':'rgb(230, 230, 230)'},200); }) 
				 .on('mouseleave','.info_option', function(){ $(this).stop().animate({'background-color':'rgb(204, 172, 216)'},500);});
		$('body').on('focus','.ptext_info',function(){
			if($(this).attr('unos')=='ne') $(this).attr('value',"");
			$(this).stop().animate({'background-color':'#FFF'},500);
			$(this).attr('unos','da');
		}).on('focusout','.ptext_info',function(){ $(this).stop().animate({'background-color':'#E6ECEE'},500); });
		dodajInformaciju();
		promjenaPozicijeIBrisanje();
	}
	function dodajInformaciju(){
		var info_div = $('#info_style').html(); $('#info_style').html(""); 
		$('#info_dodajInfo').click(function(){
			$('.info_body').append(info_div);
		});	
	}

/* POTVRID */
function s_oinfo_potvrdi(){
	$('#btn_s_oinfo').click(function(){
		var msg = $(this).children('.sekcija_msg'); msg.text("");
		if($('.info_body .info_class').length==0) { msg.text("Niste upisali nijednu informaciju!"); return; }

		var data = s_oinfo_getData();
		if(data=="|") { data=""; msg.text("Dozvoljno je maksimalno 15 informacija na profil karticu!"); }
		if(data=="") return;

		var dugme = $(this); dugme.attr('disabled', true); 
		var mem = dugme.children('.sekcija_potvrdi').text(); dugme.children('.sekcija_potvrdi').text("Sačekajte...");

		$.ajax({
			url:'komunikator.php',
			data:'&akcija=s_oinfo&data='+data,
			type:'POST',
			success: function(o){ msg.text(o); dugme.attr('disabled', false); dugme.children('.sekcija_potvrdi').text(mem);}
		});
	});
}
function s_oinfo_getData(){
	var back = "";
	var greska = false; var broj_profil_kartica = 0;
	$('.info_body .info_class').each(function(){
		var msg = $(this).find('.info_btn_err'); msg.html("");
		var naziv = ""; if($(this).find('.ptext_info_naziv').attr('unos')=="da") naziv = $(this).find('.ptext_info_naziv').val();
		var opis = ""; if($(this).find('.ptext_info_opis').attr('unos')=="da") opis = $(this).find('.ptext_info_opis').val();

		if(naziv=="") { msg.html("Niste upisali naziv informacije"); greska=true; return; }
		if(opis=="") { msg.html("Niste upisali opis informacije"); greska=true; return; }
		if(s_oinfo_getData_provjeraZnakova(naziv,'')) { msg.html("Unijeli ste ne dozvoljeni znak u nazivu informacije"); greska=true; return; }
		if(s_oinfo_getData_provjeraZnakova(opis,'')) { msg.html("Unijeli ste ne dozvoljeni znak u opisu informacije"); greska=true; return; }
		
		var kartica = $(this).find('.pcheckbox_kartica').attr('ok');       if(kartica!="da" && kartica!="ne") kartica = "da";
		var privatnost = $(this).find('.pcheckbox_privatan').attr('ok'); if(privatnost!="da" && privatnost!="ne") privatnost = "ne";
		if(kartica=="da") broj_profil_kartica++;

		back += ""+naziv+"|"+opis+"|"+kartica+"|"+privatnost+"#";
	});

	if(broj_profil_kartica>15) return "|";
	else if(!greska) return back;
	else return "";
}
function s_oinfo_getData_provjeraZnakova(unos, dodatak){
	if(unos=="") return false;
	var greske = "=|'\"#" + dodatak;
	for(var i = 0; i < unos.length; i++){
		for(var j=0;j<greske.length;j++){
			if(unos[i]==greske[j]) return true;
		}
	}
	return false;
}