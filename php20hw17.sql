-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 27 2018 г., 22:55
-- Версия сервера: 10.1.30-MariaDB
-- Версия PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `php20hw14`
--

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assigned_user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `is_done` tinyint(4) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `user_id`, `assigned_user_id`, `description`, `is_done`, `date_added`) VALUES
(2, 3, 1, 'Ð¢ÐµÑÑ‚Ð¾Ð²Ñ‹Ð¹ Ð·Ð°Ð¿Ñ€Ð¾Ñ 1', 0, '0000-00-00 00:00:00'),
(4, 3, 3, 'Ð—Ð°Ð´Ð°Ñ‡Ð°', 0, '2018-03-09 22:47:08'),
(5, 3, 3, 'Ð—Ð°Ð´Ð°Ñ‡Ð°1', 1, '2018-03-09 22:47:15'),
(6, 3, 3, 'Ð—Ð°Ð´Ð°Ñ‡Ð°2', 0, '2018-03-09 22:47:23'),
(10, 1, 3, 'Ð¢ÐµÑÑ‚Ð¾Ð²Ñ‹Ð¹ Ð·Ð°Ð¿Ñ€Ð¾Ñ 2', 0, '2018-03-27 20:05:58'),
(12, 1, 3, 'Ð¢ÐµÑÑ‚Ð¾Ð²Ñ‹Ð¹ Ð·Ð°Ð¿Ñ€Ð¾Ñ 1', 0, '2018-03-27 22:23:33'),
(14, 1, 4, 'Ð¢ÐµÑÑ‚Ð¾Ð²Ñ‹Ð¹ Ð·Ð°Ð¿Ñ€Ð¾Ñ 5', 0, '2018-03-27 23:22:03');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(1, 'user', 'c83a73ed415ed9f1a6a23e2a1ab33b378cc6b6d9a12ed618ff07321cb6c6116e'),
(3, 'user1', 'c207ab5a4484887da1a614c241670069c28610db67adead0405266ffcc0cf884'),
(4, 'user2', '920d0dee6de7accac8df4bf7303e57bee2d7ad31f79b2a1fb9c1e77e066d7be4');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_user_id` (`assigned_user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`assigned_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
