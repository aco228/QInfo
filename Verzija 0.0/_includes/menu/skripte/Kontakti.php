<?php
	class Kontakti{
		private $db = "";
		private $id = "";

		function __construct($db, $id){
			$this->db = $db;
			$this->id = $id;
		}

		function getKontakti(){
			$ime = array(); $back = array();
			$this->db->qMul("(SELECT friend2 AS 'id', friend2_ime AS 'ime' FROM profil_friend WHERE friend1='".$this->id."')
							UNION ALL
							(SELECT friend1 AS 'id', friend1_ime AS 'ime' FROM profil_friend WHERE friend2='".$this->id."' AND kruzno='da')
							ORDER BY ime;");
			$back = array();
			while($k=mysql_fetch_array($this->db->data, MYSQL_ASSOC)){
				$niz = array();
				$niz['id'] = $k['id']; $niz['ime'] = $k['ime'];
				$back[] = $niz; 
			}
			return $back;
		}

	}
?>