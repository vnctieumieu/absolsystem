-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2020 at 12:00 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absoldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `userName`, `password`, `email`, `address`, `isAdmin`) VALUES
(6, 'admin', '$2y$10$tiwMD/DMKVSafbdo9A1H3eipCrA3HZ6Sz2iTI9NwqkDud3iaxdFYK', 'admin@gmail.com', '72/152 Cao Lổ, P4, Q8, Tp Hồ Chí Minh', 1),
(7, 'test', '$2y$10$CuMNSOdmi4YqacHF2ePtROgjhiWPuZGePh9fcqIv7uuspP.RNnZmy', 'test@gmail.com', 'Đại Học STU', 0);

-- --------------------------------------------------------

--
-- Table structure for table `homepageposter`
--

CREATE TABLE `homepageposter` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datepost` double NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homepageposter`
--

INSERT INTO `homepageposter` (`id`, `title`, `datepost`, `content`) VALUES
(1, 'Cập nhật mới', 1607243360, '<p style=\"text-align:center\"><img alt=\"\" src=\"/ckfinder/userfiles/files/MunchkinOrange.jpg\" style=\"height:55px; width:60px\" /></p>\n\n<p><span style=\"color:#2ecc71\">- Find&nbsp;<em>terrific</em>&nbsp;and&nbsp;<em>spooky</em>&nbsp;event forms, with new never-ever seen ones making an appearance!</span><br />\n- Explore and uncover the truth behind conflicts taking place in Murky Town!<br />\n<span style=\"color:#27ae60\"><span style=\"font-size:16px\"><strong>- Newly coded abilities and moves!</strong></span></span><br />\n<span style=\"color:#e74c3c\">- Some new secrets to explore, can you find them all?</span></p>\n'),
(2, 'Sự kiện hot', 1607313612, '<p><img alt=\"\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTODwFU2I-UkoK8qXQOtas2tz06zNTRZ5bsIA&amp;usqp=CAU\" style=\"width:150px\" /></p>\n\n<p>aa</p>\n\n<p>&nbsp;</p>\n\n<p>aa</p>\n\n<p>&nbsp;</p>\n\n<p>aa</p>\n\n<p>a</p>\n\n<p>&nbsp;</p>\n\n<p>a</p>\n\n<p>a</p>\n\n<p>&nbsp;</p>\n\n<p>a</p>\n\n<p>a</p>\n'),
(3, 'Mega Coming Soon', 1606546457, '<p>Greetings everyone!<br />\n<span style=\"color:#3498db\">Recently, a new role within the Content Team has opened with the name of &ldquo;Story Writer&rdquo;. The purpose of this role is to create and shape the narrative aspect of the game while remaining faithful to the original lore aswell as keeping open communication with the rest of the Content Team.</span><br />\nThe most impontant requirements to apply are the following:<br />\n- Lot of knowledge about Pok&eacute;mon lore.<br />\n&nbsp;</p>\n'),
(4, 'Sale 2020', 1606630676, '<p><img alt=\"\" src=\"/ckfinder/userfiles/files/avt_13.jpg\" style=\"height:75px; width:60px\" /></p>\n\n<p>- Newly coded abilities and moves.<br />\n- Plenthora of bug fixes for both moves, battle system, and more.<br />\n-&nbsp;<strong>Implementation of mega-evolution during battles.</strong><br />\n- U-Turn and Volt-Switch work as intented now.<br />\n- Changes to the EXP bar and pokeball throw.</p>\n');

-- --------------------------------------------------------

--
-- Table structure for table `homepagevideo`
--

CREATE TABLE `homepagevideo` (
  `id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homepagevideo`
--

INSERT INTO `homepagevideo` (`id`, `code`) VALUES
(1, 'C_BWegJhZlc');

-- --------------------------------------------------------

--
-- Table structure for table `orderbyuser`
--

CREATE TABLE `orderbyuser` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateTime` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: hoàn tất\r\n2: chưa hoàn tất',
  `amoutProduct` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderbyuser`
--

INSERT INTO `orderbyuser` (`id`, `userName`, `dateTime`, `status`, `amoutProduct`) VALUES
(1, 'admin', 1607321012, 1, 1),
(2, 'admin', 1607321043, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `id` int(11) NOT NULL,
  `orderByUserID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `amount` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`id`, `orderByUserID`, `productID`, `amount`) VALUES
(1, 1, 1, 1),
(3, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pictureproduct`
--

CREATE TABLE `pictureproduct` (
  `id` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `picture` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pictureproduct`
--

INSERT INTO `pictureproduct` (`id`, `idProduct`, `picture`) VALUES
(1, 1, '1607320469.jpg'),
(2, 1, '1607320472.jpg'),
(3, 1, '1607320476.jpg'),
(4, 2, '1607320950.jpg'),
(5, 3, '1607320964.jpg'),
(6, 5, '1607320981.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `typeCode` int(11) NOT NULL,
  `itemsLove` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: không hàng yêu thích\r\n1: có',
  `size` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `typeCode`, `itemsLove`, `size`, `status`, `description`) VALUES
(1, 'Chamander', 5000, 17, 0, 55, 1, 'Charmander nóng bỏng'),
(2, 'Snivy', 21, 17, 0, 55, 1, 'asdadsa'),
(3, 'Snivy2121', 21, 17, 0, 55, 1, NULL),
(4, 'Eevee', 21, 17, 0, 55, 1, NULL),
(5, 'Sqirt', 21, 17, 0, 55, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE `producttype` (
  `id` int(11) NOT NULL,
  `typeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`id`, `typeName`, `status`) VALUES
(17, 'Thú Bông', 1),
(18, 'Móc Khóa', 0),
(19, 'Loại Mới', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- Indexes for table `homepageposter`
--
ALTER TABLE `homepageposter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepagevideo`
--
ALTER TABLE `homepagevideo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderbyuser`
--
ALTER TABLE `orderbyuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orderdetail_orderbyuser` (`orderByUserID`);

--
-- Indexes for table `pictureproduct`
--
ALTER TABLE `pictureproduct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pictureProduct_product` (`idProduct`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_producttype` (`typeCode`);

--
-- Indexes for table `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `homepageposter`
--
ALTER TABLE `homepageposter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `homepagevideo`
--
ALTER TABLE `homepagevideo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orderbyuser`
--
ALTER TABLE `orderbyuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pictureproduct`
--
ALTER TABLE `pictureproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `producttype`
--
ALTER TABLE `producttype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `fk_orderdetail_orderbyuser` FOREIGN KEY (`orderByUserID`) REFERENCES `orderbyuser` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pictureproduct`
--
ALTER TABLE `pictureproduct`
  ADD CONSTRAINT `fk_pictureProduct_product` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_producttype` FOREIGN KEY (`typeCode`) REFERENCES `producttype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
