-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 10 2014 г., 10:16
-- Версия сервера: 5.0.51b-community-nt-log
-- Версия PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Структура таблицы `advertisement`
--

CREATE TABLE IF NOT EXISTS `advertisement` (
  `id` int(11) NOT NULL auto_increment,
  `banner` varchar(17) default NULL,
  `url` varchar(31) default NULL,
  `name` varchar(43) default NULL,
  `description` varchar(10) default NULL,
  `order` int(1) default NULL,
  `gallery_id` varchar(10) default NULL,
  `extra` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `advertisement`
--

INSERT INTO `advertisement` (`id`, `banner`, `url`, `name`, `description`, `order`, `gallery_id`, `extra`) VALUES
(1, 'fishleft2.jpg', 'http://www.zverinaia-dacha.ru/', 'Звериная дача', '', 1, '', ''),
(2, 'EARAZA.jpg', 'http://earaza.ru/', 'EARAZA', '', 2, '', ''),
(3, '13.jpg', '', 'Место для вашей рекламы', '', 3, '', ''),
(4, 'fish1.jpg', '', 'Место для вашей рекламы', '', 4, '', ''),
(5, 'animal.gif', 'http://animalsimport.ru/', 'animalsimport', '', 5, '', ''),
(6, 'banner120x700.gif', 'http://www.superiorcats.com/ru/', 'superiorcats', '', 6, '', ''),
(7, 'fish1_2.jpg', '', 'Место для вашей рекламы', '', 7, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(10) NOT NULL auto_increment,
  `parent_id` varchar(10) default NULL,
  `user_id` varchar(10) default NULL,
  `text` varchar(10) default NULL,
  `created_at` varchar(10) default NULL,
  `updated_at` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `bulletin`
--

CREATE TABLE IF NOT EXISTS `bulletin` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(121) default NULL,
  `user_id` int(1) default NULL,
  `category_id` int(2) default NULL,
  `type` int(1) default NULL,
  `views` int(1) default NULL,
  `text` varchar(1822) default NULL,
  `fields` varchar(1000) NOT NULL,
  `created_at` int(10) default NULL,
  `updated_at` varchar(10) default NULL,
  `gallery_id` int(3) default NULL,
  `youtube_id` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=402 ;

--
-- Дамп данных таблицы `bulletin`
--

INSERT INTO `bulletin` (`id`, `name`, `user_id`, `category_id`, `type`, `views`, `text`, `fields`, `created_at`, `updated_at`, `gallery_id`, `youtube_id`) VALUES
(391, 'Охранник', 2, 8, 0, 0, 'Ищу работу охранником с понедельной оплатой труда.', '', 1374696517, '', 723, ''),
(392, 'Охранник, оператор, аппаратчик, машинист', 2, 8, 0, 0, 'Ищу работу Охранника, оператора технологических установок в нефтехимической отрасли,оператора котельных,аппаратчика химпроизводства и воздухоразделения(АКС),машиниста насосных-компрессорных станций.Стаж 10 лет', '', 1374696577, '', 724, ''),
(393, 'Поиск фрилансеров', 2, 7, 1, 0, 'Молодая, перспективная биржа удаленной работы ищет талантливых и креативных фрилансеров в сфере наружной рекламы, \r\n BTL-маркетинга, печатной рекламы, радио рекламы. Вас ждет много интересной и творческой работы. Высокая заработная плата. Звоните, возможно, мы ищем именно вас.', '', 1374696742, '', 725, ''),
(394, 'Требуется менеджер по продажам', 2, 7, 1, 0, 'Компании, занимающейся производством и монтажом металлоизделий (ворота, решетки, двери, заборы, навесы и т.д.) в городе Ростове-на-Дону, требуется менеджер по продажам.\r\n\r\nОбязанности.\r\n\r\nВыезд на заказ,\r\n\r\n— выявление потребности клиента,\r\n\r\n— продажа того что клиенту необходимо,\r\n\r\n— заключение договора,\r\n\r\n— замер всех параметров металлоизделия,\r\n\r\n— заключение договора,\r\n\r\n— общение с клиентом, пока изделие находится в производстве\r\n\r\nТребование.\r\n\r\n1 Техническое мышление и образование желательно.\r\n\r\n2 Наличие автомобиля обязательно.\r\n\r\n3 Опыт работы замерщиком/менеджером в аналогичной компании\r\n\r\n4 Понимание производственных процессов разработки металлоизделий и материалов используемых при изготовлении.\r\n\r\n5. Умение рисовать и разрабатывать дизайн изделий является серьезным преимуществом.\r\n\r\n6. Обязательно опыт замеров дверей, перил, решеток, навесов, ворот, заборов.\r\n\r\nУсловия:\r\n\r\nЗ/п от 30000 р.\r\n\r\n5 дневная рабочая неделя (иногда есть необходимость в замерах в субботу) Обучение.\r\n\r\nОформление по ТК РФ.', '', 1374696798, '', 726, ''),
(395, 'Сниму 1-к квартиру', 2, 10, 0, 0, 'Молодая русская семья,в которой ожидается пополнение,снимет на длительный срок однокомнатную квартиру в районе метро Выхино.Гарантируем чистоту,порядок и своевременную квартплату.', '', 1374696907, '', 727, ''),
(396, 'Британские плюшевые Серебристые котята мраморные и тебби (Вискас)', 2, 19, 1, 0, 'Московский питомник элитных кошек GREGORI al GATO 89258509506 предлагает к продаже Британских плюшевых котят Эксклюзивных окрасов: Серебристая шиншилла с изумрудными глазками! Серебристая шиншилла - пойнт с сапфировыми глазками! Серебрыстые мраморные и тебби (Вискас) Котята отличного породного типа, с большими яркими глазками. Выращены для Вас с любовью! Тел: 8(916)916-60-66, 8(925)850-95-06 http://gregorialgato.narod.ru/kotata.html', '', 1374696990, '', 728, ''),
(397, 'Волнистые попугаи(разного возраста)', 2, 20, 1, 1, 'Продаю волнистых попугаев своего разведения. Птенцам от 35 дней,так же есть птички разного возраста и окраса. Покупая птицу вы берете ответственность на всю жизнь,я вам гарантирую здоровую активную птицу способную к приручению и обучению разговаривать. тел 89629093432', '', 1374697053, '', 729, ''),
(398, 'Iron eagle DD50', 2, 16, 1, 0, 'Продаю чепер, двигатель Suzuki 125cc , механика,максимальная скорость 130км/ч , очень жалко отдавать но срочно нужны деньги. не требует регистрации в ГИБДД !!! (Торг на месте)', '', 1374697144, '', 730, ''),
(399, 'аквариумные рыбки', 2, 21, 1, 2, 'Самый большой ассортимент аквариумных рыбок, беспозвоночных, амфибий (ширпотреб). Обновление прайса еженедельно. Прайс отправляю по запросу. Условия, вопросы, консультации - по телефону. Отправка из Харькова', '', 1374697596, '1374697598', 732, ''),
(400, 'xcvxcv', 1, 7, NULL, 1, 'xcvxcv', '', 1416183642, NULL, 733, NULL),
(401, 'xzczxczxc', 1, 7, NULL, 7, 'zxczxczxc', '', 1416183674, NULL, 734, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(37) default NULL,
  `icon` varchar(10) default NULL,
  `fields` varchar(1000) NOT NULL,
  `root` int(2) default NULL,
  `lft` int(2) default NULL,
  `rgt` int(2) default NULL,
  `level` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `icon`, `fields`, `root`, `lft`, `rgt`, `level`) VALUES
(1, 'Работа и бизнес fff', '', '{"price":{"name":"sdfsdf","type":"0"},"tra":{"name":"sdfsdf","type":"0"},"_empty_":{"name":"vxcvxcv","type":"0"}}', 88, 1, 8, 1),
(2, 'Недвижимость', '', '{"price":{"name":"sdfsdf","type":"0"},"tra":{"name":"sdfsdf","type":"0"},"_empty_":{"name":"vxcvxcv","type":"0"}}', 89, 1, 12, 1),
(3, 'Транспорт', '', '', 90, 1, 10, 1),
(4, 'Животные', '', '', 91, 1, 12, 1),
(5, 'Разное', '', '', 92, 1, 2, 1),
(6, 'Услуги', '', '', 93, 1, 2, 1),
(7, 'Вакансии', '', '{"price":{"name":"sdfsdf","type":"0"},"tra":{"name":"sdfsdf","type":"0"},"_empty_":{"name":"vxcvxcv","type":"0"}}', 88, 6, 7, 2),
(8, 'Ищут работу', '', '', 88, 4, 5, 2),
(9, 'Курсы, образование', '', '', 88, 2, 3, 2),
(10, 'Квартиры', '', '', 89, 2, 3, 2),
(11, 'Офисы', '', '', 89, 6, 7, 2),
(12, 'Земля и участки', '', '', 89, 8, 9, 2),
(13, 'Гаражи', '', '', 89, 10, 11, 2),
(14, 'Легковые авто', '', '', 90, 2, 3, 2),
(15, 'Грузовые автомобили', '', '', 90, 4, 5, 2),
(16, 'Мото транспорт', '', '', 90, 6, 7, 2),
(17, 'Велосипеды', '', '', 90, 8, 9, 2),
(18, 'Грызуны', '', '', 91, 2, 3, 2),
(19, 'Кошки', '', '', 91, 6, 7, 2),
(20, 'Птицы', '', '', 91, 4, 5, 2),
(21, 'Рыбы', '', '', 91, 8, 9, 2),
(22, 'Собаки', '', '', 91, 10, 11, 2),
(23, 'Фкфкфе', '', '', 89, 4, 5, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `key` varchar(6) NOT NULL default '',
  `value` varchar(34) default NULL,
  PRIMARY KEY  (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `config`
--

INSERT INTO `config` (`key`, `value`) VALUES
('top', 'a:2:{i:0;s:3:"391";i:1;s:3:"399";}'),
('answer', 'N;');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL auto_increment,
  `versions_data` varchar(125) default NULL,
  `name` int(1) default NULL,
  `description` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=735 ;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `versions_data`, `name`, `description`) VALUES
(723, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(724, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(725, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(726, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(727, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(728, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(729, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(730, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(731, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(732, 'a:2:{s:5:"small";a:1:{s:6:"resize";a:2:{i:0;i:150;i:1;N;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(733, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(734, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_photo`
--

CREATE TABLE IF NOT EXISTS `gallery_photo` (
  `id` int(11) NOT NULL auto_increment,
  `gallery_id` int(3) default NULL,
  `rank` int(3) default NULL,
  `name` varchar(10) default NULL,
  `description` varchar(10) default NULL,
  `file_name` varchar(7) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=338 ;

--
-- Дамп данных таблицы `gallery_photo`
--

INSERT INTO `gallery_photo` (`id`, `gallery_id`, `rank`, `name`, `description`, `file_name`) VALUES
(334, 732, 334, '', '', '871.jpg'),
(335, 732, 335, '', '', '872.jpg'),
(336, 732, 336, '', '', '873.jpg'),
(337, 732, 337, '', '', '874.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `user_id` int(1) NOT NULL default '0',
  `first_name` varchar(13) default NULL,
  `last_name` varchar(5) default NULL,
  `city` varchar(10) default NULL,
  `url` varchar(10) default NULL,
  `phone` varchar(10) default NULL,
  `icq` varchar(10) default NULL,
  `company` varchar(10) default NULL,
  `about` varchar(10) default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `profiles`
--

INSERT INTO `profiles` (`user_id`, `first_name`, `last_name`, `city`, `url`, `phone`, `icq`, `company`, `about`) VALUES
(1, 'Administrator', 'Admin', '', '', '', '', '', ''),
(2, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `profiles_fields`
--

CREATE TABLE IF NOT EXISTS `profiles_fields` (
  `id` int(11) NOT NULL auto_increment,
  `varname` varchar(10) default NULL,
  `title` varchar(26) default NULL,
  `field_type` varchar(7) default NULL,
  `field_size` int(4) default NULL,
  `field_size_min` int(1) default NULL,
  `required` int(1) default NULL,
  `match` varchar(10) default NULL,
  `range` varchar(10) default NULL,
  `error_message` varchar(58) default NULL,
  `other_validator` varchar(10) default NULL,
  `default` varchar(10) default NULL,
  `widget` varchar(10) default NULL,
  `widgetparams` varchar(10) default NULL,
  `position` int(1) default NULL,
  `visible` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `profiles_fields`
--

INSERT INTO `profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'first_name', 'First Name', 'VARCHAR', 255, 3, 2, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'last_name', 'Last Name', 'VARCHAR', 255, 3, 2, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 2, 3),
(3, 'city', 'Город', 'VARCHAR', 255, 0, 2, '', '', '', '', '', '', '', 3, 3),
(4, 'url', 'URL', 'VARCHAR', 255, 0, 2, '', '', '', '', '', '', '', 4, 3),
(5, 'phone', 'Телефон', 'VARCHAR', 255, 0, 2, '', '', '', '', '', '', '', 5, 3),
(6, 'icq', 'ICQ', 'VARCHAR', 255, 0, 2, '', '', '', '', '', '', '', 6, 3),
(7, 'company', 'Организация', 'VARCHAR', 255, 0, 2, '', '', '', '', '', '', '', 7, 3),
(8, 'about', 'Коротко о себе', 'VARCHAR', 1024, 0, 2, '', '', '', '', '', '', '', 8, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `sqlite_master`
--

CREATE TABLE IF NOT EXISTS `sqlite_master` (
  `type` varchar(5) default NULL,
  `name` varchar(32) default NULL,
  `tbl_name` varchar(15) default NULL,
  `rootpage` int(2) default NULL,
  `sql` varchar(572) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sqlite_master`
--

INSERT INTO `sqlite_master` (`type`, `name`, `tbl_name`, `rootpage`, `sql`) VALUES
('table', 'bulletin', 'bulletin', 2, 'CREATE TABLE [bulletin] (\r\n[id] INTEGER  PRIMARY KEY AUTOINCREMENT NOT NULL,\r\n[name] VARCHAR(255)  NOT NULL,\r\n[user_id] INTEGER  NOT NULL,\r\n[category_id] INTEGER  NOT NULL,\r\n[type] BOOLEAN DEFAULT ''''''false'''''' NOT NULL,\r\n[views] INTEGER DEFAULT ''''''0'''''' NOT NULL,\r\n[text] TEXT  NOT NULL\r\n, "created_at" INTEGER, "updated_at" INTEGER, "gallery_id" INTEGER, "youtube_id" VARCHAR(255))'),
('table', 'sqlite_sequence', 'sqlite_sequence', 3, 'CREATE TABLE sqlite_sequence(name,seq)'),
('table', 'category', 'category', 4, 'CREATE TABLE [category] (\r\n[id] INTEGER  PRIMARY KEY AUTOINCREMENT NOT NULL,\r\n[name] VARCHAR(255)  NOT NULL,\r\n[icon] VARCHAR(255)  NULL,\r\n[root] INTEGER DEFAULT ''NULL'' NULL,\r\n[lft] INTEGER  NOT NULL,\r\n[rgt] INTEGER  NOT NULL,\r\n[level] INTEGER  NOT NULL\r\n)'),
('table', 'tbl_migration', 'tbl_migration', 5, 'CREATE TABLE ''tbl_migration'' (\n	"version" varchar(255) NOT NULL PRIMARY KEY,\n	"apply_time" integer\n)'),
('index', 'sqlite_autoindex_tbl_migration_1', 'tbl_migration', 6, ''),
('table', 'profiles', 'profiles', 8, 'CREATE TABLE ''profiles'' (\n	"user_id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,\n	"first_name" varchar(255),\n	"last_name" varchar(255)\n, `city` VARCHAR(255) NOT NULL  DEFAULT '''', `url` VARCHAR(255) NOT NULL  DEFAULT '''', `phone` VARCHAR(255) NOT NULL  DEFAULT '''', `icq` VARCHAR(255) NOT NULL  DEFAULT '''', `company` VARCHAR(255) NOT NULL  DEFAULT '''', `about` VARCHAR(1024) NOT NULL  DEFAULT '''')'),
('table', 'profiles_fields', 'profiles_fields', 10, 'CREATE TABLE ''profiles_fields'' (\n	"id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,\n	"varname" varchar(50) NOT NULL,\n	"title" varchar(255) NOT NULL,\n	"field_type" varchar(50) NOT NULL,\n	"field_size" int(3) NOT NULL,\n	"field_size_min" int(3) NOT NULL,\n	"required" int(1) NOT NULL,\n	"match" varchar(255) NOT NULL,\n	"range" varchar(255) NOT NULL,\n	"error_message" varchar(255) NOT NULL,\n	"other_validator" text NOT NULL,\n	"default" varchar(255) NOT NULL,\n	"widget" varchar(255) NOT NULL,\n	"widgetparams" text NOT NULL,\n	"position" int(3) NOT NULL,\n	"visible" int(1) NOT NULL\n)'),
('table', 'gallery', 'gallery', 12, 'CREATE TABLE ''gallery'' (\n	"id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,\n	"versions_data" text NOT NULL,\n	"name" tinyint(1) NOT NULL DEFAULT 1,\n	"description" tinyint(1) NOT NULL DEFAULT 1\n)'),
('table', 'gallery_photo', 'gallery_photo', 13, 'CREATE TABLE ''gallery_photo'' (\n	"id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,\n	"gallery_id" integer NOT NULL,\n	"rank" integer NOT NULL DEFAULT 0,\n	"name" varchar(255) NOT NULL,\n	"description" text,\n	"file_name" varchar(255) NOT NULL\n)'),
('table', 'Config', 'Config', 15, 'CREATE TABLE `Config` (`key` VARCHAR(100) PRIMARY KEY, `value` TEXT)'),
('index', 'sqlite_autoindex_Config_1', 'Config', 16, ''),
('table', 'users', 'users', 17, 'CREATE TABLE ''users'' (\n	"id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,\n	"username" varchar(20) NOT NULL,\n	"password" varchar(128) NOT NULL,\n	"email" varchar(128) NOT NULL,\n	"activkey" varchar(128) NOT NULL,\n	"superuser" int(1) NOT NULL,\n	"status" int(1) NOT NULL,\n	"create_at" TIMESTAMP,\n	"lastvisit_at" TIMESTAMP\n)'),
('table', 'advertisement', 'advertisement', 18, 'CREATE TABLE ''advertisement'' (\n	"id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,\n	"banner" VARCHAR(255) NOT NULL,\n	"url" VARCHAR(255),\n	"name" VARCHAR(255) NOT NULL,\n	"description" text,\n	"order" INTEGER,\n	"gallery_id" INTEGER,\n	"extra" text\n)'),
('table', 'answer', 'answer', 20, 'CREATE TABLE ''answer'' (\n	"id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,\n	"parent_id" INTEGER,\n	"user_id" INTEGER,\n	"text" text NOT NULL,\n	"created_at" TIMESTAMP,\n	"updated_at" TIMESTAMP\n)');

-- --------------------------------------------------------

--
-- Структура таблицы `sqlite_sequence`
--

CREATE TABLE IF NOT EXISTS `sqlite_sequence` (
  `name` varchar(15) default NULL,
  `seq` int(3) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sqlite_sequence`
--

INSERT INTO `sqlite_sequence` (`name`, `seq`) VALUES
('bulletin', 399),
('category', 109),
('profiles', 393),
('profiles_fields', 8),
('users', 393),
('advertisement', 7),
('gallery', 732),
('gallery_photo', 337);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(41) NOT NULL default '',
  `apply_time` int(10) default NULL,
  PRIMARY KEY  (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1362408335),
('m110805_153437_installYiiUser', 1362408370),
('m110810_162301_userTimestampFix', 1362408370),
('m130306_101809_add_timestamp_behavior', 1363524982),
('m130306_130214_install_gallery_manager', 1363524982),
('m130306_134530_add_gallery_id_to_bulletin', 1363524982),
('m130307_194811_add_youtube', 1363524982),
('m130308_155733_fix_user_timestamp', 1363529292),
('m130313_071213_advertisement', 1363529292),
('m130314_082305_answer', 1363529292),
('m130314_101801_add_default_ads', 1363529292);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_profiles_fields`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles_fields` (
  `id` int(10) NOT NULL auto_increment,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL default '0',
  `field_size_min` varchar(15) NOT NULL default '0',
  `required` int(1) NOT NULL default '0',
  `match` varchar(255) NOT NULL default '',
  `range` varchar(255) NOT NULL default '',
  `error_message` varchar(255) NOT NULL default '',
  `other_validator` varchar(5000) NOT NULL default '',
  `default` varchar(255) NOT NULL default '',
  `widget` varchar(255) NOT NULL default '',
  `widgetparams` varchar(5000) NOT NULL default '',
  `position` int(3) NOT NULL default '0',
  `visible` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_profiles_fields`
--

INSERT INTO `tbl_profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'firstname', 'First Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(5) default NULL,
  `password` varchar(32) default NULL,
  `email` varchar(21) default NULL,
  `activkey` varchar(32) default NULL,
  `superuser` int(1) default NULL,
  `status` int(1) default NULL,
  `create_at` varchar(19) default NULL,
  `lastvisit_at` varchar(19) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activkey`, `superuser`, `status`, `create_at`, `lastvisit_at`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', 'c902179e0e5f1f39858c661a146c6586', 1, 1, '2013-03-04 14:46:10', '2014-11-10 03:41:24'),
(2, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', 'a512641e3a3df1caf3bab2f132794b9a', 0, 1, '2013-07-24 23:52:29', '2013-07-25 00:21:05');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
