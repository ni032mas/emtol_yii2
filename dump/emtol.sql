-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 25 2016 г., 05:31
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
CREATE DATABASE IF NOT EXISTS `emtol` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `emtol`;

-- --------------------------------------------------------

--
-- Структура таблицы `consumers`
--

DROP TABLE IF EXISTS `consumers`;
CREATE TABLE `consumers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `consumers`
--

TRUNCATE TABLE `consumers`;
--
-- Дамп данных таблицы `consumers`
--

INSERT INTO `consumers` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `customers`
--

TRUNCATE TABLE `customers`;
--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 2, 'Главный контрагент', 1, 1),
(2, 3, 'Тестовый контрагент ni032mas', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `obj_reservation_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `images`
--

TRUNCATE TABLE `images`;
-- --------------------------------------------------------

--
-- Структура таблицы `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `locations`
--

TRUNCATE TABLE `locations`;
--
-- Дамп данных таблицы `locations`
--

INSERT INTO `locations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Сочи', 0, 0),
(2, 'Адлер', 1, 1),
(3, 'Красная поляна', 1, 1),
(4, 'Азов', 11, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `migration`
--

TRUNCATE TABLE `migration`;
--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1452955689),
('m130524_201442_init', 1452955696),
('m160117_183649_new_table', 1453061058),
('m160117_200323_table_update', 1453061058),
('m160122_200948_fffffddddd', 1453493500);

-- --------------------------------------------------------

--
-- Структура таблицы `objreservation`
--

DROP TABLE IF EXISTS `objreservation`;
CREATE TABLE `objreservation` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `coordinate` varchar(255) DEFAULT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
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

INSERT INTO `objreservation` (`id`, `name`, `description`, `keywords`, `coordinate`, `location_id`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 'Экскурсия на Ахун', 'Очень хорошая экскурсия. Просто супер. Вы увидите Ахун.', 'Ахун', '43.60004682587051,39.88499589889136', 1, 1, 1, 1453617213),
(2, 'Экскурсия в Красную поляну', 'Вы увидите высокие горы', '0456', '43.68341270971855,40.259817306118975', 1, 1, 22, 1453652001),
(3, 'Экскурсия в Азов', 'цукцукц', '', NULL, 4, 1, 1453398873, 1453398873),
(4, 'Экскурсия в Лазаревку', 'ЖДЛЫЖдлфыжвлф', '', NULL, 3, 1, 1453399390, 1453399390),
(5, 'sds', 'asdasd', '', NULL, 3, 1, 1453564793, 1453568071),
(6, 'Афонский монастырь', 'Поездка в Абхазию, посещение Афонского монастыря.', '', NULL, 2, 1, 1453568427, 1453568498);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `objreservation_id` int(10) UNSIGNED NOT NULL,
  `consumer_id` int(10) UNSIGNED NOT NULL,
  `reserved_amount` int(10) UNSIGNED NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `comment` text,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `orders`
--

TRUNCATE TABLE `orders`;
--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `objreservation_id`, `consumer_id`, `reserved_amount`, `is_paid`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 0, 'Примите наш заказ, он оплачен', 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `reservationinfo`
--

DROP TABLE IF EXISTS `reservationinfo`;
CREATE TABLE `reservationinfo` (
  `id` int(10) UNSIGNED NOT NULL,
  `objreservation_id` int(10) UNSIGNED NOT NULL,
  `date_begin` int(10) UNSIGNED NOT NULL,
  `date_end` int(10) UNSIGNED NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `reservationinfo`
--

TRUNCATE TABLE `reservationinfo`;
-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `user`
--

TRUNCATE TABLE `user`;
--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'n7cespQyGWhaiEKvXM5Z_9MwnN2JLFb9', '$2y$13$ZuZiyrUfgLfTd5pZrwp2O.0Cowif.BmrN0hBI8Tlmj1i/VHUJ8KLm', NULL, 'ni032mas@mail.ru', 10, 1453049060, 1453049060),
(3, 'ni032mas', 'wfLNmyMfE-NGWIXH6awpATwXGZj_oqie', '$2y$13$tkVSCeU3j1vC5XkHi5szD.hE8zecnWLufm6ErLtC4pGLUqqAalnyC', NULL, 'marmyshevas@gmail.com', 10, 1453193216, 1453193216),
(4, 'yandex', 'pyrTEu8yDpt18iuhTCq-fAV7XQ-cv0jP', '$2y$13$98uIdCi6gqEhMZW5nZLhAuGe0pYNjpkCAs9v8XseyXuie16JH8XiK', NULL, 'ni032mas@yandex.ru', 10, 1453193489, 1453193489);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `consumers`
--
ALTER TABLE `consumers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obj_reservation_id` (`obj_reservation_id`);

--
-- Индексы таблицы `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

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
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `obj_reservation_id` (`objreservation_id`),
  ADD KEY `consumer_id` (`consumer_id`);

--
-- Индексы таблицы `reservationinfo`
--
ALTER TABLE `reservationinfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `obj_reservation_id` (`objreservation_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `consumers`
--
ALTER TABLE `consumers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `objreservation`
--
ALTER TABLE `objreservation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `reservationinfo`
--
ALTER TABLE `reservationinfo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `consumers`
--
ALTER TABLE `consumers`
  ADD CONSTRAINT `consumers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`obj_reservation_id`) REFERENCES `objreservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `objreservation`
--
ALTER TABLE `objreservation`
  ADD CONSTRAINT `objreservation_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `objreservation_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`objreservation_id`) REFERENCES `objreservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`consumer_id`) REFERENCES `consumers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reservationinfo`
--
ALTER TABLE `reservationinfo`
  ADD CONSTRAINT `reservationinfo_ibfk_1` FOREIGN KEY (`objreservation_id`) REFERENCES `objreservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
