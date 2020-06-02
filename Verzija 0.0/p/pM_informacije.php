<?php
	if(!isset($_POST['id']) || !isset($_POST['status']))  die();
	$user_id = $_POST['id']; $user_status = $_POST['status'];
	include_once("../_engine/init.php");
	include_once("_skripte/OsnovneInformacije.php"); $OI = new OsnovneInformacije(_getBaza());

	$info = $OI->getInfo($user_id);
	$kljucne_rijeci = $OI->getKljucneRijeci($user_id);
	$osnovne_informacije = $OI->getData('osnovne', $OI->getOsnovneInformacije($user_id));
	$socijalne_mreze = $OI->getData('socijalne_mreze', $OI->getSocijalneMreze($user_id));
	$detaljnije_informacije = $OI->getData('detaljnije', $OI->getDetaljnijeInformacije($user_id));

?>
<div id="informacije_stranica">
	<div id="naslov_profila"><?php echo $info['naslov']; ?></div>
	<div id="pM_informacije_slider">
		<div class="informacije_page" id="osnovne_informacije">
			<div class="informacije_page_naslov">Osnovne informacije: </div>

			<table class="informacije_table" id="osnovne_informacije_table">
			<?php
				/*
				<tr>
					<td>Mobilni telefon</td>
					<td>069/891431</td>
				</tr>
				*/

				echo "<tr>";
					echo "<td>Ključne riječi</td>";
					echo "<td>" . $kljucne_rijeci . "</td>";
				echo "</tr>";
				for($i=0;$i<sizeof($osnovne_informacije);$i++){
					if($osnovne_informacije[$i]['privatnost']=='da' && $user_status='visit') continue;
					echo "<tr>";
						echo "<td>" . $osnovne_informacije[$i]['naziv'] . "</td>";
						echo "<td>" . $osnovne_informacije[$i]['opis'] . "</td>";
					echo "</tr>";
				}

			?>
			</table>

			<div class="socijalne_mreze">
				<?php
					//<div class="informacije_mreza"> <a href="http"//www.facebook.com"><img src="_slike/socijalne_mreze/Facebook.png"></a> </div>
					//<div class="informacije_mreza"> <a href="http"//www.facebook.com"><img src="_slike/socijalne_mreze/YouTube.png"></a> </div>

					for($i=0;$i<sizeof($socijalne_mreze);$i++){
						echo "<div class=\"informacije_mreza\"> <a href=\"".$socijalne_mreze[$i]['adresa'].$socijalne_mreze[$i]['username']."\">";
						echo "<img src=\"_slike/socijalne_mreze/".$socijalne_mreze[$i]['slika'].".png\"></a> </div>";
					}
				?>
			</div>
			<div style="clear:both"></div>
		</div>

		<?php
		/*
				<div class="informacije_page">
					<div class="informacije_page_naslov">Osnovne informacije: </div>
					<div class="informacije_tekst">
					</div>
				</div>
		*/
			for($i=0;$i<sizeof($detaljnije_informacije);$i++){
				echo "<div class=\"informacije_page\">";
					echo "<div class=\"informacije_page_naslov\">".$detaljnije_informacije[$i]['naslov']."</div>";
					echo "<div class=\"informacije_tekst\">" . $detaljnije_informacije[$i]['tekst'] . "</div>";
				echo "</div>";
			}
		?>
	</div> 
</div>