<div class="paragraf">
	<div class="paragraf_naslov">Korisničko ime:</div>
	<div class="paragraf_input">
		<input type="text" class="ptext pdinfo" id="sp_username" unos="ne" value="<?php echo $data['username']; ?>"/>
		<!--<input type="text" class="ptext" id="sp_username" maxlength="50" value="<?php echo $data['username']; ?>"/>-->
		<div class="paragraf_pomoc">Korisničko ime se koristi za lakši pristup vašem profilu</br>
			Bla bla
		</div>
	</div>
</div>

<div class="paragraf">
	<div class="paragraf_naslov">Naslov profila:</div>
	<div class="paragraf_input">
		<input type="text" class="ptext pdinfo" id="sp_naslov" unos="ne" value="<?php echo $data['naslov']; ?>"/>
		<!--<input type="text" class="ptext" id="sp_naslov" maxlength="150" unos='ne' value="<?php echo $data['naslov']; ?>"/>-->
		<div class="paragraf_pomoc">Upisite vase ime ili ime kompanije</div>
	</div>
</div>

<div class="paragraf">
	<div class="paragraf_naslov">Promjena šifre:</div>
	<div class="paragraf_input">
		<input type="password" class="ptext" id="sp_sifra1" maxlength="50" value=""/>
		<input type="password" class="ptext" id="sp_sifra2" maxlength="50" value=""/>
		<div class="paragraf_pomoc">
			Ukoliko ne želite da promjenite šifru ostavite oba polja prazna!</br>
			U prvo polje upišite vašu staru šifru, a u drugom polju novu šifru!
		</div>
	</div>
</div>