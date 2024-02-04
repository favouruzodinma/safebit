-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 02:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coolwallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `flname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `userid`, `flname`, `email`, `password`, `status`) VALUES
(1, 'SBT637283', 'safebit Admin', 'safebit99@gmail.com', '$2y$10$j3SxyGV9aKWFEjp0xE6.BO4oumtlNGUI.CDX3Cs2j2fTl1wfTRLjW', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `coin`
--

CREATE TABLE `coin` (
  `id` int(11) NOT NULL,
  `coin_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coin`
--

INSERT INTO `coin` (`id`, `coin_name`) VALUES
(1, 'bitcoin'),
(2, 'ethereum'),
(3, 'tron'),
(4, 'tether'),
(5, 'usd-coin'),
(6, 'binancecoin'),
(7, 'usd-tether'),
(8, 'usdc');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `updated_balance` decimal(10,2) NOT NULL,
  `coinType` varchar(20) NOT NULL,
  `wallet` varchar(100) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'pending',
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `userid`, `updated_balance`, `coinType`, `wallet`, `status`, `updated_at`) VALUES
(10, 'CWT233673', 1000000.00, 'usd-coin', '0x37A66c6A5c0d6594C77bDC06f60705d802f1bFd4', 'pending', '2024-01-30 12:05:02.000000'),
(11, 'CWT233673', 100.00, 'usd-tether', '0x37A66c6A5c0d6594C77bDC06f60705d802f1bFd4', 'pending', '2024-01-30 13:36:16.000000'),
(12, 'CWT233673', 100.00, 'tether', '0x37A66c6A5c0d6594C77bDC06f60705d802f1bFd4', 'pending', '2024-01-30 13:37:12.000000');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `userid` varchar(40) NOT NULL,
  `flname` varchar(200) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(100) NOT NULL,
  `bitcoin_wallet` varchar(100) NOT NULL DEFAULT '18W612axoWZSix6fbZnUC57zoPYyzXKP41',
  `bitcoin_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `binancecoin_wallet` varchar(100) NOT NULL DEFAULT '0x5e6e0458f1f28e932edd71e3da7ffcb7734a19b4',
  `binancecoin_balance` decimal(10,2) NOT NULL,
  `ethereum_wallet` varchar(100) NOT NULL DEFAULT '0x5e6e0458f1f28e932edd71e3da7ffcb7734a19b4',
  `ethereum_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tron_wallet` varchar(100) NOT NULL DEFAULT 'TDMNhxGfRaipnKEavSkgZ1f54K7aVNUxxJ',
  `tron_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tether_wallet` varchar(100) NOT NULL DEFAULT 'TDMNhxGfRaipnKEavSkgZ1f54K7aVNUxxJ',
  `tether_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `usd-coin_wallet` varchar(100) NOT NULL DEFAULT '0x5e6e0458f1f28e932edd71e3da7ffcb7734a19b4',
  `usd-coin_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `usd-tether_wallet` varchar(100) NOT NULL DEFAULT '0x5e6e0458f1f28e932edd71e3da7ffcb7734a19b4',
  `usd-tether_balance` decimal(10,2) NOT NULL,
  `usdc_wallet` varchar(100) NOT NULL DEFAULT 'AssCkwRyqc8F5XEZ2DgmRM8vahrEpmRH8ES2ouKDHJJK',
  `usdc_balance` decimal(10,2) NOT NULL,
  `phrase` varchar(250) NOT NULL DEFAULT 'apple water corn phone white people drag pull pill hack star crew ',
  `kyc` varchar(500) DEFAULT NULL,
  `ip_address` varchar(200) NOT NULL,
  `verify_token` varchar(200) NOT NULL,
  `status` varchar(9) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `userid`, `flname`, `email`, `password`, `bitcoin_wallet`, `bitcoin_balance`, `binancecoin_wallet`, `binancecoin_balance`, `ethereum_wallet`, `ethereum_balance`, `tron_wallet`, `tron_balance`, `tether_wallet`, `tether_balance`, `usd-coin_wallet`, `usd-coin_balance`, `usd-tether_wallet`, `usd-tether_balance`, `usdc_wallet`, `usdc_balance`, `phrase`, `kyc`, `ip_address`, `verify_token`, `status`) VALUES
