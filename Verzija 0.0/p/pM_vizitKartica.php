<?php
	if(!isset($_POST['id']) || !isset($_POST['status']))  die();
	$user_id = $_POST['id']; $user_status = $_POST['status'];
	include_once("../_engine/init.php");
	include_once("_skripte/OsnovneInformacije.php"); $OI = new OsnovneInformacije(_getBaza());

	$info = $OI->getInfo($user_id);
	$osnovne_informacije = $OI->getData('osnovne', $OI->getOsnovneInformacije($user_id));
	$slike = $OI->getData('slike_profila', $OI->getSlikeProfila($user_id));
	$socijalne_mreze = $OI->getData('socijalne_mreze', $OI->getSocijalneMreze($user_id));
	
?>

<script type="text/javascript">
	//pv_init('https://fbcdn-sphotos-f-a.akamaihd.net/hphotos-ak-prn1/q77/s720x720/1235283_10202111511888210_26731083_n.jpg');
	pv_init("<?php echo $slike['cover']['adresa']; ?>");
</script>
<div id="vizit_karta">
	<div id="vizit_profile" style="background-image:url('<?php echo $slike['profile']['adresa']; ?>');"></div>
	<div id="vizit_cover">
		<div id="vizit_cover_shader"></div>
		<div id="profile_reputacija">
			<div id="profil_reputacija_naslov">Reputacija:</div>
			<div id="profil_reputacija_iznos">1.0</div>
		</div>
	</div>
	<div id="vizit_info">
		<div id="info_naslov"><?php echo $info['naslov']; ?></div>
		
		<div id="vizit_kontakt">
			<?php
				//<div class="info_left">Kontakt telefon:</div>
				//<div class="info_right">068262810</div>
				for($i=0;$i<sizeof($osnovne_informacije);$i++){
					if($osnovne_informacije[$i]['kartica']=='ne') continue;
					if($osnovne_informacije[$i]['privatnost']=='da' && $user_status=='visit') continue;

					echo "<div class=\"info_left\">";
					echo $osnovne_informacije[$i]['naziv'] . "</div>";

					echo "<div class=\"info_right\">";
					echo $osnovne_informacije[$i]['opis'] . "</div>";
				}

			?>
		</div><!--vizit_kontakt-->
	</div><!--vizit_info-->
</div>

<div id="socijalne_mreze">
	<?php	
		//<div class="mreza"> <a href="http"//www.facebook.com"><img src="_slike/socijalne_mreze/Facebook.png"></a> </div>
		//<div class="mreza"> <a href="http"//www.facebook.com"><img src="_slike/socijalne_mreze/YouTube.png"></a> </div>
		for($i=0;$i<sizeof($socijalne_mreze);$i++){
			echo "<div class=\"mreza\"> <a href=\"".$socijalne_mreze[$i]['adresa'].$socijalne_mreze[$i]['username']."\">";
			echo "<img src=\"_slike/socijalne_mreze/".$socijalne_mreze[$i]['slika'].".png\"></a> </div>";
		}

	?>
	
</div>
<script type="text/javascript"> pv_social_media_init(); </script>