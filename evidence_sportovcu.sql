-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 26. lis 2023, 17:57
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
-- Struktura tabulky `disciplina`
--

CREATE TABLE `disciplina` (
  `id_disc` int(11) NOT NULL,
  `id_sport` int(11) NOT NULL,
  `nazev_disc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `nastenka`
--

CREATE TABLE `nastenka` (
  `id_nas` int(11) NOT NULL,
  `id_uziv` int(11) NOT NULL,
  `datum` date NOT NULL,
  `nazev` varchar(50) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `osobni_udaje`
--

CREATE TABLE `osobni_udaje` (
  `id_osob_udaj` int(11) NOT NULL,
  `jmeno` varchar(50) NOT NULL,
  `prijmeni` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `sport`
--

CREATE TABLE `sport` (
  `id_sport` int(11) NOT NULL,
  `nazev_sportu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `sportovci`
--

CREATE TABLE `sportovci` (
  `id_stud` int(11) NOT NULL,
  `id_osob_udaj` int(11) NOT NULL,
  `id_trid` int(3) NOT NULL,
  `fotka` blob NOT NULL,
  `stav` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `sportuje`
--

CREATE TABLE `sportuje` (
  `id_sportuje` int(11) NOT NULL,
  `id_disc` int(11) NOT NULL,
  `id_stud` int(11) NOT NULL,
  `pozice` varchar(25) NOT NULL,
  `tym` varchar(25) NOT NULL,
  `uroven` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `trida`
--

CREATE TABLE `trida` (
  `id_trid` int(3) NOT NULL,
  `nazev` varchar(3) NOT NULL,
  `tridni_uc` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatel`
--

CREATE TABLE `uzivatel` (
  `id_uziv` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `heslo` int(11) NOT NULL,
  `id_osob_udaj` int(11) NOT NULL,
  `opravneni` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id_disc`),
  ADD KEY `sport_disc_fk` (`id_sport`);

--
-- Indexy pro tabulku `nastenka`
--
ALTER TABLE `nastenka`
  ADD PRIMARY KEY (`id_nas`),
  ADD KEY `uzivatel_nastenka_fk` (`id_uziv`);

--
-- Indexy pro tabulku `osobni_udaje`
--
ALTER TABLE `osobni_udaje`
  ADD PRIMARY KEY (`id_osob_udaj`);

--
-- Indexy pro tabulku `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`id_sport`);

--
-- Indexy pro tabulku `sportovci`
--
ALTER TABLE `sportovci`
  ADD PRIMARY KEY (`id_stud`),
  ADD KEY `osob_udaj_sportovci_fk` (`id_osob_udaj`),
  ADD KEY `trida_sportovci_fk` (`id_trid`);

--
-- Indexy pro tabulku `sportuje`
--
ALTER TABLE `sportuje`
  ADD PRIMARY KEY (`id_sportuje`),
  ADD KEY `sportovci_sportuje_fk` (`id_stud`),
  ADD KEY `disciplina_sportuje_fk` (`id_disc`);

--
-- Indexy pro tabulku `trida`
--
ALTER TABLE `trida`
  ADD PRIMARY KEY (`id_trid`);

--
-- Indexy pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`id_uziv`),
  ADD KEY `osob_udaj_uzivatel_fk` (`id_osob_udaj`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id_disc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `nastenka`
--
ALTER TABLE `nastenka`
  MODIFY `id_nas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `sport`
--
ALTER TABLE `sport`
  MODIFY `id_sport` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `sportuje`
--
ALTER TABLE `sportuje`
  MODIFY `id_sportuje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `id_uziv` int(11) NOT NULL AUTO_INCREMENT;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `sport_disc_fk` FOREIGN KEY (`id_sport`) REFERENCES `sport` (`id_sport`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `nastenka`
--
ALTER TABLE `nastenka`
  ADD CONSTRAINT `uzivatel_nastenka_fk` FOREIGN KEY (`id_uziv`) REFERENCES `uzivatel` (`id_uziv`);

--
-- Omezení pro tabulku `sport`
--
ALTER TABLE `sport`
  ADD CONSTRAINT `sport_ibfk_1` FOREIGN KEY (`id_sport`) REFERENCES `disciplina` (`id_sport`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `sportovci`
--
ALTER TABLE `sportovci`
  ADD CONSTRAINT `osob_udaj_sportovci_fk` FOREIGN KEY (`id_osob_udaj`) REFERENCES `osobni_udaje` (`id_osob_udaj`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trida_sportovci_fk` FOREIGN KEY (`id_trid`) REFERENCES `trida` (`id_trid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `sportuje`
--
ALTER TABLE `sportuje`
  ADD CONSTRAINT `disciplina_sportuje_fk` FOREIGN KEY (`id_disc`) REFERENCES `disciplina` (`id_disc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sportovci_sportuje_fk` FOREIGN KEY (`id_stud`) REFERENCES `sportovci` (`id_stud`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD CONSTRAINT `osob_udaj_uzivatel_fk` FOREIGN KEY (`id_osob_udaj`) REFERENCES `osobni_udaje` (`id_osob_udaj`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uzivatel_ibfk_1` FOREIGN KEY (`id_uziv`) REFERENCES `nastenka` (`id_uziv`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
