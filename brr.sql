-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 03:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('roharzan@gmail.com', '$2y$10$X0SW9.w3zDu79zCgf2xRgeIwLhl700gBXfw/Uax0Nd5Fj9uZ5rLGi');

-- --------------------------------------------------------

--
-- Table structure for table `delivered`
--

CREATE TABLE `delivered` (
  `id` int(11) NOT NULL,
  `order_id` varchar(14) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `delivered_date` varchar(10) DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT 'Default Address',
  `order_note` text DEFAULT 'No notes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivered`
--

INSERT INTO `delivered` (`id`, `order_id`, `user_email`, `user_phone`, `total_amount`, `payment_mode`, `delivered_date`, `delivery_address`, `order_note`) VALUES
(13, '20240303145832', 'roharzan@gmail.com', '9861767923', 10959, 'Cash On Delivery', '2024-02-03', 'Kathmandu', 'No notes'),
(14, '20240303142321', 'roharzan@gmail.com', '9861767923', 1260, 'Cash On Delivery', '2024-03-03', 'Kimdole, Kathmandu1', 'hi'),
(15, '20240303155511', 'ram@gmail.com', '9841499333', 2559, 'Cash On Delivery', '2024-03-08', 'Tahachal, Kathmandu', 'hello'),
(16, '20240308021056', 'roharzan@gmail.com', '9861767923', 3660, 'Cash On Delivery', '2024-03-19', 'Kimdole, Kathmandu11', 'hello '),
(57, '1', '', NULL, 46, '', '2024-03-29', 'Default Address', 'No notes'),
(58, '2', '', NULL, 7234, '', '2024-04-25', 'Default Address', 'No notes'),
(59, '3', '', NULL, 32, '', '2024-02-01', 'Default Address', 'No notes'),
(60, '4', '', NULL, 517, '', '2024-01-12', 'Default Address', 'No notes'),
(61, '5', '', NULL, 539, '', '2024-01-20', 'Default Address', 'No notes'),
(62, '6', '', NULL, 591, '', '2024-01-04', 'Default Address', 'No notes'),
(63, '7', '', NULL, 376, '', '2024-03-15', 'Default Address', 'No notes'),
(64, '8', '', NULL, 828, '', '2024-02-05', 'Default Address', 'No notes'),
(65, '9', '', NULL, 354, '', '2024-03-28', 'Default Address', 'No notes'),
(66, '10', '', NULL, 282, '', '2024-03-19', 'Default Address', 'No notes'),
(67, '20240303153702', 'roharzan@gmail.com', '9861767923', 2060, 'Cash On Delivery', '2024-04-28', 'Kimdole, Kathmandu, Npl', 'hello test');

-- --------------------------------------------------------

--
-- Table structure for table `mycart`
--

CREATE TABLE `mycart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `usersize` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mycart`
--

INSERT INTO `mycart` (`id`, `product_id`, `username`, `usersize`, `quantity`) VALUES
(111, 9, 'rojan1234@gmail.com', 'L', 1),
(140, 7, 'roharzan@gmail.com', 'M', 1),
(142, 2, 'rojan123@gmail.com', 'S', 1),
(143, 5, 'lee@gmail.com', 'S', 1),
(144, 9, 'lee@gmail.com', 'L', 1),
(145, 3, 'lee@gmail.com', 'L', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(14) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `order_date` varchar(10) DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT 'Default Address',
  `order_note` text DEFAULT 'No notes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_email`, `user_phone`, `total_amount`, `payment_mode`, `order_date`, `delivery_address`, `order_note`) VALUES
(85, '20240428150036', 'rojan123@gmail.com', '9810047538', 3660, 'Cash On Delivery', '2024-04-28', 'Kimdole, Kathmanduu', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` varchar(14) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `usersize` varchar(5) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `usersize`, `quantity`) VALUES
(86, '20240303142321', 8, 'S', 1),
(91, '20240303145832', 9, 'S', 1),
(92, '20240303145832', 6, 'L', 1),
(93, '20240303145832', 5, 'XL', 1),
(94, '20240303145832', 1, 'M', 1),
(95, '20240303153702', 3, 'L', 1),
(96, '20240303155511', 6, 'S', 1),
(97, '20240308021056', 9, 'M', 1),
(98, '20240428150036', 9, 'S', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'Others',
  `product_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `category`, `product_image`, `description`) VALUES
(1, 'Plain Black Hoodie', 1500, 'Hoodies', 'images/65d30bdc2fb0b.png', 'velvet fabic heavy black hoodie made in china. High quality product'),
(2, 'Floral Shirt', 1300, 'Others', 'images/65d0bb9a5f84c.png', 'High quality is floral summer tshirt made with 95% cotton and 5% polyster'),
(3, 'Urban City Jacket', 2000, 'Jackets', 'images/jacket 2.png', 'Korean Style urban city jacket. Made in korea'),
(4, 'Baseball Jacket', 4200, 'Jackets', 'images/jacket-removebg-preview.png', 'Butter scotch baseball jacket for casual wears and unisex.'),
(5, 'Mclean Shirt', 3300, 'T-Shirts', 'images/tshirt-removebg-preview.png', 'this is 3 color embeded neutral t-shirt'),
(6, 'Cargo Jockers', 2499, 'Jockers', 'images/cargo jockers.png', 'Gents Fashion Trend Joker Loose Casual Elastic Waist Tooling Leggings Pants'),
(7, 'Plain Sweatshirt', 1999, 'Sweatshirts', 'images/sweatshirt.png', 'Plain sweatshirt made in china. Made with high quality fabric.'),
(8, 'Jeans Pant', 1200, 'Pants', 'images/65d30f0545292.png', 'Hight quality Jeans pant  made in indian made with top notch fabic. Limited stock avaliable'),
(9, 'Tri-color Sweatshirt', 3600, 'Sweatshirts', 'images/sweater@2x.png', 'High quality sweatshirt made in korea with sheep wool. Limited piece imported.');

-- --------------------------------------------------------

--
-- Table structure for table `productsizes`
--

CREATE TABLE `productsizes` (
  `fk_product_id` int(11) NOT NULL,
  `size` varchar(2) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productsizes`
--

INSERT INTO `productsizes` (`fk_product_id`, `size`, `quantity`) VALUES
(1, 'S', 0),
(1, 'M', 16),
(1, 'L', 233),
(1, 'XL', 22),
(2, 'S', 9),
(2, 'M', 9),
(2, 'L', 9),
(2, 'XL', 10),
(3, 'S', 41),
(3, 'M', 23),
(3, 'L', 34),
(3, 'XL', 15),
(4, 'S', -2),
(4, 'M', 6),
(4, 'L', 2),
(4, 'XL', 5),
(5, 'S', 6),
(5, 'M', 3),
(5, 'L', 1),
(5, 'XL', 0),
(6, 'S', 7),
(6, 'M', 16),
(6, 'L', 13),
(6, 'XL', -3),
(7, 'S', 9),
(7, 'M', 10),
(7, 'L', 9),
(7, 'XL', 10),
(8, 'S', 8),
(8, 'M', 6),
(8, 'L', 7),
(8, 'XL', 9),
(9, 'S', 11),
(9, 'M', 14),
(9, 'L', 14),
(9, 'XL', 17);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `account_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `address`, `password`, `account_created`) VALUES
(1, 'Rohan Maharjan', 'roharzan@gmail.com', '9861767923', 'Kimdole, Kathmandu', '$2y$10$9Yv3o.0HruCKGae5ndok0uQqAqRe.ycPpX7U7w9q2EezMR9grfQTC', '2024-01-22 12:03:19'),
(2, 'Ram Shahi', 'ram@gmail.com', '9841499333', 'Tahachal, Kathmandu', '$2y$10$d63kqAPfW/Q8jXif5.QBSuK7HQPBO5QwcvXdQnvbhqLjFLWtLtEjy', '2024-01-23 03:39:48'),
(3, 'Rohan Mzn', 'roharzan1@gmail.com', '9860373301', 'kimdole', '$2y$10$LUA2lA2ZeeCU6WHznVgnTOAOzAdTDHpwYw.wzJ2MbVb28Qdl3yThG', '2024-01-23 04:03:35'),
(4, 'Bips', 'bipin123@gmail.com', '9861454813', 'Lazimpat, Kathmandu', '$2y$10$3A99wagQWEITLBcfGyQQQun8uEcpHUEsflHZtQjQ5pgozQ4veanx2', '2024-02-21 06:59:44'),
(5, 'Lee', 'lee@gmail.com', '9812345678', 'Lazimpat, Kathmandu', '$2y$10$d9/rh199CwYQTei9frMobOq3zEiqrCHrWUwvvowqY9YrCdoQsMD8q', '2024-02-22 06:55:58'),
(6, 'Rojan', 'rojan123@gmail.com', '9810047538', 'Kimdole, Kathmanduu', '$2y$10$uMxIVRQTa0Vf4DM35hi9m.T8rMXxrgrG9h2cNyvhmRnMkkf4Z1qyG', '2024-02-21 19:00:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivered`
--
ALTER TABLE `delivered`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `mycart`
--
ALTER TABLE `mycart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `productsizes`
--
ALTER TABLE `productsizes`
  ADD KEY `fk_product_id` (`fk_product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivered`
--
ALTER TABLE `delivered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `mycart`
--
ALTER TABLE `mycart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`);

--
-- Constraints for table `productsizes`
--
ALTER TABLE `productsizes`
  ADD CONSTRAINT `productsizes_ibfk_1` FOREIGN KEY (`fk_product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
