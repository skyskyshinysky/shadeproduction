-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 14 2017 г., 02:34
-- Версия сервера: 10.1.21-MariaDB
-- Версия PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shadeprdoctuon_social_network`
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
('1d6789f7-38f0-49e4-a96c-eabe58c037a8', 'enter-shikari_10.jpg', '/images/logo/'),
('3eabd582-76ad-4123-b9f9-a77c72c9a9f4', 'why_people_hate_nickelback.jpg', '/images/logo/'),
('51ba78a7-95f8-4569-8e5e-7c69e4c12b4d', 'nativeswithlogo.jpg', '/images/logo/'),
('7d2a5c51-9709-45df-8eec-c92f5e70a23b', '404avatar.jpg', '/images/logo/'),
('8528576e-b9cc-495e-a4c3-5172ddfa42f7', 'og_image.jpg', '/images/logo/');

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
('0d31814d-0269-4a65-96ab-8335eeb14611', '01. Running With The Wild Things.mp3', '\\data\\music\\', '8528576e-b9cc-495e-a4c3-5172ddfa42f7', 'Rock', '2017-05-13 22:13:46'),
('3ff4cbe1-3561-47e7-a445-697e1936e1e5', '09. Wasteland.mp3', '\\data\\music\\', '8528576e-b9cc-495e-a4c3-5172ddfa42f7', 'Rock', '2017-05-13 22:14:16'),
('513dd1a9-2448-440c-b1bf-c1c2f8242862', '05. In Our Bones.mp3', '\\data\\music\\', '8528576e-b9cc-495e-a4c3-5172ddfa42f7', 'Rock', '2017-05-13 22:14:07'),
('5506c47c-e13f-4eae-aea4-c604d106f282', '03. Chasing Ghosts.mp3', '\\data\\music\\', '8528576e-b9cc-495e-a4c3-5172ddfa42f7', 'Rock', '2017-05-13 22:14:03'),
('79f69c57-953c-4349-b7a1-3932ab00c628', '11. Roses.mp3', '\\data\\music\\', '8528576e-b9cc-495e-a4c3-5172ddfa42f7', 'Rock', '2017-05-13 22:14:23'),
('85becf88-148b-4bfe-99b2-f4190096926b', '12. Demons.mp3', '\\data\\music\\', '8528576e-b9cc-495e-a4c3-5172ddfa42f7', 'Rock', '2017-05-13 22:14:19'),
('9060bb65-6fbc-42a4-8f0c-31146abe4853', '01. Radiate.mp3', '\\data\\music\\', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', 'Rock', '2017-05-14 00:52:33'),
('ac742716-9bbb-4d45-b464-5deb2bb6c8d6', '02. Forget Me Now.mp3', '\\data\\music\\', '8528576e-b9cc-495e-a4c3-5172ddfa42f7', 'Rock', '2017-05-13 22:13:57'),
('d5fa94a6-0621-470c-a8fb-cedc96846f19', '06. Hero.mp3', '\\data\\music\\', '3eabd582-76ad-4123-b9f9-a77c72c9a9f4', 'Rock', '2017-05-14 00:47:47'),
('f1d00e08-5491-48b3-81c4-86ccc3fcae29', '08. Brighter.mp3', '\\data\\music\\', '8528576e-b9cc-495e-a4c3-5172ddfa42f7', 'Rock', '2017-05-13 22:14:12');

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
  `phone` longtext,
  `skype` longtext,
  `twitter` longtext,
  `instagram` longtext,
  `facebook` longtext,
  `website` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Id`, `firstName`, `lastName`, `userName`, `email`, `activation`, `statusActivation`, `typeAccount`, `genreMusic`, `bandName`, `about`, `time`, `phone`, `skype`, `twitter`, `instagram`, `facebook`, `website`) VALUES
