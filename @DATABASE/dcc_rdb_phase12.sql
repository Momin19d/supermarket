-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2020 at 10:05 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcc_rdb_phase12`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL COMMENT 'admin_id',
  `admin_name` varchar(64) NOT NULL,
  `admin_email` varchar(64) NOT NULL,
  `admin_password` varchar(64) NOT NULL,
  `admin_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `admin_type` enum('Root Admin','Content Manager','Sales Manager','Technical Operator') NOT NULL DEFAULT 'Root Admin',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_name`, `admin_email`, `admin_password`, `admin_status`, `admin_type`, `created_at`, `updated_at`) VALUES
(1, 'Nirjhor Anjum', 'nirjhor@adnsl.net', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', 'Root Admin', '2020-04-10 18:53:12', NULL),
(4, 'Jobayer Tusher', 'jobayer@tusher.com.bd', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', 'Content Manager', '2020-04-10 21:09:15', NULL),
(6, 'Abdullah Al Mamun Roni', 'roni@piit.us', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', 'Sales Manager', '2020-04-07 19:54:38', NULL),
(7, 'Al Momin', 'momin@piit.us', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', 'Technical Operator', '2020-04-28 19:54:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT 'categoty_id',
  `category_name` varchar(128) NOT NULL,
  `category_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_status`) VALUES
(19, 'Men', 'Active'),
(20, 'Women', 'Active'),
(21, 'Kids', 'Active'),
(22, 'Electronics', 'Active'),
(23, 'Grocery', 'Active'),
(24, 'Gadget', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(128) NOT NULL,
  `customer_email` varchar(128) NOT NULL,
  `customer_mobile` varchar(64) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_password` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `customer_status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `customer_email`, `customer_mobile`, `customer_address`, `customer_password`, `customer_status`, `created_at`, `updated_at`) VALUES
(1, 'James Butt', 'jamesbutt@gmail.com', '15046218927', '6649 N Blue Gum St, New Orleans', 'e99a18c428cb38d5f260853678922e03', 'Active', '2020-04-21 16:12:11', NULL),
(2, 'Joseph', 'josephine_darakjy@yahoo.com', '15046218923', '4 B Blue Ridge Blvd, Brighton', 'e99a18c428cb38d5f260853678922e03', 'Active', '2020-04-21 16:12:19', NULL),
(3, 'Rocki', 'lpaprocki@hotmail.com', '15046218944', '639 Main St, Anchorage', 'e99a18c428cb38d5f260853678922e03', 'Active', '2020-04-21 16:12:22', NULL),
(4, 'Simon', 'simonamorasca@gmail.com', '15046218966', '3 Mcauley Dr, Ashland', 'e99a18c428cb38d5f260853678922e03', 'Active', '2020-04-21 16:12:25', NULL),
(9, 'Nirjhor Anjum', 'nirjhor.anjum@gmail.com', '07428144878', 'Dhaka, Bangladesh', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Active', '2020-04-26 18:19:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT 'order_id',
  `order_date` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sub_total` double NOT NULL,
  `delivery_charge` double NOT NULL,
  `grand_total` double NOT NULL,
  `payment_method` enum('SSLCOMMERZ','PayPal','Cash on Delivery','bKash') NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `transaction_status` enum('Paid','Unpaid','Fraud') NOT NULL DEFAULT 'Unpaid',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL COMMENT 'order_id',
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `order_item_status` enum('Pending','Accepted','Rejected') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL COMMENT 'page_id',
  `page_title` text COLLATE utf8_unicode_ci NOT NULL,
  `page_content` text COLLATE utf8_unicode_ci NOT NULL,
  `page_status` enum('Active','Inactive') CHARACTER SET utf8 NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL COMMENT 'product_id',
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `product_summary` text NOT NULL,
  `product_details` text NOT NULL,
  `product_master_image` text NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `product_discount_price` double NOT NULL,
  `discount_start` datetime NOT NULL,
  `discount_ends` datetime NOT NULL,
  `product_status` enum('In Stock','Out of Stock') NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `product_name`, `product_summary`, `product_details`, `product_master_image`, `product_quantity`, `product_price`, `product_discount_price`, `discount_start`, `discount_ends`, `product_status`, `tags`, `created_at`, `updated_at`) VALUES
