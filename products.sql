-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 05, 2025 at 09:45 AM
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
  `status` tinyint NOT NULL COMMENT '0=Yes,1=No',
  `is_available` tinyint NOT NULL COMMENT '0=available\r\n1=unavailable',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `img`, `category`, `quantity`, `status`, `is_available`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test', 'dsdsdsd', 70, '8fc12e9a0f5d7daf36616464380189c8.png', '1', 78, 0, 0, '2025-11-04 20:24:00', '2025-11-04 20:24:00', '2025-11-04 20:24:00'),
(2, 'sds fsf', 'dferfg', 22, 'product_690a2a588d131.png', '1', 23, 0, 0, '2025-11-04 22:01:20', '2025-11-04 22:01:20', '2025-11-04 22:01:20'),
(3, 'sds fsf', 'dferfg', 22, 'product_690a2a982e0ab.png', '1', 23, 0, 0, '2025-11-04 22:02:24', '2025-11-04 22:02:24', '2025-11-04 22:02:24'),
(4, 'ay', 'testing', 56, 'product_690ac575d80d2.png', '3', 1, 1, 1, '2025-11-05 09:03:09', '2025-11-05 09:03:09', '2025-11-05 09:03:09'),
(5, 'main test', 'coffee', 50, 'product_690ae7475e7b0.png', '1', 1000, 0, 0, '2025-11-05 11:27:27', '2025-11-05 11:27:27', '2025-11-05 11:27:27'),
(6, 'main test12', 'coffee', 50, 'product_690aef0cef9b0.png', '1', 1000, 0, 0, '2025-11-05 12:00:36', '2025-11-05 12:00:36', '2025-11-05 12:00:36'),
(7, 'dsf', 'gfg', 34, 'product_690af0d1c5781.png', '1', 2, 1, 1, '2025-11-05 12:08:09', '2025-11-05 12:08:09', '2025-11-05 12:08:09'),
(8, 'dsf', 'gfg', 34, 'product_690af5db0987f.png', '1', 2, 1, 1, '2025-11-05 12:29:39', '2025-11-05 12:29:39', '2025-11-05 12:29:39'),
(9, 'fwsjkdfh', 'sdsfdfddeqd', 12, 'product_690aff7730ecd.png', '2', 112, 0, 0, '2025-11-05 13:10:39', '2025-11-05 13:10:39', '2025-11-05 13:10:39'),
(10, 'AyanMondal', 'dede', 400, 'product_690b05343109a.png', '2', 222, 1, 0, '2025-11-05 13:35:08', '2025-11-05 13:35:08', '2025-11-05 13:35:08'),
(11, 'test22', 'dwqefdeqfd', 477, 'product_690b1c8cc1888.png', '1', 90, 0, 0, '2025-11-05 15:14:44', '2025-11-05 15:14:44', '2025-11-05 15:14:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
