-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2017 at 08:18 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invenity`
--

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE `component` (
  `component_id` int(11) NOT NULL,
  `component_name` varchar(30) NOT NULL COMMENT 'Component Name',
  `component_page` varchar(100) NOT NULL COMMENT 'Component Page',
  `component_type` enum('system','standard') NOT NULL DEFAULT 'standard' COMMENT 'Component Type',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT 'Active Status',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`component_id`, `component_name`, `component_page`, `component_type`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revision`) VALUES
(1, 'User Management', 'user_management.php', 'system', 'yes', 'admin', '2015-12-04 07:54:58', 'admin', '2015-12-22 14:46:59', 2),
(3, 'System Log', 'system_log.php', 'system', 'yes', 'admin', '2015-12-04 07:54:58', 'admin', '2015-12-22 14:46:55', 2),
(4, 'System Settings', 'system_settings.php', 'system', 'yes', 'admin', '2015-12-04 07:54:58', 'admin', '2015-12-22 14:46:57', 2),
(5, 'Device Management', 'device_management.php', 'system', 'yes', 'admin', '2015-12-03 15:01:55', 'admin', '2015-12-22 14:46:47', 2),
(6, 'Location Management', 'location_management.php', 'system', 'yes', 'admin', '2015-12-03 15:01:55', 'admin', '2015-12-22 14:46:52', 2),
(7, 'Report', 'report.php', 'system', 'yes', 'admin', '2015-12-22 11:17:36', 'admin', '2016-02-17 14:14:29', 4),
(8, 'Loan', 'loan_form.php', 'system', 'yes', 'admin', '2017-10-09 22:39:00', 'admin', '2017-10-09 22:39:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `device_changes`
--

CREATE TABLE `device_changes` (
  `changes_id` int(12) UNSIGNED ZEROFILL NOT NULL,
  `device_id` int(11) NOT NULL,
  `changes` text,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device_changes`
--

INSERT INTO `device_changes` (`changes_id`, `device_id`, `changes`, `updated_by`, `updated_date`) VALUES
(000000000001, 4, 'Dev status :  -> keep. ', 'admin', '2017-11-02 10:54:43'),
(000000000002, 4, 'Dev status :  -> keep. ', 'admin', '2017-11-02 10:55:55'),
(000000000003, 4, 'Dev status :  -> in use. ', 'admin', '2017-11-02 10:56:03'),
(000000000004, 4, '', 'admin', '2017-11-02 10:58:21'),
(000000000005, 4, 'Dev status : in use -> keep in it. ', 'admin', '2017-11-02 12:39:30'),
(000000000006, 4, 'Dev status :  -> keep in it. ', 'admin', '2017-11-02 15:46:51'),
(000000000007, 4, 'Dev status :  -> keep in it. ', 'admin', '2017-11-02 16:58:22'),
(000000000008, 5, 'Dev serial : REQ000000000141 -> Z3C7-205AE-0646. Dev status : Keep In IT -> . ', 'admin', '2017-11-06 09:51:13'),
(000000000009, 5, 'Dev status :  -> keep in it. ', 'admin', '2017-11-06 09:51:28'),
(000000000010, 7, 'Dev status : Keep In IT -> . ', 'admin', '2017-11-06 09:56:25'),
(000000000011, 7, 'Dev serial : DTIG3/4GB -> DTIG3. Dev status :  -> keep in it. ', 'admin', '2017-11-06 09:56:56'),
(000000000012, 4, 'Dev status :  -> in use. ', 'admin', '2017-11-06 10:04:03'),
(000000000013, 4, 'Dev status :  -> in use. ', 'admin', '2017-11-06 10:23:10'),
(000000000014, 4, 'Dev status :  -> damaged. ', 'admin', '2017-11-06 10:24:35'),
(000000000015, 4, 'Dev status : Damaged -> in use. ', 'admin', '2017-11-06 11:20:16'),
(000000000016, 4, 'Dev status :  -> damaged. ', 'admin', '2017-11-06 11:21:26'),
(000000000017, 4, 'Dev status : Damaged -> repaired. ', 'admin', '2017-11-06 11:21:42'),
(000000000018, 4, 'Dev status : Repaired -> new. ', 'admin', '2017-11-06 11:21:55'),
(000000000019, 4, 'Dev status : New -> in use. ', 'admin', '2017-11-06 11:22:13'),
(000000000020, 4, 'Dev status :  -> damaged. ', 'admin', '2017-11-06 11:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `device_list`
--

CREATE TABLE `device_list` (
  `device_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL COMMENT 'FK Device Type',
  `device_code` varchar(100) NOT NULL COMMENT 'Unique Code (5 digit number in the back)',
  `device_brand` varchar(100) NOT NULL,
  `device_model` varchar(100) DEFAULT NULL,
  `device_serial` varchar(255) NOT NULL,
  `device_color` varchar(100) NOT NULL COMMENT 'Color',
  `device_description` text,
  `device_photo` text,
  `device_status` enum('New','In User','Damaged','Repaired','Keep In IT') NOT NULL DEFAULT 'New',
  `location_id` int(11) DEFAULT NULL COMMENT 'FK Location',
  `device_deployment_date` datetime DEFAULT NULL COMMENT 'Fill this field when assigned to a location',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device_list`
--

INSERT INTO `device_list` (`device_id`, `type_id`, `device_code`, `device_brand`, `device_model`, `device_serial`, `device_color`, `device_description`, `device_photo`, `device_status`, `location_id`, `device_deployment_date`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revision`) VALUES
(4, 9, 'GG/2017/HDEKS/1', 'Western Digital', 'My Passport', 'WDBBEP0010BBK', 'Black', '<p>Hardisk Eksternal IT Support Specialist Surabaya</p>', './assets/images/device_photos/WDBBEP0010BBK.jpg', 'Damaged', 1, '2017-11-06 11:26:18', 'admin', '2017-11-01 10:28:08', 'admin', '2017-11-06 11:26:18', 16),
(5, 12, 'GG/2017/SWH/2', 'ATEN Desktop', 'ATEN CS84U', 'Z3C7-205AE-0646', 'Grey', '<p>Dekstop Swith for Provisioning</p>', './assets/images/device_photos/Z3C7-205AE-0646.jpg', 'Keep In IT', 1, '2017-11-06 09:51:28', 'admin', '2017-11-06 09:45:39', 'admin', '2017-11-06 09:51:28', 2),
(6, 11, 'GG/2017/RGCS/3', 'Western Digital', 'NOMAD', 'WDBGRD0000NBK', 'Black', '<p>Pelindung HD Eskternal</p>', './assets/images/device_photos/WDBGRD0000NBK.jpg', 'Keep In IT', 1, '0000-00-00 00:00:00', 'admin', '2017-11-06 09:46:31', 'admin', '2017-11-06 09:46:31', 0),
(7, 10, 'GG/2017/USB/4', 'Flash Drive Data Traveller', 'KingSton', 'DTIG3', 'Black', '<p>USB Flash Drive KingSton Data Traveller</p>', './assets/images/device_photos/DTIG3.jpg', '', 1, '2017-11-06 09:56:56', 'admin', '2017-11-06 09:48:28', 'admin', '2017-11-06 09:56:56', 2);

-- --------------------------------------------------------

--
-- Table structure for table `device_type`
--

CREATE TABLE `device_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(30) NOT NULL COMMENT 'Device Type Name',
  `type_code` varchar(30) NOT NULL COMMENT 'Device Type Code',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT 'Device Type Active Status',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint(3) NOT NULL DEFAULT '0' COMMENT 'Total Device Type Changes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device_type`
--

INSERT INTO `device_type` (`type_id`, `type_name`, `type_code`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revision`) VALUES
(9, 'Hard Disk Eksternal', 'HDEKS', 'yes', 'admin', '2017-11-01 10:26:02', 'admin', '2017-11-01 10:26:02', 0),
(10, 'Universal Serial Bus', 'USB', 'yes', 'admin', '2017-11-01 10:26:26', 'admin', '2017-11-01 10:26:26', 0),
(11, 'Rugged Case', 'RGCS', 'yes', 'admin', '2017-11-01 10:26:52', 'admin', '2017-11-01 10:26:52', 0),
(12, 'Switch', 'SWH', 'yes', 'admin', '2017-11-06 09:43:59', 'admin', '2017-11-06 09:43:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `username` varchar(30) NOT NULL,
  `loan_date` datetime NOT NULL,
  `device_id` int(11) NOT NULL,
  `loan_name` varchar(150) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `dept` varchar(255) NOT NULL,
  `necessary` varchar(255) NOT NULL,
  `return_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`username`, `loan_date`, `device_id`, `loan_name`, `created_date`, `updated_date`, `dept`, `necessary`, `return_date`) VALUES
('admin', '2017-11-06 00:00:00', 4, 'Bondan', '2017-11-06 10:01:23', '2017-11-06 10:01:23', 'IT', 'Back Up Data', '2017-11-06 10:01:23'),
('admin', '2017-11-06 00:00:00', 7, 'Test In Use', '2017-11-06 11:26:58', '2017-11-06 11:26:58', 'Test Dept', 'asdasd', '2017-11-06 11:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(30) NOT NULL COMMENT 'Location Name',
  `location_photo` text COMMENT 'Location Photo - If available',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT 'Location Active Status',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint(3) NOT NULL DEFAULT '0' COMMENT 'Total Device Type Changes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `location_photo`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revision`) VALUES
(1, 'IT Room', NULL, 'yes', 'admin', '2016-11-12 11:59:44', 'admin', '2016-11-12 12:09:02', 1),
(2, 'Storage 1', NULL, 'yes', 'admin', '2016-11-12 12:12:29', 'admin', '2017-11-03 08:47:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location_building`
--

CREATE TABLE `location_building` (
  `building_id` int(11) NOT NULL,
  `building_name` varchar(30) NOT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_building`
--

INSERT INTO `location_building` (`building_id`, `building_name`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revision`) VALUES
(1, 'Griya', 'yes', 'admin', '2016-11-12 11:59:00', 'admin', '2017-11-02 23:28:17', 3),
(2, 'Grafika', 'yes', 'admin', '2016-11-12 11:59:13', 'admin', '2017-11-02 23:28:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location_details`
--

CREATE TABLE `location_details` (
  `detail_id` int(15) NOT NULL,
  `location_id` int(11) NOT NULL COMMENT 'FK location',
  `place_id` int(11) NOT NULL COMMENT 'FK place',
  `building_id` int(11) NOT NULL COMMENT 'FK building',
  `floor_id` int(11) NOT NULL COMMENT 'FK floor',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_details`
--

INSERT INTO `location_details` (`detail_id`, `location_id`, `place_id`, `building_id`, `floor_id`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revision`) VALUES
(1, 1, 1, 1, 3, 'yes', 'admin', '2016-11-12 12:09:02', 'admin', '2016-11-12 12:09:02', 0),
(2, 2, 1, 2, 1, 'yes', 'admin', '2016-11-12 12:12:29', 'admin', '2017-11-03 08:47:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location_floor`
--

CREATE TABLE `location_floor` (
  `floor_id` int(11) NOT NULL,
  `floor_name` varchar(30) NOT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_floor`
--

INSERT INTO `location_floor` (`floor_id`, `floor_name`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revision`) VALUES
(1, '1st Floor', 'yes', 'admin', '2016-10-31 13:46:37', 'admin', '2016-11-12 11:56:48', 1),
(2, '2nd Floor', 'yes', 'admin', '2016-10-31 13:46:37', 'admin', '2016-11-12 11:56:59', 1),
(3, '3rd Floor', 'yes', 'admin', '2016-10-31 13:46:37', 'admin', '2016-11-12 11:56:39', 3),
(4, '4th Floor', 'no', 'admin', '2016-11-08 14:36:53', 'admin', '2016-11-12 11:57:08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `location_place`
--

CREATE TABLE `location_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(30) NOT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_place`
--

INSERT INTO `location_place` (`place_id`, `place_name`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revision`) VALUES
(1, 'Waru', 'yes', 'admin', '2016-10-31 13:46:37', 'admin', '2017-11-03 08:47:07', 2);

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `log_id` int(11) NOT NULL,
  `log_date` datetime NOT NULL COMMENT 'Date',
  `username` varchar(30) NOT NULL COMMENT 'Username',
  `description` text NOT NULL COMMENT 'Log Descriptions'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_logs`
--

INSERT INTO `system_logs` (`log_id`, `log_date`, `username`, `description`) VALUES
(50, '2017-11-03 08:47:07', 'admin', 'admin update data :  \r\n					place_name = ''Waru'', \r\n					active = ''yes'', \r\n					updated_by = ''admin'', \r\n					updated_date = NOW(), \r\n					revision = revision+1 \r\n					 where  place_id = ''1''  from location_place table on 2017/11/03 08:47:07'),
(51, '2017-11-03 08:47:16', 'admin', 'admin update data :  \r\n					location_name = ''Storage 1'', \r\n					active = ''yes'', \r\n					updated_by = ''admin'', \r\n					updated_date = NOW(), \r\n					revision = revision+1 \r\n					 where  location_id = ''2''  from location table on 2017/11/03 08:47:16'),
(52, '2017-11-03 08:47:16', 'admin', 'admin update data :  \r\n							place_id = ''1'', \r\n							building_id = ''2'', \r\n							floor_id = ''1'',\r\n							updated_by = ''admin'', \r\n							updated_date = NOW(), \r\n							revision = revision+1  where  detail_id = ''2'' from location_details table on 2017/11/03 08:47:16'),
(53, '2017-11-06 09:42:52', 'admin', 'admin update data :  setting_value=''1,3,4,5,6,7,8'' where  setting_name=''default_privileges'' from system_settings table on 2017/11/06 09:42:52'),
(54, '2017-11-06 09:43:59', 'admin', 'admin insert new data into the device_type table on 2017/11/06 09:43:59'),
(55, '2017-11-06 09:45:39', 'admin', 'admin insert new data into the device_list table on 2017/11/06 09:45:39'),
(56, '2017-11-06 09:46:31', 'admin', 'admin insert new data into the device_list table on 2017/11/06 09:46:31'),
(57, '2017-11-06 09:48:28', 'admin', 'admin insert new data into the device_list table on 2017/11/06 09:48:28'),
(58, '2017-11-06 09:51:13', 'admin', 'admin update data :  \r\n							device_brand = ''ATEN Desktop'', \r\n							device_model = ''ATEN CS84U'', \r\n							device_color = ''Grey'', \r\n							device_serial = ''Z3C7-205AE-0646'', \r\n							device_description = ''<p>Dekstop Swith for Provisioning</p>'', \r\n							device_photo = ''./assets/images/device_photos/Z3C7-205AE-0646.jpg'',   \r\n							device_status = '''', \r\n							location_id = ''1'', \r\n							device_deployment_date = NOW(), \r\n							updated_by = ''admin'', \r\n							updated_date = NOW(), \r\n							revision = revision+1 \r\n							 where  device_id = ''5''  from device_list table on 2017/11/06 09:51:13'),
(59, '2017-11-06 09:51:28', 'admin', 'admin update data :  \r\n							device_brand = ''ATEN Desktop'', \r\n							device_model = ''ATEN CS84U'', \r\n							device_color = ''Grey'', \r\n							device_serial = ''Z3C7-205AE-0646'', \r\n							device_description = ''<p>Dekstop Swith for Provisioning</p>'', \r\n							  \r\n							device_status = ''keep in it'', \r\n							location_id = ''1'', \r\n							device_deployment_date = NOW(), \r\n							updated_by = ''admin'', \r\n							updated_date = NOW(), \r\n							revision = revision+1 \r\n							 where  device_id = ''5''  from device_list table on 2017/11/06 09:51:28'),
(60, '2017-11-06 09:56:16', 'ldap', 'ldap insert new data into the users table on 2017/11/06 09:56:16'),
(61, '2017-11-06 09:56:17', 'ldap', 'ldap insert new data into the user_privileges table on 2017/11/06 09:56:17'),
(62, '2017-11-06 09:56:26', 'admin', 'admin update data :  \r\n							device_brand = ''Flash Drive Data Traveller'', \r\n							device_model = ''KingSton'', \r\n							device_color = ''Black'', \r\n							device_serial = ''DTIG3/4GB'', \r\n							device_description = ''<p>USB Flash Drive KingSton Data Traveller</p>'', \r\n							device_photo = ''./assets/images/device_photos/DTIG3/4GB.jpg'',   \r\n							device_status = '''', \r\n							location_id = ''1'', \r\n							device_deployment_date = NOW(), \r\n							updated_by = ''admin'', \r\n							updated_date = NOW(), \r\n							revision = revision+1 \r\n							 where  device_id = ''7''  from device_list table on 2017/11/06 09:56:26'),
(63, '2017-11-06 09:56:56', 'admin', 'admin update data :  \r\n							device_brand = ''Flash Drive Data Traveller'', \r\n							device_model = ''KingSton'', \r\n							device_color = ''Black'', \r\n							device_serial = ''DTIG3'', \r\n							device_description = ''<p>USB Flash Drive KingSton Data Traveller</p>'', \r\n							device_photo = ''./assets/images/device_photos/DTIG3.jpg'',   \r\n							device_status = ''keep in it'', \r\n							location_id = ''1'', \r\n							device_deployment_date = NOW(), \r\n							updated_by = ''admin'', \r\n							updated_date = NOW(), \r\n							revision = revision+1 \r\n							 where  device_id = ''7''  from device_list table on 2017/11/06 09:56:56'),
(64, '2017-11-06 10:00:53', 'ksoleh', 'ksoleh insert new data into the loan table on 2017/11/06 10:00:53'),
(65, '2017-11-06 10:00:53', 'ksoleh', 'ksoleh update data :  device_status = ''in use''  where  device_id = 7 from device_list table on 2017/11/06 10:00:53'),
(66, '2017-11-06 10:01:23', 'admin', 'admin insert new data into the loan table on 2017/11/06 10:01:23'),
(67, '2017-11-06 10:01:23', 'admin', 'admin update data :  device_status = ''in use''  where  device_id = 4 from device_list table on 2017/11/06 10:01:23'),
(68, '2017-11-06 10:04:03', 'admin', 'admin update data :  \r\n							device_brand = ''Western Digital'', \r\n							device_model = ''My Passport'', \r\n							device_color = ''Black'', \r\n							device_serial = ''WDBBEP0010BBK'', \r\n							device_description = ''<p>Hardisk Eksternal IT Support Specialist Surabaya</p>'', \r\n							  \r\n							device_status = ''in use'', \r\n							location_id = ''1'', \r\n							device_deployment_date = NOW(), \r\n							updated_by = ''admin'', \r\n							updated_date = NOW(), \r\n							revision = revision+1 \r\n							 where  device_id = ''4''  from device_list table on 2017/11/06 10:04:03'),
(69, '2017-11-06 10:23:10', 'admin', 'admin update data :  \r\n							device_brand = ''Western Digital'', \r\n							device_model = ''My Passport'', \r\n							device_color = ''Black'', \r\n							device_serial = ''WDBBEP0010BBK'', \r\n							device_description = ''<p>Hardisk Eksternal IT Support Specialist Surabaya</p>'', \r\n							  \r\n							device_status = ''in use'', \r\n							location_id = ''1'', \r\n							device_deployment_date = NOW(), \r\n							updated_by = ''admin'', \r\n							updated_date = NOW(), \r\n							revision = revision+1 \r\n							 where  device_id = ''4''  from device_list table on 2017/11/06 10:23:10'),
(70, '2017-11-06 10:24:35', 'admin', 'admin update data :  \r\n							device_brand = ''Western Digital'', \r\n							device_model = ''My Passport'', \r\n							device_color = ''Black'', \r\n							device_serial = ''WDBBEP0010BBK'', \r\n							device_description = ''<p>Hardisk Eksternal IT Support Specialist Surabaya</p>'', \r\n							  \r\n							device_status = ''damaged'', \r\n							location_id = ''1'', \r\n							device_deployment_date = NOW(), \r\n							updated_by = ''admin'', \r\n							updated_date = NOW(), \r\n							revision = revision+1 \r\n							 where  device_id = ''4''  from device_list table on 2017/11/06 10:24:35'),
(71, '2017-11-06 10:36:41', 'ldap', 'ldap insert new data into the users table on 2017/11/06 10:36:41'),
(72, '2017-11-06 10:36:42', 'ldap', 'ldap insert new data into the user_privileges table on 2017/11/06 10:36:42'),
(73, '2017-11-06 11:20:17', 'admin', 'admin update data :  \r\n							device_brand = ''Western Digital'', \r\n							device_model = ''My Passport'', \r\n							device_color = ''Black'', \r\n							device_serial = ''WDBBEP0010BBK'', \r\n							device_description = ''<p>Hardisk Eksternal IT Support Specialist Surabaya</p>'', \r\n							  \r\n							device_status = ''in use'', \r\n							location_id = ''1'', \r\n							device_deployment_date = NOW(), \r\n							updated_by = ''admin'', \r\n							updated_date = NOW(), \r\n							revision = revision+1 \r\n							 where  device_id = ''4''  from device_list table on 2017/11/06 11:20:17'),
(74, '2017-11-06 11:21:26', 'admin', 'admin update data :  \r\n							device_brand = ''Western Digital'', \r\n							device_model = ''My Passport'', \r\n							device_color = ''Black'', \r\n							device_serial = ''WDBBEP0010BBK'', \r\n							device_description = ''<p>Hardisk Eksternal IT Support Specialist Surabaya</p>'', \r\n							  \r\n							device_status = ''damaged'', \r\n							location_id = ''1'', \r\n							device_deployment_date = NOW(), \r\n							updated_by = ''admin'', \r\n							updated_date = NOW(), \r\n							revision = revision+1 \r\n							 where  device_id = ''4''  from device_list table on 2017/11/06 11:21:26'),
(75, '2017-11-06 11:21:42', 'admin', 'admin update data :  \r\n							device_brand = ''Western Digital'', \r\n							device_model = ''My Passport'', \r\n							device_color = ''Black'', \r\n							device_serial = ''WDBBEP0010BBK'', \r\n							device_description = ''<p>Hardisk Eksternal IT Support Specialist Surabaya</p>'', \r\n							  \r\n							device_status = ''repaired'', \r\n							location_id = ''1'', \r\n							device_deployment_date = NOW(), \r\n							updated_by = ''admin'', \r\n							updated_date = NOW(), \r\n							revision = revision+1 \r\n							 where  device_id = ''4''  from device_list table on 2017/11/06 11:21:42'),
(76, '2017-11-06 11:21:55', 'admin', 'admin update data :  \r\n							device_brand = ''Western Digital'', \r\n							device_model = ''My Passport'', \r\n							device_color = ''Black'', \r\n							device_serial = ''WDBBEP0010BBK'', \r\n							device_description = ''<p>Hardisk Eksternal IT Support Specialist Surabaya</p>'', \r\n							  \r\n							device_status = ''new'', \r\n							location_id = ''1'', \r\n							device_deployment_date = NOW(), \r\n							updated_by = ''admin'', \r\n							updated_date = NOW(), \r\n							revision = revision+1 \r\n							 where  device_id = ''4''  from device_list table on 2017/11/06 11:21:55'),
(77, '2017-11-06 11:22:13', 'admin', 'admin update data :  \r\n							device_brand = ''Western Digital'', \r\n							device_model = ''My Passport'', \r\n							device_color = ''Black'', \r\n							device_serial = ''WDBBEP0010BBK'', \r\n							device_description = ''<p>Hardisk Eksternal IT Support Specialist Surabaya</p>'', \r\n							  \r\n							device_status = ''in use'', \r\n							location_id = ''1'', \r\n							device_deployment_date = NOW(), \r\n							updated_by = ''admin'', \r\n							updated_date = NOW(), \r\n							revision = revision+1 \r\n							 where  device_id = ''4''  from device_list table on 2017/11/06 11:22:13'),
(78, '2017-11-06 11:26:18', 'admin', 'admin update data :  \r\n							device_brand = ''Western Digital'', \r\n							device_model = ''My Passport'', \r\n							device_color = ''Black'', \r\n							device_serial = ''WDBBEP0010BBK'', \r\n							device_description = ''<p>Hardisk Eksternal IT Support Specialist Surabaya</p>'', \r\n							  \r\n							device_status = ''damaged'', \r\n							location_id = ''1'', \r\n							device_deployment_date = NOW(), \r\n							updated_by = ''admin'', \r\n							updated_date = NOW(), \r\n							revision = revision+1 \r\n							 where  device_id = ''4''  from device_list table on 2017/11/06 11:26:18'),
(79, '2017-11-06 11:26:58', 'admin', 'admin insert new data into the loan table on 2017/11/06 11:26:58'),
(80, '2017-11-06 13:48:16', 'admin', 'admin update data :  setting_value=''5,6,7,8'' where  setting_name=''default_privileges'' from system_settings table on 2017/11/06 13:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `setting_name` varchar(50) NOT NULL COMMENT 'Setting Name',
  `setting_value` text NOT NULL COMMENT 'Values',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`setting_name`, `setting_value`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revision`) VALUES
('admin_email', 'admin@is_inventory.com', 'yes', 'system', '2015-12-10 09:33:16', 'system', '2015-12-10 09:33:16', 0),
('body_background', 'symphony.png', 'yes', 'system', '2015-12-10 09:33:16', 'admin', '2017-11-02 13:30:17', 6),
('color_scheme', 'site-default.min.css', 'yes', 'system', '2015-12-10 09:33:16', 'admin', '2017-11-01 10:08:21', 7),
('default_privileges', '5,6,7,8', 'yes', 'admin', '2017-10-22 15:44:00', 'admin', '2017-11-06 13:48:15', 4),
('device_code_format', 'GG/year/devtype', 'yes', 'system', '2016-11-09 10:48:25', 'admin', '2017-10-31 15:41:14', 1),
('favicon', 'favicon.ico', 'no', 'system', '2015-12-10 09:33:16', 'system', '2015-12-10 09:33:16', 0),
('inventory_description', '<p>Untuk memudahkan IT Surabaya dalam melakukan Peminjaman Tools</p>', 'yes', 'system', '2015-12-10 09:33:16', 'admin', '2017-11-02 16:09:30', 2),
('inventory_email', 'ithelpdesk@gudanggaramtbk.com', 'yes', 'system', '2015-12-10 09:33:16', 'admin', '2017-11-01 10:22:06', 2),
('inventory_fax_number', '', 'yes', 'system', '2015-12-10 09:33:16', 'admin', '2016-11-12 11:51:41', 1),
('inventory_location', '<p><strong>Jl. Letjen Sutoyo No. 55. Waru, Sidoarjo</strong></p>', 'yes', 'system', '2015-12-10 09:33:16', 'admin', '2017-11-01 10:22:06', 2),
('inventory_logo', 'sclogo.png', 'yes', 'system', '2015-12-10 09:33:16', 'admin', '2017-10-31 15:41:14', 3),
('inventory_name', 'Log Book', 'yes', 'system', '2015-12-10 09:33:16', 'admin', '2017-10-31 15:41:13', 1),
('inventory_phone_number', '031 2985100', 'yes', 'system', '2015-12-10 09:33:16', 'admin', '2017-11-01 10:22:06', 2),
('inventory_slogan', 'Manage Tools IT Support Specialist Surabaya', 'yes', 'system', '2015-12-10 09:33:16', 'admin', '2017-10-31 15:41:14', 1),
('inventory_website', 'www.gudanggaramtbk.com', 'yes', 'system', '2015-12-10 09:33:16', 'admin', '2017-11-01 10:22:06', 2),
('location_details', 'enable', 'yes', 'system', '2016-11-02 11:14:23', 'admin', '2016-11-08 11:39:25', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL COMMENT 'Unique Username',
  `password` varchar(128) NOT NULL COMMENT 'SHA512',
  `salt` varchar(64) NOT NULL COMMENT 'Random String SHA256',
  `level` enum('admin','user') NOT NULL DEFAULT 'user' COMMENT 'User Level',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT 'User Active Status',
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `photo` text COMMENT 'User Photo Profile - Set default if empty',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint(3) NOT NULL DEFAULT '0' COMMENT 'Total Profile Changes/Revision'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `salt`, `level`, `active`, `first_name`, `last_name`, `photo`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revision`) VALUES
('admin', '24ce1033bdfe226997340a7104d79eeb43a54a27c101da24a5eb465c90a10800d6f8671346158f0ecf2efb4f1440f45e9c16fbc3e45d3e53e2bb94839781e95f', '1f78147ac76487d519cdf84a31df14b84948c6a01f763b522df896c75a5d7e4f', 'admin', 'yes', 'Super', 'User', './assets/images/user_photos/standard_photo.jpg', 'admin', '2015-12-02 11:26:49', 'admin', '2015-12-02 11:26:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_privileges`
--

CREATE TABLE `user_privileges` (
  `username` varchar(30) NOT NULL,
  `privileges` text NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revision` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_privileges`
--

INSERT INTO `user_privileges` (`username`, `privileges`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revision`) VALUES
('admin', '*', 'admin', '2015-12-10 08:00:24', 'admin', '2015-12-10 08:00:24', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `component`
--
ALTER TABLE `component`
  ADD PRIMARY KEY (`component_id`);

--
-- Indexes for table `device_changes`
--
ALTER TABLE `device_changes`
  ADD PRIMARY KEY (`changes_id`);

--
-- Indexes for table `device_list`
--
ALTER TABLE `device_list`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `device_type`
--
ALTER TABLE `device_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`device_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `location_building`
--
ALTER TABLE `location_building`
  ADD PRIMARY KEY (`building_id`);

--
-- Indexes for table `location_details`
--
ALTER TABLE `location_details`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `location_floor`
--
ALTER TABLE `location_floor`
  ADD PRIMARY KEY (`floor_id`);

--
-- Indexes for table `location_place`
--
ALTER TABLE `location_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`setting_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `component`
--
ALTER TABLE `component`
  MODIFY `component_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `device_changes`
--
ALTER TABLE `device_changes`
  MODIFY `changes_id` int(12) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `device_list`
--
ALTER TABLE `device_list`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `device_type`
--
ALTER TABLE `device_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `location_building`
--
ALTER TABLE `location_building`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `location_details`
--
ALTER TABLE `location_details`
  MODIFY `detail_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `location_floor`
--
ALTER TABLE `location_floor`
  MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `location_place`
--
ALTER TABLE `location_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD CONSTRAINT `user_privileges_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
