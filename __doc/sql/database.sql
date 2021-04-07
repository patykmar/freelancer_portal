
SET foreign_key_checks = 0;

---
--- Table dph
---
DROP TABLE IF EXISTS `dph`;
CREATE TABLE `dph` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `nazev` varchar(50) COLLATE utf8_bin NOT NULL,
  `koeficient` float NOT NULL,
  `vychozi` tinyint(1) NULL COMMENT 'Vychozi = 1 jinak = null',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `dph` (`nazev`, `koeficient`, `vychozi`) VALUES
('Bez DPH',1.00, 1),
('21%',1.21,0);


---
--- Table jednotka
---
DROP TABLE IF EXISTS `jednotka`;
CREATE TABLE `jednotka` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `nazev` varchar(50) COLLATE utf8_bin NOT NULL,
  `zkratka` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `jednotka` (`nazev`, `zkratka`) VALUES
('Neurčito','x'),
('Korun českých','Kč'),
('Kusů','Ks'),
('Kilo','Kg');

---
--- Table zeme
---
DROP TABLE IF EXISTS `zeme`;
CREATE TABLE `zeme`(
	`id` tinyint unsigned not null auto_increment,
	`nazev` varchar(100) not null,
	primary key (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `zeme` (`nazev`) VALUES 
('Česká republika'),
('Slovenská republika'),
('Polská republika'),
('Republika Rakousko'),
('Spolková republika Německo');


---
--- Table firma
---
DROP TABLE IF EXISTS `firma`;
CREATE TABLE `firma`(
	`id` smallint unsigned not null auto_increment,
	`nazev` varchar(250) not null comment="Nazev spolecnosti vedeny v systemu, aby bylo mozne mit vice firem stejnych firem napr. s jinou adresou",
	`nazev_spolecnosti` varchar(250) not null comment="Nazev spolecnosti",
	`ico` varchar(20) null,
	`dic` varchar(20) null,
	`datum_vytvoreni` datetime not null,
	`datum_upravy` datetime not null,
	`ulice` varchar(100) not null,
	`obec` varchar(100) not null,
	`iban` varchar(100) not null,
	`cislo_uctu` varchar(50) not null,
	`psc` varchar(15) not null,
	`zeme` tinyint unsigned not null,
	primary key (`id`),
	FOREIGN KEY (`zeme`) REFERENCES zeme(`id`) ON DELETE no action ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `firma` (`id`, `nazev`, `nazev_spolecnosti`, `ico`, `dic`, `datum_vytvoreni`, `datum_upravy`, `ulice`, `obec`, `cislo_uctu`, `psc`, `zeme`, `iban`) VALUES
(1, 'Ing. Martin Patyk', 'Ing. Martin Patyk', '88230104', 'CZ8707145876', '2014-01-13 22:17:20', '2014-01-13 22:17:20', 'Ratibořská 36', 'Opava', '670100-2209225998/6210', '747 05', 1, NULL),
(2, 'PATYKDESIGN s.r.o.', 'PATYKDESIGN s.r.o.', '28648579', 'CZ28648579', '2014-01-13 22:24:39', '2014-01-13 22:25:18', 'Olomoucká 8', 'Opava - Předměstí', '', '746 01', 1, NULL),
(3, 'Opravna vah', 'Opravna vah - Vladimír Patyk', '44197373', 'CZ5908041524', '2014-01-13 22:27:52', '2014-01-13 22:27:52', 'U cukrovaru 12', 'Opava', '', '747 05', 1, NULL),
(4, 'SEDKO group s.r.o.', 'SEDKO group s.r.o.', '25857355', 'CZ25857355', '2014-01-13 22:31:07', '2014-01-13 22:31:07', 'Rooseveltova 1940/33', 'Opava', '', '746 01', 1, NULL),
(5, 'RD Rýmařov s.r.o.', 'RD Rýmařov s.r.o.', '18953581', 'CZ18953581', '2014-01-13 22:32:26', '2014-01-13 22:32:26', '8. května 1191/45', 'Rýmařov', '', '795 01', 1, NULL),
(6, 'PH&PM Trading s.r.o.', 'PH&PM Trading s.r.o.', '2784301', 'CZ02784301', '2014-02-08 15:05:18', '2014-07-18 14:34:19', 'Chudenická 1059/30', 'Praha - Hostivař', '2400578126/2010', '102 00', 1, NULL),
(7, 'Minerva-Gastro s.r.o.', 'Minerva-Gastro s.r.o.', '26840987', '', '2014-04-19 13:05:57', '2014-04-19 13:37:59', 'Mařádkova 2913/28', 'Opava', '', '746 01', 1, NULL),
(8, 'KOMCENTRA s.r.o.', 'KOMCENTRA s.r.o.', '41186991', 'CZ41186991', '2014-05-02 18:38:51', '2014-05-02 18:38:51', 'Dejvická 574/33', 'Praha 6', '', '160 00', 1, NULL),
(9, 'Jana Vimmerová', 'Jana Vimmerová', '71908129', '', '2014-05-02 18:51:22', '2014-05-02 18:51:22', 'Mánesova 8', 'Opava 1', '', '746 01', 1, NULL),
(10, 'Markéta Hajdíková', 'Markéta Hajdíková', '75270749', '', '2014-11-05 22:07:33', '2014-11-05 22:07:33', 'Olomoucká 2389/95', 'Opava', '', '746 01', 1, NULL),
(11, 'FMT spol.s.r.o.', 'FMT spol.s.r.o.', '27796868', 'CZ27796868', '2015-04-07 21:28:48', '2015-04-07 21:28:48', 'Cihelni 238', 'Neplachovice', '', '747 74', 1, NULL),
(12, 'BLAŽEK PROJEKT s.r.o.', 'BLAŽEK PROJEKT s.r.o.', '3412105', 'CZ03412105', '2015-04-08 20:45:44', '2015-04-08 20:45:44', 'Pekařská 1638/79', 'Opava - Kateřinky', '', '747 05', 1, NULL);


---
--- Table faktura_polozka
---
DROP TABLE IF EXISTS `faktura_polozka`;
CREATE TABLE `faktura_polozka` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `faktura` int unsigned NOT NULL COMMENT 'FK faktura',
  `nazev` varchar(250) COLLATE utf8_bin NOT NULL COMMENT 'Nazev polozky na fakture',
  `dph` tinyint unsigned NOT NULL COMMENT 'FK DPH',
  `jednotka` tinyint unsigned NOT NULL COMMENT 'FK Jednotka',
  `pocet_polozek` varchar(5) NOT NULL COMMENT 'Ciselna hodnota petimistna',
  `cena` decimal(8,4) NOT NULL COMMENT 'Cena za jednotku',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`dph`) REFERENCES dph(`id`) ON DELETE no action ON UPDATE CASCADE,
  FOREIGN KEY (`jednotka`) REFERENCES jednotka(`id`) ON DELETE no action ON UPDATE CASCADE,
  FOREIGN KEY (`faktura`) REFERENCES faktura(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


---
--- Table forma_uhrady
---
DROP TABLE IF EXISTS `forma_uhrady`;
CREATE TABLE `forma_uhrady` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `nazev` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `forma_uhrady` (`nazev`) VALUES
('převodním příkazem'),
('hotově');


---
--- Table forma_uhrady
---
DROP TABLE IF EXISTS `faktura`;
CREATE TABLE `faktura` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `dodavatel_nazev` varchar(250) NOT NULL COMMENT 'Nazev firmy dodavatele',
  `dodavatel_ico` varchar(20) NOT NULL COMMENT 'ICO',
  `dodavatel_dic` varchar(20) NULL COMMENT 'DIC',
  `dodavatel_ulice` varchar(100) NULL,
  `dodavatel_obec` varchar(100) NOT NULL,
  `dodavatel_psc` varchar(15) NOT NULL,
  `dodavatel_zeme` varchar(100) NOT NULL,
  `dodavatel_cislo_uctu` varchar(50) NOT NULL,
  `dodavatel_iban` varchar(100) NULL,
  `odberatel_nazev` varchar(250) NOT NULL COMMENT 'Nazev firmy odberatel',
  `odberatel_ico` varchar(20) NOT NULL COMMENT 'ICO',
  `odberatel_dic` varchar(20) NULL COMMENT 'DIC',
  `odberatel_ulice` varchar(100) NULL,
  `odberatel_obec` varchar(100) NOT NULL,
  `odberatel_psc` varchar(15) NOT NULL,
  `odberatel_zeme` varchar(100) NOT NULL,
  `odberatel_cislo_uctu` varchar(50) NOT NULL,
  `odberatel_iban` varchar(100) NULL,
  `splatnost` varchar(5) NOT NULL COMMENT 'Pocet dni splatnosti',
  `datum_vystaveni` datetime NOT NULL COMMENT 'Datum kdy se vytvorila faktura',
  `datum_splatnosti` date NOT NULL COMMENT 'now() + splatnost',
  `datum_zaplaceni` date NULL COMMENT 'Datum kdy doslo k zaplaceni',
  `vytvoril` int unsigned NOT NULL COMMENT 'FK osoba - osoba ktera vytvorila fakturu',
  `forma_uhrady` tinyint unsigned NOT NULL COMMENT 'FK forma_uhrady - zbusob uhrady',
  `vs` varchar(20) NOT NULL COMMENT 'Variabilni symbol - YYYYXXXX kde y=rok a x=id faktury',
  `ks` varchar(10) NOT NULL COMMENT 'Konstatni symbol 3658 pro IT',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`forma_uhrady`) REFERENCES forma_uhrady(`id`) ON DELETE no action ON UPDATE CASCADE,
  FOREIGN KEY (`vytvoril`) REFERENCES osoba(`id`) ON DELETE no action ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

