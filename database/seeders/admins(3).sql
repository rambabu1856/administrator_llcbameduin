SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(1) DEFAULT NULL,
  `campus_id` tinyint(1) DEFAULT NULL,
  `department_id` int(3) NOT NULL,
  `course_id` tinyint(1) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `admins` (`id`, `name`, `role`, `campus_id`, `department_id`, `course_id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ram Babu', NULL, 1, 1, 1, 'admin@gmail.com', '2023-05-29 02:34:15', '$2y$10$YwZxXNWb7veiC5nWsCqDO.wK2Vl8DvgsWC0Ry7itvd5ICQXt7kAti', NULL, '2023-05-29 02:34:15', '2023-05-29 02:34:15'),
(2, 'Smita Mohanty', NULL, 1, 1, 1, 'smita111@gmail.com', '2023-05-29 02:34:15', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2023-05-29 02:34:15', '2023-08-11 06:17:40');

