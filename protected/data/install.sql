-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 13 2015 г., 10:23
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
-- Структура таблицы `adverts`
--

CREATE TABLE IF NOT EXISTS `adverts` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(121) default NULL,
  `user_id` int(1) default NULL,
  `category_id` int(2) default NULL,
  `type` int(1) default NULL,
  `views` int(1) default NULL,
  `text` varchar(1822) default NULL,
  `fields` varchar(1000) NOT NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  `gallery_id` int(3) default NULL,
  `youtube_id` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=407 ;

--
-- Дамп данных таблицы `adverts`
--

INSERT INTO `adverts` (`id`, `name`, `user_id`, `category_id`, `type`, `views`, `text`, `fields`, `created_at`, `updated_at`, `gallery_id`, `youtube_id`) VALUES
(391, 'Охранник', 2, 8, 0, 0, 'Ищу работу охранником с понедельной оплатой труда.', '', '2015-03-09 00:00:00', '0000-00-00 00:00:00', 723, ''),
(392, 'Охранник, оператор, аппаратчик, машинист', 2, 8, 0, 0, 'Ищу работу Охранника, оператора технологических установок в нефтехимической отрасли,оператора котельных,аппаратчика химпроизводства и воздухоразделения(АКС),машиниста насосных-компрессорных станций.Стаж 10 лет', '', '2015-03-10 00:00:00', '0000-00-00 00:00:00', 724, ''),
(393, 'Поиск фрилансеров', 2, 7, 1, 0, 'Молодая, перспективная биржа удаленной работы ищет талантливых и креативных фрилансеров в сфере наружной рекламы, \r\n BTL-маркетинга, печатной рекламы, радио рекламы. Вас ждет много интересной и творческой работы. Высокая заработная плата. Звоните, возможно, мы ищем именно вас.', '', '2015-03-08 00:00:00', '0000-00-00 00:00:00', 725, ''),
(394, 'Требуется менеджер по продажам', 2, 7, 1, 0, 'Компании, занимающейся производством и монтажом металлоизделий (ворота, решетки, двери, заборы, навесы и т.д.) в городе Ростове-на-Дону, требуется менеджер по продажам.\r\n\r\nОбязанности.\r\n\r\nВыезд на заказ,\r\n\r\n— выявление потребности клиента,\r\n\r\n— продажа того что клиенту необходимо,\r\n\r\n— заключение договора,\r\n\r\n— замер всех параметров металлоизделия,\r\n\r\n— заключение договора,\r\n\r\n— общение с клиентом, пока изделие находится в производстве\r\n\r\nТребование.\r\n\r\n1 Техническое мышление и образование желательно.\r\n\r\n2 Наличие автомобиля обязательно.\r\n\r\n3 Опыт работы замерщиком/менеджером в аналогичной компании\r\n\r\n4 Понимание производственных процессов разработки металлоизделий и материалов используемых при изготовлении.\r\n\r\n5. Умение рисовать и разрабатывать дизайн изделий является серьезным преимуществом.\r\n\r\n6. Обязательно опыт замеров дверей, перил, решеток, навесов, ворот, заборов.\r\n\r\nУсловия:\r\n\r\nЗ/п от 30000 р.\r\n\r\n5 дневная рабочая неделя (иногда есть необходимость в замерах в субботу) Обучение.\r\n\r\nОформление по ТК РФ.', '', '2015-03-08 00:00:00', '0000-00-00 00:00:00', 726, ''),
(395, 'Сниму 1-к квартиру', 2, 10, 0, 0, 'Молодая русская семья,в которой ожидается пополнение,снимет на длительный срок однокомнатную квартиру в районе метро Выхино.Гарантируем чистоту,порядок и своевременную квартплату.', '', '2015-03-12 00:00:00', '0000-00-00 00:00:00', 727, ''),
(396, 'Британские плюшевые Серебристые котята мраморные и тебби (Вискас)', 2, 19, 1, 0, 'Московский питомник элитных кошек GREGORI al GATO 89258509506 предлагает к продаже Британских плюшевых котят Эксклюзивных окрасов: Серебристая шиншилла с изумрудными глазками! Серебристая шиншилла - пойнт с сапфировыми глазками! Серебрыстые мраморные и тебби (Вискас) Котята отличного породного типа, с большими яркими глазками. Выращены для Вас с любовью! Тел: 8(916)916-60-66, 8(925)850-95-06 http://gregorialgato.narod.ru/kotata.html', '', '2015-03-08 00:00:00', '0000-00-00 00:00:00', 728, ''),
(397, 'Волнистые попугаи(разного возраста)', 2, 20, 1, 1, 'Продаю волнистых попугаев своего разведения. Птенцам от 35 дней,так же есть птички разного возраста и окраса. Покупая птицу вы берете ответственность на всю жизнь,я вам гарантирую здоровую активную птицу способную к приручению и обучению разговаривать. тел 89629093432', '', '2015-03-08 00:00:00', '0000-00-00 00:00:00', 729, ''),
(398, 'Iron eagle DD50', 2, 16, 1, 0, 'Продаю чепер, двигатель Suzuki 125cc , механика,максимальная скорость 130км/ч , очень жалко отдавать но срочно нужны деньги. не требует регистрации в ГИБДД !!! (Торг на месте)', '', '2015-03-08 00:00:00', '0000-00-00 00:00:00', 730, ''),
(399, 'аквариумные рыбки', 2, 21, 1, 5, 'Самый большой ассортимент аквариумных рыбок, беспозвоночных, амфибий (ширпотреб). Обновление прайса еженедельно. Прайс отправляю по запросу. Условия, вопросы, консультации - по телефону. Отправка из Харькова', '', '2015-03-08 00:00:00', '0000-00-00 00:00:00', 732, ''),
(400, 'xcvxcv', 1, 7, NULL, 5, 'xcvxcv', '', '2015-03-08 00:00:00', NULL, 733, NULL),
(401, 'xzczxczxc', 1, 7, NULL, 7, 'zxczxczxc', '', '2015-03-08 00:00:00', NULL, 734, NULL),
(402, 'cvxcvx', 1, 8, 0, 1, 'cvxcvxcvxcvxcvxcv', '', '2015-03-03 00:00:00', NULL, 735, NULL),
(403, 'sdfsdfsfd', 1, 7, 0, 3, 'xcvxcvxcvxcvxcvx', 'Array', '2015-03-01 00:00:00', NULL, 736, NULL),
(404, 'sdfsdfsdfsdf', 1, 7, 0, 16, 'ываыва ыва ыва ыва ыва ыва ыва ', 'a:3:{s:5:"price";s:9:"dsfsdfsdf";s:3:"tra";s:9:"sdfsdfsdf";s:7:"_empty_";s:12:"sdfsdfsdfsdf";}', '2015-03-08 00:00:00', NULL, 737, NULL),
(405, 'Хочу работать ', 1, 8, 1, 1, 'Хочу работать Хочу работать Хочу работать Хочу работать Хочу работать Хочу работать Хочу работать Хочу работать Хочу работать Хочу работать Хочу работать ', 'N;', '2015-03-05 00:00:00', '0000-00-00 00:00:00', 739, NULL),
(406, 'Хочу работать ', 1, 8, 1, 8, 'Хочу работать Хочу работать Хочу работать Хочу работать Хочу работать Хочу работать Хочу работать Хочу работать Хочу работать Хочу работать Хочу работать ', 'N;', '2015-03-08 00:00:00', '0000-00-00 00:00:00', 741, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `icon`, `fields`, `root`, `lft`, `rgt`, `level`) VALUES
(1, 'Работа и бизнес', '', '{"price":{"name":"sdfsdf","type":"0"},"tra":{"name":"sdfsdf","type":"0"},"_empty_":{"name":"vxcvxcv","type":"0"}}', 88, 1, 10, 1),
(2, 'Недвижимость', '', '{"price":{"name":"sdfsdf","type":"0"},"tra":{"name":"sdfsdf","type":"0"},"_empty_":{"name":"vxcvxcv","type":"0"}}', 89, 1, 10, 1),
(3, 'Транспорт', '', '', 90, 1, 10, 1),
(4, 'Животные', '', '', 91, 1, 12, 1),
(5, 'Разное', '', '', 92, 1, 2, 1),
(6, 'Услуги', '', '', 93, 1, 2, 1),
(7, 'Вакансии', '', '{"price":{"name":"\\u0421\\u0442\\u0430\\u0436","type":"0"},"tra":{"name":"\\u0413\\u0440\\u0430\\u0444\\u0438\\u043a","type":"0"},"_empty_":{"name":"\\u041e\\u0431\\u0440\\u0430\\u0437\\u043e\\u0432\\u0430\\u043d\\u0438\\u0435","type":"0"}}', 88, 6, 7, 2),
(8, 'Ищут работу', '', '', 88, 8, 9, 2),
(9, 'Курсы, образование', '', '', 88, 2, 5, 2),
(10, 'Квартиры', '', '', 89, 2, 3, 2),
(11, 'Офисы', '', '', 89, 4, 5, 2),
(12, 'Земля и участки', '', '', 89, 6, 7, 2),
(13, 'Гаражи', '', '', 89, 8, 9, 2),
(14, 'Легковые авто', '', '', 90, 2, 3, 2),
(15, 'Грузовые автомобили', '', '', 90, 6, 7, 2),
(16, 'Мото транспорт', '', '', 90, 4, 5, 2),
(17, 'Велосипеды', '', '', 90, 8, 9, 2),
(18, 'Грызуны', '', '', 91, 2, 3, 2),
(19, 'Кошки', '', '', 91, 6, 7, 2),
(20, 'Птицы', '', '', 91, 4, 5, 2),
(21, 'Рыбы', '', '', 91, 8, 9, 2),
(22, 'Собаки', '', '', 91, 10, 11, 2),
(27, 'Детский мир', '', '', 97, 1, 2, 1),
(24, 'Телефоны и связь', '', '', 95, 1, 2, 1),
(25, 'Компьютеры и оргтехника', '', '', 96, 1, 2, 1),
(26, 'Одежда и обувь', '', '', 94, 1, 2, 1),
(28, 'Спорт, здоровье, красота', '', '', 98, 1, 2, 1),
(29, 'Все для дома и офиса', '', '', 99, 1, 2, 1),
(30, ' Знакомства и поздравления', '', '', 100, 1, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `name` varchar(400) NOT NULL,
  `address` varchar(400) NOT NULL,
  `description` varchar(400) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY  (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=742 ;

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
(734, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(735, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(736, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(737, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(738, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(739, 'a:2:{s:5:"small";a:1:{s:6:"resize";a:2:{i:0;i:150;i:1;N;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(740, 'a:2:{s:5:"small";a:1:{s:15:"centeredpreview";a:2:{i:0;i:98;i:1;i:98;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0),
(741, 'a:2:{s:5:"small";a:1:{s:6:"resize";a:2:{i:0;i:150;i:1;N;}}s:6:"medium";a:1:{s:6:"resize";a:2:{i:0;i:800;i:1;N;}}}', 0, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=344 ;

--
-- Дамп данных таблицы `gallery_photo`
--

INSERT INTO `gallery_photo` (`id`, `gallery_id`, `rank`, `name`, `description`, `file_name`) VALUES
(334, 732, 334, '', '', '871.jpg'),
(335, 732, 335, '', '', '872.jpg'),
(336, 732, 336, '', '', '873.jpg'),
(337, 732, 337, '', '', '874.jpg'),
(338, 739, 338, '', '', '07.jpg'),
(339, 739, 339, '', '', '2.jpg'),
(340, 739, 340, '', '', '5.Диало'),
(341, 741, 341, '', '', '07.jpg'),
(342, 741, 342, '', '', '2.jpg'),
(343, 741, 343, '', '', '5.Диало');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL auto_increment,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `send_date` datetime NOT NULL,
  `read_date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `send_date`, `read_date`) VALUES
(1, 1, 2, 'Интересное предложение ', '2015-03-12 01:33:43', '0000-00-00 00:00:00'),
(2, 0, 2, 'sdfsdfsdfsdf', '2015-03-12 03:10:14', '0000-00-00 00:00:00');

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
-- Структура таблицы `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL auto_increment,
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `review` text NOT NULL,
  `vote` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) default NULL,
  `password` varchar(32) default NULL,
  `email` varchar(21) default NULL,
  `activkey` varchar(32) default NULL,
  `superuser` int(1) default NULL,
  `status` int(1) default NULL,
  `create_at` varchar(19) default NULL,
  `lastvisit_at` varchar(19) default NULL,
  `identity` varchar(100) NOT NULL,
  `network` varchar(100) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activkey`, `superuser`, `status`, `create_at`, `lastvisit_at`, `identity`, `network`, `full_name`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', 'c902179e0e5f1f39858c661a146c6586', 1, 1, '2013-03-04 14:46:10', '2015-03-11 02:18:05', '', '', ''),
(2, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', 'a512641e3a3df1caf3bab2f132794b9a', 0, 1, '2013-07-24 23:52:29', '2013-07-25 00:21:05', '', '', ''),
(3, 'Макси', 'b8cfd36c855f1b040196e95e000922cd', 'wzcc@mail.ru', NULL, NULL, NULL, NULL, NULL, 'http://vk.com/id6035846', 'vkontakte', 'Максим Углов');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
