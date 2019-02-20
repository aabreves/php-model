
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2018 at 11:56 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
-- Database: `u729172951_brv`
--
CREATE DATABASE IF NOT EXISTS `u729172951_brv` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `u729172951_brv`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `cat_i4_uid` int(11) NOT NULL AUTO_INCREMENT,
  `cat_fk_usr_i4_uid` int(11) NOT NULL,
  `cat_s32_name` varchar(32) NOT NULL,
  `cat_s256_description` varchar(256) NOT NULL,
  `cat_s32_icon` varchar(32) NOT NULL DEFAULT 'sidebar icon',
  `cat_s32_color` varchar(32) NOT NULL DEFAULT 'red',
  `cat_i1_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cat_i4_uid`),
  KEY `cat_fk_usr_i4_uid` (`cat_fk_usr_i4_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`cat_i4_uid`, `cat_fk_usr_i4_uid`, `cat_s32_name`, `cat_s256_description`, `cat_s32_icon`, `cat_s32_color`, `cat_i1_active`) VALUES
(1, 0, 'Home', 'c1 - Basic category valid to all users', 'sidebar icon', 'red', 1),
(2, 0, 'Category 2', 'c2 - Reserved category', 'sidebar icon', 'red', 1),
(3, 0, 'Category 3', 'c3 - Reserved category', 'sidebar icon', 'red', 0),
(4, 0, 'Category 4', 'c4 - Reserved category', 'sidebar icon', 'red', 0),
(5, 0, 'Category 5', 'c5 - Reserved category', 'sidebar icon', 'red', 0),
(6, 0, 'Category 6', 'c6 - Reserved category', 'sidebar icon', 'red', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_companies`
--

CREATE TABLE IF NOT EXISTS `tbl_companies` (
  `cia_i4_uid` int(11) NOT NULL AUTO_INCREMENT,
  `cia_s256_name` varchar(256) NOT NULL,
  `cia_s256_social_name` varchar(256) NOT NULL,
  `cia_s32_caption` varchar(32) NOT NULL,
  `cia_s256_start_page` varchar(256) NOT NULL,
  PRIMARY KEY (`cia_i4_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_companies`
--

INSERT INTO `tbl_companies` (`cia_i4_uid`, `cia_s256_name`, `cia_s256_social_name`, `cia_s32_caption`, `cia_s256_start_page`) VALUES
(1, 'Breves', 'Breves', 'Breves', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects`
--

CREATE TABLE IF NOT EXISTS `tbl_subjects` (
  `sbj_i4_uid` int(11) NOT NULL AUTO_INCREMENT,
  `sbj_fk_thm_i4_uid` int(11) NOT NULL,
  `sbj_fk_usr_i4_uid` int(11) NOT NULL,
  `sbj_s32_name` varchar(32) NOT NULL,
  `sbj_s256_description` varchar(256) NOT NULL,
  `sbj_i1_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sbj_i4_uid`),
  KEY `sbj_fk_thm_i4_uid` (`sbj_fk_thm_i4_uid`,`sbj_fk_usr_i4_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `tbl_subjects`
--

INSERT INTO `tbl_subjects` (`sbj_i4_uid`, `sbj_fk_thm_i4_uid`, `sbj_fk_usr_i4_uid`, `sbj_s32_name`, `sbj_s256_description`, `sbj_i1_active`) VALUES
(1, 1, 0, 'Subject Tools.1', ' 1 - c1.t1.s1 - Reserved subject for c1.t1', 1),
(2, 1, 0, 'Subject Tools.2', ' 2 - c1.t1.s2 - Reserved subject for c1.t1', 1),
(3, 1, 0, 'Subject Tools.3', ' 3 - c1.t1.s3 - Reserved subject for c1.t1', 1),
(4, 2, 0, 'Subject History.1', ' 4 - c1.t2.s1 - Reserved subject for c1.t2', 1),
(5, 2, 0, 'Subject History.2', ' 5 - c1.t2.s2 - Reserved subject for c1.t2', 1),
(6, 2, 0, 'Subject History.3', ' 6 - c1.t2.s3 - Reserved subject for c1.t2', 1),
(7, 3, 0, 'Subject Friends.1', ' 7 - c1.t3.s1 - Reserved subject for c1.t3', 1),
(8, 3, 0, 'Subject Friends.2', ' 8 - c1.t3.s2 - Reserved subject for c1.t3', 1),
(9, 3, 0, 'Subject Friends.3', ' 9 - c1.t3.s3 - Reserved subject for c1.t3', 1),
(10, 4, 0, 'Subject Config.1', '10 - c1.t4.s1 - Reserved subject for c1.t4', 1),
(11, 4, 0, 'Subject Config.2', '11 - c1.t4.s2 - Reserved subject for c1.t4', 1),
(12, 4, 0, 'Subject Config.3', '12 - c1.t4.s3 - Reserved subject for c1.t4', 1),
(13, 5, 0, 'Subject Theme5.1', '13 - c1.t5.s1 - Reserved subject for c1.t5', 1),
(14, 5, 0, 'Subject Theme5.2', '14 - c1.t5.s2 - Reserved subject for c1.t5', 1),
(15, 5, 0, 'Subject Theme5.3', '15 - c1.t5.s3 - Reserved subject for c1.t5', 1),
(16, 6, 0, 'Subject Theme6.1', '16 - c1.t6.s1 - Reserved subject for c1.t6', 1),
(17, 6, 0, 'Subject Theme6.2', '17 - c1.t6.s2 - Reserved subject for c1.t6', 1),
(18, 6, 0, 'Subject Theme6.3', '18 - c1.t6.s3 - Reserved subject for c1.t6', 1),
(19, 7, 0, 'Subject Theme7.1', '19 - c2.t1.s1 - Reserved subject for c2.t1', 1),
(20, 7, 0, 'Subject Theme7.2', '20 - c2.t1.s2 - Reserved subject for c2.t1', 1),
(21, 7, 0, 'Subject Theme7.3', '21 - c2.t1.s3 - Reserved subject for c2.t1', 1),
(22, 8, 0, 'Subject Theme8.1', '22 - c2.t2.s1 - Reserved subject for c2.t2', 1),
(23, 8, 0, 'Subject Theme8.2', '23 - c2.t2.s2 - Reserved subject for c2.t2', 1),
(24, 8, 0, 'Subject Theme8.3', '24 - c2.t2.s3 - Reserved subject for c2.t2', 1),
(25, 9, 0, 'Subject Theme9.1', '25 - c2.t3.s1 - Reserved subject for c2.t3', 1),
(26, 9, 0, 'Subject Theme9.2', '26 - c2.t3.s2 - Reserved subject for c2.t3', 1),
(27, 9, 0, 'Subject Theme9.3', '27 - c2.t3.s3 - Reserved subject for c2.t3', 1),
(28, 10, 0, 'Subject Theme10.1', '28 - c2.t4.s1 - Reserved subject for c2.t4', 1),
(29, 10, 0, 'Subject Theme10.2', '29 - c2.t4.s2 - Reserved subject for c2.t4', 1),
(30, 10, 0, 'Subject Theme10.3', '30 - c2.t4.s3 - Reserved subject for c2.t4', 1),
(31, 11, 0, 'Subject Theme11.1', '31 - c2.t5.s1 - Reserved subject for c2.t5', 1),
(32, 11, 0, 'Subject Theme11.2', '32 - c2.t5.s2 - Reserved subject for c2.t5', 1),
(33, 11, 0, 'Subject Theme11.3', '33 - c2.t5.s3 - Reserved subject for c2.t5', 1),
(34, 12, 0, 'Subject Theme12.1', '34 - c3.t1.s1 - Reserved subject for c3.t1', 1),
(35, 12, 0, 'Subject Theme12.2', '35 - c3.t1.s2 - Reserved subject for c3.t1', 1),
(36, 12, 0, 'Subject Theme12.3', '36 - c3.t1.s3 - Reserved subject for c3.t1', 1),
(37, 13, 0, 'Subject Theme13.1', '37 - c3.t2.s1 - Reserved subject for c3.t2', 1),
(38, 13, 0, 'Subject Theme13.2', '38 - c3.t2.s2 - Reserved subject for c3.t2', 1),
(39, 13, 0, 'Subject Theme13.3', '39 - c3.t2.s3 - Reserved subject for c3.t2', 1),
(40, 14, 0, 'Subject Theme14.1', '40 - c3.t3.s1 - Reserved subject for c3.t3', 1),
(41, 14, 0, 'Subject Theme14.2', '41 - c3.t3.s2 - Reserved subject for c3.t3', 1),
(42, 14, 0, 'Subject Theme14.3', '42 - c3.t3.s3 - Reserved subject for c3.t3', 1),
(43, 15, 0, 'Subject Theme15.1', '43 - c3.t4.s1 - Reserved subject for c3.t4', 1),
(44, 15, 0, 'Subject Theme15.2', '44 - c3.t4.s2 - Reserved subject for c3.t4', 1),
(45, 15, 0, 'Subject Theme15.3', '45 - c3.t4.s3 - Reserved subject for c3.t4', 1),
(46, 16, 0, 'Subject Theme16.1', '46 - c3.t5.s1 - Reserved subject for c3.t5', 1),
(47, 16, 0, 'Subject Theme16.2', '47 - c3.t5.s2 - Reserved subject for c3.t5', 1),
(48, 16, 0, 'Subject Theme16.3', '48 - c3.t5.s3 - Reserved subject for c3.t5', 1),
(49, 17, 0, 'Subject Theme17.1', '49 - c4.t1.s1 - Reserved subject for c4.t1', 1),
(50, 17, 0, 'Subject Theme17.2', '50 - c4.t1.s2 - Reserved subject for c4.t1', 1),
(51, 17, 0, 'Subject Theme17.3', '51 - c4.t1.s3 - Reserved subject for c4.t1', 1),
(52, 18, 0, 'Subject Theme18.1', '52 - c4.t2.s1 - Reserved subject for c4.t2', 1),
(53, 18, 0, 'Subject Theme18.2', '53 - c4.t2.s2 - Reserved subject for c4.t2', 1),
(54, 18, 0, 'Subject Theme18.3', '54 - c4.t2.s3 - Reserved subject for c4.t2', 1),
(55, 19, 0, 'Subject Theme19.1', '55 - c4.t3.s1 - Reserved subject for c4.t3', 1),
(56, 19, 0, 'Subject Theme19.2', '56 - c4.t3.s2 - Reserved subject for c4.t3', 1),
(57, 19, 0, 'Subject Theme19.3', '57 - c4.t3.s3 - Reserved subject for c4.t3', 1),
(58, 20, 0, 'Subject Theme20.1', '58 - c4.t4.s1 - Reserved subject for c4.t4', 1),
(59, 20, 0, 'Subject Theme20.2', '59 - c4.t4.s2 - Reserved subject for c4.t4', 1),
(60, 20, 0, 'Subject Theme20.3', '60 - c4.t4.s3 - Reserved subject for c4.t4', 1),
(61, 21, 0, 'Subject Theme21.1', '61 - c4.t5.s1 - Reserved subject for c4.t5', 1),
(62, 21, 0, 'Subject Theme21.2', '62 - c4.t5.s2 - Reserved subject for c4.t5', 1),
(63, 21, 0, 'Subject Theme21.3', '63 - c4.t5.s3 - Reserved subject for c4.t5', 1),
(64, 22, 0, 'Subject Theme22.1', '64 - c5.t1.s1 - Reserved subject for c5.t1', 1),
(65, 22, 0, 'Subject Theme22.2', '65 - c5.t1.s2 - Reserved subject for c5.t1', 1),
(66, 22, 0, 'Subject Theme22.3', '66 - c5.t1.s3 - Reserved subject for c5.t1', 1),
(67, 23, 0, 'Subject Theme23.1', '67 - c5.t2.s1 - Reserved subject for c5.t2', 1),
(68, 23, 0, 'Subject Theme23.2', '68 - c5.t2.s2 - Reserved subject for c5.t2', 1),
(69, 23, 0, 'Subject Theme23.3', '69 - c5.t2.s3 - Reserved subject for c5.t2', 1),
(70, 24, 0, 'Subject Theme24.1', '70 - c5.t3.s1 - Reserved subject for c5.t3', 1),
(71, 24, 0, 'Subject Theme24.2', '71 - c5.t3.s2 - Reserved subject for c5.t3', 1),
(72, 24, 0, 'Subject Theme24.3', '72 - c5.t3.s3 - Reserved subject for c5.t3', 1),
(73, 25, 0, 'Subject Theme25.1', '73 - c5.t4.s1 - Reserved subject for c5.t4', 1),
(74, 25, 0, 'Subject Theme25.2', '74 - c5.t4.s2 - Reserved subject for c5.t4', 1),
(75, 25, 0, 'Subject Theme25.3', '75 - c5.t4.s3 - Reserved subject for c5.t4', 1),
(76, 26, 0, 'Subject Theme26.1', '76 - c5.t5.s1 - Reserved subject for c5.t5', 1),
(77, 26, 0, 'Subject Theme26.2', '77 - c5.t5.s2 - Reserved subject for c5.t5', 1),
(78, 26, 0, 'Subject Theme26.3', '78 - c5.t5.s3 - Reserved subject for c5.t5', 1),
(79, 27, 0, 'Subject Theme27.1', '79 - c6.t1.s1 - Reserved subject for c6.t1', 1),
(80, 27, 0, 'Subject Theme27.2', '80 - c6.t1.s2 - Reserved subject for c6.t1', 1),
(81, 27, 0, 'Subject Theme27.3', '81 - c6.t1.s3 - Reserved subject for c6.t1', 1),
(82, 28, 0, 'Subject Theme28.1', '82 - c6.t2.s1 - Reserved subject for c6.t2', 1),
(83, 28, 0, 'Subject Theme28.2', '83 - c6.t2.s2 - Reserved subject for c6.t2', 1),
(84, 28, 0, 'Subject Theme28.3', '84 - c6.t2.s3 - Reserved subject for c6.t2', 1),
(85, 29, 0, 'Subject Theme29.1', '85 - c6.t3.s1 - Reserved subject for c6.t3', 1),
(86, 29, 0, 'Subject Theme29.2', '86 - c6.t3.s2 - Reserved subject for c6.t3', 1),
(87, 29, 0, 'Subject Theme29.3', '87 - c6.t3.s3 - Reserved subject for c6.t3', 1),
(88, 30, 0, 'Subject Theme30.1', '88 - c6.t4.s1 - Reserved subject for c6.t4', 1),
(89, 30, 0, 'Subject Theme30.2', '89 - c6.t4.s2 - Reserved subject for c6.t4', 1),
(90, 30, 0, 'Subject Theme30.3', '90 - c6.t4.s3 - Reserved subject for c6.t4', 1),
(91, 31, 0, 'Subject Theme31.1', '91 - c6.t5.s1 - Reserved subject for c6.t5', 1),
(92, 31, 0, 'Subject Theme31.2', '92 - c6.t5.s2 - Reserved subject for c6.t5', 1),
(93, 31, 0, 'Subject Theme31.3', '93 - c6.t5.s3 - Reserved subject for c6.t5', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sys_nodes`
--

CREATE TABLE IF NOT EXISTS `tbl_sys_nodes` (
  `nod_i4_uid` int(11) NOT NULL AUTO_INCREMENT,
  `nod_fk_usr_i4_uid` int(11) NOT NULL,
  `nod_i4_parent_node_uid` int(11) NOT NULL,
  `nod_s32_name` varchar(32) NOT NULL,
  `nod_s256_description` varchar(256) NOT NULL,
  `nod_i1_type` tinyint(4) NOT NULL DEFAULT '1',
  `nod_i2_action_type` int(11) NOT NULL,
  `nod_i2_action_code` int(11) NOT NULL,
  `nod_s256_action_data` varchar(256) NOT NULL,
  `nod_s256_state1_style` varchar(256) NOT NULL DEFAULT 'colo:green;',
  `nod_s256_state2_style` varchar(256) NOT NULL DEFAULT 'color:red;background-color:rgb(170, 255, 170);',
  `nod_s32_icon1` varchar(32) NOT NULL DEFAULT 'fa fa-folder',
  `nod_s32_icon2` varchar(32) NOT NULL DEFAULT 'fa fa-folder-open',
  `nod_s256_icon1_style` varchar(256) NOT NULL DEFAULT 'color:red;',
  `nod_s256_icon2_style` varchar(256) NOT NULL DEFAULT 'color:green;',
  `nod_i1_active` tinyint(4) NOT NULL DEFAULT '1',
  `nod_i1_visible` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`nod_i4_uid`),
  KEY `nod_fk_usr_i4_uid` (`nod_fk_usr_i4_uid`),
  KEY `nod_i4_parent_node_uid` (`nod_i4_parent_node_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_sys_nodes`
--

INSERT INTO `tbl_sys_nodes` (`nod_i4_uid`, `nod_fk_usr_i4_uid`, `nod_i4_parent_node_uid`, `nod_s32_name`, `nod_s256_description`, `nod_i1_type`, `nod_i2_action_type`, `nod_i2_action_code`, `nod_s256_action_data`, `nod_s256_state1_style`, `nod_s256_state2_style`, `nod_s32_icon1`, `nod_s32_icon2`, `nod_s256_icon1_style`, `nod_s256_icon2_style`, `nod_i1_active`, `nod_i1_visible`) VALUES
(1, 1, 0, 'ROOT', '', 0, 0, 0, '', 'color:red;', 'color:red;background-color:rgb(170, 255, 170);', 'fa fa-folder', 'fa fa-folder-open', 'color:red', 'color:green', 1, 1),
(2, 1, 1, 'Theme-01-01', '02 - Theme-01-01 - description', 1, 0, 0, '', 'color:red;', 'color:red;background-color:rgb(170, 255, 170);', 'fa fa-folder', 'fa fa-folder-open', 'color:red;', 'color:green;', 1, 1),
(3, 1, 1, 'Theme-01-02', '03 - Theme-01-02 - description', 1, 0, 0, '', 'color:red;', 'color:red;background-color:rgb(170, 255, 170);', 'fa fa-folder', 'fa fa-folder-open', 'color:red;', 'color:green;', 1, 1),
(4, 1, 2, 'Subject-01-01-01', '04 - Theme-01-01-01 - description', 1, 0, 0, '', 'color:red;', 'color:red;background-color:rgb(170, 255, 170);', 'fa fa-folder', 'fa fa-folder-open', 'color:red;', 'color:green;', 1, 1),
(5, 1, 2, 'Subject-01-01-02', '05 - Theme-01-01-02 - description', 1, 0, 0, '', 'color:red;', 'color:red;background-color:rgb(170, 255, 170);', 'fa fa-folder', 'fa fa-folder-open', 'color:red;', 'color:green;', 1, 1),
(6, 1, 3, 'Subject-01-02-01', '06 - Theme-01-02-01 - description', 1, 0, 0, '', 'color:red;', 'color:red;background-color:rgb(170, 255, 170);', 'fa fa-folder', 'fa fa-folder-open', 'color:red;', 'color:green;', 1, 1),
(7, 1, 3, 'Subject-01-02-02', '07 - Theme-01-02-12 - description', 1, 0, 0, '', 'color:red;', 'color:red;background-color:rgb(170, 255, 170);', 'fa fa-folder', 'fa fa-folder-open', 'color:red;', 'color:green;', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_themes`
--

CREATE TABLE IF NOT EXISTS `tbl_themes` (
  `thm_i4_uid` int(11) NOT NULL AUTO_INCREMENT,
  `thm_fk_cat_i4_uid` int(11) NOT NULL,
  `thm_fk_usr_i4_uid` int(11) NOT NULL,
  `thm_s32_name` varchar(32) NOT NULL,
  `thm_s256_description` varchar(256) NOT NULL,
  `thm_s32_icon` varchar(32) NOT NULL DEFAULT 'block layout icon',
  `thm_s32_color` varchar(32) NOT NULL DEFAULT 'blue',
  `thm_i1_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`thm_i4_uid`),
  KEY `thm_fk_cat_i4_uid` (`thm_fk_cat_i4_uid`,`thm_fk_usr_i4_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `tbl_themes`
--

INSERT INTO `tbl_themes` (`thm_i4_uid`, `thm_fk_cat_i4_uid`, `thm_fk_usr_i4_uid`, `thm_s32_name`, `thm_s256_description`, `thm_s32_icon`, `thm_s32_color`, `thm_i1_active`) VALUES
(1, 1, 0, 'Tools', ' 1 - c1.t1 - Tools - valid to all users', 'block layout icon', 'blue', 1),
(2, 1, 0, 'History', ' 2 - c1.t2 - History category', 'block layout icon', 'blue', 1),
(3, 1, 0, 'Friends', ' 3 - c1.t3 - Friends category', 'block layout icon', 'blue', 1),
(4, 1, 0, 'Config', ' 4 - c1.t4 - Config category', 'block layout icon', 'blue', 1),
(5, 1, 0, 'Theme home.5', ' 5 - c1.t5 - Reserved theme for c1', 'block layout icon', 'blue', 1),
(6, 1, 0, 'Theme home.6', ' 6 - c1.t6 - Reserved theme for c1', 'block layout icon', 'blue', 1),
(7, 2, 0, 'Theme c2.1', ' 7 - c2.t1 - Reserved theme for c2', 'block layout icon', 'blue', 1),
(8, 2, 0, 'Theme c2.2', ' 8 - c2.t2 - Reserved theme for c2', 'block layout icon', 'blue', 1),
(9, 2, 0, 'Theme c2.3', ' 9 - c2.t3 - Reserved theme for c2', 'block layout icon', 'blue', 1),
(10, 2, 0, 'Theme c2.4', '10 - c2.t4 - Reserved theme for c2', 'block layout icon', 'blue', 1),
(11, 2, 0, 'Theme c2.5', '11 - c2.t5 - Reserved theme for c2', 'block layout icon', 'blue', 1),
(12, 3, 0, 'Theme c3.1', '12 - c3.t1 - Reserved theme for c3', 'block layout icon', 'blue', 0),
(13, 3, 0, 'Theme c3.2', '13 - c3.t2 - Reserved theme for c3', 'block layout icon', 'blue', 0),
(14, 3, 0, 'Theme c3.3', '14 - c3.t3 - Reserved theme for c3', 'block layout icon', 'blue', 0),
(15, 3, 0, 'Theme c3.4', '15 - c3.t4 - Reserved theme for c3', 'block layout icon', 'blue', 0),
(16, 3, 0, 'Theme c3.5', '16 - c3.t5 - Reserved theme for c3', 'block layout icon', 'blue', 0),
(17, 4, 0, 'Theme c4.1', '17 - c4.t1 - Reserved theme for c4', 'block layout icon', 'blue', 0),
(18, 4, 0, 'Theme c4.2', '18 - c4.t2 - Reserved theme for c4', 'block layout icon', 'blue', 0),
(19, 4, 0, 'Theme c4.3', '19 - c4.t3 - Reserved theme for c4', 'block layout icon', 'blue', 0),
(20, 4, 0, 'Theme c4.4', '20 - c4.t4 - Reserved theme for c4', 'block layout icon', 'blue', 0),
(21, 4, 0, 'Theme c4.5', '21 - c4.t5 - Reserved theme for c4', 'block layout icon', 'blue', 0),
(22, 5, 0, 'Theme c5.1', '22 - c5.t1 - Reserved theme for c5', 'block layout icon', 'blue', 0),
(23, 5, 0, 'Theme c5.2', '23 - c5.t2 - Reserved theme for c5', 'block layout icon', 'blue', 0),
(24, 5, 0, 'Theme c5.3', '24 - c5.t3 - Reserved theme for c5', 'block layout icon', 'blue', 0),
(25, 5, 0, 'Theme c5.4', '25 - c5.t4 - Reserved theme for c5', 'block layout icon', 'blue', 0),
(26, 5, 0, 'Theme c5.5', '26 - c5.t5 - Reserved theme for c5', 'block layout icon', 'blue', 0),
(27, 6, 0, 'Theme c6.1', '27 - c6.t1 - Reserved theme for c6', 'block layout icon', 'blue', 0),
(28, 6, 0, 'Theme c6.2', '28 - c6.t2 - Reserved theme for c6', 'block layout icon', 'blue', 0),
(29, 6, 0, 'Theme c6.3', '29 - c6.t3 - Reserved theme for c6', 'block layout icon', 'blue', 0),
(30, 6, 0, 'Theme c6.4', '30 - c6.t4 - Reserved theme for c6', 'block layout icon', 'blue', 0),
(31, 6, 0, 'Theme c6.5', '31 - c6.t5 - Reserved theme for c6', 'block layout icon', 'blue', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topics`
--

CREATE TABLE IF NOT EXISTS `tbl_topics` (
  `top_i4_uid` int(11) NOT NULL AUTO_INCREMENT,
  `top_fk_sbj_i4_uid` int(11) NOT NULL,
  `top_s16_name` varchar(16) NOT NULL,
  `top_s256_description` varchar(256) NOT NULL,
  `top_s256_url` varchar(256) NOT NULL,
  `top_s32_thumbnail` varchar(32) NOT NULL,
  `top_i1_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`top_i4_uid`),
  KEY `top_fk_sbj_i4_uid` (`top_fk_sbj_i4_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `usr_i4_uid` int(11) NOT NULL AUTO_INCREMENT,
  `usr_fk_uap_i4_uid` int(11) NOT NULL,
  `usr_fk_cia_i2_uid` smallint(6) NOT NULL DEFAULT '1',
  `usr_s64_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `usr_s256_email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `usr_s256_salt` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `usr_s256_hash` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `usr_s32_mobile` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_s256_site` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_ts_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usr_i2_active` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`usr_i4_uid`),
  UNIQUE KEY `usr_name` (`usr_s64_name`,`usr_s256_email`),
  KEY `usr_fk_cia_i2_uid` (`usr_fk_cia_i2_uid`),
  KEY `usr_fk_uap_i4_uid` (`usr_fk_uap_i4_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_users`
--

--INSERT INTO `tbl_users` (`usr_i4_uid`, `usr_fk_uap_i4_uid`, `usr_fk_cia_i2_uid`, `usr_s64_name`, `usr_s256_email`, `usr_s256_salt`, `usr_s256_hash`, `usr_s32_mobile`, `usr_s256_site`, `usr_ts_created`, `usr_i2_active`) VALUES
--(1, 3, 1, 'Alessandro Breves', 'aa.breves@outlook.com', 'e/4yD4y4NqV1eLIs/HboMMzC8Bv6TYbvyct3mXAbiKw=', '$2y$10$1zUttyVMDNQDtlqg1NVV5O4zJCOhR4Ztrm8vq9G0NjeGRp9BsH9Me', '55-41-9-9515-8257', 'http://asbreves.esy.es', '2018-03-19 21:25:24', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
