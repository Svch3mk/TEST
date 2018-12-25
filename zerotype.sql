-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2013 at 01:13 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zerotype`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(100) NOT NULL,
  `comm_email` varchar(100) NOT NULL,
  `comm_content` text NOT NULL,
  `comm_site` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `comm_active` tinyint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `author`, `comm_email`, `comm_content`, `comm_site`, `post_id`, `comm_active`) VALUES
(5, 'Admin', 'ashrafhefny73@yahoo.com', 'this is comment three', '', 1, 1),
(6, 'Admin', 'ashrafhefny73@yahoo.com', 'comment for another post', 'http://www.ashraf.com', 2, 1),
(7, 'Abo Zayed', 'ashraf@ashraf.com', 'this is comment ', '', 1, 1),
(9, 'Islam', 'ashraf@ashraf.com', 'this is comment one', '', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `content`, `date`, `type`) VALUES
(13, 'Admin@zerotype By : Admin@zerotype.com', 'ss@ss.com', 'dewgvwae', 'eeeeeeeeeeeeeeeeh', '2013-07-12 14:55:12', 'send');

-- --------------------------------------------------------

--
-- Table structure for table `sitedesc`
--

CREATE TABLE IF NOT EXISTS `sitedesc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` smallint(2) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sitedesc`
--

INSERT INTO `sitedesc` (`id`, `status`, `title`, `author`, `desc`, `keywords`, `copyright`, `phone`, `email`, `address`) VALUES
(1, 0, 'zerotype ', 'Ashraf Hefny', 'zerotype Site    ', 'zerotype ,zerotype site', 'Â© 2023 Zerotype. All Rights Reserved. By Abo Zayed', 1000099548, 'ashrafhefny72@gmail.com', 'Egypt - Assuit');

-- --------------------------------------------------------

--
-- Table structure for table `siteimage`
--

CREATE TABLE IF NOT EXISTS `siteimage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_type` varchar(50) NOT NULL,
  `img_name` varchar(50) NOT NULL,
  `img_path` varchar(100) NOT NULL,
  `img_width` int(11) NOT NULL,
  `img_height` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `siteimage`
--

INSERT INTO `siteimage` (`id`, `img_type`, `img_name`, `img_path`, `img_width`, `img_height`) VALUES
(1, 'logo', 'logo.png', 'images/logo.png', 49, 76);

-- --------------------------------------------------------

--
-- Table structure for table `sitepost`
--

CREATE TABLE IF NOT EXISTS `sitepost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(150) DEFAULT NULL,
  `post_author` varchar(50) DEFAULT NULL,
  `post_content` text NOT NULL,
  `post_desc` varchar(255) DEFAULT NULL,
  `post_photo` varchar(100) DEFAULT NULL,
  `post_type` varchar(50) NOT NULL,
  `post_date_d` int(11) DEFAULT NULL,
  `post_date_y` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `sitepost`
--

INSERT INTO `sitepost` (`id`, `post_title`, `post_author`, `post_content`, `post_desc`, `post_photo`, `post_type`, `post_date_d`, `post_date_y`) VALUES
(1, 'Updates: More Features Released', 'Ashraf Hefny', 'You can replace all this text with your own text. Want an easier solution for a Free Website? Head straight to Wix and immediately start customizing your website! Wix is an online website builder with a simple drag & drop interface, meaning you do the work online and instantly publish to the web. All Wix templates are fully customizable and free to use. Just pick one you like, click Edit, and enter the online editor.', '', NULL, 'news', 3, 2013),
(5, NULL, NULL, 'Change, add, and remove items as you like. If you''re having problems editing this website template, then don''t hesitate to ask for help on the Forums.', NULL, NULL, 'f_desc', NULL, NULL),
(15, 'I love PHP', NULL, 'I am WEb Developer ,and I love PHP', NULL, 'recycle.png', 'features', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siteurl`
--

CREATE TABLE IF NOT EXISTS `siteurl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_url` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `google` varchar(100) NOT NULL,
  `youtube` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `siteurl`
--

INSERT INTO `siteurl` (`id`, `site_url`, `facebook`, `twitter`, `google`, `youtube`) VALUES
(1, '', 'https://www.facebook.com/ashraf7hefny3', 'https://twitter.com/khaled', 'https://plus.google.com/u/0/103901123266072095270/posts', 'http://www.youtube.com/user/Ashrafphp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`) VALUES
(1, 'admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
