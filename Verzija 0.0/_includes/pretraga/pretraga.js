$(document).ready(function(){
	___p_listen();
	___p_rezultati();
});	

var ___p_IS_OPEN = false; 

function ___p_listen(){
	$(window).keydown(function(e){
		var key = e.which;
		if(___p_IS_OPEN){
			//alert(key);
			if(key==27) ___p_close();
			else if(key==13) { e.preventDefault(); ___p_enter(); }
		} else {
			if($("*:focus").is("textarea, input")) return;
			if(key>=65 && key <=90) ___p_open(String.fromCharCode(key.which));
		}
	});
	$('#___pretraga_btnExit').click(function(){ ___p_close(); });
	$('#___pretragaR_btnExit').click(function(){ $('#___pretraga_rezultati').fadeOut(200); ___pR_IS_OPEN = false; });
	$('#___pretraga_btn').click(function(){ ___p_enter(); });
}
function ___p_open(unos){
	___p_IS_OPEN = true;
	$('#___pretraga').fadeIn(200);
	$('#___pretraga_input').text(unos);
	$('#___pretraga_input').focus();
}
function ___p_close(){
	if(___pR_IS_OPEN){
		$('#___pretraga_rezultati').fadeOut(200);
		___pR_IS_OPEN = false;
	} else { 
		$('#___pretraga').fadeOut(200, function(){ $('#___pretraga_input').val(''); });
		___p_IS_OPEN = false;
	}
}

var ___pR_IS_OPEN = false; 

function ___p_enter(){
	if(___pR_IS_OPEN) return;
	___pR_IS_OPEN = true;

	var rijec = $('#___pretraga_input').val();
	if(rijec=="") return;

	$('#__pretragaR_preloader').fadeIn(0);
	$('#__pretragaR_rezultati').html("");
	$('#___pretraga_rezultati').fadeIn(200);

	$('#___pretragaR_kljucneRijeci').text(rijec);
	$.ajax({
		data:'&key='+rijec,
		type:'POST',
		url:_m_lokacija_sajta+'/_includes/pretraga/rezultati.php',
		success:function(o){
			$('#__pretragaR_rezultati').html(o);
			$('#__pretragaR_preloader').fadeOut(200);
		}
	});
}

function ___p_rezultati(){
	$('#__pretragaR_rezultati').on('click', '.___pR', function(){
		var profil = $(this).attr('profileId');
		___p_profilOpen();
		$('#__pretragaP_preloader').fadeIn(0);

		$('#').fadeIn(0);
		$.ajax({
			data: '&id='+profil,
			type: 'POST',
			url:_m_lokacija_sajta+'/_includes/pretraga/profil.php',
			success: function(o){
				$('#___pretragaP').html(o);
				$('#__pretragaP_preloader').fadeOut(0);
			}
		});
	});
	$('#___pretragaP_close').click(function(){ __p_profilClose();});
}

var ___pr_PROFIL_IS_OPEN = false;
function ___p_profilOpen(){
	if(___pr_PROFIL_IS_OPEN) return;
	$('#___pretraga_profil').fadeIn(200);
	___pr_PROFIL_IS_OPEN = true;
}
function __p_profilClose(){
	$('#___pretraga_profil').fadeOut(200, function(){
		$('#___pretragaP').html("");
	});
	___pr_PROFIL_IS_OPEN = false;
}
