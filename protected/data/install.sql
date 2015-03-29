-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 29 2015 г., 16:08
-- Версия сервера: 5.6.21
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `yboard`
--

-- --------------------------------------------------------

--
-- Структура таблицы `adverts`
--

CREATE TABLE IF NOT EXISTS `adverts` (
`id` int(11) NOT NULL,
  `name` varchar(121) DEFAULT NULL,
  `user_id` int(1) DEFAULT NULL,
  `category_id` int(2) DEFAULT NULL,
  `type` int(1) DEFAULT '1',
  `views` int(1) DEFAULT '0',
  `text` varchar(1822) DEFAULT NULL,
  `fields` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `currency` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `gallery_id` int(3) DEFAULT '0',
  `youtube_id` varchar(50) DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=414 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE IF NOT EXISTS `article` (
`id` int(11) unsigned NOT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `level` smallint(3) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `type` smallint(1) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `layout` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `subsection` varchar(255) DEFAULT NULL,
  `overview_page` tinyint(1) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `access_level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `name` varchar(37) DEFAULT NULL,
  `icon` varchar(10) DEFAULT NULL,
  `fields` varchar(1000) NOT NULL,
  `root` int(2) DEFAULT NULL,
  `lft` int(2) DEFAULT NULL,
  `rgt` int(2) DEFAULT NULL,
  `level` int(1) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `company`
--

CREATE TABLE IF NOT EXISTS `company` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `name` varchar(400) NOT NULL,
  `address` varchar(400) NOT NULL,
  `description` varchar(400) NOT NULL,
  `gallery_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `key` varchar(100) NOT NULL,
  `value` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `obj_id` int(11) NOT NULL DEFAULT '0',
  `obj_type` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
`id` int(11) NOT NULL,
  `versions_data` varchar(125) DEFAULT NULL,
  `name` int(1) DEFAULT NULL,
  `description` int(1) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=752 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_photo`
--

CREATE TABLE IF NOT EXISTS `gallery_photo` (
`id` int(11) NOT NULL,
  `gallery_id` int(3) DEFAULT NULL,
  `rank` int(3) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  `description` varchar(10) DEFAULT NULL,
  `file_name` varchar(7) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=347 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `send_date` datetime NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `user_id` int(1) NOT NULL DEFAULT '0',
  `first_name` varchar(13) DEFAULT NULL,
  `last_name` varchar(5) DEFAULT NULL,
  `city` varchar(10) DEFAULT NULL,
  `url` varchar(10) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `icq` varchar(10) DEFAULT NULL,
  `company` varchar(10) DEFAULT NULL,
  `about` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
`id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `review` text NOT NULL,
  `vote` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(21) DEFAULT NULL,
  `birthday` date NOT NULL,
  `location` varchar(200) NOT NULL,
  `skype` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `contacts` text NOT NULL,
  `activkey` varchar(32) DEFAULT NULL,
  `superuser` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_at` varchar(19) DEFAULT NULL,
  `lastvisit_at` varchar(19) DEFAULT NULL,
  `identity` varchar(100) NOT NULL,
  `network` varchar(100) NOT NULL,
  `full_name` varchar(150) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `adverts`
--
ALTER TABLE `adverts`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `article`
--
ALTER TABLE `article`
 ADD PRIMARY KEY (`id`), ADD KEY `lft` (`lft`), ADD KEY `rgt` (`rgt`), ADD KEY `level` (`level`), ADD KEY `name` (`name`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `company`
--
ALTER TABLE `company`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `config`
--
ALTER TABLE `config`
 ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `favorites`
--
ALTER TABLE `favorites`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery_photo`
--
ALTER TABLE `gallery_photo`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `profiles`
--
ALTER TABLE `profiles`
 ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `adverts`
--
ALTER TABLE `adverts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=414;
--
-- AUTO_INCREMENT для таблицы `article`
--
ALTER TABLE `article`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT для таблицы `company`
--
ALTER TABLE `company`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `favorites`
--
ALTER TABLE `favorites`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=752;
--
-- AUTO_INCREMENT для таблицы `gallery_photo`
--
ALTER TABLE `gallery_photo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=347;
--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
