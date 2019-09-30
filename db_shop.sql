-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2017 at 10:03 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(32) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `level`) VALUES
(1, 'opu datta', 'admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'ACER'),
(2, 'IPHONE'),
(3, 'SAMSUNG'),
(4, 'CANON');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `ssnId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `ssnId`, `productId`, `productName`, `price`, `quantity`, `image`) VALUES
(1, '52bfcusga8s8uvqaa0seui5nh0', 10, 'Lorem Ipsum is simply', 456.00, 1, 'upload/ca49de6ca9.png'),
(2, 'dnlbh4gofempf864pj7jt0hkp4', 10, 'Lorem Ipsum is simply', 456.00, 2, 'upload/ca49de6ca9.png'),
(3, 'dnlbh4gofempf864pj7jt0hkp4', 8, 'Lorem Ipsum is simply', 505.22, 1, 'upload/4dec88897d.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(1, 'Desktop'),
(3, 'Laptop'),
(4, 'Mobile Phones'),
(5, 'Accessories'),
(6, 'Software'),
(7, 'Sports &amp; Fitness'),
(8, 'Footwear'),
(9, 'Jewellery'),
(10, 'Clothing'),
(11, 'Home Decor &amp; Kitchen'),
(12, 'Beauty &amp; Healthcare'),
(13, 'Toys, Kids &amp; Babies');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zip`, `phone`, `email`, `password`) VALUES
(1, 'opu datta', 'dfbdfb', 'fghfghn', 'DZ', 'ccccdbdfb', 'fdbdfb', 'cccccc', 'dfbdfb'),
(2, 'qqq', 'nfgn', 'tdhdtrthrt', 'AF', 'gfhnfghn', 'nfgn', 'fghnfgn', '8bf6002a1f0a09fb75a9c26f3cb5e1d0'),
(3, 'dfghdfhd', 'dfndfndf', 'fdbdfbdfh', 'ndfndfn', 'dfhndfhnfdn', 'dfndfndfn', 'dfndfndfn', '611d812cdabc332e03b1660d91d05530'),
(4, 'opu datta', 'aaaaaaaa', 'aaaaaaa', 'Bangladesh', 'aaaaaaaa', '01838737333', 'apoudatto6@gmail.com', '202cb962ac59075b964b07152d234b70'),
(5, 'wqefweqf', 'wefwe', 'werfwef', 'ewrfef', 'wefwef', 'werfwef', 'wefwef', '2b0c737d84add700b987adb913d3f6d9'),
(6, 'sdfgs', 'sfdgs', 'sdgs', 'sdgg', 'sdg', 'sdg', 'opu@gmail.com', '202cb962ac59075b964b07152d234b70'),
(7, 'jhng', 'ghn', 'ghng', 'ghnfgn', 'gfnn', 'ghnfgn', 'hgjn', '9d82f8e3b76de16b486898d0c14ec7a1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `cmrId`, `productId`, `productName`, `quantity`, `price`, `image`, `date`) VALUES
(13, 4, 10, 'Lorem Ipsum is simply', 2, 456.00, 'upload/ca49de6ca9.png', '2016-12-26 18:52:41'),
(14, 4, 11, 'Lorem Ipsum is simply', 3, 456.00, 'upload/3b43d7fa6b.jpg', '2016-12-26 18:52:41'),
(15, 4, 10, 'Lorem Ipsum is simply', 1, 456.00, 'upload/ca49de6ca9.png', '2016-12-26 18:52:41'),
(16, 4, 10, 'Lorem Ipsum is simply', 1, 456.00, 'upload/ca49de6ca9.png', '2016-12-26 18:52:41'),
(17, 4, 9, 'Lorem Ipsum is simply', 1, 456.00, 'upload/d778ca9990.jpg', '2016-12-26 18:52:41'),
(18, 4, 10, 'Lorem Ipsum is simply', 1, 456.00, 'upload/ca49de6ca9.png', '2017-01-03 20:31:13'),
(19, 4, 8, 'Lorem Ipsum is simply', 1, 505.22, 'upload/4dec88897d.jpg', '2017-01-04 15:49:58'),
(20, 4, 10, 'Lorem Ipsum is simply', 1, 456.00, 'upload/ca49de6ca9.png', '2017-01-05 10:09:50'),
(21, 4, 11, 'Lorem Ipsum is simply', 1, 456.00, 'upload/3b43d7fa6b.jpg', '2017-01-05 10:39:17'),
(22, 4, 8, 'Lorem Ipsum is simply', 1, 505.22, 'upload/4dec88897d.jpg', '2017-01-05 10:39:17'),
(23, 4, 9, 'Lorem Ipsum is simply', 1, 456.00, 'upload/d778ca9990.jpg', '2017-01-20 08:52:56'),
(24, 6, 11, 'Lorem Ipsum is simply', 10, 456.00, 'upload/3b43d7fa6b.jpg', '2017-02-06 14:25:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `body`, `price`, `image`, `type`) VALUES
(1, 'Lorem Ipsum is simply', 5, 4, '<p>This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;</p>\r\n<p>This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;This is description.&nbsp;</p>', 505.22, 'upload/ff3ee32648.png', 1),
(2, 'Lorem Ipsum is simply', 13, 3, '<p>Lorem Ipsum is simply Description....Lorem Ipsum is simply Description....Lorem Ipsum is simply Description....Lorem Ipsum is simply Description....Lorem Ipsum is simply Description....Lorem Ipsum is simply Description....Lorem Ipsum is simply Description....Lorem Ipsum is simply Description....Lorem Ipsum is simply Description....Lorem Ipsum is simply Description....Lorem Ipsum is simply Description....Lorem Ipsum is simply Description....</p>', 456.00, 'upload/99c2d9b5f8.jpg', 2),
(3, 'Lorem Ipsum is simply', 11, 2, '<p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit..<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit..<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit..</span></span></span></p>', 505.22, 'upload/2164fe6d39.jpg', 2),
(4, 'Lorem Ipsum is simply', 8, 4, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..</p>', 456.00, 'upload/745bb9a236.png', 1),
(5, 'Lorem Ipsum is simply', 10, 1, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..</p>', 505.22, 'upload/bd277caec7.jpg', 1),
(6, 'Lorem Ipsum is simply', 6, 4, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..</p>', 500.00, 'upload/73a57c9f5d.jpg', 1),
(7, 'Lorem Ipsum is simply', 1, 4, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..</p>', 456.00, 'upload/2092a608ac.jpg', 2),
(8, 'Lorem Ipsum is simply', 1, 1, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..</p>', 505.22, 'upload/4dec88897d.jpg', 1),
(9, 'Lorem Ipsum is simply', 6, 2, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..</p>', 456.00, 'upload/d778ca9990.jpg', 1),
(10, 'Lorem Ipsum is simply', 4, 2, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..</p>', 456.00, 'upload/ca49de6ca9.png', 1),
(11, 'Lorem Ipsum is simply', 3, 3, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elitLorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..Lorem ipsum dolor sit amet, consectetur adipisicing elit..</p>', 456.00, 'upload/3b43d7fa6b.jpg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
