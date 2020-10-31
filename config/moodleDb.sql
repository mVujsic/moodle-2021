-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 30, 2020 at 08:51 PM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moodleDb`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `itemId` int(9) NOT NULL,
  `brTeme` int(2) NOT NULL,
  `redBroj` int(2) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_bin NOT NULL,
  `tip` varchar(5) COLLATE utf8_bin NOT NULL,
  `lokacija` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `kursevi`
--

CREATE TABLE `kursevi` (
  `kursId` varchar(255) COLLATE utf8_bin NOT NULL,
  `pristupniKod` varchar(6) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `nalozi`
--

CREATE TABLE `nalozi` (
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `sifra` varchar(255) COLLATE utf8_bin NOT NULL,
  `tip` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `nastavnici`
--

CREATE TABLE `nastavnici` (
  `idNastavnika` int(4) NOT NULL,
  `ime` varchar(255) COLLATE utf8_bin NOT NULL,
  `prezime` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `predmeti`
--

CREATE TABLE `predmeti` (
  `sifraPred` varchar(255) COLLATE utf8_bin NOT NULL,
  `naziv` varchar(255) COLLATE utf8_bin NOT NULL,
  `espb` int(1) NOT NULL DEFAULT '6',
  `brSemestra` int(1) NOT NULL,
  `smerId` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `sadrzaj`
--

CREATE TABLE `sadrzaj` (
  `kursId` varchar(255) COLLATE utf8_bin NOT NULL,
  `itemId` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `studenti`
--

CREATE TABLE `studenti` (
  `brIndeks` varchar(8) COLLATE utf8_bin NOT NULL,
  `ime` varchar(255) COLLATE utf8_bin NOT NULL,
  `prezime` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `upisanSemestar` int(1) NOT NULL,
  `kojiPutSlusaGod` int(11) NOT NULL DEFAULT '1',
  `osvojeniEspb` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `kursevi`
--
ALTER TABLE `kursevi`
  ADD KEY `Foreign key` (`kursId`);

--
-- Indexes for table `nalozi`
--
ALTER TABLE `nalozi`
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `nastavnici`
--
ALTER TABLE `nastavnici`
  ADD PRIMARY KEY (`idNastavnika`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `predmeti`
--
ALTER TABLE `predmeti`
  ADD PRIMARY KEY (`sifraPred`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `sadrzaj`
--
ALTER TABLE `sadrzaj`
  ADD KEY `kursKljuc` (`kursId`),
  ADD KEY `itemKljuc` (`itemId`);

--
-- Indexes for table `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`brIndeks`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `itemId` int(9) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `kursevi`
--
ALTER TABLE `kursevi`
  ADD CONSTRAINT `Foreign key` FOREIGN KEY (`kursId`) REFERENCES `predmeti` (`sifraPred`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nalozi`
--
ALTER TABLE `nalozi`
  ADD CONSTRAINT `emailConstraintNastavnik` FOREIGN KEY (`email`) REFERENCES `nastavnici` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emailConstraintStudent` FOREIGN KEY (`email`) REFERENCES `studenti` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sadrzaj`
--
ALTER TABLE `sadrzaj`
  ADD CONSTRAINT `itemKljuc` FOREIGN KEY (`itemId`) REFERENCES `item` (`itemId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kursKljuc` FOREIGN KEY (`kursId`) REFERENCES `kursevi` (`kursId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
