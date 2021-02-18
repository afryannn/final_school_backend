-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2021 at 11:30 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yukata`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Meja'),
(2, 'Kursi');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `product_key` varchar(90) NOT NULL,
  `store_id` int(100) NOT NULL,
  `product_name` varchar(500) NOT NULL,
  `product_price` int(100) NOT NULL,
  `category` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `stock` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `product_key`, `store_id`, `product_name`, `product_price`, `category`, `description`, `stock`) VALUES
(2, '1Q3YJTwbJ', 1, 'adjt 2', 3000, 'Kursi', 'pee', 5),
(3, '1fwVDh5E0', 1, 'adjt3', 3000, 'Kursi', 'ds', 4),
(4, '14kWDbhVN', 1, 'Adjt 5', 4000000, 'Meja', 'Exp Desc', 3),
(5, '1pxYYOraf', 1, 'halo', 200000, 'Meja', 'kosong', 0),
(6, '16w86KEy6', 1, 'kaka', 200000, 'Meja', 'kosong', 0),
(7, '2GKzz5w5p', 2, 'update', 4000, 'Meja', 'desc By Siraj Meuble', 3);

-- --------------------------------------------------------

--
-- Table structure for table `produk_image`
--

CREATE TABLE `produk_image` (
  `id` int(11) NOT NULL,
  `product_key` varchar(90) NOT NULL,
  `img1` varchar(200) NOT NULL,
  `img2` varchar(200) DEFAULT NULL,
  `img3` varchar(200) DEFAULT 'cd',
  `img4` varchar(200) DEFAULT NULL,
  `img5` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_image`
--

INSERT INTO `produk_image` (`id`, `product_key`, `img1`, `img2`, `img3`, `img4`, `img5`) VALUES
(2, '1Q3YJTwbJ', 'dua.png', 'Default', 'Default', 'Default', 'Default'),
(3, '1fwVDh5E0', 'tiga.png', 'Default', 'Default', 'Default', 'Default'),
(4, '14kWDbhVN', 'empat.png', '14kWDbhVN3iOU4ze8Q.png', 'Default', 'Default', 'Default'),
(5, '2GKzz5w5p', '2GKzz5w5peMdEBEAdn.jpg', 'Default', 'Default', 'Default', 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `img_profil` varchar(255) NOT NULL,
  `img_banner` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `img_profil`, `img_banner`, `name`, `user_id`, `description`, `address`, `telephone`) VALUES
(1, 'default-profil.jpg', 'default-profil.jpg', 'ADJATI MEUBLE', 1, 'desc store', 'Mlonggo', '08565786768432'),
(2, 'default-profil.jpg', 'default-profil.jpg', 'SIRAJ MEUBLE', 2, 'desc store', 'Mlonggo', '085656565656');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `visitor_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `store_name` varchar(200) NOT NULL,
  `visitor_name` varchar(255) NOT NULL,
  `seller_telephone` varchar(30) NOT NULL,
  `visitor_telephone` varchar(30) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_key` varchar(255) NOT NULL,
  `product_img1` varchar(200) NOT NULL,
  `address_seller` varchar(255) NOT NULL,
  `address_customer` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `visitor_id`, `store_id`, `store_name`, `visitor_name`, `seller_telephone`, `visitor_telephone`, `product_name`, `product_price`, `product_key`, `product_img1`, `address_seller`, `address_customer`, `description`, `status`) VALUES
