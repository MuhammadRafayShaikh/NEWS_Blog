-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 05:22 PM
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
-- Database: `laravel_news`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `post` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `post`) VALUES
(30, 'Entertainment', 5),
(32, 'Politics', 4),
(33, 'road', 1),
(34, 'Dacoti', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `views` int(11) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `description`, `category`, `author`, `post_img`, `created_at`, `views`, `updated_at`) VALUES
(61, 'admin1', 'admin1', '30', 41, '1728844504.png', '2024-12-11 13:13:05', 1, '2024-12-10 19:04:19'),
(62, 'admin1', 'second', '30', 41, '1728845148.webp', '2024-12-11 13:13:05', 1, '2024-12-11 12:40:02'),
(63, 'user1', 'user1 first', '30', 42, '1728848165.webp', '2024-12-11 16:15:58', 1, '2024-12-11 11:15:58'),
(64, 'user2', 'user2 first', '30', 42, '1728929769.png', '2024-12-11 16:14:36', 0, '2024-12-11 16:14:36'),
(65, 'entertainment 4', 'entertainment is the best way ', '32', 41, '1728929783.webp', '2024-12-11 13:13:05', 0, '2024-12-11 12:40:06'),
(66, 'admin latest', 'latest news', '33', 41, '1728929797.png', '2024-12-11 16:15:45', 1, '2024-12-11 11:15:45'),
(67, 'abc', 'lorem ipsum', '30', 41, '1728929931.webp', '2024-12-11 16:15:49', 1, '2024-12-11 11:15:49'),
(68, 'Breaking news', 'lorem ipsum', '32', 41, '1733922815.png', '2024-12-11 16:15:38', 1, '2024-12-11 11:15:38');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `website_name` varchar(70) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `footer` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`website_name`, `logo`, `footer`) VALUES
('NEWS Blog', 'news.jpg', '© Copyright 2021 NEWS | <a href=\"https://muhammadrafayshaikh.github.io/Monument/\" target=\"blank\">Muhammad Rafay Shaikh</a>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES
(42, 'Sana', 'Khan', 'sana@gmail.com', '$2y$12$DePfdBgVug8YWK1nKYF2.O1UcBUjyxMkbeDLM1g8dGmySgoCaYzXq', 0),
(41, 'Muhammad', 'Rafay', 'rafayshaikh405@gmail.com', '$2y$12$THfyqq71vJHpw4gEUpEUW.w46IG1Ji4ajvWMI/c7As0HPdgsuFRRO', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`),
  ADD KEY `fk_author` (`author`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
