-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2018 at 08:22 AM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metastag_codeigniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `phone_num` varchar(255) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `normal_password` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `created_on` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `first_name`, `last_name`, `admin_email`, `phone_num`, `password`, `normal_password`, `role`, `created_on`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '1234567890', 'd312c4839cfb7d2ac4ff96a368b28c4a', NULL, 'superadmin', '2018-06-06 05:03:30'),
(2, 'Anirudh', 'Deora', 'anirudh@metataggsolutions.com', '1234567890', 'b35658bc99510facfc104a5852ca817c', 'anirudh123#', 'basic', '2018-06-06 05:03:30');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `blog_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blog_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blog_content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `blog_category_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `blog_title`, `blog_image`, `blog_content`, `blog_category_id`, `author_id`, `publish_date`) VALUES
(1, 'Blog 1', '7707Tulips.jpg', 'Test content', NULL, '1', '2018-06-12'),
(2, 'Blog 2', '3318Hydrangeas.jpg', 'Blog 2 Content', NULL, '2', '2018-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_logo` varchar(255) DEFAULT NULL,
  `product_gallery` longtext,
  `product_description` longtext,
  `trash_product` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_logo`, `product_gallery`, `product_description`, `trash_product`) VALUES
(1, 'Product 18990', '4032Logo-transparent.png', '3357Chrysanthemum.jpg,431Jellyfish.jpg,8594Koala.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, opkm;lm;,/l', '1'),
(2, 'Product 2', '7079Desert4.jpg', NULL, 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting', '1'),
(3, 'Product 3', '2592Hydrangeas.jpg', NULL, 'Remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages', '1'),
(5, 'Product 5', '9596Koala.jpg', NULL, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC', '1'),
(7, 'Product 6', '2412Lighthouse.jpg', NULL, 'Making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words,', '1'),
(8, 'Product 7', '4048Penguins.jpg', NULL, 'Consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature.', '1'),
(9, 'Product 8', '6405Tulips.jpg', NULL, 'Discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum.', '1'),
(10, 'Product 9', '4316Hydrangeas.jpg', NULL, 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from', '1'),
(11, 'Product 10', '8501Koala.jpg', NULL, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour', '1'),
(12, 'Product 11', '5925Penguins.jpg', NULL, 'Or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum', '1'),
(16, 'New test', '6885Chrysanthemum.jpg', NULL, 'Hello test', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