(4, 19, 10, 'Mens Blu Jeans Tshirt', '<h4>No product summary</h4>', '<h5>No product details</h5>', 'PRODUCT_20200422180456_phase7image(9).jpg', 10, 199.99, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'tshirt, jeans, mens, men, man, t-shirt', '2020-04-22 18:04:56', NULL),
(5, 20, 11, 'Womens Product 2020', '<h4>No product summary</h4>', '<h5>No product details</h5>', 'PRODUCT_20200422181452_phase7image(5).jpg', 2, 99.99, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-22 18:14:52', NULL),
(7, 20, 11, 'Woman Product 2020', '																											<h4>No product summary</h4>																								', '																											<h5>No product details</h5>																								', 'PRODUCT_20200425085620_women(7).png', 1, 129.99, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'women', '2020-04-22 18:16:26', NULL),
(8, 21, 15, 'Kids Product 2020', '<h4>No product summary</h4>', '<h5>No product details</h5>', 'PRODUCT_20200422181707_phase7image(3).jpg', 2, 69.99, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-22 18:17:07', NULL),
(9, 21, 16, 'Kids Product 2020', '<h4>No product summary</h4>', '<h5>No product details</h5>', 'PRODUCT_20200422181742_phase7image(2).jpg', 2, 89.99, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-22 18:17:42', NULL),
(10, 19, 9, 'Mens Product 2022', '<h4>No product summary</h4>', '<h5>No product details</h5>', 'PRODUCT_20200422181828_phase7image(6).jpg', 1, 56.99, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-22 18:18:28', NULL),
(11, 21, 14, 'Kidz Summer collection', '									<p>Kidz Summer collection<br></p>								', '									<p>Kidz Summer collection<br></p>								', 'PRODUCT_20200425090500_kids(3).png', 1, 1900, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-24 10:44:12', NULL),
(12, 20, 11, 'Lehenga trend', '									<p>Lehenga trend<br></p>								', '									<p>Lehenga trend<br></p>								', 'PRODUCT_20200425085601_women(6).png', 12, 1900, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-24 10:44:51', NULL),
(13, 21, 14, 'Awsom Shirt', '																		<p>Awsome Punjabi<br></p>																', '																		<p>Awsome Punjabi<br></p>																', 'PRODUCT_20200425085507_kids(4).png', 5, 1900, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', 'mens, tshirt', '2020-04-24 10:49:47', NULL),
(14, 21, 14, '2020 trends of summer', '									<p>2020 trends of summer<br></p>								', '									<p>2020 trends of summer<br></p>								', 'PRODUCT_20200425090521_kids(5).png', 12, 1899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-24 10:50:35', NULL),
(15, 21, 14, '2020 trends of summer', '									<p>2020 trends of summer<br></p>								', '									<p>2020 trends of summer<br></p>								', 'PRODUCT_20200425090441_kids(2).png', 12, 1899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-24 14:20:02', NULL),
(16, 20, 11, 'Woman Product 1', '<p>Woman Product 1<br></p>', '<p>Woman Product 1<br></p>', 'PRODUCT_20200425085921_women(1).png', 5, 2000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-25 08:59:21', NULL),
(17, 20, 11, 'Woman product 2', '<p>Woman product 2<br></p>', '<p>Woman product 2<br></p>', 'PRODUCT_20200425090005_women(2).png', 5, 2000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-25 09:00:05', NULL),
(18, 20, 11, 'Woman Product 3', '									<p>Woman Product 3<br></p>								', '									<p>Woman Product 3<br></p>								', 'PRODUCT_20200425090207_women(4).png', 5, 2190, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-25 09:00:37', NULL),
(19, 20, 11, 'Woman Product 4', '									<p>Woman Product 4<br></p>								', '									<p>Woman Product 4<br></p>								', 'PRODUCT_20200425090230_women(5).png', 5, 2290, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-25 09:01:27', NULL),
(20, 20, 11, 'Woman Product 5', '									<p>Woman Product 5<br></p>								', '									<p>Woman Product 5<br></p>								', 'PRODUCT_20200425090326_women(8).png', 5, 2290, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-25 09:01:27', NULL),
(21, 19, 10, 'Men Product 1', '<p>Men Product 1<br></p>', '<p>Men Product 1<br></p>', 'PRODUCT_20200425090616_men(2).png', 5, 1999, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-25 09:06:16', NULL),
(22, 19, 9, 'Men Product 2', '<p><ul>\r\n<li>This vest is very eye-catching</li>\r\n<li>A comfortable, fashionable and durable vest</li>\r\n<li>The fine workmanship vest is ideal for your working out</li>\r\n<li>Nice design with practical use which will make you more appealing.</li>\r\n<li>Ideal for football, basketball, soccer and other team sports</li>\r\n</ul></p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.</p>\r\n                                        <ul>\r\n                                            <li><i class=\"icon-ok\"></i>Any Product types that You want - Simple, Configurable</li>\r\n                                            <li><i class=\"icon-ok\"></i>Downloadable/Digital Products, Virtual Products</li>\r\n                                            <li><i class=\"icon-ok\"></i>Inventory Management with Backordered items</li>\r\n                                        </ul>\r\n                                        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, <br>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>', 'PRODUCT_20200425090651_men(3).png', 5, 1999, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Stock', NULL, '2020-04-25 09:06:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shopcarts`
--

CREATE TABLE `shopcarts` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopcarts`
--

INSERT INTO `shopcarts` (`id`, `customer_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(9, 9, 22, 2, '2020-05-05 18:00:33', NULL),
(10, 9, 21, 2, '2020-05-05 18:01:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL COMMENT 'slide_id',
  `slider_title` varchar(64) NOT NULL,
  `slider_file` text NOT NULL,
  `slider_status` enum('Active','Inactive') NOT NULL,
  `slider_sequence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `slider_title`, `slider_file`, `slider_status`, `slider_sequence`) VALUES
(3, 'Amazing Sunset', 'SLIDER_20200424195512_Untitled-2.png', 'Active', 2),
(4, 'Amazing Sunset', 'SLIDER_20200424195452_Untitled-1.png', 'Active', 1),
(5, 'Summer Collection', 'SLIDER_20200424195530_Untitled-3.png', 'Active', 3),
(6, 'Summer Collection ', 'SLIDER_20200424195723_Untitled-4.png', 'Active', 3),
(8, 'Slider 5', 'SLIDER_20200425090804_slider(4).png', 'Active', 5);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL COMMENT 'subcategory_id',
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(128) NOT NULL,
  `subcategory_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `subcategory_name`, `subcategory_status`, `created_at`, `updated_at`) VALUES
(9, 19, 'Trend 2020', 'Active', '2020-04-22 17:59:27', NULL),
(10, 19, 'Blazer and Bag', 'Active', '2020-04-22 17:59:38', NULL),
(11, 20, 'Women Trend 2020', 'Active', '2020-04-22 18:00:10', NULL),
(12, 20, 'Black Collection 2020', 'Active', '2020-04-22 18:00:31', NULL),
(13, 20, 'Clothing', 'Active', '2020-04-22 18:01:00', NULL),
(14, 21, 'Summer Collection', 'Active', '2020-04-22 18:01:15', NULL),
(15, 21, 'Girls Collection', 'Active', '2020-04-22 18:01:26', NULL),
(16, 21, 'White Collection', 'Active', '2020-04-22 18:01:38', NULL),
(17, 19, 'Punjabe', 'Active', '2020-04-24 10:48:36', NULL),
(18, 24, 'Smart Watch', 'Active', '2020-04-26 00:00:00', NULL),
(19, 23, 'Dairy Foods', 'Active', '2020-04-26 00:00:00', NULL),
(20, 22, 'Laptop', 'Active', '2020-04-26 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`customer_email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `shopcarts`
--
ALTER TABLE `shopcarts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopcarts_ibfk_1` (`customer_id`),
  ADD KEY `shopcarts_ibfk_2` (`product_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'admin_id', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'categoty_id', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'order_id';

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'order_id';

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'page_id';

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'product_id', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `shopcarts`
--
ALTER TABLE `shopcarts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'slide_id', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'subcategory_id', AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_4` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `shopcarts`
--
ALTER TABLE `shopcarts`
  ADD CONSTRAINT `shopcarts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `shopcarts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
