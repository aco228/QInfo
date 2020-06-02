<?php
	if(!isset($_POST['email']) || !isset($_POST['sifra'])) die("Greška input");
	include("../../_engine/init.php"); $db = _getBaza();
	$email = mysql_real_escape_string($_POST['email']);
	$sifra = mysql_real_escape_string($_POST['sifra']);

	$db->q("SELECT COUNT(*) AS br FROM profil WHERE email='".$email."';");
	if($db->data['br']!=0) { die("Mail već postoji u bazi"); }

	$jedinstvena_sifra = md5($email + microtime());

	// UNOS U BAZU NOVOG KORISNIKA
	$db->e("INSERT INTO profil (email, sifra, jedinstvena_sifra, username) VALUES (
				'".$email."', '".$sifra."', '".$jedinstvena_sifra."', '".$jedinstvena_sifra."'
			)");

	$MailSender = _getMail();
	$MailSender->sendRegistrationMail($email, $jedinstvena_sifra);

	echo "Poslali smo vam aktivacioni mail!";
?>