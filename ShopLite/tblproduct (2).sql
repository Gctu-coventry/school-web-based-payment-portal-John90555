-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2022 at 01:03 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tblproduct`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'Kitchen Appliances'),
(2, 'Fashion'),
(3, 'Laptops');

-- --------------------------------------------------------

--
-- Table structure for table `credit_cards`
--

CREATE TABLE `credit_cards` (
  `cc_ID` int(16) NOT NULL,
  `cc_number` text NOT NULL,
  `cc_name` text NOT NULL,
  `exp_date` text NOT NULL,
  `sec_code` int(16) NOT NULL,
  `account` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `credit_cards`
--

INSERT INTO `credit_cards` (`cc_ID`, `cc_number`, `cc_name`, `exp_date`, `sec_code`, `account`) VALUES
(0, '5091701705091701', 'Jervis Onyameh', '12/20', 233, 48500),
(1, '5091702105091702', 'Nii Armah Aryee', '12/20', 234, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `account_number` int(15) NOT NULL,
  `account_firstname` varchar(70) NOT NULL,
  `account_lastname` varchar(70) NOT NULL,
  `account_balance` int(20) NOT NULL DEFAULT 0,
  `phone_number` int(40) NOT NULL,
  `email_address` varchar(40) NOT NULL,
  `account_password` varchar(500) NOT NULL,
  `isBank` varchar(10) NOT NULL DEFAULT 'no',
  `api_key` int(222) DEFAULT NULL,
  `sess_id` varchar(222) DEFAULT NULL,
  `role` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `account_number`, `account_firstname`, `account_lastname`, `account_balance`, `phone_number`, `email_address`, `account_password`, `isBank`, `api_key`, `sess_id`, `role`) VALUES
(1, 2147483647, 'ENOS', 'JERON DONKOR', 6000, 245775507, 'enosjeron@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'no', NULL, 'SES636e6c35cc5ab2.67791698', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_description` varchar(120) NOT NULL,
  `item_category` varchar(100) NOT NULL,
  `item_price` varchar(20) NOT NULL,
  `item_discount` varchar(10) NOT NULL,
  `date_created` varchar(30) NOT NULL,
  `item_image` varchar(50) NOT NULL,
  `on_promo` varchar(10) NOT NULL DEFAULT 'no',
  `tab_section` varchar(30) NOT NULL DEFAULT 'New Arrival'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `item_description`, `item_category`, `item_price`, `item_discount`, `date_created`, `item_image`, `on_promo`, `tab_section`) VALUES
(1, 'Cooking Knife', 'chccxhff', 'Kitchen Appliances', '90', '2', '12-12-2002', '', 'no', 'New Arrival'),
(2, 'Drone Precision 3056', 'chccxhff', 'Laptops', '90', '50', '12-12-2002', '', 'yes', 'New Arrival'),
(3, 'Denim Indian Sweater', 'chccxhff', 'Fashion', '90', '2', '12-12-2002', '', 'yes', 'Best Seller'),
(4, 'Casio Wrist Watch', 'Level 3', 'Fashion', '150', '10', '12-3-2022', '', 'no', 'New Arrival'),
(5, 'Diesel Wrist Watch', 'Level 2', 'Fashion', '250', '10', '12-3-2022', '', 'no', 'New Arrival'),
(6, 'Rolex Wrist Watch', 'Level 1', 'Fashion', '2999', '10', '12-3-2022', '', 'no', 'New Arrival'),
(7, 'Dolce Wrist Watch', 'Level 0', 'Fashion', '1500', '10', '12-3-2022', '', 'no', 'New Arrival'),
(8, 'Gabana Wrist Watch', 'Level 0', 'Fashion', '1599', '10', '12-3-2022', '', 'no', 'New Arrival');

-- --------------------------------------------------------

--
-- Table structure for table `normalised_orders`
--

