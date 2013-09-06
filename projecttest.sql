-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 16, 2013 at 01:01 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projecttest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '9a4e1382250c4b976a01799e309528ec43a3d1a8');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `email`) VALUES
(1, 'g@g.com');

-- --------------------------------------------------------

--
-- Table structure for table `locationinfo`
--

CREATE TABLE IF NOT EXISTS `locationinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gpslat` varchar(20) NOT NULL,
  `gpslon` varchar(20) NOT NULL,
  `gpsfull` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `locationinfo`
--

INSERT INTO `locationinfo` (`id`, `gpslat`, `gpslon`, `gpsfull`) VALUES
(1, '53.424196', '-7.935219', '53.424196, -7.935219');

-- --------------------------------------------------------

--
-- Table structure for table `sitefooter`
--

CREATE TABLE IF NOT EXISTS `sitefooter` (
  `footer` varchar(75) NOT NULL,
  PRIMARY KEY (`footer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sitefooter`
--

INSERT INTO `sitefooter` (`footer`) VALUES
('Copyright © 2013');

-- --------------------------------------------------------

--
-- Table structure for table `siteheader`
--

CREATE TABLE IF NOT EXISTS `siteheader` (
  `id` int(10) NOT NULL,
  `header` varchar(250) NOT NULL,
  `useText` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siteheader`
--

INSERT INTO `siteheader` (`id`, `header`, `useText`) VALUES
(1, '&lt;h1&gt;\r\n	Craig McCarthy Website&lt;img alt=&quot;&quot; height=&quot;143&quot; src=&quot;/PT/Frontend/uploads/images/test.PNG&quot; style=&quot;margin: 5px; float: right;&quot; width=&quot;357&quot; /&gt;&lt;/h1&gt;\r\n&lt;p&gt;\r\n	ITB!&lt;/p&gt;\r\n', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `sitelayout`
--

CREATE TABLE IF NOT EXISTS `sitelayout` (
  `styleid` int(3) NOT NULL AUTO_INCREMENT,
  `cssfilename` varchar(50) NOT NULL,
  `layout` varchar(50) DEFAULT NULL,
  `colour` varchar(50) DEFAULT NULL,
  `backgroundcolour` varchar(10) DEFAULT NULL,
  `navcolour` varchar(10) DEFAULT NULL,
  `contentcolour` varchar(10) DEFAULT NULL,
  `footercolour` varchar(10) DEFAULT NULL,
  `usingcustom` varchar(3) DEFAULT NULL,
  `navonhover` varchar(10) DEFAULT NULL,
  `navtext` varchar(10) DEFAULT NULL,
  `capitalnav` varchar(3) DEFAULT NULL,
  `corner` varchar(10) DEFAULT NULL,
  `laywidth` varchar(4) DEFAULT NULL,
  `useBgImg` varchar(5) DEFAULT NULL,
  `galleryheight` int(4) DEFAULT NULL,
  `gallerywidth` int(4) DEFAULT NULL,
  PRIMARY KEY (`styleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sitelayout`
--

INSERT INTO `sitelayout` (`styleid`, `cssfilename`, `layout`, `colour`, `backgroundcolour`, `navcolour`, `contentcolour`, `footercolour`, `usingcustom`, `navonhover`, `navtext`, `capitalnav`, `corner`, `laywidth`, `useBgImg`, `galleryheight`, `gallerywidth`) VALUES
(1, 'LO1/blue.css', 'LO1', 'blue', '5fbf00', 'ffaa56', 'ffd4aa', 'ffaa56', 'No', 'ff5656', 'ffffff', 'No', 'Yes', '80%', 'No', 480, 640);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `privlevel` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `privlevel`) VALUES
(16, 'gavpub', 'af5970eb4822f4295656e07d5a62deb395d36c52', 'publisher'),
(17, 'gaved', 'dd01d325497e1846b6f3a9e7a76f299a6661182e', 'editor');

-- --------------------------------------------------------

--
-- Table structure for table `webpage`
--

CREATE TABLE IF NOT EXISTS `webpage` (
  `pageid` int(3) NOT NULL AUTO_INCREMENT,
  `pagetitle` varchar(25) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `content` varchar(5000) DEFAULT NULL,
  `unpubcontent` varchar(5000) DEFAULT NULL,
  `lastmodified` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pageid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

--
-- Dumping data for table `webpage`
--

INSERT INTO `webpage` (`pageid`, `pagetitle`, `filename`, `content`, `unpubcontent`, `lastmodified`) VALUES
(85, 'Home', 'index.php', '&lt;p&gt;\r\n	Unpublished content!!!rawr!!&lt;/p&gt;\r\n', 'Content below that was updated at 04:16pm 25/02/2013  by user: gaved has been rejected by gavpub for the following reason:<br><br><b> Not good enough!!</b><br><br><strong>Rejected Content</strong>:<br>&lt;p&gt;\r\n	Unpublished content!!!rawr!!&lt;/p&gt;\r\n', '04:16pm 25/02/2013  by user: gaved');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
