-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2026 at 07:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `candidate_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `experience_years` int(11) NOT NULL,
  `previous_experience` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`previous_experience`)),
  `age` int(11) NOT NULL,
  `status` enum('pending','first_interview_scheduled','first_interview_completed','passed_first','rejected_first','second_interview_scheduled','second_interview_completed','hired','rejected_final') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `user_id`, `name`, `email`, `phone`, `experience_years`, `previous_experience`, `age`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Rahim Uddin', 'rahim@example.com', '01711111111', 3, '{\"ABC Ltd\":\"Junior Developer\",\"XYZ Tech\":\"Developer\"}', 26, 'rejected_final', '2026-01-06 20:05:33', '2026-01-07 08:17:26'),
(2, NULL, 'Karim Hasan', 'karim@example.com', '01822222222', 5, '{\"SoftBD\":\"Software Engineer\",\"Brain Station\":\"Senior Engineer\"}', 30, 'rejected_final', '2026-01-06 20:05:33', '2026-01-07 12:30:47'),
(4, NULL, 'Clio Walker', 'rawu@mailinator.com', '+1 (632) 779-1518', 1979, NULL, 71, 'hired', '2026-01-07 06:51:36', '2026-01-07 08:15:10'),
(5, NULL, 'Claire Oconnor', 'tatyzinew@mailinator.com', '+1 (557) 135-3372', 2001, NULL, 49, 'rejected_final', '2026-01-07 07:11:35', '2026-01-07 12:47:35'),
(6, NULL, 'Gavin Fletcher', 'nive@mailinator.com', '+1 (843) 205-4972', 1985, NULL, 26, 'first_interview_completed', '2026-01-07 07:13:11', '2026-01-07 07:13:57'),
(7, NULL, 'Charlotte Pearson', 'qabivuvid@mailinator.com', '+1 (212) 443-9516', 2012, NULL, 52, 'hired', '2026-01-07 07:14:41', '2026-01-07 07:16:17'),
(8, NULL, 'Nadine Woods', 'nekeceno@mailinator.com', '+1 (519) 305-3405', 1982, NULL, 94, 'rejected_final', '2026-01-07 07:14:53', '2026-01-07 07:14:53'),
(9, NULL, 'Dale Bates', 'cekyzipidu@mailinator.com', '+1 (608) 466-3872', 1975, NULL, 65, 'hired', '2026-01-07 08:10:07', '2026-01-07 10:09:54'),
(10, NULL, 'Acton Cash', 'myrarala@mailinator.com', '+1 (101) 842-9185', 2004, NULL, 24, 'hired', '2026-01-07 08:18:58', '2026-01-07 10:10:02'),
(11, NULL, 'Jaden Conrad', 'lexigiqud@mailinator.com', '+1 (259) 441-6875', 2009, NULL, 22, 'rejected_final', '2026-01-07 08:24:38', '2026-01-07 11:49:49'),
(12, NULL, 'Oliver Ballard', 'weheh@mailinator.com', '+1 (956) 271-8582', 1978, NULL, 98, 'rejected_first', '2026-01-07 08:30:00', '2026-01-07 11:34:18'),
(13, NULL, 'Brielle Woodward', 'zygycotuh@mailinator.com', '+1 (179) 141-5233', 1993, NULL, 90, 'passed_first', '2026-01-07 09:59:54', '2026-01-07 21:59:42'),
(14, NULL, 'Walter Bruce', 'pijypiq@mailinator.com', '+1 (731) 182-3424', 2005, NULL, 33, 'first_interview_completed', '2026-01-07 10:04:05', '2026-01-07 10:05:19'),
(15, NULL, 'Erin Tate', 'biqig@mailinator.com', '+1 (751) 382-9436', 1977, NULL, 35, 'hired', '2026-01-07 10:05:49', '2026-01-07 13:16:54'),
(16, NULL, 'Mohammad Sharpe', 'vyzoxefom@mailinator.com', '+1 (318) 611-9432', 2016, NULL, 22, 'rejected_final', '2026-01-07 11:04:58', '2026-01-07 13:15:49'),
(17, NULL, 'Owen Guy', 'mavosa@mailinator.com', '+1 (443) 332-3426', 2018, NULL, 48, 'rejected_first', '2026-01-07 11:09:00', '2026-01-07 11:26:05'),
(18, NULL, 'Vielka Martin', 'zomoze@mailinator.com', '+1 (216) 399-3058', 2013, NULL, 21, 'passed_first', '2026-01-07 11:16:00', '2026-01-07 13:00:09'),
(19, NULL, 'Charles Suarez', 'gaheh@mailinator.com', '+1 (653) 308-6578', 1988, NULL, 66, 'passed_first', '2026-01-07 11:23:24', '2026-01-07 12:47:21'),
(20, NULL, 'Addison Carpenter', 'cywox@mailinator.com', '+1 (992) 461-8196', 1982, NULL, 97, 'rejected_final', '2026-01-07 12:15:43', '2026-01-07 22:00:29'),
(21, NULL, 'Rahim Uddin', 'rahim123456@example.com', '01711111111', 3, '{\"ABC Ltd\":\"Junior Developer\",\"XYZ Tech\":\"Developer\"}', 26, 'second_interview_completed', '2026-01-07 12:27:53', '2026-01-07 20:00:29'),
(22, NULL, 'Karim Hasan', 'karim899@example.com', '01822222222', 5, '{\"SoftBD\":\"Software Engineer\",\"Brain Station\":\"Senior Engineer\"}', 30, 'first_interview_completed', '2026-01-07 12:27:54', '2026-01-07 13:15:27'),
(23, NULL, 'Nusrat Jahan', 'nusrat566789@example.com', '01933333333', 2, '{\"Creative IT\":\"Intern\",\"DataSoft\":\"Junior Engineer\"}', 24, 'pending', '2026-01-07 12:27:54', '2026-01-07 12:27:54'),
(24, NULL, 'Rahim Uddin', 'rahim3123456@example.com', '01711111111', 3, '{\"ABC Ltd\":\"Junior Developer\",\"XYZ Tech\":\"Developer\"}', 26, 'pending', '2026-01-07 12:40:08', '2026-01-07 12:40:08'),
(25, NULL, 'Karim Hasan', 'karim8939@example.com', '01822222222', 5, '{\"SoftBD\":\"Software Engineer\",\"Brain Station\":\"Senior Engineer\"}', 30, 'pending', '2026-01-07 12:40:08', '2026-01-07 12:40:08'),
(26, NULL, 'Nusrat Jahan', 'nusrat56336789@example.com', '01933333333', 2, '{\"Creative IT\":\"Intern\",\"DataSoft\":\"Junior Engineer\"}', 24, 'pending', '2026-01-07 12:40:08', '2026-01-07 12:40:08'),
(27, NULL, 'IGL Ibrahim', 'Iigl_ibrahim@gmail.com', '01787147988', 1, NULL, 24, 'hired', '2026-01-07 13:08:35', '2026-01-07 13:11:50'),
(28, NULL, 'Rahim Uddin', 'rahim31293456@example.com', '01711111111', 3, '{\"ABC Ltd\":\"Junior Developer\",\"XYZ Tech\":\"Developer\"}', 26, 'pending', '2026-01-07 13:14:18', '2026-01-07 13:14:43'),
(29, NULL, 'Karim Hasan', 'karim893944@example.com', '01822222222', 5, '{\"SoftBD\":\"Software Engineer\",\"Brain Station\":\"Senior Engineer\"}', 30, 'pending', '2026-01-07 13:14:18', '2026-01-07 13:14:18'),
(30, NULL, 'Nusrat Jahan', 'nusddrat56336789@example.com', '01933333333', 2, '{\"Creative IT\":\"Intern\",\"DataSoft\":\"Junior Engineer\"}', 24, 'first_interview_scheduled', '2026-01-07 13:14:18', '2026-01-07 20:17:14'),
(32, NULL, 'Bithi Akter', 'bithi@mailinator.com', '+1 (796) 707-5197', 3, NULL, 18, 'hired', '2026-01-07 19:56:31', '2026-01-07 19:59:32'),
(34, NULL, 'Ibrahim khan', 'ibrahimkhan450@mailinator.com', '+1 (859) 349-3083', 1987, NULL, 24, 'pending', '2026-01-07 20:13:56', '2026-01-07 20:13:56'),
(35, NULL, 'Ibrahim Khan', 'mribrahimkhan3608@gmail.com', '01930174750', 2, NULL, 25, 'rejected_first', '2026-01-07 20:16:10', '2026-01-07 20:17:48'),
(36, NULL, 'Ibrahim Khan', 'mribrahimkhan3607@gmail.com', '01930174751', 2, NULL, 25, 'hired', '2026-01-07 20:19:08', '2026-01-07 20:21:47'),
(38, NULL, 'Rahim Uddin', 'rahim3333@example.com', '01711111111', 3, '{\"ABC Ltd\":\"Junior Developer\",\"XYZ Tech\":\"Developer\"}', 26, 'pending', '2026-01-07 20:24:07', '2026-01-07 20:24:07'),
(39, NULL, 'Karim Hasan', 'karim8945@example.com', '01822222222', 5, '{\"SoftBD\":\"Software Engineer\",\"Brain Station\":\"Senior Engineer\"}', 30, 'pending', '2026-01-07 20:24:07', '2026-01-07 20:24:07'),
(40, NULL, 'Nusrat Jahan', 'nusddrat5789@example.com', '01933333333', 2, '{\"Creative IT\":\"Intern\",\"DataSoft\":\"Junior Engineer\"}', 24, 'pending', '2026-01-07 20:24:07', '2026-01-07 20:24:07'),
(41, NULL, 'Rahim Uddin', 'rahim_khan3333@example.com', '01711111111', 3, '{\"ABC Ltd\":\"Junior Developer\",\"XYZ Tech\":\"Developer\"}', 26, 'pending', '2026-01-07 20:27:18', '2026-01-07 20:27:18'),
(42, NULL, 'Karim Hasan', 'karim_khan8945@example.com', '01822222222', 5, '{\"SoftBD\":\"Software Engineer\",\"Brain Station\":\"Senior Engineer\"}', 30, 'pending', '2026-01-07 20:27:18', '2026-01-07 20:27:18'),
(43, NULL, 'Nusrat Jahan', 'abu_bakkar5789@example.com', '01933333333', 2, '{\"Creative IT\":\"Intern\",\"DataSoft\":\"Junior Engineer\"}', 24, 'pending', '2026-01-07 20:27:18', '2026-01-07 20:27:18'),
(44, NULL, 'Rahim Khan', 'rahim@gmail.com', '01930174752', 3, NULL, 24, 'hired', '2026-01-07 21:47:02', '2026-01-07 21:54:38'),
(45, NULL, 'Mahafuj', 'Mahafuj@gmail.com', '01930174753', 0, NULL, 30, 'rejected_first', '2026-01-07 21:57:11', '2026-01-07 21:59:15'),
(46, NULL, 'Rahim Uddin', 'rahim_khan340@example.com', '01711111111', 3, '{\"ABC Ltd\":\"Junior Developer\",\"XYZ Tech\":\"Developer\"}', 26, 'pending', '2026-01-07 22:03:12', '2026-01-07 22:03:12'),
(47, NULL, 'Karim Hasan', 'karim_khan789@example.com', '01822222222', 5, '{\"SoftBD\":\"Software Engineer\",\"Brain Station\":\"Senior Engineer\"}', 30, 'pending', '2026-01-07 22:03:12', '2026-01-07 22:03:12'),
(48, NULL, 'Nusrat Jahan', 'abu_bakkar589@example.com', '01933333333', 2, '{\"Creative IT\":\"Intern\",\"DataSoft\":\"Junior Engineer\"}', 24, 'pending', '2026-01-07 22:03:12', '2026-01-07 22:03:12'),
(49, NULL, 'Rahim Uddin', 'rahim_khan3400@example.com', '01711111111', 3, '{\"ABC Ltd\":\"Junior Developer\",\"XYZ Tech\":\"Developer\"}', 26, 'pending', '2026-01-07 22:05:24', '2026-01-07 22:05:24'),
(50, NULL, 'Karim Hasan', 'karim_khan7890@example.com', '01822222222', 5, '{\"SoftBD\":\"Software Engineer\",\"Brain Station\":\"Senior Engineer\"}', 30, 'pending', '2026-01-07 22:05:24', '2026-01-07 22:05:24'),
(51, NULL, 'Nusrat Jahan', 'abu_bakkar5890@example.com', '01933333333', 2, '{\"Creative IT\":\"Intern\",\"DataSoft\":\"Junior Engineer\"}', 24, 'pending', '2026-01-07 22:05:24', '2026-01-07 22:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interviews`
--

