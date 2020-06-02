<?php 
	$___root = realpath(dirname(__FILE__) . '/../..');
	include_once($___root."/_engine/init.php");

	$_db = _getBaza();
?>

<link rel="stylesheet" type="text/css" href="<?php echo iGetSiteAdresa(); ?>/_includes/menu/menu.css">
<script type="text/javascript" src="<?php echo iGetSiteAdresa(); ?>/_includes/menu/menu.js"></script>
<script type="text/javascript" src="<?php echo iGetSiteAdresa(); ?>/_includes/menu/prozor.js"></script>
<script type="text/javascript">
	$(document).ready(function(){__m_init("<?php echo iGetSiteAdresa(); ?>");});
</script>

<!-- LOGO -->
<div id="___LOGO" style="background-image:url('<?php echo iGetSiteAdresa(); ?>/_slike/logo/back.png');"> 
	<div id="___LOGO_img">
		<a href="<?php echo iGetSiteAdresa(); ?>index.php">
			<img src="<?php echo iGetSiteAdresa(); ?>_slike/logo/logo_dark.png">
		</a>
	</div> 
</div>


<link rel="stylesheet" type="text/css" href="<?php echo iGetSiteAdresa()."/_includes/pretraga/pretraga.css"; ?>">
<script type="text/javascript" src="<?php echo iGetSiteAdresa()."/_includes/pretraga/pretraga.js"; ?>"></script>
<?php include_once($___root."/_includes/pretraga/pretraga.php"); ?>


<?php if($__USER_MAIL=="") return; ?>

<!-- LOGO -->
<div id="__m">

	<div id="__m_content">
		<div id="_m_uppBar">
			<div id="__m_initTekst">
				Ovdje treba nesto upisat? <?php echo $__USER_MAIL; ?>
			</div>
		</div>

		<div id="_m_menuBar">
			<div class="_m_btn _m_btn_in" id="_m_id_profil">
				Profil
			</div>
			<div class="_m_btn">
				Informacije
			</div>
			<div class="_m_btn">
				Poruke
			</div>
			<div class="_m_btn" id="_m_id_kontakti">
				Kontakti
			</div>
			<div class="_m_btn _m_btn_in" id="_m_id_podesavanja">
				Podešavanja
			</div>
			<div class="_m_btn">
				Pomoć
			</div>
			<div class="_m_btn _m_btn_in" id="_m_id_odjava">
				Odjava
			</div>
		</div>
	</div>

	<div id="__m_openner">
		<div id="__m_opener_c">
			M E N U
		</div>
	</div>
</div>

<div id="__menu_prozor">
	<div id="__menu_prozor_header">
		<div id="__menu_prozor_close">X</div>
	</div>
	<div id="__menu_prozor_preloader"><img src="<?php echo iGetSiteAdresa(); ?>/p/_slike/preloader.gif"></div>
	<div id="__menu_prozor_content"></div>
</div>

