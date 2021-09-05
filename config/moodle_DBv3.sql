-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 05, 2021 at 07:41 PM
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
('7100', 3);

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
('nenad@gmail.com', 'c312d804d2819d2b900e88cab30492cb82d91733', 1),
('nesto@gmail.com', '3cae9563fead45e28e50c4cd45f4eb11cc723fd7', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nastavnik`
--

INSERT INTO `nastavnik` (`ime`, `prezime`, `email`, `idNastavnika`) VALUES
('Nenad', 'Ilic', 'nenad@gmail.com', 1),
('Boban', 'Peric', 'boban@gmail.com', 2),
('Ana', 'Bojic', 'ana@gmail.com', 3),
('Milica', 'Milic', 'milica@gmail.com', 4);

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
('123-2020', '7200'),
('123-2020', '7300'),
('617-2017', '7100'),
('617-2017', '7500'),
('635-2017', '7100'),
('635-2017', '7300'),
('635-2017', '7400'),
('635-2017', '7600'),
('635-2017', '7700');

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
('123-2020', 'Aca', 'Lukic', 'aca@gmail.com', 2, 1, 120, 1),
('555-2022', 'Luka', 'Lukic', 'luka@gmail.com', 1, 1, 0, 2),
('617-2017', 'Mateja', 'Vujsic', 'mateja@gmail.com', 8, 1, 152, 2),
('635-2017', 'Mladen', 'Ravlic', 'nesto@gmail.com', 7, 1, 168, 2);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
