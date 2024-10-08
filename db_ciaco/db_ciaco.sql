-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 13, 2024 at 10:47 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ciaco`
--

-- --------------------------------------------------------

--
-- Table structure for table `distribution`
--

DROP TABLE IF EXISTS `distribution`;
CREATE TABLE IF NOT EXISTS `distribution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `type` int(5) NOT NULL,
  `descriptions` varchar(3000) NOT NULL,
  `date_added` date NOT NULL,
  `date_update` date DEFAULT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distribution`
--

INSERT INTO `distribution` (`id`, `user_id`, `image`, `type`, `descriptions`, `date_added`, `date_update`, `status`) VALUES
(1, 1, '../upload/preparing.jpeg', 2, 'test', '2024-02-14', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `dist_id` int(10) NOT NULL,
  `user_to` int(10) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `user_id`, `dist_id`, `user_to`, `status`) VALUES
(1, 1, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan_details`
--

DROP TABLE IF EXISTS `loan_details`;
CREATE TABLE IF NOT EXISTS `loan_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `occupation` varchar(200) NOT NULL,
  `date_of_birth` date NOT NULL,
  `civil_status` varchar(100) NOT NULL,
  `dependents` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `spouse` varchar(100) NOT NULL,
  `spouse_occu` varchar(100) NOT NULL,
  `gross` varchar(100) NOT NULL,
  `expenses` varchar(100) NOT NULL,
  `net` varchar(100) NOT NULL,
  `date_applied` date NOT NULL,
  `date_needed` date NOT NULL,
  `amount_applied` varchar(100) NOT NULL,
  `purpose` varchar(500) NOT NULL,
  `type` varchar(100) NOT NULL,
  `mode` varchar(100) NOT NULL,
  `others` varchar(100) NOT NULL,
  `kind` varchar(100) NOT NULL,
  `tct` varchar(100) NOT NULL,
  `area` varchar(100) DEFAULT NULL,
  `co_maker1` varchar(200) NOT NULL,
  `stock1` varchar(100) NOT NULL,
  `co_maker2` varchar(200) NOT NULL,
  `stock2` varchar(100) NOT NULL,
  `date_submit` date NOT NULL,
  `submit_by` int(5) NOT NULL,
  `date_update` date DEFAULT NULL,
  `update_by` int(5) DEFAULT NULL,
  `approve_date` date DEFAULT NULL,
  `approve_by` int(5) DEFAULT NULL,
  `reason` varchar(2000) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members_data`
--

DROP TABLE IF EXISTS `members_data`;
CREATE TABLE IF NOT EXISTS `members_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `civil_status` varchar(100) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `height` varchar(50) DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `phone_num` varchar(50) DEFAULT NULL,
  `residence` varchar(1000) DEFAULT NULL,
  `place_of_birth` varchar(1000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `age` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `father_birth` date DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mother_birth` date DEFAULT NULL,
  `educ_attain` varchar(1000) DEFAULT NULL,
  `school` varchar(1000) DEFAULT NULL,
  `date_grad` date DEFAULT NULL,
  `properties` varchar(500) DEFAULT NULL,
  `emp_business` varchar(255) DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `tin_front` varchar(255) DEFAULT NULL,
  `tin_back` varchar(255) DEFAULT NULL,
  `ctc` varchar(100) DEFAULT NULL,
  `arb` varchar(50) DEFAULT NULL,
  `num_of_dep` int(20) DEFAULT NULL,
  `elementary` varchar(20) DEFAULT NULL,
  `hs` varchar(20) DEFAULT NULL,
  `college` varchar(20) DEFAULT NULL,
  `benifi_primary` varchar(255) DEFAULT NULL,
  `benifi_primary_birth` date DEFAULT NULL,
  `benifi_secondary` varchar(255) DEFAULT NULL,
  `benifi_secondary_birth` date DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `relig_aff` varchar(255) DEFAULT NULL,
  `crime` varchar(50) DEFAULT NULL,
  `spouse_placeof_birth` varchar(500) DEFAULT NULL,
  `spouse_birth` date DEFAULT NULL,
  `spouse_age` varchar(20) DEFAULT NULL,
  `spouse_father_name` varchar(255) DEFAULT NULL,
  `spouse_mother_name` varchar(255) DEFAULT NULL,
  `p1_name_add` varchar(255) DEFAULT NULL,
  `p2_name_add` varchar(255) DEFAULT NULL,
  `date_apply` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved_by` int(5) DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members_data`
--

