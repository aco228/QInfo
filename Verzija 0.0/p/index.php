<?php
	include_once("../_engine/init.php");
	$unos = ""; $id_user = ""; 
	if(isset($_GET['p'])) $unos = $_GET['p'];
	include_once("_skripte/OsnovneInformacije.php"); $OI = new OsnovneInformacije(_getBaza());

	// Provjera unosa i preuzimanje id-a profila
	if($unos=="") {
		if($__USER_ID=="") header("Location: ../index.php");
		$id_user = $__USER_ID;
	} else $id_user = $OI->provjeraUnosa($unos);

	$status = $OI->getStatus($id_user, $__USER_ID); // | none | friend | own | visit | [ban/nea]

	$pozadinska_slika['adresa'] = "";
	if($id_user!="") $pozadinska_slika = $OI->getBackground($id_user);
?>
<html>
<head>
	<title><?php echo "|".$__USER_ID . "| UPISI OVDJE USERNAME"; ?></title>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

	<link rel="stylesheet" type="text/css" href="../_css/main.css">
	<link rel="stylesheet" type="text/css" href="_css/profil.css">
	<link rel="stylesheet" type="text/css" href="_css/profil_menu.css">
	<link rel="stylesheet" type="text/css" href="_css/pM_vizitKartica.css">
	<link rel="stylesheet" type="text/css" href="_css/pM_informacije.css">

	<!-- JAVA SCRIPT -->
	<script type="text/javascript" src="../_js/_jQuery.js"></script>
	<script type="text/javascript" src="../_js/_jQueryUI.js"></script>
	<script type="text/javascript" src="_js/background.js"></script>
	<script type="text/javascript" src="_js/profil_menu.js"></script>
	<script type="text/javascript" src="_js/profil_topMenu.js"></script>
	<script type="text/javascript" src="_js/pM_vizitKartica.js"></script>
	<script type="text/javascript" src="_js/pM_informacije.js"></script>
	<script type="text/javascript">
		//var __BACKGROUND = 'https://fbcdn-sphotos-f-a.akamaihd.net/hphotos-ak-prn1/q77/s720x720/1235283_10202111511888210_26731083_n.jpg';
		var __BACKGROUND = "<?php echo $pozadinska_slika['adresa']; ?>";
		var ___getUser   = <?php echo "'" . $id_user . "'"; ?>;
		var ___getStatus = <?php echo "'" . $status . "'"; ?>;
	</script>
</head>
<body>

	<?php 
		include("../_includes/menu/menu.php"); // Ukljucivanje menija 
	?>


	<div id="profile_top_menu">
		<?php
		/*
			<div id="btn_addKontakt" class="btn_topMenu">Dodaj u svoje kontakte </br>
				<img src="_slike/topMenu/addKontakt.png" alt=""/>
			</div>
			<div id="btn_sendMessage" class="btn_topMenu">Pošalji poruku korisniku</br>
				<img src="_slike/topMenu/sendMessage.png" alt=""/>
			</div>
		*/

		if($__USER_ID!=""){
			if($status=='visit'){
				echo "<div id=\"btn_addKontakt\" class=\"btn_topMenu\">
						<div id=\"btn_addKontakt_text\">Dodaj u svoje kontakte</div>
						<img src=\"_slike/topMenu/addKontakt.png\" alt=\"\"/>
					</div>";
			}
			else if($status=='friend'){
				echo "<div id=\"btn_addKontakt\" class=\"btn_topMenu\">
						<div id=\"btn_addKontakt_text\">Izbriši iz svojih kontakata</div>
						<img src=\"_slike/topMenu/addKontakt.png\" alt=\"\"/>
					</div>";
			}
			if($status!='own'){
				echo "<div id=\"btn_sendMessage\" class=\"btn_topMenu\">Pošalji poruku korisniku</br>
						<img src=\"_slike/topMenu/sendMessage.png\" alt=\"\"/>
					</div>";
			}
		}

		?>

	</div>

	<div id="profile_body_loader"><img src="_slike/preloader.gif" alt=""></div>
	<div id="profile_body">
		<div class="profile_body_fade"></div>
	</div><!--profile_body-->

	<div id="profile_menu">
		<div id="profile_menu_container">
			<div class="pMenu" id="pM_vizitKartica">Vizit Kartica</div>
			<div class="pMenu" id="pM_informacije">Informacije</div>
		</div>
	</div><!--profile_menu-->

	<div id="back_shade"></div>
	<div id="back_image"></div>
</body>
</html>