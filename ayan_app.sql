-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 12, 2026 at 04:51 AM
-- Server version: 9.1.0
-- PHP Version: 8.4.0

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `b_fname` varchar(20) NOT NULL,
  `b_lname` varchar(20) NOT NULL,
  `b_address` text NOT NULL,
  `b_state` varchar(50) NOT NULL,
  `b_city` varchar(50) NOT NULL,
  `b_country` varchar(30) NOT NULL,
  `b_pin` varchar(10) NOT NULL,
  `b_landmark` varchar(255) NOT NULL,
  `b_phone` varchar(15) NOT NULL,
  `b_email` text NOT NULL,
  `is_shipping_same` tinyint NOT NULL DEFAULT '1' COMMENT '0=no,1=yes',
  `s_fname` varchar(20) NOT NULL,
  `s_lname` varchar(20) NOT NULL,
  `s_address` text NOT NULL,
  `s_state` varchar(50) NOT NULL,
  `s_city` varchar(50) NOT NULL,
  `s_country` varchar(30) NOT NULL,
  `s_pin` varchar(20) NOT NULL,
  `s_landmark` varchar(255) NOT NULL,
  `s_phone` varchar(15) NOT NULL,
  `s_email` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `b_fname`, `b_lname`, `b_address`, `b_state`, `b_city`, `b_country`, `b_pin`, `b_landmark`, `b_phone`, `b_email`, `is_shipping_same`, `s_fname`, `s_lname`, `s_address`, `s_state`, `s_city`, `s_country`, `s_pin`, `s_landmark`, `s_phone`, `s_email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(31, 11, 'Leonard Carney', 'Lacota Moses', 'Elit quia commodi m', 'Soluta nihil nisi ex', 'Quis enim aut dolor ', 'Eius id commodo quas', '654656', 'Modi natus dolore pa', '1546295655', 'kadipulip@mailinator.com', 0, 'Xandra Osborne', 'Diana Baxter', 'Repudiandae veniam ', 'Eu non ullam et sunt', 'Officiis omnis vero ', 'Consequatur modi to', '654654', 'Id qui officia in qu', '1208828680', 'fonup@mailinator.com', '2025-12-19 09:41:22', '2025-12-19 22:36:34', NULL),
(29, 13, 'Ayan 098', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Nihil et a ea veniam', 'Officia animi fugia', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'clutchdropkings@gmail.com', 1, '', '', '', '', '', '', '', '', '', '', '2025-12-17 00:42:39', '2026-01-06 13:21:07', NULL),
(30, 11, 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 09:39:33', '2025-12-19 09:39:33', NULL),
(32, 24, 'smriti', 'gaunia', 'kolkata golpalpur', 'wb', 'kolkata', 'ind', '700014', 'it dhsqesoqejqe', '7485965412', 'smriti@gmail.com', 1, '', '', '', '', '', '', '', '', '', '', '2025-12-20 16:22:25', '2025-12-20 16:22:25', NULL),
(33, 25, 'Fiona Humphrey', 'Courtney Coffey', 'Fugiat velit mollit', 'Sed ab velit quis ex', 'Aute ut veritatis et', 'Qui duis quod cupidi', '477777', 'Sit illum inventor', '1486577123', 'baqipyc@mailinator.com', 1, '', '', '', '', '', '', '', '', '', '', '2025-12-20 16:25:11', '2025-12-20 16:25:11', NULL),
(35, 0, 'Xavier Little', 'Kane Torres', 'Id eius do temporib', 'Non consequatur assu', 'Dicta eum incididunt', 'Irure repellendus R', '859999', 'Consequat Laudantiu', '1331268995', 'tumi@mailinator.com', 1, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(34, 26, 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-03 11:40:36', '2026-01-07 20:03:23', NULL),
(60, 33, 'Aline Savage', 'Nehru Floyd', 'Hic aliqua Magna co', 'Voluptas nisi pariat', 'Est in similique do', 'Minim sunt nostrum b', '774545', 'Quidem non minima mi', '1517776514', 'clutchdropkings@gmail.com', 0, 'Melanie Slater', 'Mollie Franklin', 'Non expedita nihil c', 'Molestias eius molli', 'Nisi sunt duis fuga', 'Aut consequat Conse', '265659', 'Totam neque cupidata', '1976338405', 'peverowoji@mailinator.com', '2026-01-12 10:20:08', '2026-01-12 10:20:08', NULL),
(59, 28, 'Ira May', 'Kermit Zamora', 'Ullamco dolor est a', 'Sequi in distinctio', 'Tenetur exercitation', 'Ipsum aliquip veniam', '546574', 'Cupiditate aliquid s', '1621157641', 'clutchdropkings@gmail.com', 1, '', '', '', '', '', '', '', '', '', '', '2026-01-08 17:16:10', '2026-01-08 17:35:20', NULL),
(58, 27, 'Brendan Rowland', 'Ori Mills', 'In autem doloribus a', 'Ea recusandae Culpa', 'Eius eu vitae quia e', 'Distinctio Ullamco ', '645469', 'Quia aut ut tempore', '1194894496', 'qifoxe@mailinator.com', 1, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'Admin', '123', 'admin@gmail.com', '7856985478', '$2y$10$iGty.02hA5s5lbyfLQRym.v2inR7TZTSxlCrfdXkq4EnQDz8uZ76u', 'img_20251216_214736_69418620f13de.png', '2025-12-16 21:47:37', '2025-12-16 21:47:37', '0000-00-00 00:00:00'),
(5, 'admin', '001', 'admin001@gmail.com', '8697669081', '$2y$10$i9qDlvUKMKtuMdJtqS9oBOqrAYrkPEYDUsxDZ6TtU0EHEgIqxHtwq', 'img_20251217_000811_6941a71352ecd.jpeg', '2025-12-17 00:08:11', '2025-12-17 00:08:11', '0000-00-00 00:00:00');

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
  `category_slug` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `image_alt`, `category_slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Meat', 'cat_6921e99d94aae.jpg', 'Meat', 'meat', '2025-11-22 22:19:33', '2025-11-22 22:19:33', '2025-11-22 22:19:33'),
(2, 'Fruits', 'cat_6921e9b1985fd.jpg', 'fruits', 'fruits', '2025-11-22 22:19:53', '2025-11-22 22:19:53', '2025-11-22 22:19:53'),
(3, 'Vegetables', 'cat_6921e9c59e551.jpg', 'vegetables', 'vegetables', '2025-11-22 22:20:13', '2025-11-22 22:20:13', '2025-11-22 22:20:13');

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
  `status` tinyint DEFAULT NULL COMMENT '1=active,0=inactive',
  `image` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount_type`, `discount_value`, `min_purchase`, `start_date`, `expiry_date`, `status`, `image`, `created_at`) VALUES
(5, 'ayan001', 'percentage', 20.00, 0.00, '2026-10-16', '2027-03-19', 1, 'coupon_692a511741c51.png', '2025-11-29 07:19:11'),
(4, 'new1', 'fixed', 1000.00, 67.00, '2026-09-22', '2027-08-15', 1, 'coupon_6929db5f27a80.png', '2025-11-28 22:56:55'),
(6, 'me205', 'fixed', 2000.00, 0.00, '2025-11-30', '2025-12-03', 1, 'coupon_692c65cbddc63.jpg', '2025-11-29 20:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_01_10_072329_create_address_table', 0),
(2, '2026_01_10_072329_create_admins_table', 0),
(3, '2026_01_10_072329_create_category_table', 0),
(4, '2026_01_10_072329_create_coupons_table', 0),
(5, '2026_01_10_072329_create_order_details_table', 0),
(6, '2026_01_10_072329_create_orders_table', 0),
(7, '2026_01_10_072329_create_product_image_table', 0),
(8, '2026_01_10_072329_create_product_unit_table', 0),
(9, '2026_01_10_072329_create_products_table', 0),
(10, '2026_01_10_072329_create_users_table', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_number` varchar(50) DEFAULT NULL,
  `coupon_id` int DEFAULT NULL,
  `coupon_discount` decimal(10,2) DEFAULT '0.00',
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `final_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment_method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `payment_intent_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `payment_status` enum('pending','paid','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending',
  `paid_at` datetime NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `order_status` varchar(50) NOT NULL DEFAULT 'pending',
  `b_fname` varchar(30) NOT NULL,
  `b_lname` varchar(30) NOT NULL,
  `b_address` text NOT NULL,
  `b_state` varchar(30) NOT NULL,
  `b_city` varchar(30) NOT NULL,
  `b_country` varchar(50) NOT NULL,
  `b_pin` varchar(12) NOT NULL,
  `b_landmark` varchar(255) NOT NULL,
  `b_phone` varchar(15) NOT NULL,
  `b_email` text NOT NULL,
  `is_shipping_same` tinyint NOT NULL DEFAULT '1' COMMENT '0=no , 1=yes',
  `s_fname` varchar(30) NOT NULL,
  `s_lname` varchar(30) NOT NULL,
  `s_address` text NOT NULL,
  `s_state` varchar(30) NOT NULL,
  `s_city` varchar(30) NOT NULL,
  `s_country` varchar(30) NOT NULL,
  `s_pin` varchar(12) NOT NULL,
  `s_landmark` varchar(255) NOT NULL,
  `s_phone` varchar(15) NOT NULL,
  `s_email` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `coupon_id`, `coupon_discount`, `total_amount`, `final_amount`, `payment_method`, `payment_intent_id`, `payment_status`, `paid_at`, `transaction_id`, `order_status`, `b_fname`, `b_lname`, `b_address`, `b_state`, `b_city`, `b_country`, `b_pin`, `b_landmark`, `b_phone`, `b_email`, `is_shipping_same`, `s_fname`, `s_lname`, `s_address`, `s_state`, `s_city`, `s_country`, `s_pin`, `s_landmark`, `s_phone`, `s_email`, `created_at`, `updated_at`) VALUES
