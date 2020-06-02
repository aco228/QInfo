<?php
	class OsnovneInformacije{
		private $unos = "";
		private $data = null;
		private $db = null;

		public function __construct($db = null){
			$this->db = $db;
		}
		public function __destruct(){ $this->unos = ""; $this->data = ""; }

		/*
			================================================================
			PROFILE
		*/
		public function provjeraUnosa($unos){
			$this->db->q("SELECT COUNT(*) AS br, pid FROM profil WHERE username='".$unos."' OR pid='".$unos."';");
			if($this->db->data['br']!=1) return "";
			else return $this->db->data['pid'];
		}
		public function getBackground($id){
			$this->db->q("SELECT slike_profila FROM profil WHERE pid='".$id."';");
			$this->getData('slike_profila', $this->db->data['slike_profila']);
			return $this->data['back'];
		}
		public function getStatus($id_p, $id_in){
			$this->db->q("SELECT COUNT(*) AS br, status FROM profil WHERE pid='".$id_p."';");
			if($this->db->data['br']!=1) return "none";
			if($this->db->data['status']!='akt') return $this->db->data['status'];

			if($id_p== $id_in) return "own";
			$this->db->q("SELECT COUNT(*) AS br, friend1, friend2, kruzno FROM profil_friend WHERE friend1='".$id_p."' AND friend2='".$id_in."'
																		OR friend1='".$id_in."' AND friend2='".$id_p."';");

			if($this->db->data['br']==1) {
				if($this->db->data['kruzno']=='da' || $this->db->data['friend1']==$id_in) return "friend";
				else return 'visit';
			}
			else return "visit";

		}

		/*
			PREUZIMANJE PODATAKA IZ BAZE
		*/
		public function getKljucneRijeci($id){ 
			$this->db->q("SELECT kljucne_rijeci FROM profil WHERE pid='".$id."';"); return $this->db->data['kljucne_rijeci']; }
		public function getInfo($id){ return $this->db->q("SELECT naslov, kljucne_rijeci, username, reputacija FROM profil WHERE pid='".$id."';"); }
		public function getOsnovneInformacije($id){ 
			$this->db->q("SELECT osnovne_informacije FROM profil WHERE pid='".$id."';"); return $this->db->data['osnovne_informacije']; }
		public function getSlikeProfila($id){ 
			$this->db->q("SELECT slike_profila FROM profil WHERE pid='".$id."';"); return $this->db->data['slike_profila']; }
		public function getSocijalneMreze($id){ 
			$this->db->q("SELECT socijalne_mreze FROM profil WHERE pid='".$id."';"); return $this->db->data['socijalne_mreze']; }
		public function getDetaljnijeInformacije($id){
			$this->db->q("SELECT detaljnije_informacije FROM profil WHERE pid='".$id."';"); return $this->db->data['detaljnije_informacije']; }
			
		/*
			================================================================
			INFO

			Osnovne informacije
			Zvanican format
			naziv|opis|kartica[da/ne]|privatnost[da/ne]#
		*/
		private function engine_osnovneInformacije(){
			$informacije = explode('#',$this->unos);
			$this->data = ""; $this->data = array();
			for($i=0;$i<sizeof($informacije);$i++){
				if($informacije[$i]=="") continue;
				$niz = array();
				$red = explode('|', $informacije[$i]);
				$niz['naziv'] = $red[0];
				$niz['opis'] = $red[1];
				$niz['kartica'] = $red[2];
				$niz['privatnost'] = $red[3];
				$this->data[] = $niz;
			}
		}

		/*
			Detaljnije informacije
			Zvanican format
			naziv|opis|kartica[da/ne]|privatnost[da/ne]#
		*/
		private function engine_detaljnijeInformacije(){
			$informacije = explode('#',$this->unos);
			$this->data = ""; $this->data = array();
			for($i=0;$i<sizeof($informacije);$i++){
				if($informacije[$i]=="") continue;
				$niz = array();
				$red = explode('|', $informacije[$i]);
				$niz['naslov'] = $red[0];
				$niz['tekst'] = $red[1];
				$this->data[] = $niz;
			}
		}

		/*
			Socijalne mreze
			Zvanicni format
			adresa|slika#
		*/
		private function engine_socijalne_mreze(){
			$this->data = ""; $this->data = array();
			$info = explode('#', $this->unos);

			for($i=0;$i<sizeof($info);$i++){
				if($info[$i]=="") continue;
				$red = explode('|', $info[$i]);
				$niz = array();
				$niz['adresa'] = $red[0];
				$niz['username'] = $red[1];
				$niz['naziv'] = $red[2];
				$niz['slika'] = $red[3];
				$this->data[] = $niz;
			}
			$this->unos = "";
			if($this->data==""){$this->data['profile'] = "";$this->data['back'] = "";$this->data['cover'] = "";}
		}

		/*
			Zvanican format
			0                 1              2               3
			naziv_varijable | adresa_slike | server[da/ne] | cover_info[?]#
		*/
		private function engine_slike(){
			$___root = realpath(dirname(__FILE__) . '/../..');
			include_once($___root."/_engine/init.php");
			$dirname = iGetSiteAdresa()."/p/_slike/_";

			$this->data = array();
			$info = explode('#', $this->unos);
			for($i=0;$i<sizeof($info);$i++){
				if($info[$i]=="") continue;
				$niz = array(); $red = explode('|', $info[$i]);
				$niz['cover']  = $red[3];
				$niz['server'] = $red[2];
				$niz['adresa_orginal'] = $red[1];

				     if($niz['cover']!="")  $niz['adresa'] = $this->data[$niz['cover']]['adresa']; 
				else if($red[2]=='da') $niz['adresa'] = $dirname . $red[0] . "/" . $red[1];
				else if($red[2]=='ne') $niz['adresa'] = $red[1];

				$this->data[$red[0]] = $niz;
			}
			$this->unos = "";
		}

		public function getData($tip, $podatak){ 
			$this->unos = $podatak;
			     if($tip=="osnovne") $this->engine_osnovneInformacije();
			else if($tip=="detaljnije") $this->engine_detaljnijeInformacije();
			else if($tip=="socijalne_mreze") $this->engine_socijalne_mreze();
			else if($tip=="slike_profila") $this->engine_slike();
			return $this->data; 
		}
	}
?>