-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 06, 2021 at 06:18 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moodle_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `drzi`
--

DROP TABLE IF EXISTS `drzi`;
CREATE TABLE IF NOT EXISTS `drzi` (
  `kursID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idNastavnika` int(11) NOT NULL,
  KEY `FK kurs` (`kursID`),
  KEY `FK nastavnik` (`idNastavnika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drzi`
--

INSERT INTO `drzi` (`kursID`, `idNastavnika`) VALUES
('7100', 1),
('7100', 4);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `itemId` int(11) NOT NULL AUTO_INCREMENT,
  `brTeme` int(11) NOT NULL,
  `redBroj` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokacija` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kursId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`itemId`),
  KEY `FK item kurs` (`kursId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemId`, `brTeme`, `redBroj`, `naziv`, `tip`, `lokacija`, `kursId`) VALUES
(1, 1, 1, 'Uvod u predmet', 'pdf', 'https://iopscience.iop.org/article/10.1088/1755-1315/69/1/012073/pdf', '7100'),
(2, 1, 2, 'Pravila rada', 'pdf', 'https://iopscience.iop.org/article/10.1088/1755-1315/69/1/012073/pdf', '7100'),
(3, 2, 1, 'Prva lekcija', 'pdf', 'https://iopscience.iop.org/article/10.1088/1755-1315/69/1/012073/pdf', '7100'),
(6, 3, 2, 'Primer', 'txt', 'iopscience.iop.org/article/10.1088/1755-1315/69/1/012073/pdf', '7100'),
(8, 3, 1, 'Druga lekcija', 'pdf', 'https://iopscience.iop.org/article/10.1088/1755-1315/69/1/012073/pdf', '7100'),
(9, 4, 1, 'Lekcija 4', 'ppt', 'https://iopscience.iop.org/article/10.1088/1755-1315/69/1/012073/pdf', '7100');

-- --------------------------------------------------------

--
-- Table structure for table `kurs`
--

DROP TABLE IF EXISTS `kurs`;
CREATE TABLE IF NOT EXISTS `kurs` (
  `kursId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pristupniKod` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `predmetID` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '7100',
  PRIMARY KEY (`kursId`),
  KEY `Foreign key` (`kursId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kurs`
--

INSERT INTO `kurs` (`kursId`, `pristupniKod`, `predmetID`) VALUES
('7100', 'asdfge', '7100'),
('7200', '323fee', '7200'),
('7300', 'asdfg1', '7300'),
('7400', 'asd123', '7400'),
('7500', 'asdfgh', '7800'),
('7600', 'asdfgh', '7600'),
('7700', 'asdfgh', '7700');

-- --------------------------------------------------------

--
-- Table structure for table `nalog`
--

DROP TABLE IF EXISTS `nalog`;
CREATE TABLE IF NOT EXISTS `nalog` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sifra` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip` int(1) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nalog`
--

INSERT INTO `nalog` (`email`, `sifra`, `tip`) VALUES
('aca@gmail.com', 'f64bb73095341d354a088601cad0cdead52f7b75', 2),
('admin@mfkg.rs', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0),
('ana@gmail.com', '72019bbac0b3dac88beac9ddfef0ca808919104f', 1),
('boban@gmail.com', '5ecb8051bca07199fd09668eca8620309618dec6', 1),
('luka@gmail.com', 'e69a756ac71279bfe707cf457c3331b5a413c5a7', 2),
('milica@gmail.com', '0f1b89ea1ee683218d1139370803d93edaca8e15', 1),
('milos@gmail.com', '58243df0c40ca8fbc493c87983b258070c5e8e61', 2),
('nenad@gmail.com', 'c312d804d2819d2b900e88cab30492cb82d91733', 1),
('nesto@gmail.com', '3cae9563fead45e28e50c4cd45f4eb11cc723fd7', 2),
('tara@gmail.com', '54a8445e42535513337134855be214b58a64c8d5', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nastavnik`
--

DROP TABLE IF EXISTS `nastavnik`;
CREATE TABLE IF NOT EXISTS `nastavnik` (
  `ime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idNastavnika` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idNastavnika`),
  KEY `FK email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nastavnik`
--

INSERT INTO `nastavnik` (`ime`, `prezime`, `email`, `idNastavnika`) VALUES
('Nenad', 'Ilic', 'nenad@gmail.com', 1),
('Boban', 'Peric', 'boban@gmail.com', 2),
('Ana', 'Biljic', 'ana@gmail.com', 3),
('Milica', 'Milic', 'milica@gmail.com', 4),
('Tara', 'Taric', 'tara@gmail.com', 5);

-- --------------------------------------------------------

--
-- Table structure for table `odgovori`
--

DROP TABLE IF EXISTS `odgovori`;
CREATE TABLE IF NOT EXISTS `odgovori` (
  `testId` int(11) NOT NULL,
  `pitanjeId` int(3) NOT NULL,
  `odgovorId` int(2) NOT NULL,
  `odgovor` varchar(3000) NOT NULL,
  `tacan` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`testId`,`pitanjeId`,`odgovorId`),
  KEY `Fk pitanjeId` (`pitanjeId`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `odgovori`
--

INSERT INTO `odgovori` (`testId`, `pitanjeId`, `odgovorId`, `odgovor`, `tacan`) VALUES
(1, 1, 1, 'Prvi odgovor', 0),
(1, 1, 2, 'Drugi odgovor', 1),
(1, 1, 3, 'Treci odgovor', 0),
(1, 2, 1, 'Prvi odgovor', 1),
(1, 2, 2, 'Drugi odgovor', 0),
(1, 3, 1, 'Prvi odgovor', 0),
(1, 3, 2, 'Drugi odgovor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pitanja`
--

DROP TABLE IF EXISTS `pitanja`;
CREATE TABLE IF NOT EXISTS `pitanja` (
  `testId` int(11) NOT NULL,
  `pitanjeId` int(3) NOT NULL,
  `pitanje` varchar(3000) NOT NULL,
  `bodovi` int(3) NOT NULL,
  PRIMARY KEY (`pitanjeId`,`testId`),
  KEY `FK testId` (`testId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pitanja`
--

INSERT INTO `pitanja` (`testId`, `pitanjeId`, `pitanje`, `bodovi`) VALUES
(1, 1, 'Probno pitanje 1', 5),
(1, 2, 'Probno pitanje 2', 5),
(1, 3, 'Probno pitanje 3', 10);

-- --------------------------------------------------------

--
-- Table structure for table `pohadja`
--

DROP TABLE IF EXISTS `pohadja`;
CREATE TABLE IF NOT EXISTS `pohadja` (
  `studentID` varchar(11) NOT NULL,
  `kursID` varchar(10) NOT NULL,
  PRIMARY KEY (`studentID`,`kursID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pohadja`
--

INSERT INTO `pohadja` (`studentID`, `kursID`) VALUES
('123-2020', '7100'),
('617-2017', '7100'),
('617-2017', '7200'),
('617-2017', '7500'),
('635-2017', '7100'),
('635-2017', '7300'),
('635-2017', '7400'),
('635-2017', '7600'),
('635-2017', '7700');

-- --------------------------------------------------------

--
-- Table structure for table `polaze`
--

DROP TABLE IF EXISTS `polaze`;
CREATE TABLE IF NOT EXISTS `polaze` (
  `studentID` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `testId` int(11) NOT NULL,
  `bodovi` int(3) NOT NULL,
  PRIMARY KEY (`studentID`,`testId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polaze`
--

INSERT INTO `polaze` (`studentID`, `testId`, `bodovi`) VALUES
('123-2020', 1, 0),
('617-2017', 1, 20),
('635-2017', 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `predmet`
--

DROP TABLE IF EXISTS `predmet`;
CREATE TABLE IF NOT EXISTS `predmet` (
  `sifraPred` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naziv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `espb` int(11) NOT NULL DEFAULT '6',
  `brSemestra` int(11) NOT NULL,
  `smerID` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sifraPred`),
  UNIQUE KEY `naziv` (`naziv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `predmet`
--

INSERT INTO `predmet` (`sifraPred`, `naziv`, `espb`, `brSemestra`, `smerID`) VALUES
('7100', 'Osnove interneta', 6, 7, 1),
('7200', 'Programiranje I', 6, 7, 1),
('7300', 'Programiranje II', 6, 7, 1),
('7400', 'Masinsko ucenje', 6, 7, 1),
('7500', 'Elektronika', 6, 7, 1),
('7600', 'Mehanika', 6, 7, 1),
('7700', 'Signali i sistemi', 6, 7, 1),
('7800', 'Baze podataka', 6, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `smer`
--

DROP TABLE IF EXISTS `smer`;
CREATE TABLE IF NOT EXISTS `smer` (
  `smerID` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`smerID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `smer`
--

INSERT INTO `smer` (`smerID`, `naziv`) VALUES
(1, 'Машинство'),
(2, 'Рачунарска техника и софтверско инжењерство');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `studentID` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upisanSemestar` int(11) NOT NULL,
  `kojiPutSlusaGod` int(11) NOT NULL DEFAULT '1',
  `osvojeniEspb` int(11) NOT NULL DEFAULT '0',
  `smerID` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`studentID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `ime`, `prezime`, `email`, `upisanSemestar`, `kojiPutSlusaGod`, `osvojeniEspb`, `smerID`) VALUES
('0', 'admin', 'admin', 'admin@mfkg.rs', 0, 1, 0, 1),
('111-2023', 'Milos', 'Milosevic', 'milos@gmail.com', 1, 1, 0, 1),
('123-2020', 'Aca', 'Lukic', 'aca@gmail.com', 2, 1, 120, 1),
('555-2022', 'Luka', 'Lukic', 'luka@gmail.com', 1, 1, 0, 2),
('617-2017', 'Mateja', 'Vujsic', 'mateja@gmail.com', 8, 1, 152, 2),
('635-2017', 'Mladen', 'Ravlic', 'nesto@gmail.com', 7, 1, 168, 2);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `testId` int(11) NOT NULL AUTO_INCREMENT,
  `kursID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `naziv` varchar(20) NOT NULL,
  PRIMARY KEY (`testId`),
  KEY `Fk kursId` (`kursID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`testId`, `kursID`, `naziv`) VALUES
(1, '7100', 'test01'),
(2, '7200', 'test01');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK item kurs` FOREIGN KEY (`kursId`) REFERENCES `kurs` (`kursId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nastavnik`
--
ALTER TABLE `nastavnik`
  ADD CONSTRAINT `FK email` FOREIGN KEY (`email`) REFERENCES `nalog` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `odgovori`
--
ALTER TABLE `odgovori`
  ADD CONSTRAINT `Fk pitanjeId` FOREIGN KEY (`pitanjeId`) REFERENCES `pitanja` (`pitanjeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pitanja`
--
ALTER TABLE `pitanja`
  ADD CONSTRAINT `FK testId` FOREIGN KEY (`testId`) REFERENCES `test` (`testId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `polaze`
--
ALTER TABLE `polaze`
  ADD CONSTRAINT `Fk studentId` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `Fk kursId` FOREIGN KEY (`kursID`) REFERENCES `kurs` (`kursId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
