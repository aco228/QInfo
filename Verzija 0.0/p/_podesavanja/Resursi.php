<?php
	class Resursi{
		private $id = "";
		private $db = null;

		public function __construct($id = "", $db = ""){
			if($db==""){
				include_once("../../_engine/init.php");
				$this->db = _getBaza();
				$this->id = $__USER_ID;
			} else {
				$this->id = $id;
				$this->db = $db;
			}
		}

		public function getInfo(){
			$this->db->q("SELECT username, naslov, slike_profila, socijalne_mreze,
							osnovne_informacije, detaljnije_informacije, kljucne_rijeci
							FROM profil WHERE pid='".$this->id."';");
			return $this->db->data;
		}
		public function getSocijalneMreze(){
			$this->db->qMul("SELECT naziv, slika, adresa FROM socijalne_mreze;");
			$back = array();
			while($s = mysql_fetch_array($this->db->data, MYSQL_ASSOC)){
				$red = array();
				$red['naziv'] = $s['naziv'];
				$red['slika'] = $s['slika'];
				$red['adresa'] = $s['adresa'];
				$back[] = $red;
			}
			return $back;
		}

		public function updateNaloga($username, $naslov, $sifra1, $sifra2){
			$username = mysql_real_escape_string($username);
			$naslov = mysql_real_escape_string($naslov);
			$sifra1 = mysql_real_escape_string($sifra1);
			$sifra2 = mysql_real_escape_string($sifra2);

			$podaci_profila = $this->db->q("SELECT username, naslov, sifra FROM profil WHERE pid='".$this->id."';");

			if($sifra1!=""&&$sifra2!=""){
				if($podaci_profila['sifra']!=$sifra1) { return "Niste ukucali ispravnu staru šifru!"; }
				$this->db->e("UPDATE profil SET sifra='".$sifra2."' WHERE pid='".$this->id."';");
			}

			if($podaci_profila['username']!=$username){
				$this->db->q("SELECT COUNT(*) AS br FROM profil WHERE username='".$username."';");
				if($this->db->data['br']!=0 && $username!='_') return "Već postoji profil sa ovim korisničkim imenom";
			}

			$this->db->e("UPDATE profil SET username='".$username."', naslov='".$naslov."' WHERE pid='".$this->id."';");
			return "Promjene uspješno izvršene!";
		}

		public function updateOsnovnihInformacija($data){
			$this->db->e("UPDATE profil SET osnovne_informacije='".$data."' WHERE pid='".$this->id."';");
			return "Informacije su sačuvane!";
		}
		public function updateDetaljnihInformacije($data, $kljucne_rijeci){
			$data = mysql_real_escape_string($data);
			$kljucne_rijeci = mysql_real_escape_string($kljucne_rijeci);
			$this->db->e("UPDATE profil SET detaljnije_informacije='".$data."', kljucne_rijeci='".$kljucne_rijeci."' WHERE pid='".$this->id."';");
			return "Informacije su sačuvane!";
		}
		public function updateSocijalnihMreza($data){
			$data = mysql_real_escape_string($data);
			$this->db->e("UPDATE profil SET socijalne_mreze='".$data."' WHERE pid='".$this->id."';");
			return "Socijalne mreže su sačuvane!";
		}
		public function updateSlike($profile_upload, $profile_url, $back_upload, $back_url, $cover_upload, $cover_url, $cover_copy){
			$profile_url = mysql_real_escape_string($profile_url);
			$back_url = mysql_real_escape_string($back_url);
			$cover_url = mysql_real_escape_string($cover_url);

			$this->db->q("SELECT slike_profila FROM profil WHERE pid='".$this->id."';");
			include_once("../_skripte/OsnovneInformacije.php"); $OI = new OsnovneInformacije();
			$slike = $OI->getData("slike_profila", $this->db->data['slike_profila']);

			$profile_adresa = $profile_url; 
			if($profile_upload=='da') $profile_adresa = $this->id.".jpg";
			else if($profile_upload=='none') { $profile_adresa = $slike['profile']['adresa_orginal']; $profile_upload = $slike['profile']['server']; }

			$back_adresa = $back_url; 
			if($back_upload=='da') $back_adresa = $this->id.".jpg";
			else if($back_upload=='none') { $back_adresa = $slike['back']['adresa_orginal']; $back_upload = $slike['back']['server']; }

			$cover_adresa = $cover_url; 
			if($cover_upload=='da' || $cover_copy!="") $cover_adresa = $this->id.".jpg";
			else if($cover_upload=='none') { $cover_adresa = $slike['cover']['adresa_orginal']; $cover_upload = $slike['cover']['server']; $cover_copy = $slike['cover']['cover'];}

			$data  = "profile|".$profile_adresa."|".$profile_upload."|#";
			$data .= "back|".$back_adresa."|".$back_upload."|#";
			$data .= "cover|".$cover_adresa."|".$cover_upload."|".$cover_copy."#";

			$this->db->e("UPDATE profil SET slike_profila='".$data."' WHERE pid='".$this->id."';");
			return "Slike su sačuvane!";
		}
		public function slikeEngine($profil, $back, $cover){
			$back_msg = array();

			$back_msg['profile'] = $this->slikeEngine_provjera($profil, "profile", 1.5);
			$back_msg['back'] = $this->slikeEngine_provjera($back, "back", 2.5);
			$back_msg['cover'] = $this->slikeEngine_provjera($cover, "cover", 1.5);

			return $back_msg;
		}
		public function slikeEngine_provjera($slika, $lokacija, $velicina){
			$b = array(); $b['u']='true'; $b['g']='true'; $b['t']='';
			if(!isset($slika) || !is_uploaded_file($slika['tmp_name'])){ $b['u']='false'; $b['t']=""; return $b; }
			$b['u']='true';

			$exe = explode(".",$slika['name']); $exe = strtolower(end($exe));
			if($exe != "jpg"){ $b['t']='Postavili ste pogrešan format slike. Dozvoljen format je .jpg!'; return $b; }

			$max_vel = $velicina*1048576;
			if($slika['size'] >= $max_vel) {$b['t']='Postavili ste sliku čija je veličina veća od dozvoljene ('.$velicina.' mb)'; return $b; }

			$lokacija = "../_slike/_".$lokacija."/". $this->id . '.jpg';
			if(file_exists($lokacija)) unlink($lokacija);
			move_uploaded_file($slika['tmp_name'], $lokacija);

			$b['g']="false"; $b['t']='Slika uspješno postavljena!';
			return $b;
		}
	}
?>