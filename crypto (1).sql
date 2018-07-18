-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2018 at 12:11 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crypto`
--

-- --------------------------------------------------------

--
-- Table structure for table `coins`
--

CREATE TABLE `coins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coins`
--

INSERT INTO `coins` (`id`, `name`, `symbol`, `created_at`, `updated_at`) VALUES
(1, 'Bitcoin', 'BTC', NULL, NULL),
(2, 'Ethereum', 'ETH', NULL, NULL),
(3, 'Ripple', 'XRP', NULL, NULL),
(4, 'Bitcoin Cash', 'BCH', NULL, NULL),
(5, 'Cardano', 'ADA', NULL, NULL),
(6, 'Stellar', 'XLM', NULL, NULL),
(7, 'Litecoin', 'LTC', NULL, NULL),
(8, 'NEO', 'NEO', NULL, NULL),
(9, 'EOS', 'EOS', NULL, NULL),
(10, 'NEM', 'XEM', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coin_transactions`
--

CREATE TABLE `coin_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `coin_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `price` double NOT NULL,
  `commission` double(8,2) NOT NULL,
  `total_cost` double NOT NULL,
  `status` int(11) NOT NULL,
  `price_per_coin` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `point_transactions`
--

CREATE TABLE `point_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `point_type_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `point_transactions`
--

INSERT INTO `point_transactions` (`id`, `user_id`, `point_type_id`, `points`, `created_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 30000, '2018-01-28 17:30:00', '2018-01-29 04:12:21', '2018-01-29 04:12:21'),
(2, 2, 1, 30000, '2018-01-28 17:30:00', '2018-01-29 04:21:06', '2018-01-29 04:21:06'),
(3, 3, 1, 30000, '2018-01-28 17:30:00', '2018-01-29 04:38:47', '2018-01-29 04:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `point_types`
--

CREATE TABLE `point_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `point_types`
--

INSERT INTO `point_types` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'initial_reward', NULL, NULL),
(2, 'daily_reward', NULL, NULL),
(3, 'video_reward', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `facebook_id` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `last_login_date` timestamp NULL DEFAULT NULL,
  `net_coins` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `net_points` double NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `facebook_id`, `name`, `email`, `created_date`, `last_login_date`, `net_coins`, `net_points`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '533892266990312', 'Wai Yan Lynn', 'mr.kyawwaiyanlynn@gmail.com', '2018-01-29 10:42:21', '2018-01-29 10:43:04', 'a:10:{s:3:"BTC";i:0;s:3:"ETH";i:0;s:3:"XRP";i:0;s:3:"BCH";i:0;s:3:"ADA";i:0;s:3:"XLM";i:0;s:3:"LTC";i:0;s:3:"NEO";i:0;s:3:"EOS";i:0;s:3:"XEM";i:0;}', 30000, NULL, '2018-01-29 04:12:21', '2018-01-29 04:13:04'),
(2, '532757607096052', 'Hsu Linn Htet', NULL, '2018-01-29 10:51:06', '2018-01-29 11:08:35', 'a:10:{s:3:"BTC";i:0;s:3:"ETH";i:0;s:3:"XRP";i:0;s:3:"BCH";i:0;s:3:"ADA";i:0;s:3:"XLM";i:0;s:3:"LTC";i:0;s:3:"NEO";i:0;s:3:"EOS";i:0;s:3:"XEM";i:0;}', 30000, NULL, '2018-01-29 04:21:06', '2018-01-29 04:38:35'),
(3, '2033616853589894', 'အသည္းကြဲ ခ်စ္သူ', 'chukolay@gmail.com', '2018-01-29 11:08:47', '2018-01-29 11:08:51', 'a:10:{s:3:"BTC";i:0;s:3:"ETH";i:0;s:3:"XRP";i:0;s:3:"BCH";i:0;s:3:"ADA";i:0;s:3:"XLM";i:0;s:3:"LTC";i:0;s:3:"NEO";i:0;s:3:"EOS";i:0;s:3:"XEM";i:0;}', 30000, NULL, '2018-01-29 04:38:47', '2018-01-29 04:38:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coins`
--
ALTER TABLE `coins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coin_transactions`
--
ALTER TABLE `coin_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_transactions`
--
ALTER TABLE `point_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_types`
--
ALTER TABLE `point_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coins`
--
ALTER TABLE `coins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `coin_transactions`
--
ALTER TABLE `coin_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `point_transactions`
--
ALTER TABLE `point_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `point_types`
--
ALTER TABLE `point_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
