-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 27 2021 г., 09:24
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `website`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `Id` int NOT NULL,
  `Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`Id`, `Name`) VALUES
(1, 'Москва'),
(2, 'Томск'),
(3, 'Новосибирск'),
(5, 'Краснодар');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `Id` int NOT NULL,
  `Text` varchar(1200) NOT NULL,
  `Date` datetime NOT NULL,
  `UserId` int NOT NULL,
  `CreatorId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`Id`, `Text`, `Date`, `UserId`, `CreatorId`) VALUES
(2, 'Привет, друг', '2021-05-13 11:56:36', 1, 15),
(3, 'message 1', '2021-05-13 19:33:09', 1, 27),
(5, 'message 123', '2021-05-13 19:33:14', 1, 27),
(6, 'message 1234', '2021-05-13 19:33:18', 1, 27),
(8, 'Я тоби забаню', '2021-05-13 21:55:39', 29, 1),
(9, 'Я тоби забаню nnnnn', '2021-05-13 23:27:52', 29, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `Id` int NOT NULL,
  `CreatorId` int NOT NULL,
  `Link` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`Id`, `CreatorId`, `Link`) VALUES
(7, 1, '/Uploads/Photos/1620917063мем2.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `UserId` int NOT NULL,
  `Id` int NOT NULL,
  `Text` varchar(2500) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`UserId`, `Id`, `Text`, `Date`) VALUES
(1, 2, 'Мой второй текст, но уже измененный', '2021-05-13 10:55:38'),
(2, 4, 'Hello, world!', '2021-05-13 11:25:35'),
(29, 5, 'Ну, привет', '2021-05-13 21:41:15');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `Id` int NOT NULL,
  `Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`Id`, `Name`) VALUES
(1, 'user'),
(2, 'moderator'),
(3, 'admin'),
(5, 'teacher');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `Id` int NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Surname` varchar(250) NOT NULL,
  `UserName` varchar(250) NOT NULL,
  `Birthday` date DEFAULT NULL,
  `Avatar` varchar(555) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Status` int DEFAULT NULL,
  `CityId` int DEFAULT NULL,
  `RoleId` int DEFAULT NULL,
  `Password` varchar(555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Id`, `Name`, `Surname`, `UserName`, `Birthday`, `Avatar`, `Status`, `CityId`, `RoleId`, `Password`) VALUES
(1, 'Viktor', 'Just', 'iJustWant', '2001-03-04', '/Uploads/Avatars/1620838645qFR8kEDhq2E.jpg', NULL, 1, 3, '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'No', 'Name', 'NoName', '2001-03-04', '/Uploads/Avatars/test.jpg', NULL, 2, 2, '81dc9bdb52d04dc20036dbd8313ed055'),
(15, 'Xexe', 'Name', 'NoNameNoExitEr', '2001-03-04', '/Uploads/Avatars/test.jpg', 1, 1, 2, '81dc9bdb52d04dc20036dbd8313ed055'),
(16, 'ERROR', 'Just', 'NoNameNoExi', '2001-03-04', NULL, NULL, 1, 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(17, 'ERROR', 'Just', 'NoNameNoExiasad', '2001-03-04', NULL, NULL, 2, 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(18, 'ERROR', 'Just', 'NoNameNoExiasadasdfa', '2001-03-04', NULL, NULL, 2, 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(20, 'ERROR', 'Just', 'iJustWantTest', '2001-03-04', NULL, NULL, NULL, 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(21, 'ERROR', 'Just', 'iJustWantTestst', '2001-03-04', NULL, NULL, NULL, 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(22, 'ERROR', 'Just', 'iJustWantTestst123', '2001-03-04', NULL, NULL, NULL, 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(23, 'ERROR', 'Just', 'iJustWantTestst1234', '2001-03-04', NULL, NULL, NULL, 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(24, 'ERROR', 'Just', 'iJustWantTestst1234123', '2001-03-04', NULL, NULL, NULL, 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(25, 'ERROR', 'Just', 'TestTest', '2001-03-04', '/Uploads/Avatars/1620834536iBiuEImzcDU.jpg', NULL, NULL, 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(26, 'TestSuccess', 'Testovich', 'iJustWant1234', NULL, '/Uploads/Avatars/test.jpg', NULL, NULL, 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(28, 'RealNameTest', 'RealPeople', 'iJustWantTestNow', '1999-01-01', '/Uploads/Avatars/1620916330oboik.ru_38862.jpg', 1, 1, 2, 'd41d8cd98f00b204e9800998ecf8427e'),
(29, 'Real', 'People', 'iJustWantTestNowT', '1999-01-01', NULL, NULL, NULL, 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(30, 'Real', 'People', 'iJustWant1233456', '1999-01-01', NULL, NULL, NULL, 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(31, 'Смешарик', 'People', 'iJustWantToSetAvatar', '1999-01-01', '/Uploads/Avatars/1620925629Azu3FKvDPlo.jpg', NULL, NULL, 1, '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
