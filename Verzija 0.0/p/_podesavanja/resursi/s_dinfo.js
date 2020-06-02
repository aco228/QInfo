$(document).ready(function(){
	s_dinfo_init();
});

function s_dinfo_init(){
	//Brisanje prilikom unosa
	$('body').on('focus', '.pdinfo', function(){
		if($(this).attr('unos')=='ne'){ $(this).attr('value',''); $(this).text(""); $(this).attr('unos','');}
	});
	$('.ptext_dinfo_tekst').autosize();

	// Dodavanje novog paragrafa
	var novi_paragraf = $('#dinfo_style').html(); $('#dinfo_style').html("");
	$('#info_dodajDInfo').click(function(){
		$('.dinfo_body').append(novi_paragraf);
	});
	
	s_dinfo_potvrdi();
}

function s_dinfo_potvrdi(){
	$('#btn_s_dinfo').click(function(){
		var msg = $(this).children('.sekcija_msg'); msg.text("");
		if($('.dinfo_body .info_class').length==0) { msg.text("Niste upisali nijednu informaciju!"); return; }
		
		var data = s_dinfo_getData();
		if(data=="") return;
		var kljucne_rijeci = $('#kljucne_rijeci').val();

		var dugme = $(this); dugme.attr('disabled', true); 
		var mem = dugme.children('.sekcija_potvrdi').text(); dugme.children('.sekcija_potvrdi').text("Sačekajte...");

		$.ajax({
			url:'komunikator.php',
			data:'&akcija=s_dinfo&data='+data+"&kljucne_rijeci="+kljucne_rijeci,
			type:'POST',
			success: function(o){ msg.text(o); dugme.attr('disabled', false); dugme.children('.sekcija_potvrdi').text(mem);}
		});
	});
}
function s_dinfo_getData(){
	var greska = false;
	var back = "";
	$('.dinfo_body .info_class').each(function(){
		var msg = $(this).find('.info_btn_err'); msg.html("");
		var tekst = "";if($(this).find('.ptext_dinfo_tekst').attr('unos')!='ne') tekst=$(this).find('.ptext_dinfo_tekst').val();
		var naziv = "";if($(this).find('.ptext_dinfo_naziv').attr('unos')!='ne') naziv=$(this).find('.ptext_dinfo_naziv').val();

		if(tekst=="") { msg.text("Niste upisali tekst paragrafa"); greska = true; return; }
		if(naziv=="") { msg.text("Niste upisali naziv paragrafa"); greska = true; return; }
		var provjera_znaka = s_dinfo_getData_provjeraZnakova(tekst,'');
		if(provjera_znaka!="") { msg.text("Unijeli ste ne dozvoljeni znak u tekstu '"+provjera_znaka+"'"); greska = true; return; }
		provjera_znaka = s_dinfo_getData_provjeraZnakova(naziv,'');
		if(provjera_znaka!="") { msg.text("Unijeli ste ne dozvoljeni znak u nazivu '"+provjera_znaka+"'"); greska = true; return; }

		back += naziv + "|" + tekst + "#";
	});

	if(!greska) return back;
	else return "";
}
function s_dinfo_getData_provjeraZnakova(unos, dodatak){
	if(unos=="") return false;
	var greske = "=|#" + dodatak;
	for(var i = 0; i < unos.length; i++){
		for(var j=0;j<greske.length;j++){
			if(unos[i]==greske[j]) return greske[j];
		}
	}
	return "";
}