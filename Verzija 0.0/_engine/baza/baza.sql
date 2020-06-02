/* qINFO */

/*===============================================================================================*/
/* PROFIL */
DROP TABLE IF EXISTS profil;
CREATE TABLE profil(
	pid int auto_increment primary key,
	email varchar(100) default '',
	username varchar(50) default '',
	sifra varchar(50) default '',
	status varchar(3) default 'nea', /* akt=aktivan; nea=neaktivan; ban=banovan; */
	jedinstvena_sifra varchar(32) default '', 
	datum_uclanjenja TIMESTAMP default CURRENT_TIMESTAMP,
	reputacija int default 0,
	
	/* OSNOVNE INFORMACIJE*/
	naslov varchar(150) default '',
	slike_profila text,
	osnovne_informacije text,
	detaljnije_informacije text,
	socijalne_mreze text,
	kljucne_rijeci varchar(500) default ''
)DEFAULT charset utf8;
INSERT INTO profil(email, sifra, username, status, naslov) VALUES (
	'a@a.com', /*email*/
	'aco', /*sifra*/
	'aco228', /*username*/
	'akt', /*status*/
	'Aleksandar Konatar' /*naslov*/
);

DROP TABLE IF EXISTS profil_friend;
CREATE TABLE profil_friend(
	pfi int auto_increment primary key,
	friend1 int not null,
	friend2 int not null,
	friend1_ime varchar(150) not null,
	friend2_ime varchar(150) not null,
	kruzno varchar(2) default 'ne'
);

DROP TABLE IF EXISTS socijalne_mreze;
CREATE TABLE socijalne_mreze(
	smid int auto_increment primary key,
	naziv varchar(20) default '',
	slika varchar(20) default '',
	adresa varchar(50)
);
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('Facebook', 'Facebook', 'http://www.facebook.com/');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('Behance', 'Behance', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('Blogger', 'Blogger', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('Deviant art', 'Deviantart', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('Digg', 'Digg', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('Dribble', 'Dribble', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('Flickr', 'Flickr', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('Google +', 'GooglePlus', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('Linkedin', 'Linkedin', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('MySpace', 'Myspace', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('Orkut', 'Orkut', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('Pinterest', 'Pinterest', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('RSS', 'RSS', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('StumbleUpon', 'StumbleUpon', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('StrumbleUpon', 'StrumbleUpon', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('Tumblr', 'Tumblr', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('Twitter', 'Twitter', 'http://www.twiter.com/');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('Vimeo', 'Vimeo', '');
INSERT INTO socijalne_mreze (naziv, slika, adresa) VALUES('YouTube', 'YouTube', 'http://wwww.youtube.com/');