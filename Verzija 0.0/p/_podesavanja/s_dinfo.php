<div class="paragraf">
	<div class="paragraf_naslov">Ključne riječi:</div>
	<div class="paragraf_input">
		<input type="text" class="ptext pdinfo" id="kljucne_rijeci" unos="ne" value="<?php echo $data['kljucne_rijeci']; ?>"/>
		<div class="paragraf_pomoc">
			Ukoliko ne želite da promjenite šifru ostavite oba polja prazna!</br>
			U prvo polje upišite vašu staru šifru, a u drugom polju novu šifru!
		</div>
	</div><!--paragraf_input-->
</div><!--paragraf-->

<div class="paragraf">
	<div class="paragraf_naslov">Kratke informacije o vama:</div>
	<div class="paragraf_input">
		<div id="dinfo_style" style="display:none">
			<div class="info_class">
				<div class="info_header">
					<div class="info_btn info_btn_izbrisi">Izbrisi informaciju</div>
					<div class="info_btn info_btn_up">Pomjeri gore</div>
					<div class="info_btn info_btn_down">Pomjeri dolje</div>
					<div class="info_btn_err"></div>
				</div>
				<div class="info_unos" style="clear:both">
					<input type="text" class="ptext pdinfo ptext_dinfo_naziv" unos="ne" value="Naziv paragrafa"/>
					<textarea class="ptext pdinfo ptext_dinfo_tekst" unos="ne">Tekst paragrafa</textarea>
				</div>
				<div style="clear:both"></div>
			</div><!--info_class-->
		</div><!--info_style-->
		<div class="dinfo_body">
			<?php
				for($i=0;$i<sizeof($detaljnije_informacije);$i++){

					echo "<div class=\"info_class\">
							<div class=\"info_header\">
								<div class=\"info_btn info_btn_izbrisi\">Izbrisi informaciju</div>
								<div class=\"info_btn info_btn_up\">Pomjeri gore</div>
								<div class=\"info_btn info_btn_down\">Pomjeri dolje</div>
								<div class=\"info_btn_err\"></div>
							</div>
							<div class=\"info_unos\" style=\"clear:both\">
								<input type=\"text\" class=\"ptext pdinfo ptext_dinfo_naziv\" unos=\"da\" value=\"".$detaljnije_informacije[$i]['naslov']."\"/>
								<textarea class=\"ptext pdinfo ptext_dinfo_tekst\" unos=\"da\">".$detaljnije_informacije[$i]['tekst']."</textarea>
							</div>
							<div style=\"clear:both\"></div>
						</div><!--info_class-->";
				}
			?>
		</div><!--info_body-->
		<div class="info_options">
			<div class="info_option" id="info_dodajDInfo">Dodaj novu paragraf</div>
		</div> <div style="clear:both"></div>

		<div class="paragraf_pomoc">
			Ukoliko ne želite da promjenite šifru ostavite oba polja prazna!</br>
			U prvo polje upišite vašu staru šifru, a u drugom polju novu šifru!
		</div>
	</div><!--paragraf_input-->
</div><!--paragraf-->