(75, 11, 'ORD-20251219-748275-75', 5, 4919.40, 24597.00, 19677.60, 'Card', 'pi_3Sfv3HF338nGzwqe04qXpv1V', 'paid', '0000-00-00 00:00:00', '', 'cancelled', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 09:41:22', '2025-12-27 10:06:04'),
(76, 11, 'ORD-20251219-262699-76', NULL, 0.00, 3772.00, 3772.00, 'Card', 'pi_3Sfxi1F338nGzwqe0sHfmyoD', 'paid', '0000-00-00 00:00:00', '', 'confirmed', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 11:07:06', '2025-12-19 11:07:06'),
(77, 11, 'ORD-20251219-793715-77', 5, 1140.20, 5701.00, 4560.80, 'Card', 'pi_3Sfxp2F338nGzwqe0rfWo3gf', 'paid', '0000-00-00 00:00:00', '', 'confirmed', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 12:35:37', '2025-12-19 12:35:37'),
(78, 11, 'ORD-20251219-820763-78', NULL, 0.00, 678.00, 678.00, 'Card', 'pi_3SfxpEF338nGzwqe0vwtW41l', 'paid', '0000-00-00 00:00:00', 'TXN-20251219124035-7573', 'confirmed', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 12:40:07', '2025-12-19 12:40:07'),
(79, 11, 'ORD-20251219-826834-79', NULL, 0.00, 869.00, 869.00, 'Card', 'pi_3SfxqDF338nGzwqe0yPrT6RL', 'paid', '0000-00-00 00:00:00', 'TXN-20251219130518-7927', 'confirmed', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 12:41:08', '2025-12-19 12:41:08'),
(80, 11, 'ORD-20251219-626979-80', NULL, 0.00, 7110.00, 7110.00, 'Card', 'pi_3Sg24BF338nGzwqe1hxW2bpH', 'paid', '0000-00-00 00:00:00', 'TXN-20251219171149-9166', 'confirmed', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 14:54:29', '2025-12-19 14:54:29'),
(81, 11, 'ORD-20251219-784286-81', NULL, 0.00, 5022.00, 5022.00, 'Card', 'pi_3Sg2vvF338nGzwqe1KclRdI6', 'paid', '0000-00-00 00:00:00', 'ch_3Sg2vvF338nGzwqe1vgVs1YB', 'confirmed', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 18:07:22', '2025-12-19 18:07:22'),
(82, 11, 'ORD-20251219-233795-82', NULL, 0.00, 2190.00, 2190.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 19:22:17', '2025-12-19 19:22:17'),
(83, 11, 'ORD-20251219-234130-83', NULL, 0.00, 2190.00, 2190.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 19:22:21', '2025-12-19 19:22:21'),
(84, 11, 'ORD-20251219-241490-84', NULL, 0.00, 2190.00, 2190.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 19:23:34', '2025-12-19 19:23:34'),
(85, 11, 'ORD-20251219-247925-85', NULL, 0.00, 2190.00, 2190.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 19:24:39', '2025-12-19 19:24:39'),
(86, 11, 'ORD-20251219-249873-86', NULL, 0.00, 2190.00, 2190.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 19:24:58', '2025-12-19 19:24:58'),
(87, 11, 'ORD-20251219-251898-87', NULL, 0.00, 2190.00, 2190.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 19:25:18', '2025-12-19 19:25:18'),
(88, 11, 'ORD-20251219-254773-88', NULL, 0.00, 2190.00, 2190.00, 'Card', 'pi_3Sg49nF338nGzwqe0pQnv4Sw', 'paid', '0000-00-00 00:00:00', 'ch_3Sg49nF338nGzwqe0woFcJbH', 'confirmed', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 19:25:47', '2025-12-19 19:25:47'),
(89, 11, 'ORD-20251219-449014-89', 5, 2958.60, 14793.00, 11834.40, 'Cash On Delivery', 'pi_3Sg4f8F338nGzwqe0WJIoBQA', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 19:58:10', '2025-12-19 19:58:10'),
(90, 11, 'ORD-20251219-576958-90', 5, 2958.60, 14793.00, 11834.40, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 20:19:29', '2025-12-19 20:19:29'),
(91, 11, 'ORD-20251219-604711-91', 5, 2958.60, 14793.00, 11834.40, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 20:24:07', '2025-12-19 20:24:07'),
(92, 11, 'ORD-20251219-609330-92', 5, 2958.60, 14793.00, 11834.40, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 20:24:53', '2025-12-19 20:24:53'),
(93, 11, 'ORD-20251219-144815-93', 5, 3079.40, 15397.00, 12317.60, 'Card', 'pi_3Sg6TNF338nGzwqe1ntQHQYh', 'paid', '0000-00-00 00:00:00', 'ch_3Sg6TNF338nGzwqe1Ulmffzw', 'confirmed', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 21:54:08', '2025-12-19 21:54:08'),
(94, 11, 'ORD-20251219-196689-94', NULL, 0.00, 1512.00, 1512.00, 'Card', 'pi_3Sg6khF338nGzwqe0pfb5t3n', 'paid', '0000-00-00 00:00:00', 'ch_3Sg6khF338nGzwqe0mmL8rq2', 'confirmed', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 22:02:46', '2025-12-19 22:02:46'),
(95, 11, 'ORD-20251219-290860-95', 4, 1000.00, 2416.00, 1416.00, 'Card', 'pi_3Sg6quF338nGzwqe1po2svLX', 'paid', '0000-00-00 00:00:00', 'ch_3Sg6quF338nGzwqe1TInPd3J', 'confirmed', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 0, 'Neil Lucas', 'Katelyn Huber', 'Qui et non culpa ip', 'Aut reprehenderit en', 'Est consequat Ex en', 'Voluptate quod eaque', '984998', 'Aliquid fugit ad qu', '1901178140', 'jubuhekis@mailinator.com', '2025-12-19 22:18:28', '2025-12-19 22:18:28'),
(96, 11, 'ORD-20251219-296686-96', NULL, 0.00, 3641.00, 3641.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Nissim Ingram', 'Fitzgerald Rowe', 'Aut ut eligendi aliq', 'Nobis aute incididun', 'Aut quia consequatur', 'Quia blanditiis labo', '654466', 'Temporibus culpa ame', '1153104683', 'bipyruzur@mailinator.com', 1, '', '', '', '', '', '', '', '', '', '', '2025-12-19 22:19:26', '2025-12-19 22:19:26'),
(97, 11, 'ORD-20251219-395346-97', NULL, 0.00, 1547.00, 1547.00, 'Card', 'pi_3Sg77mF338nGzwqe13P2ugi5', 'paid', '0000-00-00 00:00:00', 'ch_3Sg77mF338nGzwqe1V4EnuE8', 'confirmed', 'Leonard Carney', 'Lacota Moses', 'Elit quia commodi m', 'Soluta nihil nisi ex', 'Quis enim aut dolor ', 'Eius id commodo quas', '654656', 'Modi natus dolore pa', '1546295655', 'kadipulip@mailinator.com', 0, 'Xandra Osborne', 'Diana Baxter', 'Repudiandae veniam ', 'Eu non ullam et sunt', 'Officiis omnis vero ', 'Consequatur modi to', '654654', 'Id qui officia in qu', '1208828680', 'fonup@mailinator.com', '2025-12-19 22:35:53', '2025-12-19 22:35:53'),
(98, 11, 'ORD-20251219-399429-98', NULL, 0.00, 678.00, 678.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'confirmed', 'Leonard Carney', 'Lacota Moses', 'Elit quia commodi m', 'Soluta nihil nisi ex', 'Quis enim aut dolor ', 'Eius id commodo quas', '654656', 'Modi natus dolore pa', '1546295655', 'kadipulip@mailinator.com', 0, 'Xandra Osborne', 'Diana Baxter', 'Repudiandae veniam ', 'Eu non ullam et sunt', 'Officiis omnis vero ', 'Consequatur modi to', '654654', 'Id qui officia in qu', '1208828680', 'fonup@mailinator.com', '2025-12-19 22:36:34', '2025-12-25 22:18:04'),
(99, 13, 'ORD-20251220-358713-99', 5, 1078.40, 5392.00, 4313.60, 'Card', 'pi_3SgK2LF338nGzwqe0MhK64he', 'paid', '0000-00-00 00:00:00', 'ch_3SgK2LF338nGzwqe0Vllod9A', 'cancelled', 'Ayan 009', 'Mondal', 'srichanda srichanda', 'tt', 'udbsj ', 'hcfdhksahfsdhf', '534464', 'smfjdfjfjfj  wefjkwerjf', '9775460713', 'mondalayan.exe@gmail.com', 1, '', '', '', '', '', '', '', '', '', '', '2025-12-20 12:23:07', '2025-12-27 10:12:37'),
(100, 13, 'ORD-20251220-312034-100', NULL, 0.00, 8846.00, 8846.00, 'Card', 'pi_3SgMtHF338nGzwqe0OICm2kP', 'paid', '0000-00-00 00:00:00', 'ch_3SgMtHF338nGzwqe0b3Xkve5', 'confirmed', 'Ayan', 'Mondal', 'srichanda srichanda', 'udbsj ', 'tt', 'hcfdhksahfsdhf', '534464', 'smfjdfjfjfj  wefjkwerjf', '9775460713', 'mondalayan.exe@gmail.com', 0, 'hfsdjkfghjewsdkh', 'edefhwehfoiwehf', 'efhefhewqdfgfdgdfg', 'iefgheghoeh', 'iefoefh', 'efoewf', '645474', 'lk;ejfgwjfgweo', '4654677779', 'w@gmail.com', '2025-12-20 15:02:00', '2025-12-20 15:02:00'),
(101, 13, 'ORD-20251220-466950-101', NULL, 0.00, 1547.00, 1547.00, 'Card', 'pi_3SgMv4F338nGzwqe1pfk7rGJ', 'paid', '0000-00-00 00:00:00', 'ch_3SgMv4F338nGzwqe1CFLgAXH', 'confirmed', 'Ayan', 'Mondal', 'srichanda srichanda', 'udbsj ', 'tt', 'hcfdhksahfsdhf', '534464', 'smfjdfjfjfj  wefjkwerjf', '9775460713', 'mondalayan.exe@gmail.com', 0, 'hfsdjkfghjewsdkh', 'edefhwehfoiwehf', 'efhefhewqdfgfdgdfg', 'iefgheghoeh', 'iefoefh', 'efoewf', '645474', 'lk;ejfgwjfgweo', '4654677779', 'w@gmail.com', '2025-12-20 15:27:49', '2025-12-20 15:27:49'),
(102, 13, 'ORD-20251220-496380-102', 5, 406.80, 2034.00, 1627.20, 'Card', 'pi_3SgN7aF338nGzwqe0rmlLGW0', 'paid', '0000-00-00 00:00:00', 'ch_3SgN7aF338nGzwqe0AZDHpEy', 'confirmed', 'Ayan', 'Mondal', 'srichanda srichanda', 'udbsj ', 'tt', 'hcfdhksahfsdhf', '534464', 'smfjdfjfjfj  wefjkwerjf', '9775460713', 'mondalayan.exe@gmail.com', 0, 'hfsdjkfghjewsdkh', 'edefhwehfoiwehf', 'efhefhewqdfgfdgdfg', 'iefgheghoeh', 'iefoefh', 'efoewf', '645474', 'lk;ejfgwjfgweo', '4654677779', 'w@gmail.com', '2025-12-20 15:32:43', '2025-12-20 15:32:43'),
(103, 13, 'ORD-20251220-778336-103', NULL, 0.00, 1547.00, 1547.00, 'Card', 'pi_3SgNjIF338nGzwqe1MDxNbYf', 'paid', '0000-00-00 00:00:00', 'ch_3SgNjIF338nGzwqe15niQgNS', 'confirmed', 'me', 'Mondal', 'srichanda srichanda', 'udbsj ', 'tt', 'hcfdhksahfsdhf', '534464', 'smfjdfjfjfj  wefjkwerjf', '9775460713', 'mondalayan.exe@gmail.com', 0, 'hfsdjkfghjewsdkh', 'edefhwehfoiwehf', 'efhefhewqdfgfdgdfg', 'iefgheghoeh', 'iefoefh', 'efoewf', '645474', 'lk;ejfgwjfgweo', '4654677779', 'w@gmail.com', '2025-12-20 16:19:43', '2025-12-20 16:19:43'),
(104, 13, 'ORD-20251220-782995-104', NULL, 0.00, 732.00, 732.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'me', 'Mondal', 'srichanda srichanda', 'udbsj ', 'tt', 'hcfdhksahfsdhf', '534464', 'smfjdfjfjfj  wefjkwerjf', '9775460713', 'mondalayan.exe@gmail.com', 0, 'hfsdjkfghjewsdkh', 'edefhwehfoiwehf', 'efhefhewqdfgfdgdfg', 'iefgheghoeh', 'iefoefh', 'efoewf', '645474', 'lk;ejfgwjfgweo', '4654677779', 'w@gmail.com', '2025-12-20 16:20:29', '2025-12-20 16:20:29'),
(105, 24, 'ORD-20251220-794583-105', NULL, 0.00, 1547.00, 1547.00, 'Card', 'pi_3SgNlvF338nGzwqe1JibeM2A', 'paid', '0000-00-00 00:00:00', 'ch_3SgNlvF338nGzwqe1GJohe5L', 'confirmed', 'smriti', 'gaunia', 'kolkata golpalpur', 'wb', 'kolkata', 'ind', '700014', 'it dhsqesoqejqe', '7485965412', 'smriti@gmail.com', 1, '', '', '', '', '', '', '', '', '', '', '2025-12-20 16:22:25', '2025-12-20 16:22:25'),
(106, 25, 'ORD-20251220-811124-106', NULL, 0.00, 3476.00, 3476.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Fiona Humphrey', 'Courtney Coffey', 'Fugiat velit mollit', 'Sed ab velit quis ex', 'Aute ut veritatis et', 'Qui duis quod cupidi', '477777', 'Sit illum inventor', '1486577123', 'baqipyc@mailinator.com', 1, '', '', '', '', '', '', '', '', '', '', '2025-12-20 16:25:11', '2025-12-20 16:25:11'),
(107, 13, 'ORD-20251222-802161-107', NULL, 0.00, 8308.00, 8308.00, 'Card', 'pi_3Sh0oSF338nGzwqe0aQl1ruF', 'paid', '0000-00-00 00:00:00', 'ch_3Sh0oSF338nGzwqe0NUM5SwK', 'confirmed', 'koyek', 'Mondal', 'srichanda srichanda', 'udbsj ', 'tt', 'hcfdhksahfsdhf', '534464', 'smfjdfjfjfj  wefjkwerjf', '9775460713', 'mondalayan.exe@gmail.com', 0, 'hfsdjkfghjewsdkh', 'edefhwehfoiwehf', 'efhefhewqdfgfdgdfg', 'iefgheghoeh', 'iefoefh', 'efoewf', '645474', 'lk;ejfgwjfgweo', '4654677779', 'w@gmail.com', '2025-12-22 10:03:41', '2025-12-22 10:03:41'),
(108, 13, 'ORD-20251222-034057-108', NULL, 0.00, 732.00, 732.00, 'Card', 'pi_3Sh1PtF338nGzwqe07JjvmA6', 'paid', '0000-00-00 00:00:00', 'ch_3Sh1PtF338nGzwqe0pl48g2P', 'confirmed', 'koyek', 'Mondal', 'srichanda srichanda', 'udbsj ', 'tt', 'hcfdhksahfsdhf', '534464', 'smfjdfjfjfj  wefjkwerjf', '9775460713', 'mondalayan.exe@gmail.com', 0, 'hfsdjkfghjewsdkh', 'edefhwehfoiwehf', 'efhefhewqdfgfdgdfg', 'iefgheghoeh', 'iefoefh', 'efoewf', '645474', 'lk;ejfgwjfgweo', '4654677779', 'w@gmail.com', '2025-12-22 10:42:20', '2025-12-22 10:42:20'),
(109, 13, 'ORD-20251222-607994-109', 5, 2356.20, 11781.00, 9424.80, 'Card', 'pi_3Sh2uSF338nGzwqe0eBN5jdr', 'paid', '0000-00-00 00:00:00', 'ch_3Sh2uSF338nGzwqe0CnvKYza', 'cancelled', 'ayan', 'Mondal', 'srichanda srichanda', 'udbsj ', 'tt', 'hcfdhksahfsdhf', '534464', 'smfjdfjfjfj  wefjkwerjf', '9775460713', 'mondalayan.exe@gmail.com', 0, 'wwet', 'dqhjd', 'bfhf yt new town', 'idudihjjk', 'huihj', 'nisdfoij', '857874', 'v dvbedvfbveb', '9714644121', 'wq@gmail.com', '2025-12-22 12:17:59', '2025-12-22 21:58:05'),
(110, 13, 'ORD-20251224-143815-110', 4, 1000.00, 9917.00, 8917.00, 'Card', 'pi_3Shpm5F338nGzwqe0mdkDVDn', 'paid', '0000-00-00 00:00:00', 'ch_3Shp88F338nGzwqe0q1A2hOs', 'confirmed', 'Ayan ', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'uuhyb', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-24 15:47:18', '2025-12-24 15:47:18'),
(111, 13, 'ORD-20251224-398810-111', NULL, 0.00, 1200.00, 1200.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Ayan ', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'uuhyb', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-24 16:29:48', '2025-12-24 16:29:48'),
(112, 13, 'ORD-20251224-401096-112', NULL, 0.00, 869.00, 869.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Ayan ', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'uuhyb', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-24 16:30:10', '2025-12-24 16:30:10'),
(113, 13, 'ORD-20251224-531291-113', NULL, 0.00, 1512.00, 1512.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Ayan ', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'uuhyb', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-24 16:51:52', '2025-12-24 16:51:52'),
(114, 13, 'ORD-20251224-547737-114', NULL, 0.00, 643.00, 643.00, 'Card', 'pi_3ShqBFF338nGzwqe0bOuKZjJ', 'paid', '0000-00-00 00:00:00', 'ch_3ShqBFF338nGzwqe0tIkSPov', 'confirmed', 'Ayan  sd', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Nihil et a ea veniam', 'Officia animi fugia', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'uuhyb', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-24 16:54:37', '2025-12-24 16:54:37'),
(115, 13, 'ORD-20251224-744021-115', NULL, 0.00, 4832.00, 4832.00, 'Card', 'pi_3ShqguF338nGzwqe1BbmSu9V', 'paid', '0000-00-00 00:00:00', 'ch_3ShqguF338nGzwqe1XWL4Jgm', 'confirmed', 'Ayan ', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'uuhyb', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-24 17:27:20', '2025-12-24 17:27:20'),
(116, 13, 'ORD-20251224-752923-116', NULL, 0.00, 1547.00, 1547.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'cancelled', 'Ayan ', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'uuhyb', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-24 17:28:49', '2025-12-24 21:09:12'),
(117, 13, 'ORD-20251224-467285-117', NULL, 0.00, 689.00, 689.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Ayan ', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'uuhyb', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-24 22:14:32', '2025-12-24 22:14:32'),
(118, 13, 'ORD-20251224-529058-118', 5, 3736.40, 18682.00, 14945.60, 'Card', 'pi_3ShvKoF338nGzwqe1S32EBax', 'paid', '0000-00-00 00:00:00', 'ch_3ShvKoF338nGzwqe1Yx29XtF', 'confirmed', 'Ayan 001', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'uuhyb', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-24 22:24:50', '2025-12-24 22:24:50'),
(119, 13, 'ORD-20251227-131443-119', 5, 662.20, 3311.00, 2648.80, 'Card', 'pi_3SizwkF338nGzwqe1AbqPrbQ', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Ayan 001', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'uuhyb', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-27 21:31:54', '2025-12-27 21:31:54'),
(120, 13, 'ORD-20251227-150293-120', 5, 662.20, 3311.00, 2648.80, 'Card', 'pi_3Sj03lF338nGzwqe1pzeazfq', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Ayan 001', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'uuhyb', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-27 21:35:02', '2025-12-27 21:35:02'),
(121, 13, 'ORD-20251227-261964-121', 5, 662.20, 3311.00, 2648.80, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Ayan 001', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'uuhyb', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-27 21:53:39', '2025-12-27 21:53:39'),
(122, 13, 'ORD-20251227-263322-122', NULL, 0.00, 869.00, 869.00, 'Card', 'pi_3Sj0IoF338nGzwqe0K3GwSmZ', 'paid', '2025-12-27 22:39:34', 'ch_3Sj0IoF338nGzwqe0mID056S', 'confirmed', 'Ayan 001', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'uuhyb', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-27 21:53:53', '2025-12-27 21:53:53'),
(123, 13, 'ORD-20251227-638057-123', NULL, 0.00, 1547.00, 1547.00, 'Card', 'pi_3Sj1FvF338nGzwqe0SqoNNV7', 'paid', '2025-12-27 22:56:52', 'ch_3Sj1FvF338nGzwqe01j1Yb7g', 'confirmed', 'Ayan 001', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'uuhyb', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-27 22:56:20', '2025-12-27 22:56:20'),
(124, 13, 'ORD-20251228-235074-124', NULL, 0.00, 4556.00, 4556.00, 'Card', 'pi_3SjDDPF338nGzwqe0sCu6hVn', 'paid', '2025-12-28 11:42:53', 'ch_3SjDDPF338nGzwqe00bExzDO', 'confirmed', 'Ayan ', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-28 11:42:30', '2025-12-28 11:42:30'),
(125, 13, 'ORD-20251228-302679-125', 5, 1624.60, 8123.00, 6498.40, 'Card', 'pi_3SjDOJF338nGzwqe16lVKcCZ', 'paid', '2025-12-28 11:54:07', 'ch_3SjDOJF338nGzwqe1Z7ahw2D', 'confirmed', 'Ayan ', 'Mondal ss', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-28 11:53:46', '2025-12-28 11:53:46'),
(126, 13, 'ORD-20251228-382667-126', 4, 1000.00, 18932.00, 17932.00, 'Card', 'pi_3SjDbEF338nGzwqe1aOY7PYj', 'paid', '2025-12-28 12:07:34', 'ch_3SjDbEF338nGzwqe1umqDRaQ', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-28 12:07:06', '2025-12-28 12:07:06'),
(127, 13, 'ORD-20251228-391620-127', NULL, 0.00, 6335.00, 6335.00, 'Card', 'pi_3SjDcfF338nGzwqe1iiz8mlZ', 'paid', '2025-12-28 12:08:55', 'ch_3SjDcfF338nGzwqe1WVZndUZ', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-28 12:08:36', '2025-12-28 12:08:36'),
(128, 13, 'ORD-20251228-407291-128', NULL, 0.00, 1474.00, 1474.00, 'Card', 'pi_3SjDfBF338nGzwqe1zJiuzP0', 'paid', '2025-12-28 12:11:31', 'ch_3SjDfBF338nGzwqe1n5auuKh', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-28 12:11:12', '2025-12-28 12:11:12'),
(129, 13, 'ORD-20251228-412348-129', NULL, 0.00, 1474.00, 1474.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-28 12:12:03', '2025-12-28 12:12:03'),
(130, 13, 'ORD-20251228-414091-130', NULL, 0.00, 89.00, 89.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-28 12:12:20', '2025-12-28 12:12:20'),
(131, 13, 'ORD-20251228-002380-131', NULL, 0.00, 678.00, 678.00, 'Card', 'pi_3SjHoUF338nGzwqe1LtwStjE', 'paid', '2025-12-28 16:41:42', 'ch_3SjHoUF338nGzwqe1By7vP2W', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2025-12-28 16:37:03', '2025-12-28 16:37:03'),
(132, 26, 'ORD-20260103-063682-132', NULL, 0.00, 11000.00, 11000.00, 'Card', 'pi_3SlO2sF338nGzwqe0oqip4hm', 'paid', '2026-01-03 11:42:28', 'ch_3SlO2sF338nGzwqe0UM5KjIt', 'confirmed', 'demo', 'demo', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'demo@gmail.com', 1, '', '', '', '', '', '', '', '', '', '', '2026-01-03 11:40:36', '2026-01-03 11:40:36'),
(133, 13, 'ORD-20260103-467593-133', NULL, 0.00, 6570.00, 6570.00, 'Card', 'pi_3SlP5zF338nGzwqe08HkCTMz', 'paid', '2026-01-03 12:48:27', 'ch_3SlP5zF338nGzwqe0VKiRhZu', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 12:47:55', '2026-01-03 12:47:55'),
(134, 13, 'ORD-20260103-607639-134', NULL, 0.00, 6659.00, 6659.00, 'Card', 'pi_3SlPSbF338nGzwqe1arpGR9F', 'paid', '2026-01-03 13:11:37', 'ch_3SlPSbF338nGzwqe18pilxpX', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 13:11:16', '2026-01-03 13:11:16'),
(135, 13, 'ORD-20260103-704097-135', NULL, 0.00, 678.00, 678.00, 'Card', 'pi_3SlPi9F338nGzwqe1q8dwidR', 'paid', '2026-01-03 13:27:39', 'ch_3SlPi9F338nGzwqe1zGvvULV', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 13:27:20', '2026-01-03 13:27:20'),
(136, 13, 'ORD-20260103-714282-136', NULL, 0.00, 643.00, 643.00, 'Card', 'pi_3SlPjnF338nGzwqe0jqrDyfN', 'paid', '2026-01-03 13:29:18', 'ch_3SlPjnF338nGzwqe0N1CSB0z', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 13:29:02', '2026-01-03 13:29:02'),
(137, 13, 'ORD-20260103-749645-137', NULL, 0.00, 890.00, 890.00, 'Card', 'pi_3SlPpVF338nGzwqe15azuNA2', 'paid', '2026-01-03 13:35:12', 'ch_3SlPpVF338nGzwqe1FipOPSs', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 13:34:56', '2026-01-03 13:34:56'),
(138, 13, 'ORD-20260103-844430-138', NULL, 0.00, 785.00, 785.00, 'Card', 'pi_3SlQ4oF338nGzwqe1r5KzKxB', 'paid', '2026-01-03 13:51:04', 'ch_3SlQ4oF338nGzwqe1tSpByqV', 'confirmed', 'Ayan  kiu', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Nihil et a ea veniam', 'Officia animi fugia', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 13:50:44', '2026-01-03 13:50:44'),
(139, 13, 'ORD-20260103-911148-139', NULL, 0.00, 643.00, 643.00, 'Card', 'pi_3SlQFYF338nGzwqe1zPC1Q5B', 'paid', '2026-01-03 14:02:10', 'ch_3SlQFYF338nGzwqe1wL782mY', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 14:01:51', '2026-01-03 14:01:51'),
(140, 13, 'ORD-20260103-952244-140', NULL, 0.00, 643.00, 643.00, 'Card', 'pi_3SlQMBF338nGzwqe0eWCNMoR', 'paid', '2026-01-03 14:09:01', 'ch_3SlQMBF338nGzwqe0IRsTcB2', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 14:08:42', '2026-01-03 14:08:42'),
(141, 13, 'ORD-20260103-653547-141', NULL, 0.00, 89.00, 89.00, 'Card', 'pi_3SlSBHF338nGzwqe11F8vtXn', 'paid', '2026-01-03 16:05:57', 'ch_3SlSBHF338nGzwqe1c4VWmRK', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'jofi@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 16:05:35', '2026-01-03 16:05:35'),
(142, 13, 'ORD-20260103-721356-142', 5, 3644.00, 18220.00, 14576.00, 'Card', 'pi_3SlSMEF338nGzwqe1TSIjeYm', 'paid', '2026-01-03 16:17:10', 'ch_3SlSMEF338nGzwqe1pUo4EMa', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'mondalayan.exe@mailinator.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 16:16:53', '2026-01-03 16:16:53'),
(143, 13, 'ORD-20260103-729089-143', NULL, 0.00, 785.00, 785.00, 'Card', 'pi_3SlSNSF338nGzwqe18NmQnwp', 'paid', '2026-01-03 16:18:28', 'ch_3SlSNSF338nGzwqe14qq9jGB', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'mondalayan.exe@gmail.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 16:18:10', '2026-01-03 16:18:10'),
(144, 13, 'ORD-20260103-045096-144', NULL, 0.00, 600.00, 600.00, 'Card', 'pi_3SlTCQF338nGzwqe1PtbMVl7', 'paid', '2026-01-03 17:11:02', 'ch_3SlTCQF338nGzwqe12NZHy3D', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'mondalayan.exe@gmail.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 17:10:50', '2026-01-03 17:10:50'),
(145, 13, 'ORD-20260103-067781-145', NULL, 0.00, 600.00, 600.00, 'Card', 'pi_3SlTG6F338nGzwqe1xq2aFLG', 'paid', '2026-01-03 17:14:49', 'ch_3SlTG6F338nGzwqe1LOtxYeS', 'confirmed', 'Ayan ', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'mondalayan.exe@gmail.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 17:14:37', '2026-01-03 17:14:37'),
(146, 13, 'ORD-20260103-693586-146', 5, 2528.20, 12641.00, 10112.80, 'Card', 'pi_3SlUt2F338nGzwqe05fHzk41', 'paid', '2026-01-03 18:59:15', 'ch_3SlUt2F338nGzwqe0zIAgD61', 'confirmed', 'we', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'mondalayan.exe@gmail.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 18:58:55', '2026-01-03 18:58:55'),
(147, 13, 'ORD-20260103-739474-147', NULL, 0.00, 869.00, 869.00, 'Card', 'pi_3SlV0QF338nGzwqe1IWXXZGt', 'paid', '2026-01-03 19:06:45', 'ch_3SlV0QF338nGzwqe1E3BSCaR', 'confirmed', 'we', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'clutchdropkings@gmail.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 19:06:34', '2026-01-03 19:06:34'),
(148, 13, 'ORD-20260103-118267-148', NULL, 0.00, 3370.00, 3370.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'we', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'clutchdropkings@gmail.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 20:09:42', '2026-01-03 20:09:42'),
(149, 13, 'ORD-20260103-149071-149', NULL, 0.00, 1801.00, 1801.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'we', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'clutchdropkings@gmail.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 20:14:50', '2026-01-03 20:14:50'),
(150, 13, 'ORD-20260103-302710-150', NULL, 0.00, 7480.00, 7480.00, 'Card', 'pi_3SlWTHF338nGzwqe0WloIxNo', 'paid', '2026-01-03 20:40:42', 'ch_3SlWTHF338nGzwqe0QkuEGYT', 'confirmed', 'we', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'clutchdropkings@gmail.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-03 20:40:27', '2026-01-03 20:40:27'),
(151, 13, 'ORD-20260104-166483-151', 5, 990.60, 4953.00, 3962.40, 'Card', 'pi_3Sllj3F338nGzwqe0mpbLrYB', 'paid', '2026-01-04 12:57:58', 'ch_3Sllj3F338nGzwqe0rwPYOkp', 'confirmed', 'Ayan', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'clutchdropkings@gmail.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-04 12:57:44', '2026-01-04 12:57:44'),
(152, 13, 'ORD-20260104-014490-152', 5, 4701.80, 23509.00, 18807.20, 'Card', 'pi_3SlqX7F338nGzwqe0ew5LZCj', 'paid', '2026-01-04 18:06:03', 'ch_3SlqX7F338nGzwqe0LPJK4S2', 'confirmed', 'Ayan', 'Mondal ', 'Officiis porro beata 90000000000000000', 'Officia animi fugia', 'Nihil et a ea veniam', 'Dolor aliquip id qui ', '554888', 'Ex rerum est in mol', '1365353450', 'clutchdropkings@gmail.com', 0, 'koyel', 'Naskar', 'ggg hgighiiugfg gu ', 'fyfg', 'huihj', 'eewx', '589474', 'polkmnghfgyghj', '7842156853', 'koyelnaskar@gmail.com', '2026-01-04 18:05:44', '2026-01-04 18:05:44'),
(153, 26, 'ORD-20260105-014793-153', 5, 313.60, 1568.00, 1254.40, 'Card', 'pi_3SmDwmF338nGzwqe1JvLQYBg', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'demo@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-05 19:05:47', '2026-01-05 19:05:47'),
(154, 26, 'ORD-20260105-045160-154', 5, 313.60, 1568.00, 1254.40, 'Card', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'demo@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-05 19:10:51', '2026-01-05 19:10:51'),
(155, 26, 'ORD-20260105-054194-155', 5, 313.60, 1568.00, 1254.40, 'Card', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'demo@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-05 19:12:21', '2026-01-05 19:12:21'),
(156, 26, 'ORD-20260105-123365-156', 5, 313.60, 1568.00, 1254.40, 'Card', 'pi_3SmEKrF338nGzwqe1gSDpF9J', 'paid', '2026-01-05 19:31:19', 'ch_3SmEKrF338nGzwqe1Rur2dFS', 'confirmed', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'demo@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-05 19:23:53', '2026-01-05 19:23:53'),
(157, 26, 'ORD-20260105-179424-157', 5, 2135.60, 10678.00, 8542.40, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'demo@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-05 19:33:14', '2026-01-05 19:33:14'),
(158, 26, 'ORD-20260107-472947-158', NULL, 0.00, 678.00, 678.00, 'Card', 'pi_3SmpYmF338nGzwqe1p3Byiub', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'demo@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 11:15:29', '2026-01-07 11:15:29'),
(159, 26, 'ORD-20260107-480568-159', NULL, 0.00, 678.00, 678.00, 'Card', 'pi_3SmpZyF338nGzwqe16eCY5De', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'demo@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 11:16:45', '2026-01-07 11:16:45'),
(160, 26, 'ORD-20260107-510078-160', NULL, 0.00, 678.00, 678.00, 'Card', 'pi_3SmpejF338nGzwqe1AErO3lL', 'paid', '2026-01-07 11:21:53', 'ch_3SmpejF338nGzwqe1moUej8p', 'confirmed', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'demo@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 11:21:40', '2026-01-07 11:21:40'),
(161, 26, 'ORD-20260107-672095-161', NULL, 0.00, 600.00, 600.00, 'Card', 'pi_3Smq4rF338nGzwqe1bAZmBMr', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'demo@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 11:48:40', '2026-01-07 11:48:40'),
(162, 26, 'ORD-20260107-717960-162', NULL, 0.00, 600.00, 600.00, 'Card', 'pi_3SmqCGF338nGzwqe1gJtQTIm', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'demo@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 11:56:19', '2026-01-07 11:56:19'),
(163, 26, 'ORD-20260107-739892-163', NULL, 0.00, 600.00, 600.00, 'Card', 'pi_3SmqFnF338nGzwqe0wYIJfF3', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'demo@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 11:59:58', '2026-01-07 11:59:58');
INSERT INTO `orders` (`id`, `user_id`, `order_number`, `coupon_id`, `coupon_discount`, `total_amount`, `final_amount`, `payment_method`, `payment_intent_id`, `payment_status`, `paid_at`, `transaction_id`, `order_status`, `b_fname`, `b_lname`, `b_address`, `b_state`, `b_city`, `b_country`, `b_pin`, `b_landmark`, `b_phone`, `b_email`, `is_shipping_same`, `s_fname`, `s_lname`, `s_address`, `s_state`, `s_city`, `s_country`, `s_pin`, `s_landmark`, `s_phone`, `s_email`, `created_at`, `updated_at`) VALUES
(164, 26, 'ORD-20260107-767293-164', NULL, 0.00, 600.00, 600.00, 'Card', 'pi_3SmqKDF338nGzwqe0xN5lHkF', 'paid', '2026-01-07 12:04:43', 'ch_3SmqKDF338nGzwqe0xNF91eO', 'confirmed', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'demo@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 12:04:32', '2026-01-07 12:04:32'),
(165, 26, 'ORD-20260107-258643-165', 5, 22155.00, 110775.00, 88620.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 16:13:06', '2026-01-07 16:13:06'),
(166, 26, 'ORD-20260107-300018-166', NULL, 0.00, 1989.00, 1989.00, 'Card', 'pi_3SmuJRF338nGzwqe1WlS9vfT', 'paid', '2026-01-07 16:20:14', 'ch_3SmuJRF338nGzwqe11Sw5I3b', 'confirmed', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 16:20:00', '2026-01-07 16:20:00'),
(167, 26, 'ORD-20260107-494119-167', NULL, 0.00, 2500.00, 2500.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 16:52:21', '2026-01-07 16:52:21'),
(168, 26, 'ORD-20260107-617095-168', NULL, 0.00, 842.00, 842.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 17:12:50', '2026-01-07 17:12:50'),
(169, 26, 'ORD-20260107-699312-169', NULL, 0.00, 678.00, 678.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 17:26:33', '2026-01-07 17:26:33'),
(170, 26, 'ORD-20260107-205962-170', NULL, 0.00, 408.00, 408.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 18:50:59', '2026-01-07 18:50:59'),
(171, 26, 'ORD-20260107-297559-171', NULL, 0.00, 600.00, 600.00, 'Card', 'pi_3SmwuKF338nGzwqe1NRqRoEl', 'paid', '2026-01-07 19:06:31', 'ch_3SmwuKF338nGzwqe1AER9kkC', 'confirmed', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 19:06:15', '2026-01-07 19:06:15'),
(172, 26, 'ORD-20260107-447162-172', NULL, 0.00, 1224.00, 1224.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 19:31:11', '2026-01-07 19:31:11'),
(173, 26, 'ORD-20260107-474072-173', NULL, 0.00, 3778.00, 3778.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 19:35:40', '2026-01-07 19:35:40'),
(174, 26, 'ORD-20260107-479425-174', NULL, 0.00, 3586.00, 3586.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 19:36:34', '2026-01-07 19:36:34'),
(175, 26, 'ORD-20260107-494887-175', NULL, 0.00, 1385.00, 1385.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 19:39:08', '2026-01-07 19:39:08'),
(176, 26, 'ORD-20260107-507490-176', NULL, 0.00, 785.00, 785.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 19:41:14', '2026-01-07 19:41:14'),
(177, 26, 'ORD-20260107-518160-177', NULL, 0.00, 678.00, 678.00, 'Cash On Delivery', '', 'pending', '0000-00-00 00:00:00', '', 'pending', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 19:43:01', '2026-01-07 19:43:01'),
(178, 26, 'ORD-20260107-550668-178', 4, 1000.00, 4175.00, 3175.00, 'Card', 'pi_3SmxZ9F338nGzwqe0VpBTPX9', 'paid', '2026-01-07 19:48:38', 'ch_3SmxZ9F338nGzwqe0VDXScN4', 'confirmed', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 19:48:26', '2026-01-07 19:48:26'),
(179, 26, 'ORD-20260107-569746-179', NULL, 0.00, 1389.00, 1389.00, 'Card', 'pi_3SmxcDF338nGzwqe1z3ivpR6', 'paid', '2026-01-07 19:51:51', 'ch_3SmxcDF338nGzwqe1DI2EMBc', 'confirmed', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 19:51:37', '2026-01-07 19:51:37'),
(180, 26, 'ORD-0000000180', NULL, 0.00, 3178.00, 3178.00, 'Card', 'pi_3SmxnbF338nGzwqe1yicSnNP', 'paid', '2026-01-07 20:03:35', 'ch_3SmxnbF338nGzwqe1VxAk6lK', 'confirmed', 'demo', 'demo1 2', 'demo  demo demo 22', 'trbfdbe ', 'west bengal', 'india', '874569', 'uyt.wri ndfnsdjfn', '1234567891', 'clutchdropkings@gmail.com', 0, 'demo 009', 'demo', 'demo shhipping kfnnf wiifd w', 'ijfw', 'ede', 'fows', '895552', 'fe,;mfmm efkoefj', '9877774522', 'demoiiu@gmail.com', '2026-01-07 20:03:23', '2026-01-07 20:03:23'),
(181, 28, 'ORD-0000000181', 5, 2000.00, 10000.00, 8000.00, 'Card', 'pi_3SnHfLF338nGzwqe1Rdq0zy2', 'paid', '2026-01-08 17:16:27', 'ch_3SnHfLF338nGzwqe1E3nZa7j', 'confirmed', 'Ira May', 'Kermit Zamora', 'Ullamco dolor est a', 'Sequi in distinctio', 'Tenetur exercitation', 'Ipsum aliquip veniam', '546574', 'Cupiditate aliquid s', '1621157641', 'clutchdropkings@gmail.com', 1, '', '', '', '', '', '', '', '', '', '', '2026-01-08 17:16:10', '2026-01-08 17:16:10'),
(182, 28, 'ORD-0000000182', 5, 1711.20, 8556.00, 6844.80, 'Card', 'pi_3SnHxMF338nGzwqe0qcUNUgC', 'paid', '2026-01-08 17:35:00', 'ch_3SnHxMF338nGzwqe0JfkD6dd', 'confirmed', 'Ira May', 'Kermit Zamora', 'Ullamco dolor est a', 'Sequi in distinctio', 'Tenetur exercitation', 'Ipsum aliquip veniam', '546574', 'Cupiditate aliquid s', '1621157641', 'clutchdropkings@gmail.com', 1, '', '', '', '', '', '', '', '', '', '', '2026-01-08 17:34:47', '2026-01-08 17:34:47'),
(183, 28, 'ORD-0000000183', 5, 1711.20, 8556.00, 6844.80, 'Card', 'pi_3SnHxtF338nGzwqe1sTYr4yZ', 'paid', '2026-01-08 17:35:38', 'ch_3SnHxtF338nGzwqe1A2MamQk', 'confirmed', 'Ira May', 'Kermit Zamora', 'Ullamco dolor est a', 'Sequi in distinctio', 'Tenetur exercitation', 'Ipsum aliquip veniam', '546574', 'Cupiditate aliquid s', '1621157641', 'clutchdropkings@gmail.com', 1, '', '', '', '', '', '', '', '', '', '', '2026-01-08 17:35:21', '2026-01-08 17:35:21'),
(184, 33, 'ORD-0000000184', NULL, 0.00, 4582.00, 4582.00, 'Card', 'pi_3Sod4uF338nGzwqe096tlITW', 'paid', '2026-01-12 10:20:25', 'ch_3Sod4uF338nGzwqe0iCh8nLp', 'confirmed', 'Aline Savage', 'Nehru Floyd', 'Hic aliqua Magna co', 'Voluptas nisi pariat', 'Est in similique do', 'Minim sunt nostrum b', '774545', 'Quidem non minima mi', '1517776514', 'clutchdropkings@gmail.com', 0, 'Melanie Slater', 'Mollie Franklin', 'Non expedita nihil c', 'Molestias eius molli', 'Nisi sunt duis fuga', 'Aut consequat Conse', '265659', 'Totam neque cupidata', '1976338405', 'peverowoji@mailinator.com', '2026-01-12 10:20:08', '2026-01-12 10:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int DEFAULT '1',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=469 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total`, `created_at`, `updated_at`) VALUES
(103, 41, 13, 15, 600.00, 9000.00, '2025-12-18 14:06:10', '2025-12-18 14:06:10'),
(102, 41, 14, 9, 89.00, 801.00, '2025-12-18 14:06:10', '2025-12-18 14:06:10'),
(101, 41, 11, 7, 604.00, 4228.00, '2025-12-18 14:06:10', '2025-12-18 14:06:10'),
(100, 41, 10, 8, 890.00, 7120.00, '2025-12-18 14:06:10', '2025-12-18 14:06:10'),
(99, 40, 13, 15, 600.00, 9000.00, '2025-12-18 13:58:27', '2025-12-18 13:58:27'),
(98, 40, 14, 9, 89.00, 801.00, '2025-12-18 13:58:27', '2025-12-18 13:58:27'),
(97, 40, 11, 7, 604.00, 4228.00, '2025-12-18 13:58:27', '2025-12-18 13:58:27'),
(96, 40, 10, 8, 890.00, 7120.00, '2025-12-18 13:58:27', '2025-12-18 13:58:27'),
(95, 39, 13, 1, 600.00, 600.00, '2025-12-18 13:17:39', '2025-12-18 13:17:39'),
(94, 39, 14, 9, 89.00, 801.00, '2025-12-18 13:17:39', '2025-12-18 13:17:39'),
(93, 39, 11, 7, 604.00, 4228.00, '2025-12-18 13:17:39', '2025-12-18 13:17:39'),
(92, 39, 10, 8, 890.00, 7120.00, '2025-12-18 13:17:39', '2025-12-18 13:17:39'),
(91, 38, 13, 1, 600.00, 600.00, '2025-12-18 11:59:00', '2025-12-18 11:59:00'),
(90, 38, 14, 9, 89.00, 801.00, '2025-12-18 11:59:00', '2025-12-18 11:59:00'),
(89, 38, 11, 7, 604.00, 4228.00, '2025-12-18 11:59:00', '2025-12-18 11:59:00'),
(88, 38, 10, 8, 890.00, 7120.00, '2025-12-18 11:59:00', '2025-12-18 11:59:00'),
(87, 37, 13, 1, 600.00, 600.00, '2025-12-18 11:48:10', '2025-12-18 11:48:10'),
(86, 37, 14, 9, 89.00, 801.00, '2025-12-18 11:48:10', '2025-12-18 11:48:10'),
(85, 37, 11, 7, 604.00, 4228.00, '2025-12-18 11:48:10', '2025-12-18 11:48:10'),
(84, 37, 10, 8, 890.00, 7120.00, '2025-12-18 11:48:10', '2025-12-18 11:48:10'),
(83, 36, 17, 5, 678.00, 3390.00, '2025-12-18 11:46:23', '2025-12-18 11:46:23'),
(82, 36, 15, 4, 643.00, 2572.00, '2025-12-18 11:46:23', '2025-12-18 11:46:23'),
(81, 36, 10, 4, 890.00, 3560.00, '2025-12-18 11:46:23', '2025-12-18 11:46:23'),
(80, 35, 15, 1, 643.00, 643.00, '2025-12-18 10:26:17', '2025-12-18 10:26:17'),
(79, 35, 16, 1, 869.00, 869.00, '2025-12-18 10:26:17', '2025-12-18 10:26:17'),
(78, 34, 9, 6, 911.00, 5466.00, '2025-12-17 00:47:20', '2025-12-17 00:47:20'),
(77, 34, 10, 7, 890.00, 6230.00, '2025-12-17 00:47:20', '2025-12-17 00:47:20'),
(76, 34, 16, 7, 869.00, 6083.00, '2025-12-17 00:47:20', '2025-12-17 00:47:20'),
(75, 34, 17, 2, 678.00, 1356.00, '2025-12-17 00:47:20', '2025-12-17 00:47:20'),
(74, 33, 14, 1, 89.00, 89.00, '2025-12-17 00:42:39', '2025-12-17 00:42:39'),
(73, 33, 17, 3, 678.00, 2034.00, '2025-12-17 00:42:39', '2025-12-17 00:42:39'),
(72, 33, 15, 5, 643.00, 3215.00, '2025-12-17 00:42:39', '2025-12-17 00:42:39'),
(71, 33, 16, 5, 869.00, 4345.00, '2025-12-17 00:42:39', '2025-12-17 00:42:39'),
(104, 42, 10, 8, 890.00, 7120.00, '2025-12-18 14:10:56', '2025-12-18 14:10:56'),
(105, 42, 11, 7, 604.00, 4228.00, '2025-12-18 14:10:56', '2025-12-18 14:10:56'),
(106, 42, 14, 9, 89.00, 801.00, '2025-12-18 14:10:56', '2025-12-18 14:10:56'),
(107, 42, 13, 15, 600.00, 9000.00, '2025-12-18 14:10:56', '2025-12-18 14:10:56'),
(108, 43, 10, 8, 890.00, 7120.00, '2025-12-18 14:30:31', '2025-12-18 14:30:31'),
(109, 43, 11, 7, 604.00, 4228.00, '2025-12-18 14:30:31', '2025-12-18 14:30:31'),
(110, 43, 14, 9, 89.00, 801.00, '2025-12-18 14:30:31', '2025-12-18 14:30:31'),
(111, 43, 13, 15, 600.00, 9000.00, '2025-12-18 14:30:31', '2025-12-18 14:30:31'),
(112, 44, 10, 8, 890.00, 7120.00, '2025-12-18 14:31:48', '2025-12-18 14:31:48'),
(113, 44, 11, 7, 604.00, 4228.00, '2025-12-18 14:31:48', '2025-12-18 14:31:48'),
(114, 44, 14, 9, 89.00, 801.00, '2025-12-18 14:31:48', '2025-12-18 14:31:48'),
(115, 44, 13, 15, 600.00, 9000.00, '2025-12-18 14:31:48', '2025-12-18 14:31:48'),
(116, 45, 10, 8, 890.00, 7120.00, '2025-12-18 14:32:08', '2025-12-18 14:32:08'),
(117, 45, 11, 7, 604.00, 4228.00, '2025-12-18 14:32:08', '2025-12-18 14:32:08'),
(118, 45, 14, 9, 89.00, 801.00, '2025-12-18 14:32:08', '2025-12-18 14:32:08'),
(119, 45, 13, 15, 600.00, 9000.00, '2025-12-18 14:32:08', '2025-12-18 14:32:08'),
(120, 46, 10, 8, 890.00, 7120.00, '2025-12-18 14:32:44', '2025-12-18 14:32:44'),
(121, 46, 11, 7, 604.00, 4228.00, '2025-12-18 14:32:44', '2025-12-18 14:32:44'),
(122, 46, 14, 9, 89.00, 801.00, '2025-12-18 14:32:44', '2025-12-18 14:32:44'),
(123, 46, 13, 15, 600.00, 9000.00, '2025-12-18 14:32:44', '2025-12-18 14:32:44'),
(124, 47, 10, 8, 890.00, 7120.00, '2025-12-18 14:35:12', '2025-12-18 14:35:12'),
(125, 47, 11, 7, 604.00, 4228.00, '2025-12-18 14:35:12', '2025-12-18 14:35:12'),
(126, 47, 14, 9, 89.00, 801.00, '2025-12-18 14:35:12', '2025-12-18 14:35:12'),
(127, 47, 13, 15, 600.00, 9000.00, '2025-12-18 14:35:12', '2025-12-18 14:35:12'),
(128, 48, 10, 8, 890.00, 7120.00, '2025-12-18 15:14:09', '2025-12-18 15:14:09'),
(129, 48, 11, 7, 604.00, 4228.00, '2025-12-18 15:14:09', '2025-12-18 15:14:09'),
(130, 48, 14, 9, 89.00, 801.00, '2025-12-18 15:14:09', '2025-12-18 15:14:09'),
(131, 48, 13, 15, 600.00, 9000.00, '2025-12-18 15:14:09', '2025-12-18 15:14:09'),
(132, 49, 10, 18, 890.00, 16020.00, '2025-12-18 15:20:07', '2025-12-18 15:20:07'),
(133, 49, 11, 16, 604.00, 9664.00, '2025-12-18 15:20:07', '2025-12-18 15:20:07'),
(134, 49, 14, 9, 89.00, 801.00, '2025-12-18 15:20:07', '2025-12-18 15:20:07'),
(135, 49, 13, 15, 600.00, 9000.00, '2025-12-18 15:20:07', '2025-12-18 15:20:07'),
(136, 50, 10, 18, 890.00, 16020.00, '2025-12-18 15:37:07', '2025-12-18 15:37:07'),
(137, 50, 11, 16, 604.00, 9664.00, '2025-12-18 15:37:07', '2025-12-18 15:37:07'),
(138, 51, 10, 18, 890.00, 16020.00, '2025-12-18 16:20:44', '2025-12-18 16:20:44'),
(139, 51, 11, 16, 604.00, 9664.00, '2025-12-18 16:20:44', '2025-12-18 16:20:44'),
(140, 52, 10, 18, 890.00, 16020.00, '2025-12-18 16:25:18', '2025-12-18 16:25:18'),
(141, 52, 11, 16, 604.00, 9664.00, '2025-12-18 16:25:18', '2025-12-18 16:25:18'),
(142, 53, 10, 18, 890.00, 16020.00, '2025-12-18 16:32:38', '2025-12-18 16:32:38'),
(143, 53, 11, 16, 604.00, 9664.00, '2025-12-18 16:32:38', '2025-12-18 16:32:38'),
(144, 53, 13, 3, 600.00, 1800.00, '2025-12-18 16:32:38', '2025-12-18 16:32:38'),
(145, 53, 12, 5, 785.00, 3925.00, '2025-12-18 16:32:38', '2025-12-18 16:32:38'),
(146, 54, 15, 5, 643.00, 3215.00, '2025-12-18 20:38:17', '2025-12-18 20:38:17'),
(147, 54, 14, 1, 89.00, 89.00, '2025-12-18 20:38:17', '2025-12-18 20:38:17'),
(148, 54, 12, 4, 785.00, 3140.00, '2025-12-18 20:38:17', '2025-12-18 20:38:17'),
(149, 54, 10, 6, 890.00, 5340.00, '2025-12-18 20:38:17', '2025-12-18 20:38:17'),
(150, 54, 9, 6, 911.00, 5466.00, '2025-12-18 20:38:17', '2025-12-18 20:38:17'),
(151, 55, 15, 5, 643.00, 3215.00, '2025-12-18 20:43:56', '2025-12-18 20:43:56'),
(152, 55, 14, 1, 89.00, 89.00, '2025-12-18 20:43:56', '2025-12-18 20:43:56'),
(153, 55, 12, 4, 785.00, 3140.00, '2025-12-18 20:43:56', '2025-12-18 20:43:56'),
(154, 55, 10, 6, 890.00, 5340.00, '2025-12-18 20:43:56', '2025-12-18 20:43:56'),
(155, 55, 9, 6, 911.00, 5466.00, '2025-12-18 20:43:56', '2025-12-18 20:43:56'),
(156, 56, 15, 5, 643.00, 3215.00, '2025-12-18 20:47:17', '2025-12-18 20:47:17'),
(157, 56, 14, 1, 89.00, 89.00, '2025-12-18 20:47:17', '2025-12-18 20:47:17'),
(158, 56, 12, 4, 785.00, 3140.00, '2025-12-18 20:47:17', '2025-12-18 20:47:17'),
(159, 56, 10, 6, 890.00, 5340.00, '2025-12-18 20:47:17', '2025-12-18 20:47:17'),
(160, 56, 9, 6, 911.00, 5466.00, '2025-12-18 20:47:17', '2025-12-18 20:47:17'),
(161, 57, 15, 5, 643.00, 3215.00, '2025-12-18 20:48:56', '2025-12-18 20:48:56'),
(162, 57, 14, 1, 89.00, 89.00, '2025-12-18 20:48:56', '2025-12-18 20:48:56'),
(163, 57, 12, 4, 785.00, 3140.00, '2025-12-18 20:48:56', '2025-12-18 20:48:56'),
(164, 57, 10, 6, 890.00, 5340.00, '2025-12-18 20:48:56', '2025-12-18 20:48:56'),
(165, 57, 9, 6, 911.00, 5466.00, '2025-12-18 20:48:56', '2025-12-18 20:48:56'),
(166, 58, 15, 5, 643.00, 3215.00, '2025-12-18 20:58:46', '2025-12-18 20:58:46'),
(167, 58, 14, 1, 89.00, 89.00, '2025-12-18 20:58:46', '2025-12-18 20:58:46'),
(168, 58, 12, 4, 785.00, 3140.00, '2025-12-18 20:58:46', '2025-12-18 20:58:46'),
(169, 58, 10, 6, 890.00, 5340.00, '2025-12-18 20:58:46', '2025-12-18 20:58:46'),
(170, 58, 9, 6, 911.00, 5466.00, '2025-12-18 20:58:46', '2025-12-18 20:58:46'),
(171, 59, 15, 5, 643.00, 3215.00, '2025-12-18 21:11:59', '2025-12-18 21:11:59'),
(172, 59, 14, 1, 89.00, 89.00, '2025-12-18 21:11:59', '2025-12-18 21:11:59'),
(173, 59, 12, 4, 785.00, 3140.00, '2025-12-18 21:11:59', '2025-12-18 21:11:59'),
(174, 59, 10, 6, 890.00, 5340.00, '2025-12-18 21:11:59', '2025-12-18 21:11:59'),
(175, 59, 9, 6, 911.00, 5466.00, '2025-12-18 21:11:59', '2025-12-18 21:11:59'),
(176, 60, 15, 5, 643.00, 3215.00, '2025-12-18 21:16:02', '2025-12-18 21:16:02'),
(177, 60, 14, 1, 89.00, 89.00, '2025-12-18 21:16:02', '2025-12-18 21:16:02'),
(178, 60, 12, 4, 785.00, 3140.00, '2025-12-18 21:16:02', '2025-12-18 21:16:02'),
(179, 60, 10, 6, 890.00, 5340.00, '2025-12-18 21:16:02', '2025-12-18 21:16:02'),
(180, 60, 9, 6, 911.00, 5466.00, '2025-12-18 21:16:02', '2025-12-18 21:16:02'),
(181, 61, 15, 5, 643.00, 3215.00, '2025-12-18 21:18:36', '2025-12-18 21:18:36'),
(182, 61, 14, 1, 89.00, 89.00, '2025-12-18 21:18:36', '2025-12-18 21:18:36'),
(183, 61, 12, 4, 785.00, 3140.00, '2025-12-18 21:18:36', '2025-12-18 21:18:36'),
(184, 61, 10, 6, 890.00, 5340.00, '2025-12-18 21:18:36', '2025-12-18 21:18:36'),
(185, 61, 9, 6, 911.00, 5466.00, '2025-12-18 21:18:36', '2025-12-18 21:18:36'),
(186, 62, 15, 5, 643.00, 3215.00, '2025-12-18 21:19:44', '2025-12-18 21:19:44'),
(187, 62, 14, 1, 89.00, 89.00, '2025-12-18 21:19:44', '2025-12-18 21:19:44'),
(188, 62, 12, 4, 785.00, 3140.00, '2025-12-18 21:19:44', '2025-12-18 21:19:44'),
(189, 62, 10, 6, 890.00, 5340.00, '2025-12-18 21:19:44', '2025-12-18 21:19:44'),
(190, 62, 9, 6, 911.00, 5466.00, '2025-12-18 21:19:44', '2025-12-18 21:19:44'),
(191, 63, 15, 5, 643.00, 3215.00, '2025-12-18 21:20:55', '2025-12-18 21:20:55'),
(192, 63, 14, 1, 89.00, 89.00, '2025-12-18 21:20:55', '2025-12-18 21:20:55'),
(193, 63, 12, 4, 785.00, 3140.00, '2025-12-18 21:20:55', '2025-12-18 21:20:55'),
(194, 63, 10, 6, 890.00, 5340.00, '2025-12-18 21:20:55', '2025-12-18 21:20:55'),
(195, 63, 9, 6, 911.00, 5466.00, '2025-12-18 21:20:55', '2025-12-18 21:20:55'),
(196, 64, 15, 5, 643.00, 3215.00, '2025-12-18 21:25:01', '2025-12-18 21:25:01'),
(197, 64, 14, 1, 89.00, 89.00, '2025-12-18 21:25:01', '2025-12-18 21:25:01'),
(198, 64, 12, 4, 785.00, 3140.00, '2025-12-18 21:25:01', '2025-12-18 21:25:01'),
(199, 64, 10, 6, 890.00, 5340.00, '2025-12-18 21:25:01', '2025-12-18 21:25:01'),
(200, 64, 9, 6, 911.00, 5466.00, '2025-12-18 21:25:01', '2025-12-18 21:25:01'),
(201, 65, 12, 4, 785.00, 3140.00, '2025-12-18 21:26:42', '2025-12-18 21:26:42'),
(202, 65, 10, 6, 890.00, 5340.00, '2025-12-18 21:26:42', '2025-12-18 21:26:42'),
(203, 65, 9, 6, 911.00, 5466.00, '2025-12-18 21:26:42', '2025-12-18 21:26:42'),
(204, 66, 12, 4, 785.00, 3140.00, '2025-12-18 21:29:37', '2025-12-18 21:29:37'),
(205, 66, 10, 6, 890.00, 5340.00, '2025-12-18 21:29:37', '2025-12-18 21:29:37'),
(206, 66, 9, 6, 911.00, 5466.00, '2025-12-18 21:29:37', '2025-12-18 21:29:37'),
(207, 67, 12, 4, 785.00, 3140.00, '2025-12-18 22:32:33', '2025-12-18 22:32:33'),
(208, 67, 10, 6, 890.00, 5340.00, '2025-12-18 22:32:33', '2025-12-18 22:32:33'),
(209, 67, 9, 6, 911.00, 5466.00, '2025-12-18 22:32:33', '2025-12-18 22:32:33'),
(210, 68, 13, 4, 600.00, 2400.00, '2025-12-18 22:36:07', '2025-12-18 22:36:07'),
(211, 68, 12, 4, 785.00, 3140.00, '2025-12-18 22:36:07', '2025-12-18 22:36:07'),
(212, 70, 13, 4, 600.00, 2400.00, '2025-12-18 22:50:57', '2025-12-18 22:50:57'),
(213, 70, 12, 4, 785.00, 3140.00, '2025-12-18 22:50:57', '2025-12-18 22:50:57'),
(214, 71, 13, 4, 600.00, 2400.00, '2025-12-18 23:10:59', '2025-12-18 23:10:59'),
(215, 71, 12, 4, 785.00, 3140.00, '2025-12-18 23:10:59', '2025-12-18 23:10:59'),
(216, 72, 13, 4, 600.00, 2400.00, '2025-12-18 23:26:50', '2025-12-18 23:26:50'),
(217, 72, 12, 4, 785.00, 3140.00, '2025-12-18 23:26:50', '2025-12-18 23:26:50'),
(218, 73, 13, 4, 600.00, 2400.00, '2025-12-18 23:36:04', '2025-12-18 23:36:04'),
(219, 73, 12, 18, 785.00, 14130.00, '2025-12-18 23:36:04', '2025-12-18 23:36:04'),
(220, 74, 15, 5, 643.00, 3215.00, '2025-12-18 23:40:42', '2025-12-18 23:40:42'),
(221, 74, 17, 7, 678.00, 4746.00, '2025-12-18 23:40:42', '2025-12-18 23:40:42'),
(222, 74, 16, 6, 869.00, 5214.00, '2025-12-18 23:40:42', '2025-12-18 23:40:42'),
(223, 74, 12, 23, 785.00, 18055.00, '2025-12-18 23:40:42', '2025-12-18 23:40:42'),
(224, 74, 9, 16, 911.00, 14576.00, '2025-12-18 23:40:42', '2025-12-18 23:40:42'),
(225, 74, 11, 6, 604.00, 3624.00, '2025-12-18 23:40:42', '2025-12-18 23:40:42'),
(226, 75, 14, 3, 89.00, 267.00, '2025-12-19 09:41:22', '2025-12-19 09:41:22'),
(227, 75, 13, 1, 600.00, 600.00, '2025-12-19 09:41:22', '2025-12-19 09:41:22'),
(228, 75, 12, 8, 785.00, 6280.00, '2025-12-19 09:41:22', '2025-12-19 09:41:22'),
(229, 75, 11, 1, 604.00, 604.00, '2025-12-19 09:41:22', '2025-12-19 09:41:22'),
(230, 75, 10, 5, 890.00, 4450.00, '2025-12-19 09:41:22', '2025-12-19 09:41:22'),
(231, 75, 9, 6, 911.00, 5466.00, '2025-12-19 09:41:22', '2025-12-19 09:41:22'),
(232, 75, 1, 3, 375.00, 1125.00, '2025-12-19 09:41:22', '2025-12-19 09:41:22'),
(233, 75, 3, 4, 852.00, 3408.00, '2025-12-19 09:41:22', '2025-12-19 09:41:22'),
(234, 75, 2, 3, 799.00, 2397.00, '2025-12-19 09:41:22', '2025-12-19 09:41:22'),
(235, 76, 16, 2, 869.00, 1738.00, '2025-12-19 11:07:06', '2025-12-19 11:07:06'),
(236, 76, 17, 3, 678.00, 2034.00, '2025-12-19 11:07:06', '2025-12-19 11:07:06'),
(237, 77, 17, 2, 678.00, 1356.00, '2025-12-19 12:35:37', '2025-12-19 12:35:37'),
(238, 77, 16, 5, 869.00, 4345.00, '2025-12-19 12:35:37', '2025-12-19 12:35:37'),
(239, 78, 17, 1, 678.00, 678.00, '2025-12-19 12:40:07', '2025-12-19 12:40:07'),
(240, 79, 16, 1, 869.00, 869.00, '2025-12-19 12:41:08', '2025-12-19 12:41:08'),
(241, 80, 13, 4, 600.00, 2400.00, '2025-12-19 14:54:29', '2025-12-19 14:54:29'),
(242, 80, 12, 6, 785.00, 4710.00, '2025-12-19 14:54:29', '2025-12-19 14:54:29'),
(243, 81, 14, 3, 89.00, 267.00, '2025-12-19 18:07:22', '2025-12-19 18:07:22'),
(244, 81, 13, 4, 600.00, 2400.00, '2025-12-19 18:07:22', '2025-12-19 18:07:22'),
(245, 81, 12, 3, 785.00, 2355.00, '2025-12-19 18:07:22', '2025-12-19 18:07:22'),
(246, 82, 17, 1, 678.00, 678.00, '2025-12-19 19:22:17', '2025-12-19 19:22:17'),
(247, 82, 16, 1, 869.00, 869.00, '2025-12-19 19:22:17', '2025-12-19 19:22:17'),
(248, 82, 15, 1, 643.00, 643.00, '2025-12-19 19:22:17', '2025-12-19 19:22:17'),
(249, 83, 17, 1, 678.00, 678.00, '2025-12-19 19:22:21', '2025-12-19 19:22:21'),
(250, 83, 16, 1, 869.00, 869.00, '2025-12-19 19:22:21', '2025-12-19 19:22:21'),
(251, 83, 15, 1, 643.00, 643.00, '2025-12-19 19:22:21', '2025-12-19 19:22:21'),
(252, 84, 17, 1, 678.00, 678.00, '2025-12-19 19:23:34', '2025-12-19 19:23:34'),
(253, 84, 16, 1, 869.00, 869.00, '2025-12-19 19:23:34', '2025-12-19 19:23:34'),
(254, 84, 15, 1, 643.00, 643.00, '2025-12-19 19:23:34', '2025-12-19 19:23:34'),
(255, 85, 17, 1, 678.00, 678.00, '2025-12-19 19:24:39', '2025-12-19 19:24:39'),
(256, 85, 16, 1, 869.00, 869.00, '2025-12-19 19:24:39', '2025-12-19 19:24:39'),
(257, 85, 15, 1, 643.00, 643.00, '2025-12-19 19:24:39', '2025-12-19 19:24:39'),
(258, 86, 17, 1, 678.00, 678.00, '2025-12-19 19:24:58', '2025-12-19 19:24:58'),
(259, 86, 16, 1, 869.00, 869.00, '2025-12-19 19:24:58', '2025-12-19 19:24:58'),
(260, 86, 15, 1, 643.00, 643.00, '2025-12-19 19:24:58', '2025-12-19 19:24:58'),
(261, 87, 17, 1, 678.00, 678.00, '2025-12-19 19:25:18', '2025-12-19 19:25:18'),
(262, 87, 16, 1, 869.00, 869.00, '2025-12-19 19:25:18', '2025-12-19 19:25:18'),
(263, 87, 15, 1, 643.00, 643.00, '2025-12-19 19:25:18', '2025-12-19 19:25:18'),
(264, 88, 17, 1, 678.00, 678.00, '2025-12-19 19:25:47', '2025-12-19 19:25:47'),
(265, 88, 16, 1, 869.00, 869.00, '2025-12-19 19:25:47', '2025-12-19 19:25:47'),
(266, 88, 15, 1, 643.00, 643.00, '2025-12-19 19:25:47', '2025-12-19 19:25:47'),
(267, 89, 16, 7, 869.00, 6083.00, '2025-12-19 19:58:10', '2025-12-19 19:58:10'),
(268, 89, 15, 5, 643.00, 3215.00, '2025-12-19 19:58:10', '2025-12-19 19:58:10'),
(269, 89, 12, 7, 785.00, 5495.00, '2025-12-19 19:58:10', '2025-12-19 19:58:10'),
(270, 90, 16, 7, 869.00, 6083.00, '2025-12-19 20:19:29', '2025-12-19 20:19:29'),
(271, 90, 15, 5, 643.00, 3215.00, '2025-12-19 20:19:29', '2025-12-19 20:19:29'),
(272, 90, 12, 7, 785.00, 5495.00, '2025-12-19 20:19:29', '2025-12-19 20:19:29'),
(273, 91, 16, 7, 869.00, 6083.00, '2025-12-19 20:24:07', '2025-12-19 20:24:07'),
(274, 91, 15, 5, 643.00, 3215.00, '2025-12-19 20:24:07', '2025-12-19 20:24:07'),
(275, 91, 12, 7, 785.00, 5495.00, '2025-12-19 20:24:07', '2025-12-19 20:24:07'),
(276, 92, 16, 7, 869.00, 6083.00, '2025-12-19 20:24:53', '2025-12-19 20:24:53'),
(277, 92, 15, 5, 643.00, 3215.00, '2025-12-19 20:24:53', '2025-12-19 20:24:53'),
(278, 92, 12, 7, 785.00, 5495.00, '2025-12-19 20:24:53', '2025-12-19 20:24:53'),
(279, 93, 16, 7, 869.00, 6083.00, '2025-12-19 21:54:08', '2025-12-19 21:54:08'),
(280, 93, 15, 5, 643.00, 3215.00, '2025-12-19 21:54:08', '2025-12-19 21:54:08'),
(281, 93, 12, 7, 785.00, 5495.00, '2025-12-19 21:54:08', '2025-12-19 21:54:08'),
(282, 93, 11, 1, 604.00, 604.00, '2025-12-19 21:54:08', '2025-12-19 21:54:08'),
(283, 94, 16, 1, 869.00, 869.00, '2025-12-19 22:02:46', '2025-12-19 22:02:46'),
(284, 94, 15, 1, 643.00, 643.00, '2025-12-19 22:02:46', '2025-12-19 22:02:46'),
(285, 95, 17, 1, 678.00, 678.00, '2025-12-19 22:18:28', '2025-12-19 22:18:28'),
(286, 95, 16, 2, 869.00, 1738.00, '2025-12-19 22:18:28', '2025-12-19 22:18:28'),
(287, 96, 15, 2, 643.00, 1286.00, '2025-12-19 22:19:26', '2025-12-19 22:19:26'),
(288, 96, 12, 3, 785.00, 2355.00, '2025-12-19 22:19:26', '2025-12-19 22:19:26'),
(289, 97, 17, 1, 678.00, 678.00, '2025-12-19 22:35:53', '2025-12-19 22:35:53'),
(290, 97, 16, 1, 869.00, 869.00, '2025-12-19 22:35:53', '2025-12-19 22:35:53'),
(291, 98, 17, 1, 678.00, 678.00, '2025-12-19 22:36:34', '2025-12-19 22:36:34'),
(292, 99, 14, 3, 89.00, 267.00, '2025-12-20 12:23:07', '2025-12-20 12:23:07'),
(293, 99, 13, 2, 600.00, 1200.00, '2025-12-20 12:23:07', '2025-12-20 12:23:07'),
(294, 99, 12, 5, 785.00, 3925.00, '2025-12-20 12:23:07', '2025-12-20 12:23:07'),
(295, 100, 16, 5, 869.00, 4345.00, '2025-12-20 15:02:00', '2025-12-20 15:02:00'),
(296, 100, 15, 7, 643.00, 4501.00, '2025-12-20 15:02:00', '2025-12-20 15:02:00'),
(297, 101, 17, 1, 678.00, 678.00, '2025-12-20 15:27:49', '2025-12-20 15:27:49'),
(298, 101, 16, 1, 869.00, 869.00, '2025-12-20 15:27:49', '2025-12-20 15:27:49'),
(299, 102, 17, 3, 678.00, 2034.00, '2025-12-20 15:32:43', '2025-12-20 15:32:43'),
(300, 103, 17, 1, 678.00, 678.00, '2025-12-20 16:19:43', '2025-12-20 16:19:43'),
(301, 103, 16, 1, 869.00, 869.00, '2025-12-20 16:19:43', '2025-12-20 16:19:43'),
(302, 104, 15, 1, 643.00, 643.00, '2025-12-20 16:20:29', '2025-12-20 16:20:29'),
(303, 104, 14, 1, 89.00, 89.00, '2025-12-20 16:20:29', '2025-12-20 16:20:29'),
(304, 105, 17, 1, 678.00, 678.00, '2025-12-20 16:22:25', '2025-12-20 16:22:25'),
(305, 105, 16, 1, 869.00, 869.00, '2025-12-20 16:22:25', '2025-12-20 16:22:25'),
(306, 106, 16, 4, 869.00, 3476.00, '2025-12-20 16:25:11', '2025-12-20 16:25:11'),
(307, 107, 17, 3, 678.00, 2034.00, '2025-12-22 10:03:41', '2025-12-22 10:03:41'),
(308, 107, 16, 5, 869.00, 4345.00, '2025-12-22 10:03:41', '2025-12-22 10:03:41'),
(309, 107, 15, 3, 643.00, 1929.00, '2025-12-22 10:03:41', '2025-12-22 10:03:41'),
(310, 108, 15, 1, 643.00, 643.00, '2025-12-22 10:42:20', '2025-12-22 10:42:20'),
(311, 108, 14, 1, 89.00, 89.00, '2025-12-22 10:42:20', '2025-12-22 10:42:20'),
(312, 109, 17, 5, 678.00, 3390.00, '2025-12-22 12:17:59', '2025-12-22 12:17:59'),
(313, 109, 16, 5, 869.00, 4345.00, '2025-12-22 12:17:59', '2025-12-22 12:17:59'),
(314, 109, 15, 4, 643.00, 2572.00, '2025-12-22 12:17:59', '2025-12-22 12:17:59'),
(315, 109, 12, 1, 785.00, 785.00, '2025-12-22 12:17:59', '2025-12-22 12:17:59'),
(316, 109, 13, 1, 600.00, 600.00, '2025-12-22 12:17:59', '2025-12-22 12:17:59'),
(317, 109, 14, 1, 89.00, 89.00, '2025-12-22 12:17:59', '2025-12-22 12:17:59'),
(318, 110, 16, 5, 869.00, 4345.00, '2025-12-24 15:47:18', '2025-12-24 15:47:18'),
(319, 110, 15, 4, 643.00, 2572.00, '2025-12-24 15:47:18', '2025-12-24 15:47:18'),
(320, 110, 13, 5, 600.00, 3000.00, '2025-12-24 15:47:18', '2025-12-24 15:47:18'),
(321, 111, 13, 2, 600.00, 1200.00, '2025-12-24 16:29:48', '2025-12-24 16:29:48'),
(322, 112, 16, 1, 869.00, 869.00, '2025-12-24 16:30:10', '2025-12-24 16:30:10'),
(323, 113, 16, 1, 869.00, 869.00, '2025-12-24 16:51:52', '2025-12-24 16:51:52'),
(324, 113, 15, 1, 643.00, 643.00, '2025-12-24 16:51:52', '2025-12-24 16:51:52'),
(325, 114, 15, 1, 643.00, 643.00, '2025-12-24 16:54:37', '2025-12-24 16:54:37'),
(326, 115, 17, 2, 678.00, 1356.00, '2025-12-24 17:27:20', '2025-12-24 17:27:20'),
(327, 115, 16, 4, 869.00, 3476.00, '2025-12-24 17:27:20', '2025-12-24 17:27:20'),
(328, 116, 16, 1, 869.00, 869.00, '2025-12-24 17:28:49', '2025-12-24 17:28:49'),
(329, 116, 17, 1, 678.00, 678.00, '2025-12-24 17:28:49', '2025-12-24 17:28:49'),
(330, 117, 14, 1, 89.00, 89.00, '2025-12-24 22:14:32', '2025-12-24 22:14:32'),
(331, 117, 13, 1, 600.00, 600.00, '2025-12-24 22:14:32', '2025-12-24 22:14:32'),
(332, 118, 13, 6, 600.00, 3600.00, '2025-12-24 22:24:50', '2025-12-24 22:24:50'),
(333, 118, 12, 7, 785.00, 5495.00, '2025-12-24 22:24:50', '2025-12-24 22:24:50'),
(334, 118, 15, 7, 643.00, 4501.00, '2025-12-24 22:24:50', '2025-12-24 22:24:50'),
(335, 118, 16, 3, 869.00, 2607.00, '2025-12-24 22:24:50', '2025-12-24 22:24:50'),
(336, 118, 17, 3, 678.00, 2034.00, '2025-12-24 22:24:50', '2025-12-24 22:24:50'),
(337, 118, 14, 5, 89.00, 445.00, '2025-12-24 22:24:50', '2025-12-24 22:24:50'),
(338, 119, 14, 4, 89.00, 356.00, '2025-12-27 21:31:54', '2025-12-27 21:31:54'),
(339, 119, 13, 1, 600.00, 600.00, '2025-12-27 21:31:54', '2025-12-27 21:31:54'),
(340, 119, 12, 3, 785.00, 2355.00, '2025-12-27 21:31:54', '2025-12-27 21:31:54'),
(341, 120, 14, 4, 89.00, 356.00, '2025-12-27 21:35:02', '2025-12-27 21:35:02'),
(342, 120, 13, 1, 600.00, 600.00, '2025-12-27 21:35:02', '2025-12-27 21:35:02'),
(343, 120, 12, 3, 785.00, 2355.00, '2025-12-27 21:35:02', '2025-12-27 21:35:02'),
(344, 121, 14, 4, 89.00, 356.00, '2025-12-27 21:53:39', '2025-12-27 21:53:39'),
(345, 121, 13, 1, 600.00, 600.00, '2025-12-27 21:53:39', '2025-12-27 21:53:39'),
(346, 121, 12, 3, 785.00, 2355.00, '2025-12-27 21:53:39', '2025-12-27 21:53:39'),
(347, 122, 16, 1, 869.00, 869.00, '2025-12-27 21:53:53', '2025-12-27 21:53:53'),
(348, 123, 17, 1, 678.00, 678.00, '2025-12-27 22:56:20', '2025-12-27 22:56:20'),
(349, 123, 16, 1, 869.00, 869.00, '2025-12-27 22:56:20', '2025-12-27 22:56:20'),
(350, 124, 14, 4, 89.00, 356.00, '2025-12-28 11:42:30', '2025-12-28 11:42:30'),
(351, 124, 13, 7, 600.00, 4200.00, '2025-12-28 11:42:30', '2025-12-28 11:42:30'),
(352, 125, 15, 5, 643.00, 3215.00, '2025-12-28 11:53:46', '2025-12-28 11:53:46'),
(353, 125, 14, 3, 89.00, 267.00, '2025-12-28 11:53:46', '2025-12-28 11:53:46'),
(354, 125, 16, 3, 869.00, 2607.00, '2025-12-28 11:53:46', '2025-12-28 11:53:46'),
(355, 125, 17, 3, 678.00, 2034.00, '2025-12-28 11:53:46', '2025-12-28 11:53:46'),
(356, 126, 13, 4, 600.00, 2400.00, '2025-12-28 12:07:06', '2025-12-28 12:07:06'),
(357, 126, 12, 5, 785.00, 3925.00, '2025-12-28 12:07:06', '2025-12-28 12:07:06'),
(358, 126, 10, 7, 890.00, 6230.00, '2025-12-28 12:07:06', '2025-12-28 12:07:06'),
(359, 126, 9, 7, 911.00, 6377.00, '2025-12-28 12:07:06', '2025-12-28 12:07:06'),
(360, 127, 10, 2, 890.00, 1780.00, '2025-12-28 12:08:36', '2025-12-28 12:08:36'),
(361, 127, 9, 5, 911.00, 4555.00, '2025-12-28 12:08:36', '2025-12-28 12:08:36'),
(362, 128, 13, 1, 600.00, 600.00, '2025-12-28 12:11:12', '2025-12-28 12:11:12'),
(363, 128, 12, 1, 785.00, 785.00, '2025-12-28 12:11:12', '2025-12-28 12:11:12'),
(364, 128, 14, 1, 89.00, 89.00, '2025-12-28 12:11:12', '2025-12-28 12:11:12'),
(365, 129, 14, 1, 89.00, 89.00, '2025-12-28 12:12:03', '2025-12-28 12:12:03'),
(366, 129, 13, 1, 600.00, 600.00, '2025-12-28 12:12:03', '2025-12-28 12:12:03'),
(367, 129, 12, 1, 785.00, 785.00, '2025-12-28 12:12:03', '2025-12-28 12:12:03'),
(368, 130, 14, 1, 89.00, 89.00, '2025-12-28 12:12:20', '2025-12-28 12:12:20'),
(369, 131, 17, 1, 678.00, 678.00, '2025-12-28 16:37:03', '2025-12-28 16:37:03'),
(370, 132, 13, 6, 600.00, 3600.00, '2026-01-03 11:40:36', '2026-01-03 11:40:36'),
(371, 132, 14, 6, 89.00, 534.00, '2026-01-03 11:40:36', '2026-01-03 11:40:36'),
(372, 132, 17, 5, 678.00, 3390.00, '2026-01-03 11:40:36', '2026-01-03 11:40:36'),
(373, 132, 16, 4, 869.00, 3476.00, '2026-01-03 11:40:36', '2026-01-03 11:40:36'),
(374, 133, 17, 3, 678.00, 2034.00, '2026-01-03 12:47:55', '2026-01-03 12:47:55'),
(375, 133, 16, 3, 869.00, 2607.00, '2026-01-03 12:47:55', '2026-01-03 12:47:55'),
(376, 133, 15, 3, 643.00, 1929.00, '2026-01-03 12:47:55', '2026-01-03 12:47:55'),
(377, 134, 17, 3, 678.00, 2034.00, '2026-01-03 13:11:16', '2026-01-03 13:11:16'),
(378, 134, 16, 3, 869.00, 2607.00, '2026-01-03 13:11:16', '2026-01-03 13:11:16'),
(379, 134, 15, 3, 643.00, 1929.00, '2026-01-03 13:11:16', '2026-01-03 13:11:16'),
(380, 134, 14, 1, 89.00, 89.00, '2026-01-03 13:11:16', '2026-01-03 13:11:16'),
(381, 135, 17, 1, 678.00, 678.00, '2026-01-03 13:27:20', '2026-01-03 13:27:20'),
(382, 136, 15, 1, 643.00, 643.00, '2026-01-03 13:29:02', '2026-01-03 13:29:02'),
(383, 137, 10, 1, 890.00, 890.00, '2026-01-03 13:34:56', '2026-01-03 13:34:56'),
(384, 138, 12, 1, 785.00, 785.00, '2026-01-03 13:50:44', '2026-01-03 13:50:44'),
(385, 139, 15, 1, 643.00, 643.00, '2026-01-03 14:01:51', '2026-01-03 14:01:51'),
(386, 140, 15, 1, 643.00, 643.00, '2026-01-03 14:08:42', '2026-01-03 14:08:42'),
(387, 141, 14, 1, 89.00, 89.00, '2026-01-03 16:05:35', '2026-01-03 16:05:35'),
(388, 142, 9, 20, 911.00, 18220.00, '2026-01-03 16:16:53', '2026-01-03 16:16:53'),
(389, 143, 12, 1, 785.00, 785.00, '2026-01-03 16:18:10', '2026-01-03 16:18:10'),
(390, 144, 13, 1, 600.00, 600.00, '2026-01-03 17:10:50', '2026-01-03 17:10:50'),
(391, 145, 13, 1, 600.00, 600.00, '2026-01-03 17:14:37', '2026-01-03 17:14:37'),
(392, 146, 16, 4, 869.00, 3476.00, '2026-01-03 18:58:55', '2026-01-03 18:58:55'),
(393, 146, 15, 5, 643.00, 3215.00, '2026-01-03 18:58:55', '2026-01-03 18:58:55'),
(394, 146, 10, 5, 890.00, 4450.00, '2026-01-03 18:58:55', '2026-01-03 18:58:55'),
(395, 146, 1, 4, 375.00, 1500.00, '2026-01-03 18:58:55', '2026-01-03 18:58:55'),
(396, 147, 16, 1, 869.00, 869.00, '2026-01-03 19:06:34', '2026-01-03 19:06:34'),
(397, 148, 12, 2, 785.00, 1570.00, '2026-01-03 20:09:42', '2026-01-03 20:09:42'),
(398, 148, 13, 3, 600.00, 1800.00, '2026-01-03 20:09:42', '2026-01-03 20:09:42'),
(399, 149, 10, 1, 890.00, 890.00, '2026-01-03 20:14:50', '2026-01-03 20:14:50'),
(400, 149, 9, 1, 911.00, 911.00, '2026-01-03 20:14:50', '2026-01-03 20:14:50'),
(401, 150, 13, 2, 600.00, 1200.00, '2026-01-03 20:40:27', '2026-01-03 20:40:27'),
(402, 150, 12, 8, 785.00, 6280.00, '2026-01-03 20:40:27', '2026-01-03 20:40:27'),
(403, 151, 16, 2, 869.00, 1738.00, '2026-01-04 12:57:44', '2026-01-04 12:57:44'),
(404, 151, 15, 5, 643.00, 3215.00, '2026-01-04 12:57:44', '2026-01-04 12:57:44'),
(405, 152, 17, 7, 678.00, 4746.00, '2026-01-04 18:05:44', '2026-01-04 18:05:44'),
(406, 152, 16, 7, 869.00, 6083.00, '2026-01-04 18:05:44', '2026-01-04 18:05:44'),
(407, 152, 15, 5, 643.00, 3215.00, '2026-01-04 18:05:44', '2026-01-04 18:05:44'),
(408, 152, 13, 4, 600.00, 2400.00, '2026-01-04 18:05:44', '2026-01-04 18:05:44'),
(409, 152, 12, 9, 785.00, 7065.00, '2026-01-04 18:05:44', '2026-01-04 18:05:44'),
(410, 153, 17, 1, 678.00, 678.00, '2026-01-05 19:05:47', '2026-01-05 19:05:47'),
(411, 153, 10, 1, 890.00, 890.00, '2026-01-05 19:05:47', '2026-01-05 19:05:47'),
(412, 154, 17, 1, 678.00, 678.00, '2026-01-05 19:10:51', '2026-01-05 19:10:51'),
(413, 154, 10, 1, 890.00, 890.00, '2026-01-05 19:10:51', '2026-01-05 19:10:51'),
(414, 155, 17, 1, 678.00, 678.00, '2026-01-05 19:12:21', '2026-01-05 19:12:21'),
(415, 155, 10, 1, 890.00, 890.00, '2026-01-05 19:12:21', '2026-01-05 19:12:21'),
(416, 156, 17, 1, 678.00, 678.00, '2026-01-05 19:23:53', '2026-01-05 19:23:53'),
(417, 156, 10, 1, 890.00, 890.00, '2026-01-05 19:23:53', '2026-01-05 19:23:53'),
(418, 157, 17, 1, 678.00, 678.00, '2026-01-05 19:33:14', '2026-01-05 19:33:14'),
(419, 157, 18, 4, 2500.00, 10000.00, '2026-01-05 19:33:14', '2026-01-05 19:33:14'),
(420, 158, 17, 1, 678.00, 678.00, '2026-01-07 11:15:29', '2026-01-07 11:15:29'),
(421, 159, 17, 1, 678.00, 678.00, '2026-01-07 11:16:45', '2026-01-07 11:16:45'),
(422, 160, 17, 1, 678.00, 678.00, '2026-01-07 11:21:40', '2026-01-07 11:21:40'),
(423, 161, 13, 1, 600.00, 600.00, '2026-01-07 11:48:40', '2026-01-07 11:48:40'),
(424, 162, 13, 1, 600.00, 600.00, '2026-01-07 11:56:19', '2026-01-07 11:56:19'),
(425, 163, 13, 1, 600.00, 600.00, '2026-01-07 11:59:58', '2026-01-07 11:59:58'),
(426, 164, 13, 1, 600.00, 600.00, '2026-01-07 12:04:32', '2026-01-07 12:04:32'),
(427, 165, 13, 15, 600.00, 9000.00, '2026-01-07 16:13:06', '2026-01-07 16:13:06'),
(428, 165, 12, 15, 785.00, 11775.00, '2026-01-07 16:13:06', '2026-01-07 16:13:06'),
(429, 165, 18, 36, 2500.00, 90000.00, '2026-01-07 16:13:06', '2026-01-07 16:13:06'),
(430, 166, 12, 1, 785.00, 785.00, '2026-01-07 16:20:00', '2026-01-07 16:20:00'),
(431, 166, 11, 1, 604.00, 604.00, '2026-01-07 16:20:00', '2026-01-07 16:20:00'),
(432, 166, 13, 1, 600.00, 600.00, '2026-01-07 16:20:00', '2026-01-07 16:20:00'),
(433, 167, 18, 1, 2500.00, 2500.00, '2026-01-07 16:52:21', '2026-01-07 16:52:21'),
(434, 168, 6, 1, 842.00, 842.00, '2026-01-07 17:12:50', '2026-01-07 17:12:50'),
(435, 169, 17, 1, 678.00, 678.00, '2026-01-07 17:26:33', '2026-01-07 17:26:33'),
(436, 170, 19, 1, 408.00, 408.00, '2026-01-07 18:50:59', '2026-01-07 18:50:59'),
(437, 171, 13, 1, 600.00, 600.00, '2026-01-07 19:06:15', '2026-01-07 19:06:15'),
(438, 172, 19, 3, 408.00, 1224.00, '2026-01-07 19:31:11', '2026-01-07 19:31:11'),
(439, 173, 18, 1, 2500.00, 2500.00, '2026-01-07 19:35:40', '2026-01-07 19:35:40'),
(440, 173, 17, 1, 678.00, 678.00, '2026-01-07 19:35:40', '2026-01-07 19:35:40'),
(441, 173, 13, 1, 600.00, 600.00, '2026-01-07 19:35:40', '2026-01-07 19:35:40'),
(442, 174, 18, 1, 2500.00, 2500.00, '2026-01-07 19:36:34', '2026-01-07 19:36:34'),
(443, 174, 19, 1, 408.00, 408.00, '2026-01-07 19:36:34', '2026-01-07 19:36:34'),
(444, 174, 17, 1, 678.00, 678.00, '2026-01-07 19:36:34', '2026-01-07 19:36:34'),
(445, 175, 13, 1, 600.00, 600.00, '2026-01-07 19:39:08', '2026-01-07 19:39:08'),
(446, 175, 12, 1, 785.00, 785.00, '2026-01-07 19:39:08', '2026-01-07 19:39:08'),
(447, 176, 12, 1, 785.00, 785.00, '2026-01-07 19:41:14', '2026-01-07 19:41:14'),
(448, 177, 17, 1, 678.00, 678.00, '2026-01-07 19:43:01', '2026-01-07 19:43:01'),
(449, 178, 13, 1, 600.00, 600.00, '2026-01-07 19:48:26', '2026-01-07 19:48:26'),
(450, 178, 12, 1, 785.00, 785.00, '2026-01-07 19:48:26', '2026-01-07 19:48:26'),
(451, 178, 11, 1, 604.00, 604.00, '2026-01-07 19:48:26', '2026-01-07 19:48:26'),
(452, 178, 10, 1, 890.00, 890.00, '2026-01-07 19:48:26', '2026-01-07 19:48:26'),
(453, 178, 9, 1, 911.00, 911.00, '2026-01-07 19:48:26', '2026-01-07 19:48:26'),
(454, 178, 8, 1, 385.00, 385.00, '2026-01-07 19:48:26', '2026-01-07 19:48:26'),
(455, 179, 12, 1, 785.00, 785.00, '2026-01-07 19:51:37', '2026-01-07 19:51:37'),
(456, 179, 11, 1, 604.00, 604.00, '2026-01-07 19:51:37', '2026-01-07 19:51:37'),
(457, 180, 18, 1, 2500.00, 2500.00, '2026-01-07 20:03:23', '2026-01-07 20:03:23'),
(458, 180, 17, 1, 678.00, 678.00, '2026-01-07 20:03:23', '2026-01-07 20:03:23'),
(459, 181, 18, 4, 2500.00, 10000.00, '2026-01-08 17:16:10', '2026-01-08 17:16:10'),
(460, 182, 12, 4, 785.00, 3140.00, '2026-01-08 17:34:47', '2026-01-08 17:34:47'),
(461, 182, 13, 5, 600.00, 3000.00, '2026-01-08 17:34:47', '2026-01-08 17:34:47'),
(462, 182, 11, 4, 604.00, 2416.00, '2026-01-08 17:34:47', '2026-01-08 17:34:47'),
(463, 183, 12, 4, 785.00, 3140.00, '2026-01-08 17:35:21', '2026-01-08 17:35:21'),
(464, 183, 13, 5, 600.00, 3000.00, '2026-01-08 17:35:21', '2026-01-08 17:35:21'),
(465, 183, 11, 4, 604.00, 2416.00, '2026-01-08 17:35:21', '2026-01-08 17:35:21'),
(466, 184, 13, 2, 600.00, 1200.00, '2026-01-12 10:20:08', '2026-01-12 10:20:08'),
(467, 184, 12, 2, 785.00, 1570.00, '2026-01-12 10:20:08', '2026-01-12 10:20:08'),
(468, 184, 11, 3, 604.00, 1812.00, '2026-01-12 10:20:08', '2026-01-12 10:20:08');

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
  `slug` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sulg` (`slug`(191))
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `quantity`, `unit_id`, `status`, `is_available`, `is_featured`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Forrest Wise', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 375.00, '2', 275, 4, 0, 0, 0, 'forrest-wise', '2025-11-24 17:58:07', '2025-11-24 17:58:07', '2025-11-24 17:58:07'),
(2, 'Suki Griffin', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 799.00, '1', 444, 2, 0, 0, 0, 'suki-griffin', '2025-11-24 20:28:27', '2025-11-24 20:28:27', '2025-11-24 20:28:27'),
(3, 'Uriah Galloway', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 852.00, '1', 353, 4, 0, 0, 0, 'uriah-galloway', '2025-11-24 20:37:08', '2025-11-24 20:37:08', '2025-11-24 20:37:08'),
(4, 'Daphne Dickerson', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 93.00, '3', 125, 4, 0, 0, 0, 'daphne-dickerson', '2025-11-24 20:37:45', '2025-11-24 20:37:45', '2025-11-24 20:37:45'),
(6, 'Maggy Carney', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 842.00, '3', 277, 3, 0, 0, 1, 'maggy-carney', '2025-11-24 20:42:05', '2025-11-24 20:42:05', '2025-11-24 20:42:05'),
(7, 'Candice Evans', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 452.00, '2', 716, 4, 0, 0, 1, 'candice-evans', '2025-11-24 20:42:38', '2025-11-24 20:42:38', '2025-11-24 20:42:38'),
(8, 'Aquila Ayers', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 385.00, '3', 207, 3, 0, 0, 1, 'aquila-ayers', '2025-11-24 20:43:27', '2025-11-24 20:43:27', '2025-11-24 20:43:27'),
(9, 'Zane Hill', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 911.00, '2', 528, 3, 0, 0, 0, 'zane-hill', '2025-11-24 20:52:23', '2025-11-24 20:52:23', '2025-11-24 20:52:23'),
(10, 'Sophia Wyatt', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 890.00, '1', 472, 2, 0, 0, 1, 'sophia-wyatt', '2025-11-24 20:52:49', '2025-11-24 20:52:49', '2025-11-24 20:52:49'),
(11, 'Kasimir Mcclain', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 604.00, '3', 435, 4, 0, 0, 0, 'kasimir-mcclain', '2025-11-24 20:53:21', '2025-11-24 20:53:21', '2025-11-24 20:53:21'),
(12, 'Allegra Lawrence', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu', 785.00, '3', 655, 3, 0, 0, 0, 'allegra-lawrence', '2025-11-24 20:54:02', '2025-11-24 20:54:02', '2025-11-24 20:54:02'),
(13, 'Mariko Peters', '<p>dasdasdasfdffweedfhfhwehf&nbsp; ewjefewfewfjf&nbsp; nc wffwjfqjfqjfffjef&nbsp; fjefjef fjffo0qifeeikfiiiiiiiiiiiiiiiiiiiiiiiiiiiqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq', 600.00, '2', 511, 2, 0, 0, 1, 'mariko-peters', '2025-11-25 17:28:44', '2025-11-25 17:28:44', '2025-11-25 17:28:44'),
(14, 'Gail Abbott', '<p>sSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS</p>\r\n', 89.00, '2', 372, 1, 1, 0, 1, 'gail-abbott', '2025-11-25 17:34:05', '2025-11-25 17:34:05', '2025-11-25 17:34:05'),
(15, 'Octavia Warner', '<p>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</p>\r\n', 643.00, '1', 646, 2, 1, 1, 1, 'octavia-warner', '2025-11-25 17:35:22', '2025-11-25 17:35:22', '2025-11-25 17:35:22'),
(16, 'Jorden Hale', '<p>assssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss s ssssssssssssssssssssssafdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</p>\r\n', 869.00, '2', 506, 3, 0, 1, 0, 'jorden-hale', '2025-11-25 17:39:31', '2025-11-25 17:39:31', '2025-11-25 17:39:31'),
(17, 'Emmanuel Pollard', '<p>ddddddddddddddddddddddddddddddddddddddddddddddwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww</p>\n', 678.00, '1', 623, 3, 0, 0, 1, 'emmanuel-pollard', '2025-11-25 17:40:34', '2025-11-25 17:40:34', '2025-11-25 17:40:34'),
(18, 'newqw uiyt', '<h1>sSS NFSDJF <strong>34 </strong>fgsf kfgsdkfg&nbsp; gsdgerg fsdfnn fhhfiuehfuefhhoiefh9oewufwoieasf iwse f9wsew esdfwsedruoifjuosewrjf9sefws e 9soivgjseoijsoifujoiwswhiusej foiawsejfu sevfv sed hsehf v s hsdr</h1>\r\n', 2500.00, '3', 500, 1, 0, 0, 1, 'newqw-uiyt', '2026-01-05 14:06:42', '2026-01-05 14:06:42', '2026-01-05 14:06:42'),
(19, 'newqw uiyt', '<p>hdhgedrt&nbsp; uuwed hf iegiuqegfqrf qhgfdqehg qefdhuqe qdhqedy3wyHAUFHDUQYFWEW sdfhe ffnkmfjifuewfuyew 8yfheufhejfhjkhvishgfvlishliksjvb sivkbs ueh&nbsp; &nbsp;f i i werfijeefe jkfjdj d ssowsoifjkn s&nbsp; ijfgirgrd jgrjijgirgngngjiirjgrkggrvkjrgjirk&', 408.00, '1', 82, 4, 0, 0, 1, 'newqw-uiyt-3', '2026-01-06 16:21:12', '2026-01-06 16:21:12', '2026-01-06 16:21:12');

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
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(85, 17, 'product_69259cbb1325a.jpg', 'Ut consequat Tempor', 0, '2025-11-25 17:40:35', '2025-11-25 17:40:35'),
(86, 18, 'product_695b781add216.png', 'gedrfg', 1, '2026-01-05 14:06:43', '2026-01-05 14:06:43'),
(87, 18, 'product_695b781b41ec1.png', 'rrgr', 1, '2026-01-05 14:06:43', '2026-01-05 14:06:43'),
(88, 18, 'product_695b781b8fbe4.png', 'wtre', 1, '2026-01-05 14:06:43', '2026-01-05 14:06:43'),
(89, 18, 'product_695b781be3a56.png', 'kuk', 1, '2026-01-05 14:06:44', '2026-01-05 14:06:44'),
(90, 18, 'product_695b781c40b65.png', 'dfe', 0, '2026-01-05 14:06:44', '2026-01-05 14:06:44'),
(91, 19, 'product_695ce9201e985.png', 'jkuh', 1, '2026-01-06 16:21:12', '2026-01-06 16:21:12'),
(92, 19, 'product_695ce920664c5.png', 'kuk', 1, '2026-01-06 16:21:12', '2026-01-06 16:21:12'),
(93, 19, 'product_695ce920b41da.png', 'tyjytu', 1, '2026-01-06 16:21:13', '2026-01-06 16:21:13'),
(94, 19, 'product_695ce92101588.png', 'ktujk', 1, '2026-01-06 16:21:13', '2026-01-06 16:21:13'),
(95, 19, 'product_695ce9214c3d3.png', 'bbfdgb', 0, '2026-01-06 16:21:13', '2026-01-06 16:21:13');

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
(4, 'Packet', 'PKT', 'active', '2025-11-15 15:28:22', '2025-11-15 15:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_guest` tinyint DEFAULT '0' COMMENT '0=no,1=yes',
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `mobile` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=deactivate,1=activate \r\n',
  `is_verified` tinyint NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `email_verify_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email_token_expiry` datetime NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `token_expiry` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `is_guest`, `fname`, `lname`, `email`, `mobile`, `password`, `status`, `is_verified`, `email_verify_token`, `email_token_expiry`, `reset_token`, `token_expiry`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, 1, 'Kelsey Hensley', 'Kaseem Cline', 'mondalme@gmail.com', '1523697736', '', 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2025-12-09 22:47:52', '2025-12-29 20:49:11', NULL),
(17, 1, 'Tattu', 'King', 'ak@gmail.com', '8790876545', '', 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2025-12-09 22:56:48', '2025-12-30 21:50:32', NULL),
(13, 0, 'Ayan me', 'Mondal', 'mondalayan.exe@gmail.com', '9775460713', '$2y$10$CNEFBFoYhxdDZHKtQSHGR.53yc5Yo5i4mFJ2BsvTTHVhUyETamrPK', 1, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2025-12-09 21:47:16', '2025-12-30 22:13:38', NULL),
(11, 0, 'Brandon', 'Norris', 'xonocilys@mailinator.com', '1236958475', '$2y$10$KAkzuod49qvet1KQB53alefFP3Bpb3zqF/gvuYX4NYbDUWEvDQdE6', 1, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2025-12-07 07:22:33', '2025-12-30 16:45:05', NULL),
(12, 0, 'new', 'test', 'test@gmail.com', '8697660981', '$2y$10$zVYCFjInBJ7CaM1w2vzbD.F2OZXg85uoBX1ot3NYVM8PoY0QJTcIi', 1, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2025-12-07 17:16:46', '2025-12-30 16:45:05', NULL),
(18, 0, 'SBW', 'OY', 'mondalayans.exe@gmail.com', '9685745896', '$2y$10$dyHgc9XWMNdaQLyH8OBRgesKPryYut/2CsgurV5gKZLcl5aIBFeae', 1, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2025-12-10 11:06:07', '2025-12-30 22:13:37', NULL),
(20, 1, 'arpit', 'Sarkar', 'nick@gmail.com', '2536541256', '', 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2025-12-10 21:40:27', '2025-12-30 21:42:52', NULL),
(24, 1, 'smriti', 'gaunia', 'smriti@gmail.com', '7485965412', '', 1, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2025-12-20 16:22:25', '2025-12-30 21:43:14', NULL),
(25, 1, 'Fiona Humphrey', 'Courtney Coffey', 'baqipyc@mailinator.com', '1486577123', '', 1, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2025-12-20 16:25:11', '2025-12-30 16:50:10', NULL),
(23, 1, 'Cooper Moss', 'Cain Beasley', 'putope@mailinator.com', '1807975639', '', 1, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2025-12-16 19:02:39', '2025-12-29 21:35:16', NULL),
(26, 0, 'demo58', 'demo22', 'demo@gmail.com', '1234567891', '$2y$10$JFWd5JlU8aQQrzj3BirDKeB2CnN1ioxmJG0LT/4h.WKTsLs5ovlaG', 1, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2026-01-03 11:39:02', '2026-01-05 16:45:50', NULL),
(27, 0, 'koyel', 'naskar', 'koyel@gmail.com', '9856478512', '$2y$10$Mp6eWT7SXPdOC9577A1KhuK9WfYLVenwAhECSI.U3OmK4YkeYCjAi', 1, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2026-01-05 19:54:30', '2026-01-05 19:54:30', NULL),
(33, 0, 'Ayan ', 'mondal', 'clutchdropkings@gmail.com', '7859625428', '$2y$12$VhVkx5BNGlXTSZikVgFwsu4Buvp1Hti5bEAo5QEycIBy4vKIuvK9W', 1, 1, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2026-01-09 11:18:15', '2026-01-12 10:17:45', NULL),
(34, 0, 'vsvfscfsfsef', 'ssrrgdfrgedrgerdg', 'clutchdropkingss@gmail.com', '6144684945', '$2y$10$PQw9XPRH1MiN4PV6nluHneFzyWgJCU0xq2XmIdwRT96Av6RoKoynq', 1, 0, '9289f368ec6f44408e59788bca212c382be67b9474ca185aa815cc7401f6d575', '2026-01-10 11:24:37', '', '0000-00-00 00:00:00', '2026-01-09 11:24:37', '2026-01-09 11:24:37', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
