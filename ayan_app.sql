-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 06, 2025 at 01:47 PM
-- Server version: 8.0.31
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'foods', 'cat_690c84573c299.png', '2025-11-06 16:49:51', '2025-11-06 16:49:51', '2025-11-06 16:49:51'),
(2, 'foods 2', 'cat_690c88b038728.png', '2025-11-06 17:08:24', '2025-11-06 17:08:24', '2025-11-06 17:08:24'),
(3, '', 'cat_690c88c2dc438.png', '2025-11-06 17:08:42', '2025-11-06 17:08:42', '2025-11-06 17:08:42'),
(4, 'Maggy Walsh', 'cat_690c96634a7b2.png', '2025-11-06 18:06:51', '2025-11-06 18:06:51', '2025-11-06 18:06:51'),
(5, 'Maggy Walsh', 'cat_690c96818cb3a.png', '2025-11-06 18:07:21', '2025-11-06 18:07:21', '2025-11-06 18:07:21'),
(6, 'Maggy Walsh', 'cat_690c968946d1c.png', '2025-11-06 18:07:29', '2025-11-06 18:07:29', '2025-11-06 18:07:29'),
(7, 'Maggy Walsh', 'cat_690c96fa02228.png', '2025-11-06 18:09:22', '2025-11-06 18:09:22', '2025-11-06 18:09:22'),
(8, 'Lesley Martinez', 'cat_690c973d4ee6b.png', '2025-11-06 18:10:29', '2025-11-06 18:10:29', '2025-11-06 18:10:29'),
(9, 'Robin Mckee', 'cat_690c9789cf395.png', '2025-11-06 18:11:45', '2025-11-06 18:11:45', '2025-11-06 18:11:45');

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
  `img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `quantity` int NOT NULL,
  `status` tinyint NOT NULL COMMENT '0=active,1=inactive',
  `is_available` tinyint NOT NULL COMMENT '0=available\r\n1=unavailable',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `img`, `category`, `quantity`, `status`, `is_available`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'dfef', 'cdf', 2323, 'product_690b22361c031.png', '1', 323, 0, 0, '2025-11-05 15:38:54', '2025-11-05 15:38:54', '2025-11-05 15:38:54'),
(2, 'aas', 'gsgsfu', 25.2, 'product_690b28576d99b.png', '2', 55, 0, 0, '2025-11-05 16:05:03', '2025-11-05 16:05:03', '2025-11-05 16:05:03'),
(3, 'aas', 'gsgsfu', 25.2, 'product_690b28b7db281.png', '2', 55, 0, 0, '2025-11-05 16:06:39', '2025-11-05 16:06:39', '2025-11-05 16:06:39'),
(4, 'aas', 'gsgsfu', 25.2, 'product_690b28c18eb1c.png', '2', 55, 0, 0, '2025-11-05 16:06:49', '2025-11-05 16:06:49', '2025-11-05 16:06:49'),
(5, 'ara', 'fdefef', 45, 'product_690b32c2d18ee.png', '1', 55, 0, 0, '2025-11-05 16:49:30', '2025-11-05 16:49:30', '2025-11-05 16:49:30'),
(6, 'Victoria Anderson', 'Pariatur Nihil nisi', 637, 'product_690b32f4911f3.png', '1', 155, 1, 0, '2025-11-05 16:50:20', '2025-11-05 16:50:20', '2025-11-05 16:50:20'),
(7, 'ffef', 'r3r3r3r', 23, 'product_690b37f74b311.png', '2', 33, 0, 1, '2025-11-05 17:11:43', '2025-11-05 17:11:43', '2025-11-05 17:11:43'),
(8, 'ffef', 'r3r3r3r', 23, 'product_690b385289a70.png', '2', 33, 0, 1, '2025-11-05 17:13:14', '2025-11-05 17:13:14', '2025-11-05 17:13:14'),
(9, 'test222', 'gggutu', 233, 'product_690b3e8e02b62.png', '3', 45, 0, 0, '2025-11-05 17:39:50', '2025-11-05 17:39:50', '2025-11-05 17:39:50'),
(10, 'test222', 'gggutu', 233, 'product_690b3f62bedec.png', '3', 45, 0, 0, '2025-11-05 17:43:22', '2025-11-05 17:43:22', '2025-11-05 17:43:22'),
(11, 'test222', 'gggutu', 233, 'product_690b3f81a74a3.png', '3', 45, 0, 0, '2025-11-05 17:43:53', '2025-11-05 17:43:53', '2025-11-05 17:43:53'),
(12, 'Ayayaya', 'dehdued', 45, 'product_690b471358df5.png', '1', 65, 1, 0, '2025-11-05 18:16:11', '2025-11-05 18:16:11', '2025-11-05 18:16:11'),
(13, 'Quail Hardin', 'Voluptate est offici', 245, 'product_690c7bc7d2b18.png', '3', 952, 0, 0, '2025-11-06 16:13:20', '2025-11-06 16:13:20', '2025-11-06 16:13:20'),
(14, 'Cassandra Fields', 'Odit aut dolor digni', 960, 'product_690c801f68886.png', '2', 96, 1, 1, '2025-11-06 16:31:51', '2025-11-06 16:31:51', '2025-11-06 16:31:51'),
(15, 'Briar Sawyer', 'Modi quae in aut sed', 84, 'product_690ca651bf97b.png', '3', 547, 0, 1, '2025-11-06 19:14:49', '2025-11-06 19:14:49', '2025-11-06 19:14:49');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
