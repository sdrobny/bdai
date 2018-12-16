-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Czas generowania: 16 Gru 2018, 11:24
-- Wersja serwera: 5.7.23
-- Wersja PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bdai`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building_name` int(11) NOT NULL,
  `city` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conference`
--

DROP TABLE IF EXISTS `conference`;
CREATE TABLE IF NOT EXISTS `conference` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tittle` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conference_address`
--

DROP TABLE IF EXISTS `conference_address`;
CREATE TABLE IF NOT EXISTS `conference_address` (
  `conference_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  PRIMARY KEY (`conference_id`,`address_id`),
  KEY `IDX_F6B3F039604B8382` (`conference_id`),
  KEY `IDX_F6B3F039F5B7AF75` (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conference_organizing_committee`
--

DROP TABLE IF EXISTS `conference_organizing_committee`;
CREATE TABLE IF NOT EXISTS `conference_organizing_committee` (
  `conference_id` int(11) NOT NULL,
  `organizing_committee_id` int(11) NOT NULL,
  PRIMARY KEY (`conference_id`,`organizing_committee_id`),
  KEY `IDX_B3EB1E0B604B8382` (`conference_id`),
  KEY `IDX_B3EB1E0B2AA77FB0` (`organizing_committee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conference_partner`
--

DROP TABLE IF EXISTS `conference_partner`;
CREATE TABLE IF NOT EXISTS `conference_partner` (
  `conference_id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  PRIMARY KEY (`conference_id`,`partner_id`),
  KEY `IDX_CAD6A1AE604B8382` (`conference_id`),
  KEY `IDX_CAD6A1AE9393F8FE` (`partner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conference_plan`
--

DROP TABLE IF EXISTS `conference_plan`;
CREATE TABLE IF NOT EXISTS `conference_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conference_id` int(11) DEFAULT NULL,
  `speaker_id` int(11) NOT NULL,
  `tittle` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C93305F3604B8382` (`conference_id`),
  KEY `IDX_C93305F3D04A0F27` (`speaker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `important_dates`
--

DROP TABLE IF EXISTS `important_dates`;
CREATE TABLE IF NOT EXISTS `important_dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conference_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67B6B843604B8382` (`conference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `organizing_committee`
--

DROP TABLE IF EXISTS `organizing_committee`;
CREATE TABLE IF NOT EXISTS `organizing_committee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `partner`
--

DROP TABLE IF EXISTS `partner`;
CREATE TABLE IF NOT EXISTS `partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `speaker`
--

DROP TABLE IF EXISTS `speaker`;
CREATE TABLE IF NOT EXISTS `speaker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `speaker`
--

INSERT INTO `speaker` (`id`, `name`, `surname`, `image`, `specialization`) VALUES
(3, 'asdasdasdasdQWERRTa222', 'asdasdasdasdasd', '../upload/test.jpg(2)', 'SPECJALIZACJA');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` smallint(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `admin`) VALUES
(3, 'user', '$2y$10$JxFZcvM4iHq0Zy0RK3P02e.wcTLTUVku3RH/.u/puhii6T/zbcAmi', 'asdf@gasdasd.com', 3),
(4, 'adminlogin', '$2y$10$/jSNnXajeCIrJVeRAaPRIuEBzgrfI7vwK..Vm3dRe130B7OYxaJvq', 'kontakt@softwaresystem.pl', 3);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `conference_address`
--
ALTER TABLE `conference_address`
  ADD CONSTRAINT `FK_F6B3F039604B8382` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F6B3F039F5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `conference_organizing_committee`
--
ALTER TABLE `conference_organizing_committee`
  ADD CONSTRAINT `FK_B3EB1E0B2AA77FB0` FOREIGN KEY (`organizing_committee_id`) REFERENCES `organizing_committee` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B3EB1E0B604B8382` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `conference_partner`
--
ALTER TABLE `conference_partner`
  ADD CONSTRAINT `FK_CAD6A1AE604B8382` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CAD6A1AE9393F8FE` FOREIGN KEY (`partner_id`) REFERENCES `partner` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `conference_plan`
--
ALTER TABLE `conference_plan`
  ADD CONSTRAINT `FK_C93305F3604B8382` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`),
  ADD CONSTRAINT `FK_C93305F3D04A0F27` FOREIGN KEY (`speaker_id`) REFERENCES `speaker` (`id`);

--
-- Ograniczenia dla tabeli `important_dates`
--
ALTER TABLE `important_dates`
  ADD CONSTRAINT `FK_67B6B843604B8382` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
