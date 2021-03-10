-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2021 at 09:35 AM
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
(1, 'KURSI'),
(2, 'MEJA'),
(3, 'UKIRAN'),
(4, 'GEBYOK');

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
(1, '17FeSKyFj', 1, 'SunBed Berjemur Mebel Jepara', 950000, 'KURSI', 'Spesifikasi \nKondisi : Baru\nBerat     : 100 Gram\nPreorder: 7 Hari\n\nsofa kursi Cafe , kursi santai , kursi tamu minimalis pengrajin jepara\n\nUD.SIRAJ MEUBLE : menjual Kebutuhan Furniture dengan kualitas barang yang bagus karena proses produksi kami kerjakan sendiri langsung di UD. SIRAJ MEUBLE Jepara oleh pengrajin yang sudah berpengalaman dengan menggunakan bahan JATI BERKUALITAS', 5),
(3, '10wzQnefX', 1, 'KURSI - CAFE - RESTO - Belum finising', 250000, 'KURSI', 'Tinggi dudukan 45cm.\r\nTinggi sandaran 80cm. Panjang 43cm. Lebar 42cm Terbuat dari kayu jati solid. Finising melamin nc. Bisa request warna', 5),
(4, '1OeEV6NBB', 1, 'MEJA MAKAN SET OUTDOOR', 45000000, 'MEJA', 'Terdiri dari - 1 meja ukuran 180cm x90cm x 75cm. Kaki pakai besi. - 6 kursi dilengkapi matras dudukan. - Finising teak oil outdoor', 5),
(6, '1fl9OCZLP', 1, 'MEJA MEETING LAMINATING KAYU JATI - Finising', 550000, 'MEJA', '-Terbuat dari kayu jati yg diproses melalui laminating sehingga nampak unik dan antik. - Finising melamin nc natural menambah indah dan menarik dipandang mata. - Dilengkapi stop kontak listrik merk bruco yg bisa dipakai cas hp atau laptop. - Ukuran 280cm x 100cm x 75cm.', 3),
(7, '1aYId9pF1', 1, 'MEJA BELAJAR IMPRES SD SMP SMA MEBEL JEPARA', 300000, 'MEJA', 'Terbuat dari kayu mahoni Pengerjaan rapi karena diawasi oleh qc kami yang sudah berpengalaman. Konstruksi kuat. Finising melamin nc. Grade barang berkwaliats. Harga terjangkau. Ukuran kursi 60x50x85cm. tinggi dudukan kursi 45cm  Silahkan bertanya apa saja yang berhubungan dengan produk kami.', 3),
(8, '1l1AbYbcz', 1, 'KURSI SOFA MEBEL JEPARA', 950000, 'KURSI', 'Terbuat dari kayu mahogani berkwalitas. cover pakai oscar. mudah dibersihkan. Finising melamin atau duco seduai request  HARGA BELUM TERMASUK ONGKIR BARANG VIA TRUCK.  Nb: - Ongkir yg tercantum hanya untuk pengiriman dokumen/faktur. - Pengiriman barang melalui expedisi truck karena kategori barang besar.  Jika masih ada yg ditanyakan silahkan hubungi kami.', 3),
(14, '1obWFtXn7', 1, 'ds', 112968, 'KURSI', 'kosong', 0),
(18, '1XvHY0aKz', 1, 'Exp Product 1', 1000000, 'KURSI', 'Exp Desc', 1),
(19, '1xUOeoDeA', 1, 'Exp Product 2', 200000, 'MEJA', 'Exp Desc', 2),
(20, '11WZ8vsoU', 1, 'SA', 112968, 'KURSI', 'kosong', 0),
(21, '1bWEPZyMs', 1, 'ASX', 112968, 'KURSI', 'kosong', 0),
(22, '1YdXRVbm1', 1, 'dc', 112968, 'KURSI', 'kosong', 0),
(23, '1n7AVNKge', 1, 'c', 112968, 'KURSI', 'kosong', 0),
(24, '1Dz7KUKCg', 1, 'adjt', 112968, 'KURSI', 'kosong', 0),
(25, '1DlIjVh01', 1, 'dcs', 112968, 'MEJA', 'kosong', 0),
(26, '1v35Va4I8', 1, 'adjt', 112968, 'MEJA', 'kosong', 0),
(27, '1Hiyi1GQ0', 1, 'dscs', 112968, 'KURSI', 'kosong', 0),
(28, '1LuiqCcxE', 1, 'adjt', 112968, 'KURSI', 'kosong', 0),
(29, '1w7xoJPFc', 1, 'cs', 112968, 'MEJA', 'kosong', 0),
(30, '1ggxPdjlf', 1, 'sa', 112968, 'KURSI', 'kosong', 0),
(31, '1y7AtwIzG', 1, 'c', 112968, 'KURSI', 'kosong', 0),
(32, '1ZcnT8cr1', 1, 'adjt', 1, 'KURSI', 'dc fv', 2),
(33, '1vFemCvyb', 1, 'dcs', 112968, 'KURSI', 'kosong', 0),
(34, '186ELymiu', 1, 'cdscf', 32, 'KURSI', 'dcsc', 32),
(35, '12JC8gxMi', 1, 'dcs', 112968, 'KURSI', 'kosong', 0),
(36, '1naM1rSo9', 1, 'cdscf', 112968, 'KURSI', 'kosong', 0),
(37, '1ZE8kaEM3', 1, 'dcs', 112968, 'KURSI', 'kosong', 0),
(38, '1mQ8kOiUb', 1, 'dscs', 32, 'KURSI', 'dcs', 3),
(39, '189VFZQkt', 1, 'ds', 112968, 'MEJA', 'kosong', 0),
(40, '1hoOAMkwu', 1, 'cdxsw', 32, 'KURSI', 'dscx', 3);

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
(1, '17FeSKyFj', '17FeSKyFjOVA0PSXSv.jpg', '17FeSKyFj6VuJbx1sg.jpg', 'default.png', 'default.png', 'default.png'),
(3, '10wzQnefX', '10wzQnefXFrvr5Vwux.jpg', '10wzQnefXLoJwtYkuZ.jpg', 'default.png', 'default.png', 'default.png'),
(4, '1OeEV6NBB', '1OeEV6NBBXhlf4rlKz.jpg', '1OeEV6NBBDlawm9RpT.jpg', 'default.png', 'default.png', 'default.png'),
(6, '1fl9OCZLP', '1fl9OCZLPr3ZNjPc7N.jpg', '1fl9OCZLPPT2WQX8Em.jpg', '1fl9OCZLPCOhuKZnFU.jpg', 'default.png', 'default.png'),
(7, '1aYId9pF1', '1aYId9pF1GqT6B0r2v.jpg', '1aYId9pF1BRqVG1AEX.jpg', 'default.png', 'default.png', 'default.png'),
(8, '1l1AbYbcz', '1l1AbYbczmTcaEWT0e.jpg', '1l1AbYbczs5Ptrxan6.jpg', 'default.png', 'default.png', 'default.png'),
(14, '1XvHY0aKz', '1XvHY0aKzGtQul018M.jpg', '1XvHY0aKzzW7Gxr8Ut.jpg', 'default.png', 'default.png', 'default.png'),
(15, '1xUOeoDeA', '1xUOeoDeASfCN1NSBs.jpg', '1xUOeoDeAW2U9KBlmg.jpg', 'default.png', 'default.png', 'default.png'),
(16, '1ZcnT8cr1', '1ZcnT8cr1je9Vw3iq8.jpg', 'default.png', 'default.png', 'default.png', 'default.png'),
(17, '1vFemCvyb', '1vFemCvybg7ip4JOAl.jpg', '1vFemCvybvEWDJEdSD.jpg', 'default.png', 'default.png', 'default.png'),
(18, '186ELymiu', '186ELymiu5xSS6TGwc.jpg', 'default.png', 'default.png', 'default.png', 'default.png'),
(19, '1mQ8kOiUb', '1mQ8kOiUbJYZgne9Bl.jpg', 'default.png', 'default.png', 'default.png', 'default.png'),
(20, '1hoOAMkwu', '1hoOAMkwuyAebRd1AC.jpg', '1hoOAMkwujrZx60CF8.jpg', '1hoOAMkwuUg7i16CBK.jpg', '1hoOAMkwutBmTUC0ir.jpg', '1hoOAMkwuRdOPOkltL.jpg');

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
(1, 'profilsrj.jpg', 'image4601.png', 'ADAJATI MEUBLE', 1, 'Menjual Mebel Asli Jepara dan dibuat dengan Kayu Jati asli,bisa preorder dengan memilih kayu,cat dan model ukiran\r\n\r\n\r\n', 'Jl. Kauman, RT.03/RW.03, Rw2, Srobyong, Kec. Mlonggo, Kabupaten Jepara, Jawa Tengah 59452', '0897754998374'),
(2, 'default-profil.jpg', '1.png', 'SIRAJ MEUBLE', 2, 'Pe', 'Jl. Kauman, RT.03/RW.03, Rw2, Srobyong, Kec. Mlonggo, Kabupaten Jepara, Jawa Tengah 59452', '089789979883');

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
(3, 3, 1, 'ADAJATI MEUBLE', 'user1', '0897754998374', '08888', 'SunBed Berjemur Mebel Jepara', 950000, '17FeSKyFj', '17FeSKyFjOVA0PSXSv.jpg', 'Jl. Kauman, RT.03/RW.03, Rw2, Srobyong, Kec. Mlonggo, Kabupaten Jepara, Jawa Tengah 59452', 'Exp', 'Exp', 'SELESAI'),
(4, 3, 1, 'ADAJATI MEUBLE', 'user1', '0897754998374', '08888', 'MEJA MAKAN SET OUTDOOR', 45000000, '1OeEV6NBB', '1OeEV6NBBXhlf4rlKz.jpg', 'Jl. Kauman, RT.03/RW.03, Rw2, Srobyong, Kec. Mlonggo, Kabupaten Jepara, Jawa Tengah 59452', 's', 'Null', 'SELESAI');

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
  `role_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `telephone`, `username`, `password`, `role_user`) VALUES
(1, 'ADAJATI MEUBLE', 'adajatimeuble1@gmail.com', '089789979883', 'adjtmeuble', 'p', 'SELLER'),
(2, 'SIRAJ MEUBLE', 'test@gmail.com', '0897999999999', 'srj', 'p', 'SELLER'),
(3, 'user1', 's@s.s', '09898989898', 'usr1', 'p', 'VISITOR');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `produk_image`
--
ALTER TABLE `produk_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
