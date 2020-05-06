-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 04, 2019 at 08:43 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `EAuction`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `search` (IN `prodname` VARCHAR(50))  SELECT * from products WHERE pname = prodname$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adusername` varchar(50) NOT NULL,
  `adpassword` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adusername`, `adpassword`) VALUES
('admin', 'admin'),
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `audit_product`
--

CREATE TABLE `audit_product` (
  `id` int(11) NOT NULL,
  `prod_name` varchar(200) NOT NULL,
  `action_performed` varchar(400) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit_product`
--

INSERT INTO `audit_product` (`id`, `prod_name`, `action_performed`, `date_added`) VALUES
(19, 'King sized bed', 'Inserted a new product.', '2019-11-03 14:26:54'),
(24, 'Mamba Focus Shoes', 'Updated a product.', '2019-11-03 14:29:58'),
(25, 'Sofa Set', 'Deleted a product.', '2019-11-03 14:31:18'),
(65, 'Dining Table Set', 'Inserted a new product.', '2019-11-07 17:03:33'),
(71, 'OnePlus 7T Pro', 'Inserted a new product.', '2019-11-07 17:18:59'),
(84, 'iPhone 11 Pro', 'Inserted a new product.', '2019-11-07 17:43:27'),
(108, 'iPhone 11 Pro', 'Updated a product.', '2019-11-30 16:55:16'),
(109, 'iPhone 11 Pro', 'Updated a product.', '2019-11-30 16:55:27'),
(110, 'Dining Table Set', 'Updated a product.', '2019-11-30 16:55:35'),
(111, 'Trench Coat ', 'Updated a product.', '2019-11-30 16:56:02'),
(112, 'Mamba Focus Shoes', 'Updated a product.', '2019-11-30 16:56:13'),
(113, 'OnePlus 7T Pro', 'Updated a product.', '2019-11-30 16:56:20'),
(121, 'OnePlus 7T Pro', 'Deleted a product.', '2019-12-03 14:07:13'),
(122, 'OnePlus 7T Pro', 'Inserted a new product.', '2019-12-03 14:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `bidproducts`
--

CREATE TABLE `bidproducts` (
  `username` varchar(50) NOT NULL,
  `pid` int(11) NOT NULL,
  `bidamount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidproducts`
--

INSERT INTO `bidproducts` (`username`, `pid`, `bidamount`) VALUES
('v', 1, 95000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(10) NOT NULL,
  `seller` varchar(25) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `startprice` int(10) NOT NULL,
  `endtime` datetime NOT NULL,
  `image` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `seller`, `pname`, `category`, `description`, `startprice`, `endtime`, `image`) VALUES
(1, 'vibha', 'iPhone 11 Pro', 'mobiles', 'This phone comes with a 5.80-inch touchscreen display with a resolution of 1125x2436 pixels at a pixel density of 458 pixels per inch (ppi).', 93000, '2019-12-10 02:25:00', 0x6970686f6e652e6a7067),
(90, 'harshitha', 'Dining Table Set', 'furniture', 'Dining Table for four. Made of rose wood.', 25000, '2019-12-12 05:30:00', 0x64696e696e677461626c652e6a7067),
(94, 'v', 'Trench Coat ', 'clothing', 'Blue trench coat for women. It is comfortable and is a winter-wear clothing.', 3000, '2019-12-17 16:15:00', 0x636f61742e6a7067),
(95, 'vibha', 'Mamba Focus Shoes', 'footwear', 'Comfortable basketball shoes. Size 11. ', 7500, '2019-12-12 22:00:00', 0x73686f65732e6a7067),
(100, 'harshitha', 'OnePlus 7T Pro', 'mobiles', 'The brand new OnePlus 7T Pro with amazing new features at the lowest cost! Features: 6.65\" screen size, 48 + 16 + 8 | 16 MP camera, 64GB/8GB memory, 4085 MAH battery.', 40000, '2019-12-07 04:30:00', 0x6f6e65706c75732e6a7067);

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `after_product_delete` AFTER DELETE ON `products` FOR EACH ROW BEGIN
    INSERT INTO audit_product
    SET action_performed  = 'Deleted a product.',
    prod_name =  OLD.pname;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_product_edit` AFTER UPDATE ON `products` FOR EACH ROW BEGIN
    INSERT INTO audit_product
    SET action_performed  = 'Updated a product.',
    prod_name       =  OLD.pname;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_product_insert` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
    INSERT INTO audit_product
    SET action_performed  = 'Inserted a new product.',
    prod_name = new.pname;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `winner` BEFORE DELETE ON `products` FOR EACH ROW INSERT INTO winners SELECT p.pid,b.username,p.pname,p.category,p.description,p.image,b.bidamount FROM products p,bidproducts b where p.pid=old.pid and b.bidamount IN( SELECT max(bidamount) FROM bidproducts WHERE pid=old.pid)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'vibha', 'vibha'),
(2, 'v', 'v'),
(3, 'admin', 'admin'),
(4, 'harshitha', 'harshitha'),
(5, 'xyz', 'xyz');

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE `winners` (
  `pid` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` mediumblob NOT NULL,
  `winningbid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `winners`
--

INSERT INTO `winners` (`pid`, `username`, `pname`, `category`, `description`, `image`, `winningbid`) VALUES
(96, 'vibha', 'OnePlus 7T Pro', 'mobiles', 'The brand new OnePlus 7T Pro with amazing new features at the lowest cost! Features: 6.65\" screen size, 48 + 16 + 8 | 16 MP camera, 64GB/8GB memory, 4085 MAH battery', 0x6f6e65706c75732e6a7067, 45700);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_product`
--
ALTER TABLE `audit_product`
  ADD PRIMARY KEY (`id`,`prod_name`,`action_performed`),
  ADD UNIQUE KEY `date_added` (`date_added`);

--
-- Indexes for table `bidproducts`
--
ALTER TABLE `bidproducts`
  ADD PRIMARY KEY (`username`,`pid`),
  ADD KEY `productid` (`pid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `pname` (`pname`),
  ADD UNIQUE KEY `pname_2` (`pname`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`username`);

--
-- Indexes for table `winners`
--
ALTER TABLE `winners`
  ADD PRIMARY KEY (`pid`,`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_product`
--
ALTER TABLE `audit_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidproducts`
--
ALTER TABLE `bidproducts`
  ADD CONSTRAINT `productid` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