(15, 'SBT233673', 'Henry', 'henry000@gmail.com', '$2y$10$Iskiz30qhulboK.eIEi3/eWHC/cNhCOwvS8528Y9Ds7v5P1fXM4eW', '18W612axoWZSix6fbZnUC57zoPYyzXKP41', 0.50, '0x5e6e0458f1f28e932edd71e3da7ffcb7734a19b4', 0.50, '0x5e6e0458f1f28e932edd71e3da7ffcb7734a19b4', 0.50, 'TDMNhxGfRaipnKEavSkgZ1f54K7aVNUxxJ', 0.00, 'TDMNhxGfRaipnKEavSkgZ1f54K7aVNUxxJ', 100.00, '0x5e6e0458f1f28e932edd71e3da7ffcb7734a19b4', 1000050.00, '0x5e6e0458f1f28e932edd71e3da7ffcb7734a19b4', 100.00, 'AssCkwRyqc8F5XEZ2DgmRM8vahrEpmRH8ES2ouKDHJJK', 800.00, 'apple water corn phone white people drag pull pill hack star crew ', NULL, '::1', '', 'pending'),
(16, 'SBT455664', 'mikky', 'mickycrush@gmail.com', '$2y$10$3ELQBIFpQYPAl.WAX1cBnOWEZvA0haU0dCzMfLmSBwzg.7cRXJXqi', '18W612axoWZSix6fbZnUC57zoPYyzXKP41', 0.00, '0x5e6e0458f1f28e932edd71e3da7ffcb7734a19b4', 0.00, '0x5e6e0458f1f28e932edd71e3da7ffcb7734a19b4', 0.00, 'TDMNhxGfRaipnKEavSkgZ1f54K7aVNUxxJ', 0.00, 'TDMNhxGfRaipnKEavSkgZ1f54K7aVNUxxJ', 0.00, '0x5e6e0458f1f28e932edd71e3da7ffcb7734a19b4', 0.00, '0x5e6e0458f1f28e932edd71e3da7ffcb7734a19b4', 0.00, 'AssCkwRyqc8F5XEZ2DgmRM8vahrEpmRH8ES2ouKDHJJK', 0.00, 'apple water corn phone white people drag pull pill hack star crew ', NULL, '::1', '', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `wallet_name` varchar(20) NOT NULL,
  `wallet_img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_keystore`
--

CREATE TABLE `wallet_keystore` (
  `id` int(11) NOT NULL,
  `wallet_name` varchar(20) NOT NULL,
  `keystore` text NOT NULL,
  `wallet_pass` text NOT NULL,
  `date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_phrase`
--

CREATE TABLE `wallet_phrase` (
  `id` int(11) NOT NULL,
  `wallet_name` varchar(20) NOT NULL,
  `phrase` text NOT NULL,
  `date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_private_key`
--

CREATE TABLE `wallet_private_key` (
  `id` int(11) NOT NULL,
  `wallet_name` varchar(20) NOT NULL,
  `private_key` text NOT NULL,
  `date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coin`
--
ALTER TABLE `coin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_keystore`
--
ALTER TABLE `wallet_keystore`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_phrase`
--
ALTER TABLE `wallet_phrase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_private_key`
--
ALTER TABLE `wallet_private_key`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coin`
--
ALTER TABLE `coin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_keystore`
--
ALTER TABLE `wallet_keystore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_phrase`
--
ALTER TABLE `wallet_phrase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_private_key`
--
ALTER TABLE `wallet_private_key`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
