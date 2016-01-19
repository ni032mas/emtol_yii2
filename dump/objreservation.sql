-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 19 2016 г., 15:26
-- Версия сервера: 10.1.9-MariaDB
-- Версия PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `emtol`
--

-- --------------------------------------------------------

--
-- Структура таблицы `objreservation`
--

CREATE TABLE `objreservation` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `alias` varchar(255) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `objreservation`
--

TRUNCATE TABLE `objreservation`;
--
-- Дамп данных таблицы `objreservation`
--

INSERT INTO `objreservation` (`id`, `name`, `description`, `location_id`, `customer_id`, `alias`, `created_at`, `updated_at`) VALUES
(1, 'Экскурсия на Ахун', 'Очень хорошая экскурсия. Просто супер. Вы увидите Ахун.', 1, 1, 'картинка', 1, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `objreservation`
--
ALTER TABLE `objreservation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `objreservation`
--
ALTER TABLE `objreservation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `objreservation`
--
ALTER TABLE `objreservation`
  ADD CONSTRAINT `objreservation_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `objreservation_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
