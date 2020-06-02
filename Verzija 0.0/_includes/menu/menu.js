var _m_lokacija_sajta = "";
function __m_init(lokacija){
	_m_lokacija_sajta = lokacija;

	__m_realokacija_menuOpenera();
	__m_clikfadeeffect();
	__m_openClick();

	__m_menuBtns_init();
	__m_realokacija_menuBtns();
}
/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/* MENU OPENNER */
	function __m_realokacija_menuOpenera(){
		var centriranje = ($(window).height()/2)-($('#__m_openner').height())
		$('#__m_openner').css({'left':'40px', 'top':centriranje+'px'});
		$('#__m_opener_c').text(__m_opener_open);
	}
	function __m_clikfadeeffect(){
		$('#__m_opener_c').hover(function(){
			$('#__m_opener_c').stop().animate({'opacity':'1'}, 800);
		}, function(){
			$('#__m_opener_c').stop().animate({'opacity':'.6'}, 600);
		});
	}

	/* KLIK EVENT ZA OTvARANJE MENIJA */
	var __m_opener_open = "M E N U";
	var __m_opener_close = "Zatvori menu";
	function __m_openClick(){
		$('#__m_opener_c').click(function(){
			if($(this).text()==__m_opener_open){
				$(this).text(__m_opener_close);
				$('#__m').stop().animate({'left':'0px'}, 1000, "easeOutBounce");
			} else {
				$(this).text(__m_opener_open);
				$('#__m').stop().animate({'left':'-179px'}, 1000, "easeOutBounce");
			}
		});
	}

/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/* MENU BTNS */
	function __m_menuBtns_init(){
		__m_menuBtns_effect();
		__m_menuBtns_click();

		_m_prozor_init();
	}
	function __m_realokacija_menuBtns(){
		var pojedinacni_procenti = 70 / $('#_m_menuBar ._m_btn').length;
		$('._m_btn').css({'height':pojedinacni_procenti+'%'});
	}
	function __m_menuBtns_effect(){
		var color_memory = ""; var color_font = "";
		$('._m_btn').hover(function(){
			color_memory = $(this).css('background-color'); color_font = $(this).css('color');
			$(this).stop().animate({'background-color':'#444354', 'color':'#FFF'}, 500);
		}, function(){
			$(this).stop().animate({'background-color':color_memory, 'color':color_font}, 800);
		});	
	}
	function __m_menuBtns_click(){
		$('._m_btn').click(function(){
			if($(this).hasClass('_m_btn_in')) __m_menuBtns_click_in($(this));
			else __m_openProzor('_includes/menu/prozori/'+$(this).attr('id')+'.php', true);
		});	
	}	
	function __m_menuBtns_click_in(elem){ // specijalni slucajevi
		switch(elem.attr('id')){
			case "_m_id_odjava":
				$.ajax({
					type:"POST",
					url:_m_lokacija_sajta+="/_includes/login/logout.php",
					success: function(o){ alert(o); location.reload(); }
				});
				break;
			case "_m_id_podesavanja":
				window.location = _m_lokacija_sajta+"p/_podesavanja/", "_blank";
				break;
			case "_m_id_profil":
				window.location = _m_lokacija_sajta+"p/", "_blank";
				break;

		}
	}

	// ============================================================================
	// PROZORI
	function _m_prozor_init(){
		$('#__menu_prozor_close').click(function(){
			if(__m_isProzorOpened) __m_closeProzor();
		});
	}
	var __m_isProzorOpened = true;
	function __m_openProzor(url, promjeniUrl, data){
		if(__m_isProzorOpened) __m_closeProzor();
		if(promjeniUrl) url = _m_lokacija_sajta + url;
		__m_isProzorOpened = true;
		$('#__menu_prozor').fadeIn(500);
		$('#__menu_prozor_preloader').fadeIn(0);
		$('#__menu_prozor_content').fadeOut(0);

		$.ajax({
			type: 'POST',
			url: url,
			data: data,
			success: function(o){
				$('#__menu_prozor_content').html(o);
				$('#__menu_prozor_preloader').fadeOut(500);
				$('#__menu_prozor_content').fadeIn(500);
				proz_load($('.prozor_left').attr('id'), true, '');				
			}
		});
	}
	function __m_closeProzor(){
		__m_isProzorOpened = false;
		$('#__menu_prozor').fadeOut(500);
		$('#__menu_prozor_content').html("");
	}




