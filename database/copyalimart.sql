-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2025 at 07:59 PM
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
-- Database: `copyalimart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(200, 3, 2, 1),
(441, 2, 17, 3),
(442, 2, 13, 5),
(456, 1, 13, 3),
(457, 1, 11, 3),
(460, 1, 14, 1),
(461, 1, 16, 4),
(462, 1, 21, 2),
(463, 1, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image2` varchar(300) NOT NULL,
  `image3` varchar(300) NOT NULL,
  `image4` varchar(300) NOT NULL,
  `image5` varchar(300) NOT NULL,
  `fullname` varchar(300) NOT NULL,
  `product_details` varchar(1000) NOT NULL,
  `price` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `image2`, `image3`, `image4`, `image5`, `fullname`, `product_details`, `price`) VALUES
(11, 'video game', 'images/videogame.jpg', 'images/videogame1.jpg', 'images/videogame3.jpg', 'images/videogame4.jpg', 'images/vieogame2.jpg', 'Xbox Series Wireless Controller', 'Placerat tempor dolor eu leo ullamcorper et magnis habitant ultrices consectetur arcu nulla mattis fermentum adipiscing a et bibendum sed platea malesuada eget vestibulum', '25,300.00'),
(12, 'airpods', 'images/airdrops1.jpg', 'images/airdrops2.jpg', 'images/airdrops3.jpg', 'images/airdrops4.jpg', 'images/', 'Airdopes 125 PRO', 'Placerat tempor dolor eu leo ullamcorper et magnis habitant ultrices consectetur arcu nulla mattis fermentum adipiscing a et bibendum sed platea malesuada eget vestibulum.', '4,300.00'),
(13, 'camera', 'images/camera1.jpg', 'images/camera2.jpg', 'images/camera3.jpg', 'images/camera4.jpg', 'images/camera5.jpg', 'Smart Outdoor Camera', 'Placerat tempor dolor eu leo ullamcorper et magnis habitant ultrices consectetur arcu nulla mattis fermentum adipiscing a et bibendum sed platea malesuada eget vestibulum.', '16,900.00'),
(14, 'speaker', 'images/comspe1.jpg', 'images/comspe2.jpg', 'images/comspe3.jpg', 'images/comspe4.jpg', 'images/comspe5.jpg', '10 Watt Wired Computer Speakers', 'Carry your party with you wherever you go with this Powerful Bluetooth speaker. Packed with a number of impressive features, including 10 hours of playback time, a waterproof design and...', '8,500.00'),
(15, 'drone', 'images/drone.jpg', 'images/drone1.jpg', 'images/drone5.jpg', 'images/drone6.jpg', 'images/', 'Mini Drone FlyCam Quadcopter', 'Placerat tempor dolor eu leo ullamcorper et magnis habitant ultrices consectetur arcu nulla mattis fermentum adipiscing a et bibendum sed platea malesuada eget vestibulum.', '84,200.00'),
(16, 'laptop', 'images/laptop1.jpg', 'images/laptop2.jpg', 'images/laptop3.jpg', 'images/laptop4.jpg', 'images/laptop5.jpg', 'MSI Modern 15 Laptop', 'Placerat tempor dolor eu leo ullamcorper et magnis habitant ultrices consectetur arcu nulla mattis fermentum adipiscing a et bibendum sed platea malesuada eget vestibulum.', '101,000.00'),
(17, 'LED', 'images/led.jpg', 'images/led1.jpg', 'images/led3.jpg', 'images/led4.jpg', 'images/', 'AUE65 Crystal 4K UHD Smart TV', 'Placerat tempor dolor eu leo ullamcorper et magnis habitant ultrices consectetur arcu nulla mattis fermentum adipiscing a et bibendum sed platea malesuada eget vestibulum.', '33,700.00'),
(18, 'PHONE', 'images/mobile1.jpg', 'images/mobile2.jpg', 'images/mobile3.jpg', 'images/phone1.jpg', 'images/phone.jpg', 'Samsung S201FE White', 'Placerat tempor dolor eu leo ullamcorper et magnis habitant ultrices consectetur arcu nulla mattis fermentum adipiscing a et bibendum sed platea malesuada eget vestibulum.', '75,800.00'),
(19, 'SONY', 'images/smallspeaker1.jpg', 'images/smallspeaker3.jpg', 'images/smallspeaker2.jpg', 'images/smallspeaker4.jpg', 'images/smallspeaker5.jpg', 'Wireless Extra Bass Speaker', 'Placerat tempor dolor eu leo ullamcorper et magnis habitant ultrices consectetur arcu nulla mattis fermentum adipiscing a et bibendum sed platea malesuada eget vestibulum.', '8,500.00'),
(20, 'TABLET', 'images/tablet.jpg', 'images/tablet1.jpg', 'images/tablet2.jpg', 'images/tablet3.jpg', 'images/tablet4.jpg', '10.2-inch iPad 9th Gen Black', 'Placerat tempor dolor eu leo ullamcorper et magnis habitant ultrices consectetur arcu nulla mattis fermentum adipiscing a et bibendum sed platea malesuada eget vestibulum.', '50,500.00'),
(21, 'WATCH', 'images/watch1.jpg', 'images/watch2.jpg', 'images/watch3.jpg', 'images/watch4.jpg', 'images/watch5.jpg', 'Reflex Play AMOLED Display', 'The Fixer GTR 2 is here to make your fitness goals more achievable with its 90 different sports modes, heart rate monitoring, stress-level monitoring, and more. Oh, and it lets...', '4,300.00'),
(22, 'ULED', 'images/uled1.jpg', 'images/uled2.jpg', 'images/uled3.jpg', 'images/uled4.jpg', 'images/uled5.jpg', '32 inch HD Smart LED TV', 'Placerat tempor dolor eu leo ullamcorper et magnis habitant ultrices consectetur arcu nulla mattis fermentum adipiscing a et bibendum sed platea malesuada eget vestibulum.', '42100.00');

-- --------------------------------------------------------

--
-- Table structure for table `product_id`
--

CREATE TABLE `product_id` (
  `pro_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quick`
--

CREATE TABLE `quick` (
  `id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `pass`) VALUES
(1, 'sajid', 'ali', 'alisajid@gmail.com', '$2y$10$6RR00GHuDgc9wpnLg6e/9efaO7wMDt5WFAlM0I1jKzLZAI03s2Xla'),
(2, 'mohd', 'hussain', 'mohdhussain@gmail.com', '$2y$10$QjM8Lo6S6MlGplHxqFNgrey4//ofiRhJlilogybBHyrKPJpeoSooC'),
(3, 'amit ', 'sevda', 'amitsevda@gmail.com', '$2y$10$4LmFl7yFLgPMcPBtYn1bC.jHr29RS1r3RZMmACj6n.mtnivnOswAG'),
(4, 'gyuhijkl', 'yuhbijnkml', 'rftgyhujk@gmail.com', '$2y$10$l75rfbudAwLczeLIjtKOkeRde1Ix.AS1lzayPziF5vq/JQpB.66xe');

-- --------------------------------------------------------

--
-- Table structure for table `wishid`
--

CREATE TABLE `wishid` (
  `w_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`) VALUES
(277, 2, 13),
(295, 2, 17),
(307, 2, 12),
(308, 2, 14),
(309, 1, 16),
(329, 1, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=464;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
