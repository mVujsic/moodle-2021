-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 05, 2021 at 07:41 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18
use moodle_db;

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
('617-2017', 1, 20);

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
  ADD CONSTRAINT `Fk kursId` FOREIGN KEY (`kursID`) REFERENCES `kurs` (`kursID`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
