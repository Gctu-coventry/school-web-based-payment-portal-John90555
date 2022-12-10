-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2022 at 04:19 PM
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
-- Database: `lifelinebank`
--

-- --------------------------------------------------------

--
-- Table structure for table `topup`
--

CREATE TABLE `topup` (
  `transaction_id` varchar(200) NOT NULL,
  `requester_id` int(200) NOT NULL,
  `recipient_id` int(200) NOT NULL,
  `amount` int(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `reference` text NOT NULL,
  `type` varchar(222) NOT NULL,
  `time_requested` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topup`
--

INSERT INTO `topup` (`transaction_id`, `requester_id`, `recipient_id`, `amount`, `status`, `reference`, `type`, `time_requested`) VALUES
('TXD627c45f0688583.48383607', 1628, 1628, 1000, 'Complete', 'w', 'Deposit', '2022-05-12 00:25:36'),
('TXD627c46254e4ae5.50452922', 1628, 1626, 90, 'Pending', '', 'External', '2022-05-12 00:26:29'),
('TXD627c46bacaacb2.68766357', 1628, 1628, 1900, 'Complete', 'f', 'Deposit', '2022-05-12 00:28:58'),
('TXD627c46e141a5d5.05858717', 1628, 1626, 90, 'Pending', '', 'External', '2022-05-12 00:29:37'),
('TXD627c486d288862.78491200', 1628, 1626, 90, 'Completed', '', 'Payment Via API', '2022-05-12 00:36:13'),
('TXD627c4b0c431874.47657026', 1628, 1626, 90, 'Completed', '', 'Payment Via API', '2022-05-12 00:47:24'),
('TXD627c4bfe68a289.66836874', 1628, 1626, 90, 'Completed', '', 'Payment Via API', '2022-05-12 00:51:26'),
('TXD627c5494afbd38.75125178', 1628, 1626, 270, 'Completed', '', 'Payment Via API', '2022-05-12 01:28:04'),
('TXD627c54ea68a6c3.19209150', 1628, 1626, 270, 'Completed', '', 'Payment Via API', '2022-05-12 01:29:30'),
('TXD627c5736ba8547.90598821', 1628, 1626, 270, 'Completed', '', 'Payment Via API', '2022-05-12 01:39:18'),
('TXD627d00be68e9c4.17788867', 1628, 1628, 1000, 'Complete', '1', 'Deposit', '2022-05-12 13:42:38'),
('TXD627d00d6b43717.12752115', 1628, 1628, 10000, 'Complete', 's', 'Deposit', '2022-05-12 13:43:02'),
('TXD627d00ec94d2d7.06195317', 1628, 1626, 3400, 'Completed', '', 'Payment Via API', '2022-05-12 13:43:24'),
('TXD627d23cb4cb2e3.16119910', 1628, 1626, 90, 'Completed', '', 'Payment Via API', '2022-05-12 16:12:11'),
('TXD627d242ff003a8.01650260', 1628, 1626, 90, 'Completed', '', 'Payment Via API', '2022-05-12 16:13:51'),
('TXD6280db2e9fa954.06382200', 1628, 1626, 450, 'Completed', '', 'Payment Via API', '2022-05-15 11:51:26'),
('TXD6280db87cf3525.83084891', 1628, 1626, 450, 'Completed', '', 'Payment Via API', '2022-05-15 11:52:55'),
('TXD6280dc388d3800.80333684', 1628, 1626, 450, 'Completed', '', 'Payment Via API', '2022-05-15 11:55:52'),
('TXD6280dcd5bf57d8.19124759', 1628, 1626, 450, 'Completed', '', 'Payment Via API', '2022-05-15 11:58:29'),
('TXD6280dce135da13.31881238', 1628, 1626, 450, 'Completed', '', 'Payment Via API', '2022-05-15 11:58:41'),
('TXD6280dd07057094.37372941', 1628, 1626, 450, 'Completed', '', 'Payment Via API', '2022-05-15 11:59:19'),
('TXD6280dddda358e0.49419308', 1628, 1626, 450, 'Completed', '', 'Payment Via API', '2022-05-15 12:02:53'),
('TXD6280de33c73437.15413567', 1628, 1626, 450, 'Completed', '', 'Payment Via API', '2022-05-15 12:04:19'),
('TXD6280e842590dc9.65757609', 1628, 1626, 450, 'Completed', '', 'Payment Via API', '2022-05-15 12:47:14'),
('TXD6280e8efe59887.04479136', 1628, 1626, 450, 'Completed', '', 'Payment Via API', '2022-05-15 12:50:07'),
('TXD6280f0188e10a6.85017363', 1628, 1626, 210, 'Completed', '', 'Payment Via API', '2022-05-15 13:20:40'),
('TXD6280f1d34c37c9.58885740', 1628, 1626, 210, 'Completed', '', 'Payment Via API', '2022-05-15 13:28:03'),
('TXD6280f4dc2f1e84.36757490', 1626, 1626, 1000, 'Complete', 'er', 'Deposit', '2022-05-15 13:41:00'),
('TXD6280f56dc99894.28930939', 1628, 1626, 840, 'Completed', '', 'Payment Via API', '2022-05-15 13:43:25'),
('TXD6280f586761f80.08507089', 1628, 1626, 840, 'Completed', '', 'Payment Via API', '2022-05-15 13:43:50'),
('TXD6280f637861c64.00154975', 1628, 1626, 840, 'Completed', '', 'Payment Via API', '2022-05-15 13:46:47'),
('TXD6280fa7e8c45d9.81392262', 1626, 1626, 998, 'Complete', 'f', 'Deposit', '2022-05-15 14:05:02'),
('TXD6280faad91d604.13690095', 1628, 1628, 1000, 'Complete', '3', 'Deposit', '2022-05-15 14:05:49'),
('TXD6280fab5a663e4.69189712', 1628, 1626, 840, 'Completed', '', 'Payment Via API', '2022-05-15 14:05:57'),
('TXD62810758a3e337.67031397', 1628, 1626, 420, 'Completed', '', 'Payment Via API', '2022-05-15 14:59:52'),
('TXD62812ec3a95fa9.05626082', 1628, 1628, 1998, 'Complete', 'hy', 'Deposit', '2022-05-15 17:48:03'),
('TXD62812ece41ee49.77350089', 1628, 1626, 450, 'Completed', '', 'Payment Via API', '2022-05-15 17:48:14'),
('TXD6281350783c438.60298920', 1628, 1626, 140, 'Completed', '', 'Payment Via API', '2022-05-15 18:14:47'),
('TXD628139842daa16.47185026', 1628, 1626, 270, 'Completed', '', 'Payment Via API', '2022-05-15 18:33:56'),
('TXD62822814c37bf8.99316687', 1626, 1628, 0, 'Completed', '', 'Refund', '2022-05-16 11:31:48'),
('TXD6282281f7f7ef5.66924290', 1626, 1628, 0, 'Completed', '', 'Refund', '2022-05-16 11:31:59'),
('TXD628228499bc4b8.95018513', 1626, 1628, 0, 'Completed', '', 'Refund', '2022-05-16 11:32:41'),
('TXD628229e7947419.51528344', 1626, 1628, 450, 'Completed', '', 'Refund', '2022-05-16 11:39:35'),
('TXD62822fcd372d94.14215792', 1626, 1628, 450, 'Completed', '', 'Refund', '2022-05-16 12:04:45'),
('TXD62826dadca7d24.42308695', 1626, 1628, 1290, 'Completed', '', 'Refund', '2022-05-16 16:28:45'),
('TXD6282ceaac48119.04779292', 1628, 1628, 10000, 'Complete', 'w', 'Deposit', '2022-05-16 23:22:34'),
('TXD6282ceb5b20979.89212273', 1628, 1626, 10200, 'Completed', '', 'Payment Via API', '2022-05-16 23:22:45'),
('TXD6282d1117e4c06.94354547', 1626, 1628, 10200, 'Completed', '', 'Refund', '2022-05-16 23:32:49'),
('TXD6282daf9cef880.41509623', 1626, 1628, 103650, 'Completed', '', 'Refund', '2022-05-17 00:15:05'),
('TXD6283d9a1e862e8.67671403', 1628, 1626, 490, 'Completed', '', 'Payment Via API', '2022-05-17 18:21:37'),
('TXD6284150155c242.78300974', 1628, 1626, 140, 'Completed', '', 'Payment Via API', '2022-05-17 22:34:57'),
('TXD6284155a2a6663.07500047', 1626, 1628, 140, 'Completed', '', 'Refund', '2022-05-17 22:36:26'),
('TXD6284af65ed0295.26108312', 1628, 1626, 450, 'Completed', '', 'Payment Via API', '2022-05-18 09:33:41'),
('TXD6284b027ae64f4.91354628', 1626, 1628, 450, 'Pending', '', 'Refund', '2022-05-18 09:36:55'),
('TXD6284b0a5b31bb2.41901138', 0, 0, 450, 'Pending', '', 'Refund', '2022-05-18 09:39:01'),
('TXD6284b0a8e2d049.13586614', 0, 0, 450, 'Pending', '', 'Refund', '2022-05-18 09:39:04'),
('TXD6284b1afaa8366.15669845', 1626, 1628, 21000, 'Pending', '', 'Refund', '2022-05-18 09:43:27'),
('TXD6284b5676a96a8.73878503', 1628, 981006, 450, 'Completed', '', 'Payment Via API', '2022-05-18 09:59:19'),
('TXD6284b5a3955c32.53877791', 981006, 1628, 450, 'Pending', '', 'Refund', '2022-05-18 10:00:19'),
('TXD6284b5c1addc19.05535590', 981006, 1628, 450, 'Pending', '', 'Refund', '2022-05-18 10:00:49'),
('TXD6284b9accc9e54.34026948', 1628, 981006, 420, 'Completed', '', 'Payment Via API', '2022-05-18 10:17:32'),
('TXD6284d3cf0e53c3.01354791', 1628, 981006, 90, 'Completed', '', 'Payment Via API', '2022-05-18 12:09:03'),
('TXD6284d437503548.75279291', 981006, 1628, 90, 'Pending', '', 'Refund', '2022-05-18 12:10:47'),
('TXD6284d43a9e0fe5.17622499', 981006, 1628, 90, 'Pending', '', 'Refund', '2022-05-18 12:10:50'),
('TXD6284e154870239.11423377', 1628, 981006, 90, 'Completed', '', 'Payment Via API', '2022-05-18 13:06:44'),
('TXD6284f5af1f7d88.52715441', 1628, 981006, 270, 'Completed', '', 'Payment Via API', '2022-05-18 14:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `bank_account_number` int(200) NOT NULL,
  `firstname` varchar(11) NOT NULL,
  `lastname` varchar(222) NOT NULL,
  `phone_number` int(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `balance` decimal(65,2) DEFAULT NULL,
  `api_key` varchar(222) NOT NULL,
  `otp` int(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `bank_account_number`, `firstname`, `lastname`, `phone_number`, `email`, `password`, `balance`, `api_key`, `otp`) VALUES
(42, 1626, 'Ruby', 'Hanson', 549051622, 'ruby@gmail.com', '58e53d1324eef6265fdb97b08ed9aadf', '-10898.00', 'd6464b-0abad4-dbf8bd-9b38a6-61b618', NULL),
(43, 1627, 'Jeffery', 'Obolo', 549051622, 'JeyJey@gmail.com', '10a8e3a6b2a64a2720e345f9769a0e67', '2.00', '71d4d1-1afb58-5edc0f-00b370-753639', NULL),
(44, 162785, 'Messiah', 'Lukeson', 549051622, 'meow@gmail.com', '4a4be40c96ac6314e91d93f38043a634', '6700.00', '20e646-cb946a-194100-dea550-d6b36b', 1),
(45, 1628, 'Yoofi', 'appiah', 549051624, 'yoofiappiah62@gmail.com', 'a66fee0ccfbeb4d6c346aca1cbb49da3', '139558.00', '1f022f-cd1106-88a407-671674-e9a505', 108984),
(46, 16273, 'Abraham', 'Teye', 549051622, 'abteye2000@gmail.com', '187ef4436122d1cc2f40dc2b92f0eba0', '2.00', '37356d-9d4528-d35be6-a5ad2b-60c184', 537150),
(57, 981006, 'Earl', 'Mensah', 2147483647, 'earlmensah5@gmail.com', '3feaed83a0651442eb20dce04a37067c', '780.00', '7a325b-78b98d-537093-2682fc-d2088d', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `topup`
--
ALTER TABLE `topup`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