('1d6789f7-38f0-49e4-a96c-eabe58c037a8', '', '', 'shadeproduction', 'skyskyshinysky@gmail.com', '799ec61ea2ad0b6c2d4ea84eb8dc3c50', 1, 'band', 'Rock', 'Enter Shikari', 'Enter Shikari are a British rock band formed in St Albans, Hertfordshire, England in 1999 under the name Hybryd by bassist Chris Batten, lead vocalist and keyboardist Roughton \"Rou\" Reynolds, and drummer Rob Rolfe. In 2003, guitarist Liam \"Rory\" Clewlow joined the band to complete its current lineup, and it adopted its current name. In 2006, they performed to a growing fanbase at Download Festival as well as a sold-out concert at the London Astoria. Their debut studio album, Take to the Skies, was released in 2007 and reached number 4 in the Official UK Album Chart, and has since been certified gold in the UK. Their second, Common Dreads, was released in 2009 and debuted on the UK Albums Chart at number 16;[2] while their third, A Flash Flood of Colour, was released in 2012 and debuted on the chart at number 4. Both have since been certified silver in the UK. The band spent a considerable amount of time supporting the latter release through the A Flash Flood of Colour World Tour, before beginning work on a fourth studio album, The Mindsweep, which was released in 2015.\n\nEnter Shikari have their own record label, Ambush Reality. However, they have also signed distribution deals with several major labels to help with worldwide distribution. Their eclectic musical style combines influences from rock, especially punk rock and hardcore punk, with those from various electronic music genres.', '2017-05-13 23:01:05', ' 79818395594', NULL, NULL, NULL, NULL, NULL),
('3eabd582-76ad-4123-b9f9-a77c72c9a9f4', '', '', 'nickelback', 'fiyuzu@doanart.com', '0c06f7152124cf68dba92c4804d4ccd2', 1, 'band', 'Rock', 'Nickelback', NULL, '2017-05-14 01:45:03', NULL, NULL, NULL, NULL, NULL, NULL),
('51ba78a7-95f8-4569-8e5e-7c69e4c12b4d', '', '', 'notadvised', 'pivupabi@doanart.com', '6ff33bfa0aeaa752767c0d07ce1c287d', 1, 'band', 'Rock', 'Natives', NULL, '2017-05-14 01:55:05', NULL, NULL, NULL, NULL, NULL, NULL),
('7d2a5c51-9709-45df-8eec-c92f5e70a23b', 'Ilya', 'Pankov', 'ilyapankov', 'skyskyshinysky@yandex.ru', 'b94acaecfd0748df89e4938ba84650d3', 1, 'user', NULL, NULL, NULL, '2017-05-13 22:52:28', NULL, NULL, NULL, NULL, NULL, NULL),
('8528576e-b9cc-495e-a4c3-5172ddfa42f7', '', '', 'againtsthecurrent', '1362856@mail.ru', '994ed2c044f71ccc95e5b06ff3a965ec', 1, 'band', 'Rock', 'Againts the Current', NULL, '2017-05-13 23:09:15', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users_password`
--

CREATE TABLE `users_password` (
  `Id` char(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `userPassword` varchar(32) NOT NULL,
  `userHash` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_password`
--

INSERT INTO `users_password` (`Id`, `userPassword`, `userHash`) VALUES
('1d6789f7-38f0-49e4-a96c-eabe58c037a8', 'ea1b20f09d53fe011c0369e47a8f1514', '562801358354716ebbffe06055736f87'),
('3eabd582-76ad-4123-b9f9-a77c72c9a9f4', 'ea1b20f09d53fe011c0369e47a8f1514', '562801358354716ebbffe06055736f87'),
('51ba78a7-95f8-4569-8e5e-7c69e4c12b4d', 'ea1b20f09d53fe011c0369e47a8f1514', '562801358354716ebbffe06055736f87'),
('7d2a5c51-9709-45df-8eec-c92f5e70a23b', 'ea1b20f09d53fe011c0369e47a8f1514', '562801358354716ebbffe06055736f87'),
('8528576e-b9cc-495e-a4c3-5172ddfa42f7', 'ea1b20f09d53fe011c0369e47a8f1514', '562801358354716ebbffe06055736f87');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
