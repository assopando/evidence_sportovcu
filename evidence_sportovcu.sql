-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 29. pro 2023, 17:05
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
-- Struktura tabulky `archiv`
--

CREATE TABLE `archiv` (
  `id_arch` int(11) NOT NULL,
  `id_turn` int(11) NOT NULL,
  `popisek_arch` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `disciplina`
--

CREATE TABLE `disciplina` (
  `id_disc` int(11) NOT NULL,
  `id_sport` int(11) NOT NULL,
  `nazev_disc` varchar(50) NOT NULL
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
  `id_turn` int(11) NOT NULL,
  `id_sportuje` int(11) DEFAULT NULL,
  `nazev_skupiny` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'a'),
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
  `tym` varchar(25) DEFAULT NULL
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
-- Struktura tabulky `turnaj`
--

CREATE TABLE `turnaj` (
  `id_turn` int(11) NOT NULL,
  `id_sportuje` int(11) DEFAULT NULL,
  `nazev_soup` varchar(30) NOT NULL,
  `datum_zahajeni` date NOT NULL,
  `delka_dni` int(11) DEFAULT NULL,
  `misto_kon` varchar(30) NOT NULL,
  `popisek_turn` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `heslo` int(11) NOT NULL,
  `opravneni` tinyint(1) NOT NULL,
  `jmeno` varchar(25) DEFAULT NULL,
  `prijmeni` varchar(25) DEFAULT NULL,
  `dat_nar` date DEFAULT NULL,
  `pohlavi` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `archiv`
--
ALTER TABLE `archiv`
  ADD PRIMARY KEY (`id_arch`),
  ADD KEY `id_turn` (`id_turn`);

--
-- Indexy pro tabulku `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id_disc`),
  ADD KEY `fk_disc_sport` (`id_sport`) USING BTREE;

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
  ADD KEY `id_turn` (`id_turn`,`id_sportuje`),
  ADD KEY `id_sportuje` (`id_sportuje`);

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
-- Indexy pro tabulku `trida`
--
ALTER TABLE `trida`
  ADD PRIMARY KEY (`id_trid`);

--
-- Indexy pro tabulku `turnaj`
--
ALTER TABLE `turnaj`
  ADD PRIMARY KEY (`id_turn`),
  ADD KEY `id_sportuje` (`id_sportuje`);

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
-- AUTO_INCREMENT pro tabulku `archiv`
--
ALTER TABLE `archiv`
  MODIFY `id_arch` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id_disc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_soup` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT pro tabulku `turnaj`
--
ALTER TABLE `turnaj`
  MODIFY `id_turn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `uroven`
--
ALTER TABLE `uroven`
  MODIFY `id_urov` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `id_uziv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `archiv`
--
ALTER TABLE `archiv`
  ADD CONSTRAINT `archiv_ibfk_1` FOREIGN KEY (`id_turn`) REFERENCES `turnaj` (`id_turn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`id_sport`) REFERENCES `sport` (`id_sport`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `prispevek`
--
ALTER TABLE `prispevek`
  ADD CONSTRAINT `prispevek_ibfk_1` FOREIGN KEY (`id_uziv`) REFERENCES `uzivatel` (`id_uziv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `soupiska`
--
ALTER TABLE `soupiska`
  ADD CONSTRAINT `soupiska_ibfk_4` FOREIGN KEY (`id_sportuje`) REFERENCES `sportuje` (`id_sportuje`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `soupiska_ibfk_5` FOREIGN KEY (`id_turn`) REFERENCES `turnaj` (`id_turn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `sportuje`
--
ALTER TABLE `sportuje`
  ADD CONSTRAINT `sportuje_ibfk_4` FOREIGN KEY (`id_stud`) REFERENCES `uzivatel` (`id_uziv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sportuje_ibfk_5` FOREIGN KEY (`id_disc`) REFERENCES `disciplina` (`id_disc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sportuje_ibfk_6` FOREIGN KEY (`id_poz`) REFERENCES `pozice` (`id_poz`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sportuje_ibfk_7` FOREIGN KEY (`id_urov`) REFERENCES `uroven` (`id_urov`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD CONSTRAINT `uzivatel_ibfk_1` FOREIGN KEY (`id_trid`) REFERENCES `trida` (`id_trid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
