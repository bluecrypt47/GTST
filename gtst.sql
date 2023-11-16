-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 29, 2023 lúc 09:50 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gtst`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `idProduct` int(11) NOT NULL,
  `idProductType` int(11) NOT NULL,
  `nameProductType` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` bigint(20) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cái',
  `createAtProduct` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAtProduct` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `producttypes`
--

CREATE TABLE `producttypes` (
  `idProductType` int(11) NOT NULL,
  `nameProductType` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createAtProType` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAtProType` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `idRole` int(11) NOT NULL,
  `nameRole` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createAtRole` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAtRole` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`idRole`, `nameRole`, `createAtRole`, `updateAtRole`) VALUES
(1, 'Administrator', '2023-04-12 00:00:00', '2023-04-12 00:00:00'),
(2, 'User', '2023-04-12 00:00:00', '2023-04-12 00:00:00'),
(5, 'test', '2023-04-27 11:28:10', '2023-04-27 11:28:10'),
(6, 'asd', '2023-04-27 11:28:10', '2023-04-27 11:28:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
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
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`idUser`, `idRole`, `name`, `email`, `phoneNumber`, `username`, `password`, `avatar`, `createAt`, `updateAt`) VALUES
(1, 1, 'Administrators', 'admin@gmail.com', '', 'admin', '538d598f97cc42ab6669d5038283106b', 'abcb56bdc80388583afc15efe85a5f99.jpg', '2023-04-12 00:00:00', '2023-04-23 07:46:07'),
(2, 2, 'User', 'user@gmail.com', '0126483920', 'user', '538d598f97cc42ab6669d5038283106b', 'da100700eb7e070324707b8e41dc7242.gif', '2023-04-12 00:00:00', '2023-04-23 07:45:45'),
(3, 2, 'Blue', 'blue@gmail.com', '0123456789', 'blue', '538d598f97cc42ab6669d5038283106b', 'e33b49d9ca7f08bd5614db2c6d5e5089.jpg', '2023-04-21 00:00:00', '2023-04-23 07:45:55');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `idProductType` (`idProductType`),

--
-- Chỉ mục cho bảng `producttypes`
--
ALTER TABLE `producttypes`
  ADD PRIMARY KEY (`idProductType`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRole`),
  ADD UNIQUE KEY `nameRole` (`nameRole`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idRole` (`idRole`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `producttypes`
--
ALTER TABLE `producttypes`
  MODIFY `idProductType` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
