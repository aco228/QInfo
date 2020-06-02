$(document).ready(function(){
	socijal_getMreze();
	socijal_dodajVezu();
	socijal_potvrdi();
});	
var socijal_mreze;
function socijal_getMreze(){
	socijal_mreze = new Array(); var i = 0;
	$('.info_multioption option').each(function(){
		var red = new Array();
		red['naziv'] = $(this).text();
		red['slika'] = $(this).attr('pic');
		red['adresa'] = $(this).attr('adress');
		socijal_mreze[i] = [];
		socijal_mreze[i] = red;
		i++;
	});
}
function socijal_dodajVezu(){
	var veza_sablon = $('#socijal_style').html(); $('#socijal_style').html("");

	$('#info_dodajSocijal').click(function(){
		var ime= $('#socijal_select :selected').text();
		var adresa= $('#socijal_select :selected').attr('adress');
		var slika= $('#socijal_select :selected').attr('pic');

		$('.socijal_body').append(veza_sablon);

		var div = "<div class=\"socijal_pic\" style=\"background-image:url('../_slike/socijalne_mreze/"+slika+".png')\"></div>"
				+	"<div class=\"socijal_right\">"
				+		"<div class=\"socijal_siteurl\" tip=\""+ime+"\">"+adresa+"</div>"
				+		"<input type=\"text\" class=\"ptext pdinfo socijal_username\" unos=\"ne\" value=\"Username\"/>"
				+"</div>" ;

		$('#sablon').html(div);
		$('#sablon').attr('id','');
	});
}
function socijal_potvrdi(){
	$('#btn_s_socijal').click(function(){
		var msg = $(this).children('.sekcija_msg'); msg.text("");
		if($('.socijal_body .info_class').length==0) { msg.text("Niste upisali nijednu vezu!"); return; }

		var data = socijal_getData();
		if(data=="") return;
		
		var dugme = $(this); dugme.attr('disabled', true); 
		var mem = dugme.children('.sekcija_potvrdi').text(); dugme.children('.sekcija_potvrdi').text("Sačekajte...");
		$.ajax({
			url:'komunikator.php',
			data:'&akcija=s_socijal&data='+data,
			type:'POST',
			success: function(o){ msg.text(o); dugme.attr('disabled', false); dugme.children('.sekcija_potvrdi').text(mem);}
		});
	});
}
function socijal_getData(){
	var back = ""; var greska = false;
	$('.socijal_body .info_class').each(function(){
		var msg = $(this).find('.info_btn_err'); msg.html("");
		var user = $(this).find('.socijal_username');

		var username = "";
		if(user.attr('unos')=='ne' || user.val()=="") {msg.text("Niste upisali username tj. put prema vasem nalogu!"); greska = true; return; }
		username = user.val();
		if(s_socijal_getData_provjeraZnakova(username,' ')){msg.text("Username sadrži ne dozvoljene karaktere!"); greska = true; return; }

		var tip = $(this).find('.socijal_siteurl').attr('tip');
		if(tip==""){msg.text("Greška sa ovom vezom! Molimo vas da je izbrišete i ponovo upišete!"); greska = true; return; }

		var indeks = -1;
		for(var i=0;i<socijal_mreze.length;i++){
			if(socijal_mreze[i]['naziv']==tip) { indeks=i; break; }
		}
		if(indeks==-1){msg.text("Greška sa ovom vezom. Molimo vas da je izbrišete i ponovo upišete!"); greska = true; return; }

		back+=socijal_mreze[indeks]['adresa']+"|"+username+"|"+socijal_mreze[indeks]['naziv']+"|"+socijal_mreze[indeks]['slika']+"#";
	});
	if(!greska) return back;
	return "";
}
function s_socijal_getData_provjeraZnakova(unos, dodatak){
	if(unos=="") return false;
	var greske = "=|'\"#" + dodatak;
	for(var i = 0; i < unos.length; i++){
		for(var j=0;j<greske.length;j++){
			if(unos[i]==greske[j]) return true;
		}
	}
	return false;
}