<?php
	session_start();
	// PREUZIMANJE PODATAKA O KORISNIKU
	$__USER_MAIL = ""; $__USER_ID = "";
	if(isset($_SESSION['USER_MAIL'])) $__USER_MAIL = $_SESSION['USER_MAIL'];
	if(isset($_SESSION['USER_ID'])) $__USER_ID = $_SESSION['USER_ID'];
	if($__USER_MAIL == "" || $__USER_ID == ""){
		if(isset($_COOKIE['USER_MAIL'])) $__USER_MAIL = $_COOKIE['USER_MAIL'];
		if(isset($_COOKIE['USER_ID'])) $__USER_ID = $_COOKIE['USER_ID'];
	}


	function iGetSiteAdresa(){
		switch($_SERVER['HTTP_HOST']){ 
			case 'localhost': return "http://localhost/www/05_%20qInfo/Verzija%200.0/"; 
			default: return "http://".$_SERVER['HTTP_HOST']."/Verzija 0.0/"; 
		}
	}
	function _getBaza(){
		include_once(dirname(__FILE__)."/baza/connect.php");
		return new BazaPodataka();
	}
	function _getMail(){
		$server = $_SERVER['HTTP_HOST'];
		if($server=="localhost" || $server=="www.aco228.freeiz.com"){
			include("mailSender/StandardMail.php");
			return new MailSender;
		} 
	}
?>