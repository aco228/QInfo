<?php
	if(!isset($_POST['akcija'])) die();
	$akcija = $_POST['akcija']; 
	include_once("../../../_engine/init.php");

	switch($akcija){
		case "kontakti_dell":
		echo "mjaa";
			break;
	}

?>