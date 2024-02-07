-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 09:07 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gtst`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `idOrder` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `nameCustomer` varchar(30) NOT NULL,
  `phoneNumberCustomer` varchar(11) NOT NULL,
  `addressCustomer` varchar(255) NOT NULL,
  `noteCustomer` text NOT NULL,
  `total` bigint(20) NOT NULL,
  `createAtTime` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAtTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `idOrderDetail` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `idProduct` int(11) NOT NULL,
  `idProductType` int(11) NOT NULL,
  `nameProduct` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` bigint(20) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cái',
  `highlightProduct` tinyint(1) NOT NULL DEFAULT 0,
  `newProduct` tinyint(1) NOT NULL DEFAULT 1,
  `createAtProduct` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAtProduct` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`idProduct`, `idProductType`, `nameProduct`, `image`, `description`, `price`, `quantity`, `unit`, `highlightProduct`, `newProduct`, `createAtProduct`, `updateAtProduct`) VALUES
(1, 1, 'Bánh', 'd5c38f64679fa5eac5caf02599eb0a36.jpg', '', 10000, 20, 'Cái', 1, 1, '2023-11-16 17:45:54', '2023-11-16 18:14:36'),
(2, 2, 'Kẹo', '584853c4e18bd2ec591adb5ec1b5e77f.jpg', '', 10000, 2, 'Cái', 1, 1, '2023-11-16 17:48:54', '2023-11-16 18:14:50'),
(3, 1, 'Bánh 2', '56692797a03b1671e343598ef5de59e8.jpg', 'Bánh 2', 11000, 3, '', 1, 1, '2024-02-06 15:49:47', '2024-02-06 15:49:47'),
(4, 1, 'Bánh 3', '2b8fb91173c99d6ba6eb9126ce15c86d.jpg', 'Bánh 3', 13000, 3, 'Cái', 1, 1, '2024-02-06 15:51:35', '2024-02-06 15:51:35'),
(5, 1, 'Bánh 4', '8107bb010a6076bfce258187f0042e4e.jpg', 'Bánh 4', 14000, 3, 'Cái', 1, 1, '2024-02-06 15:51:53', '2024-02-06 15:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `producttypes`
--

CREATE TABLE `producttypes` (
  `idProductType` int(11) NOT NULL,
  `nameProductType` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createAtProType` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAtProType` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `producttypes`
--

INSERT INTO `producttypes` (`idProductType`, `nameProductType`, `createAtProType`, `updateAtProType`) VALUES
(1, 'Bánh', '2023-11-16 17:37:28', '2023-11-16 17:37:28'),
(2, 'Kẹo', '2023-11-16 17:57:04', '2023-11-16 17:57:04'),
(3, 'Bim bim', '2023-11-16 17:57:51', '2023-11-16 18:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `idRole` int(11) NOT NULL,
  `nameRole` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createAtRole` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAtRole` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`idRole`, `nameRole`, `createAtRole`, `updateAtRole`) VALUES
(1, 'Administrator', '2023-04-12 00:00:00', '2023-04-12 00:00:00'),
(2, 'User', '2023-04-12 00:00:00', '2023-04-12 00:00:00'),
(5, 'test', '2023-04-27 11:28:10', '2023-04-27 11:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `idRole` int(11) NOT NULL DEFAULT 2,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'avatar-default.png',
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `idRole`, `name`, `email`, `phoneNumber`, `username`, `password`, `avatar`, `createAt`, `updateAt`) VALUES
(1, 1, 'Administrators', 'admin@gmail.com', '', 'admin', '538d598f97cc42ab6669d5038283106b', 'a13939f48a7832dc9a887c98b659f58d.jpg', '2023-04-12 00:00:00', '2023-11-16 22:36:46'),
(2, 2, 'User', 'user@gmail.com', '0126483920', 'user', '538d598f97cc42ab6669d5038283106b', 'da100700eb7e070324707b8e41dc7242.gif', '2023-04-12 00:00:00', '2023-04-23 07:45:45'),
(3, 2, 'Blue', 'blue@gmail.com', '0123456789', 'blue', '538d598f97cc42ab6669d5038283106b', 'e33b49d9ca7f08bd5614db2c6d5e5089.jpg', '2023-04-21 00:00:00', '2023-11-16 20:43:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`idOrderDetail`),
  ADD UNIQUE KEY `idOrder_2` (`idOrder`),
  ADD KEY `idOrder` (`idOrder`),
  ADD KEY `idProduct` (`idProduct`),
  ADD KEY `idOrder_3` (`idOrder`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `idProductType` (`idProductType`);

--
-- Indexes for table `producttypes`
--
ALTER TABLE `producttypes`
  ADD PRIMARY KEY (`idProductType`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRole`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `idRole` (`idRole`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `idOrderDetail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `producttypes`
--
ALTER TABLE `producttypes`
  MODIFY `idProductType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `idOrder` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idOrder`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idProduct` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `idProductType` FOREIGN KEY (`idProductType`) REFERENCES `producttypes` (`idProductType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `idRole` FOREIGN KEY (`idRole`) REFERENCES `roles` (`idRole`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
