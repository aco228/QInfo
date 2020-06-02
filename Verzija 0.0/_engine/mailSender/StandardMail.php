<?php
	class MailSender{

		public function __construct(){}
		public function __destruct(){}

		public function sendRegistrationMail($email, $jedinstvena_sifra){
			mail(
			$email, 
			"Registracija naloga: " . $email , 
			"Molimo vas da aktivirate vas nalog na sledeci link:\n\r"
			."http://www.aco228i.freeiz.com/profil/_registracija.php?aktivacija=".$jedinstvena_sifra, 
			"From: evropa-za-mlade"
		);
		}
	}

?>