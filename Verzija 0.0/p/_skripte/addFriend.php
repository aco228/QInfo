<?php
	if(!isset($_POST['status']) || !isset($_POST['user'])) die("a");
	$status = $_POST['status']; $user = $_POST['user'];
	include_once("../../_engine/init.php");
	$db = _getBaza();

	$db->q("SELECT COUNT(*) AS br, pfi, kruzno FROM profil_friend 
					WHERE friend1='".$user."'      AND friend2='".$__USER_ID."' 
					OR friend1='".$__USER_ID."' AND friend2='".$user."';");
	if($status=='friend')
	{
		// IZBRISI IZ PRIJATELJA
		if($db->data['br']!=1){ echo "Greška! Kontakt ne postoji"; die(); }
		if($db->data['kruzno']=='da'){
			$pfi = $db->data['pfi'];
			$korisnk_kojiDodaje = $db->q("SELECT naslov FROM profil WHERE pid='".$__USER_ID."' ;");
			$korisnk_kojiPostaje = $db->q("SELECT naslov FROM profil WHERE pid='".$user."';");
			$db->e("UPDATE profil_friend SET kruzno='ne', friend1='".$user."', friend2='".$__USER_ID."' , friend1_ime='".$korisnk_kojiPostaje['naslov']."', friend2_ime='".$korisnk_kojiDodaje['naslov']."'
						WHERE pfi='".$pfi."';");
		} else 
			$db->e("DELETE FROM profil_friend WHERE pfi='".$db->data['pfi']."';");
		
		echo "Profil se više ne nalazi u vašim ličnim kontaktima";
	}
	else if($status=='visit')
	{
		// DODAJ PRIJATELJA
		if($db->data['br']==0){
			$korisnk_kojiDodaje = $db->q("SELECT naslov FROM profil WHERE pid='".$__USER_ID."' ;");
			$korisnk_kojiPostaje = $db->q("SELECT naslov FROM profil WHERE pid='".$user."';");
			$db->e("INSERT INTO profil_friend (friend1, friend2, friend1_ime, friend2_ime) 
					VALUES ('".$__USER_ID."','".$user."', '".$korisnk_kojiDodaje['naslov']."', '".$korisnk_kojiPostaje['naslov']."');");
		} else {
			if($db->data['kruzno']=='da'){ echo "Greška! Vec se nalazite u kontaktima"; die(); }
			else if($db->data['kruzno']=='ne')
				$db->e("UPDATE profil_friend SET kruzno='da' WHERE pfi='".$db->data['pfi']."';");
		}	
		echo "Profil se nalazi u vašim ličnim kontaktima";
	}
	

?>