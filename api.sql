-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 04 2020 г., 14:55
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `api`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `cat_created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `description`, `cat_created`, `modified`) VALUES
(1, 'Fashion', 'Category for anything related to fashion.', '2014-06-01 00:35:07', '2014-05-30 10:34:33'),
(2, 'Electronics', 'Gadgets, drones and more.', '2014-06-01 00:35:07', '2014-05-30 10:34:33'),
(3, 'Motors', 'Motor sports and more', '2014-06-01 00:35:07', '2014-05-30 10:34:54'),
(5, 'Movies', 'Movie products.', '2019-05-20 10:22:05', '2019-08-20 03:30:15'),
(6, 'Books', 'Kindle books, audio books and more.', '2018-03-14 08:05:25', '2019-05-20 04:29:11'),
(13, 'Sports', 'Drop into new winter gear.', '2016-01-09 02:24:24', '2016-01-08 18:24:24');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `created`, `modified`) VALUES
(83, 'derf', '123ad asfe rsdg', '300', 2, '0000-00-00 00:00:00', '2020-05-27 14:21:13'),
(88, 'Some', 'asd21dsa', '2888', 3, '0000-00-00 00:00:00', '2020-05-28 04:57:25'),
(89, '2eadce', '2dassdw', '2390', 2, '0000-00-00 00:00:00', '2020-05-28 04:57:25'),
(91, '2eadce', '2dassdw', '2390', 2, '0000-00-00 00:00:00', '2020-05-28 04:57:28'),
(92, 'Some', 'asd21dsa', '2888', 3, '0000-00-00 00:00:00', '2020-05-28 04:57:32'),
(93, '2eadce', '2dassdw', '2390', 2, '0000-00-00 00:00:00', '2020-05-28 04:57:32'),
(94, 'main', 'something', '333', 1, '2020-05-28 08:40:24', '2020-05-28 06:40:24'),
(95, 'The Witcher', 'auf', '200', 6, '2020-05-28 08:41:06', '2020-05-28 06:41:06'),
(96, 'Financier', 'Remark', '1900', 6, '2020-05-28 08:52:29', '2020-05-28 06:52:29'),
(97, 'iPhone', 'XX', '1', 2, '2020-05-28 08:54:25', '2020-05-28 06:54:25'),
(98, 'dsada', 'dasd', '200', 6, '2020-05-28 08:55:23', '2020-05-28 06:55:23');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_phone`, `email`, `password`) VALUES
(1, '', 0, '', '$2y$10$OBHQkCYSSU.u2l0klcLw4OnPstopsbMNtnNwQ/iYEeoajHUcw0IJO'),
(2, '', 0, '', '$2y$10$pD992BfbWNi3.JD5NtvMhOwXpLcQkOlU1uqzqWE3g4EGW.LnHBwna'),
(3, 'Leonid', 2147483647, 'lolkekcheburek', '$2y$10$YMCErspXsgcKHNSwXRkUju8qvCjKUcYYT3huIS/41hUzamznmKwF2');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
