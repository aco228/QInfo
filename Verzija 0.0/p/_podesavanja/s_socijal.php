<?php
/*
			<div class="info_class">
				<div class="info_header">
					<div class="info_btn info_btn_izbrisi">Izbrisi vezu</div>
					<div class="info_btn info_btn_up">Pomjeri gore</div>
					<div class="info_btn info_btn_down">Pomjeri dolje</div>
					<div class="info_btn_err"></div>
				</div>
				<div class="info_unos" style="clear:both">
					<div class="socijal_pic" style="background-image:url('../_slike/socijalne_mreze/Facebook.png')"></div>
					<div class="socijal_right">
						<div class="socijal_siteurl" tip="facebook">http://www.facebook.com/</div>
						<input type="text" class="ptext pdinfo socijal_username" unos="ne" value="Username"/>
					</div>
				</div>
				<div style="clear:both"></div>
			</div><!--info_class-->

*/
?>
<div class="paragraf">
	<div class="paragraf_naslov">Veze prema vašim socijalnim mrežama:</div>
	<div class="paragraf_input">
		<div id="socijal_style" style="display:none">
			<div class="info_class">
				<div class="info_header">
					<div class="info_btn info_btn_izbrisi">Izbrisi vezu</div>
					<div class="info_btn info_btn_up">Pomjeri gore</div>
					<div class="info_btn info_btn_down">Pomjeri dolje</div>
					<div class="info_btn_err"></div>
				</div>
				<div class="info_unos" style="clear:both" id="sablon">
				</div>
				<div style="clear:both"></div>
			</div><!--info_class-->
		</div><!--info_style-->
		<div class="socijal_body">
			<?php
				for($i=0;$i<sizeof($socijalne_mreze_korisnika);$i++){
					echo "<div class=\"info_class\">
							<div class=\"info_header\">
								<div class=\"info_btn info_btn_izbrisi\">Izbrisi vezu</div>
								<div class=\"info_btn info_btn_up\">Pomjeri gore</div>
								<div class=\"info_btn info_btn_down\">Pomjeri dolje</div>
								<div class=\"info_btn_err\"></div>
							</div>
							<div class=\"info_unos\" style=\"clear:both\">
								<div class=\"socijal_pic\" style=\"background-image:url('../_slike/socijalne_mreze/".$socijalne_mreze_korisnika[$i]['slika'].".png')\"></div>
								<div class=\"socijal_right\">
									<div class=\"socijal_siteurl\" tip=\"".$socijalne_mreze_korisnika[$i]['naziv']."\">".$socijalne_mreze_korisnika[$i]['adresa']."</div>
									<input type=\"text\" class=\"ptext pdinfo socijal_username\" unos=\"da\" value=\"".$socijalne_mreze_korisnika[$i]['username']."\"/>
								</div>
							</div>
							<div style=\"clear:both\"></div>
						</div><!--info_class-->";
				}
			?>	
		</div><!--info_body-->
		<div class="info_options">
			<select class="info_multioption" id="socijal_select">
				<?php
					for($i=0;$i<sizeof($socijalne_mreze);$i++){
						echo "<option pic=\"".$socijalne_mreze[$i]['slika']."\" adress=\"".$socijalne_mreze[$i]['adresa']."\">".$socijalne_mreze[$i]['naziv']."</option>";
					}
				?>
			</select>
			<div class="info_option" id="info_dodajSocijal">Dodaj novu vezu</div>
		</div> <div style="clear:both"></div>

		<div class="paragraf_pomoc">
			Ukoliko ne želite da promjenite šifru ostavite oba polja prazna!</br>
			U prvo polje upišite vašu staru šifru, a u drugom polju novu šifru!
		</div>
	</div><!--paragraf_input-->
</div><!--paragraf-->