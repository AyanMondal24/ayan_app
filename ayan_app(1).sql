-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 29, 2025 at 05:06 AM
-- Server version: 9.1.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ayan_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `image_alt` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `image_alt`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Meat', 'cat_6921e99d94aae.jpg', 'Meat', '2025-11-22 22:19:33', '2025-11-22 22:19:33', '2025-11-22 22:19:33'),
(2, 'Fruits', 'cat_6921e9b1985fd.jpg', 'fruits', '2025-11-22 22:19:53', '2025-11-22 22:19:53', '2025-11-22 22:19:53'),
(3, 'Vegetables', 'cat_6921e9c59e551.jpg', 'vegetables', '2025-11-22 22:20:13', '2025-11-22 22:20:13', '2025-11-22 22:20:13');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `discount_type` enum('percentage','fixed') DEFAULT 'percentage',
  `discount_value` decimal(10,2) NOT NULL,
  `min_purchase` decimal(10,2) DEFAULT '0.00',
  `start_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `image` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount_type`, `discount_value`, `min_purchase`, `start_date`, `expiry_date`, `status`, `image`, `created_at`) VALUES
(5, 'ayan001', 'percentage', 20.00, 0.00, '2026-10-16', '2027-03-19', 1, 'coupon_692a511741c51.png', '2025-11-29 07:19:11'),
(4, 'new1', 'fixed', 5.00, 67.00, '2026-09-22', '2027-08-15', 1, 'coupon_6929db5f27a80.png', '2025-11-28 22:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `quantity` int NOT NULL,
  `unit_id` int NOT NULL,
  `status` tinyint NOT NULL COMMENT '0=active,1=inactive',
  `is_available` tinyint NOT NULL COMMENT '0=available\r\n1=unavailable',
  `is_featured` tinyint DEFAULT NULL COMMENT '0=yes,1=no',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `quantity`, `unit_id`, `status`, `is_available`, `is_featured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Forrest Wise', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 375.00, '2', 275, 4, 0, 0, 0, '2025-11-24 17:58:07', '2025-11-24 17:58:07', '2025-11-24 17:58:07'),
(2, 'Suki Griffin', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 799.00, '1', 444, 2, 0, 0, 0, '2025-11-24 20:28:27', '2025-11-24 20:28:27', '2025-11-24 20:28:27'),
(3, 'Uriah Galloway', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 852.00, '1', 353, 4, 0, 0, 0, '2025-11-24 20:37:08', '2025-11-24 20:37:08', '2025-11-24 20:37:08'),
(4, 'Daphne Dickerson', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 93.00, '3', 125, 4, 0, 0, 0, '2025-11-24 20:37:45', '2025-11-24 20:37:45', '2025-11-24 20:37:45'),
(6, 'Maggy Carney', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 842.00, '3', 277, 3, 0, 0, 1, '2025-11-24 20:42:05', '2025-11-24 20:42:05', '2025-11-24 20:42:05'),
(7, 'Candice Evans', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 452.00, '2', 716, 4, 0, 0, 1, '2025-11-24 20:42:38', '2025-11-24 20:42:38', '2025-11-24 20:42:38'),
(8, 'Aquila Ayers', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 385.00, '3', 207, 3, 0, 0, 1, '2025-11-24 20:43:27', '2025-11-24 20:43:27', '2025-11-24 20:43:27'),
(9, 'Zane Hill', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 911.00, '2', 528, 3, 0, 0, 0, '2025-11-24 20:52:23', '2025-11-24 20:52:23', '2025-11-24 20:52:23'),
(10, 'Sophia Wyatt', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 890.00, '1', 472, 2, 0, 0, 1, '2025-11-24 20:52:49', '2025-11-24 20:52:49', '2025-11-24 20:52:49'),
(11, 'Kasimir Mcclain', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 604.00, '3', 435, 4, 0, 0, 0, '2025-11-24 20:53:21', '2025-11-24 20:53:21', '2025-11-24 20:53:21'),
(12, 'Allegra Lawrence', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 785.00, '3', 655, 3, 0, 0, 0, '2025-11-24 20:54:02', '2025-11-24 20:54:02', '2025-11-24 20:54:02'),
(13, 'Mariko Peters', '<p>dasdasdasfdffweedfhfhwehf&nbsp; ewjefewfewfjf&nbsp; nc wffwjfqjfqjfffjef&nbsp; fjefjef fjffo0qifeeikfiiiiiiiiiiiiiiiiiiiiiiiiiiiqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq', 600.00, '2', 511, 2, 0, 0, 1, '2025-11-25 17:28:44', '2025-11-25 17:28:44', '2025-11-25 17:28:44'),
(14, 'Gail Abbott', '<p>sSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS</p>\r\n', 89.00, '2', 372, 1, 0, 0, 1, '2025-11-25 17:34:05', '2025-11-25 17:34:05', '2025-11-25 17:34:05'),
(15, 'Octavia Warner', '<p>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</p>\r\n', 643.00, '1', 646, 2, 0, 0, 1, '2025-11-25 17:35:22', '2025-11-25 17:35:22', '2025-11-25 17:35:22'),
(16, 'Jorden Hale', '<p>assssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss s ssssssssssssssssssssssafdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</p>\r\n', 869.00, '2', 506, 3, 0, 0, 0, '2025-11-25 17:39:31', '2025-11-25 17:39:31', '2025-11-25 17:39:31'),
(17, 'Emmanuel Pollard', '<p>ddddddddddddddddddddddddddddddddddddddddddddddwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww</p>\n', 678.00, '1', 623, 3, 0, 0, 1, '2025-11-25 17:40:34', '2025-11-25 17:40:34', '2025-11-25 17:40:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
CREATE TABLE IF NOT EXISTS `product_image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `image_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `is_featured` tinyint NOT NULL DEFAULT '1' COMMENT '0=yes,1=no',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `image_name`, `alt_text`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 1, 'product_69244f578bf2f.png', 'Laboriosam aut reru', 1, '2025-11-24 17:58:07', '2025-11-24 17:58:07'),
(2, 1, 'product_69244f57ac663.png', 'Quis in facere sint ', 1, '2025-11-24 17:58:07', '2025-11-24 17:58:07'),
(3, 1, 'product_69244f57cf6ce.png', 'Sequi maiores et sit', 1, '2025-11-24 17:58:07', '2025-11-24 17:58:07'),
(4, 1, 'product_69244f57ed52e.png', 'Vitae pariatur Labo', 1, '2025-11-24 17:58:08', '2025-11-24 17:58:08'),
(5, 1, 'product_69244f5818903.jpg', 'Dolor tempore delec', 0, '2025-11-24 17:58:08', '2025-11-24 17:58:08'),
(6, 2, 'product_6924729397b6d.png', 'Soluta quos tempore', 1, '2025-11-24 20:28:27', '2025-11-24 20:28:27'),
(7, 2, 'product_69247293dbddc.png', 'In labore adipisicin', 1, '2025-11-24 20:28:28', '2025-11-24 20:28:28'),
(8, 2, 'product_69247294342b5.png', 'Dolorem soluta tempo', 1, '2025-11-24 20:28:28', '2025-11-24 20:28:28'),
(9, 2, 'product_6924729477ba2.jpg', 'Tempora amet soluta', 1, '2025-11-24 20:28:28', '2025-11-24 20:28:28'),
(10, 2, 'product_692472949819b.jpg', 'Debitis ut quis reru', 0, '2025-11-24 20:28:28', '2025-11-24 20:28:28'),
(11, 3, 'product_6924749cb19c2.png', 'Tempora earum est m', 1, '2025-11-24 20:37:08', '2025-11-24 20:37:08'),
(12, 3, 'product_6924749ce2874.png', 'Doloremque nihil ear', 1, '2025-11-24 20:37:09', '2025-11-24 20:37:09'),
(13, 3, 'product_6924749d251bc.png', 'Qui occaecat nulla v', 1, '2025-11-24 20:37:09', '2025-11-24 20:37:09'),
(14, 3, 'product_6924749d5b3eb.png', 'Et cillum dolores iu', 1, '2025-11-24 20:37:09', '2025-11-24 20:37:09'),
(15, 3, 'product_6924749d8ef15.jpg', 'Et consectetur aut ', 0, '2025-11-24 20:37:09', '2025-11-24 20:37:09'),
(16, 4, 'product_692474c142bef.png', 'Ipsum sunt et amet ', 1, '2025-11-24 20:37:45', '2025-11-24 20:37:45'),
(17, 4, 'product_692474c163d16.png', 'Quia sint sit deseru', 1, '2025-11-24 20:37:45', '2025-11-24 20:37:45'),
(18, 4, 'product_692474c18363e.png', 'Harum qui exercitati', 1, '2025-11-24 20:37:45', '2025-11-24 20:37:45'),
(19, 4, 'product_692474c1cceb6.png', 'Eum non laboriosam ', 1, '2025-11-24 20:37:46', '2025-11-24 20:37:46'),
(20, 4, 'product_692474c21c56a.jpeg', 'Quia consequatur Si', 0, '2025-11-24 20:37:46', '2025-11-24 20:37:46'),
(21, 5, 'product_6924752903d87.png', 'Adipisicing providen', 1, '2025-11-24 20:39:29', '2025-11-24 20:39:29'),
(22, 5, 'product_69247529355e1.png', 'Minus voluptatibus e', 1, '2025-11-24 20:39:29', '2025-11-24 20:39:29'),
(23, 5, 'product_692475296ab00.png', 'Odit nemo sed labore', 1, '2025-11-24 20:39:29', '2025-11-24 20:39:29'),
(24, 5, 'product_69247529a8af1.png', 'Ipsum at asperiores ', 1, '2025-11-24 20:39:29', '2025-11-24 20:39:29'),
(25, 5, 'product_69247529dbda2.png', 'Eveniet excepteur r', 0, '2025-11-24 20:39:30', '2025-11-24 20:39:30'),
(26, 6, 'product_692475c55c1f4.png', 'Consectetur nostrud', 1, '2025-11-24 20:42:05', '2025-11-24 20:42:05'),
(27, 6, 'product_692475c5a694c.png', 'Iure autem ipsum par', 1, '2025-11-24 20:42:05', '2025-11-24 20:42:05'),
(28, 6, 'product_692475c5f1f11.png', 'Voluptate alias maio', 1, '2025-11-24 20:42:06', '2025-11-24 20:42:06'),
(29, 6, 'product_692475c6418fb.png', 'Vel dicta suscipit q', 1, '2025-11-24 20:42:06', '2025-11-24 20:42:06'),
(30, 6, 'product_692475c691e68.png', 'Voluptas saepe sit ', 0, '2025-11-24 20:42:06', '2025-11-24 20:42:06'),
(31, 7, 'product_692475e6dcbdb.png', 'At maiores non volup', 1, '2025-11-24 20:42:39', '2025-11-24 20:42:39'),
(32, 7, 'product_692475e72a23c.png', 'Nisi qui aspernatur ', 1, '2025-11-24 20:42:39', '2025-11-24 20:42:39'),
(33, 7, 'product_692475e766ce8.png', 'Voluptate consectetu', 1, '2025-11-24 20:42:39', '2025-11-24 20:42:39'),
(34, 7, 'product_692475e7ab13e.png', 'Obcaecati fugit rer', 1, '2025-11-24 20:42:39', '2025-11-24 20:42:39'),
(35, 7, 'product_692475e7f4022.png', 'Officiis exercitatio', 0, '2025-11-24 20:42:40', '2025-11-24 20:42:40'),
(36, 8, 'product_69247617924da.png', 'Cupidatat in quod mi', 1, '2025-11-24 20:43:27', '2025-11-24 20:43:27'),
(37, 8, 'product_69247617aae5d.jpeg', 'Ex molestiae autem o', 1, '2025-11-24 20:43:27', '2025-11-24 20:43:27'),
(38, 8, 'product_69247617b3a57.jpg', 'Exercitationem non i', 1, '2025-11-24 20:43:27', '2025-11-24 20:43:27'),
(39, 8, 'product_69247617befa6.jpg', 'Assumenda nostrud co', 1, '2025-11-24 20:43:27', '2025-11-24 20:43:27'),
(40, 8, 'product_69247617c6841.png', 'Labore qui sunt seq', 0, '2025-11-24 20:43:27', '2025-11-24 20:43:27'),
(41, 9, 'product_6924782f582c3.png', 'Magna culpa sit et ', 1, '2025-11-24 20:52:23', '2025-11-24 20:52:23'),
(42, 9, 'product_6924782f96a8a.jpg', 'Voluptate provident', 1, '2025-11-24 20:52:23', '2025-11-24 20:52:23'),
(43, 9, 'product_6924782fa4328.jpg', 'Voluptas inventore c', 1, '2025-11-24 20:52:23', '2025-11-24 20:52:23'),
(44, 9, 'product_6924782fc3ba4.jpg', 'Delectus ex totam c', 1, '2025-11-24 20:52:23', '2025-11-24 20:52:23'),
(45, 9, 'product_6924782fce387.png', 'Sit libero veniam ', 0, '2025-11-24 20:52:23', '2025-11-24 20:52:23'),
(46, 10, 'product_69247849b4c1a.png', 'Dolore dolor quaerat', 1, '2025-11-24 20:52:50', '2025-11-24 20:52:50'),
(47, 10, 'product_6924784a05d3c.png', 'Sint sint officia qu', 1, '2025-11-24 20:52:50', '2025-11-24 20:52:50'),
(48, 10, 'product_6924784a4d31f.png', 'Animi sit vitae ut ', 1, '2025-11-24 20:52:50', '2025-11-24 20:52:50'),
(49, 10, 'product_6924784a98622.png', 'Cupiditate pariatur', 1, '2025-11-24 20:52:50', '2025-11-24 20:52:50'),
(50, 10, 'product_6924784add130.png', 'Ut culpa accusamus ', 0, '2025-11-24 20:52:51', '2025-11-24 20:52:51'),
(51, 11, 'product_6924786977b04.png', 'Ad laborum natus qui', 1, '2025-11-24 20:53:21', '2025-11-24 20:53:21'),
(52, 11, 'product_69247869ac18f.png', 'Nulla reprehenderit', 1, '2025-11-24 20:53:21', '2025-11-24 20:53:21'),
(53, 11, 'product_69247869e4b09.png', 'Delectus maiores qu', 1, '2025-11-24 20:53:22', '2025-11-24 20:53:22'),
(54, 11, 'product_6924786a26c71.png', 'Cumque ut rerum aper', 1, '2025-11-24 20:53:22', '2025-11-24 20:53:22'),
(55, 11, 'product_6924786a5edec.png', 'Soluta dolor nostrud', 0, '2025-11-24 20:53:22', '2025-11-24 20:53:22'),
(56, 12, 'product_692478922a35d.png', 'Qui tenetur consequa', 1, '2025-11-24 20:54:02', '2025-11-24 20:54:02'),
(57, 12, 'product_692478926ece1.png', 'Officiis amet ab vo', 1, '2025-11-24 20:54:02', '2025-11-24 20:54:02'),
(58, 12, 'product_69247892b3185.png', 'Est dicta autem ut ', 1, '2025-11-24 20:54:03', '2025-11-24 20:54:03'),
(59, 12, 'product_6924789307a4f.png', 'Architecto natus lab', 1, '2025-11-24 20:54:03', '2025-11-24 20:54:03'),
(60, 12, 'product_692478934336e.png', 'Iste neque quia sed ', 0, '2025-11-24 20:54:03', '2025-11-24 20:54:03'),
(61, 13, 'product_692599f40dbf4.png', 'Aut ut incidunt fug', 1, '2025-11-25 17:28:44', '2025-11-25 17:28:44'),
(62, 13, 'product_692599f44b7e1.png', 'Cillum rerum quis cu', 1, '2025-11-25 17:28:44', '2025-11-25 17:28:44'),
(63, 13, 'product_692599f4802f2.png', 'Dolore culpa sit eu', 1, '2025-11-25 17:28:44', '2025-11-25 17:28:44'),
(64, 13, 'product_692599f4a10fa.png', 'Non labore totam min', 1, '2025-11-25 17:28:44', '2025-11-25 17:28:44'),
(65, 13, 'product_692599f4c08a8.png', 'Sed aliquip rerum in', 0, '2025-11-25 17:28:45', '2025-11-25 17:28:45'),
(66, 14, 'product_69259b35cd765.png', 'Minima voluptates ip', 1, '2025-11-25 17:34:06', '2025-11-25 17:34:06'),
(67, 14, 'product_69259b360a80f.png', 'Sit harum aut magnam', 1, '2025-11-25 17:34:06', '2025-11-25 17:34:06'),
(68, 14, 'product_69259b3648d96.png', 'Qui consequatur omn', 1, '2025-11-25 17:34:06', '2025-11-25 17:34:06'),
(69, 14, 'product_69259b367e947.png', 'Recusandae Consecte', 1, '2025-11-25 17:34:06', '2025-11-25 17:34:06'),
(70, 14, 'product_69259b36b1efa.png', 'Et qui odit suscipit', 0, '2025-11-25 17:34:06', '2025-11-25 17:34:06'),
(71, 15, 'product_69259b8226e60.png', 'Dolore distinctio D', 1, '2025-11-25 17:35:22', '2025-11-25 17:35:22'),
(72, 15, 'product_69259b826bce9.png', 'Do possimus volupta', 1, '2025-11-25 17:35:22', '2025-11-25 17:35:22'),
(73, 15, 'product_69259b82b0a6c.png', 'Aliquid ab rerum et ', 1, '2025-11-25 17:35:22', '2025-11-25 17:35:22'),
(74, 15, 'product_69259b82f063f.jpg', 'Et non aut reprehend', 1, '2025-11-25 17:35:23', '2025-11-25 17:35:23'),
(75, 15, 'product_69259b830aa48.png', 'Vero illum sunt sed', 0, '2025-11-25 17:35:23', '2025-11-25 17:35:23'),
(76, 16, 'product_69259c7bb800b.png', 'Excepturi quibusdam ', 1, '2025-11-25 17:39:31', '2025-11-25 17:39:31'),
(77, 16, 'product_69259c7bee0c5.png', 'Tenetur ipsum magnam', 1, '2025-11-25 17:39:32', '2025-11-25 17:39:32'),
(78, 16, 'product_69259c7c2e688.png', 'Est cumque porro aut', 1, '2025-11-25 17:39:32', '2025-11-25 17:39:32'),
(79, 16, 'product_69259c7c797ca.png', 'Aut velit et eos fu', 1, '2025-11-25 17:39:32', '2025-11-25 17:39:32'),
(80, 16, 'product_69259c7cba7a1.png', 'Qui temporibus delec', 0, '2025-11-25 17:39:33', '2025-11-25 17:39:33'),
(81, 17, 'product_69259cba5ee57.png', 'Quasi sunt ipsam dol', 1, '2025-11-25 17:40:34', '2025-11-25 17:40:34'),
(82, 17, 'product_69259cbaa342e.png', 'Do fugiat odio sit t', 1, '2025-11-25 17:40:34', '2025-11-25 17:40:34'),
(83, 17, 'product_69259cbae6098.png', 'At lorem nesciunt v', 1, '2025-11-25 17:40:35', '2025-11-25 17:40:35'),
(84, 17, 'product_69259cbb0a7ba.jpeg', 'Ut rerum nisi doloru', 1, '2025-11-25 17:40:35', '2025-11-25 17:40:35'),
(85, 17, 'product_69259cbb1325a.jpg', 'Ut consequat Tempor', 0, '2025-11-25 17:40:35', '2025-11-25 17:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_unit`
--

DROP TABLE IF EXISTS `product_unit`;
CREATE TABLE IF NOT EXISTS `product_unit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `short_name` varchar(20) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_unit`
--

INSERT INTO `product_unit` (`id`, `name`, `short_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kilogram', 'KG', 'active', '2025-11-15 12:34:05', '2025-11-15 12:34:05'),
(2, 'Piece', 'PCS', 'active', '2025-11-15 15:26:45', '2025-11-15 15:26:45'),
(3, 'Litter', 'L', 'active', '2025-11-15 15:27:23', '2025-11-15 15:27:23'),
(4, 'Packet', 'PKG', 'active', '2025-11-15 15:28:22', '2025-11-15 15:28:22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
