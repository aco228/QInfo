<?php

	if(!isset($_POST['email']) || !isset($_POST['sifra'])) die();
	$email = mysql_real_escape_string($_POST['email']);
	$sifra = mysql_real_escape_string($_POST['sifra']);
	$ostani_prijavljen = "ne"; if(isset($_POST['ostani_prijavljen'])) $ostani_prijavljen = "da";
	include("../../_engine/init.php"); $db = _getBaza(); 

	$db->q("SELECT COUNT(*) AS br, pid, email, sifra, status FROM profil WHERE email='".$email."';");
	if($db->data['br']!=1) { echo "Profil sa unijetim email-om ne postoji!"; die(); }
	else if($db->data['sifra']!=$sifra) { echo "Unijeli ste pogrešnu šifru"; die(); }
	switch($db->data['status']){
		case "nea": echo "Još uvjek niste aktivirali vaš profil!"; die();
		case "ban": echo "Vaš profil je blokiran!"; die();
	}

	$_SESSION['USER_MAIL'] = $email;
	$_SESSION['USER_ID'] = $db->data['pid'];

	if($ostani_prijavljen=="da"){
		setcookie("USER_MAIL", $email, time()*3600);
		setcookie("USER_ID", $db->data['pid'], time()*3600);
	}
?>