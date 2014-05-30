SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE `heph_tracker` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `galaxy` tinyint(3) NOT NULL,
  `system` smallint(3) NOT NULL,
  `slot` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `player` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `planet` varchar(1500) COLLATE utf8_unicode_ci NOT NULL,
  `timeupdated` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `galaxy` (`galaxy`),
  KEY `system` (`system`),
  KEY `slot` (`slot`),
  KEY `galaxy_2` (`galaxy`,`system`),
  KEY `galaxy_3` (`galaxy`,`system`,`slot`),
  KEY `player` (`player`(333))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `planets` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `galaxy` tinyint(3) NOT NULL,
  `system` smallint(3) NOT NULL,
  `slot` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `player` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `alliance` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `timeupdated` int(11) NOT NULL,
  `rank` mediumint(11) NOT NULL,
  `planet` varchar(1500) COLLATE utf8_unicode_ci NOT NULL,
  `planetactivity` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `galaxy_3` (`galaxy`,`system`,`slot`),
  KEY `galaxy` (`galaxy`),
  KEY `system` (`system`),
  KEY `galaxy_2` (`galaxy`,`system`),
  KEY `slot` (`slot`),
  KEY `player` (`player`(333)),
  KEY `alliance` (`alliance`),
  KEY `timeupdated` (`timeupdated`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `planets_activity` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `galaxy` tinyint(3) NOT NULL,
  `system` smallint(3) NOT NULL,
  `slot` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `player` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `00` int(11) NOT NULL DEFAULT '0',
  `00_ts` int(11) NOT NULL DEFAULT '0',
  `01` int(11) NOT NULL DEFAULT '0',
  `01_ts` int(11) NOT NULL DEFAULT '0',
  `02` int(11) NOT NULL DEFAULT '0',
  `02_ts` int(11) NOT NULL DEFAULT '0',
  `03` int(11) NOT NULL DEFAULT '0',
  `03_ts` int(11) NOT NULL DEFAULT '0',
  `04` int(11) NOT NULL DEFAULT '0',
  `04_ts` int(11) NOT NULL DEFAULT '0',
  `05` int(11) NOT NULL DEFAULT '0',
  `05_ts` int(11) NOT NULL DEFAULT '0',
  `06` int(11) NOT NULL DEFAULT '0',
  `06_ts` int(11) NOT NULL DEFAULT '0',
  `07` int(11) NOT NULL DEFAULT '0',
  `07_ts` int(11) NOT NULL DEFAULT '0',
  `08` int(11) NOT NULL DEFAULT '0',
  `08_ts` int(11) NOT NULL DEFAULT '0',
  `09` int(11) NOT NULL DEFAULT '0',
  `09_ts` int(11) NOT NULL DEFAULT '0',
  `10` int(11) NOT NULL DEFAULT '0',
  `10_ts` int(11) NOT NULL DEFAULT '0',
  `11` int(11) NOT NULL DEFAULT '0',
  `11_ts` int(11) NOT NULL DEFAULT '0',
  `12` int(11) NOT NULL DEFAULT '0',
  `12_ts` int(11) NOT NULL DEFAULT '0',
  `13` int(11) NOT NULL DEFAULT '0',
  `13_ts` int(11) NOT NULL DEFAULT '0',
  `14` int(11) NOT NULL DEFAULT '0',
  `14_ts` int(11) NOT NULL DEFAULT '0',
  `15` int(11) NOT NULL DEFAULT '0',
  `15_ts` int(11) NOT NULL DEFAULT '0',
  `16` int(11) NOT NULL DEFAULT '0',
  `16_ts` int(11) NOT NULL DEFAULT '0',
  `17` int(11) NOT NULL DEFAULT '0',
  `17_ts` int(11) NOT NULL DEFAULT '0',
  `18` int(11) NOT NULL DEFAULT '0',
  `18_ts` int(11) NOT NULL DEFAULT '0',
  `19` int(11) NOT NULL DEFAULT '0',
  `19_ts` int(11) NOT NULL DEFAULT '0',
  `20` int(11) NOT NULL DEFAULT '0',
  `20_ts` int(11) NOT NULL DEFAULT '0',
  `21` int(11) NOT NULL DEFAULT '0',
  `21_ts` int(11) NOT NULL DEFAULT '0',
  `22` int(11) NOT NULL DEFAULT '0',
  `22_ts` int(11) NOT NULL DEFAULT '0',
  `23` int(11) NOT NULL DEFAULT '0',
  `23_ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `galaxy` (`galaxy`),
  KEY `system` (`system`),
  KEY `slot` (`slot`),
  KEY `galaxy_2` (`galaxy`,`slot`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
