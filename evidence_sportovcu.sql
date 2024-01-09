-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 09. led 2024, 19:07
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
  `delka_dni` int(11) DEFAULT NULL,
  `misto_kon` varchar(30) NOT NULL,
  `popisek_akce` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `akce`
--

INSERT INTO `akce` (`id_akce`, `nazev_akce`, `datum_zahajeni`, `delka_dni`, `misto_kon`, `popisek_akce`) VALUES
(1, 'thrgfdztrgf', '2024-01-17', NULL, 'oikujhgfbuijzhgf', 'dsagzjrhtgrfjuzhtgzthgfv');

-- --------------------------------------------------------

--
-- Struktura tabulky `disciplina`
--

CREATE TABLE `disciplina` (
  `id_disc` int(11) NOT NULL,
  `nazev_disc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `disciplina`
--

INSERT INTO `disciplina` (`id_disc`, `nazev_disc`) VALUES
(3, 'rsgdghd');

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

-- --------------------------------------------------------

--
-- Struktura tabulky `pozice`
--

CREATE TABLE `pozice` (
  `id_poz` int(11) NOT NULL,
  `nazev_poz` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 1, 'poilkujznhgbfvdc', NULL);

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
(1, 'asd'),
(2, 'b');

-- --------------------------------------------------------

--
-- Struktura tabulky `sportuje`
--

CREATE TABLE `sportuje` (
  `id_sportuje` int(11) NOT NULL,
  `id_disc` int(11) NOT NULL,
  `id_stud` int(11) NOT NULL,
  `id_poz` int(11) DEFAULT NULL,
  `id_urov` int(11) DEFAULT NULL,
  `tym` varchar(25) DEFAULT NULL,
  `rekord` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `sport_disc`
--

CREATE TABLE `sport_disc` (
  `id_sport_disc` int(11) NOT NULL,
  `id_sport` int(11) NOT NULL,
  `id_disc` int(11) NOT NULL
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
  `vys_u` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `ucastnik`
--

INSERT INTO `ucastnik` (`id_ucast`, `id_uziv`, `id_soup`, `vys_u`) VALUES
(2, 105, 1, '                                                                                                                                                                                                                                                                                                        dasdas                                                                                                                                                                                                                                                                                            ');

-- --------------------------------------------------------

--
-- Struktura tabulky `uroven`
--

CREATE TABLE `uroven` (
  `id_urov` int(11) NOT NULL,
  `nazev_urov` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatel`
--

CREATE TABLE `uzivatel` (
  `id_uziv` int(11) NOT NULL,
  `id_trid` varchar(3) DEFAULT NULL,
  `student` tinyint(1) NOT NULL,
  `isic` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `opravneni` tinyint(1) NOT NULL,
  `jmeno` varchar(25) DEFAULT NULL,
  `prijmeni` varchar(25) DEFAULT NULL,
  `dat_nar` date DEFAULT NULL,
  `pohlavi` varchar(1) DEFAULT NULL,
  `komentar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `uzivatel`
--

INSERT INTO `uzivatel` (`id_uziv`, `id_trid`, `student`, `isic`, `email`, `opravneni`, `jmeno`, `prijmeni`, `dat_nar`, `pohlavi`, `komentar`) VALUES
(100, 'I4B', 0, 'S420300750570P', NULL, 0, 'Radim', 'Bednář', '2005-02-04', 'M', NULL),
(101, 'I4B', 0, 'S420300750566B', NULL, 0, 'Duc Trung', 'Do', '2005-02-05', 'M', NULL),
(102, 'I4B', 0, 'S420300750563Q', NULL, 0, 'Samuel', 'Fabisz', '2004-08-11', 'M', NULL),
(105, 'I4B', 1, NULL, NULL, 1, 'samson', 'fabi', NULL, NULL, NULL),
(106, 'I3B', 1, NULL, NULL, 1, 'nula', 'donald', NULL, NULL, NULL);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `akce`
--
ALTER TABLE `akce`
  ADD PRIMARY KEY (`id_akce`);

--
-- Indexy pro tabulku `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id_disc`);

--
-- Indexy pro tabulku `disc_ucast`
--
ALTER TABLE `disc_ucast`
  ADD PRIMARY KEY (`id_disc_ucast`),
  ADD KEY `id_uzivsoup` (`id_ucast`),
  ADD KEY `id_disc` (`id_disc`);

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
  ADD KEY `fk_sportuje_sportovci` (`id_stud`) USING BTREE,
  ADD KEY `isic` (`id_stud`),
  ADD KEY `uroven` (`id_urov`),
  ADD KEY `pozice` (`id_poz`);

--
-- Indexy pro tabulku `sport_disc`
--
ALTER TABLE `sport_disc`
  ADD PRIMARY KEY (`id_sport_disc`),
  ADD KEY `id_disc` (`id_disc`),
  ADD KEY `id_sport` (`id_sport`);

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
  ADD KEY `id_trid` (`id_trid`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `akce`
--
ALTER TABLE `akce`
  MODIFY `id_akce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id_disc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `disc_ucast`
--
ALTER TABLE `disc_ucast`
  MODIFY `id_disc_ucast` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `pozice`
--
ALTER TABLE `pozice`
  MODIFY `id_poz` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `prispevek`
--
ALTER TABLE `prispevek`
  MODIFY `id_pris` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `soupiska`
--
ALTER TABLE `soupiska`
  MODIFY `id_soup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `sport`
--
ALTER TABLE `sport`
  MODIFY `id_sport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `sportuje`
--
ALTER TABLE `sportuje`
  MODIFY `id_sportuje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `sport_disc`
--
ALTER TABLE `sport_disc`
  MODIFY `id_sport_disc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `ucastnik`
--
ALTER TABLE `ucastnik`
  MODIFY `id_ucast` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `uroven`
--
ALTER TABLE `uroven`
  MODIFY `id_urov` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `id_uziv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `disc_ucast`
--
ALTER TABLE `disc_ucast`
  ADD CONSTRAINT `disc_ucast_ibfk_1` FOREIGN KEY (`id_ucast`) REFERENCES `ucastnik` (`id_ucast`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disc_ucast_ibfk_2` FOREIGN KEY (`id_disc`) REFERENCES `disciplina` (`id_disc`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `sportuje_ibfk_4` FOREIGN KEY (`id_stud`) REFERENCES `uzivatel` (`id_uziv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sportuje_ibfk_5` FOREIGN KEY (`id_disc`) REFERENCES `disciplina` (`id_disc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sportuje_ibfk_6` FOREIGN KEY (`id_poz`) REFERENCES `pozice` (`id_poz`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sportuje_ibfk_7` FOREIGN KEY (`id_urov`) REFERENCES `uroven` (`id_urov`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `sport_disc`
--
ALTER TABLE `sport_disc`
  ADD CONSTRAINT `sport_disc_ibfk_1` FOREIGN KEY (`id_disc`) REFERENCES `disciplina` (`id_disc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sport_disc_ibfk_2` FOREIGN KEY (`id_sport`) REFERENCES `sport` (`id_sport`) ON DELETE CASCADE ON UPDATE CASCADE;

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
