-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 29, 2017 at 06:28 PM
-- Server version: 10.1.26-MariaDB-0+deb9u1
-- PHP Version: 7.0.19-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u729172951_ap`
--
CREATE DATABASE IF NOT EXISTS `u729172951_ap` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `u729172951_ap`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

CREATE TABLE `tbl_config` (
  `cfg_i2_uid` smallint(6) NOT NULL,
  `cfg_s64_name` varchar(64) NOT NULL,
  `cfg_s256_value` varchar(256) NOT NULL,
  `cfg_s256_description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dbase_accesspoint`
--

CREATE TABLE `tbl_dbase_accesspoint` (
  `dap_i2_uid` smallint(6) NOT NULL,
  `dap_s64_database` varchar(64) NOT NULL,
  `dap_s64_host` varchar(64) NOT NULL,
  `dap_s64_username` varchar(64) NOT NULL,
  `dap_s256_salt` varchar(256) NOT NULL,
  `dap_s256_hash` varchar(256) NOT NULL,
  `dap_s256_hmac` varchar(256) NOT NULL,
  `dap_i4_port` int(11) NOT NULL,
  `dap_s32_driver` varchar(32) NOT NULL,
  `dap_i2_active` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_accesspoint`
--

CREATE TABLE `tbl_users_accesspoint` (
  `uap_i4_uid` int(11) NOT NULL,
  `uap_ts_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uap_s64_login` varchar(64) NOT NULL,
  `uap_s256_salt` varchar(256) NOT NULL,
  `uap_s256_hash` varchar(256) NOT NULL,
  `uap_i2_active` smallint(6) NOT NULL DEFAULT '1',
  `uap_fk_usr_i4_uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_config`
--
ALTER TABLE `tbl_config`
  ADD PRIMARY KEY (`cfg_i2_uid`),
  ADD UNIQUE KEY `cfg_s64_name` (`cfg_s64_name`);

--
-- Indexes for table `tbl_dbase_accesspoint`
--
ALTER TABLE `tbl_dbase_accesspoint`
  ADD PRIMARY KEY (`dap_i2_uid`);

--
-- Indexes for table `tbl_users_accesspoint`
--
ALTER TABLE `tbl_users_accesspoint`
  ADD PRIMARY KEY (`uap_i4_uid`),
  ADD UNIQUE KEY `uap_s64_login` (`uap_s64_login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_config`
--
ALTER TABLE `tbl_config`
  MODIFY `cfg_i2_uid` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_dbase_accesspoint`
--
ALTER TABLE `tbl_dbase_accesspoint`
  MODIFY `dap_i2_uid` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_users_accesspoint`
--
ALTER TABLE `tbl_users_accesspoint`
  MODIFY `uap_i4_uid` int(11) NOT NULL AUTO_INCREMENT;--
-- Database: `u729172951_brv`
--
CREATE DATABASE IF NOT EXISTS `u729172951_brv` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `u729172951_brv`;

-- --------------------------------------------------------

--
-- Table structure for table `tab_link_groups`
--

CREATE TABLE `tab_link_groups` (
  `lnk_grp_uid` int(11) NOT NULL,
  `lnk_grp_usr_uid` int(11) NOT NULL,
  `lnk_grp_name` varchar(128) NOT NULL,
  `lnk_grp_description` varchar(512) NOT NULL,
  `lnk_grp_active` smallint(6) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tab_link_groups`
--

INSERT INTO `tab_link_groups` (`lnk_grp_uid`, `lnk_grp_usr_uid`, `lnk_grp_name`, `lnk_grp_description`, `lnk_grp_active`) VALUES
(1, 0, 'Visitors', '', 1),
(2, 1, 'Main', '', 1),
(3, 1, 'Development', 'Development resources', 1),
(4, 1, 'Tutorials', 'Tutorials', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tab_links`
--

CREATE TABLE `tab_links` (
  `lnk_uid` int(11) NOT NULL,
  `lnk_ctg_uid` int(11) NOT NULL,
  `lnk_name` varchar(32) NOT NULL,
  `lnk_url` varchar(512) NOT NULL,
  `lnk_active` smallint(6) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tab_links`
--

INSERT INTO `tab_links` (`lnk_uid`, `lnk_ctg_uid`, `lnk_name`, `lnk_url`, `lnk_active`) VALUES
(1, 1, 'Search', 'https://www.google.com', 1),
(2, 1, 'Advanced search', 'https://www.google.com/advanced_search', 1),
(3, 1, 'Translate', 'https://translate.google.com', 1),
(4, 1, 'Maps', 'https://www.google.com.br/maps', 1),
(5, 1, 'reserved', '', 0),
(6, 1, 'reserved', '', 0),
(7, 1, 'reserved', '', 0),
(8, 1, 'reserved', '', 0),
(9, 1, 'reserved', '', 0),
(10, 1, 'reserved', '', 0),
(11, 2, 'reserved', '', 0),
(12, 2, 'reserved', '', 0),
(13, 2, 'reserved', '', 0),
(14, 2, 'reserved', '', 0),
(15, 2, 'reserved', '', 0),
(16, 2, 'reserved', '', 0),
(17, 2, 'reserved', '', 0),
(18, 2, 'reserved', '', 0),
(19, 2, 'reserved', '', 0),
(20, 2, 'reserved', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tab_links_categories`
--

CREATE TABLE `tab_links_categories` (
  `lnk_ctg_uid` int(11) NOT NULL,
  `lnk_ctg_grp_id` int(11) NOT NULL,
  `lnk_ctg_name` varchar(128) NOT NULL,
  `lnk_ctg_description` varchar(512) NOT NULL,
  `lnk_ctg_active` smallint(6) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tab_links_categories`
--

INSERT INTO `tab_links_categories` (`lnk_ctg_uid`, `lnk_ctg_grp_id`, `lnk_ctg_name`, `lnk_ctg_description`, `lnk_ctg_active`) VALUES
(1, 1, 'Tools & Utilities', '', 1),
(2, 1, 'Sponsors', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tab_users`
--

CREATE TABLE `tab_users` (
  `usr_uid` int(11) NOT NULL,
  `usr_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `usr_email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `usr_salt` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `usr_pass` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `usr_mobile` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_group_uid` int(11) NOT NULL DEFAULT '1',
  `usr_site` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_users`
--

INSERT INTO `tab_users` (`usr_uid`, `usr_name`, `usr_email`, `usr_salt`, `usr_pass`, `usr_mobile`, `usr_group_uid`, `usr_site`, `usr_created`) VALUES
(1, 'Alessandro Breves', 'aa.breves@outlook.com', '', '$2y$10$63IGVnrOIi.eJklyiJng..UnIVdQIlMkUU7jDBeVccWI.mkXrmHGi', NULL, 1, NULL, '2017-10-13 20:18:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tab_link_groups`
--
ALTER TABLE `tab_link_groups`
  ADD PRIMARY KEY (`lnk_grp_uid`);

--
-- Indexes for table `tab_links`
--
ALTER TABLE `tab_links`
  ADD PRIMARY KEY (`lnk_uid`);

--
-- Indexes for table `tab_links_categories`
--
ALTER TABLE `tab_links_categories`
  ADD PRIMARY KEY (`lnk_ctg_uid`);

--
-- Indexes for table `tab_users`
--
ALTER TABLE `tab_users`
  ADD PRIMARY KEY (`usr_uid`),
  ADD UNIQUE KEY `usr_name` (`usr_name`,`usr_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tab_link_groups`
--
ALTER TABLE `tab_link_groups`
  MODIFY `lnk_grp_uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tab_links`
--
ALTER TABLE `tab_links`
  MODIFY `lnk_uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tab_links_categories`
--
ALTER TABLE `tab_links_categories`
  MODIFY `lnk_ctg_uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tab_users`
--
ALTER TABLE `tab_users`
  MODIFY `usr_uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
