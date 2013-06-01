-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 01, 2013 at 05:42 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lnufileapplication`
--
CREATE DATABASE `lnufileapplication` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lnufileapplication`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounting`
--

CREATE TABLE IF NOT EXISTS `tbl_accounting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_accounting`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_administrator`
--

CREATE TABLE IF NOT EXISTS `tbl_administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=333 ;

--
-- Dumping data for table `tbl_administrator`
--

INSERT INTO `tbl_administrator` (`id`, `username`, `password`) VALUES
(332, 'admin', 'd033e22ae348aeb5660fc2140aec3585');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appforcertification`
--

CREATE TABLE IF NOT EXISTS `tbl_appforcertification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date_applied` date NOT NULL,
  `reason` varchar(255) NOT NULL,
  `status` enum('1','0','2') NOT NULL COMMENT '1 for approved 0 for not yet approved 2 for canceled',
  `date_confirmed` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_appforcertification`
--

INSERT INTO `tbl_appforcertification` (`id`, `user_id`, `date_applied`, `reason`, `status`, `date_confirmed`) VALUES
(1, 1, '2013-05-31', 'Certification', '1', '0000-00-00'),
(2, 1, '2013-05-31', 'Certification', '0', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appforgm`
--

CREATE TABLE IF NOT EXISTS `tbl_appforgm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date_applied` date NOT NULL,
  `status` enum('1','0','2') NOT NULL COMMENT '1 for approved 0 for pending and 2 for canceled',
  `date_confirmed` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_appforgm`
--

INSERT INTO `tbl_appforgm` (`id`, `user_id`, `date_applied`, `status`, `date_confirmed`) VALUES
(1, 1, '2013-05-31', '1', '0000-00-00'),
(2, 1, '2013-05-31', '1', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appfortor`
--

CREATE TABLE IF NOT EXISTS `tbl_appfortor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `date_applied` date NOT NULL,
  `status` enum('1','0','2') NOT NULL COMMENT '1 for approved 0 for pending and 2 for canceled',
  `date_confirmed` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_appfortor`
--

