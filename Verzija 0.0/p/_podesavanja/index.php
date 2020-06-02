<?php
	include("../../_engine/init.php");
	if($__USER_ID=="") header("Location: ../../index.php");
	include("Resursi.php"); $R = new Resursi($__USER_ID, _getBaza());

	// Upload slika
	$upload_err = "";
	if(isset($_FILES['file_back']) || isset($_FILES['file_profile']) || isset($_FILES['file_cover'])){
		$upload_err =  $R->slikeEngine($_FILES['file_profile'], $_FILES['file_back'], $_FILES['file_cover']);
	}

	$data = $R->getInfo();
	$socijalne_mreze = $R->getSocijalneMreze();

	include("../_skripte/OsnovneInformacije.php");
	$OI = new OsnovneInformacije(); 
	$osnovne_informacije = $OI->getData("osnovne", $data['osnovne_informacije']);
	$detaljnije_informacije=$OI->getData("detaljnije", $data['detaljnije_informacije']);
	$socijalne_mreze_korisnika = $OI->getData("socijalne_mreze", $data['socijalne_mreze']);
	$slike_profila = $OI->getData("slike_profila", $data['slike_profila']);
?>
<html>
<head>
	<title>Podešavanja profila: <?php echo $data['username']; ?></title>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

	<link rel="stylesheet" type="text/css" href="../../_css/main.css">
	<link rel="stylesheet" type="text/css" href="resursi/podesavanja.css">
	<link rel="stylesheet" type="text/css" href="resursi/podesavanja_socijal.css">
	<link rel="stylesheet" type="text/css" href="resursi/podesavanja_slika.css">

	<!-- JAVA SCRIPT -->
	<script type="text/javascript">
		<?php
			if($upload_err!=""){
				$elementi = "";
				if($upload_err['profile']['u'] =='true')$elementi .= "slike_msg_init_var['profile']='".$upload_err['profile']['t']."';slike_msg_init_var['profile_err']=".$upload_err['profile']['g'].";";
				if($upload_err['back']['u']    =='true')$elementi .= "slike_msg_init_var['back']='".$upload_err['back']['t']."';slike_msg_init_var['back_err']=".$upload_err['back']['g'].";";
				if($upload_err['cover']['u']   =='true')$elementi .= "slike_msg_init_var['cover']='".$upload_err['cover']['t']."';slike_msg_init_var['cover_err']=".$upload_err['cover']['g'].";";
				echo "var slike_msg_init_var=new Array();".$elementi;
			}
		?>
	</script>
	<script type="text/javascript" src="../../_js/_jQuery.js"></script>
	<script type="text/javascript" src="../../_js/_jQueryUI.js"></script>
	<script type="text/javascript" src="../../_js/_testBox_autoSize.js"></script>
	<script type="text/javascript" src="resursi/podesavanja.js"></script>
	<script type="text/javascript" src="resursi/s_podesavanje.js"></script> 
	<script type="text/javascript" src="resursi/s_oinfo.js"></script> <!-- osnovne informacije-->
	<script type="text/javascript" src="resursi/s_dinfo.js"></script> <!-- detaljnije informacije-->
	<script type="text/javascript" src="resursi/s_socijal.js"></script> <!-- socijalne mreze-->
	<script type="text/javascript" src="resursi/s_slika.js"></script> <!-- slike sa profila-->
</head>
<body>

	<?php include("../../_includes/menu/menu.php"); // Ukljucivanje menija ?>

	<div id="podesavanja_header">
		<div id="email"><?php echo $__USER_MAIL; ?></div>
	</div>
	<div id="separator"></div>

	<div class="sekcija" id="s_podesavanje">
		<div class="sekcija_naslov">Podešavanja</div>
		<div class="sekcija_body">
			<?php include("s_podesavanje.php"); ?>
		<div class="sekcija_slanje" id="btn_s_potvrdi">
			<div class="sekcija_potvrdi">Potvrdi</div>
			<div class="sekcija_msg">Poruka bla bla kume</div>
		</div>
	</div></div><!--s_podesavanje-->

	<div class="sekcija" id="s_oinfo">
		<div class="sekcija_naslov">Osnovne informacije</div>
		<div class="sekcija_body">
			<?php include("s_oinfo.php"); ?>
		<div class="sekcija_slanje" id="btn_s_oinfo">
			<div class="sekcija_potvrdi">Potvrdi</div>
			<div class="sekcija_msg">Poruka bla bla kume</div>
		</div>
	</div></div><!--s_informacije-->

	<div class="sekcija" id="s_dinfo">
		<div class="sekcija_naslov">Detaljniji opis</div>
		<div class="sekcija_body">
			<?php include("s_dinfo.php"); ?>
		<div class="sekcija_slanje" id="btn_s_dinfo">
			<div class="sekcija_potvrdi">Potvrdi</div>
			<div class="sekcija_msg">Poruka bla bla kume</div>
		</div>
	</div></div><!--s_dinfo-->

	<div class="sekcija" id="s_slike">
		<div class="sekcija_naslov">Slike sa profila</div>
		<div class="sekcija_body">
			<?php include("s_slike.php"); ?>
		<div class="sekcija_slanje" id="btn_s_slike">
			<div class="sekcija_potvrdi">Potvrdi</div>
			<div class="sekcija_msg">Poruka bla bla kume</div>
		</div>
	</div></div><!--s_dinfo-->

	<div class="sekcija" id="s_socijal">
		<div class="sekcija_naslov">Socijalne mreže</div>
		<div class="sekcija_body">
			<?php include("s_socijal.php"); ?>
		<div class="sekcija_slanje" id="btn_s_slike" name="btn_s_slike">
			<div class="sekcija_potvrdi">Potvrdi</div>
			<div class="sekcija_msg">Poruka bla bla kume</div>
		</div>
	</div></div><!--s_dinfo-->

	<div id="separator"></div>
	<div id="back_shade"></div>
	<div id="back_image" style="background-image:url(<?php echo $slike_profila['back']['adresa']; ?>);"></div>
</body>
</html>