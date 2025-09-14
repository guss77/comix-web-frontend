/*!40101 SET NAMES utf8mb4 */;

DROP TABLE IF EXISTS `comix_feeds`;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `comix_feeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL DEFAULT '',
  `homepage` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `updated` datetime DEFAULT NULL,
  `update_freq` int(11) DEFAULT 43200,
  `next_poll` datetime DEFAULT NULL,
  `delay` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `last_error` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `comix_parsers`;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `comix_parsers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comixid` int(11) NOT NULL,
  `type` enum('page','strip','rant') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `parent_page` int(11) DEFAULT NULL,
  `regex` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `comix_rants`;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `comix_rants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comixid` int(11) NOT NULL DEFAULT 0,
  `url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data` mediumtext NOT NULL,
  `md5` varchar(35) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_rants` (`md5`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `comix_registrations`;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `comix_registrations` (
  `userid` int(11) NOT NULL DEFAULT 0,
  `comixid` int(11) NOT NULL DEFAULT 0,
  `want_rants` tinyint(1) DEFAULT 1,
  UNIQUE KEY `userid` (`userid`,`comixid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `comix_strips`;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `comix_strips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comixid` int(11) NOT NULL DEFAULT 0,
  `filename` varchar(256) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `mime` varchar(30) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `md5` varchar(35) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `data` longblob NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dup_images` (`md5`),
  KEY `updates` (`date`),
  KEY `comixid` (`comixid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `comix_users`;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `comix_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `schedule` int(11) NOT NULL DEFAULT 86400,
  `last_sent` datetime DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `password` varchar(20) DEFAULT NULL,
  `refcode` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `email_size` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
