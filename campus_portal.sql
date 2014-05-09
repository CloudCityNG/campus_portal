-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2014 at 11:16 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `campus_portal`
--
CREATE DATABASE IF NOT EXISTS `campus_portal` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `campus_portal`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL,
  `password` varchar(50) NOT NULL,
  `full_name` varchar(65) NOT NULL,
  `email_address` varchar(65) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `course_id` varchar(25) NOT NULL DEFAULT '0',
  `role` enum('1','2','3') NOT NULL DEFAULT '2',
  `status` enum('A','D') NOT NULL,
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`admin_id`, `username`, `password`, `full_name`, `email_address`, `dept_id`, `course_id`, `role`, `status`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 'admission', '21232f297a57a5a743894a0e4a801fc3', 'Soyab Rana', 'ranasoyab@gmail.com', 1, '0', '3', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(2, 'exam', '21232f297a57a5a743894a0e4a801fc3', 'Soyab Rana', 'ranasoyab@gmail.com', 2, '0', '3', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(3, 'hostel', '21232f297a57a5a743894a0e4a801fc3', 'Soyab Rana', 'ranasoyab@gmail.com', 3, '0', '3', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(4, 'student_section', '21232f297a57a5a743894a0e4a801fc3', 'Soyab Rana', 'ranasoyab@gmail.com', 4, '1,7,15', '3', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `admission_candidate_status`
--

CREATE TABLE IF NOT EXISTS `admission_candidate_status` (
  `admission_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` enum('A','D') NOT NULL,
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`admission_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admission_candidate_status`
--

INSERT INTO `admission_candidate_status` (`admission_status_id`, `name`, `status`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 'Payment Not Done', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(2, 'Entrance Exam Test', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(3, 'Counselling', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(4, 'Admission Order', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(5, 'Admision Confirmed', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(6, 'Admision Closed', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `admission_details`
--

CREATE TABLE IF NOT EXISTS `admission_details` (
  `admission_id` int(11) NOT NULL AUTO_INCREMENT,
  `degree` enum('PG','UG') NOT NULL,
  `admission_year` int(4) NOT NULL,
  `exam_date` date NOT NULL,
  `exam_time` varchar(20) NOT NULL,
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`admission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admission_details`
--

INSERT INTO `admission_details` (`admission_id`, `degree`, `admission_year`, `exam_date`, `exam_time`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 'UG', 2014, '2014-05-31', '11.00 to 2.00 P.M.', 1, '2014-04-17 00:00:00', 1, '2014-04-17 00:00:00'),
(2, 'UG', 2013, '2014-05-31', '11.00 to 2.00 P.M.', 1, '2014-04-17 00:00:00', 1, '2014-04-17 00:00:00'),
(3, 'PG', 2014, '2014-05-31', '11.00 to 2.00 P.M.', 1, '2014-04-17 00:00:00', 1, '2014-04-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `short_code` char(2) NOT NULL,
  `degree` enum('PG','UG','SS','Diploma','Certificate') NOT NULL,
  `entrance_exam` enum('Y','N','O') NOT NULL DEFAULT 'N',
  `seats` int(3) NOT NULL,
  `status` enum('A','D') NOT NULL,
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `name`, `short_code`, `degree`, `entrance_exam`, `seats`, `status`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 'MBBS', 'MS', 'UG', 'Y', 150, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(2, 'BDS', 'BS', 'UG', 'Y', 150, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(3, 'BPT', 'BT', 'UG', 'N', 100, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(4, 'B.Sc. (Nursing)', 'BN', 'UG', 'N', 100, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(5, 'Pharm. D.', 'PD', 'UG', 'N', 100, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(6, 'B. Pharm', 'BP', 'UG', 'N', 100, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(7, 'PG. MD/MS', 'DS', 'PG', 'Y', 113, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(8, 'MDS', 'MD', 'PG', 'Y', 44, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(9, 'MPT', 'MT', 'PG', 'N', 100, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(10, 'M. Sc. Nursing', 'MN', 'PG', 'N', 100, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(11, 'M-Pharm', 'MP', 'PG', 'N', 100, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(12, 'MBA', 'MB', 'PG', 'N', 100, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(13, 'Super Speciality', 'SS', 'SS', 'Y', 100, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(14, 'P.B. B.Sc. Nursing', 'PB', 'UG', 'N', 100, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(15, 'Diploma MS/MD', 'DP', 'Diploma', 'Y', 25, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(16, 'Certificate Courses', 'CC', 'Certificate', 'N', 100, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `course_specialization`
--

CREATE TABLE IF NOT EXISTS `course_specialization` (
  `course_special_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `name` varchar(65) NOT NULL,
  `short_code` char(2) NOT NULL,
  `seats` int(3) NOT NULL,
  `status` enum('A','D') NOT NULL,
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`course_special_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `course_specialization`
--

INSERT INTO `course_specialization` (`course_special_id`, `course_id`, `name`, `short_code`, `seats`, `status`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 7, 'MD (Community Medicine)', 'CM', 6, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(2, 7, 'MD (Microbiology)', 'MB', 3, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(3, 7, 'MD (TB & Chest)', 'TC', 3, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(4, 7, 'MD (Anaesthesia)', 'AN', 12, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(5, 7, 'MD (Paramacology)', 'PO', 9, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(6, 7, 'MD (Anatomy)', 'AO', 5, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(7, 7, 'MD (Paediatrics)', 'PT', 10, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(8, 7, 'MD (Biochemistry)', 'BC', 2, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(9, 7, 'MD (Obst. & Gynaec)', 'OG', 6, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(10, 7, 'MD (Psysiology)', 'PO', 3, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(11, 7, 'MD (Psychiatry)', 'PC', 2, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(12, 7, 'MD (Pathology)', 'PA', 8, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(13, 7, 'MD (Radiodiagnosis)', 'RD', 10, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(14, 7, 'MD (Forensic Medicine)', 'FM', 1, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(15, 7, 'MD (Gemeral Medicine)', 'GM', 12, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(16, 7, 'MD (Skin & VD)', 'SV', 2, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(17, 7, 'MS (Orthopadics)', 'OP', 6, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(18, 7, 'MS (General Surgery)', 'GS', 7, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(19, 7, 'MS (Opthalmology)', 'OO', 4, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(20, 7, 'MS (ENT)', 'ET', 2, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(21, 15, 'DCM (Community Medicine)', 'DM', 2, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(22, 15, 'D-Ortho (Orthopadics)', 'DP', 2, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(23, 15, 'DTCB (TB & Chest)', 'DT', 1, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(24, 15, 'DA (Anaesthesia)', 'DA', 2, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(25, 15, 'DO (Opthalmology)', 'DO', 1, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(26, 15, 'DCH (Paediatrics)', 'CH', 2, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(27, 15, 'DGO (Obst. & Gynaec)', 'GO', 4, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(28, 15, 'DLO (ENT)', 'LO', 1, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(29, 15, 'DPM (Psychiatry)', 'PM', 1, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(30, 15, 'DCP (Pathology)', 'CP', 4, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(31, 15, 'DMRD (Medical Radiodiagnosis)', 'DM', 3, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(32, 15, 'DVD (Skin & VD)', 'DV', 2, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(33, 8, 'Prosthodontics', 'PO', 6, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(34, 8, 'Periodontics', 'PE', 6, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(35, 8, 'Pedodontics', 'PD', 6, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(36, 8, 'Public Health Dentstry PH', 'AN', 3, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(37, 8, 'Oral Surgery', 'OS', 5, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(38, 8, 'Oral Medicine & Diagnosis', 'OD', 3, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(39, 8, 'Oralpatho', 'OP', 6, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(40, 8, 'Orthondontics', 'OT', 4, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(41, 8, 'Endo & Conservative', 'EC', 5, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(42, 9, 'Paediatrics', 'PE', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(43, 9, 'Orthopedics', 'OP', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(44, 9, 'Nerology', 'NO', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(45, 9, 'Cardio Thoracic', 'CT', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(46, 9, 'Sport Science', 'SS', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(47, 9, 'Geriatrics', 'GT', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(48, 9, 'Rehabitlation', 'RH', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(49, 9, 'Women Health', 'WH', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(50, 10, 'Psychatric', 'PS', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(51, 10, 'Community Health', 'CH', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(52, 10, 'Obstetricalgynecology', 'OG', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(53, 10, 'Medical Surgical', 'MS', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(54, 10, 'Paediatrics', 'PD', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(55, 11, 'Quality Assurance', 'QA', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(56, 11, 'Pharmasuticals', 'PH', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(57, 11, 'Pharma Techno', 'PT', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(58, 11, 'Pharmacology & Clinical Research', 'PC', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(59, 11, 'Industrial Pharmacy', 'IP', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(60, 11, 'Pharma Analysis', 'PA', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(61, 12, 'Public Health', 'PH', 50, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(63, 13, 'Cardio Vascular & Thoracic Surgery', 'CT', 5, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(64, 13, 'Neuro Surgery', 'NS', 5, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(65, 13, 'Plastic & Reconstructive Surgery', 'PR', 5, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(66, 13, 'Cardiology', 'CO', 5, 'A', 1, '2014-05-06 00:00:00', 1, '2014-05-06 00:00:00'),
(67, 16, 'AAC-2 (Medical)', 'AA', 50, 'A', 1, '2014-05-07 00:00:00', 1, '2014-05-07 00:00:00'),
(68, 16, 'AAC-3 (Medical)', 'AB', 50, 'A', 1, '2014-05-07 00:00:00', 1, '2014-05-07 00:00:00'),
(69, 16, 'AAC-4 (Medical)', 'AC', 50, 'A', 1, '2014-05-07 00:00:00', 1, '2014-05-07 00:00:00'),
(70, 16, 'OTT-2 (Medical)', 'OT', 50, 'A', 1, '2014-05-07 00:00:00', 1, '2014-05-07 00:00:00'),
(71, 16, 'MLT-2 (Medical)', 'MT', 50, 'A', 1, '2014-05-07 00:00:00', 1, '2014-05-07 00:00:00'),
(72, 16, 'Dental Mechanics (Dental)', 'DM', 50, 'A', 1, '2014-05-07 00:00:00', 1, '2014-05-07 00:00:00'),
(73, 16, 'RIT (Medical)', 'RT', 50, 'A', 1, '2014-05-07 00:00:00', 1, '2014-05-07 00:00:00'),
(74, 16, 'MLT-1 (Medical)', 'MT', 50, 'A', 1, '2014-05-07 00:00:00', 1, '2014-05-07 00:00:00'),
(75, 16, 'ACC-1 (Medical)', 'AC', 50, 'A', 1, '2014-05-07 00:00:00', 1, '2014-05-07 00:00:00'),
(76, 16, 'OTT-1 (Medical)', 'AC', 50, 'A', 1, '2014-05-07 00:00:00', 1, '2014-05-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `status` enum('A','D') NOT NULL,
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `name`, `status`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 'Admission Cell', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(2, 'Exam Section', 'A', 1, '2014-04-11 00:00:00', 1, '2014-04-11 00:00:00'),
(3, 'Hostel Department', 'A', 1, '2014-04-11 00:00:00', 1, '2014-04-11 00:00:00'),
(4, 'Student Section', 'A', 1, '2014-04-11 00:00:00', 1, '2014-04-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `entrance_exam_marks`
--

CREATE TABLE IF NOT EXISTS `entrance_exam_marks` (
  `mark_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `marks` decimal(5,2) NOT NULL,
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`mark_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `entrance_exam_marks`
--

INSERT INTO `entrance_exam_marks` (`mark_id`, `student_id`, `marks`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 6, '152.00', 1, '2014-05-08 16:29:24', 1, '2014-05-08 16:29:24'),
(2, 5, '140.00', 1, '2014-05-08 16:29:32', 1, '2014-05-08 16:29:32'),
(3, 3, '204.00', 1, '2014-05-08 16:29:37', 1, '2014-05-08 16:29:37'),
(4, 1, '142.00', 1, '2014-05-08 16:29:42', 1, '2014-05-08 16:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `exam_centers`
--

CREATE TABLE IF NOT EXISTS `exam_centers` (
  `center_id` int(11) NOT NULL AUTO_INCREMENT,
  `degree` enum('PG','UG','SS','Diploma') NOT NULL,
  `name` varchar(65) NOT NULL,
  `code` varchar(5) NOT NULL,
  `address` text,
  `status` enum('A','D') NOT NULL DEFAULT 'A',
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`center_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `exam_centers`
--

INSERT INTO `exam_centers` (`center_id`, `degree`, `name`, `code`, `address`, `status`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 'UG', 'Vadodara', '1000', 'Suamandeep Vidyapeeth University\nAt & Po Pipariya,\nTa. Waghodia,\nDist. Vadodara-391760 (Gujarat) India', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(2, 'UG', 'New Delhi', '2000', NULL, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(3, 'UG', 'Mumbai', '3000', NULL, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(4, 'UG', 'Jaipur', '4000', NULL, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(5, 'UG', 'Indore', '5000', NULL, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(6, 'UG', 'Banglore', '6000', NULL, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(7, 'PG', 'Vadodara', '1000', 'Suamandeep Vidyapeeth University\r\nAt & Po Pipariya,\r\nTa. Waghodia,\r\nDist. Vadodara-391760 (Gujarat) India', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(8, 'PG', 'New Delhi', '2000', NULL, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(9, 'PG', 'Mumbai', '3000', NULL, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(10, 'SS', 'Vadodara', '1000', 'Suamandeep Vidyapeeth University\r\nAt & Po Pipariya,\r\nTa. Waghodia,\r\nDist. Vadodara-391760 (Gujarat) India', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(11, 'Diploma', 'Vadodara', '1000', 'Suamandeep Vidyapeeth University\r\nAt & Po Pipariya,\r\nTa. Waghodia,\r\nDist. Vadodara-391760 (Gujarat) India', 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(12, 'Diploma', 'New Delhi', '2000', NULL, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00'),
(13, 'Diploma', 'Mumbai', '3000', NULL, 'A', 1, '2014-04-10 00:00:00', 1, '2014-04-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_basic_info`
--

CREATE TABLE IF NOT EXISTS `student_basic_info` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `admission_id` int(11) NOT NULL,
  `degree` enum('PG_OTHER','PG','UG','SS','Diploma','Certificate') NOT NULL DEFAULT 'UG',
  `form_number` varchar(16) NOT NULL,
  `course_id` int(11) NOT NULL,
  `firstname` varchar(65) NOT NULL,
  `middlename` varchar(65) DEFAULT NULL,
  `lastname` varchar(65) NOT NULL,
  `address` text NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `mobile_p` varchar(10) NOT NULL,
  `mobile_s` varchar(10) NOT NULL,
  `gender` enum('M','F','O') NOT NULL,
  `email_p` varchar(65) NOT NULL,
  `email_s` varchar(65) NOT NULL,
  `parent_1` varchar(65) NOT NULL,
  `parent_1_occupation` varchar(65) NOT NULL,
  `parent_2` varchar(65) NOT NULL,
  `dob` date NOT NULL,
  `marital_status` enum('M','U') NOT NULL,
  `nationality` varchar(65) NOT NULL,
  `religion` varchar(65) NOT NULL,
  `community` varchar(65) DEFAULT NULL,
  `category` varchar(65) DEFAULT NULL,
  `hostel` enum('Y','N') NOT NULL DEFAULT 'N',
  `transoprt` enum('Y','N') NOT NULL DEFAULT 'N',
  `status` int(11) NOT NULL DEFAULT '1',
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `form_number` (`form_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `student_basic_info`
--

INSERT INTO `student_basic_info` (`student_id`, `admission_id`, `degree`, `form_number`, `course_id`, `firstname`, `middlename`, `lastname`, `address`, `pincode`, `mobile_p`, `mobile_s`, `gender`, `email_p`, `email_s`, `parent_1`, `parent_1_occupation`, `parent_2`, `dob`, `marital_status`, `nationality`, `religion`, `community`, `category`, `hostel`, `transoprt`, `status`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 1, 'UG', '1405MS08SV00001', 1, 'MBBS  2', 'MBBS 3', 'MBBS 1', 'asa', '396852', '9638527410', '9638527410', 'M', 'x@x.com', 'x@x.com', 'Chandubhai R. Rana', 'Service', 'Muntazben Rana', '1990-09-19', 'U', 'Indian', 'Muslim', 'Moleslamgarasiya', 'General', 'N', 'N', 4, 1, '2014-05-08 10:15:41', 1, '2014-05-09 12:40:47'),
(2, 3, 'PG_OTHER', '1405MT08SV00002', 9, 'MPT 1', 'MPT 1', 'MPT 1', 'AA', '390016', '9638527410', '9638527410', 'M', 'x@x.com', 'x@x.com', 'Chandubhai R. Rana', 'Service', 'Muntazben Rana', '1990-09-19', 'U', 'Indian', 'Muslim', 'Moleslamgarasiya', 'Other', 'N', 'N', 5, 1, '2014-05-08 15:29:33', 1, '2014-05-09 11:08:13'),
(3, 3, 'PG', '1405DS08SV00003', 7, 'MD 1', 'MD 1', 'MD 1', 'dsd', '390016', '9638527410', '9638527410', 'F', 'x@x.com', 'x@x.com', 'Chandubhai R. Rana', 'Service', 'Muntazben Rana', '1990-09-19', 'M', 'Indian', 'Muslim', 'Moleslamgarasiya', 'General', 'N', 'N', 3, 1, '2014-05-08 11:21:54', 1, '2014-05-08 15:31:30'),
(5, 3, 'SS', '1405SS08SV00004', 13, 'SS', 'SS', 'SS', 'AA', '390016', '9638527410', '9638527410', 'F', 'x@x.com', 'x@x.com', 'Chandubhai R. Rana', 'Service', 'Muntazben Rana', '1990-09-19', 'M', 'Indian', 'Muslim', 'Moleslamgarasiya', 'SEBC', 'Y', 'Y', 4, 1, '2014-05-08 11:45:17', 1, '2014-05-09 10:07:01'),
(6, 3, 'Diploma', '1405DP08SV00005', 15, 'Diploma', 'D', 'D', 'aa', '390016', '9638527410', '9638527410', 'F', 'x@x.com', 'x@x.com', 'Chandubhai R. Rana', 'Service', 'Muntazben Rana', '1990-09-19', 'M', 'Indian', 'Muslim', 'Moleslamgarasiya', 'ST', 'N', 'N', 3, 1, '2014-05-08 11:47:59', 1, '2014-05-08 11:47:59'),
(7, 3, 'Certificate', '1405CC08SV00006', 16, 'CC', 'CC', 'CC', 'aa', '390016', '9638527410', '9638527410', 'F', 'x@x.com', 'x@x.com', 'Chandubhai R. Rana', 'Service', 'Muntazben Rana', '1990-09-19', 'M', 'Indian', 'Muslim', 'Moleslamgarasiya', 'ST', 'N', 'N', 3, 1, '2014-05-08 11:52:42', 1, '2014-05-08 11:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `student_basic_pg_details`
--

CREATE TABLE IF NOT EXISTS `student_basic_pg_details` (
  `student_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `hallticket` int(10) NOT NULL,
  `course_special_id` int(11) NOT NULL DEFAULT '0',
  `preference_1` int(11) NOT NULL DEFAULT '0',
  `preference_2` int(11) NOT NULL DEFAULT '0',
  `preference_3` int(11) NOT NULL DEFAULT '0',
  `center_pref_1` int(11) NOT NULL DEFAULT '0',
  `center_pref_2` int(11) NOT NULL DEFAULT '0',
  `center_pref_3` int(11) NOT NULL DEFAULT '0',
  `rotational_intership` enum('Y','N') NOT NULL DEFAULT 'N',
  `intership_date` date DEFAULT NULL,
  `register_mci_dci` enum('Y','N') NOT NULL DEFAULT 'N',
  `reg_no` varchar(25) DEFAULT NULL,
  `reg_date` date DEFAULT NULL,
  `past_college` varchar(100) DEFAULT NULL,
  `past_university` varchar(100) DEFAULT NULL,
  `college_mci_dci` enum('Y','N') NOT NULL DEFAULT 'N',
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`student_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `student_basic_pg_details`
--

INSERT INTO `student_basic_pg_details` (`student_detail_id`, `student_id`, `hallticket`, `course_special_id`, `preference_1`, `preference_2`, `preference_3`, `center_pref_1`, `center_pref_2`, `center_pref_3`, `rotational_intership`, `intership_date`, `register_mci_dci`, `reg_no`, `reg_date`, `past_college`, `past_university`, `college_mci_dci`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 3, 20141001, 0, 6, 4, 2, 7, 8, 9, 'Y', '1991-01-16', 'Y', '1q2w3e', '2001-01-30', 'SBKS', 'SVU', 'Y', 1, '2014-05-08 11:21:54', 1, '2014-05-08 15:31:31'),
(3, 5, 20142001, 63, 63, 66, 64, 10, 10, 10, 'N', NULL, 'N', NULL, NULL, NULL, NULL, 'N', 1, '2014-05-08 11:45:17', 1, '2014-05-08 11:45:17'),
(4, 6, 20143001, 0, 31, 30, 30, 11, 12, 13, 'N', NULL, 'N', NULL, NULL, NULL, NULL, 'N', 1, '2014-05-08 11:47:59', 1, '2014-05-08 11:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `student_basic_pg_other_details`
--

CREATE TABLE IF NOT EXISTS `student_basic_pg_other_details` (
  `student_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `preference_1` int(11) NOT NULL DEFAULT '0',
  `preference_2` int(11) NOT NULL DEFAULT '0',
  `preference_3` int(11) NOT NULL DEFAULT '0',
  `course_special_id` int(11) DEFAULT '0',
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`student_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `student_basic_pg_other_details`
--

INSERT INTO `student_basic_pg_other_details` (`student_detail_id`, `student_id`, `preference_1`, `preference_2`, `preference_3`, `course_special_id`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 2, 49, 47, 45, 49, 1, '2014-05-08 10:18:24', 1, '2014-05-08 10:18:24'),
(2, 7, 76, 74, 72, 76, 1, '2014-05-08 11:52:42', 1, '2014-05-08 11:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `student_basic_ug_details`
--

CREATE TABLE IF NOT EXISTS `student_basic_ug_details` (
  `student_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `hallticket` int(10) NOT NULL,
  `center_pref_1` int(11) NOT NULL DEFAULT '0',
  `center_pref_2` int(11) NOT NULL DEFAULT '0',
  `center_pref_3` int(11) NOT NULL DEFAULT '0',
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`student_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `student_basic_ug_details`
--

INSERT INTO `student_basic_ug_details` (`student_detail_id`, `student_id`, `hallticket`, `center_pref_1`, `center_pref_2`, `center_pref_3`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 1, 20141001, 1, 2, 3, 1, '2014-05-08 10:15:41', 1, '2014-05-08 10:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `student_edu_details`
--

CREATE TABLE IF NOT EXISTS `student_edu_details` (
  `edu_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `edu_master_id` int(11) NOT NULL,
  `subject` varchar(25) NOT NULL,
  `theory_min_mark` int(3) NOT NULL DEFAULT '0',
  `theory_max_mark` int(3) NOT NULL DEFAULT '0',
  `pratical_min_mark` int(3) NOT NULL DEFAULT '0',
  `pratical_max_mark` int(3) NOT NULL DEFAULT '0',
  `total_min_mark` int(4) NOT NULL DEFAULT '0',
  `total_max_mark` int(4) NOT NULL DEFAULT '0',
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`edu_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `student_edu_details`
--

INSERT INTO `student_edu_details` (`edu_detail_id`, `edu_master_id`, `subject`, `theory_min_mark`, `theory_max_mark`, `pratical_min_mark`, `pratical_max_mark`, `total_min_mark`, `total_max_mark`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 2, 'Physics', 56, 70, 65, 70, 121, 140, 1, '2014-05-08 17:11:59', 1, '2014-05-08 17:11:59'),
(2, 2, 'Chemistry', 69, 70, 52, 70, 121, 140, 1, '2014-05-08 17:11:59', 1, '2014-05-08 17:11:59'),
(3, 2, 'Biology', 55, 70, 50, 70, 105, 140, 1, '2014-05-08 17:11:59', 1, '2014-05-08 17:11:59'),
(4, 2, 'Mathematics', 0, 0, 0, 0, 0, 0, 1, '2014-05-08 17:11:59', 1, '2014-05-08 17:11:59'),
(5, 2, 'English', 68, 70, 0, 0, 68, 70, 1, '2014-05-08 17:12:00', 1, '2014-05-08 17:12:00'),
(6, 2, 'Computer Science', 0, 0, 0, 0, 0, 0, 1, '2014-05-08 17:12:00', 1, '2014-05-08 17:12:00'),
(7, 2, 'Others', 0, 0, 0, 0, 0, 0, 1, '2014-05-08 17:12:00', 1, '2014-05-08 17:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_edu_master`
--

CREATE TABLE IF NOT EXISTS `student_edu_master` (
  `edu_master_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course` varchar(15) NOT NULL,
  `year` int(4) NOT NULL,
  `uni_institute` varchar(50) NOT NULL,
  `board` varchar(25) NOT NULL,
  `pcb_percentage` decimal(4,2) NOT NULL DEFAULT '0.00',
  `pcbe_percentage` decimal(4,2) NOT NULL DEFAULT '0.00',
  `total_percentage` decimal(4,2) DEFAULT NULL,
  `rank` varchar(5) DEFAULT NULL,
  `result_wating` enum('Y','N') NOT NULL DEFAULT 'N',
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`edu_master_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `student_edu_master`
--

INSERT INTO `student_edu_master` (`edu_master_id`, `student_id`, `course`, `year`, `uni_institute`, `board`, `pcb_percentage`, `pcbe_percentage`, `total_percentage`, `rank`, `result_wating`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 1, 'S.S.C', 2008, 'qq', 'qq', '0.00', '0.00', '68.00', '1', 'N', 1, '2014-05-08 13:18:03', 1, '2014-05-08 17:11:59'),
(2, 1, 'H.S.C', 2010, 'qq', 'qq', '54.00', '55.00', '60.00', '1', 'N', 1, '2014-05-08 13:18:03', 1, '2014-05-08 17:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `student_edu_pg`
--

CREATE TABLE IF NOT EXISTS `student_edu_pg` (
  `pg_edu_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `exam` varchar(25) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `attempt` int(2) NOT NULL,
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`pg_edu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `student_edu_pg`
--

INSERT INTO `student_edu_pg` (`pg_edu_id`, `student_id`, `exam`, `month`, `year`, `percentage`, `attempt`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 3, '4', 1, 2013, '56.00', 3, 1, '2014-05-08 16:12:42', 1, '2014-05-08 16:12:42'),
(2, 3, '3', 1, 2011, '15.00', 1, 1, '2014-05-08 16:12:43', 1, '2014-05-08 16:12:43'),
(3, 3, '2', 1, 2014, '56.00', 2, 1, '2014-05-08 16:12:43', 1, '2014-05-08 16:12:43'),
(4, 3, '1', 1, 2014, '50.00', 1, 1, '2014-05-08 16:12:43', 1, '2014-05-08 16:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `student_edu_pg_other`
--

CREATE TABLE IF NOT EXISTS `student_edu_pg_other` (
  `pg_other_edu_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course` varchar(15) NOT NULL,
  `year` int(4) NOT NULL,
  `uni_institute` varchar(50) NOT NULL,
  `board` varchar(25) NOT NULL,
  `total_percentage` decimal(4,2) DEFAULT NULL,
  `rank` varchar(5) DEFAULT NULL,
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`pg_other_edu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `student_edu_pg_other`
--

INSERT INTO `student_edu_pg_other` (`pg_other_edu_id`, `student_id`, `course`, `year`, `uni_institute`, `board`, `total_percentage`, `rank`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 2, 'Temp', 2006, 'qq', 'qq', '50.00', '1', 1, '2014-05-08 15:29:47', 1, '2014-05-08 15:29:47'),
(2, 2, 'Temp 1', 2006, 'qq', 'qq', '50.00', '1', 1, '2014-05-08 15:29:47', 1, '2014-05-08 15:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `student_foregin_details`
--

CREATE TABLE IF NOT EXISTS `student_foregin_details` (
  `foregin_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `detail_pp` text NOT NULL,
  `passport_no` varchar(100) NOT NULL,
  `country` varchar(65) NOT NULL,
  `issue` varchar(65) NOT NULL,
  `expire_date` date NOT NULL,
  `visa_type` enum('S','T','O') NOT NULL DEFAULT 'O',
  `aids_dearance` enum('Y','N') NOT NULL DEFAULT 'N',
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`foregin_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `student_foregin_details`
--

INSERT INTO `student_foregin_details` (`foregin_detail_id`, `student_id`, `detail_pp`, `passport_no`, `country`, `issue`, `expire_date`, `visa_type`, `aids_dearance`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 1, 'q', 'q', 'q', 'q', '2014-05-07', 'T', 'N', 1, '2014-05-08 13:20:57', 1, '2014-05-08 13:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `student_language`
--

CREATE TABLE IF NOT EXISTS `student_language` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'q',
  `student_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `reading` enum('Y','N') NOT NULL DEFAULT 'Y',
  `speaking` enum('Y','N') NOT NULL DEFAULT 'Y',
  `writing` enum('Y','N') NOT NULL DEFAULT 'Y',
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `student_language`
--

INSERT INTO `student_language` (`language_id`, `student_id`, `name`, `reading`, `speaking`, `writing`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 1, 'eng', 'Y', 'Y', 'Y', 1, '2014-05-08 13:19:44', 1, '2014-05-08 13:19:44'),
(2, 1, 'gujarati', 'Y', 'Y', 'N', 1, '2014-05-08 13:19:44', 1, '2014-05-08 13:19:44'),
(3, 2, 'tamil', 'Y', 'Y', 'N', 1, '2014-05-08 15:30:09', 1, '2014-05-08 15:30:09'),
(4, 2, 'eng', 'Y', 'Y', 'Y', 1, '2014-05-08 15:30:09', 1, '2014-05-08 15:30:09'),
(5, 3, 'qq', 'Y', 'Y', 'Y', 1, '2014-05-08 16:13:05', 1, '2014-05-08 16:13:05'),
(6, 3, 'ww', 'Y', 'Y', 'N', 1, '2014-05-08 16:13:05', 1, '2014-05-08 16:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `student_payment_info`
--

CREATE TABLE IF NOT EXISTS `student_payment_info` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `mode` enum('CS','DD','CH') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `ch_dd_number` int(25) DEFAULT NULL,
  `name_bank` varchar(65) DEFAULT NULL,
  `create_id` int(11) NOT NULL,
  `create_date_time` date NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` date NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `studnet_images`
--

CREATE TABLE IF NOT EXISTS `studnet_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `student_image` varchar(65) DEFAULT NULL,
  `sign` varchar(65) DEFAULT NULL,
  `ssc_marksheet` varchar(65) DEFAULT NULL,
  `hsc_marksheet` varchar(65) DEFAULT NULL,
  `migration_certificate` varchar(65) DEFAULT NULL,
  `leaving_certificate` varchar(65) DEFAULT NULL,
  `cast_certificate` varchar(65) DEFAULT NULL,
  `aids_certificate` varchar(65) DEFAULT NULL,
  `create_id` int(11) NOT NULL,
  `create_date_time` datetime NOT NULL,
  `modify_id` int(11) NOT NULL,
  `modify_date_time` datetime NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `studnet_images`
--

INSERT INTO `studnet_images` (`image_id`, `student_id`, `student_image`, `sign`, `ssc_marksheet`, `hsc_marksheet`, `migration_certificate`, `leaving_certificate`, `cast_certificate`, `aids_certificate`, `create_id`, `create_date_time`, `modify_id`, `modify_date_time`) VALUES
(1, 1, '25ce15b45f9329cf0aebd9f2d8b88298.jpg', '56f970a5f6ead8b22669f3bddcee943d.jpg', '1163b723f6e5467a98b49a341e04ee69.jpg', NULL, NULL, NULL, NULL, NULL, 1, '2014-05-08 13:42:25', 1, '2014-05-08 13:42:25'),
(2, 2, 'e9eb5d7adf7f711b0c4424d4a0b182e3.jpg', '68793aab45c51e9b3b5e69aca408d1a9.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-05-08 15:31:14', 1, '2014-05-08 15:31:14'),
(3, 3, '60231f2a0ecd8c0a83e0410592f2c302.jpg', 'ffd4e760dffc6d8584322cb1a45948fa.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-05-08 16:14:49', 1, '2014-05-08 16:14:49');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
