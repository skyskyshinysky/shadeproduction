-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 08 2017 г., 23:08
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
('27ff66da-8fe8-405e-97ec-218cf02f763a', 'photo_2017-04-24_21-27-18.jpg', '\\data\\images\\logo\\');

-- --------------------------------------------------------

--
-- Структура таблицы `music`
--

CREATE TABLE `music` (
  `Id` char(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `nameMusic` varchar(300) DEFAULT NULL,
  `pathFile` varchar(300) DEFAULT NULL,
  `bandId` char(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `genreMusic` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `music`
--

INSERT INTO `music` (`Id`, `nameMusic`, `pathFile`, `bandId`, `genreMusic`) VALUES
('bd12ed30-a778-43ef-bce9-f87159ba65fd', '01. Running With The Wild Things.mp3', '\\data\\music\\', '27ff66da-8fe8-405e-97ec-218cf02f763a', 'Rock');

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
  `bandName` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Id`, `firstName`, `lastName`, `userName`, `email`, `activation`, `statusActivation`, `typeAccount`, `genreMusic`, `bandName`) VALUES
('27ff66da-8fe8-405e-97ec-218cf02f762', NULL, NULL, 'kakaha', 'qwe@mail.ru', '1123131231231231231231231', 1, 'band', 'Rock', 'Shikari'),
('27ff66da-8fe8-405e-97ec-218cf02f763a', '', '', 'shadeproduction', '1362856@mail.ru', '539341207999e03bc96e8f01e10c7104', 1, 'band', 'Rock', 'Enter Shikari'),
('a74f0ba6-4209-481c-a57b-2f91ab304056', 'Ilya', 'Pankov', 'ilyapankov', 'skyskyshinysky@yandex.ru', 'cecfcaab0495cb4d1d687cdbfa7c2a8a', 1, 'user', NULL, NULL);

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
('27ff66da-8fe8-405e-97ec-218cf02f763a', 'ea1b20f09d53fe011c0369e47a8f1514', 'dc540764cb5291e7720a65c6b4df3306'),
('a74f0ba6-4209-481c-a57b-2f91ab304056', 'ea1b20f09d53fe011c0369e47a8f1514', 'dc540764cb5291e7720a65c6b4df3306');

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
