-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Авг 06 2024 г., 16:32
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hh`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`) VALUES
(2, '2', '2@mail.ru', '2'),
(66, 'Ivan ivanov', 'test@mail.ru', '3'),
(67, 'Ivan ivanov', 'test2@mail.ru', '4'),
(68, 'Ivan ivanov', 'test3@mail.ru', '5'),
(69, 'Ivan ivanov', 'test4@mail.ru', '6'),
(72, 'Ivan ivanov', 'test5@mail.ru', 'test'),
(74, 'Ivan ivanov', 'test6@mail.ru', 'test'),
(75, 'df', 'a2', 'SDF'),
(76, 'SFG', 'SFG', 'SFGSFG'),
(78, 'Ivan ivanov', 'test7@mail.ru', 'test'),
(81, 'Ivan ivanov', 'test8@mail.ru', '$2y$10$0ZRAmJLcrELinVFQGq'),
(82, 'Ivan ivanov', 'test9@mail.ru', '$2y$10$osQDt4UUqZIpJB8d88'),
(85, 'Ivan ivanov', 'test10@mail.ru', 'test');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
