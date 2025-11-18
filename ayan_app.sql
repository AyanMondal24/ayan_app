-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 18, 2025 at 10:35 AM
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, 'Bread', 'cat_691ab89753070.png', '2025-11-17 11:24:31', '2025-11-17 11:24:31', '2025-11-17 11:24:31'),
(14, 'Meat', 'cat_691ab87e9358d.jpg', '2025-11-17 11:24:06', '2025-11-17 11:24:06', '2025-11-17 11:24:06'),
(12, 'Vegetables', 'cat_691ab851ba28f.jpg', '2025-11-17 11:23:21', '2025-11-17 11:23:21', '2025-11-17 11:23:21'),
(13, 'Fruits', 'cat_691ab86c2adc1.jpg', '2025-11-17 11:23:48', '2025-11-17 11:23:48', '2025-11-17 11:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` float NOT NULL,
  `category` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `quantity` int NOT NULL,
  `unit_id` int NOT NULL,
  `status` tinyint NOT NULL COMMENT '0=active,1=inactive',
  `is_available` tinyint NOT NULL COMMENT '0=available\r\n1=unavailable',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `quantity`, `unit_id`, `status`, `is_available`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Green Chili', '<p>This is a sample text created to be exactly one hundred fifty characters long so you can use it to test your validation rule for minimum description length.</p>\n', 50, '12', 500, 1, 0, 0, '2025-11-17 11:56:29', '2025-11-17 11:56:29', '2025-11-17 11:56:29'),
(7, 'Sade Mcfarland', '<h1>This is a<em><strong> sample text</strong></em> created to be exactly one hundred fifty characters long so you can use it to test your validation rule for minimum description length. just testing with more character</h1>\r\n', 609, '12', 532, 4, 0, 0, '2025-11-17 19:12:40', '2025-11-17 19:12:40', '2025-11-17 19:12:40'),
(2, 'Jocelyn Fields', '<p>This is a sample text created to be exactly one hundred fifty characters long so you can use it to test your validation rule for minimum description length.</p>\n', 751, '14', 611, 3, 0, 1, '2025-11-17 12:04:34', '2025-11-17 12:04:34', '2025-11-17 12:04:34'),
(3, 'Iris Wade', '<p>This is a sample text created to be exactly one hundred fifty characters long so you can use it to test your validation rule for minimum description length.</p>\n', 248, '12', 933, 4, 0, 0, '2025-11-17 12:20:37', '2025-11-17 12:20:37', '2025-11-17 12:20:37'),
(4, 'Britanney Hubbard', '<p>This is a sample text created to be exactly one hundred fifty characters long so you can use it to test your validation rule for minimum description length.</p>\n', 133, '15', 818, 3, 0, 1, '2025-11-17 12:22:14', '2025-11-17 12:22:14', '2025-11-17 12:22:14'),
(5, 'Judah Lloyd', '<p>This is a sample text created to be exactly one hundred fifty characters long so you can use it to test your validation rule for minimum description length.</p>\n', 655, '12', 818, 3, 0, 1, '2025-11-17 12:22:56', '2025-11-17 12:22:56', '2025-11-17 12:22:56'),
(6, 'Sophia Espinoza', '<p>This is a sample text created to be exactly one hundred fifty characters long so you can use it to test your validation rule for minimum description length.</p>\n', 953, '12', 702, 4, 0, 1, '2025-11-17 16:45:48', '2025-11-17 16:45:48', '2025-11-17 16:45:48'),
(8, 'Brendan Shepard', '<p>this is aa testing one two three tesst demo test demo test ok no yes good night nice great not good yes ok this may use no thanks&nbsp; ft yt fb looks good&nbsp;</p>\r\n', 776, '13', 951, 2, 0, 0, '2025-11-17 22:28:48', '2025-11-17 22:28:48', '2025-11-17 22:28:48'),
(9, 'Melanie Floyd', '<p>its hdjdh ieddwuiede msdjsdskwq sjjmxkjso&nbsp; sksikos&nbsp; jdkwjdiuwd9 nxmxnkwdjiw wmxxwdkwod&nbsp; ddk wdjowd sddwhq qddwqdd&nbsp; &nbsp; iduwqd</p>\r\n', 615, '14', 18, 1, 0, 1, '2025-11-18 15:05:46', '2025-11-18 15:05:46', '2025-11-18 15:05:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
CREATE TABLE IF NOT EXISTS `product_image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `image_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image_type` enum('main','gallery','thumb') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'main',
  `alt_text` varchar(255) DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=255 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `image_name`, `image_type`, `alt_text`, `sort_order`, `created_at`, `updated_at`) VALUES
(254, 9, 'product_691c3df2dc9a3.png', 'gallery', 'Cumque quo anim natu', 0, '2025-11-18 15:05:46', '2025-11-18 15:05:46'),
(253, 9, 'product_691c3df2db762.png', 'gallery', 'Aliquid officiis tem', 0, '2025-11-18 15:05:46', '2025-11-18 15:05:46'),
(252, 9, 'product_691c3df2db370.png', 'gallery', 'Deserunt nihil nemo ', 0, '2025-11-18 15:05:46', '2025-11-18 15:05:46'),
(251, 9, 'product_691c3df2dafe9.png', 'main', 'Labore unde harum of', 0, '2025-11-18 15:05:46', '2025-11-18 15:05:46'),
(250, 8, 'product_691b5448521b6.png', 'main', 'Ab sed numquam dolor', 0, '2025-11-17 22:28:48', '2025-11-17 22:28:48'),
(249, 8, 'product_691b544851e8b.png', 'gallery', 'Doloremque necessita', 0, '2025-11-17 22:28:48', '2025-11-17 22:28:48'),
(248, 7, 'product_691b2650978b2.jpeg', 'main', 'Est voluptatem Deb', 0, '2025-11-17 19:12:40', '2025-11-17 19:12:40'),
(247, 7, 'product_691b265097526.png', 'gallery', 'Pariatur Sequi sunt', 0, '2025-11-17 19:12:40', '2025-11-17 19:12:40'),
(246, 7, 'product_691b265097154.png', 'gallery', 'Qui proident minima', 0, '2025-11-17 19:12:40', '2025-11-17 19:12:40'),
(245, 7, 'product_691b265096d75.png', 'gallery', 'Non delectus aspern', 0, '2025-11-17 19:12:40', '2025-11-17 19:12:40'),
(244, 6, 'product_691b03e4b3459.png', 'gallery', 'Aliquip necessitatib', 0, '2025-11-17 16:45:48', '2025-11-17 16:45:48'),
(243, 6, 'product_691b03e4b2e97.png', 'gallery', 'Est inventore deseru', 0, '2025-11-17 16:45:48', '2025-11-17 16:45:48'),
(242, 6, 'product_691b03e4b2ae1.png', 'gallery', 'Amet nihil reiciend', 0, '2025-11-17 16:45:48', '2025-11-17 16:45:48'),
(241, 6, 'product_691b03e4b2572.png', 'main', 'Ea sint occaecat exe', 0, '2025-11-17 16:45:48', '2025-11-17 16:45:48'),
(235, 4, 'product_691ac61e2f2ca.png', 'gallery', 'Odio occaecat occaec', 0, '2025-11-17 12:22:14', '2025-11-17 12:22:14'),
(236, 4, 'product_691ac61e2f6e9.png', 'main', 'At at et optio anim', 0, '2025-11-17 12:22:14', '2025-11-17 12:22:14'),
(237, 5, 'product_691ac648721e3.png', 'gallery', 'Modi id omnis eveni', 0, '2025-11-17 12:22:56', '2025-11-17 12:22:56'),
(238, 5, 'product_691ac648726f7.png', 'main', 'Alias nobis sit ven', 0, '2025-11-17 12:22:56', '2025-11-17 12:22:56'),
(239, 5, 'product_691ac64872ade.png', 'gallery', 'Qui at voluptatem a', 0, '2025-11-17 12:22:56', '2025-11-17 12:22:56'),
(240, 5, 'product_691ac64872ef3.png', 'gallery', 'Non sunt fugiat repe', 0, '2025-11-17 12:22:56', '2025-11-17 12:22:56'),
(234, 4, 'product_691ac61e2eed0.png', 'main', 'Eiusmod qui reprehen', 0, '2025-11-17 12:22:14', '2025-11-17 12:22:14'),
(233, 4, 'product_691ac61e2ea77.png', 'main', 'Alias et beatae veli', 0, '2025-11-17 12:22:14', '2025-11-17 12:22:14'),
(232, 4, 'product_691ac61e2e489.png', 'thumb', 'Sit est ea et repreh', 0, '2025-11-17 12:22:14', '2025-11-17 12:22:14'),
(231, 3, 'product_691ac5bda167b.png', 'thumb', 'Et adipisci sint com', 0, '2025-11-17 12:20:37', '2025-11-17 12:20:37'),
(230, 3, 'product_691ac5bda132d.png', 'gallery', 'Irure praesentium se', 0, '2025-11-17 12:20:37', '2025-11-17 12:20:37'),
(229, 3, 'product_691ac5bda0f7f.png', 'thumb', 'Eos voluptas in arch', 0, '2025-11-17 12:20:37', '2025-11-17 12:20:37'),
(228, 3, 'product_691ac5bda0a74.png', 'main', 'Voluptatem Dolor qu', 0, '2025-11-17 12:20:37', '2025-11-17 12:20:37'),
(223, 1, 'product_691ac0159eca3.png', 'main', 'green Chili', 0, '2025-11-17 11:56:29', '2025-11-17 11:56:29'),
(227, 2, 'product_691ac1fa665bc.png', 'gallery', 'Ipsam laborum Susci', 0, '2025-11-17 12:04:34', '2025-11-17 12:04:34'),
(226, 2, 'product_691ac1fa65fe5.png', 'gallery', 'Quibusdam nobis exer', 0, '2025-11-17 12:04:34', '2025-11-17 12:04:34'),
(225, 2, 'product_691ac1fa6594c.png', 'gallery', 'Aliqua Quo exceptur', 0, '2025-11-17 12:04:34', '2025-11-17 12:04:34'),
(224, 2, 'product_691ac1fa65465.png', 'main', 'Anim minim omnis pro', 0, '2025-11-17 12:04:34', '2025-11-17 12:04:34');

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
