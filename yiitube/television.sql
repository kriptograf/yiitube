-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 31 2015 г., 12:38
-- Версия сервера: 5.1.68-community-log
-- Версия PHP: 5.3.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `television`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` text,
  `icon` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `top` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `icon`, `parent_id`, `top`) VALUES
(1, 'First Cat', 'Детроитом овладел злобный миллионер Абрахам Кейн. Подавляя свободы и запрещая движение на автомобилях, Кейн сталкивается с бандой бунтарей во главе с Майком Чилтоном, именуемых себя "Горящими". Они восстают, чтобы остановить Кейна от завоевания', '3630405-R3L8T8D-600-21.jpg', 0, 1),
(2, 'First Subcat', 'ывкыва ываыв аы ываываукцк цук цук ывацукцукцукцу цукываываыв', '3405655-R3L8T8D-500-credit.jpg', 1, 1),
(3, 'Second Subcat', 'цукцукцу цук цукцукцу кцук цукцу кцук цукцукцу', '1739505-R3L8T8D-600-reklama_109.jpg', 1, 1),
(4, 'Четвертая категория', 'ываы ываыва ываываываываыв ываываыв ываываы ываыва ыва ываываыв ываыв аыв', '14.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `author` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_videos` (`video_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `content`, `status`, `create_time`, `author`, `email`, `url`, `video_id`) VALUES
(1, 'rwerwer werwerwer werwer erter terter\r\nerter erter ter\r\nertert erterterter t erterterter', 2, 1378579318, 'wqeqweqw', 'ffffff@nm.ru', '', 5),
(2, 'xcvxcvxcvxcvxcvxcvxcvx', 2, 1378579415, 'xvxvxcvxcv', 'xxxx@nm.ru', '', 5),
(3, 'sdddddddddddddddddddddddddd', 2, 1378661251, 'rrrrrrrr', 'ffffff@nm.ru', '', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(127) NOT NULL,
  `video_id` int(11) NOT NULL,
  `mind` enum('-1','1') NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `video_id`, `mind`, `time`) VALUES
(1, 'http://vk.com/id192474266', 1, '1', '2013-04-22 13:28:45'),
(2, 'https://www.google.com/accounts/o8/id?id=AItOawnyp6qCIg-UYfHH68ly9S19Gjv-wWOaXaE', 1, '1', '2013-04-23 08:20:55'),
(3, 'https://www.google.com/accounts/o8/id?id=AItOawmjLIK5-M2UZaaSxQ6kInZEXVoiWjq5E3A', 1, '-1', '2013-04-23 15:17:00'),
(4, 'https://www.google.com/accounts/o8/id?id=AItOawmjLIK5-M2UZaaSxQ6kInZEXVoiWjq5E3A', 1, '-1', '2013-04-23 16:07:52'),
(5, 'demo', 1, '-1', '2013-08-13 12:37:23'),
(6, '18', 9, '1', '2013-09-08 17:26:51'),
(7, '18', 9, '-1', '2013-09-08 17:27:11'),
(8, '18', 9, '-1', '2013-09-08 17:32:18'),
(9, '18', 9, '-1', '2013-09-08 17:52:33');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `tags` text,
  `image` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `IsFeatured` tinyint(4) NOT NULL DEFAULT '0',
  `CreatedDate` datetime DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `Views` int(11) DEFAULT '0',
  `Useful` int(11) DEFAULT '0',
  `Unuseful` int(11) DEFAULT '0',
  PRIMARY KEY (`id_news`),
  UNIQUE KEY `Alias_Unique` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id_news`, `title`, `alias`, `tags`, `image`, `content`, `status`, `IsFeatured`, `CreatedDate`, `UpdatedDate`, `user_id`, `Views`, `Useful`, `Unuseful`) VALUES
