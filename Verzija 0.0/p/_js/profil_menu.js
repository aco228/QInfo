/* oznaka: pm_ */
$(document).ready(function(){
	pm_setUser();
});	
	var ___USER_ID = ''; var ___USER_status
	function pm_setUser() { 
		___USER_ID = ___getUser; 
		___USER_status = ___getStatus; 
		if(___USER_status=="nea"||___USER_status=="ban"||___USER_status=='none'){
			pm_load("_greska");
			$('#profile_menu').html("");
			$('#profile_top_menu').html(""); 
		} else {
			pm_init_lokacija();
			pm_rollover_funkcionalnost();
			pm_click_funkcionalnost();
			pm_init();
			pm_topMenu();
		}
	}

	/* POZICIJA MENU */
	function pm_init_lokacija(){
		var velicina_container = $('#profile_menu_container').width();
		var velicina_ekrana = $(window).width();

		var rezultat = (velicina_ekrana - velicina_container)/2;
		$('#profile_menu_container').css({'left':rezultat+'px'});

		/* LOKACIJA PRELOADER */
		var velicina_preloader = $('#profile_body_loader').width();
		var pm_PRELOADER_x = (velicina_ekrana - velicina_preloader)/2;
		velicina_ekrana = $(window).height();
		var pm_PRELOADER_y = (velicina_ekrana - velicina_preloader)/2;
		$('#profile_body_loader').css({'left':pm_PRELOADER_x+'px', 'top':pm_PRELOADER_y+'px'});
	}

	/* EFEKAT ZA MOUSE ENTER */
	function pm_rollover_funkcionalnost(){
		var predhodna_vrijednost;
		$('.pMenu').hover(function(){
			if($(this).hasClass('pmMenuUcitano')) return;
			predhodna_vrijednost = $(this).css('backgroundColor');
			$(this).stop().animate({'background-color':'#FFF', 'top':'1px'}, 500);
		}, function(){
			if($(this).hasClass('pmMenuUcitano')) return;
			$(this).stop().animate({'background-color':predhodna_vrijednost, 'top':'25px'}, 1000);

		});
	}

	/* KLIK FUNKCIONALNOST MENIJA */
	function pm_click_funkcionalnost(){
		$('.pMenu').click(function(){
			if($(this).hasClass('pmMenuUcitano')) return;

			$('.pmMenuUcitano').animate({'background-color':'rgb(205, 206, 207)', 'top':'25px'}, 1000);
			$('.pmMenuUcitano').removeClass('pmMenuUcitano');
			$(this).addClass('pmMenuUcitano');
			pm_load($(this).attr('id'));
		});
	}

	/* POCETNA KONFIGURACIJA */
	var _TRENUTNA_STRANICA = "";
	function pm_init(){
		// Ucitavanje prve stranice 'vizit karta'
		$('#pM_vizitKartica').animate({'background-color':'#FFF', 'top':'1px'}, 500);
		$('#pM_vizitKartica').addClass('pmMenuUcitano');
		pm_load('pM_vizitKartica');
	}

	/* LOAD STRANICA */
	function pm_load(stranica){
		if(_TRENUTNA_STRANICA!=""){
			$('.profile_body_fade').removeClass('profile_body_fade');
			$('#cash_'+_TRENUTNA_STRANICA).removeClass('profile_body_current');
			$('#cash_'+_TRENUTNA_STRANICA).addClass('profile_body_fade');
			_TRENUTNA_STRANICA = "";
		}
		
		// PROVJERA DA LI VEC POSTOJI STRANICA U CASH-u
		if($('#profile_body').find("#cash_"+stranica).length==1) { pm_ucitajStranicu("", stranica); return; }

		pm_prikaziPreloader(true);
		$.ajax({
			type:'POST',
			url:stranica+'.php',
			data:'&id='+___USER_ID+"&status="+___USER_status,
			success:function(o){ pm_ucitajStranicu(o, stranica); }
		});
	}
	function pm_ucitajStranicu(inhtml, id){ 
		var velicina_ekrana = $(window).width();

		if(inhtml!=""){ /* AJAX */
			$('#profile_body').append("<div class=\"profile_body_current\" id=\"cash_"+id+"\">"+inhtml+"</div>");
		} else { /* CASH */
			$('#cash_'+id).addClass('profile_body_current');
		}

		$('.profile_body_current').css({'left':velicina_ekrana+"px"});
		$('.profile_body_fade').animate({'left':'-'+velicina_ekrana+"px"}, 800, "easeOutCubic");
		$('.profile_body_current').animate({'left':"0px"}, 800, "easeOutCubic");

		_TRENUTNA_STRANICA = id;
		pm_prikaziPreloader(false);
	}
	function pm_prikaziPreloader(prikaz){
		if(prikaz) $('#profile_body_loader').fadeIn(255);
		else $('#profile_body_loader').fadeOut(255);
	}

/*=================================================================
	TOP MENU OPCIJE */

function pm_topMenu(){
	// DODAJ / IZBRISI PROFIL IZ PRIJATELJA
	$('#btn_addKontakt').click(function(){	
		if($(this).children('#btn_addKontakt_text').text()=="Sačekajte...") return;
		var friend = "Dodaj u svoje kontakte";
		var unfriend = "Izbriši iz svojih kontakata";


		var btn = $(this); var text = btn.children('#btn_addKontakt_text').text();
		btn.children('#btn_addKontakt_text').text("Sačekajte...");
		$.ajax({
			type: 'POST',
			data: "&status="+___USER_status+"&user="+___USER_ID,
			url: "_skripte/addFriend.php",
			success: function(o){
				alert(o);

				if(___USER_status=='visit'){
					___USER_status = 'friend';
					btn.children('#btn_addKontakt_text').text(unfriend);
				} else if(___USER_status=='friend'){
					___USER_status = 'visit';
					btn.children('#btn_addKontakt_text').text(friend);
				}

				btn.attr('disabled', false);
			}
		});
	});	
}