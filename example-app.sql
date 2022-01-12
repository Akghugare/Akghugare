-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2021 at 03:57 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `example-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('I','A') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `state_id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Nagpur', 'A', '2021-08-29 00:06:10', '2021-08-29 00:06:10'),
(2, 1, 1, 'Amravati', 'A', '2021-08-29 00:06:10', '2021-08-29 00:06:10'),
(3, 1, 1, 'Yavatmal', 'A', '2021-08-29 00:06:10', '2021-08-29 00:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('I','A') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'India', 'A', '2021-08-28 23:59:09', '2021-08-28 23:59:09'),
(2, 'Pakistan', 'A', '2021-08-28 23:59:09', '2021-08-28 23:59:09'),
(3, 'China', 'I', '2021-08-28 23:59:09', '2021-08-28 23:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `hobbies`
--

CREATE TABLE `hobbies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('I','A') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hobbies`
--

INSERT INTO `hobbies` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Playing', 'A', '2021-09-04 18:53:06', '2021-09-04 18:53:06'),
(2, 'Reading', 'A', '2021-09-04 18:53:06', '2021-09-04 18:53:06'),
(3, 'Singing', 'A', '2021-09-04 18:53:34', '2021-09-04 18:53:34'),
(4, 'Watching', 'I', '2021-09-04 18:53:34', '2021-09-04 18:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('I','A') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English', 'A', '2021-09-04 09:52:13', '2021-09-04 09:52:13'),
(2, 'Hindi', 'A', '2021-09-04 09:52:13', '2021-09-04 09:52:13'),
(3, 'Marathi', 'A', '2021-09-04 18:52:25', '2021-09-04 18:52:25'),
(4, 'Gujrati', 'I', '2021-09-04 18:52:25', '2021-09-04 18:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('I','A') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Manager', 'A', '2021-08-28 23:44:05', '2021-08-28 23:44:05'),
(2, 'Admin', 'A', '2021-08-28 23:44:05', '2021-08-28 23:44:05'),
(3, 'User', 'A', '2021-08-28 23:44:05', '2021-08-28 23:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('I','A') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Maharashtra', 'A', '2021-08-29 00:01:25', '2021-08-29 00:01:25'),
(2, 1, 'Gujrat', 'A', '2021-08-29 00:01:25', '2021-08-29 00:01:25'),
(3, 1, 'Punjab', 'I', '2021-08-29 00:01:25', '2021-08-29 00:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `show_password` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `dob` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `hobby_id` varchar(255) NOT NULL,
  `language_id` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `pincode` int(11) NOT NULL,
  `address` text NOT NULL,
  `is_login` enum('N','Y') NOT NULL,
  `login_attempt` int(11) NOT NULL DEFAULT 0,
  `status` enum('I','P','A') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `show_password`, `mobile`, `dob`, `image`, `country_id`, `state_id`, `city_id`, `role_id`, `hobby_id`, `language_id`, `gender`, `pincode`, `address`, `is_login`, `login_attempt`, `status`, `created_at`, `updated_at`) VALUES
(6, 'json parse', 'json@parse.com', '$2y$10$2D3bqH7F3v6IdWtwcE3aBuRq.1R49qzy9LRrBBi/k84d5ENjrYKsO', '1100', 8888888888, NULL, 'c7925076c52867768c28a5b9ea6d7b56.jpg', 1, 1, 1, 1, '1, 2', '1, 2', 'Male', 440013, 'it park nagpur', 'N', 3, 'A', '2021-09-05 09:05:26', '2021-09-05 09:09:38'),
(7, 'test demo', 'test@demo.com', '$2y$10$uU4gCtlMKTI3gGqUJ6X0CurVVp20WDa0G.o6kkuoInwCF.hKVZF1O', '1100', 9999999999, '2021-08-03', '0e359713b6609ee83a64d99cce71eeb2.jpg', 1, 1, 1, 3, '1, 2, 3', '1, 2, 3', 'Male', 440013, 'it park', 'Y', 0, 'A', '2021-09-05 09:08:29', '2021-09-05 12:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
