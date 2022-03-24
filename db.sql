-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:33060
-- Generation Time: Mar 24, 2022 at 08:37 AM
-- Server version: 10.7.3-MariaDB-log
-- PHP Version: 8.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `name` varchar(50) NOT NULL,
  `avatar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `name`, `avatar`) VALUES
(1, 'admin@admin.com', '$2y$10$frL9MvImSDZTMkmzXUUNXOwtNjcmdWmTU0peYHopRqstnIO4Yy.9W', 'Gimmey', 'avatar.png'),
(2, 'gdelagua1@w3.org', '$2y$10$frL9MvImSDZTMkmzXUUNXOwtNjcmdWmTU0peYHopRqstnIO4Yy.9W', 'Gene', 'avatar.png'),
(3, 'cisakov2@live.com', '$2y$10$frL9MvImSDZTMkmzXUUNXOwtNjcmdWmTU0peYHopRqstnIO4Yy.9W', 'Cleveland', 'avatar.png'),
(4, 'tbeeston3@youtube.com', '$2y$10$frL9MvImSDZTMkmzXUUNXOwtNjcmdWmTU0peYHopRqstnIO4Yy.9W', 'Townsend', 'avatar.png'),
(5, 'rstetson4@washington.edu', '$2y$10$frL9MvImSDZTMkmzXUUNXOwtNjcmdWmTU0peYHopRqstnIO4Yy.9W', 'Renaldo', 'avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`) VALUES
(1, 'Hot drinks'),
(2, 'Soft drinks'),
(3, 'icecreams'),
(4, 'zbady_Khalat');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_status` enum('processing','done') NOT NULL DEFAULT 'processing',
  `total_amount` float UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_date`, `order_status`, `total_amount`, `user_id`) VALUES
(35, '2022-03-19 23:20:57', 'done', 90.23, 1),
(38, '2022-03-21 01:06:00', 'processing', 457.47, 1),
(41, '2022-03-23 20:25:00', 'processing', 98.21, 1),
(44, '2022-03-24 03:19:08', 'processing', 25.26, 1),
(45, '2022-03-24 03:25:47', 'done', 27.44, 1),
(47, '2022-03-24 03:31:37', 'done', 106.79, 1),
(53, '2022-03-24 04:10:48', 'processing', 22.5, 1),
(54, '2022-03-24 04:43:38', 'processing', 273.69, 5),
(55, '2022-03-24 04:47:33', 'processing', 69.79, 3),
(56, '2022-03-24 04:52:11', 'done', 69.79, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `quantity` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`quantity`, `product_id`, `order_id`) VALUES
(1, 7, 35),
(1, 11, 35),
(1, 12, 35),
(1, 4, 38),
(1, 6, 38),
(6, 7, 38),
(3, 11, 38),
(1, 12, 38),
(1, 17, 38),
(3, 20, 38),
(4, 21, 38),
(1, 6, 41),
(1, 7, 41),
(1, 11, 41),
(1, 7, 44),
(1, 10, 44),
(1, 5, 45),
(1, 5, 47),
(1, 6, 47),
(2, 7, 47),
(1, 20, 53),
(1, 21, 53),
(1, 6, 54),
(1, 11, 54),
(1, 17, 54),
(1, 18, 54),
(1, 20, 54),
(2, 21, 54),
(1, 6, 55),
(1, 7, 55),
(1, 6, 56),
(1, 7, 56);

-- --------------------------------------------------------

--
-- Table structure for table `password_rest`
--

CREATE TABLE `password_rest` (
  `id` int(11) NOT NULL,
  `reset_token` varchar(60) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `prd_name` varchar(50) NOT NULL,
  `available` tinyint(1) DEFAULT 1,
  `price` float UNSIGNED NOT NULL,
  `image` varchar(150) NOT NULL,
  `cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `prd_name`, `available`, `price`, `image`, `cat_id`) VALUES
(4, 'Pepper - Red Chili', 1, 68.84, 'Pepper---Red-Chili_image.jpeg', 1),
(5, 'Bagel - Sesame Seed Presliced', 0, 27.44, 'Coffe-1_image.jpeg', 2),
(6, 'Sobe - Berry Energy', 1, 60.23, 'Coffe-1_image.jpeg', 2),
(7, 'Oil - Sesame', 1, 9.56, 'Coffe-1_image.jpeg', 2),
(8, 'Lamb - Shanks', 0, 11.64, 'Coffe-1_image.jpeg', 2),
(10, 'Cookies - Englishbay Chochip', 0, 15.7, 'Coffe-1_image.jpeg', 3),
(11, 'Pastry - Raisin Muffin - Mini', 1, 28.42, 'Coffe-1_image.jpeg', 3),
(12, 'Pork - Bacon Cooked Slcd', 1, 52.25, 'Coffe-1_image.jpeg', 3),
(13, 'Carrots - Jumbo', 0, 62.71, 'Coffe-1_image.jpeg', 3),
(15, 'Croissant, Raw - Mini', 0, 29.84, 'Coffe-1_image.jpeg', 4),
(16, 'Bar Energy Chocchip', 0, 13.24, 'Coffe-1_image.jpeg', 4),
(17, 'White Baguette', 1, 56.03, 'Coffe-1_image.jpeg', 4),
(18, 'Ice Cream Bar - Hageen Daz To', 0, 96.51, 'Coffe-1_image.jpeg', 4),
(20, 'Coffe 1', 1, 12.5, 'Coffe-1_image.jpeg', 1),
(21, 'Nescafe', 1, 10, 'Nescafe_image.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `name` varchar(50) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `room` varchar(50) NOT NULL,
  `ext` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `avatar`, `room`, `ext`) VALUES
(1, 'user@user.com', '$2y$10$CQ98FyczVIMBkKBSw0Xh9uQcquvWj1Rl0DrtvGQ/yM6X73wlrWstK', 'Dona Clout', 'userusercom_avatar.jpeg', '596', '1'),
(2, 'agerhts1@fc2.com', '$2y$10$Q5f3IHhbDQOFwrFxlNvHZOq7VQikpmDzoEHNOsOW/7dT1LsspUVCS', 'Aurelia Gerhts', 'mgnet55yahoocom_avatar.jpeg', '2235', '2'),
(3, 'gellacombe2@squidoo.com', '$2y$10$Q5f3IHhbDQOFwrFxlNvHZOq7VQikpmDzoEHNOsOW/7dT1LsspUVCS', 'Geoffrey Ellacombe', 'mgnet55yahoocom_avatar.jpeg', '230', '3'),
(4, 'cdyers3@patch.com', '$2y$10$Q5f3IHhbDQOFwrFxlNvHZOq7VQikpmDzoEHNOsOW/7dT1LsspUVCS', 'Carmelita Dyers', 'mgnet55yahoocom_avatar.jpeg', '91635', '4'),
(5, 'rwaplinton4@unblog.fr', '$2y$10$vFIzT2b95PMHK08nHlL4kexc0Xvr1GWjYoLBoqevAopfx6nT3DVzm', 'Rosalind Waplinton', 'rwaplinton4unblogfr_avatar.png', '16', '5'),
(10, 'test@test.com', '$2y$10$xn871Df1wfF14gt25r2XDuzQqB6IdvQL0VkPEElM2fzGbI.ZAO4aa', 'Mina Gamal', 'testtestcom_avatar.jpeg', '12', '1212');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `order_products_ibfk_1` (`product_id`);

--
-- Indexes for table `password_rest`
--
ALTER TABLE `password_rest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `password_rest`
--
ALTER TABLE `password_rest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