INSERT INTO `members_data` (`id`, `user_id`, `civil_status`, `sex`, `height`, `weight`, `phone_num`, `residence`, `place_of_birth`, `date_of_birth`, `age`, `father_name`, `father_birth`, `mother_name`, `mother_birth`, `educ_attain`, `school`, `date_grad`, `properties`, `emp_business`, `tin`, `tin_front`, `tin_back`, `ctc`, `arb`, `num_of_dep`, `elementary`, `hs`, `college`, `benifi_primary`, `benifi_primary_birth`, `benifi_secondary`, `benifi_secondary_birth`, `spouse_name`, `relig_aff`, `crime`, `spouse_placeof_birth`, `spouse_birth`, `spouse_age`, `spouse_father_name`, `spouse_mother_name`, `p1_name_add`, `p2_name_add`, `date_apply`, `approved_by`, `approved_date`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-08 12:46:16', NULL, NULL),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-08 13:34:22', NULL, NULL),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-12 13:50:11', NULL, NULL),
(4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-12 14:34:11', NULL, NULL),
(5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-12 14:35:46', NULL, NULL),
(6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-12 14:36:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(20) NOT NULL,
  `sender_id` int(10) NOT NULL,
  `reciever_id` int(10) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `msg_detail`
--

DROP TABLE IF EXISTS `msg_detail`;
CREATE TABLE IF NOT EXISTS `msg_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(20) NOT NULL,
  `reciever` int(20) NOT NULL,
  `last_message` varchar(2000) NOT NULL,
  `last_sent` datetime DEFAULT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `stat_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `type`, `status`, `stat_name`) VALUES
(1, 'Loan Application', 1, 'For Approval'),
(2, 'Loan Application', 2, 'Decline Loan'),
(3, 'Loan Application', 3, 'Approved Loan'),
(4, 'User Management', 1, 'Pending in Application'),
(5, 'User Management', 2, 'Pending for membership'),
(6, 'User Management', 3, 'Approved Access'),
(7, 'Messages', 1, 'unseen'),
(8, 'Messages', 2, 'seen');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contact_no` varchar(20) NOT NULL,
  `image` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `mycode` int(6) DEFAULT NULL,
  `reason` varchar(2000) DEFAULT NULL,
  `role` int(5) NOT NULL,
  `status` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middle_name`, `lastname`, `username`, `password`, `added_at`, `contact_no`, `image`, `mycode`, `reason`, `role`, `status`) VALUES
(1, 'Elmar', '', 'Malazarte', 'elmar.malazarte', '$2y$10$4awr2vcpVbICzANv5MrRPeKLINO7Dh/CBXRkDCrKS.NjnUm2ACpDu', '2024-02-08 12:46:16', '09272259203', '../upload/viber_image_2023-12-06_10-51-55-271.jpg', 7779, NULL, 1, 1),
(2, 'Xena Fitzpatrick', 'Ingrid Macias', 'Hiram Hill', 'elmar', '6c111cb1d9e320aa348970073e509b33f922a1f14efb5da34aba71aefbde81f6', '2024-02-08 13:34:22', '09518768325', NULL, 898, '', 2, 3),
(3, 'Kitra Hester', 'Olivia Justice', 'Xyla Stevenson', 'ciaco123', '$2y$10$4awr2vcpVbICzANv5MrRPeKLINO7Dh/CBXRkDCrKS.NjnUm2ACpDu', '2024-02-12 13:50:11', '09272258421', NULL, 0, NULL, 2, 3),
(4, 'Hayley', 'Zorita Montgomery', 'Craft', 'noxyfigicu', '$2y$10$Qzc85S4kqFD/18aXFVYS7uXd6JXD1mf9irQlE6T8V7f5gDv7eOyge', '2024-02-12 14:34:11', '214', NULL, NULL, NULL, 2, NULL),
(5, 'Georgia', 'Sonia Warner', 'Smith', 'bagofucyp', '$2y$10$z.XM8MauPpYSGbBaV/7LoeRn3xMdz3G685rYDVShbHYnd9h9fkVSu', '2024-02-12 14:35:46', '752', NULL, 0, NULL, 1, NULL),
(6, 'Virginia Mcmahon', 'Melinda Spears', 'Libby Deleon', 'fiwys', '$2y$10$4gnPBU1hV9ij3xKaZol52e9xwSZZCbuQTH1GTx2gvNbprKy2opkYu', '2024-02-12 14:36:17', '09254875455', NULL, 0, NULL, 2, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
