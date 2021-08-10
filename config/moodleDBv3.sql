-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 10, 2021 at 04:57 PM
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
  PRIMARY KEY (`itemId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemId`, `brTeme`, `redBroj`, `naziv`, `tip`, `lokacija`) VALUES
(1, 1, 1, 'Uvod u predmet', 'pdf', 'https://iopscience.iop.org/article/10.1088/1755-1315/69/1/012073/pdf'),
(2, 1, 2, 'Pravila rada', 'pdf', 'https://iopscience.iop.org/article/10.1088/1755-1315/69/1/012073/pdf'),
(3, 2, 1, 'Prva lekcija', 'pdf', 'https://iopscience.iop.org/article/10.1088/1755-1315/69/1/012073/pdf'),
(4, 3, 1, 'Druga lekcija', 'pdf', 'https://iopscience.iop.org/article/10.1088/1755-1315/69/1/012073/pdf'),
(6, 3, 2, 'Primer', 'txt', 'iopscience.iop.org/article/10.1088/1755-1315/69/1/012073/pdf');

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
('4000', '123qwe', '7600'),
('7100', 'asdfge', '7100'),
('7200', '323fee', '7200'),
('7300', 'asdfg1', '7300'),
('7400', 'asd123', '7400');

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
('admin@mfkg.rs', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0),
('mateja@gmail.com', '4e3f433505a4e48562931dfd3daf5af3952a2dd9', 2),
('milanko@gmail.com', '5700227a9912a0272bc850f44e12bbfd86532f1d', 2),
('nesto@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nastavnik`
--

DROP TABLE IF EXISTS `nastavnik`;
CREATE TABLE IF NOT EXISTS `nastavnik` (
  `idNastavnika` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idNastavnika`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nastavnik`
--

INSERT INTO `nastavnik` (`idNastavnika`, `ime`, `prezime`, `email`) VALUES
(100, 'Вук', 'Вуковић', 'vuk.vukovic@gmail.com'),
(101, 'Владан', 'Матовић', 'vladamatovic@gmail.com');

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
('7100', 'Основе Интернета', 6, 7, 1),
('7200', 'Програмирање I', 6, 7, 1),
('7300', 'Програмирање II', 6, 7, 1),
('7400', 'Maшинско учење', 6, 7, 1),
('7500', 'Електроника', 6, 7, 1),
('7600', 'Механика', 6, 7, 1),
('7700', 'Дигитална обрада сигнала', 6, 7, 1),
('7800', 'Дебатинг', 6, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sadrzaj`
--

DROP TABLE IF EXISTS `sadrzaj`;
CREATE TABLE IF NOT EXISTS `sadrzaj` (
  `kursId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemId` int(11) NOT NULL,
  KEY `kursKljuc` (`kursId`),
  KEY `itemKljuc` (`itemId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sadrzaj`
--

INSERT INTO `sadrzaj` (`kursId`, `itemId`) VALUES
('7100', 1),
('7100', 2),
('7100', 3),
('7100', 4),
('7100', 6);

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
('1/2000', 'Milanko', 'Stefanovic', 'milanko@gmail.com', 8, 1, 140, 2),
('617-2017', 'Mateja', 'Vujsic', 'mateja@gmail.com', 7, 1, 152, 2),
('635-2017', 'Mladen', 'Ravlic', 'nesto@gmail.com', 7, 1, 168, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nalog`
--
ALTER TABLE `nalog`
  ADD CONSTRAINT `emailConstraintStudent` FOREIGN KEY (`email`) REFERENCES `student` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sadrzaj`
--
ALTER TABLE `sadrzaj`
  ADD CONSTRAINT `itemKljuc` FOREIGN KEY (`itemId`) REFERENCES `item` (`itemId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kursKljuc` FOREIGN KEY (`kursId`) REFERENCES `kurs` (`kursId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
