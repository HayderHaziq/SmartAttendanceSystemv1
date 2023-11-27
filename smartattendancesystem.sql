-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table smartattendancesystem.attendances
CREATE TABLE IF NOT EXISTS `attendances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `status` enum('Absent','Present') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Absent',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `card_reader_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendances_student_id_foreign` (`student_id`),
  KEY `card_reader_id` (`card_reader_id`),
  CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`card_reader_id`) REFERENCES `card_readers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smartattendancesystem.attendances: ~3 rows (approximately)
DELETE FROM `attendances`;

-- Dumping structure for table smartattendancesystem.card_readers
CREATE TABLE IF NOT EXISTS `card_readers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reader_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `card_readers_reader_id_unique` (`reader_id`),
  KEY `class_id` (`class_id`),
  CONSTRAINT `card_readers_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smartattendancesystem.card_readers: ~0 rows (approximately)
DELETE FROM `card_readers`;
INSERT INTO `card_readers` (`id`, `reader_id`, `class_id`, `created_at`, `updated_at`) VALUES
	(1, '123', 15, '2023-11-26 22:01:34', '2023-11-27 06:01:36');

-- Dumping structure for table smartattendancesystem.classes
CREATE TABLE IF NOT EXISTS `classes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class` varchar(255) DEFAULT NULL,
  `teacher` int DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table smartattendancesystem.classes: ~1 rows (approximately)
DELETE FROM `classes`;
INSERT INTO `classes` (`id`, `class`, `teacher`, `subject`, `time_in`, `time_out`, `created_at`, `updated_at`) VALUES
	(4, 'D-10', 5, 'Sejarah', '09:30:00', '10:00:00', '2023-10-24 05:50:23', '2023-10-24 13:50:23'),
	(15, 'I-80', 10, 'Arts', '09:30:00', '10:30:00', '2023-11-13 03:05:51', '2023-11-13 11:05:51'),
	(16, '9-IO', 10, 'Math', '12:12:00', '12:12:00', '2023-11-24 09:01:29', '2023-11-24 17:01:29');

-- Dumping structure for table smartattendancesystem.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smartattendancesystem.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(2, '2023_11_23_175542_create_attendance_table', 1);

-- Dumping structure for table smartattendancesystem.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table smartattendancesystem.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table smartattendancesystem.students
CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_name` varchar(255) DEFAULT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `class_id` int DEFAULT NULL,
  `teachers` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table smartattendancesystem.students: ~4 rows (approximately)
DELETE FROM `students`;
INSERT INTO `students` (`id`, `student_name`, `student_id`, `class_id`, `teachers`, `created_at`, `updated_at`) VALUES
	(8, 'Hayder Haziq', '01932371233', 4, 'Kamarulzaman', '2023-10-24 05:53:32', '2023-10-24 13:53:32'),
	(24, 'Sumbubu', 'Dset21085634', 15, 'Bahrain', '2023-11-02 22:20:26', '2023-11-13 11:05:59'),
	(25, 'Daniel', '2890138123', 15, 'Bahrain', '2023-11-24 09:01:08', '2023-11-24 17:01:08'),
	(26, 'Jahanam', '892618233', 16, 'Bahrain', '2023-11-24 09:01:42', '2023-11-24 17:01:42');

-- Dumping structure for table smartattendancesystem.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `reset_password_token` text,
  `reset_expiry_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table smartattendancesystem.users: ~5 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `mobile`, `department`, `password`, `role`, `status`, `created_at`, `updated_at`, `reset_password_token`, `reset_expiry_datetime`) VALUES
	(1, 'Admin', 'Administrator', 'admin@gmail.com', '01136096401', 'IT', '$2y$10$BQiWkyDLRC44IpeRyu.O3O/1OvIeKi6h3SV67Ufx.8Yx4OuawVjni', 'Admin', 'A', '2023-07-07 01:12:30', '2023-07-07 09:12:30', NULL, NULL),
	(5, 'Kamarul', 'Kamarulzaman', 'Jisoo@gmail.com', '01923764578', 'GMI', '$2y$10$nNVr1.q82qnDZ6gpgcQTbe92UATeP2AhC9f21DNQzUhiGiVHecnia', 'Teacher', 'A', '2023-10-24 05:47:21', '2023-10-24 13:47:21', NULL, NULL),
	(6, 'Amir', 'Amiruddin', 'amiruddin12@gmail.com', '0187654356', 'GMI', '$2y$10$cH8/SYNImxrOxkenamn/ruujCL62JyJBqkK9L7fMsJP7waV0wjrhG', 'Teacher', 'A', '2023-10-24 05:52:52', '2023-10-24 13:52:52', NULL, NULL),
	(7, 'Jamal', 'Jamal', 'jamal012@gmail.com', '0167654383', 'GMI', '$2y$10$4qYuTCwclZ.XN1k9eTo2zusE7ffEL8ZILLf5UIRkTcUOM9urcwnkS', 'Teacher', 'A', '2023-10-24 06:19:57', '2023-10-24 14:19:57', NULL, NULL),
	(10, 'Bahrain', 'Bahrain', 'bahrain123@gmail.com', '01973452634', 'GMI', '$2y$10$qxjOxLrfR2.KNlc3b8H91Otv7LEfuorqlZoQwbJSq2uTC9kVQZO7e', 'Teacher', 'A', '2023-10-24 06:43:42', '2023-10-24 14:43:42', NULL, NULL),
	(12, 'hayder123', 'hayder123', 'abc123@gmail.com', '123131231313', 'GMI', '$2y$10$pxKBUlxyMfsRaFvBObtrwOeo6zqRVHJxgCBKUArwnb1eiBLz.x6ya', 'Teacher', 'A', '2023-11-25 01:59:36', '2023-11-25 09:59:36', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
