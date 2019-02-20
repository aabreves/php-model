
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2018 at 09:18 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
CREATE DATABASE IF NOT EXISTS `u729172951_ap` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `u729172951_ap`;

--
-- Database: `u729172951_ap`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

CREATE TABLE IF NOT EXISTS `tbl_config` (
  `cfg_i2_uid` smallint(6) NOT NULL AUTO_INCREMENT,
  `cfg_fk_cia_i2_uid` smallint(6) NOT NULL DEFAULT '1',
  `cfg_s64_name` varchar(64) NOT NULL,
  `cfg_s256_value` varchar(256) NOT NULL,
  `cfg_s256_description` varchar(256) NOT NULL,
  PRIMARY KEY (`cfg_i2_uid`),
  UNIQUE KEY `cfg_s64_name` (`cfg_s64_name`),
  KEY `cfg_i2_coid` (`cfg_fk_cia_i2_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dbase_accesspoint`
--

CREATE TABLE IF NOT EXISTS `tbl_dbase_accesspoint` (
  `dap_i2_uid` smallint(6) NOT NULL AUTO_INCREMENT,
  `dap_fk_cia_i2_uid` smallint(6) NOT NULL DEFAULT '1',
  `dap_s64_database` varchar(64) NOT NULL,
  `dap_s64_host` varchar(64) NOT NULL,
  `dap_s64_username` varchar(64) NOT NULL,
  `dap_s256_salt` varchar(256) NOT NULL,
  `dap_s256_hash` varchar(256) NOT NULL,
  `dap_s256_hmac` varchar(256) NOT NULL,
  `dap_i4_port` int(11) NOT NULL DEFAULT '0',
  `dap_s32_driver` varchar(32) NOT NULL,
  `dap_i2_active` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`dap_i2_uid`),
  KEY `dap_i2_coid` (`dap_fk_cia_i2_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_accesspoint`
--

CREATE TABLE IF NOT EXISTS `tbl_users_accesspoint` (
  `uap_i4_uid` int(11) NOT NULL AUTO_INCREMENT,
  `uap_fk_cia_i2_uid` smallint(6) NOT NULL DEFAULT '1',
  `uap_s256_login` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `uap_s256_salt` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `uap_s256_hash` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `uap_ts_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uap_i2_active` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uap_i4_uid`),
  UNIQUE KEY `usr_name` (`uap_s256_login`),
  KEY `usr_fk_cia_i2_uid` (`uap_fk_cia_i2_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
