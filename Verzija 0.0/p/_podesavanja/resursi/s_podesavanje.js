$(document).ready(function(){
	s_podesavanje_potvrdi();
});



/* POTVRDI */
function s_podesavanje_potvrdi(){	
	$('#btn_s_potvrdi').click(function(){
		var username = $('#sp_username').val();
		var naslov   = $('#sp_naslov').val();
		var sifra1   = $('#sp_sifra1').val();
		var sifra2   = $('#sp_sifra2').val();

		var msg = $(this).children('.sekcija_msg'); msg.text("");
		var greska = false;

		if(username!='_'){
				 if(username[0] == '_') { msg.text("Prvi karakter korisničkog imena sadrži ne dozvoljeni znak ('_')!"); return; }
			else if($.isNumeric(username[0])) { msg.text("Prvi karakter korisničkog imena sadrži broj, a to nije dozvoljeno!"); return; }
			else greska = s_provjeraKaraktera(username, ' '); if(greska) msg.text("Username zadrži ne dozvoljeni znak!");
		} 
		if(naslov!="") greska = s_provjeraKaraktera(naslov, ''); if(greska) msg.text("Naslov profila zadrži ne dozvoljeni znak!");
		if(sifra1=="" && sifra2!="" || sifra1!="" && sifra2==""){ greska = true; msg.text("Morate ukucati u prvom polju staru sifru, a u drugom novu! Ukoliko ne zelite da mijenjate siftu, ostavite oba polja prazna!"); }
		if(greska) return;

		$('#sp_sifra1').val(""); $('#sp_sifra2').val("");

		var dugme = $(this); dugme.attr('disabled', true); 
		var mem = dugme.children('.sekcija_potvrdi').text(); dugme.children('.sekcija_potvrdi').text("Sačekajte...");
		var data = '&username='+username+"&naslov="+naslov+"&sifra1="+sifra1+"&sifra2="+sifra2;

		$.ajax({
			url:'komunikator.php',
			data:'&akcija=s_podesavanje'+data,
			type:'POST',
			success: function(o){ msg.text(o); dugme.attr('disabled', false); dugme.children('.sekcija_potvrdi').text(mem);}
		});

	});	
}

function s_provjeraKaraktera(unos,dodatak){
	if(unos=="") return false;
	var greske = "';|=<>!?,@#$%^&*()+-`\"" + dodatak;
	for(var i = 0; i < unos.length; i++){
		for(var j=0;j<greske.length;j++){
			if(unos[i]==greske[j]) return true;
		}
	}
	return false;
}