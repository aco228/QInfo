<?php
	if(!isset($_POST['akcija'])) die();
	$akcija = $_POST['akcija']; 
	
	include("Resursi.php"); $R = new Resursi();

	switch($akcija){
		case "s_podesavanje":
			$username = $_POST['username'];
			$naslov = $_POST['naslov'];
			$sifra1 = $_POST['sifra1']; 
			$sifra2 = $_POST['sifra2'];

			echo $R->updateNaloga($username, $naslov, $sifra1, $sifra2);
			break;

		case "s_oinfo":
			echo $R->updateOsnovnihInformacija($_POST['data']);
			break;

		case "s_dinfo":
			echo $R->updateDetaljnihInformacije($_POST['data'], $_POST['kljucne_rijeci']);
			break;

		case "s_socijal":
			echo $R->updateSocijalnihMreza($_POST['data']);
			break;

		case "s_slika":
			echo $R->updateSlike($_POST['profile_upload'], $_POST['profile_url'], $_POST['back_upload'], $_POST['back_url'],
								$_POST['cover_upload'], $_POST['cover_url'], $_POST['cover_copy'] );
			break;
	}

?>