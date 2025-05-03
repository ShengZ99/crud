-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 11:21 AM
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
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'zs', 'zsp1911999@gmail.com', '0123456789', '$2y$12$KcpUIQ5Enm3XQcmErtGNuu1vYAGw/7g.5txCxhS8hK0pqiLCI5/Mm', 'active', '2025-05-02 20:56:46', '2025-05-02 21:16:23', NULL),
(2, 'qq', 'pzs1911999@gmail.com', '0123456788', '$2y$12$pte/L.Wr7r3eXvII79UuHekTHyV7E2Ve9YRs.8mTiohOVneXyXCGu', 'active', '2025-05-02 20:57:43', '2025-05-02 20:57:43', NULL),
(3, 'aa', 'aa@gmail.com', '0123456787', '$2y$12$bB6IiRQ6osKHr.t5Y1hH5.fbczaqX0BapHZKl454fX4k.FC.Q3NMa', 'active', '2025-05-02 21:42:03', '2025-05-03 00:09:00', NULL),
(4, 'ww', 'ww@gmail.com', '0123456786', '$2y$12$EwTtaK9kTTFNXu/wSKHy6eLdsKrys6u4UeyDOQcc4NknEVVFyVf2W', 'active', '2025-05-03 00:26:50', '2025-05-03 00:26:50', NULL),
(5, 'test', 'test@gmail.com', '0123456785', '$2y$12$vLL6kM59UUhSPZ/oYmvO9udSmBsXXnKDb2a3atOQUZVATPmvhSJNa', 'active', '2025-05-03 00:59:25', '2025-05-03 01:07:49', '2025-05-03 01:07:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
