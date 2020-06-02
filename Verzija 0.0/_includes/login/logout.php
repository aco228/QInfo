<?php
	session_start();
	
	if(isset($_SESSION['USER_MAIL'])){
		unset($_SESSION['USER_MAIL']);
		unset($_SESSION['USER_ID']);
		if(isset($_COOKIE['USER_MAIL'])){
			setcookie("USER_MAIL", "", time()-3600);
			setcookie("USER_ID", "", time()-3600);
		}
		echo "Uspješno ste se izlogovali!";
	}
?>	