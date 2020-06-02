<?php
	class MailSender{

		public function __construct(){
			require("phpMailer/class.phpmailer.php");

			$this->mail = new PHPMailer(); 
			
			$this->mail->IsSMTP(); 
			$this->mail->SMTPDebug = false; // debugging: 1 = errors and messages, 2 = messages only
			$this->mail->SMTPAuth = true; 
			$this->mail->SMTPSecure = 'ssl'; // mora za Gmail
			$this->mail->Host = "smtp.gmail.com";
			$this->mail->Port = 465; // ili 587
			//$this->mail->IsHTML(true);
			$this->mail->Username = "aleksandar.k03@gmail.com";
			$this->mail->Password = "aco2284ever";
			$this->mail->SetFrom("aleksandar.k03@gmail.com", "qInfo");
		}
		public function __destruct(){}

		public function sendRegistrationMail($email, $jedinstvena_sifra){
			if($email=="") { echo "Greska sa mailom"; return false;}

			$this->mail->AddAddress($email);
			$this->Subject = "Registracija naloga: " . $email;
			$this->mail->Body = " Registracija profila qInfo\n\r"
				."Molimo vas da aktivirate vas nalog na sledeci link:\n\r"
				."http://www.aco228i.freeiz.com/profil/_registracija.php?aktivacija=".$jedinstvena_sifra;
			$this->mail->Send();
			if ($this->mail->IsError()) { echo nl2br("Greška sa slanjem pozivnice na mail: '" . $email . "'\n"); return false; }
			$this->mail->ClearAddresses();
			return true;
		}
	}

?>