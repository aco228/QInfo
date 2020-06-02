<div class="paragraf">
	<div class="paragraf_naslov">Kratke informacije o vama:</div>

	<div class="paragraf_input">
		<div id="info_style" style="display:none">
			<div class="info_class">
				<div class="info_header">
					<div class="info_btn info_btn_izbrisi">Izbrisi informaciju</div>
					<div class="info_btn info_btn_up">Pomjeri gore</div>
					<div class="info_btn info_btn_down">Pomjeri dolje</div>
					<div class="info_btn_err"></div>
				</div>
				<div class="info_unos" style="clear:both">
					<input type="text" class="ptext ptext_info ptext_info_naziv" unos="ne" value="Naziv informacije"/>
					<input type="text" class="ptext ptext_info ptext_info_opis" unos="ne" value="Informacija"/>
				</div>
				<div class="info_footer" style="clear:both">
					<div class="pcheckbox pcheckbox_kartica" ok="da">
						<div class="pchechbox_box pgreen"></div>
						<div class="pchechbox_text">Prikazi na kartici</div>
					</div><!--pcheckbox-->
					<div class="pcheckbox pcheckbox_privatan" ok="ne">
						<div class="pchechbox_box pred"></div>
						<div class="pchechbox_text">Prikazi samo kruznim kontaktima</div>
					</div><!--pcheckbox-->
				</div><!--info_footer-->
				<div style="clear:both"></div>
			</div><!--info_class-->
		</div><!--info_style-->
		<div class="info_body">
			<?php
				for($i=0;$i<sizeof($osnovne_informacije);$i++){
					$boja_kartica = "pgreen"; $boja_privatnost = "pgreen";
					if($osnovne_informacije[$i]['kartica']=="ne") $boja_kartica = "pred";
					if($osnovne_informacije[$i]['privatnost']=="ne") $boja_privatnost = "pred";

					echo "<div class=\"info_class\">
							<div class=\"info_header\">
								<div class=\"info_btn info_btn_izbrisi\">Izbrisi informaciju</div>
								<div class=\"info_btn info_btn_up\">Pomjeri gore</div>
								<div class=\"info_btn info_btn_down\">Pomjeri dolje</div>
								<div class=\"info_btn_err\"></div>
							</div>
							<div class=\"info_unos\" style=\"clear:both\">
								<input type=\"text\" class=\"ptext ptext_info ptext_info_naziv\" unos=\"da\" value=\"".$osnovne_informacije[$i]['naziv']."\"/>
								<input type=\"text\" class=\"ptext ptext_info ptext_info_opis\" unos=\"da\" value=\"".$osnovne_informacije[$i]['opis']."\"/>
							</div>
							<div class=\"info_footer\" style=\"clear:both\">
								<div class=\"pcheckbox pcheckbox_kartica\" ok=\"".$osnovne_informacije[$i]['kartica']."\">
									<div class=\"pchechbox_box ".$boja_kartica."\"></div>
									<div class=\"pchechbox_text\">Prikazi na kartici</div>
								</div><!--pcheckbox-->
								<div class=\"pcheckbox pcheckbox_privatan\" ok=\"".$osnovne_informacije[$i]['privatnost']."\">
									<div class=\"pchechbox_box ".$boja_privatnost."\"></div>
									<div class=\"pchechbox_text\">Prikazi samo kruznim kontaktima</div>
								</div><!--pcheckbox-->
							</div><!--info_footer-->
							<div style=\"clear:both\"></div>
						</div>";
				}
			?>
		</div><!--info_body-->
		<div class="info_options">
			<div class="info_option" id="info_dodajInfo">Dodaj novu informaciju</div>
		</div> <div style="clear:both"></div>

		<div class="paragraf_pomoc">
			Ukoliko ne želite da promjenite šifru ostavite oba polja prazna!</br>
			U prvo polje upišite vašu staru šifru, a u drugom polju novu šifru!
		</div>
	</div><!--paragraf_input-->
</div><!--paragraf-->