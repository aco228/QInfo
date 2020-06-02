<?php
	if(!isset($_POST['id'])) die();
	include("../../_engine/init.php");
	$user_id = $_POST['id'];
	include_once("../../p/_skripte/OsnovneInformacije.php"); $OI = new OsnovneInformacije(_getBaza());

	$info = $OI->getInfo($user_id);
	$osnovne_informacije = $OI->getData('osnovne', $OI->getOsnovneInformacije($user_id));
	$slike = $OI->getData('slike_profila', $OI->getSlikeProfila($user_id));
?>

<!--<div class="_pP_cover" style="background-image:url('https://fbcdn-sphotos-d-a.akamaihd.net/hphotos-ak-ash3/224297_2078731206786_524365_n.jpg')">
	<div class="_pP_cover_shade"  style="background-image:url('<?php echo iGetSiteAdresa(); ?>/p/_slike/resursi/back_static.gif')"></div>
	<div class="_pP_img" style="background-image:url('https://fbcdn-sphotos-d-a.akamaihd.net/hphotos-ak-ash3/224297_2078731206786_524365_n.jpg')"></div>
	<div class="_pP_name"><a href="<?php echo iGetSiteAdresa(); ?>/p/index.php?p=<?php echo 1; ?>">
		Aleksandar Konatar <?php echo $id; ?>
	</a></div>
</div>
<div class="_pP_info">
	<table id="_pP_table">
		<tr>
			<td>Mobilni telefon</td>
			<td>069/891431</td>
		</tr>
	</table>
</div>-->

<div class="_pP_cover" style="background-image:url(<?php echo $slike['cover']['adresa']; ?>)">
	<div class="_pP_cover_shade"  style="background-image:url('<?php echo iGetSiteAdresa(); ?>/p/_slike/resursi/back_static.gif')"></div>
	<div class="_pP_img" style="background-image:url(<?php echo $slike['profile']['adresa']; ?>)"></div>
	<div class="_pP_name"><a href="<?php echo iGetSiteAdresa(); ?>/p/index.php?p=<?php echo $user_id; ?>">
		<?php echo $info['naslov']; ?>
	</a></div>
</div>
<div class="_pP_info">
	<table id="_pP_table">			
	<?php
/*
		<tr>
			<td>Mobilni telefon</td>
			<td>069/891431</td>
		</tr>	
*/
		echo "<tr>
				<td>Korisničko ime</td>
				<td>".$info['username']."</td>
			  </tr>	";
		echo "<tr>
				<td>Ključne riječi</td>
				<td>".$info['kljucne_rijeci']."</td>
			  </tr>	";


		for($i=0;$i<sizeof($osnovne_informacije);$i++){
			if($osnovne_informacije[$i]['privatnost']=='da' && $user_status='visit') continue;
			echo "<tr>";
				echo "<td>" . $osnovne_informacije[$i]['naziv'] . "</td>";
				echo "<td>" . $osnovne_informacije[$i]['opis'] . "</td>";
			echo "</tr>";
		}

	?>	
		
	</table>
</div>