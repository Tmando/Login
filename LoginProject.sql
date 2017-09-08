-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 08. Sep 2017 um 07:37
-- Server-Version: 10.1.26-MariaDB
-- PHP-Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `LoginProject`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Photos`
--

CREATE TABLE `Photos` (
  `photoid` int(11) NOT NULL,
  `photolink` varchar(200) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Photos`
--

INSERT INTO `Photos` (`photoid`, `photolink`, `category`) VALUES
(1, 'http://www.vladi-private-islands.de/fileadmin/_processed_/1/7/csm_cousine_island_057_1339e09652.jpg', 'free'),
(2, 'http://www.vladi-private-islands.de/fileadmin/_processed_/6/7/csm_Eustatia_Island_teaser_c309f79e8f.jpg', 'premium'),
(3, 'http://www.vladi-private-islands.de/fileadmin/_processed_/f/9/csm_lodge_on_forsyth_island_034_d13dcb373c.jpg', 'free'),
(4, 'https://www.urlaubsguru.at/wp-content/uploads/2014/08/Artikelbild_Island_Nordlicht-686x438.jpg', 'premium');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `photolink` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`, `category`, `photolink`) VALUES
(1, 'tmando', 't.mandorfer@gmail.com', '759cfde265aaddb6f728ed08d97862bbd9b56fd39de97a049c640b4c5b70aac9', NULL, NULL),
(2, 'Max Doe', 'max.doe@gmx.at', '63ff23582c2a6f4b8db765aa1cb27425b921a5a3043eb2c8ba8941def307b08e', 'free', NULL),
(3, 'test', 'test1@test.at', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'free', NULL),
(4, 'test', 'test2@test2.at', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'free', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjE1MDkxMjQ3NV5BMl5BanBnXkFtZTcwMzQ3Mjc4MQ@@._V1_UY317_CR8,0,214,317_AL_.jpg'),
(5, 'testThree', 'test3@test3.at', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'premium', 'https://ichef.bbci.co.uk/images/ic/960x540/p01khvxr.jpg');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Photos`
--
ALTER TABLE `Photos`
  ADD PRIMARY KEY (`photoid`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Photos`
--
ALTER TABLE `Photos`
  MODIFY `photoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
