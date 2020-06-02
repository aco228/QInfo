function lgn_init(){
	lgn_realociranje_boksa();
	lgn_tab_init();
	lgn_tab_change();
}
function lgn_realociranje_boksa(){
	var x = ($(window).width()/2)-($('#register_login').width()/2);
	var y = ($(window).height()/2)-($('#register_login').height()/2);

	$('#register_login').css({'top':y+'px','left':x+'px'});
}

var lgn_tabKojiSePrikazuje = "";
function lgn_tab_init(){
	var procenti = 100 / $('#tabovi ._tab').length;
	$('._tab').css({'width':procenti+'%'});

	var prvi_element = $('#tabovi').children().attr('id');
	$('#'+prvi_element).addClass('_tab_selekt');
	$('#tab_'+prvi_element).fadeIn(0);
	lgn_tabKojiSePrikazuje = prvi_element;
}
function lgn_tab_change(){
	$('._tab').click(function(){
		$('#tab_'+lgn_tabKojiSePrikazuje).fadeOut(0);
		$('._tab_selekt').removeClass('_tab_selekt');
		$(this).addClass('_tab_selekt');
		$('#tab_'+$(this).attr('id')).fadeIn(0);
		lgn_tabKojiSePrikazuje = $(this).attr('id');
	});
}

function lgn_init_once(){
	lgn_btns();
	lgn_checkBox();
}
function lgn_checkBox(){
	$('#ostani_prijavljen').click(function(){
		var element = $(this).children('.chekcbox_box');
		if(element.hasClass('ck_green')){
			element.removeClass('ck_green');
			element.addClass('ck_red');
		} else {
			element.removeClass('ck_red');
			element.addClass('ck_green');
		}
	});
}
function lgn_btns(){ 
	/* FOCUS */
	$('._tab_unos').focus(function(){ 
		$(this).css({'background-color': '#FFF'});
		$(this).attr('value', ""); 
		$(this).attr('ok', 't');
	}).focusout(function(){
		$(this).css({'background-color': 'rgba(255,255,255,0.7)'});
	});

	/* HOVER */
	$('._tab_btn').hover(function(){
		$(this).stop().animate({'background-color':'#FFF'}, 200);
	}, function(){
		$(this).stop().animate({'background-color':'rgba(255,255,255,0.7)'}, 400);
	});

	/* POTVRDA */
	$('._tab_btn').click(function(){ lgn_potvrdi('', $(this)); });
}
function lgn_potvrdi(id, inelem){
	var element; var parentId; var msg; var btn;  // elemnti za preuzimanje
	var email = ""; var sifra = ""; // info za data
	var data = ""; var url; // ajax

	if(id!=""){ element = $('#'+id); }
	else element = inelem;
	parentId = element.parent().attr('id');
	msg = element.parent().children('._tab_msg');
	btn = element.parent().children('._tab_btn');
	if(parentId=="tab_login"){
		if($('#unos_login_email').attr('ok')=='f' || $('#unos_login_sifra').attr('ok')=='f'){
			msg.text("Niste upisali email ili šifru"); return; } // Nije nista upisano
		if($('#ostani_prijavljen .chekcbox_box').hasClass('ck_green')) data+="&ostani_prijavljen=da"; // ostani prijavljen

		email = $('#unos_login_email').val();
		sifra = $('#unos_login_sifra').val(); 
		url = "_includes/login/login.php";
	} else if(parentId=="tab_registracija"){
		if($('#unos_registracija_email').attr('ok')=='f' || $('#unos_registracija_sifra').attr('ok')=='f'){
			msg.text("Niste upisali email ili šifru"); return; } // Nije nista upisano

		email = $('#unos_registracija_email').val();
		sifra = $('#unos_registracija_sifra').val(); 
		url = "_includes/registracija/registracija.php";
	}

	// Provere za prazno polje
	if(email=="" || sifra=="") { msg.text("Polje za email ili šifru je prazno!"); return; }
	if(lgn_validateEmail(email)){ msg.text("Pogrešan format mail-a!"); return; }

	var btn_cash_value = btn.val();
	btn.attr('disabled', true); btn.val("Sačekajte...");
	data += "&email="+email+"&sifra="+sifra;
	$.ajax({
		type:"POST",
		data:data,
		url:url,
		success:function(o){
			if(o!="") msg.text(o);
			else location.reload();
			btn.attr('disabled', false); btn.val(btn_cash_value);
		}
	});
}
function lgn_validateEmail(email){
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(email)) return true;
	return false; 
}