CREATE TABLE `normalised_orders` (
  `customer_id` varchar(30) NOT NULL,
  `order_id` varchar(40) NOT NULL,
  `order_date` varchar(20) NOT NULL,
  `item_count` varchar(10) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `order_status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `normalised_orders`
--

INSERT INTO `normalised_orders` (`customer_id`, `order_id`, `order_date`, `item_count`, `amount`, `order_status`) VALUES
('2', '4Q0UZOGCGQ', '05/11/2022', '1', '150', '300'),
('2', '1HLXG8KF3P', '05/11/2022', '3', '3239', '300'),
('2', 'O3HAH12TAV', '05/11/2022', '2', '240', '300'),
('1', 'WMSOLBYQJJ', '05/12/2022', '1', '90', '200'),
('1', '3KFGEQLQLO', '05/12/2022', '1', '90', '200'),
('1', 'FI9MYXVVDL', '05/12/2022', '1', '90', '200'),
('1', 'UE6YCCTER9', '05/12/2022', '1', '90', '200'),
('1', 'PQJP5HS1LQ', '05/12/2022', '1', '150', '200'),
('1', 'F3GZMPEJZ7', '05/12/2022', '1', '150', '200'),
('1', 'PARMGL56TV', '05/12/2022', '1', '250', '200'),
('1', 'OPS4VUVPMY', '05/12/2022', '1', '250', '200'),
('1', 'UNWZWGGYFY', '05/12/2022', '1', '90', '200'),
('1', 'ORMY1Y8YIO', '05/13/2022', '1', '150', '200');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `product_id` varchar(222) NOT NULL,
  `sess_id` varchar(200) DEFAULT NULL,
  `item_name` varchar(80) NOT NULL,
  `item_quantity` varchar(10) NOT NULL,
  `item_price` varchar(30) NOT NULL,
  `sub_total` varchar(40) NOT NULL,
  `customer_id` varchar(30) DEFAULT NULL,
  `order_status` varchar(222) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `product_id`, `sess_id`, `item_name`, `item_quantity`, `item_price`, `sub_total`, `customer_id`, `order_status`) VALUES
(317, 'ORD636e36f989ca23.49', 'wristWear03', 'SES636e366382e197.40493477', 'Luxury Ultra thin Wrist Watch', '1', '300.00', '300', NULL, 'Complete'),
(318, 'ORD636e684f0bba40.79', 'LPN45', 'SES636e6845a6f467.10245142', 'XP 1155 Intel Core Laptop', '5', '800.00', '4000', NULL, 'Requested_Refund'),
(316, 'ORD636e36b98f1060.23', 'USB02', 'SES636e366382e197.40493477', 'EXP Portable Hard Drive', '1', '800.00', '800', NULL, 'Complete'),
(315, 'ORD636d1cd929a2d7.94', 'LPN45', 'SES636d1c83800c84.40470835', 'XP 1155 Intel Core Laptop', '1', '800.00', '2300', NULL, 'Refund Complete'),
(313, 'ORD636d1ca108a924.10', 'USB02', 'SES636d1c83800c84.40470835', 'EXP Portable Hard Drive', '12', '800.00', '9600', NULL, 'Refund Complete'),
(314, 'ORD636d1cd9298f26.31', '3DcAM01', 'SES636d1c83800c84.40470835', 'FinePix Pro2 3D Camera', '1', '1500.00', '2300', NULL, 'Refund Complete'),
(312, 'ORD636c1894f22b91.60', '3DcAM01', 'SES636c188a992857.13620130', 'FinePix Pro2 3D Camera', '1', '1500.00', '1500', NULL, 'Refund Complete'),
(311, 'ORD636a9937e3de98.68', 'USB02', 'SES636a75ff38f2d2.53963765', 'EXP Portable Hard Drive', '1', '800.00', '800', NULL, 'Complete'),
(310, 'ORD636a98d33a5f11.44', 'USB02', 'SES636a75ff38f2d2.53963765', 'EXP Portable Hard Drive', '1', '800.00', '800', NULL, 'Complete'),
(308, 'ORD6366b0521e21a9.97', 'wristWear03', 'SES6366b037cebef9.96578777', 'Luxury Ultra thin Wrist Watch', '1', '300.00', '300', NULL, 'Complete'),
(309, 'ORD636a7607e6f1e0.46', 'LPN45', 'SES636a75ff38f2d2.53963765', 'XP 1155 Intel Core Laptop', '1', '800.00', '800', NULL, 'Complete'),
(307, 'ORD6362efe4225597.43', 'USB02', 'SES6362a577c950c0.17781336', 'EXP Portable Hard Drive', '1', '800.00', '800', NULL, 'Complete'),
(305, 'ORD6361aa5f6d1fa3.10', 'wristWear03', 'SES6361a9327e7e76.90569869', 'Luxury Ultra thin Wrist Watch', '1', '300.00', '300', NULL, 'Refund Complete'),
(306, 'ORD6362efb3f12494.44', '3DcAM01', 'SES6362a577c950c0.17781336', 'FinePix Pro2 3D Camera', '6', '1500.00', '9000', NULL, 'Complete'),
(304, 'ORD6361a8e4bfe852.94', 'USB02', 'SES6361a8dd1d1540.64645720', 'EXP Portable Hard Drive', '1', '800.00', '800', NULL, 'Complete'),
(303, 'ORD6361a346b52912.30', 'USB02', 'SES63617fd2228937.89223549', 'EXP Portable Hard Drive', '3', '800.00', '2400', NULL, 'Refund Complete');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`id`, `name`, `code`, `image`, `price`) VALUES
(1, 'FinePix Pro2 3D Camera', '3DcAM01', 'product-images/camera.jpg', 1500.00),
(2, 'EXP Portable Hard Drive', 'USB02', 'product-images/external-hard-drive.jpg', 800.00),
(3, 'Luxury Ultra thin Wrist Watch', 'wristWear03', 'product-images/watch.jpg', 300.00),
(4, 'XP 1155 Intel Core Laptop', 'LPN45', 'product-images/laptop.jpg', 800.00);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `tsn_type` varchar(40) NOT NULL,
  `tsn_date` date NOT NULL DEFAULT current_timestamp(),
  `account_number` varchar(15) NOT NULL,
  `to_account_number` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `tsn_status` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `tsn_type`, `tsn_date`, `account_number`, `to_account_number`, `amount`, `tsn_status`) VALUES
(203, 'Payment', '0000-00-00', '101111334401', '1000000000', '150', 300),
(202, 'Payment', '0000-00-00', '101111334401', '1000000000', '3239', 300),
(201, 'Payment', '0000-00-00', '101111334401', '1000000000', '240', 300),
(204, 'Payment', '0000-00-00', '151100000100', '1000000000', '90', 200),
(205, 'Payment', '0000-00-00', '151100000100', '1000000000', '90', 200),
(206, 'Payment', '0000-00-00', '151100000100', '1000000000', '90', 200),
(207, 'Payment', '0000-00-00', '151100000100', '1000000000', '90', 200),
(208, 'Payment', '0000-00-00', '151100000100', '1000000000', '150', 200),
(209, 'Payment', '0000-00-00', '151100000100', '1000000000', '150', 200),
(210, 'Payment', '0000-00-00', '151100000100', '1000000000', '250', 200),
(211, 'Payment', '0000-00-00', '151100000100', '1000000000', '250', 200),
(212, 'Payment', '0000-00-00', '151100000100', '1000000000', '90', 200),
(213, 'Payment', '0000-00-00', '151100000100', '1000000000', '150', 200),
(214, 'Payment', '2022-05-17', '2147483647', '111', '5800', 200),
(215, 'Payment', '2022-05-17', '2147483647', '111', '0', 200),
(216, 'Payment', '2022-05-17', '2147483647', '111', '10000', 200),
(217, 'Payment', '2022-05-17', '2147483647', '111', '1000', 200),
(218, 'Payment', '2022-05-17', '2147483647', '111', '1000', 200),
(219, 'Payment', '2022-05-17', '2147483647', '111', '1000', 200),
(220, 'Payment', '2022-05-17', '2147483647', '111', '800', 200),
(221, 'Payment', '2022-05-17', '2147483647', '111', '800', 200),
(222, 'Payment', '2022-05-17', '2147483647', '111', '800', 200),
(223, 'Payment', '2022-05-17', '2147483647', '111', '800', 200),
(224, 'Payment', '2022-05-18', '2147483647', '111', '800', 200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `normalised_orders`
--
ALTER TABLE `normalised_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`code`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
