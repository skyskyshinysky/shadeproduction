-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 16 2017 г., 03:39
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

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`userName`, `idBand`, `time`, `message`) VALUES
('shadeproduction', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 02:26:46', 'hello,bro!'),
('ilyapankov', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 02:27:40', 'Phoenix!'),
('ilyapankov', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 02:44:18', 'qwe'),
('ilyapankov', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 02:44:19', 'qwe'),
('ilyapankov', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 02:44:21', 'qwe'),
('ilyapankov', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 02:44:22', 'ert'),
('ilyapankov', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 02:44:24', 'tryu'),
('ilyapankov', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 02:44:26', 'tyui'),
('ilyapankov', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 02:44:28', 'yuoi'),
('shadeproduction', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 02:47:37', 'qweasd'),
('shadeproduction', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 02:47:39', 'qweasdadasdf'),
('shadeproduction', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 02:47:41', 'sdfgsdfg'),
('shadeproduction', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 02:47:42', 'zxcvzxb'),
('shadeproduction', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 02:47:45', 'asdftggh'),
('shadeproduction', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 03:39:05', 'easd;flajsdl;kfjalskdjfl;asjdfl;kasjdfl;kasjdfl;kasjl;kdvnla;dfnv;af;asdflaksjdfl;ajsdfoiwqerpoqwiejropweifjql;wkefj;alskdfj;laskglkdfnlsfja;lskdjf;laskjdfl;aksjdfl;aksjdlf;kjfpowierjoqpwierpoqiwherpoqhepfkd;jf;alskdjf;alksjdf;laskv;lkanf;lkand;flkas;ldkfma;lskdjfasdfasdfasdfasdf'),
('shadeproduction', '1d6789f7-38f0-49e4-a96c-eabe58c037a8', '2017-05-15 03:39:35', 'asdfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff'),
('shadeproduction', '3eabd582-76ad-4123-b9f9-a77c72c9a9f4', '2017-05-15 23:49:24', 'Cool!');

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
('026775cd-162a-419b-a1c9-e2c83b5592c7', 'skrillex01.jpg', '/images/logo/'),
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
('448f814c-11a4-4f2c-a8d9-da33e053a12e', 'Long Drive.mp3', '\\data\\music\\', '026775cd-162a-419b-a1c9-e2c83b5592c7', 'Pop', '2017-05-16 03:21:41'),
('513dd1a9-2448-440c-b1bf-c1c2f8242862', '05. In Our Bones.mp3', '\\data\\music\\', '8528576e-b9cc-495e-a4c3-5172ddfa42f7', 'Rock', '2017-05-13 22:14:07'),
('5506c47c-e13f-4eae-aea4-c604d106f282', '03. Chasing Ghosts.mp3', '\\data\\music\\', '8528576e-b9cc-495e-a4c3-5172ddfa42f7', 'Rock', '2017-05-13 22:14:03'),
('6f8a1840-7b73-426e-953f-191c0b791e6c', 'Right now.mp3', '\\data\\music\\', '51ba78a7-95f8-4569-8e5e-7c69e4c12b4d', 'Rock', '2017-05-16 03:03:56'),
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
  `skype` longtext,
  `twitter` longtext,
  `instagram` longtext,
  `facebook` longtext,
  `website` longtext,
  `origin` text,
  `yearsActive` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Id`, `firstName`, `lastName`, `userName`, `email`, `activation`, `statusActivation`, `typeAccount`, `genreMusic`, `bandName`, `about`, `time`, `skype`, `twitter`, `instagram`, `facebook`, `website`, `origin`, `yearsActive`) VALUES
('026775cd-162a-419b-a1c9-e2c83b5592c7', '', '', 'skrillex', 'lezumumapi@doanart.com', '320d842e92cf25499783b9ffde04d289', 1, 'band', 'Rock', 'Skrillex', '                                                      Sonny John Moore (born January 15, 1988), known professionally as Skrillex, is an American electronic dance music producer, DJ, singer, songwriter and multi-instrumentalist. Growing up in Northeast Los Angeles and in Northern California, Sonny Moore joined the American post-hardcore band From First to Last as the lead singer in 2004, and recorded two studio albums with the band (Dear Diary, My Teen Angst Has a Body Count, 2004, and Heroine, 2006) before leaving to pursue a solo career in 2007. He began his first tour as a solo artist in late 2007. After recruiting a new band lineup, Moore joined the Alternative Press Tour to support bands such as All Time Low and The Rocket Summer, and appeared on the cover of Alternative Press\' annual \"100 Bands You Need to Know\" issue.\r\n\r\nAfter releasing the Gypsyhook EP in 2009, Moore was scheduled to record his debut studio album, Bells, with producer Noah Shain. However, he ceased production of the album and began performing under the name Skrillex, distributing the My Name Is Skrillex EP for free download on his official MySpace page. Subsequently, he released the Scary Monsters and Nice Sprites EP in late–2010 and More Monsters and Sprites EP in mid–2011, both of which have since become moderate commercial successes. On November 30, 2011, he was nominated for a total of five Grammy Awards at the 54th Grammy Awards, including Best New Artist and won three: \"Best Dance/Electronica Album\", \"Best Dance Recording\", and \"Best Remixed Recording, Non-Classical\".[5] On December 5, 2011, the BBC announced that he had been nominated for their Sound of 2012 poll.[6] On December 12, 2011, he was also named MTV\'s Electronic Dance Music Artist of the Year.[7] Skrillex has won a total of eight Grammy Awards and holds the world record for most Grammys won by an Electronic Dance Music artist.[8] Skrillex has collaborated with Diplo and Boys Noize to form the groups of Jack Ü and Dog Blood respectively. It was announced on Moore\'s 29th birthday, he reunited with From First To Last and released a single named \"Make War\". In 2017, Skrillex produced and mixed 8, the eighth studio album by rock band Incubus.                                                                                                                                              ', '2017-05-16 04:05:47', '', 'skrillex', 'skrillex', 'skrillex', 'www.skrillex.com', 'Highland Park, Los Angeles, California, U.S.', '2012– present'),
('1d6789f7-38f0-49e4-a96c-eabe58c037a8', '', '', 'shadeproduction', 'skyskyshinysky@gmail.com', '799ec61ea2ad0b6c2d4ea84eb8dc3c50', 1, 'band', 'Rock', 'Enter Shikari', '                                                Enter Shikari are a British rock band formed in St Albans, Hertfordshire, England in 1999 under the name Hybryd by bassist Chris Batten, lead vocalist and keyboardist Roughton \"Rou\" Reynolds, and drummer Rob Rolfe. In 2003, guitarist Liam \"Rory\" Clewlow joined the band to complete its current lineup, and it adopted its current name. In 2006, they performed to a growing fanbase at Download Festival as well as a sold-out concert at the London Astoria. Their debut studio album, Take to the Skies, was released in 2007 and reached number 4 in the Official UK Album Chart, and has since been certified gold in the UK. Their second, Common Dreads, was released in 2009 and debuted on the UK Albums Chart at number 16;[2] while their third, A Flash Flood of Colour, was released in 2012 and debuted on the chart at number 4. Both have since been certified silver in the UK. The band spent a considerable amount of time supporting the latter release through the A Flash Flood of Colour World Tour, before beginning work on a fourth studio album, The Mindsweep, which was released in 2015.\r\n\r\nEnter Shikari have their own record label, Ambush Reality. However, they have also signed distribution deals with several major labels to help with worldwide distribution. Their eclectic musical style combines influences from rock, especially punk rock and hardcore punk, with those from various electronic music genres.                                    ', '2017-05-13 23:01:05', 'shinysky__', 'entershikari', 'entershikariofficial', 'entershikari', 'www.entershikari.com', 'St Albans, Hertfordshire, England, United Kingdom ', ' 1999–present'),
('3eabd582-76ad-4123-b9f9-a77c72c9a9f4', '', '', 'nickelback', 'fiyuzu@doanart.com', '0c06f7152124cf68dba92c4804d4ccd2', 1, 'band', 'Rock', 'Nickelback', '                            Nickelback is a Canadian rock band formed in 1995 in Hanna, Alberta, Canada. The band is composed of guitarist and lead vocalist Chad Kroeger, guitarist, keyboardist and backing vocalist Ryan Peake, bassist Mike Kroeger, and drummer Daniel Adair. The band went through a few drummer changes between 1995 and 2005, achieving its current form when Adair replaced drummer Ryan Vikedal.\r\n\r\nNickelback is one of the most commercially successful Canadian groups, having sold more than 50 million albums worldwide[1] and ranking as the eleventh best-selling music act, and the second best-selling foreign act in the U.S. of the 2000s, behind The Beatles.[2][3] Billboard ranks them the most successful rock group of the decade; their song \"How You Remind Me\" was listed as the best-selling rock song of the decade and the fourth best-selling of the decade. They were listed number seven on the Billboard top artist of the decade, with four albums listed on the Billboard top albums of the decade.[4]\r\n\r\nThe band signed with Roadrunner Records in 1999 and re-released their once-independent album The State.[5] The band achieved commercial success with the release of their 2000 album The State and then they achieved mainstream success with the release of their 2001 album Silver Side Up.[6] Following the release of Silver Side Up the band released their biggest and most known hit today, \"How You Remind Me\" which peaked number 1 on the American and Canadian charts at the same time.[7] Then, the band\'s fourth album The Long Road (2003) spawned 5 singles and continued the band\'s mainstream success with their hit single \"Someday\" which peaked at number 7 on the Billboard Hot 100 and number 1 at the Canadian Singles Chart.[8] Afterwards, the band put out their biggest album to date, All The Right Reasons (2005) which produced 3 top 10 singles and 5 top 20 singles, on the Billboard Hot 100 example of songs like \"Photograph\", \"Far Away\", and \"Rockstar\".[7] The band\'s album Dark Horse (2008) was a success which produced eight singles, one of which peaked on the top 10 on the Billboard Hot 100 and two of which peaked on the top 20 on the Billboard Hot 100. In 2011, the band released their seventh album Here and Now which again topped the charts.[9] Their eighth studio album No Fixed Address was released on 17 November 2014,[10] and their ninth studio album, Feed the Machine, is scheduled for release on June 16, 2017.', '2017-05-14 01:45:03', '', 'nickelback', 'nickelback', 'Nickelback', 'www.nickelback.com', '	Hanna, Alberta, Canada', '1995–present'),
('51ba78a7-95f8-4569-8e5e-7c69e4c12b4d', '', '', 'notadvised', 'pivupabi@doanart.com', '6ff33bfa0aeaa752767c0d07ce1c287d', 1, 'band', 'Rock', 'Natives', '                         Natives is a pop rock band from The New Forest, United Kingdom. The four-piece band consists of Andy White (drums and percussion), Greg Day (bass), Jack Fairbrother (guitar, keyboards), and Jim Thomas (vocals). All members also play various percussion.   \r\nThe band was initially formed by Jack Fairbrother, Andy White, and Greg Day when they started jamming together at school. Jim Thomas and Ash Oliver, both originally from different bands, soon joined their group. Prior to becoming Natives, the members played together under the name Not Advised. Feeling like they needed a fresh start from their Not Advised days, they soon renamed themselves Natives. This was shortly after flying to Los Angeles to begin recording their debut full-length album with platinum-selling producer John Feldmann.', '2017-05-14 01:55:05', '', '', '', '', 'www.follownatives.com', 'The New Forest, UK', '2012– present'),
('7d2a5c51-9709-45df-8eec-c92f5e70a23b', 'Ilya', 'Pankov', 'ilyapankov', 'skyskyshinysky@yandex.ru', 'b94acaecfd0748df89e4938ba84650d3', 1, 'user', NULL, NULL, NULL, '2017-05-13 22:52:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('8528576e-b9cc-495e-a4c3-5172ddfa42f7', '', '', 'againtsthecurrent', '1362856@mail.ru', '994ed2c044f71ccc95e5b06ff3a965ec', 1, 'band', 'Rock', 'Againts the Current', '                            Against the Current (often abbreviated as ATC) is an American pop rock band based in Poughkeepsie, New York and formed in 2011. The band currently consists of lead vocalist Chrissy Costanza, guitarist Dan Gow, and drummer Will Ferri. The group gained a sizable YouTube following after posting their covers of popular songs from a variety of different artists.\r\n\r\nThe band\'s first EP, Infinity, was released on May 2014 under their own label. The band followed Infinity up with their next EP, Gravity, which was released on February 17, 2015. Shortly afterward, they signed to the record label Fueled by Ramen. Their debut full-length album, In Our Bones was released on May 20, 2016.', '2017-05-13 23:09:15', '', 'atc_band', 'againstthecurrentny', 'againstthecurrentband', 'www.atcofficial.com', '	Poughkeepsie, New York, United States', '2011–present');

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
('026775cd-162a-419b-a1c9-e2c83b5592c7', 'ea1b20f09d53fe011c0369e47a8f1514', '779196a37d9fedbc77dbf6ce8da95828'),
('1d6789f7-38f0-49e4-a96c-eabe58c037a8', 'ea1b20f09d53fe011c0369e47a8f1514', '779196a37d9fedbc77dbf6ce8da95828'),
('3eabd582-76ad-4123-b9f9-a77c72c9a9f4', 'ea1b20f09d53fe011c0369e47a8f1514', '779196a37d9fedbc77dbf6ce8da95828'),
('51ba78a7-95f8-4569-8e5e-7c69e4c12b4d', 'ea1b20f09d53fe011c0369e47a8f1514', '779196a37d9fedbc77dbf6ce8da95828'),
('7d2a5c51-9709-45df-8eec-c92f5e70a23b', 'ea1b20f09d53fe011c0369e47a8f1514', '779196a37d9fedbc77dbf6ce8da95828'),
('8528576e-b9cc-495e-a4c3-5172ddfa42f7', 'ea1b20f09d53fe011c0369e47a8f1514', '779196a37d9fedbc77dbf6ce8da95828');

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