CREATE TABLE `interviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidate_id` bigint(20) UNSIGNED NOT NULL,
  `interview_type` enum('first','second') NOT NULL DEFAULT 'first',
  `scheduled_date` datetime NOT NULL,
  `status` enum('upcoming','completed') NOT NULL DEFAULT 'upcoming',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interviews`
--

INSERT INTO `interviews` (`id`, `candidate_id`, `interview_type`, `scheduled_date`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 'second', '2026-01-07 21:59:00', 'completed', NULL, '2026-01-07 07:00:13', '2026-01-07 07:07:42'),
(2, 4, 'second', '2026-01-07 21:59:00', 'completed', NULL, '2026-01-07 07:00:13', '2026-01-07 07:12:48'),
(3, 1, 'second', '2016-04-17 11:23:00', 'completed', NULL, '2026-01-07 07:12:21', '2026-01-07 07:12:21'),
(4, 5, 'second', '2016-04-17 11:23:00', 'completed', NULL, '2026-01-07 07:12:21', '2026-01-07 07:12:21'),
(5, 6, 'first', '1980-09-04 14:23:00', 'completed', NULL, '2026-01-07 07:13:57', '2026-01-07 07:13:57'),
(6, 7, 'first', '2026-01-07 19:17:00', 'completed', NULL, '2026-01-07 07:15:47', '2026-01-07 07:16:17'),
(7, 9, 'first', '2026-01-10 22:10:00', 'completed', NULL, '2026-01-07 08:11:35', '2026-01-07 08:13:10'),
(8, 10, 'first', '2017-03-28 02:23:00', 'completed', NULL, '2026-01-07 08:19:32', '2026-01-07 08:19:32'),
(9, 11, 'second', '2026-01-07 23:25:00', 'completed', NULL, '2026-01-07 08:25:37', '2026-01-07 08:25:47'),
(10, 13, 'first', '1999-05-08 09:05:00', 'completed', NULL, '2026-01-07 10:05:18', '2026-01-07 10:05:19'),
(11, 14, 'first', '1999-05-08 09:05:00', 'completed', NULL, '2026-01-07 10:05:18', '2026-01-07 10:05:19'),
(12, 12, 'first', '2026-01-08 22:06:00', 'completed', NULL, '2026-01-07 10:06:15', '2026-01-07 10:06:33'),
(13, 9, 'second', '2026-01-16 13:09:00', 'completed', NULL, '2026-01-07 10:09:22', '2026-01-07 10:09:42'),
(14, 10, 'second', '2026-01-16 13:09:00', 'completed', NULL, '2026-01-07 10:09:22', '2026-01-07 10:09:46'),
(15, 15, 'second', '1994-11-17 20:42:00', 'completed', NULL, '2026-01-07 11:04:27', '2026-01-07 11:04:28'),
(16, 16, 'first', '2026-01-09 13:05:00', 'completed', NULL, '2026-01-07 11:05:19', '2026-01-07 11:05:34'),
(17, 17, 'first', '2026-01-08 23:11:00', 'completed', NULL, '2026-01-07 11:09:26', '2026-01-07 11:10:06'),
(18, 18, 'first', '1985-03-20 19:44:00', 'completed', NULL, '2026-01-07 11:16:26', '2026-01-07 11:16:26'),
(19, 19, 'first', '2002-05-12 06:53:00', 'completed', NULL, '2026-01-07 11:23:49', '2026-01-07 11:23:49'),
(20, 20, 'first', '1976-12-21 01:27:00', 'completed', NULL, '2026-01-07 12:28:50', '2026-01-07 12:28:51'),
(21, 16, 'second', '2026-01-08 00:32:00', 'completed', NULL, '2026-01-07 12:30:10', '2026-01-07 12:30:19'),
(22, 21, 'first', '2026-01-10 01:45:00', 'completed', NULL, '2026-01-07 12:45:09', '2026-01-07 12:59:52'),
(23, 16, 'second', '2026-01-08 05:01:00', 'completed', NULL, '2026-01-07 13:01:51', '2026-01-07 13:02:08'),
(24, 27, 'first', '2026-01-08 03:09:00', 'completed', NULL, '2026-01-07 13:09:49', '2026-01-07 13:10:04'),
(25, 21, 'second', '2026-01-12 04:10:00', 'completed', NULL, '2026-01-07 13:10:55', '2026-01-07 20:00:29'),
(26, 27, 'second', '2026-01-12 04:10:00', 'completed', NULL, '2026-01-07 13:10:55', '2026-01-07 13:11:14'),
(27, 22, 'first', '2026-01-09 01:15:00', 'completed', NULL, '2026-01-07 13:15:15', '2026-01-07 13:16:26'),
(28, 22, 'first', '2026-01-09 01:15:00', 'completed', NULL, '2026-01-07 13:15:17', '2026-01-07 13:15:27'),
(29, 32, 'first', '2026-01-09 07:57:00', 'completed', NULL, '2026-01-07 19:57:07', '2026-01-07 19:57:49'),
(30, 32, 'second', '2026-01-13 10:00:00', 'completed', NULL, '2026-01-07 19:59:03', '2026-01-07 19:59:15'),
(31, 30, 'first', '2026-01-10 10:00:00', 'upcoming', NULL, '2026-01-07 20:17:14', '2026-01-07 20:17:14'),
(32, 35, 'first', '2026-01-10 10:00:00', 'completed', NULL, '2026-01-07 20:17:14', '2026-01-07 20:17:30'),
(33, 36, 'first', '2026-01-10 10:00:00', 'completed', NULL, '2026-01-07 20:19:56', '2026-01-07 20:20:05'),
(34, 20, 'second', '2026-01-12 10:20:00', 'completed', NULL, '2026-01-07 20:20:52', '2026-01-07 22:00:05'),
(35, 36, 'second', '2026-01-12 10:20:00', 'completed', NULL, '2026-01-07 20:20:52', '2026-01-07 20:21:06'),
(36, 44, 'first', '2026-01-09 09:00:00', 'completed', NULL, '2026-01-07 21:49:31', '2026-01-07 21:49:53'),
(37, 44, 'second', '2026-01-12 09:30:00', 'completed', NULL, '2026-01-07 21:53:42', '2026-01-07 21:54:07'),
(38, 45, 'first', '2026-01-13 09:30:00', 'completed', NULL, '2026-01-07 21:58:46', '2026-01-07 21:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_07_010706_add_role_to_users_table', 1),
(5, '2026_01_07_010803_create_candidates_table', 1),
(6, '2026_01_07_010831_create_interviews_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bGTfopezgKA34dl9998xs3RqHSWeZLXgl7gxoQgW', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS083VDc4b0dnOUtCcUk3VUlwTDVFejBrM3A0SzM4cTlSeTg2ZmltSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1767845279),
('Td1gyb9Mm1j73rStA1LaLHAvckmQ2SfOIEoA2CwZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibVM0cXRrYVVOeW1pTTdMRVFKZjdvZjNBT0hyZk1jT2xWd0tpWUpvWiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2ludGVydmlld3MvY29tcGxldGVkIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767839888);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','staff','candidate') NOT NULL DEFAULT 'candidate',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', 'admin', NULL, '$2y$12$wP6de.XWzYClvSrd/Dw93.FVSvlHdbsnC4S5Us9QHhfI4BL1Jme5.', 'h5vuEOKMzo5jxpD7t133R3c5agUXaZlOri81lAw5LjlBKPoG4jIcJSPXhi5b', '2026-01-06 19:28:59', '2026-01-06 19:28:59'),
(2, 'Staff User', 'staff@example.com', 'staff', NULL, '$2y$12$3ZmrSYTO9oVzCZVLPDdVoedmiVtW9bDaYSWrRYLYvRW3UN35Zfy/y', 'TJvFgj7LqJYFiXpegSryRT9NT10N0OP0vbaA02QoIfJ2nAgYRoVu9QYAR4Di', '2026-01-06 19:29:00', '2026-01-06 19:29:00'),
(3, 'Candidate User', 'candidate@example.com', 'candidate', NULL, '$2y$12$DtrY9.xAXtzQiWLihnQfHObz/r1dBaLIhmTKaTfWaPay2Fh98WkM2', NULL, '2026-01-06 19:29:00', '2026-01-06 19:29:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `candidates_email_unique` (`email`),
  ADD KEY `candidates_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `interviews`
--
ALTER TABLE `interviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interviews_candidate_id_foreign` (`candidate_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interviews`
--
ALTER TABLE `interviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `interviews`
--
ALTER TABLE `interviews`
  ADD CONSTRAINT `interviews_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
