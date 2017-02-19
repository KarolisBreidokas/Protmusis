-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Darbinė stotis: localhost
-- Atlikimo laikas: 2016 m. Lap 08 d. 17:09
-- Serverio versija: 5.5.53-0ubuntu0.14.04.1
-- PHP versija: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Duomenų bazė: `Info`
--

DELIMITER $$
--
-- Procedūros
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `reset`()
    NO SQL
Begin
Truncate Table Atsakymai;
Truncate Table Klausimai_Testas;
Truncate Table Klausimai_Zodziu;
Truncate Table Klausimai_Vaizdo;
Truncate Table Admins;
Truncate Table Komandos;
INSERT INTO Admins Values (0,"root",1);
INSERT INTO Komandos Values (0,"root");
UPDATE Admins Set Nr=0 where Nr=1;
UPDATE Komandos Set Nr=0 where Nr=1;
ALTER TABLE Admins Auto_Increment=1;
ALTER TABLE Komandos Auto_Increment=1;
INSERT INTO Klausimai_Testas VALUES (0,"Testinis Klausimas","A","B","C",null);
INSERT INTO Klausimai_Zodziu VALUES (0,"Testinis Klausimas",null);
INSERT INTO Klausimai_Vaizdo VALUES (0,"Testinis Klausimas",null);

End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Send`(IN `K` INT, IN `N` INT, IN `T` INT, IN `A` VARCHAR(100) CHARSET utf8)
Begin
declare Te int;
declare Tr bool;
if T<>0 then
insert into Atsakymai(Ko,Type,Nr,Ats,Teis) values (K,T,N,A,NULL);
end if;
Select Teis into Te from Klausimai_Testas where Nr=N;
if Te=A then
	set Tr=1;
else Set Tr=0;
end if;
insert into Atsakymai(Ko,Type,Nr,Ats,Teis) values (K,T,N,A,Tr);
End$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `Admins`
--

CREATE TABLE IF NOT EXISTS `Admins` (
  `Nr` int(11) NOT NULL AUTO_INCREMENT,
  `Pav` varchar(20) COLLATE utf8_lithuanian_ci NOT NULL,
  `SuAd` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Nr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci AUTO_INCREMENT=1 ;

--
-- Sukurta duomenų kopija lentelei `Admins`
--

INSERT INTO `Admins` (`Nr`, `Pav`, `SuAd`) VALUES
(0, 'root', 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `Atsakymai`
--

CREATE TABLE IF NOT EXISTS `Atsakymai` (
  `Ko` int(11) NOT NULL COMMENT 'Komandos Nr.',
  `Type` int(11) NOT NULL COMMENT 'Klausimo tipas',
  `Nr` int(11) NOT NULL COMMENT 'Klausimo numeris',
  `Ats` varchar(100) COLLATE utf8_lithuanian_ci DEFAULT NULL COMMENT 'Atsakymas',
  `Teis` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'už klausimą skirti taškai',
  PRIMARY KEY (`Ko`,`Type`,`Nr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `Klausimai_Testas`
--

CREATE TABLE IF NOT EXISTS `Klausimai_Testas` (
  `Nr` int(10) NOT NULL,
  `Klausimas` varchar(200) COLLATE utf8_lithuanian_ci NOT NULL,
  `A` varchar(100) COLLATE utf8_lithuanian_ci NOT NULL,
  `B` varchar(100) COLLATE utf8_lithuanian_ci NOT NULL,
  `C` varchar(100) COLLATE utf8_lithuanian_ci NOT NULL,
  `Teis` varchar(1) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  PRIMARY KEY (`Nr`),
  UNIQUE KEY `Nr` (`Nr`),
  KEY `Nr_2` (`Nr`),
  KEY `Nr_3` (`Nr`),
  KEY `Nr_4` (`Nr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `Klausimai_Testas`
--

INSERT INTO `Klausimai_Testas` (`Nr`, `Klausimas`, `A`, `B`, `C`, `Teis`) VALUES
(0, 'Testinis Klausimas', 'A', 'B', 'C', NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `Klausimai_Vaizdo`
--

CREATE TABLE IF NOT EXISTS `Klausimai_Vaizdo` (
  `Nr` int(10) NOT NULL,
  `Klausimas` varchar(100) COLLATE utf8_lithuanian_ci NOT NULL,
  `Teis` varchar(100) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  PRIMARY KEY (`Nr`),
  UNIQUE KEY `Nr` (`Nr`),
  KEY `Nr_2` (`Nr`),
  KEY `Nr_3` (`Nr`),
  KEY `Nr_4` (`Nr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `Klausimai_Vaizdo`
--

INSERT INTO `Klausimai_Vaizdo` (`Nr`, `Klausimas`, `Teis`) VALUES
(0, 'Testinis Klausimas', NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `Klausimai_Zodziu`
--

CREATE TABLE IF NOT EXISTS `Klausimai_Zodziu` (
  `Nr` int(10) NOT NULL,
  `Klausimas` varchar(200) COLLATE utf8_lithuanian_ci NOT NULL,
  `Teis` varchar(100) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  PRIMARY KEY (`Nr`),
  UNIQUE KEY `Nr` (`Nr`),
  KEY `Nr_2` (`Nr`),
  KEY `Nr_3` (`Nr`),
  KEY `Nr_4` (`Nr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `Klausimai_Zodziu`
--

INSERT INTO `Klausimai_Zodziu` (`Nr`, `Klausimas`, `Teis`) VALUES
(0, 'Testinis Klausimas', NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `Komandos`
--

CREATE TABLE IF NOT EXISTS `Komandos` (
  `Nr` int(11) NOT NULL AUTO_INCREMENT,
  `Pav` varchar(100) COLLATE utf8_lithuanian_ci NOT NULL,
  PRIMARY KEY (`Nr`),
  KEY `Nr` (`Nr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci AUTO_INCREMENT=1 ;

--
-- Sukurta duomenų kopija lentelei `Komandos`
--

INSERT INTO `Komandos` (`Nr`, `Pav`) VALUES
(0, 'root');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `ServerInfo`
--

CREATE TABLE IF NOT EXISTS `ServerInfo` (
  `Kn` int(20) NOT NULL,
  `Kt` varchar(10) COLLATE utf8_lithuanian_ci NOT NULL,
  `reset` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `ServerInfo`
--

INSERT INTO `ServerInfo` (`Kn`, `Kt`, `reset`) VALUES
(1, 'Testas', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
