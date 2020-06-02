<?php
	if(!isset($_GET['aktivacija']) || empty($_GET['aktivacija'])) header("Location: ../index.php");
	include("../_engine/init.php"); $db = _getBaza();
	$aktivacija = mysql_real_escape_string($_GET['aktivacija']);

	$db->q("SELECT COUNT(*) AS br, status, email FROM profil WHERE jedinstvena_sifra='".$aktivacija."';");
	if($db->data['br']!=1 || $db->data['status']!="nea") header("Location: ../index.php");
	$email = $db->data['email'];

	$db->e("UPDATE profil SET status='akt' WHERE jedinstvena_sifra='".$aktivacija."';");
?>
<html>
<head>
	<title>Registracija	</title>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

	<link rel="stylesheet" type="text/css" href="../_css/main.css">
	<link rel="stylesheet" type="text/css" href="_css/registracija.css">

	<!-- JAVA SCRIPT -->
	<script type="text/javascript" src="../_js/_jQuery.js"></script>
	<script type="text/javascript" src="../_js/_jQueryUI.js"></script>
	<script type="text/javascript" src="_js/registracija.js"></script>
</head>
<body>
	<div id="center">
		<div id="naslov">Aktivacija naloga</div>
		<div id="mail"><?php echo $email; ?></div>
		<div id="opis">Sada možete da se ulogujete na vaš profil. ..</div>
		<div id="futer">
			<div id="counter">260</div>
			 sekundi do prelaska na početnu stranicu
		</div>
	</div>
</body>
</html>