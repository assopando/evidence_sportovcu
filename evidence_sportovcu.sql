-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Sob 16. bře 2024, 21:48
-- Verze serveru: 10.4.22-MariaDB
-- Verze PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `evidence_sportovcu`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `akce`
--

CREATE TABLE `akce` (
  `id_akce` int(11) NOT NULL,
  `nazev_akce` varchar(30) NOT NULL,
  `datum_zahajeni` date NOT NULL,
  `datum_konce` date DEFAULT NULL,
  `misto_kon` varchar(30) NOT NULL,
  `poradatel` varchar(100) DEFAULT NULL,
  `popisek_akce` text NOT NULL,
  `pritomni_uc` varchar(150) DEFAULT NULL,
  `shrnuti` varchar(100) DEFAULT NULL,
  `archivovano` tinyint(4) DEFAULT NULL,
  `id_opak` int(11) DEFAULT NULL,
  `id_kolo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `akce`
--

INSERT INTO `akce` (`id_akce`, `nazev_akce`, `datum_zahajeni`, `datum_konce`, `misto_kon`, `poradatel`, `popisek_akce`, `pritomni_uc`, `shrnuti`, `archivovano`, `id_opak`, `id_kolo`) VALUES
(1, 'Fotbalový turnaj 3. ročníků', '2024-01-17', '2024-01-20', 'Ostrava', NULL, 'Fotbalový turnaj 3. ročníků pořádáný městem Ostrava o pohár Primátora Ostravy, konaný na hale ŠŠTD', 'Mgr. Lenka Hudecová', 'student Bednář se zranil', 1, NULL, NULL),
(2, 'Hokejový turnaj', '2024-01-26', '2024-01-30', 'Opava', NULL, 'Krajské kolo Hokejové ligy středních škol', 'Mgr. Lenka Hudecová, Mgr. Jakub Hubáček', 'všichni žáci dali do toho maximum', 1, NULL, NULL),
(3, 'Volejbalový turnaj', '2024-03-06', '2024-03-08', 'Pardubice', NULL, 'Volejbalový turnaj pro SŠ konané v Pardubicích', 'Mgr. Daniela Kozáková', '', 1, NULL, NULL),
(4, 'Silový trojboj', '2024-03-05', '2024-03-06', 'Opava', NULL, 'Silový trojboj', 'Mgr. Lenka Hudecová', 'studenti se snažili ', 1, NULL, NULL),
(6, 'opak', '2024-03-01', '2024-03-08', 'Opava', 'karorak', 'popis akce', NULL, NULL, NULL, 1, 1),
(7, 'liga', '2024-03-09', '2024-03-31', 'kolo', 'kolo', 'kolo', NULL, NULL, NULL, 3, 5);

-- --------------------------------------------------------

--
-- Struktura tabulky `akce_disc`
--

CREATE TABLE `akce_disc` (
  `id_akce_disc` int(11) NOT NULL,
  `id_akce` int(11) NOT NULL,
  `id_disc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `akce_disc`
--

INSERT INTO `akce_disc` (`id_akce_disc`, `id_akce`, `id_disc`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 4),
(4, 4, 5),
(5, 4, 6),
(6, 4, 7),
(8, 6, 5),
(9, 7, 2),
(10, 6, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `disciplina`
--

CREATE TABLE `disciplina` (
  `id_disc` int(11) NOT NULL,
  `id_sport` int(11) NOT NULL,
  `nazev_disc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `disciplina`
--

INSERT INTO `disciplina` (`id_disc`, `id_sport`, `nazev_disc`) VALUES
(1, 2, 'hokej'),
(2, 1, 'fotbal'),
(4, 1, 'volejbal'),
(5, 9, 'bench'),
(6, 1, 'dřep'),
(7, 1, 'deadlift');

-- --------------------------------------------------------

--
-- Struktura tabulky `disc_ucast`
--

CREATE TABLE `disc_ucast` (
  `id_disc_ucast` int(11) NOT NULL,
  `id_ucast` int(11) NOT NULL,
  `id_disc` int(11) NOT NULL,
  `vys_du` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `disc_ucast`
--

INSERT INTO `disc_ucast` (`id_disc_ucast`, `id_ucast`, `id_disc`, `vys_du`) VALUES
(5, 6, 4, NULL),
(7, 8, 5, NULL),
(9, 10, 7, NULL),
(13, 14, 5, NULL),
(14, 15, 5, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `dodatecne_info`
--

CREATE TABLE `dodatecne_info` (
  `email` varchar(50) NOT NULL,
  `komentar_uzi` text NOT NULL,
  `kontaktni_udaje` varchar(50) DEFAULT NULL,
  `odkaz_na_web` varchar(225) DEFAULT NULL,
  `zdravotni_omezeni` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `kolo`
--

CREATE TABLE `kolo` (
  `id_kolo` int(11) NOT NULL,
  `nazev_kolo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `kolo`
--

INSERT INTO `kolo` (`id_kolo`, `nazev_kolo`) VALUES
(1, 'liga'),
(2, 'školní'),
(3, 'městské'),
(4, 'okresní'),
(5, 'krajské'),
(6, 'republikové'),
(8, 'mezinárodní');

-- --------------------------------------------------------

--
-- Struktura tabulky `opakovanost`
--

CREATE TABLE `opakovanost` (
  `id_opak` int(11) NOT NULL,
  `nazev_opak` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `opakovanost`
--

INSERT INTO `opakovanost` (`id_opak`, `nazev_opak`) VALUES
(1, 'jednorázově'),
(2, 'čtvrtletně'),
(3, 'pololetně'),
(5, 'ročně');

-- --------------------------------------------------------

--
-- Struktura tabulky `pozice`
--

CREATE TABLE `pozice` (
  `id_poz` int(11) NOT NULL,
  `nazev_poz` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `pozice`
--

INSERT INTO `pozice` (`id_poz`, `nazev_poz`) VALUES
(1, 'leve kridlo');

-- --------------------------------------------------------

--
-- Struktura tabulky `prispevek`
--

CREATE TABLE `prispevek` (
  `id_pris` int(11) NOT NULL,
  `id_uziv` int(11) NOT NULL,
  `nazev_pris` varchar(50) NOT NULL,
  `datum` date NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `soupiska`
--

CREATE TABLE `soupiska` (
  `id_soup` int(11) NOT NULL,
  `id_akce` int(11) NOT NULL,
  `nazev_skupiny` varchar(30) NOT NULL,
  `vys_s` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `soupiska`
--

INSERT INTO `soupiska` (`id_soup`, `id_akce`, `nazev_skupiny`, `vys_s`) VALUES
(1, 1, 'soupiska na fotbal', 'dobrý výkon'),
(2, 2, 'soupiska na volejbal I4B', 'skončili jsme předposlední'),
(3, 3, 'soupiska na volejbal I4B', 'dobrý výkon'),
(4, 4, 'soupiska na trojboj', 'Array'),
(5, 4, 'soupiska na dřep', 'Array'),
(7, 6, 'soupiska zkouska', NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `sport`
--

CREATE TABLE `sport` (
  `id_sport` int(11) NOT NULL,
  `nazev_sportu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `sport`
--

INSERT INTO `sport` (`id_sport`, `nazev_sportu`) VALUES
(1, 'míčové'),
(2, 'zimní'),
(9, 'silové');

-- --------------------------------------------------------

--
-- Struktura tabulky `sportuje`
--

CREATE TABLE `sportuje` (
  `id_sportuje` int(11) NOT NULL,
  `id_disc` int(11) NOT NULL,
  `email` varchar(11) NOT NULL,
  `id_poz` int(11) DEFAULT NULL,
  `id_urov` int(11) DEFAULT NULL,
  `tym` varchar(25) DEFAULT NULL,
  `rekord` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `trida`
--

CREATE TABLE `trida` (
  `id_trid` varchar(3) NOT NULL,
  `tridni_uc` varchar(50) NOT NULL,
  `zkratka_uc` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `trida`
--

INSERT INTO `trida` (`id_trid`, `tridni_uc`, `zkratka_uc`) VALUES
('E1A', 'Ing. Smyčková Renáta', 'SMY'),
('E1B', 'Mgr. et Mgr. Richterová Dajana', 'RIC'),
('E2A', 'Ing. Luptáková Monika', 'LUP'),
('E2B', 'Mgr. Drahošová Lenka', 'DRA'),
('E3A', 'Ing. Přindiš Aleš', 'PRI'),
('E3B', 'Ing. Poloch Petr', 'POC'),
('E4A', 'Ing. Lacková Martina', 'LAC'),
('E4B', 'Ing. Bos Petr, Ph.D.', 'BOS'),
('I1A', 'Mgr. Helsteinová Vladimíra', 'HEL'),
('I1B', 'Mgr. Kubíčková Marie', 'KUB'),
('I1C', 'Mgr. Kubinová Vlasta', 'KUI'),
('I2A', 'Mgr. Zelenková Denisa', 'ZEL'),
('I2B', 'Mgr. Hubáček Jakub', 'HUB'),
('I2C', 'Mgr. Plačková Aneta', 'PLO'),
('I3A', 'Mgr. Gibalová Helena', 'GIB'),
('I3B', 'Mgr. Šeligová Darja', 'SEL'),
('I3C', 'Mgr. Hudecová Lenka', 'HUD'),
('I4A', 'Ing. Krusberská Ivana', 'KRB'),
('I4B', 'Mgr. Kačerovský Antonín', 'KAC'),
('I4C', 'Ing. Zapletal Ivo', 'ZAP');

-- --------------------------------------------------------

--
-- Struktura tabulky `ucastnik`
--

CREATE TABLE `ucastnik` (
  `id_ucast` int(11) NOT NULL,
  `id_uziv` int(11) NOT NULL,
  `id_soup` int(11) NOT NULL,
  `vys_u` text DEFAULT NULL,
  `potrvzeni` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `ucastnik`
--

INSERT INTO `ucastnik` (`id_ucast`, `id_uziv`, `id_soup`, `vys_u`, `potrvzeni`) VALUES
(2, 100, 1, 'doporučuji studenta Bednáře pro příští turnaj', 1),
(3, 100, 2, 'skvělý hráč', 1),
(4, 101, 2, 'dobrý brankář', 1),
(5, 102, 2, 'skvělý hráč', 1),
(6, 100, 3, 'v pohodě', 1),
(8, 100, 4, 'nejlepší výkon ze všech', 1),
(9, 101, 4, 'druhý nejlepší výkon', 1),
(10, 102, 4, 'nejlepší výkon', 1),
(11, 100, 5, 'nejlepší výkon', 1),
(14, 100, 7, NULL, 1),
(15, 101, 7, NULL, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `uroven`
--

CREATE TABLE `uroven` (
  `id_urov` int(11) NOT NULL,
  `nazev_urov` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `uroven`
--

INSERT INTO `uroven` (`id_urov`, `nazev_urov`) VALUES
(1, 'celostatni');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatel`
--

CREATE TABLE `uzivatel` (
  `id_uziv` int(11) NOT NULL,
  `id_trid` varchar(3) DEFAULT NULL,
  `isic` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `opravneni` tinyint(1) NOT NULL,
  `jmeno` varchar(25) DEFAULT NULL,
  `prijmeni` varchar(25) DEFAULT NULL,
  `dat_nar` date DEFAULT NULL,
  `pohlavi` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `uzivatel`
--

INSERT INTO `uzivatel` (`id_uziv`, `id_trid`, `isic`, `email`, `opravneni`, `jmeno`, `prijmeni`, `dat_nar`, `pohlavi`) VALUES
(100, 'I4B', 'S420300750570P', 'r.bednar.st@spseiostrava.cz', 0, 'Radim', 'Bednář', '2005-02-04', 'M'),
(101, 'I4B', 'S420300750566B', NULL, 0, 'Duc Trung', 'Do', '2005-02-05', 'M'),
(102, 'I4B', 'S420300750563Q', NULL, 0, 'Samuel', 'Fabisz', '2004-08-11', 'M');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `akce`
--
ALTER TABLE `akce`
  ADD PRIMARY KEY (`id_akce`),
  ADD KEY `fk_akce_opak` (`id_opak`),
  ADD KEY `fk_akce_kolo` (`id_kolo`);

--
-- Indexy pro tabulku `akce_disc`
--
ALTER TABLE `akce_disc`
  ADD PRIMARY KEY (`id_akce_disc`),
  ADD KEY `id_akce` (`id_akce`),
  ADD KEY `id_disc` (`id_disc`);

--
-- Indexy pro tabulku `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id_disc`),
  ADD KEY `id_sport` (`id_sport`);

--
-- Indexy pro tabulku `disc_ucast`
--
ALTER TABLE `disc_ucast`
  ADD PRIMARY KEY (`id_disc_ucast`),
  ADD KEY `id_uzivsoup` (`id_ucast`),
  ADD KEY `id_disc` (`id_disc`);

--
-- Indexy pro tabulku `dodatecne_info`
--
ALTER TABLE `dodatecne_info`
  ADD PRIMARY KEY (`email`);

--
-- Indexy pro tabulku `kolo`
--
ALTER TABLE `kolo`
  ADD PRIMARY KEY (`id_kolo`);

--
-- Indexy pro tabulku `opakovanost`
--
ALTER TABLE `opakovanost`
  ADD PRIMARY KEY (`id_opak`);

--
-- Indexy pro tabulku `pozice`
--
ALTER TABLE `pozice`
  ADD PRIMARY KEY (`id_poz`);

--
-- Indexy pro tabulku `prispevek`
--
ALTER TABLE `prispevek`
  ADD PRIMARY KEY (`id_pris`),
  ADD KEY `fk_nastenka_uzivatel` (`id_uziv`) USING BTREE;

--
-- Indexy pro tabulku `soupiska`
--
ALTER TABLE `soupiska`
  ADD PRIMARY KEY (`id_soup`),
  ADD KEY `id_turn` (`id_akce`);

--
-- Indexy pro tabulku `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`id_sport`);

--
-- Indexy pro tabulku `sportuje`
--
ALTER TABLE `sportuje`
  ADD PRIMARY KEY (`id_sportuje`),
  ADD KEY `fk_sportuje_disc` (`id_disc`) USING BTREE,
  ADD KEY `uroven` (`id_urov`),
  ADD KEY `pozice` (`id_poz`);

--
-- Indexy pro tabulku `trida`
--
ALTER TABLE `trida`
  ADD PRIMARY KEY (`id_trid`);

--
-- Indexy pro tabulku `ucastnik`
--
ALTER TABLE `ucastnik`
  ADD PRIMARY KEY (`id_ucast`),
  ADD KEY `id_uziv` (`id_uziv`),
  ADD KEY `id_soup` (`id_soup`);

--
-- Indexy pro tabulku `uroven`
--
ALTER TABLE `uroven`
  ADD PRIMARY KEY (`id_urov`);

--
-- Indexy pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`id_uziv`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_trid` (`id_trid`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `akce`
--
ALTER TABLE `akce`
  MODIFY `id_akce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pro tabulku `akce_disc`
--
ALTER TABLE `akce_disc`
  MODIFY `id_akce_disc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pro tabulku `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id_disc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `disc_ucast`
--
ALTER TABLE `disc_ucast`
  MODIFY `id_disc_ucast` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pro tabulku `kolo`
--
ALTER TABLE `kolo`
  MODIFY `id_kolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `opakovanost`
--
ALTER TABLE `opakovanost`
  MODIFY `id_opak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `pozice`
--
ALTER TABLE `pozice`
  MODIFY `id_poz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `prispevek`
--
ALTER TABLE `prispevek`
  MODIFY `id_pris` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `soupiska`
--
ALTER TABLE `soupiska`
  MODIFY `id_soup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `sport`
--
ALTER TABLE `sport`
  MODIFY `id_sport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pro tabulku `sportuje`
--
ALTER TABLE `sportuje`
  MODIFY `id_sportuje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `ucastnik`
--
ALTER TABLE `ucastnik`
  MODIFY `id_ucast` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pro tabulku `uroven`
--
ALTER TABLE `uroven`
  MODIFY `id_urov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `id_uziv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `akce`
--
ALTER TABLE `akce`
  ADD CONSTRAINT `fk_akce_kolo` FOREIGN KEY (`id_kolo`) REFERENCES `kolo` (`id_kolo`),
  ADD CONSTRAINT `fk_akce_opak` FOREIGN KEY (`id_opak`) REFERENCES `opakovanost` (`id_opak`);

--
-- Omezení pro tabulku `akce_disc`
--
ALTER TABLE `akce_disc`
  ADD CONSTRAINT `akce_disc_ibfk_1` FOREIGN KEY (`id_akce`) REFERENCES `akce` (`id_akce`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akce_disc_ibfk_2` FOREIGN KEY (`id_disc`) REFERENCES `disciplina` (`id_disc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`id_sport`) REFERENCES `sport` (`id_sport`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `disc_ucast`
--
ALTER TABLE `disc_ucast`
  ADD CONSTRAINT `disc_ucast_ibfk_1` FOREIGN KEY (`id_ucast`) REFERENCES `ucastnik` (`id_ucast`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disc_ucast_ibfk_2` FOREIGN KEY (`id_disc`) REFERENCES `akce_disc` (`id_disc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `dodatecne_info`
--
ALTER TABLE `dodatecne_info`
  ADD CONSTRAINT `dodatecne_info_ibfk_1` FOREIGN KEY (`email`) REFERENCES `uzivatel` (`email`);

--
-- Omezení pro tabulku `prispevek`
--
ALTER TABLE `prispevek`
  ADD CONSTRAINT `prispevek_ibfk_1` FOREIGN KEY (`id_uziv`) REFERENCES `uzivatel` (`id_uziv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `soupiska`
--
ALTER TABLE `soupiska`
  ADD CONSTRAINT `soupiska_ibfk_5` FOREIGN KEY (`id_akce`) REFERENCES `akce` (`id_akce`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `sportuje`
--
ALTER TABLE `sportuje`
  ADD CONSTRAINT `sportuje_ibfk_5` FOREIGN KEY (`id_disc`) REFERENCES `disciplina` (`id_disc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sportuje_ibfk_6` FOREIGN KEY (`id_poz`) REFERENCES `pozice` (`id_poz`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sportuje_ibfk_7` FOREIGN KEY (`id_urov`) REFERENCES `uroven` (`id_urov`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sportuje_ibfk_8` FOREIGN KEY (`email`) REFERENCES `uzivatel` (`email`);

--
-- Omezení pro tabulku `ucastnik`
--
ALTER TABLE `ucastnik`
  ADD CONSTRAINT `ucastnik_ibfk_1` FOREIGN KEY (`id_uziv`) REFERENCES `uzivatel` (`id_uziv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ucastnik_ibfk_2` FOREIGN KEY (`id_soup`) REFERENCES `soupiska` (`id_soup`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD CONSTRAINT `uzivatel_ibfk_1` FOREIGN KEY (`id_trid`) REFERENCES `trida` (`id_trid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
