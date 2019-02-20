
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2018 at 09:19 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u729172951_brv`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
