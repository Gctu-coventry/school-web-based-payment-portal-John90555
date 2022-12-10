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
-- Database: `lifelinebank`
--

-- --------------------------------------------------------

--
-- Table structure for table `arrears`
--

CREATE TABLE `arrears` (
  `id` int(11) NOT NULL,
  `accountNumber` int(11) NOT NULL,
  `accountName` varchar(200) NOT NULL,
  `userType` varchar(200) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `arrears`
--

INSERT INTO `arrears` (`id`, `accountNumber`, `accountName`, `userType`, `amount`, `date`) VALUES
(1, 93755875, 'Greg Joefy', 'Student', -3800, '2022-11-08 16:59:45'),
(2, 345745, 'Mikel Inowa', 'Non-Student', -270, '2022-11-02 17:00:59');

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
('TXD635929ff216e38.22405862', 162785, 162785, 1500, 'Completed', '', 'Payment Via API', '2022-10-26 12:37:19'),
('TXD63592a6b8c0230.68018662', 162785, 162785, 1500, 'Completed', '', 'Payment Via API', '2022-10-26 12:39:07'),
('TXD636180d067ab64.99055354', 162785, 162785, 300, 'Completed', '', 'Payment Via API', '2022-11-01 20:25:52'),
('TXD6361a364afb007.58681524', 162785, 162785, 2400, 'Completed', '', 'Payment Via API', '2022-11-01 22:53:24'),
('TXD6361a902138886.11595470', 162785, 162785, 800, 'Completed', '', 'Payment Via API', '2022-11-01 23:17:22'),
('TXD6361aa79e98094.79398320', 162785, 162785, 300, 'Completed', '', 'Payment Via API', '2022-11-01 23:23:37'),
('TXD6362a9a6636a69.85436853', 569925, 569925, 2000, 'Complete', '1', 'Deposit', '2022-11-02 17:32:22'),
('TXD6362aa380a9051.79386059', 162785, 569925, 25050, 'Pending', 'er', 'Internal', '2022-11-02 17:34:48'),
('TXD6362aa48523ab2.23978648', 162785, 8, 40, 'Pending', '7', 'Internal', '2022-11-02 17:35:04'),
('TXD6366b7826fb2b3.17496697', 1626, 1626, 19998, 'Complete', 's', 'Deposit', '2022-11-05 19:20:34'),
('TXD636a994ec40f17.41145296', 162785, 1626, 800, 'Completed', '', 'Payment Via API', '2022-11-08 18:00:46'),
('TXD636c18b89ada13.95905364', 162785, 1626, 1500, 'Completed', '', 'Payment Via API', '2022-11-09 21:16:40'),
('TXD636d1cb872e148.91556127', 162785, 1626, 9600, 'Completed', '', 'Payment Via API', '2022-11-10 15:46:00'),
('TXD636d1ce809e268.12334447', 162785, 1626, 2300, 'Completed', '', 'Payment Via API', '2022-11-10 15:46:48'),
('TXD636e36db2f1c09.95894931', 162785, 1626, 800, 'Completed', '', 'Payment Via API', '2022-11-11 11:49:47'),
('TXD636e6860917393.75580895', 162785, 1626, 4000, 'Completed', '', 'Payment Via API', '2022-11-11 15:21:04');

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
  `otp` int(222) DEFAULT NULL,
  `position` varchar(200) NOT NULL,
  `arrears` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `bank_account_number`, `firstname`, `lastname`, `phone_number`, `email`, `password`, `balance`, `api_key`, `otp`, `position`, `arrears`) VALUES
(42, 1626, 'Ruby', 'Hanson', 549051622, 'ruby@gmail.com', '58e53d1324eef6265fdb97b08ed9aadf', '28100.00', 'd6464b-0abad4-dbf8bd-9b38a6-61b618', NULL, 'admin', 0),
(44, 162785, 'Messiah', 'Lukeson', 549051622, 'meow@gmail.com', '4a4be40c96ac6314e91d93f38043a634', '104510.00', '20e646-cb946a-194100-dea550-d6b36b', 1, 'admin', 1208),
(57, 981006, 'Earl', 'Mensah', 2147483647, 'earlmensah5@gmail.com', '3feaed83a0651442eb20dce04a37067c', '870.00', '7a325b-78b98d-537093-2682fc-d2088d', NULL, 'user', 23),
(58, 569925, 'Ton', 'Hanson', 549051622, 'tonhanson@gmail.com', '3ab4eebc984621af9cd64e5757417e84', '2000.00', '384a38-ab6e15-3b51db-d5f46a-728ccb', NULL, 'user', 15),
(59, 184387, 'Bro', 'ther', 549051622, 'brother@gmail.com', 'b977e3380f2d6cdf0f8884b574ea3d30', '0.00', 'ae231c-6df3df-0700e5-55e220-c90730', NULL, '', 90),
(60, 503183, 'Poloski', 'Azerbiha', 4563845, 'poloski@gmail.com', '899c82cb1895c935c68399eb895b92e5', '0.00', '3b0ad9-720293-011298-e90cf1-1185f3', NULL, 'user', 1642);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arrears`
--
ALTER TABLE `arrears`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `arrears`
--
ALTER TABLE `arrears`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