(1, 3, 1, 'ADJATI MEUBLE', 'afrr', '08565786768432', '08970025959', 'meja adjt', 100000, '1FOcMGOn8', '1FOcMGOn8HpSrBfKpF.png', 'Mlonggo', 'Mlonggo', 'hei!!', 'DI PROSES'),
(2, 3, 1, 'ADJATI MEUBLE', 'afrr', '08565786768432', '08970025959', 'meja adjt', 100000, '1FOcMGOn8', '1FOcMGOn8HpSrBfKpF.png', 'Mlonggo', 'Mlonggo', 'cdscd', 'DI PROSES'),
(3, 3, 1, 'ADJATI MEUBLE', 'afrr', '08565786768432', '08970025959', 'meja adjt', 100000, '1FOcMGOn8', '1FOcMGOn8HpSrBfKpF.png', 'Mlonggo', 'Mlonggo', 'cdscd', 'DI PROSES'),
(4, 3, 1, 'ADJATI MEUBLE', 'afrr', '08565786768432', '08970025959', 'meja adjt', 100000, '1FOcMGOn8', '1FOcMGOn8HpSrBfKpF.png', 'Mlonggo', 'Mlonggo', 'cdscd', 'DI PROSES'),
(5, 3, 1, 'ADJATI MEUBLE', 'afrr', '08565786768432', '08970025959', 'meja adjt', 100000, '1FOcMGOn8', '1FOcMGOn8HpSrBfKpF.png', 'Mlonggo', 'Mlonggo', 'cdscd', 'DI PROSES'),
(6, 3, 1, 'ADJATI MEUBLE', 'afrr', '08565786768432', '08970025959', 'meja adjt', 100000, '1FOcMGOn8', '1FOcMGOn8HpSrBfKpF.png', 'Mlonggo', 'Mlonggo', 'cdscds', 'DI PROSES'),
(7, 3, 1, 'ADJATI MEUBLE', 'afrr', '08565786768432', '08970025959', 'meja adjt', 100000, '1FOcMGOn8', '1FOcMGOn8HpSrBfKpF.png', 'Mlonggo', 'Mlonggo', 'cdscds', 'DI PROSES'),
(8, 3, 2, 'SIRAJ MEUBLE', 'afrr', '085656565656', '08970025959', 'srj1', 4000, '2GKzz5w5p', '2GKzz5w5peMdEBEAdn.jpg', 'Mlonggo', 'Mlonggo', 'Exp Buyer', 'SELESAI'),
(9, 3, 2, 'SIRAJ MEUBLE', 'afrr', '085656565656', '08970025959', 'update', 4000, '2GKzz5w5p', '2GKzz5w5peMdEBEAdn.jpg', 'Mlonggo', 'dcdfv', 'Null', 'DI PROSES'),
(10, 3, 2, 'SIRAJ MEUBLE', 'afrr', '085656565656', '08970025959', 'update', 4000, '2GKzz5w5p', '2GKzz5w5peMdEBEAdn.jpg', 'Mlonggo', 'dcdfv', 'Null', 'DI PROSES'),
(11, 3, 1, 'ADJATI MEUBLE', 'afrr', '08565786768432', '08970025959', 'Adjt 5', 4000000, '14kWDbhVN', 'empat.png', 'Mlonggo', 'hudis', 'Null', 'DI PROSES'),
(12, 4, 1, 'adjt', 'psstore', '08565786768432', '08970025959', 'dff', 4, '1FOcMGOn8', 'C:\\xampp\\tmp\\php60D.tmp', 'rer', 're', 'EMPTY', 'DI PROSES'),
(13, 3, 1, 'ADJATI MEUBLE', 'afrr', '08565786768432', '08970025959', 'adjt 2', 3000, '1Q3YJTwbJ', 'dua.png', 'Mlonggo', 'dcf', 'Null', 'DI PROSES'),
(14, 3, 1, 'ADJATI MEUBLE', 'afrr', '08565786768432', '08888', 'Adjt 5', 4000000, '14kWDbhVN', 'empat.png', 'Mlonggo', 'cz', 'Null', 'DI PROSES'),
(15, 3, 2, 'SIRAJ MEUBLE', 'afrr', '085656565656', '08888', 'update', 4000, '2GKzz5w5p', '2GKzz5w5peMdEBEAdn.jpg', 'Mlonggo', 'scsx', 'Null', 'DI PROSES'),
(16, 3, 2, 'SIRAJ MEUBLE', 'afrr', '085656565656', '08888', 'update', 4000, '2GKzz5w5p', '2GKzz5w5peMdEBEAdn.jpg', 'Mlonggo', 'scsx', 'Null', 'DI PROSES'),
(17, 3, 2, 'SIRAJ MEUBLE', 'afrr', '085656565656', '08888', 'update', 4000, '2GKzz5w5p', '2GKzz5w5peMdEBEAdn.jpg', 'Mlonggo', 'SRG', 'To Push', 'DI PROSES');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `telephone`, `username`, `password`, `role_user`) VALUES
(1, 'adajati meuble', 'adjt@gmail.com', '08970025959', 'adjt', 'p', 'SELLER'),
(2, 'siraj meuble', 's@g.g', '08970025959', 'srj', 'p', 'SELLER'),
(3, 'afrr', 'afr@g.c', '08970025959', 'afrr', 'p', 'VISITOR'),
(4, 'psstore', 'a@a.a', '08970025959', 'pss', 'p', 'SELLER'),
(5, 'fang', 'adajati@m.m', '085', 'fang12', 'p', 'VISITOR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk_image`
--
ALTER TABLE `produk_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk_image`
--
ALTER TABLE `produk_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
