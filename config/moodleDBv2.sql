-- phpMyAdmin SQL Dump
<<<<<<< HEAD
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 08, 2020 at 06:12 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
=======
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 22, 2020 at 01:42 AM
-- Server version: 8.0.19
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
>>>>>>> master
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
<<<<<<< HEAD
-- Database: `moodle`
=======
-- Database: `moodle_db`
>>>>>>> master
--

-- --------------------------------------------------------

--
-- Table structure for table `drzi`
--

DROP TABLE IF EXISTS `drzi`;
CREATE TABLE IF NOT EXISTS `drzi` (
<<<<<<< HEAD
  `kursID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idNastavnika` int(4) NOT NULL,
=======
  `kursID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idNastavnika` int NOT NULL,
>>>>>>> master
  KEY `FK kurs` (`kursID`),
  KEY `FK nastavnik` (`idNastavnika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
<<<<<<< HEAD
  `itemId` int(9) NOT NULL AUTO_INCREMENT,
  `brTeme` int(2) NOT NULL,
  `redBroj` int(2) NOT NULL,
  `naziv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokacija` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
=======
  `itemId` int NOT NULL AUTO_INCREMENT,
  `brTeme` int NOT NULL,
  `redBroj` int NOT NULL,
  `naziv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokacija` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
>>>>>>> master
  PRIMARY KEY (`itemId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kurs`
--

DROP TABLE IF EXISTS `kurs`;
CREATE TABLE IF NOT EXISTS `kurs` (
<<<<<<< HEAD
  `kursId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pristupniKod` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
=======
  `kursId` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pristupniKod` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
>>>>>>> master
  KEY `Foreign key` (`kursId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kurs`
--

INSERT INTO `kurs` (`kursId`, `pristupniKod`) VALUES
('BRTSI4000', '323fee'),
('BRTSI4001', 'asdfg1'),
('BRTSI4002', 'asd123'),
<<<<<<< HEAD
('OMI30003', '123qwe');
=======
('OMI30003', '123qwe'),
('7100', 'asdfg');
>>>>>>> master

-- --------------------------------------------------------

--
-- Table structure for table `nalog`
--

DROP TABLE IF EXISTS `nalog`;
CREATE TABLE IF NOT EXISTS `nalog` (
<<<<<<< HEAD
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sifra` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
=======
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sifra` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
>>>>>>> master
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nastavnik`
--

DROP TABLE IF EXISTS `nastavnik`;
CREATE TABLE IF NOT EXISTS `nastavnik` (
<<<<<<< HEAD
  `idNastavnika` int(4) NOT NULL,
  `ime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
=======
  `idNastavnika` int NOT NULL,
  `ime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
>>>>>>> master
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
<<<<<<< HEAD
  `studentID` int(11) NOT NULL,
=======
  `studentID` int NOT NULL,
>>>>>>> master
  `kursID` varchar(10) NOT NULL,
  PRIMARY KEY (`studentID`,`kursID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

<<<<<<< HEAD
=======
--
-- Dumping data for table `pohadja`
--

INSERT INTO `pohadja` (`studentID`, `kursID`) VALUES
(6352017, '7100'),
(6352017, '7300'),
(6352017, '7400'),
(6352017, '7600'),
(6352017, '7700');

>>>>>>> master
-- --------------------------------------------------------

--
-- Table structure for table `predmet`
--

DROP TABLE IF EXISTS `predmet`;
CREATE TABLE IF NOT EXISTS `predmet` (
<<<<<<< HEAD
  `sifraPred` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naziv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `espb` int(1) NOT NULL DEFAULT '6',
  `brSemestra` int(1) NOT NULL,
  `smerID` int(10) NOT NULL DEFAULT '1',
=======
  `sifraPred` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `naziv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `espb` int NOT NULL DEFAULT '6',
  `brSemestra` int NOT NULL,
  `smerID` int NOT NULL DEFAULT '1',
>>>>>>> master
  PRIMARY KEY (`sifraPred`),
  UNIQUE KEY `naziv` (`naziv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

<<<<<<< HEAD
=======
--
-- Dumping data for table `predmet`
--

INSERT INTO `predmet` (`sifraPred`, `naziv`, `espb`, `brSemestra`, `smerID`) VALUES
('7100', 'Predmet A', 6, 7, 1),
('7200', 'Predmet B', 6, 7, 1),
('7300', 'Predmet C', 6, 7, 1),
('7400', 'Predmet D', 6, 7, 1),
('7500', 'Predmet E', 6, 7, 1),
('7600', 'Predmet F', 6, 7, 1),
('7700', 'Predmet G', 6, 7, 1),
('7800', 'Predmet H', 6, 7, 1);

>>>>>>> master
-- --------------------------------------------------------

--
-- Table structure for table `sadrzaj`
--

DROP TABLE IF EXISTS `sadrzaj`;
CREATE TABLE IF NOT EXISTS `sadrzaj` (
<<<<<<< HEAD
  `kursId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemId` int(9) NOT NULL,
=======
  `kursId` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemId` int NOT NULL,
>>>>>>> master
  KEY `kursKljuc` (`kursId`),
  KEY `itemKljuc` (`itemId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `smer`
--

DROP TABLE IF EXISTS `smer`;
CREATE TABLE IF NOT EXISTS `smer` (
<<<<<<< HEAD
  `smerID` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(60) COLLATE utf8mb4_bin NOT NULL,
=======
  `smerID` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
>>>>>>> master
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
<<<<<<< HEAD
  `brIndeks` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upisanSemestar` int(1) NOT NULL,
  `kojiPutSlusaGod` int(11) NOT NULL DEFAULT '1',
  `osvojeniEspb` int(3) NOT NULL DEFAULT '0',
=======
  `brIndeks` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `upisanSemestar` int NOT NULL,
  `kojiPutSlusaGod` int NOT NULL DEFAULT '1',
  `osvojeniEspb` int NOT NULL DEFAULT '0',
>>>>>>> master
  PRIMARY KEY (`brIndeks`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
<<<<<<< HEAD
=======
-- Dumping data for table `student`
--

INSERT INTO `student` (`brIndeks`, `ime`, `prezime`, `email`, `upisanSemestar`, `kojiPutSlusaGod`, `osvojeniEspb`) VALUES
('6352017', 'Mladen', 'Ravlic', 'nesto@gmail.com', 7, 1, 168);

--
>>>>>>> master
-- Constraints for dumped tables
--

--
-- Constraints for table `drzi`
--
ALTER TABLE `drzi`
  ADD CONSTRAINT `FK kurs` FOREIGN KEY (`kursID`) REFERENCES `kurs` (`kursId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK nastavnik` FOREIGN KEY (`idNastavnika`) REFERENCES `nastavnik` (`idNastavnika`) ON DELETE CASCADE ON UPDATE CASCADE;

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
