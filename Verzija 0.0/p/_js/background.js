$(document).ready(function(){
	background_ucitavanje();
	//background_pokreti();
});
	
	var _background_w = -1;
	var _background_h = -1;
	var _ekran_w = -1;
	var _ekran_h = -1;

	function background_ucitavanje(){
		$('#back_image').fadeOut(0);

		var slika = new Image(); slika.src = __BACKGROUND;
		slika.onload = function(){
			_background_w = slika.width;
			_background_h = slika.height;
			_ekran_h = $(window).height();
			_ekran_w = $(window).width();

			$('#back_image').css({'background-image':'url('+__BACKGROUND+')'});
			$('#back_image').fadeIn(1000);
		};	
	}

	function background_pokreti(){
		$(document).mousemove(function(e){
			var x = e.pageX; var y = e.pageY;
			var procenatX = Math.floor(x/_ekran_w*100);
			var procenatY = Math.floor(y/_ekran_h*100);

			var pozicija_background = Math.floor(procenatX/_background_w*100);
			$('#back_image').css({"background-position":pozicija_background+'px 0px'});

			//$('#pM_vizitKartica').text(x+"."+y+" _ "+procenatX+" x "+procenatY);
		});
	}