create database manyminds;

CREATE TABLE `users` (
						 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
						 `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
						 `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
						 `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
						 `gender` enum('Masculino','Feminino') COLLATE utf8_unicode_ci NOT NULL,
						 `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
						 `created_at` datetime NOT NULL DEFAULT current_timestamp(),
						 `updated_at` datetime NOT NULL,
						 `deleted_at` datetime NOT NULL,
						 `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active | 0=Inactive',
						 PRIMARY KEY (`id`),
						 UNIQUE KEY `uq_email` (`email`),
						 KEY `idx_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `logs_authorization` (
									  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
									  `user_id` int(11) unsigned NOT NULL,
									  `ip` varchar(40) DEFAULT NULL,
									  `ok` tinyint(1) unsigned NOT NULL,
									  `created_at` datetime DEFAULT current_timestamp(),
									  PRIMARY KEY (`id`),
									  KEY `idx_ip` (`ip`),
									  KEY `idx_user_id` (`user_id`)
) ENGINE=InnoDB;

create view vw_logsauth as
select l.id, u.name as user, l.ip, l.ok, l.created_at
from users u
right join logs_authorization l on l.user_id = u.id;
