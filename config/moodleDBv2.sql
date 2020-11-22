SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moodle`
--

-- --------------------------------------------------------

--
-- Table structure for table `drzi`
--

DROP TABLE IF EXISTS `drzi`;
CREATE TABLE IF NOT EXISTS `drzi` (
  `kursID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idNastavnika` int(4) NOT NULL,
  KEY `FK kurs` (`kursID`),
  KEY `FK nastavnik` (`idNastavnika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `itemId` int(9) NOT NULL AUTO_INCREMENT,
  `brTeme` int(2) NOT NULL,
  `redBroj` int(2) NOT NULL,
  `naziv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokacija` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`itemId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kurs`
--

DROP TABLE IF EXISTS `kurs`;
CREATE TABLE IF NOT EXISTS `kurs` (
  `kursId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pristupniKod` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `Foreign key` (`kursId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kurs`
--

INSERT INTO `kurs` (`kursId`, `pristupniKod`) VALUES
('BRTSI4000', '323fee'),
('BRTSI4001', 'asdfg1'),
('BRTSI4002', 'asd123'),
('OMI30003', '123qwe');

-- --------------------------------------------------------

--
-- Table structure for table `nalog`
--

DROP TABLE IF EXISTS `nalog`;
CREATE TABLE IF NOT EXISTS `nalog` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sifra` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nastavnik`
--

DROP TABLE IF EXISTS `nastavnik`;
CREATE TABLE IF NOT EXISTS `nastavnik` (
  `idNastavnika` int(4) NOT NULL,
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
  `studentID` int(11) NOT NULL,
  `kursID` varchar(10) NOT NULL,
  PRIMARY KEY (`studentID`,`kursID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `predmet`
--

DROP TABLE IF EXISTS `predmet`;
CREATE TABLE IF NOT EXISTS `predmet` (
  `sifraPred` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naziv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `espb` int(1) NOT NULL DEFAULT '6',
  `brSemestra` int(1) NOT NULL,
  `smerID` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sifraPred`),
  UNIQUE KEY `naziv` (`naziv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sadrzaj`
--

DROP TABLE IF EXISTS `sadrzaj`;
CREATE TABLE IF NOT EXISTS `sadrzaj` (
  `kursId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemId` int(9) NOT NULL,
  KEY `kursKljuc` (`kursId`),
  KEY `itemKljuc` (`itemId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `brIndeks` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upisanSemestar` int(1) NOT NULL,
  `kojiPutSlusaGod` int(11) NOT NULL DEFAULT '1',
  `osvojeniEspb` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`brIndeks`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
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