$(document).ready(function(){
	sekcija_init();
});

/* SEKCIJA*/
function sekcija_init(){
	// Zatvaranje sekcije
	$('.sekcija_naslov').click(function(){
		var parent = $(this).parent();
		if(parent.height()!=21) parent.css({'height':'21px'}); 
		else parent.css({'height':'auto'});
	});

	// Sekcija potvrdi hover
	$('.sekcija_slanje').hover(function(){ $(this).stop().animate({'background-color':'rgb(155, 255, 155)'}, 200);},
							   function(){$(this).stop().animate({'background-color':'rgb(199, 255, 199)'}, 200); });
	$('.sekcija_slanje .sekcija_potvrdi').text("Sačuvaj promjene"); $('.sekcija_slanje .sekcija_msg').text("");
}

/* PREMJESTANJE */
function promjenaPozicijeIBrisanje(){
	/* OVDJE SU FUNKCIJE ZA PREMJESTANJE I OSNOVNIH I DETALJNIJIH INFORMAICJA */
	$('body').on('click', '.info_btn_izbrisi', function(){
		var klasa = $(this).parent().parent().parent().attr('class');
		$(this).parent().parent().attr('id', 'izbrisi'); premjestanjeInfoPozicija(klasa);
	});
	$('body').on('click', '.info_btn_up', function(){
		var klasa = $(this).parent().parent().parent().attr('class');
		$(this).parent().parent().prev().attr('id', 'down'); premjestanjeInfoPozicija(klasa);	
	});
	$('body').on('click', '.info_btn_down', function(){
		var klasa = $(this).parent().parent().parent().attr('class');
		$(this).parent().parent().attr('id', 'down'); premjestanjeInfoPozicija(klasa);		
	});
}
function premjestanjeInfoPozicija(klasa){
	var div = ""; var mem = ""; var br = 0;
	$('.'+klasa+' .info_class').each(function(){
		if(klasa=="info_body"){
			var opis = $(this).find('.ptext_info_opis'); var naziv = $(this).find('.ptext_info_naziv');
			opis.attr('value', opis.val()); naziv.attr('value', naziv.val());
		} else if(klasa=="dinfo_body"){
			var opis = $(this).find('.ptext_dinfo_tekst'); var naziv = $(this).find('.ptext_dinfo_naziv');
			opis.text(opis.val()); naziv.attr('value', naziv.val());
		} else if(klasa=="socijal_body"){
			var socijal = $(this).find('.socijal_username'); socijal.attr('value', socijal.val());
		}

		if($(this).attr('id')=='izbrisi') return;
		else if($(this).attr('id')=='down') { mem = "<div class=\"info_class\">"+$(this).html()+"</div>"; return; }
		div+="<div class=\"info_class\">"+$(this).html()+"</div>";
		if(mem!="") { div+=mem; mem = ""; }
	});

	if(mem!="") div+=mem;
	$('.'+klasa).html(div);
}
