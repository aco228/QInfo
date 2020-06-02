function pv_init(background){
	pv_coverImage(background);
	pv_relociranje();
}

var pv_sw = -1;
var pv_sh = -1;

/* COVER IMAAGE PROFILA */
function pv_coverImage(background){
	$('#vizit_cover').css({'background-image':'url('+background+')'});
	var slika = new Image(); slika.src = background;
	slika.onload = function(){
		pv_sh = slika.height*1.0;
		pv_sw = slika.width;
		//pv_coverPokreti();
		//alert($('#vizit_cover').width() + ' ' + $('#vizit_cover').outerHeight());
	}
}
//document.onselectstart = function(){ return false; }
function pv_coverPokreti(){
	$('#profile_body').on('click', '#vizit_cover', function(){
		alert("a");
		$(this).css({'cursor': 'url(../slike/profil_cover/zatvorena_ruka.cur) 4 4, move'});
	}, function(){

	});
}

/* REALOCIRANJE ELEMENATA U ZAVISNOSTI OD INFORMACIJA */
function pv_relociranje(){
	var velicina_infa = $('#info_naslov').height() + $('#vizit_kontakt').height();
	var velicina_kartice = $('#vizit_karta').height();

	var procenat = (velicina_infa/velicina_kartice)*100;
	var rezultat = 90 - procenat;
	if(rezultat>75) rezultat=75;

	$('#vizit_cover').css({'height':rezultat+'%'}); 
	rezultat-=20;
	$('#vizit_profile').css({'top':rezultat+'%'});
}


/*================================================================================*/
function pv_social_media_init(){
	realociranje_medija();

	var broj_medija = $('#socijalne_mreze .mreza').length;
	var velicina = (broj_medija*48)+(broj_medija*5)
	var velicina_karte = $('#vizit_karta').height();

	if(velicina<=velicina_karte) return;
	var nova_vrijednost = (velicina_karte/broj_medija)-5;
	$('.mreza').css({'height':nova_vrijednost+'px'});
	$('.mreza').hover(function(){

	});
}
function realociranje_medija(){
	var left = $('#vizit_karta').position().left + $('#vizit_karta').width()-12;
	$('#socijalne_mreze').css({'left':left+'px'});
}