-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 18 2016 г., 20:48
-- Версия сервера: 5.6.26
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `sitesoft`
--

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `message__user_id_fk` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `user_id`, `message`, `created_at`) VALUES
(5, 1, 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq', 1452757982),
(12, 1, ' sfgs fg df fg dfsg dfgsfdgdfdfg df fdg df fg srg fg sd gdfsg dfg d', 1452758114),
(28, 1, 'aaaa', 1452853177),
(29, 1, 'fffff', 1452853192),
(30, 1, 'ddddd', 1452853206),
(31, 1, 'mmm', 1452859391),
(32, 1, 'nnnn', 1452859403),
(33, 1, 'fdfdfd', 1452859458),
(34, 1, 'jjj', 1452859525),
(35, 1, 'jjj', 1452859525),
(36, 1, 'ddd', 1452859584),
(37, 1, 'hhhh', 1452859709),
(38, 1, 'jnjjn', 1452860668),
(39, 1, 'dddggg', 1452861008),
(40, 1, 'erw', 1452861019),
(41, 1, 'wrwer', 1452861021),
(42, 1, 'wrwrqw', 1452861023),
(43, 1, 'wrwrw', 1452861025),
(44, 1, 'wrewrqw', 1452861028),
(45, 1, 'wrwerewr', 1452861030),
(46, 1, 'wrwrqwr', 1452861033),
(47, 1, 'wrwrqw', 1452861035),
(48, 1, 'qwrwerqw', 1452861038),
(49, 1, 'qwerwrqw', 1452861040),
(50, 1, 'qewrerqwer', 1452861042),
(51, 1, 'erqwrqewr', 1452861045),
(52, 1, 'rqwewrqw', 1452861048),
(53, 1, 'wrqwrqw', 1452861058),
(54, 1, 'hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 1452861296);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1452691890),
('m160113_131711_user_table_creation', 1452691954),
('m160113_175436_message_table_creation', 1452708261);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(45) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `password_hash`, `auth_key`, `created_at`) VALUES
(1, 'useer1@test.com', 'User1', '$2y$13$e3KOBa36yWvR0DCbxT3P7OISqKq/BSiehDcIZlXCAAococZA3P0CO', 'aubZBdWNs8F26099mzjOcqPS0yAEaQTF', 1452701391);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message__user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
