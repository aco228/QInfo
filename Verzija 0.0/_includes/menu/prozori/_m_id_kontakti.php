<?php
	include_once("../../../_engine/init.php");
	include_once("../skripte/Kontakti.php"); $Kontakti = new Kontakti(_getBaza(), $__USER_ID);
	$kontakti = $Kontakti->getKontakti();
?>
<link rel="stylesheet" type="text/css" href="<?php echo iGetSiteAdresa(); ?>/_includes/menu/prozori/_m_id_kontakti.css">
<script type="text/javascript">
$(document).ready(function(){
	$('.proz_lft_itm').click(function(){
		if($(this).hasClass('proz_lft_itm_kat')) return;
		if($(this).attr('idprofile')=='process') return;
		proz_load('_m_id_kontakti', true, '&id='+$(this).attr('idprofile'));
	});

	$('#__menu_prozor_content').on('click', '.proz_lft_itm_btn', function(){
		alert($(this).html());
		var dgm = $(this);
		var id = dgm.attr('idprofile'); dgm.parent().attr('idprofile', 'process');
		dgm.text("Sačekajte..."); dgm.removeClass("proz_lft_itm_btn");
		$.ajax({
			data:'&status=no&user='+id,
			type:'POST',
			url:_m_lokacija_sajta+'/p/_skripte/addFriend.php',
			success: function(o){
				alert(o);
				if(dgm.hasClass('_profile_info_btn')) $('.prozor_right').html("");
				$('#kontakt'+id).html(""); $('#kontakt'+id).fadeOut(0);
			}
		});
	});	
});
</script>

<div class="prozor_left" id="_m_id_kontakti">
<?php
/*	
	<div class="proz_lft_itm proz_lft_itm_kat">A</div>
	<div class="proz_lft_itm_kat_box" id="kat_box_A">
		<div class="proz_lft_itm" idprofile="1" id="kontakt1">
			<div class="proz_lft_itm_ime">Aleksandar Konatar</div>
			<div class="proz_lft_itm_btn" idprofile="1">Izbrisi kontakt</div>
		</div>
		<div class="proz_lft_itm" idprofile="1" id="kontakt1">
			<div class="proz_lft_itm_ime">Aleksandar Konatar</div>
			<div class="proz_lft_itm_btn" idprofile="1">Izbrisi kontakt</div>
		</div>
		<div class="proz_lft_itm" idprofile="1" id="kontakt1">
			<div class="proz_lft_itm_ime">Aleksandar Konatar</div>
			<div class="proz_lft_itm_btn" idprofile="1">Izbrisi kontakt</div>
		</div>
		<div class="proz_lft_itm" idprofile="1" id="kontakt1">
			<div class="proz_lft_itm_ime">Aleksandar Konatar</div>
			<div class="proz_lft_itm_btn" idprofile="1">Izbrisi kontakt</div>
		</div>
		<div class="proz_lft_itm" idprofile="1" id="kontakt1">
			<div class="proz_lft_itm_ime">Aleksandar Konatar</div>
			<div class="proz_lft_itm_btn" idprofile="1">Izbrisi kontakt</div>
		</div>
	</div>
*/
	$char = ''; $char_back = '';
	for($i=0;$i<sizeof($kontakti);$i++){
		if($char='' || $kontakti[$i]['ime'][0]!=$char){
			$char = strtoupper($kontakti[$i]['ime'][0]);
			echo $char_back;
			echo "<div class=\"proz_lft_itm proz_lft_itm_kat\">".$char."</div>";
			echo "<div class=\"proz_lft_itm_kat_box\" id=\"kat_box_".$char."\">";
			$char_back = "</div>";
		}
		echo "<div class=\"proz_lft_itm\" idprofile=\"".$kontakti[$i]['id']."\" id=\"kontakt".$kontakti[$i]['id']."\">
				<div class=\"proz_lft_itm_ime\">".$kontakti[$i]['ime']."</div>
				<div class=\"proz_lft_itm_btn\" idprofile=\"".$kontakti[$i]['id']."\">Izbrisi kontakt</div>
			</div>";
	}
	if($char_back!="") echo $char_back;
?>
</div>
<div id="_prozor_preloader"><img src="<?php echo iGetSiteAdresa(); ?>/p/_slike/preloader.gif"></div>
<div class="prozor_right">

</div>