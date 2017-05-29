-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 29 2017 г., 02:22
-- Версия сервера: 10.1.22-MariaDB
-- Версия PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shadeproduction_social_network`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `userName` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `idBand` char(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`userName`, `idBand`, `time`, `message`) VALUES
('entershikari', '5fa29da2-87b5-4a9b-b0d5-6b78558fa9f4', '2017-05-29 02:11:57', 'Hello, guys! Welcome official page band Enter Shikari!'),
('againstthecurrent', '90c90c91-7af1-43d3-9f60-190a57c113a6', '2017-05-29 02:16:56', 'Welcome on page Against the Current band!');

-- --------------------------------------------------------

--
-- Структура таблицы `logo`
--

CREATE TABLE `logo` (
  `Id` char(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `nameLogo` varchar(300) DEFAULT NULL,
  `pathFile` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `logo`
--

INSERT INTO `logo` (`Id`, `nameLogo`, `pathFile`) VALUES
('5fa29da2-87b5-4a9b-b0d5-6b78558fa9f4', 'enter-shikari_10.jpg', '/images/logo/'),
('90c90c91-7af1-43d3-9f60-190a57c113a6', 'og_image.jpg', '/images/logo/');

-- --------------------------------------------------------

--
-- Структура таблицы `music`
--

CREATE TABLE `music` (
  `Id` char(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `nameMusic` varchar(300) DEFAULT NULL,
  `pathFile` varchar(300) DEFAULT NULL,
  `bandId` char(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `genreMusic` varchar(100) DEFAULT NULL,
  `time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `music`
--

INSERT INTO `music` (`Id`, `nameMusic`, `pathFile`, `bandId`, `genreMusic`, `time`) VALUES
('47dac63b-3eac-4bdf-9ae2-13e8bc77c203', '01. Running With The Wild Things.mp3', '\\data\\music\\', '90c90c91-7af1-43d3-9f60-190a57c113a6', 'Rock', '2017-05-29 02:22:27'),
('a924b47c-9cd1-435a-a087-03aa7b9a7f86', '08. Brighter.mp3', '\\data\\music\\', '90c90c91-7af1-43d3-9f60-190a57c113a6', 'Rock', '2017-05-29 02:17:52'),
('eca0d980-6c96-4da7-be69-1602cb4f36c6', 'Right now.mp3', '\\data\\music\\', '5fa29da2-87b5-4a9b-b0d5-6b78558fa9f4', 'Rock', '2017-05-29 02:06:47');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `Id` char(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `firstName` varchar(300) DEFAULT NULL,
  `lastName` varchar(300) DEFAULT NULL,
  `userName` varchar(300) DEFAULT NULL,
  `email` longtext,
  `activation` varchar(300) NOT NULL,
  `statusActivation` tinyint(1) DEFAULT NULL,
  `typeAccount` text,
  `genreMusic` varchar(100) DEFAULT NULL,
  `bandName` varchar(300) DEFAULT NULL,
  `about` text,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `skype` longtext,
  `twitter` longtext,
  `instagram` longtext,
  `facebook` longtext,
  `website` longtext,
  `origin` text,
  `yearsActive` text,
  `male` varchar(100) DEFAULT NULL,
  `city` text,
  `language` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Id`, `firstName`, `lastName`, `userName`, `email`, `activation`, `statusActivation`, `typeAccount`, `genreMusic`, `bandName`, `about`, `time`, `skype`, `twitter`, `instagram`, `facebook`, `website`, `origin`, `yearsActive`, `male`, `city`, `language`) VALUES
('5fa29da2-87b5-4a9b-b0d5-6b78558fa9f4', '', '', 'entershikari', 'skyskyshinysky@gmail.com', 'b90e2363d4bf3a59908d3b122e2fe9eb', 1, 'band', 'Rock', 'Enter Shikari', 'Enter Shikari are a British rock band formed in St Albans, Hertfordshire, England in 1999 under the name Hybryd by bassist Chris Batten, lead vocalist and keyboardist Roughton \"Rou\" Reynolds, and drummer Rob Rolfe. In 2003, guitarist Liam \"Rory\" Clewlow joined the band to complete its current lineup, and it adopted its current name. In 2006, they performed to a growing fanbase at Download Festival as well as a sold-out concert at the London Astoria. Their debut studio album, Take to the Skies, was released in 2007 and reached number 4 in the Official UK Album Chart, and has since been certified gold in the UK. Their second, Common Dreads, was released in 2009 and debuted on the UK Albums Chart at number 16;[2] while their third, A Flash Flood of Colour, was released in 2012 and debuted on the chart at number 4. Both have since been certified silver in the UK. The band spent a considerable amount of time supporting the latter release through the A Flash Flood of Colour World Tour, before beginning work on a fourth studio album, The Mindsweep, which was released in 2015.\r\n\r\nEnter Shikari have their own record label, Ambush Reality. However, they have also signed distribution deals with several major labels to help with worldwide distribution. Their eclectic musical style combines influences from rock, especially punk rock and hardcore punk, with those from various electronic music genres.', '2017-05-29 02:28:08', '', '', 'entershikari', '', 'https://www.entershikari.com/', '	St Albans, Hertfordshire, England, United Kingdom', '	1999–present', NULL, NULL, NULL),
('90c90c91-7af1-43d3-9f60-190a57c113a6', '', '', 'againstthecurrent', 'skyskyshinysky@yandex.ru', '7efc6fb773e0dd645157ceb0939f0792', 1, 'band', 'Rock', 'Against the Current', 'Against the Current (often abbreviated as ATC) is an American pop rock band based in Poughkeepsie, New York and formed in 2011. The band currently consists of lead vocalist Chrissy Costanza, guitarist Dan Gow, and drummer Will Ferri. The group gained a sizable YouTube following after posting their covers of popular songs from a variety of different artists.\r\n\r\nThe band\'s first EP, Infinity, was released on May 2014 under their own label. The band followed Infinity up with their next EP, Gravity, which was released on February 17, 2015. Shortly afterward, they signed to the record label Fueled by Ramen. Their debut full-length album, In Our Bones was released on May 20, 2016.', '2017-05-29 03:14:17', '', '', '', '', 'http://www.atcofficial.com/', '	Poughkeepsie, New York, United States', '	2011–present', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users_password`
--

CREATE TABLE `users_password` (
  `Id` char(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `userPassword` varchar(60) NOT NULL,
  `userHash` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_password`
--

INSERT INTO `users_password` (`Id`, `userPassword`, `userHash`) VALUES
('5fa29da2-87b5-4a9b-b0d5-6b78558fa9f4', '$2y$10$8uohFCpG8wC7A96uWaknierQX9A8Efv.vj8jM/QKdfczHikgqHDYq', '268b8d122885831067471af69a9de652'),
('90c90c91-7af1-43d3-9f60-190a57c113a6', '$2y$10$zgvO7kPS1oFq.jYlWpk75.objNR0.T0G7s5n6CRInxWgnr3BjJu6C', '268b8d122885831067471af69a9de652');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `users_password`
--
ALTER TABLE `users_password`
  ADD PRIMARY KEY (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
