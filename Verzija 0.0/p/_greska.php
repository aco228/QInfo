<?php
	if(!isset($_POST['status'])) header("../index.php");
	$poruka = "";

	switch($_POST['status']){
		case "nea": $poruka = "Ovaj profil je još uvjek neaktivan!"; break;
		case "ban": $poruka = "Ovaj profil je blokiran uspled kršenja pravila sajta!"; break;
		case "none": $poruka = "Profil koji tražite ne postoji!"; break;
	}
?>
<div id="vizit_karta">
	<div id="vizit_cover_shader" style="position:absolute"></div>
	<div id="vizit_cover">
		
	</div>
	<div id="vizit_info">
		<div id="info_naslov"> Greška</div>
		<div id="vizit_kontakt">
			<div class="info_left"><?php echo $poruka; ?></div>
		</div><!--vizit_kontakt-->
	</div><!--vizit_info-->
</div>