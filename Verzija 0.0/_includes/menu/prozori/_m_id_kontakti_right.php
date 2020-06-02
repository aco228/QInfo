<?php
	if(!isset($_POST['id'])) die();
	include("../../../_engine/init.php");
	$user_id = $_POST['id'];
	include_once("../../../p/_skripte/OsnovneInformacije.php"); $OI = new OsnovneInformacije(_getBaza());

	$info = $OI->getInfo($user_id);
	$osnovne_informacije = $OI->getData('osnovne', $OI->getOsnovneInformacije($user_id));
	$slike = $OI->getData('slike_profila', $OI->getSlikeProfila($user_id));
?>
<div class="_profile_cover" style="background-image:url(<?php echo $slike['cover']['adresa']; ?>)">
	<div class="_profile_cover_shade"  style="background-image:url('<?php echo iGetSiteAdresa(); ?>/p/_slike/resursi/back_static.gif')"></div>
	<div class="_profile_img" style="background-image:url(<?php echo $slike['profile']['adresa']; ?>)"></div>
	<div class="_profile_name"><a href="<?php echo iGetSiteAdresa(); ?>/p/index.php?p=<?php echo $user_id; ?>">
		<?php echo $info['naslov']; ?>
	</a></div>
</div>
<div class="_profile_info">
	<table id="informacije_table_profile">			
	<?php
/*
		<tr>
			<td>Mobilni telefon</td>
			<td>069/891431</td>
		</tr>	
*/
		for($i=0;$i<sizeof($osnovne_informacije);$i++){
			if($osnovne_informacije[$i]['privatnost']=='da' && $user_status='visit') continue;
			echo "<tr>";
				echo "<td>" . $osnovne_informacije[$i]['naziv'] . "</td>";
				echo "<td>" . $osnovne_informacije[$i]['opis'] . "</td>";
			echo "</tr>";
		}

	?>	
		
	</table>
	<div class="_profile_info_button">
		<input type="button" class="_profile_info_btn proz_lft_itm_btn" idprofile="<?php echo $user_id; ?>" value="Izbiriši iz liste">
		<input type="button" class="_profile_info_btn" value="Pošalji poruku">
	</div>
</div>