INSERT INTO `tbl_appfortor` (`id`, `user_id`, `reason`, `date_applied`, `status`, `date_confirmed`) VALUES
(1, 1, '1', '2013-05-31', '1', '0000-00-00'),
(2, 1, '2', '2013-05-31', '1', '0000-00-00'),
(3, 1, 'LET', '2013-05-31', '1', '0000-00-00'),
(4, 1, '1', '2013-05-31', '0', '0000-00-00'),
(5, 1, '2', '2013-05-31', '0', '0000-00-00'),
(6, 1, 'LET', '2013-05-31', '0', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appfortorreasons`
--

CREATE TABLE IF NOT EXISTS `tbl_appfortorreasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appforTORid` int(11) NOT NULL,
  `reasons` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_appfortorreasons`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicant`
--

CREATE TABLE IF NOT EXISTS `tbl_applicant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `citizenship` varchar(32) NOT NULL,
  `religion` varchar(32) NOT NULL,
  `civilStatus` varchar(32) NOT NULL,
  `contact` varchar(32) NOT NULL,
  `studentnumber` varchar(32) NOT NULL,
  `dob` date NOT NULL,
  `pob` text NOT NULL,
  `nameoffather` varchar(32) NOT NULL,
  `nameofmother` varchar(32) NOT NULL,
  `nameofspouse` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `nameOfElemSchool` varchar(255) NOT NULL,
  `dateOfElemGraduate` varchar(255) NOT NULL,
  `course` varchar(32) NOT NULL,
  `majorspecialization` varchar(32) NOT NULL,
  `firstattendance` varchar(32) NOT NULL,
  `lastattendance` varchar(32) NOT NULL,
  `numofsemsandsums` int(2) NOT NULL,
  `dogInLNU` varchar(8) NOT NULL,
  `nameOfSecSchool` varchar(255) NOT NULL,
  `dateOfSecGraduate` varchar(255) NOT NULL,
  `nameOfUnderGradSchool` varchar(255) NOT NULL,
  `dateOfUnderGradGraduate` varchar(255) NOT NULL,
  `nameOfGradSchool` varchar(255) NOT NULL,
  `dateOfGradGraduate` varchar(255) NOT NULL,
  `date_registered` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_applicant`
--

INSERT INTO `tbl_applicant` (`id`, `username`, `password`, `fname`, `mname`, `lname`, `citizenship`, `religion`, `civilStatus`, `contact`, `studentnumber`, `dob`, `pob`, `nameoffather`, `nameofmother`, `nameofspouse`, `address`, `nameOfElemSchool`, `dateOfElemGraduate`, `course`, `majorspecialization`, `firstattendance`, `lastattendance`, `numofsemsandsums`, `dogInLNU`, `nameOfSecSchool`, `dateOfSecGraduate`, `nameOfUnderGradSchool`, `dateOfUnderGradGraduate`, `nameOfGradSchool`, `dateOfGradGraduate`, `date_registered`) VALUES
(1, 'rocajohntemoty', '6116afedcb0bc31083935c1c262ff4c9', 'John Temoty ', 'Homeres', 'Roca', 'Filipino', 'Roman Catholic', 'Single', '09286638253', '0901293', '1990-02-13', 'Bulacan, Manila', 'Daniel Langahid Roca', 'Susan Homeres Roca', '', '                 Brgy.104 Salvacion Tacloban City                ', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '2013-05-30 03:42:03'),
(2, 'rocajohntemoty', '700c8b805a3e2a265b01c77614cd8b21', '1234', '123', '123', 'Filipino', 'Roman Catholic', 'Single', '09286638253', '', '1992-12-09', 'Bulacan Manila', 'Daniel Langahid Roca', 'Susan Homeres Roca', 'Angel Locsin', '                                   John Temoty Roca                                                                                                 ', 'City Central School', '2005', '', '', '', '', 0, '', 'Leyte National High School', '2005', 'Leyte Normal University', '2013', 'Eastern Visayas State University', '2016', '2013-05-30 13:43:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gradlibadmin`
--

CREATE TABLE IF NOT EXISTS `tbl_gradlibadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_gradlibadmin`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_gsadmin`
--

CREATE TABLE IF NOT EXISTS `tbl_gsadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_gsadmin`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_osa`
--

CREATE TABLE IF NOT EXISTS `tbl_osa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_osa`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_registrar`
--

CREATE TABLE IF NOT EXISTS `tbl_registrar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_registrar`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_undergradlibadmin`
--

CREATE TABLE IF NOT EXISTS `tbl_undergradlibadmin` (
  `id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_undergradlibadmin`
--

--
-- Database: `lnuh-tps-mis`
--
CREATE DATABASE `lnuh-tps-mis` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lnuh-tps-mis`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_administrator`
--

CREATE TABLE IF NOT EXISTS `tbl_administrator` (
  `admin_id` smallint(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_administrator`
--

INSERT INTO `tbl_administrator` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997 ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_backendusers`
--

CREATE TABLE IF NOT EXISTS `tbl_backendusers` (
  `bu_id` int(11) NOT NULL AUTO_INCREMENT,
  `bu_username` varchar(255) NOT NULL,
  `bu_password` varchar(255) NOT NULL,
  `bu_name` varchar(255) NOT NULL,
  `bu_contact` varchar(255) NOT NULL,
  PRIMARY KEY (`bu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_backendusers`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE IF NOT EXISTS `tbl_department` (
  `dep_id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(255) NOT NULL,
  `dep_contactDetails` varchar(255) NOT NULL,
  PRIMARY KEY (`dep_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`dep_id`, `dep_name`, `dep_contactDetails`) VALUES
(1, 'ABCom Unit', '321-3238'),
(2, 'Accounting Unit', '321-2744'),
(3, 'BAC Office', '321-8176'),
(7, 'ILS Unit', '321-2927');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logindetails`
--

CREATE TABLE IF NOT EXISTS `tbl_logindetails` (
  `ld_id` int(11) NOT NULL AUTO_INCREMENT,
  `ld_user_id` smallint(6) NOT NULL,
  `ld_user_type` smallint(6) NOT NULL,
  `ld_datetime` datetime NOT NULL,
  `ld_IPAddress` varchar(32) NOT NULL,
  PRIMARY KEY (`ld_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_logindetails`
--

INSERT INTO `tbl_logindetails` (`ld_id`, `ld_user_id`, `ld_user_type`, `ld_datetime`, `ld_IPAddress`) VALUES
(1, 1, 1, '2013-05-24 05:01:28', '::1'),
(2, 1, 1, '2013-05-24 05:21:08', '::1'),
(3, 1, 1, '2013-05-24 11:21:59', '::1'),
(4, 1, 1, '2013-05-24 12:19:22', '::1'),
(5, 1, 1, '2013-05-24 12:20:03', '::1'),
(6, 2, 1, '2013-05-28 10:34:46', '::1'),
(7, 2, 1, '2013-05-29 02:56:59', '::1'),
(8, 2, 1, '2013-05-29 14:25:19', '::1'),
(9, 2, 1, '2013-05-29 14:27:27', '::1'),
(10, 2, 1, '2013-05-29 14:33:12', '::1'),
(11, 2, 1, '2013-05-29 14:44:41', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mealcategory`
--

CREATE TABLE IF NOT EXISTS `tbl_mealcategory` (
  `mc_id` int(11) NOT NULL AUTO_INCREMENT,
  `mc_name` varchar(255) NOT NULL,
  PRIMARY KEY (`mc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_mealcategory`
--

INSERT INTO `tbl_mealcategory` (`mc_id`, `mc_name`) VALUES
(4, 'beverages'),
(7, 'Viands');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_meals`
--

CREATE TABLE IF NOT EXISTS `tbl_meals` (
  `meal_id` int(11) NOT NULL AUTO_INCREMENT,
  `meal_name` varchar(255) NOT NULL,
  `meal_price` varchar(50) NOT NULL,
  `meal_category` smallint(6) NOT NULL,
  `meal_status` enum('0','1') NOT NULL,
  PRIMARY KEY (`meal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_meals`
--

INSERT INTO `tbl_meals` (`meal_id`, `meal_name`, `meal_price`, `meal_category`, `meal_status`) VALUES
(1, 'Cola', '15', 4, '1'),
(2, 'San Miguel Beer', '36', 4, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderingusers`
--

CREATE TABLE IF NOT EXISTS `tbl_orderingusers` (
  `ou_id` int(11) NOT NULL AUTO_INCREMENT,
  `ou_username` varchar(255) NOT NULL,
  `ou_department` varchar(255) NOT NULL,
  `ou_password` varchar(255) NOT NULL,
  `ou_name` varchar(255) NOT NULL,
  `ou_dateRegistered` datetime NOT NULL,
  `ou_IPAddress` varchar(255) NOT NULL,
  `ou_status` enum('1','0') NOT NULL,
  `ou_contact` varchar(255) NOT NULL,
  PRIMARY KEY (`ou_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_orderingusers`
--

INSERT INTO `tbl_orderingusers` (`ou_id`, `ou_username`, `ou_department`, `ou_password`, `ou_name`, `ou_dateRegistered`, `ou_IPAddress`, `ou_status`, `ou_contact`) VALUES
(2, 'rocajohntemoty', '2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'rocajohntemoty', '2013-05-28 10:33:49', '::1', '1', '09286638253');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE IF NOT EXISTS `tbl_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_meal_name` varchar(255) NOT NULL,
  `order_price` varchar(32) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_quantity` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `meal_user_id` int(11) NOT NULL,
  `order_status` smallint(6) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `order_meal_name`, `order_price`, `order_date`, `order_quantity`, `location`, `meal_user_id`, `order_status`) VALUES
(1, 'chicken combo meal', '28', '2013-05-24 05:28:24', 2, '', 1, 1),
(5, 'Cola', '15', '2013-05-29 15:35:53', 1, '1', 2, 0),
(4, 'Cola', '15', '2013-05-29 14:27:37', 3, 'BAC Office', 2, 0),
(6, 'San Miguel Beer', '36', '2013-05-29 15:36:12', 1, '1', 2, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