(44, 'Скончалась звезда Голливуда 30-х годов Дина Дурбин', 'skonchalas-zvezda-gollivuda-30-h-godov-dina-durbin', NULL, '3.jpg', '<p>\r\n	Скончалась звезда Голливуда 30-х годов Дина Дурбин</p>\r\n<p>\r\n	Скончалась звезда Голливуда 30-х годов Дина Дурбин</p>\r\n<p>\r\n	Скончалась звезда Голливуда 30-х годов Дина Дурбин</p>\r\n<p>\r\n	Скончалась звезда Голливуда 30-х годов Дина Дурбин</p>\r\n<p>\r\n	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"><param name="quality" value="high" /><param name="movie" value="/media/flash/les_b21.swf" /><embed pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="/media/flash/les_b21.swf" type="application/x-shockwave-flash"></embed></object></p>\r\n', 1, 1, '2013-09-03 13:48:23', '2013-09-09 03:30:47', 18, 0, 0, 0),
(45, 'Запущенные в направлении Сирии ракеты упали в море', 'zapuschennyie-v-napravlenii-sirii-raketyi-upali-v-more', NULL, '52240612.jpeg', '<p>\r\n	Зафиксированные в Средиземноморье баллистические цели упали в море. Об этом сообщает РИА Новости со ссылкой на свой источник в Дамаске.<br />\r\n	<br />\r\n	&quot;Действительно, было два запуска, они (цели) упали в море&quot;, - рассказал из Дамаска информированный источник в одной из сирийских госструктур.<br />\r\n	<br />\r\n	Он не сообщил, в каком именно месте упали ракеты и насколько близки они были к сирийскому побережью.<br />\r\n	<br />\r\n	Ранее сообщалось, что Министерство обороны России зафиксировало запуск двух баллистических целей из центральной части Средиземного моря в направлении восточной части Средиземноморского побережья.<br />\r\n	<br />\r\n	После сообщения информацию стали проверять сразу несколько стран. Минобороны Великобритании не располгает информацией о запуске, как и военные Израиля. Также о ракетах ничего не знали в посольстве России в Дамаске.<br />\r\n	<br />\r\n	О возможности военного вторжения в Сирию заговорили после того, как правительство Башара Асада обвинили в применении химического оружия. Тем не менее, доподлинно неизвестно, кто именно применил химоружие: оппозиция или правительство. США выступили инициатором вторжения, однако их не поддержали в Великобритании, России и ряде других стран. Президент США Барак Обама обратился к конгрессу за одобрением военной операции в Сирии. Ответ американскому лидеру конгрессмены дадут после выхода из отпуска в десятых числах сентября. Эксперты по химоружию в конце прошлой недели покинули Сирию, где расследовали обстоятельства химической атаки. В ближайшее время они должны сообщить о результатах расследования.</p>\r\n', 1, 1, '2013-09-03 14:30:57', '2013-09-03 14:35:10', 18, 0, 0, 0),
(46, 'bbbbbbbbbbbbb', 'bbbbbbbbbbbbb', NULL, '1739505-R3L8T8D-600-reklama_109.jpg', '<p>\r\n	bbbbbbbbbbbbbbb bbbbbbbbbbbbbbb bbbbbbbbbbbb bbbbbbbbbbbbbbbb bbbbbbbbbbbbb bbbbbbbbb b</p>\r\n', 1, 0, '2013-09-03 14:35:47', '2013-09-03 14:35:47', 18, 0, 0, 0),
(47, 'sdfsdfsd', 'sdfsdfsd', NULL, '3583105-R3L8T8D-500-dog.jpg', '<p>\r\n	sdfsdfsdf</p>\r\n', 1, 0, '2013-09-03 14:42:53', '2013-09-03 14:42:53', 18, 0, 0, 0),
(48, 'qweqwe', 'qweqwe', NULL, '3567655-R3L8T8D-500-0039dyfq.jpg', '<p>\r\n	qweqweqwe</p>\r\n', 1, 0, '2013-09-03 14:44:31', '2013-09-03 14:44:31', 18, 0, 0, 0),
(49, 'vbnfghfghvg', 'vbnfghfghvg', NULL, '3404705-R3L8T8D-400-2.JPG', '<p>\r\n	vvbnvbnvbnvbnvbn</p>\r\n', 1, 1, '2013-09-03 14:47:17', '2013-09-03 14:47:17', 18, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `state` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `title`, `text`, `keywords`, `descr`, `alias`, `state`) VALUES
(4, 'eeeeeeeeeeeee', '<p>\r\n	Ofcourse, I could just ignore it and clear the error log (when I&#39;ve finished scanning my site), but I&#39;m just curious and would like to know why (and if there is a &#39;fix&#39;)?<br />\r\n	<br />\r\n	Upgrade your PHP version to the current stable one: PHP 5.4.7.<br />\r\n	<br />\r\n	Run the security checks again. If the error still happens (which I highly doubt), this needs further inspection. In that case (and even earlier) you should have added your session configuration (it is larger than you might think) to the question.<br />\r\n	<br />\r\n	Also the code which is triggering this is unknown. The function session_regenerate_id() is normally used in the context of the session management.<br />\r\n	<br />\r\n	Because the concept of session is not that easy to grasp many developers (incl. me) do errors in that field more often. Some useful debugging functions:<br />\r\n	session_status<br />\r\n	headers_list<img alt="" src="/media/images/6212605-R3L8T8D-500-50799cf858a8a.jpeg" style="width: 500px; height: 374px;" /></p>\r\n', 'ewerwer', 'sdfsdfsdfsd', 'eeeeeeeeeeeeeee', 1),
(5, 'about', '<p>\r\n	`session_regenerate_id` sends a new cookie but doesn&#39;t overwrite the value stored in `$_COOKIE`. After calling `session_destroy`, the open session ID is discarded, so simply restarting the session with `session_start` (as done in Ben Johnson&#39;s code) will re-open the original, though now empty, session for the current request (subsequent requests will use the new session ID). Instead of `session_destroy`+`session_start`, use the `$delete_old_session` parameter to `session_regenerate_id` to delete the previous session data.</p>\r\n', '', '', 'about', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `social`
--

CREATE TABLE IF NOT EXISTS `social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(500) NOT NULL,
  `link` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `social`
--

INSERT INTO `social` (`id`, `icon`, `link`, `title`, `alt`, `status`) VALUES
(1, 'Facebook.png', 'http://facebook.com', 'фасебук', 'фейсбук', 1),
(2, 'Blogger.png', 'http://vk.com', 'Мы из джаза', 'Мы из джаза', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `identity` varchar(255) NOT NULL,
  `network` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `activkey` varchar(255) DEFAULT NULL,
  `superuser` tinyint(1) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `identity`, `network`, `email`, `full_name`, `activkey`, `superuser`, `state`) VALUES
(18, 'foreach', '1bbd886460827015e5d605ed44252251', 'https://www.facebook.com/profile.php?id=100001653371575', 'facebook', 'foreach@mail.ru', 'Виталий Москвин', 'c74baafb3bd17946898469c171c0495a', 1, 1),
(19, 'moskvinvitaliy@gmail.com', 'b46c28a129b19bc150a0904cd6001756', 'https://plus.google.com/u/0/101599749116832918250/', 'google', 'moskvinvitaliy@gmail.com', 'Виталий Петренко', 'ff368541c922e702d7cb559d676bca1d', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `announce` text,
  `description` text NOT NULL,
  `video` varchar(256) NOT NULL,
  `ext` varchar(6) DEFAULT NULL,
  `poster` varchar(256) NOT NULL,
  `category_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `videos`
--

INSERT INTO `videos` (`id`, `name`, `announce`, `description`, `video`, `ext`, `poster`, `category_id`, `time`, `featured`, `views`) VALUES
(1, 'Тестовое видео333', NULL, 'Описание описание описание случайное описание\r\nОписание описание описание случайное описание\r\nОписание описание описание случайное описание\r\nОписание описание описание случайное описание\r\nОписание описание описание случайное описание\r\nОписание описание описание случайное описание\r\nОписание описание описание случайное описание\r\nОписание описание описание случайное описание\r\nОписание описание описание случайное описание', 'out-5.ogv', 'ogv', '', 2, '2013-04-20 23:36:21', 1, 1),
(2, 'Видео 2', NULL, 'Суарес укусил, и молодец\r\nСуарес укусил, и молодец\r\nСуарес укусил, и молодец\r\nСуарес укусил, и молодец\r\nСуарес укусил, и молодец\r\nСуарес укусил, и молодец\r\nСуарес укусил, и молодец', 'out-6.ogv', 'ogv', '', 2, '2013-04-23 08:52:26', 1, 0),
(3, 'Видео 3', NULL, 'Моряк зашивал парус иглой от компаса\r\nМоряк зашивал парус иглой от компаса\r\nМоряк зашивал парус иглой от компаса\r\nМоряк зашивал парус иглой от компаса\r\nМоряк зашивал парус иглой от компаса', 'out-7.ogv', 'ogv', '', 3, '2013-04-23 08:53:46', 1, 0),
(5, 'Параметризация маршрутов', NULL, 'Управление URL-адресами в веб-приложениях включает в себя два аспекта:\r\nПриложению необходимо разобрать запрос пользователя, поступающий в виде URL, на отдельные параметры.\r\nПриложение должно предоставлять способ формирования адресов URL, с которыми оно сможет корректно работать.\r\n\r\nВ приложениях на Yii эти задачи решаются с использованием класса CUrlManager.', 'bbb_short.ogv', NULL, '', 1, '2013-09-03 16:31:07', 1, 1),
(6, 'Использование своего класса правила URL', NULL, 'Мы можем сделать так, чтобы адрес, приведенный в качестве примера выше, выглядел более аккуратно и понятно за счет использования формата path, который исключает использование строки запроса и включает все GET-параметры в информационную часть адреса URL:\r\n/index.php/post/read/id/100\r\n\r\nДля изменения формата представления адреса URL, нужно настроить компонент приложения urlManager таким образом, чтобы метод createUrl мог автоматически переключиться на использование нового формата, а приложение могло корректно воспринимать новый формат адресов URL:', 'tennis-500-b.ogv', NULL, '', 1, '2013-09-03 16:32:21', 1, 0),
(7, 'vvvvvvvvvvv', NULL, 'Подсказка: Адрес URL, генерируемый методом createUrl является относительным. Для того, чтобы получить абсолютный адрес, нужно добавить префикс, используя Yii::app()->request->hostInfo, или вызвать метод createAbsoluteUrl.', 'si.ogv', NULL, '', 2, '2013-09-03 16:34:53', 1, 0),
(8, 'xxxxxxxxxxxxxxx', NULL, 'Если в качестве формата адреса URL используется path, то мы можем определить правила формирования URL, чтобы сделать адреса более привлекательными и понятными с точки зрения пользователя. Например, мы можем использовать короткий адрес /post/100 вместо длинного варианта /index.php/post/read/id/100. CUrlManager использует правила формирования URL как для создания, так и для обработки адресов.', 'foreman-500-c.ogv', NULL, '', 3, '2013-09-03 16:36:02', 1, 0),
(9, 'nnnnnnnnnnn', NULL, 'Правила задаются в виде массива пар шаблон-путь, где каждая пара соответствует одному правилу. Шаблон правила — строка, которая должна совпадать с путём в URL. Путь правила должен указывать на существующий путь контроллера.', 'crew_128_150.ogv', NULL, '', 4, '2013-09-03 16:53:12', 1, 13);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `view_search`
--
CREATE TABLE IF NOT EXISTS `view_search` (
`title` varchar(256)
,`text` text
,`url` varbinary(22)
,`type` varchar(7)
);
-- --------------------------------------------------------

--
-- Структура для представления `view_search`
--
DROP TABLE IF EXISTS `view_search`;

CREATE ALGORITHM=UNDEFINED DEFINER=`mysql`@`%` SQL SECURITY DEFINER VIEW `view_search` AS select `news`.`title` AS `title`,`news`.`content` AS `text`,concat('/news/news/',`news`.`id_news`) AS `url`,concat('Новости') AS `type` from `news` union select `videos`.`name` AS `title`,`videos`.`description` AS `text`,concat('/videos/',`videos`.`id`) AS `url`,concat('Видео') AS `type` from `videos`;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_comment_videos` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
