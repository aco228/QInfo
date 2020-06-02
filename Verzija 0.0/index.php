<html>
<head>
	<title>qInfo</title>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="_css/main.css">
	<link rel="stylesheet" type="text/css" href="index/css/index.css">
	<link rel="stylesheet" type="text/css" href="index/css/ne_registrovani.css">

	<!-- JAVA SCRIPT -->
	<script type="text/javascript" src="_js/_jQuery.js"></script>
	<script type="text/javascript" src="_js/_jQueryUI.js"></script>
	<script type="text/javascript" src="_js/index.js"></script>
	<script type="text/javascript" src="index/js/login.js"></script>
</head>
<body>
	<?php include('_includes/menu/menu.php'); ?>
	<script type="text/javascript">
		indx_load(<?php if($__USER_MAIL=="") echo "'ne'"; else echo "'da'";?>);
	</script>

	<div id="indx_preloader"><img src="profil/slike/preloader.gif" alt=""></div>
	<div id="indx_body"></div>
</body>
</html>