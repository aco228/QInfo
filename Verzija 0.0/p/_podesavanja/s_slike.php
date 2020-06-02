<?php
	$cover = "";
	$tabs = "style=\"display:none\"";
	if(sizeof($slike_profila)==0){ $cover = "style=\"display:none\""; $tabs = "";}
?>

<div id="slika_msg_div">
	<!--<div class="slika_msg msggreen">"+slike_msg_init_var['profile']+"</div>-->
</div>
<form id="slika_upload" action="" method="post" enctype="multipart/form-data">

	<div class="paragraf">
		<div class="paragraf_naslov">Profil slika:</div>
		<div class="paragraf_input">
			<div class="slika_holder">
				<div class="slika_cover" <?php echo $cover; ?>>
					<div class="slika_cover_close">
						<div class="slika_cover_close_text">Promjeni sliku</div>
						<div class="slika_cover_close_fade"></div>
					</div>
					<div class="slika_cover_orginal slika_prikaz" style="background-image:url(<?php echo $slike_profila['profile']['adresa'] ?>);"></div>
					<div class="slika_cover_shade"></div>
					<!--<div class="slika_cover_full slika_prikaz" style="background-image:url(<?php echo $slike_profila['profile']['adresa'] ?>);"></div>
				--></div>

				<div class="slika_tabs" <?php echo $tabs; ?> id="slika_tab_profile">
					<div class="slika_tab">
						<div class="slika_tab_option slika_tab_selected" data="slika_comp">Postavljanje slike sa racunara</div>
						<div class="slika_tab_option" data="slika_url">Postavljanje slike preko URL adrese</div>
						<div class="slika_tab_option" data="vrati_sliku">Povrati sliku</div>
					</div>
					<div class="slika_content">
						<div class="slika_comp">
							<input type="file" name="file_profile" id="fileid_profile" class="slika_comp_fileUpload"/>
							<div class="paragraf_pomoc">
								Pronađite sliku na vašem računari u postavite je kao vašu profil sliku!</br>
								Slika ne smije biti veća od 1mb
							</div>
						</div>
						<div class="slika_url" style="display:none">
							<input type="text" class="ptext slika_text_url" id="slika_url_profile" value=""/>
							<div class="paragraf_pomoc">Pronađite url adresu slike koju želite da postavite za profil</div>
						</div>
					</div>
				</div>
			</div>
			<div class="paragraf_pomoc">Postavite vašu profil sliku iz računara ili sa interneta</div>
		</div>
	</div>

	<!-- BACKGROUND -->
	<div class="paragraf">
		<div class="paragraf_naslov">Pozadinska slika:</div>
		<div class="paragraf_input">
			<div class="slika_holder">
				<div class="slika_cover" <?php echo $cover; ?>>
					<div class="slika_cover_close">
						<div class="slika_cover_close_text">Promjeni sliku</div>
						<div class="slika_cover_close_fade"></div>
					</div>
					<div class="slika_cover_orginal slika_prikaz" style="background-image:url(<?php echo $slike_profila['back']['adresa'] ?>);"></div>
					<div class="slika_cover_shade"></div>
					<!--<div class="slika_cover_full slika_prikaz" style="background-image:url(<?php echo $slike_profila['back']['adresa'] ?>);"></div>
				--></div>

				<div class="slika_tabs" <?php echo $tabs; ?> id="slika_tab_back">
					<div class="slika_tab">
						<div class="slika_tab_option slika_tab_selected" data="slika_comp">Postavljanje slike sa racunara</div>
						<div class="slika_tab_option" data="slika_url">Postavljanje slike preko URL adrese</div>
						<div class="slika_tab_option" data="vrati_sliku">Povrati sliku</div>
					</div>
					<div class="slika_content">
						<div class="slika_comp">
							<input type="file" name="file_back" id="fileid_back" class="slika_comp_fileUpload"/>
							<div class="paragraf_pomoc">
								Pronađite sliku na vašem računari u postavite je kao vašu pozadinsku sliku!</br>
								Slika ne smije biti veća od 1mb
							</div>
						</div>
						<div class="slika_url" style="display:none">
							<input type="text" class="ptext slika_text_url" id="slika_url_back" value=""/>
							<div class="paragraf_pomoc">Pronađite url adresu slike koju želite da postavite za profil</div>
						</div>
					</div>
				</div>
			</div>
			<div class="paragraf_pomoc">Postavite vašu profil sliku iz računara ili sa interneta</div>
		</div>
	</div>

	<!-- COVER -->
	<div class="paragraf">
		<div class="paragraf_naslov" id="picka">Cover slika sa vizit kartice:</div>
		<div class="paragraf_input">
			<div class="slika_holder">
				<div class="slika_cover" <?php echo $cover; ?>>
					<div class="slika_cover_close">
						<div class="slika_cover_close_text">Promjeni sliku</div>
						<div class="slika_cover_close_fade"></div>
					</div>
					<div class="slika_cover_orginal slika_prikaz" style="background-image:url(<?php echo $slike_profila['cover']['adresa'] ?>);"></div>
					<div class="slika_cover_shade"></div>
					<!--<div class="slika_cover_full slika_prikaz" style="background-image:url(<?php echo $slike_profila['cover']['adresa'] ?>);"></div>
				--></div>

				<div class="slika_tabs" <?php echo $tabs; ?> id="slika_tab_cover">
					<div class="slika_tab">
						<div class="slika_tab_option slika_tab_selected" data="slika_comp">Postavljanje slike sa racunara</div>
						<div class="slika_tab_option" data="slika_url">Postavljanje slike preko URL adrese</div>
						<div class="slika_tab_option" data="vrati_sliku">Povrati sliku</div>
					</div>
					<div class="slika_content">
						<div class="slika_comp">
							<input type="file" name="file_cover" id="fileid_cover" class="slika_comp_fileUpload"/>
							<div class="paragraf_pomoc">
								Pronađite sliku na vašem računari u postavite je kao vašu cover sliku!</br>
								Slika ne smije biti veća od 1mb
							</div>
						</div>
						<div class="slika_url" style="display:none">
							<input type="text" class="ptext slika_text_url" id="slika_url_cover" value=""/>
							<div class="paragraf_pomoc">Pronađite url adresu slike koju želite da postavite za profil</div>
						</div>
					</div>
					<?php
						$cekboksovi = array( 'da', 'pgreen', 'ne', 'pred', 'ne', 'pred');
						if(sizeof($slike_profila)!=0) $cover = $slike_profila['cover']['cover']; else $cover = '';
						$promjeni = false;
						switch($cover){
							case '': break;
							case 'profile': $cekboksovi[2]='da'; $cekboksovi[3] = 'pgreen'; $promjeni = true; break;
							case 'back': $cekboksovi[4]='da'; $cekboksovi[5] = 'pgreen'; $promjeni = true; break;
						}
						if($promjeni){ $cekboksovi[0]='ne'; $cekboksovi[1] = 'pred'; }
					?>
					<div class="pcheckbox pccheckbox_cover" id="cover_check_upload" ok="<?php echo $cekboksovi[0]; ?>">
						<div class="pchechbox_box <?php echo $cekboksovi[1]; ?>"></div>
						<div class="pchechbox_text">Koristi sliku koju sada postavljam</div>
					</div><!--pcheckbox-->
					<div class="pcheckbox pccheckbox_cover" id="cover_check_cover" ok="<?php echo $cekboksovi[2]; ?>">
						<div class="pchechbox_box <?php echo $cekboksovi[3]; ?>"></div>
						<div class="pchechbox_text">Koristi profil sliku kao cover</div>
					</div><!--pcheckbox-->
					<div class="pcheckbox pccheckbox_cover" id="cover_check_back" ok="<?php echo $cekboksovi[4]; ?>">
						<div class="pchechbox_box <?php echo $cekboksovi[5]; ?>"></div>
						<div class="pchechbox_text">Koristi pozadinsku sliku kao cover</div>
					</div><!--pcheckbox-->
				</div>
			</div>
		</div>
	</div>
</form>