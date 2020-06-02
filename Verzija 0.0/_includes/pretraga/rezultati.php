<?php
	if(!isset($_POST['key'])) die();
	include_once("../../_engine/init.php"); $db = _getBaza();
	$key = mysql_real_escape_string($_POST['key']);

	$db->qMul(" SELECT pid, naslov, username, kljuc FROM (
				(SELECT pid, naslov, username, 'Ključna riječ' AS 'kljuc', reputacija FROM profil WHERE kljucne_rijeci LIKE '%".$key."%')
				UNION ALL
				(SELECT pid, naslov, username, 'Naslov profila' AS 'kljuc', reputacija FROM profil WHERE naslov LIKE '%".$key."%')
				UNION ALL
				(SELECT pid, naslov, username, 'Korisničko ime profila' AS 'kljuc', reputacija FROM profil WHERE username LIKE '%".$key."%')
				) AS rezultat
				GROUP BY pid
				ORDER BY reputacija", true, true);

?>
<?php
	/*
<div class="___pR" profileId="1">
	<div class="___pR_img"></div>
	<div class="___pR_ime">Aleksandar Konatar</div>
	<div class="___pR_key">
		Prema: 
		<div class="__pR_keyAb">Kljucna rijec</div>
	</div>
</div>
	*/

	while($p=mysql_fetch_array($db->data, MYSQL_ASSOC)){
		echo "<div class=\"___pR\" profileId=\"".$p['pid']."\">
				<div class=\"___pR_img\"></div>
				<div class=\"___pR_ime\">".$p['naslov']."</div>
				<div class=\"___pR_key\">
					Prema: 
					<div class=\"__pR_keyAb\">".$p['kljuc']."</div>
				</div>
			</div>";
	}
?>