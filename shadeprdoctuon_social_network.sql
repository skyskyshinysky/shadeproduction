-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 08 2017 г., 02:00
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
  `id` int(6) NOT NULL,
  `userName` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `idBand` char(36) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `userName`, `idBand`, `time`, `message`) VALUES
(0, 'shadeproduction', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:11:06', 'Hellow'),
(0, 'shadeproduction', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:22:45', 'qwe'),
(0, 'shadeproduction', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:22:45', 'qwe'),
(0, 'shadeproduction', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:22:46', 'qwe'),
(0, 'shadeproduction', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:22:46', 'qwe'),
(0, 'shadeproduction', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:22:46', 'qwe'),
(0, 'shadeproduction', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:22:46', 'qwe'),
(0, 'shadeproduction', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:22:52', 'aa'),
(0, 'shadeproduction', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:22:53', 'aa'),
(0, 'shadeproduction', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:22:53', 'aa'),
(0, 'shadeproduction', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:22:53', 'aa'),
(0, 'shadeproduction', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:23:33', 'asd'),
(0, 'shadeproduction', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:23:52', 'asd'),
(0, 'shadeproduction', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:25:03', 'asd'),
(0, 'ilyapankov', '0f5eeef6-7c96-44b8-934c-9c856b054772', '2017-05-08 01:56:06', 'Cool music!');

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
('0f5eeef6-7c96-44b8-934c-9c856b054772', 'photo_2017-04-24_21-27-18.jpg', '\\data\\images\\logo\\');

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
('dac1bdfb-3e8f-440e-8483-00f0d1f7d15c', '01. Дикая кошка feat. Kristina Si.mp3', '\\data\\music\\', '0f5eeef6-7c96-44b8-934c-9c856b054772', 'Rap');

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
  `typeAccount` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Id`, `firstName`, `lastName`, `userName`, `email`, `activation`, `statusActivation`, `typeAccount`) VALUES
('0f5eeef6-7c96-44b8-934c-9c856b054772', '', '', 'shadeproduction', '1362856@mail.ru', '1df58df1acbb5fc0489687b176ce737d', 1, 'band'),
('db460a19-947c-49d2-b6e3-86f88d259791', 'Ilya', 'Pankov', 'ilyapankov', 'skyskyshinysky@yandex.ru', '744c645eaf71f83b092496b275e003bc', 1, 'user');

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
('0f5eeef6-7c96-44b8-934c-9c856b054772', 'ea1b20f09d53fe011c0369e47a8f1514', '530a8b321fda373eb6c224ff0c271471'),
('db460a19-947c-49d2-b6e3-86f88d259791', 'ea1b20f09d53fe011c0369e47a8f1514', '530a8b321fda373eb6c224ff0c271471');

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
