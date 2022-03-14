-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 14, 2022 at 12:44 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `name`, `avatar`) VALUES
(1, 'admin@admin.com', '$2y$10$7iIrWgJtV1n29wIoVMaqz.d02ma2bmbHxqamZ3aIq5i8Tsrb8p6qS', 'teststes', 'img.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `avatar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `avatar`) VALUES
(1, 'beldred0@cpanel.net', '81xMKon', 'Baxie Eldred', 'http://dummyimage.com/77x57.png/ff4444/ffffff'),
(2, 'lboncoeur1@howstuffworks.com', 'Tlfu0IrGNkL', 'Livia Boncoeur', 'http://dummyimage.com/82x82.png/5fa2dd/ffffff'),
(3, 'kungaretti2@cdbaby.com', 'KbyuMppDU', 'Kira Ungaretti', 'http://dummyimage.com/86x88.png/cc0000/ffffff'),
(4, 'wjosebury3@netlog.com', 'FenS4Fd9W', 'Wynny Josebury', 'http://dummyimage.com/95x84.png/ff4444/ffffff'),
(5, 'gwhitechurch4@opensource.org', 'Vqe5BTe1qq3o', 'Giacobo Whitechurch', 'http://dummyimage.com/59x63.png/ff4444/ffffff'),
(6, 'dmurton5@yolasite.com', 'bo6JjA1O', 'Darryl Murton', 'http://dummyimage.com/70x76.png/dddddd/000000'),
(7, 'cmickelwright6@shutterfly.com', 'hlyXbdRg', 'Corty Mickelwright', 'http://dummyimage.com/52x64.png/5fa2dd/ffffff'),
(8, 'cstrowger7@technorati.com', '73ACTLf', 'Clerc Strowger', 'http://dummyimage.com/56x55.png/cc0000/ffffff'),
(9, 'sipplett8@macromedia.com', 'm3Z7Gv', 'Sondra Ipplett', 'http://dummyimage.com/65x96.png/5fa2dd/ffffff'),
(10, 'dglasser9@sitemeter.com', 'vkdi3dojdZuJ', 'Danita Glasser', 'http://dummyimage.com/51x88.png/cc0000/ffffff'),
(11, 'jlindenmana@behance.net', '0UPnd5', 'Jedidiah Lindenman', 'http://dummyimage.com/82x66.png/dddddd/000000'),
(12, 'mkunkelb@admin.ch', '5EwRJ2', 'Magda Kunkel', 'http://dummyimage.com/54x62.png/ff4444/ffffff'),
(13, 'dbingec@youku.com', 'LuCo9P0P', 'Dania Binge', 'http://dummyimage.com/84x61.png/cc0000/ffffff'),
(14, 'kmuccinod@weibo.com', 'frVb0n', 'Kylynn Muccino', 'http://dummyimage.com/67x54.png/5fa2dd/ffffff'),
(15, 'bmessere@over-blog.com', '8MhfeffNVW', 'Bruis Messer', 'http://dummyimage.com/92x77.png/dddddd/000000'),
(16, 'elowensohnf@netlog.com', 'BSqAzDbMd', 'Errick Lowensohn', 'http://dummyimage.com/83x62.png/5fa2dd/ffffff'),
(17, 'wpostinsg@vinaora.com', '1qH0oscV1hDi', 'Wilmette Postins', 'http://dummyimage.com/86x80.png/dddddd/000000'),
(18, 'fgoskarh@gmpg.org', 'dqb6Sg5z7ph', 'Free Goskar', 'http://dummyimage.com/62x55.png/ff4444/ffffff'),
(19, 'kgilliveri@amazon.co.uk', '9lZn36Zl', 'Kinnie Gilliver', 'http://dummyimage.com/93x72.png/5fa2dd/ffffff'),
(20, 'elansberryj@51.la', '3iN0ex', 'Else Lansberry', 'http://dummyimage.com/64x52.png/5fa2dd/ffffff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
