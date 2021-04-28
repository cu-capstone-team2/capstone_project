-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2021 at 12:04 AM
-- Server version: 5.1.73-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cs01`
--
CREATE DATABASE IF NOT EXISTS `cs01` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cs01`;

-- --------------------------------------------------------

--
-- Table structure for table `Apply`
--

CREATE TABLE `Apply` (
  `apply_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `major_id` int(11) NOT NULL,
  `date_requested` date NOT NULL,
  `is_Completed` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Apply`
--

INSERT INTO `Apply` (`apply_id`, `first_name`, `last_name`, `email`, `major_id`, `date_requested`, `is_Completed`) VALUES
(8, 'Elias', 'Proctor', 'elias.proctor@cameron.edu', 1, '2021-03-10', b'1'),
(15, 'Mike', 'Baker', 'mike.baker@cameron.edu', 3, '2021-03-23', b'1'),
(16, 'Bob', 'Hoover', 'rc938758@cameron.edu', 3, '2021-03-23', b'1'),
(18, 'Brett', 'Smith', 'brett.smith@outlook.com', 3, '2021-03-31', b'1'),
(27, 'Barack', 'Obama', 'bo@gmail.com', 5, '2021-04-08', b'1'),
(28, 'Bean', 'Burrito', 'beanburrito@gmail.com', 1, '2021-04-10', b'1'),
(30, 'Ryan', 'Pierce', 'rp932334@cameron.edu', 1, '2021-04-13', b'1'),
(31, 'Ezekial', 'Parker', 'ep943087@cameron.edu', 1, '2021-04-13', b'1'),
(36, 'Jonah', 'Hull', 'rp932334@cameron.edu', 2, '2021-04-14', b'1'),
(37, 'Jonah', 'Hill', 'rp932334@cameron.edu', 2, '2021-04-15', b'1'),
(38, 'Jonah', 'Hill', 'rp932334@cameron.edu', 2, '2021-04-15', b'1'),
(39, 'Kayla', 'Snyder', 'test@gmail.com', 1, '2021-04-17', b'1'),
(40, 'Becca', 'Smith', 'Smith@gmail.com', 20, '2021-04-17', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `Appointment`
--

CREATE TABLE `Appointment` (
  `appointment_id` int(11) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `is_finished` bit(1) NOT NULL DEFAULT b'0',
  `appointment_date` date NOT NULL,
  `student_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `time_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Appointment`
--

INSERT INTO `Appointment` (`appointment_id`, `comments`, `is_finished`, `appointment_date`, `student_id`, `faculty_id`, `time_id`) VALUES
(1, '', b'1', '2021-03-01', 3, 4, 5),
(2, '', b'1', '2021-03-02', 1, 4, 5),
(3, '', b'1', '2021-03-02', 3, 4, 5),
(4, 'VIA Zoom', b'1', '2021-03-30', 6, 4, 6),
(5, 'VIA Zoom', b'1', '2021-04-01', 3, 4, 20),
(7, 'VIA Zoom', b'1', '2021-04-20', 1, 4, 21),
(11, '', b'1', '2021-08-08', 12, 4, 5),
(12, 'via zoom', b'1', '2021-03-31', 3, 4, 21),
(15, 'VIA Zoom', b'1', '2021-03-27', 3, 4, 18),
(17, 'In Person', b'1', '2021-04-09', 1, 4, 17),
(19, 'Do something before hand.', b'1', '2021-04-30', 1, 4, 6),
(23, '', b'1', '2021-04-30', 31, 4, 17),
(24, '', b'1', '2021-04-23', 31, 4, 18),
(27, 'Final credits', b'0', '2021-04-15', 29, 27, 17),
(34, 'Via Zoom', b'1', '2021-04-28', 1, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `Class`
--

CREATE TABLE `Class` (
  `class_id` int(11) NOT NULL,
  `days` char(4) NOT NULL,
  `minutes` int(11) NOT NULL,
  `time_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Class`
--

INSERT INTO `Class` (`class_id`, `days`, `minutes`, `time_id`, `room_id`, `course_id`, `faculty_id`) VALUES
(1, 'MW', 75, 7, 13, 2, 11),
(2, 'MTWR', 75, 7, 22, 4, 14),
(3, 'MTWR', 55, 1, 19, 12, 4),
(4, 'MW', 75, 7, 21, 13, 17),
(5, 'T', 90, 7, 3, 10, 3),
(6, 'F', 90, 3, 15, 9, 4),
(7, 'S', 75, 7, 15, 7, 7),
(8, 'MW', 75, 1, 15, 14, 14),
(9, 'WRF', 75, 4, 15, 11, 4),
(10, 'MW', 55, 4, 21, 3, 10),
(14, 'MTWR', 75, 13, 20, 11, 12),
(15, 'MW', 55, 13, 16, 15, 4),
(20, 'TR', 75, 1, 17, 14, 14),
(21, 'MTWR', 75, 1, 21, 2, 15),
(22, 'F', 75, 7, 15, 9, 15),
(24, 'TR', 55, 9, 17, 4, 10),
(25, 'TR', 55, 1, 18, 4, 10),
(26, 'MTWR', 75, 4, 19, 6, 14),
(27, 'MTWR', 75, 9, 22, 2, 11),
(28, 'TR', 55, 7, 15, 3, 7),
(29, 'TR', 75, 9, 14, 5, 6),
(30, 'MW', 55, 1, 16, 24, 9),
(31, 'MR', 75, 9, 19, 8, 9),
(33, 'MTWR', 75, 1, 22, 20, 11),
(35, 'MW', 75, 1, 3, 28, 36);

-- --------------------------------------------------------

--
-- Table structure for table `Constants`
--

CREATE TABLE `Constants` (
  `role_instructor` int(11) NOT NULL,
  `role_secretary` int(11) NOT NULL,
  `role_admin` int(11) NOT NULL,
  `role_chair` int(11) NOT NULL,
  `room_office` int(11) NOT NULL,
  `room_class` int(11) NOT NULL,
  `time_appointment` int(11) NOT NULL,
  `time_class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Constants`
--

INSERT INTO `Constants` (`role_instructor`, `role_secretary`, `role_admin`, `role_chair`, `room_office`, `room_class`, `time_appointment`, `time_class`) VALUES
(1, 2, 3, 4, 1, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Contact`
--

CREATE TABLE `Contact` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_request` date NOT NULL,
  `is_Contacted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Contact`
--

INSERT INTO `Contact` (`ID`, `first_name`, `last_name`, `email`, `message`, `date_request`, `is_Contacted`) VALUES
(1, 'Ryan', 'Cox', 'rc938758@cameron.com', 'hello, just a test', '2021-03-21', b'1'),
(6, 'Mike', 'Baker', 'mike.baker@notreal.com', 'HI', '2021-03-22', b'1'),
(7, 'Bob', 'Saget', 'bob.saget@notreal.com', 'Need more info', '2021-03-24', b'1'),
(10, 'Lyndia', 'Smith', 'lyndia.smith@yahoo.com', 'I would like to acquire a campus life information', '2021-03-31', b'0'),
(11, 'Michael', 'Jordan', 'mj@gmail.com', 'How are you today?', '2021-04-04', b'1'),
(12, 'Elias', 'Proctor', 'ep943087@cameron.edu', 'Hello world!', '2021-04-04', b'1'),
(14, 'Barack', 'Obama', 'bo@gmail.com', 'Hello world, from obama', '2021-04-08', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE `Course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `credits` int(11) NOT NULL,
  `course_number` int(11) NOT NULL,
  `major_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Course`
--

INSERT INTO `Course` (`course_id`, `course_name`, `credits`, `course_number`, `major_id`) VALUES
(1, 'Programming I', 3, 1024, 2),
(2, 'Computer Science I', 5, 1111, 1),
(3, 'Discrete Math', 3, 1523, 1),
(4, 'Data Structures', 3, 3003, 1),
(5, 'Network Programming', 3, 3013, 1),
(6, 'Database Design & Structures', 3, 3183, 1),
(7, 'Software Engineering', 4, 4204, 1),
(8, 'Intro to Info Assurance/Security', 3, 2233, 2),
(9, 'Introduction to Networking', 3, 1063, 2),
(10, 'Computer Forensics', 3, 2333, 2),
(11, 'Data Analytics', 3, 4023, 2),
(12, 'Structured Query Language', 3, 3183, 2),
(13, 'Human Computer Interface Development', 3, 3603, 2),
(14, 'Computer Science II', 4, 1524, 1),
(15, 'Algorithmn Analysis', 3, 3713, 1),
(18, 'Programming II', 4, 1414, 2),
(19, 'Calculus I', 5, 2233, 5),
(20, 'Math For Beginners', 3, 4545, 5),
(24, 'Capstone', 4, 4242, 1),
(28, 'Management Information Systems', 3, 3013, 20);

-- --------------------------------------------------------

--
-- Table structure for table `Enrollment`
--

CREATE TABLE `Enrollment` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Enrollment`
--

INSERT INTO `Enrollment` (`student_id`, `class_id`) VALUES
(1, 1),
(10, 1),
(14, 1),
(23, 1),
(8, 2),
(31, 2),
(12, 3),
(14, 3),
(12, 4),
(13, 4),
(15, 4),
(5, 5),
(11, 5),
(12, 5),
(13, 5),
(5, 6),
(12, 6),
(5, 7),
(7, 7),
(9, 7),
(11, 7),
(15, 7),
(31, 7),
(39, 7),
(1, 8),
(5, 8),
(7, 8),
(23, 8),
(1, 9),
(13, 9),
(7, 10),
(8, 10),
(10, 10),
(15, 10),
(23, 10),
(31, 10),
(31, 14),
(8, 15),
(23, 15),
(31, 20),
(39, 20),
(8, 21),
(40, 21),
(8, 22),
(14, 22),
(39, 22),
(41, 22),
(14, 24),
(39, 24),
(40, 24),
(39, 26),
(40, 26),
(41, 27),
(1, 28),
(14, 28),
(40, 28),
(41, 28);

-- --------------------------------------------------------

--
-- Table structure for table `Faculty_Staff`
--

CREATE TABLE `Faculty_Staff` (
  `faculty_id` int(11) NOT NULL,
  `faculty_firstname` varchar(50) NOT NULL,
  `faculty_lastname` varchar(50) NOT NULL,
  `faculty_email` varchar(50) NOT NULL,
  `faculty_phone` char(14) NOT NULL,
  `role` int(11) NOT NULL,
  `faculty_username` varchar(100) NOT NULL,
  `faculty_password` varchar(255) NOT NULL,
  `faculty_active` bit(1) NOT NULL DEFAULT b'1',
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Faculty_Staff`
--

INSERT INTO `Faculty_Staff` (`faculty_id`, `faculty_firstname`, `faculty_lastname`, `faculty_email`, `faculty_phone`, `role`, `faculty_username`, `faculty_password`, `faculty_active`, `room_id`) VALUES
(1, 'Elias', 'Proctor', 'ep943087@cameron.edu', '580-704-0803', 3, 'admin1', '$2y$10$Ss.41yYVvLTL89LjSfxZDO5lEv68UWw8GqxM5b/YDNUzKLSoLkSfq', b'1', 1),
(3, 'Robert', 'Alden', 'ep943087@cameron.edu', '555-555-5555', 4, 'chair1', '$2y$10$DZBWwyhBk435RnW.5ipSG.JEnqMbH5Sz/NQnzJewaW0Q0PUhy4GSy', b'1', 1),
(4, 'Ryan', 'Cox', 'ep943087@cameron.edu', '555-555-5555', 1, 'instructor1', '$2y$10$/AqF1lCBMoDf30BuyuQcBeGPrGJl5ccXeEdM4oqPIwaKGpItitKoK', b'1', 1),
(6, 'Muhammad', 'Javed', 'mjaved@cameron.edu', '580-581-2335', 1, 'mjaved', '\'\'', b'1', 1),
(7, 'Mike', 'Estep', 'mestep@cameron.edu', '580-581-2846', 1, 'mestep', '\'\'', b'1', 2),
(9, 'Abbas', 'Johari', 'abbasj@cameron.edu', '580-581-2540', 1, 'ajohari', '\'\'', b'1', 1),
(10, 'Chao', 'Zhao', 'chaoz@cameron.edu', '580-581-2907', 1, 'czhao', '\'\'', b'1', 2),
(11, 'Jawad', 'Drissi', 'jdrissi@cameron.edu', '580-581-7935', 1, 'jawaddrissi11', '\'\'', b'1', 1),
(12, 'Feridoon', 'Moinian', 'feridoon@cameron.edu', '580-581-2489', 1, 'fmoinian', '\'\'', b'1', 1),
(13, 'Teresa', 'Hickerson', 'thickers@cameron.edu', '580-581-8094', 1, 'thickerson', '\'\'', b'1', 6),
(14, 'David', 'Smith', 'davids@cameron.edu', '580-581-2850', 1, 'dsmith', '\'\'', b'1', 5),
(15, 'Harry', 'Kimberling', 'hkimberling@cameron.edu', '580-581-7934', 1, 'hkimberling', '\'\'', b'1', 7),
(16, 'Walter', 'Lentz', 'wlentz@cameron.edu', '580-581-2335', 1, 'wlentz', '\'\'', b'1', 4),
(17, 'Elizabeth', 'Mattson', 'emattson@cameron.edu', '580-581-2335', 1, 'emattson', '\'\'', b'1', 8),
(18, 'Rachel', 'Redus', 'rredus@cameron.edu', '580-581-2335', 2, 'secretary1', '$2y$10$gHXu/8BpZxHnx268kuffyOIpx92ZNSmo/YeLgCj55F3Gy.kASY0G6', b'1', 2),
(27, 'Joe', 'Rogan', 'rc938758@cameron.edu', '555-555-5555', 1, 'joerogan27', '$2y$10$fID4yAMg8U8UE4zeRS/FMOwh6ejX3ARwYcuC5b9zs796tuBzsEM4K', b'1', 10),
(29, 'Lorena', 'Parker', 'ep943087@cameron.edu', '555-555-5555', 1, 'lorenaparker29', '$2y$10$JOjU2/VZN.EwBNi/gumIi.cXIBhGBfYxyMuWECFAJTgEaJr4fjS6a', b'1', 9),
(30, 'Kevin', 'Durant', 'kevindurant@gmail.com', '555-555-5555', 2, 'kevindurant30', '$2y$10$EXBZfDvn/pKok/25x7AH2Odm5JBRcJHuG7qcpYF1XhmKmd74a6kJq', b'0', 11),
(32, 'James', 'Ferguson', 'jf@cameron.edu', '580-777-2222', 1, 'jamesferguson32', '$2y$10$8Ga2R76hwKafUcpOfMgKG.eHRrXyHIDSwqdWiZ9iU8cZmasZZvGPG', b'1', 12),
(36, 'Ava', 'Klement', 'rp932334@cameron.edu', '555-555-5555', 1, 'avaklement36', '$2y$10$3PWTy3KhOFwzBOVwo9bsTuFiM8AfLTQXWf4jA9oqgrsjmfTZL7jWO', b'1', 12);

-- --------------------------------------------------------

--
-- Table structure for table `Major`
--

CREATE TABLE `Major` (
  `major_id` int(11) NOT NULL,
  `major_name` varchar(50) NOT NULL,
  `short_name` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Major`
--

INSERT INTO `Major` (`major_id`, `major_name`, `short_name`) VALUES
(1, 'Computer Science', 'CS'),
(2, 'Information Technology', 'IT'),
(3, 'Info Assurance Security ', 'IAS'),
(5, 'Mathematical Sciences', 'MATH'),
(20, 'Management Information Systems', 'MIS'),
(22, 'Biology', 'BIO');

-- --------------------------------------------------------

--
-- Table structure for table `Numbers`
--

CREATE TABLE `Numbers` (
  `number` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Numbers`
--

INSERT INTO `Numbers` (`number`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

-- --------------------------------------------------------

--
-- Table structure for table `Reset_Password`
--

CREATE TABLE `Reset_Password` (
  `password_key` char(50) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `is_student` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Reset_Password`
--

INSERT INTO `Reset_Password` (`password_key`, `student_id`, `faculty_id`, `is_student`) VALUES
('kducLCh34BGBqYCEkOjB0ZukSUmOHqdURJGaivAfmFCua7anSC', 1, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `Room`
--

CREATE TABLE `Room` (
  `room_id` int(11) NOT NULL,
  `room_number` varchar(4) NOT NULL,
  `room_type` int(11) NOT NULL,
  `building` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Room`
--

INSERT INTO `Room` (`room_id`, `room_number`, `room_type`, `building`) VALUES
(1, '203A', 1, 'Howell Hall'),
(2, '104C', 1, 'Howell Hall'),
(3, '206', 2, 'Howell Hall'),
(4, '212A', 1, 'Howell Hall'),
(5, '216E', 1, 'Howell Hall'),
(6, '104D', 1, 'Howell Hall'),
(7, '212B', 1, 'Howell Hall'),
(8, '203C', 1, 'Howell Hall'),
(9, '212C', 1, 'Howell Hall'),
(10, '104E', 1, 'Howell Hall'),
(11, '203D', 1, 'Howell Hall'),
(12, '104', 1, 'Howell Hall'),
(13, '107', 2, 'Howell Hall'),
(14, '207', 2, 'Howell Hall'),
(15, '201N', 2, 'Howell Hall'),
(16, '213', 2, 'Howell Hall'),
(17, '204', 2, 'Howell Hall'),
(18, '101', 2, 'Howell Hall'),
(19, '108', 2, 'Howell Hall'),
(20, '205', 2, 'Howell Hall'),
(21, '209', 2, 'Howell Hall'),
(22, '102', 2, 'Howell Hall');

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `student_id` int(11) NOT NULL,
  `student_firstname` varchar(50) NOT NULL,
  `student_lastname` varchar(50) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `classification` varchar(9) NOT NULL,
  `PIN` int(11) NOT NULL,
  `student_username` varchar(100) NOT NULL,
  `student_password` varchar(255) NOT NULL,
  `student_active` bit(1) NOT NULL DEFAULT b'1',
  `major_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`student_id`, `student_firstname`, `student_lastname`, `student_email`, `classification`, `PIN`, `student_username`, `student_password`, `student_active`, `major_id`, `faculty_id`) VALUES
(1, 'Kadar', 'Lamsal', 'ep943087@cameron.edu', 'senior', 1837, 'student1', '$2y$10$6rMUW2NwOO.olFpkTN.vYOi2ubomMM4rKBjL9H1Dnn5ddNHpFEttK', b'1', 1, 4),
(3, 'Cynthia', 'Dy', 'cynthiady@cameron.edu', 'sophomore', 1526, 'cynthiady', '\'\'', b'0', 2, 6),
(4, 'Ryan', 'Cox', 'ryancox@cameron.edu', 'sophmore', 1123, 'ryancox', '\'\'', b'0', 2, 27),
(5, 'Ryan', 'Pierce', 'ryanpierce@cameron.edu', 'senior', 1645, 'ryanpierce5', '\'\'', b'1', 1, 27),
(6, 'Robert', 'Alden', 'robertalden@cameron.edu', 'sophomore', 1985, 'robertalden6', '\'\'', b'1', 3, 13),
(7, 'Kayla', 'Snyder', 'kaylasnyder@cameron.edu', 'senior', 1647, 'kaylasnyder7', '\'\'', b'1', 2, 10),
(8, 'Michael', 'Argyros', 'michaelargyros@cameron.edu', 'senior', 1775, 'michaelargyros8', '\'\'', b'1', 5, 11),
(9, 'Christian', 'Cost', 'christiancost@cameron.edu', 'junior', 7486, 'christiancost9', '\'\'', b'1', 1, 11),
(10, 'Matthew', 'Dean', 'matthewdean@cameron.edu', 'junior', 1221, 'matthewdean10', '\'\'', b'1', 1, 15),
(11, 'Gabriella', 'Moore', 'gabriellamoore@cameron.edu', 'sophomore', 7945, 'gabriellamoore11', '\'\'', b'1', 2, 6),
(12, 'Jacob', 'Dunn', 'jacobdunn@cameron.edu', 'junior', 9985, 'jacobdunn12', '\'\'', b'1', 2, 14),
(13, 'Daniella', 'Salas', 'daniellasalas@cameron.edu', 'sophomore', 4652, 'daniellasalas13', '\'\'', b'1', 2, 9),
(14, 'Zane', 'Gaines', 'zanegaines@cameron.edu', 'senior', 6545, 'zanegaines14', '\'\'', b'1', 1, 7),
(15, 'Sophia', 'Montes', 'sophiamontes@cameron.edu', 'sophomore', 7998, 'sophiamontes15', '\'\'', b'1', 1, 10),
(20, 'Ray', 'Pierce', 'raypierce@cameron.edu', 'junior', 6422, 'raypierce20', '$2y$10$qnBVMInwWO/eraLiqcJsWe2ZdsmXHK9avMtCzytl1M6vwda6g86Fa', b'1', 2, 17),
(22, 'Ryan', 'Young', 'rp932334@cameron.edu', 'junior', 1137, 'ryanyoung22', '$2y$10$aCOTPJwNX2HXZRyiUyWu5eDDIN1RjHj5cSDo875qg8zUlTl5hrYTS', b'1', 3, 7),
(23, 'Elijah', 'Proctor', 'elijahred23@gmail.com', 'senior', 1259, 'elijahproctor23', '$2y$10$WDLLlSi/GylBv03GdlfKhO9cT8i29.pB7mBLAQ5GGNvJrXwy.GyCu', b'1', 1, 12),
(29, 'Ryan', 'Pierce', 'rc938758@cameron.edu', 'freshman', 5297, 'ryanpierce29', '$2y$10$vCLFw.yFtNUlyHCZMzC2N.fk8DApyzwfoZsU46DpkLHLMtUyQbKJu', b'1', 1, 27),
(30, 'Elijah', 'Proctor', 'ep943087@cameron.edu', 'freshman', 2345, 'elijahproctor30', '$2y$10$lFB1Oi55aAYi2tpNaokDSOIBuKfi2EobH1fBH94T1t0LphVGc1lHO', b'1', 1, 6),
(31, 'Bob', 'Hoover', 'rc938758@cameron.edu', 'freshman', 2457, 'bobhoover31', '$2y$10$Q9QHdKgqtiY1wiukUHZxeOoNgZlGWtyM5n0Wx.E5HsqFQ3qqypj1O', b'1', 3, 4),
(32, 'Michael', 'Jackson', 'mj@cameron.edu', 'freshman', 1762, 'michaeljackson32', '$2y$10$7TRWwMXM4/z6dGzZiIT6beTO5kr5JSOcECk6kX7MKOjGHtfr0qsBC', b'1', 1, 17),
(33, 'Brett', 'Smith', 'brett.smith@outlook.com', 'freshman', 7038, 'brettsmith33', '$2y$10$2xWzPLxGXbqeb.hR1ZeYLeGjgaR8ezN4LGk2u9GfgNOwXZLKDOefy', b'1', 3, 17),
(34, 'Hayden', 'Young', 'hyoung@cameron.edu', 'freshman', 1177, 'haydenyoung34', '$2y$10$2pmqJcz4z3O8kBy6H/2nf.AfPFICmAw6pSmtJsDgPOSLJg42cEBYS', b'1', 2, 16),
(35, 'Alyssa', 'Young', 'ayoung@cameron.edu', 'freshman', 8072, 'alyssayoung35', '$2y$10$43Sb79cE/kZTIXr49jx40uHTZJP0uuqzy7qe0Kmxej5Ztm6H8JQYW', b'1', 2, 6),
(37, 'John', 'Smith', 'john.smith@smith.inc', 'freshman', 7108, 'johnsmith37', '$2y$10$fAeXgEZCojoZw/z/gdQMYO8j.Yt73/PLa6CzU9bxwDBly.PcfLCBO', b'1', 5, 14),
(38, 'Brad', 'Pitt', 'bradpitt@cameron.edu', 'sophomore', 8858, 'bradpitt38', '$2y$10$zfsklzASxnFz/doj1WlmYuAZZQgxVqKB05ihi/c1NQW5GT9V1xA9i', b'1', 1, 12),
(39, 'Hazel', 'Brownlee', 'hazelbrownlee@gmail.com', 'freshman', 4713, 'hazelbrownlee39', '$2y$10$4wrUxnyFBCrtRLW2xJqksuEncDg2rAtj2F17OBEFZ7NrcULjRyKX2', b'1', 3, 9),
(40, 'Barack', 'Obama', 'bo@gmail.com', 'freshman', 4764, 'barackobama40', '$2y$10$DFrHfkgTmCcgyQtMsFQa8uH6J7F/Ru1Sy6FRdZwY56iMFlO2/cEHC', b'1', 1, 15),
(41, 'Henry', 'Michaels', 'beanburrito@gmail.com', 'freshman', 8437, 'henrymichaels41', '$2y$10$3u1RG2sN9gHuvzvcThw27.KVxEQgoA5Y2/OeaNn19zWW/kyWVtrEK', b'1', 1, 7),
(42, 'Jessica', 'Moine', 'ja@cameron.edu', 'junior', 6966, 'jessicamoine42', '$2y$10$PC7Q8Cx1EO97.ablB7Bu5uf9TLzAf2MVCAjeLn0q1YwQOFzmlYfQ6', b'1', 3, 15),
(43, 'Ryan', 'Pierce', 'rp932334@cameron.edu', 'freshman', 8941, 'ryanpierce43', '$2y$10$QGuZuXNeP9WISfCFxyX1eeojFpOx4QiKmnoyr/AY.AEkdEbf86/bO', b'1', 1, 16),
(44, 'Ezekial', 'Parker', 'ep943087@cameron.edu', 'freshman', 8860, 'ezekialparker44', '$2y$10$xKJNGQrMra3d2U7WeAapaOy0q0O/c5F4u1qAuMBa0Q.tu5Hf315Ra', b'0', 1, 14),
(48, 'Jonah', 'Hill', 'rp932334@cameron.edu', 'freshman', 9966, 'jonahhill48', '$2y$10$RtYauNdXUEnnVAk3OVO8F.Fi.chghPkW/XGJVU5eKqBLFi493z9Om', b'0', 2, 36),
(49, 'Sijalu', 'Paudel', 'eliasproctor23@gmail.com', 'senior', 6049, 'sijalupaudel49', '$2y$10$rXyAFHgj79PBMciaIsZXC.cvVduAMPGkeuJI/fYTiN23aKywdYPDG', b'1', 1, 29),
(50, 'Kayla', 'Snyder', 'test@gmail.com', 'freshman', 7029, 'kaylasnyder50', '$2y$10$sQvugufsW1.d4ROCfvD75uOMd8cFoHy9U1.YnZjzNduz2zyzk4hEu', b'1', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Timeslot`
--

CREATE TABLE `Timeslot` (
  `time_id` int(11) NOT NULL,
  `time_type` int(11) NOT NULL,
  `time_` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Timeslot`
--

INSERT INTO `Timeslot` (`time_id`, `time_type`, `time_`) VALUES
(1, 2, '09:30:00'),
(3, 2, '08:00:00'),
(4, 2, '14:00:00'),
(5, 1, '08:00:00'),
(6, 1, '09:00:00'),
(7, 2, '11:00:00'),
(9, 2, '12:30:00'),
(13, 2, '15:30:00'),
(15, 1, '10:00:00'),
(16, 1, '11:00:00'),
(17, 1, '12:00:00'),
(18, 1, '13:00:00'),
(19, 1, '14:00:00'),
(20, 1, '15:00:00'),
(21, 1, '16:00:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `View_Admin`
-- (See below for the actual view)
--
CREATE TABLE `View_Admin` (
`full_name` varchar(102)
,`email` varchar(50)
,`phone` char(14)
,`role` int(11)
,`username` varchar(100)
,`password` varchar(255)
,`room` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `View_Chair`
-- (See below for the actual view)
--
CREATE TABLE `View_Chair` (
`full_name` varchar(102)
,`email` varchar(50)
,`phone` char(14)
,`role` int(11)
,`username` varchar(100)
,`password` varchar(255)
,`room` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `View_Instructor`
-- (See below for the actual view)
--
CREATE TABLE `View_Instructor` (
`full_name` varchar(102)
,`email` varchar(50)
,`phone` char(14)
,`role` int(11)
,`username` varchar(100)
,`password` varchar(255)
,`id` int(11)
,`room` varchar(25)
,`students` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `View_Secretary`
-- (See below for the actual view)
--
CREATE TABLE `View_Secretary` (
`full_name` varchar(102)
,`email` varchar(50)
,`phone` char(14)
,`role` int(11)
,`username` varchar(100)
,`password` varchar(255)
,`room` varchar(25)
);

-- --------------------------------------------------------

--
-- Structure for view `View_Admin`
--
DROP TABLE IF EXISTS `View_Admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`cs01`@`localhost` SQL SECURITY DEFINER VIEW `View_Admin`  AS SELECT concat(`Faculty_Staff`.`faculty_lastname`,', ',`Faculty_Staff`.`faculty_firstname`) AS `full_name`, `Faculty_Staff`.`faculty_email` AS `email`, `Faculty_Staff`.`faculty_phone` AS `phone`, `Faculty_Staff`.`role` AS `role`, `Faculty_Staff`.`faculty_username` AS `username`, `Faculty_Staff`.`faculty_password` AS `password`, concat(`Room`.`building`,' ',`Room`.`room_number`) AS `room` FROM (`Faculty_Staff` join `Room` on((`Room`.`room_id` = `Faculty_Staff`.`room_id`))) WHERE (`Faculty_Staff`.`role` = (select `Constants`.`role_admin` from `Constants`)) ;

-- --------------------------------------------------------

--
-- Structure for view `View_Chair`
--
DROP TABLE IF EXISTS `View_Chair`;

CREATE ALGORITHM=UNDEFINED DEFINER=`cs01`@`localhost` SQL SECURITY DEFINER VIEW `View_Chair`  AS SELECT concat(`Faculty_Staff`.`faculty_lastname`,', ',`Faculty_Staff`.`faculty_firstname`) AS `full_name`, `Faculty_Staff`.`faculty_email` AS `email`, `Faculty_Staff`.`faculty_phone` AS `phone`, `Faculty_Staff`.`role` AS `role`, `Faculty_Staff`.`faculty_username` AS `username`, `Faculty_Staff`.`faculty_password` AS `password`, concat(`Room`.`building`,' ',`Room`.`room_number`) AS `room` FROM (`Faculty_Staff` join `Room` on((`Room`.`room_id` = `Faculty_Staff`.`room_id`))) WHERE (`Faculty_Staff`.`role` = (select `Constants`.`role_chair` from `Constants`)) ;

-- --------------------------------------------------------

--
-- Structure for view `View_Instructor`
--
DROP TABLE IF EXISTS `View_Instructor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`cs01`@`localhost` SQL SECURITY DEFINER VIEW `View_Instructor`  AS SELECT concat(`Faculty_Staff`.`faculty_lastname`,', ',`Faculty_Staff`.`faculty_firstname`) AS `full_name`, `Faculty_Staff`.`faculty_email` AS `email`, `Faculty_Staff`.`faculty_phone` AS `phone`, `Faculty_Staff`.`role` AS `role`, `Faculty_Staff`.`faculty_username` AS `username`, `Faculty_Staff`.`faculty_password` AS `password`, `Faculty_Staff`.`faculty_id` AS `id`, concat(`Room`.`building`,' ',`Room`.`room_number`) AS `room`, count(`Student`.`student_id`) AS `students` FROM ((`Faculty_Staff` join `Room` on((`Room`.`room_id` = `Faculty_Staff`.`room_id`))) left join `Student` on((`Student`.`faculty_id` = `Faculty_Staff`.`faculty_id`))) WHERE (`Faculty_Staff`.`role` = (select `Constants`.`role_instructor` from `Constants`)) GROUP BY `Faculty_Staff`.`faculty_id` ;

-- --------------------------------------------------------

--
-- Structure for view `View_Secretary`
--
DROP TABLE IF EXISTS `View_Secretary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`cs01`@`localhost` SQL SECURITY DEFINER VIEW `View_Secretary`  AS SELECT concat(`Faculty_Staff`.`faculty_lastname`,', ',`Faculty_Staff`.`faculty_firstname`) AS `full_name`, `Faculty_Staff`.`faculty_email` AS `email`, `Faculty_Staff`.`faculty_phone` AS `phone`, `Faculty_Staff`.`role` AS `role`, `Faculty_Staff`.`faculty_username` AS `username`, `Faculty_Staff`.`faculty_password` AS `password`, concat(`Room`.`building`,' ',`Room`.`room_number`) AS `room` FROM (`Faculty_Staff` join `Room` on((`Room`.`room_id` = `Faculty_Staff`.`room_id`))) WHERE (`Faculty_Staff`.`role` = (select `Constants`.`role_secretary` from `Constants`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Apply`
--
ALTER TABLE `Apply`
  ADD PRIMARY KEY (`apply_id`),
  ADD KEY `major_id` (`major_id`);

--
-- Indexes for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `time_id` (`time_id`);

--
-- Indexes for table `Class`
--
ALTER TABLE `Class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `time_id` (`time_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `Contact`
--
ALTER TABLE `Contact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Course`
--
ALTER TABLE `Course`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `unique_course` (`major_id`,`course_number`);

--
-- Indexes for table `Enrollment`
--
ALTER TABLE `Enrollment`
  ADD PRIMARY KEY (`student_id`,`class_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `Faculty_Staff`
--
ALTER TABLE `Faculty_Staff`
  ADD PRIMARY KEY (`faculty_id`),
  ADD UNIQUE KEY `faculty_username` (`faculty_username`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `Major`
--
ALTER TABLE `Major`
  ADD PRIMARY KEY (`major_id`),
  ADD UNIQUE KEY `un_major_name` (`major_name`),
  ADD UNIQUE KEY `un_short_name` (`short_name`);

--
-- Indexes for table `Reset_Password`
--
ALTER TABLE `Reset_Password`
  ADD KEY `fk_student_id` (`student_id`),
  ADD KEY `fk_faculty_id` (`faculty_id`);

--
-- Indexes for table `Room`
--
ALTER TABLE `Room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_username` (`student_username`),
  ADD KEY `major_id` (`major_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `Timeslot`
--
ALTER TABLE `Timeslot`
  ADD PRIMARY KEY (`time_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Apply`
--
ALTER TABLE `Apply`
  MODIFY `apply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `Appointment`
--
ALTER TABLE `Appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `Class`
--
ALTER TABLE `Class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `Contact`
--
ALTER TABLE `Contact`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `Course`
--
ALTER TABLE `Course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `Enrollment`
--
ALTER TABLE `Enrollment`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `Faculty_Staff`
--
ALTER TABLE `Faculty_Staff`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `Major`
--
ALTER TABLE `Major`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `Room`
--
ALTER TABLE `Room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `Student`
--
ALTER TABLE `Student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `Timeslot`
--
ALTER TABLE `Timeslot`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Apply`
--
ALTER TABLE `Apply`
  ADD CONSTRAINT `Apply_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `Major` (`major_id`);

--
-- Constraints for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD CONSTRAINT `Appointment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `Student` (`student_id`),
  ADD CONSTRAINT `Appointment_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `Faculty_Staff` (`faculty_id`),
  ADD CONSTRAINT `Appointment_ibfk_3` FOREIGN KEY (`time_id`) REFERENCES `Timeslot` (`time_id`);

--
-- Constraints for table `Class`
--
ALTER TABLE `Class`
  ADD CONSTRAINT `Class_ibfk_1` FOREIGN KEY (`time_id`) REFERENCES `Timeslot` (`time_id`),
  ADD CONSTRAINT `Class_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `Room` (`room_id`),
  ADD CONSTRAINT `Class_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `Course` (`course_id`),
  ADD CONSTRAINT `Class_ibfk_4` FOREIGN KEY (`faculty_id`) REFERENCES `Faculty_Staff` (`faculty_id`);

--
-- Constraints for table `Course`
--
ALTER TABLE `Course`
  ADD CONSTRAINT `Course_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `Major` (`major_id`);

--
-- Constraints for table `Enrollment`
--
ALTER TABLE `Enrollment`
  ADD CONSTRAINT `Enrollment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `Student` (`student_id`),
  ADD CONSTRAINT `Enrollment_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `Class` (`class_id`);

--
-- Constraints for table `Faculty_Staff`
--
ALTER TABLE `Faculty_Staff`
  ADD CONSTRAINT `Faculty_Staff_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `Room` (`room_id`);

--
-- Constraints for table `Reset_Password`
--
ALTER TABLE `Reset_Password`
  ADD CONSTRAINT `fk_faculty_id` FOREIGN KEY (`faculty_id`) REFERENCES `Faculty_Staff` (`faculty_id`),
  ADD CONSTRAINT `fk_student_id` FOREIGN KEY (`student_id`) REFERENCES `Student` (`student_id`);

--
-- Constraints for table `Student`
--
ALTER TABLE `Student`
  ADD CONSTRAINT `Student_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `Major` (`major_id`),
  ADD CONSTRAINT `Student_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `Faculty_Staff` (`faculty_id`);
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `AccountID` int(10) UNSIGNED NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `InvalidAttempts` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `UserID` int(11) UNSIGNED NOT NULL,
  `ExpirationDate` date NOT NULL,
  `logoutTime` int(11) NOT NULL DEFAULT '300'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`AccountID`, `UserName`, `Password`, `InvalidAttempts`, `UserID`, `ExpirationDate`, `logoutTime`) VALUES
(9, 'BugsBunny', '$2y$10$NS8qaFymWbIQ0tnPp.Bln.OyDOmEZOpVhV6dzTtOmIN0dtHVnu8xC', 1000, 30, '2020-12-02', 300),
(10, 'DonaldDuck', '$2y$10$NS8qaFymWbIQ0tnPp.Bln.OyDOmEZOpVhV6dzTtOmIN0dtHVnu8xC', 0, 31, '2016-07-29', 300),
(11, 'DaffyDuck', '$2y$10$NS8qaFymWbIQ0tnPp.Bln.OyDOmEZOpVhV6dzTtOmIN0dtHVnu8xC', 0, 32, '2016-07-29', 300),
(12, 'PorkyPig', '$2y$10$uK6dPt/Xg8WP8q88.Ma9OuoSNB2t9dw3i35YLpvn0v5CFUFMquYpq', 0, 33, '2016-08-02', 300),
(13, 'FoghornLeghorn', '$2y$10$b1BGo.JWspJlNwF/lrlXpeeLE5.oD8scGm5r93pGH1xSh/BEie69S', 0, 34, '2016-08-02', 300),
(14, 'bwayne', '$2y$10$FhksK9tnDEXMOxl9wXJhAOza3t/8eg2fR4Nsc6ssqnman.IGfKHVW', 0, 35, '2016-05-03', 300),
(15, 'pparker', '$2y$10$yGfgHDjlXjMs/ODyI6m3lOXZubczUwHiWfrrEDR2q4xJBKWd0.YyK', 0, 36, '2016-05-03', 300),
(16, 'llane', '$2y$10$6tiqPUz0qEOaXCnsAnGQEuSrnof6ACI8/dqAv.axA6x.uV9nibp9u', 0, 37, '2016-05-03', 300),
(17, 'ckent', '$2y$10$ECdLl7gBGjYFCdqVZ9apQOL2.9/Ym0QDeMQM1C6qPC3CzhcJ3VqLu', 0, 38, '2016-05-03', 300),
(18, 'MickeyMouse', '123', 1000, 39, '2020-01-01', 300),
(19, 'user', '1234', 100, 40, '0000-00-00', 300);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentnum` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `implantNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentnum`, `comment`, `implantNum`) VALUES
(12, 'additional comments. ', 21);

-- --------------------------------------------------------

--
-- Table structure for table `implant_log`
--

CREATE TABLE `implant_log` (
  `implantNum` int(11) NOT NULL,
  `implantSerial` varchar(32) NOT NULL,
  `lotNum` int(11) DEFAULT NULL,
  `implantStatus` varchar(10) NOT NULL DEFAULT 'RECEIVED',
  `recons` char(1) DEFAULT NULL,
  `reconsMat` varchar(10) DEFAULT NULL,
  `reconsAmt` varchar(10) DEFAULT NULL,
  `reconsName` varchar(50) DEFAULT NULL,
  `reconsCred` varchar(20) DEFAULT NULL,
  `medicalRecord` varchar(15) DEFAULT NULL,
  `PO` int(11) NOT NULL,
  `dateRec` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateSto` datetime DEFAULT NULL,
  `initRec` varchar(30) NOT NULL,
  `initSto` varchar(30) DEFAULT NULL,
  `size` varchar(10) NOT NULL,
  `dateSer` datetime DEFAULT NULL,
  `expDate` date NOT NULL,
  `frozen` char(1) NOT NULL,
  `boxIntact` varchar(1) NOT NULL,
  `hospitalBranch` varchar(5) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `VID` int(11) NOT NULL,
  `reconsLotNum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `implant_log`
--

INSERT INTO `implant_log` (`implantNum`, `implantSerial`, `lotNum`, `implantStatus`, `recons`, `reconsMat`, `reconsAmt`, `reconsName`, `reconsCred`, `medicalRecord`, `PO`, `dateRec`, `dateSto`, `initRec`, `initSto`, `size`, `dateSer`, `expDate`, `frozen`, `boxIntact`, `hospitalBranch`, `description`, `VID`, `reconsLotNum`) VALUES
(21, '10331680', 371509, 'IMPLANTED', 'N', NULL, NULL, NULL, NULL, 'OOOO327094', 919752, '2016-04-30 18:26:19', '2016-04-30 13:36:52', 'Porky Pig', 'Donald Duck', 'FAL-13', '2016-04-30 13:38:51', '2017-12-31', 'N', 'Y', 'MAIN', NULL, 240, NULL),
(22, '10331681', 371509, 'IMPLANTED', 'Y', 'Saline', '50ml', 'Bonnie Cooper', 'RN', '009445', 919759, '2016-04-30 18:26:58', '2016-04-30 13:37:33', 'Porky Pig', 'Donald Duck', 'FAL-13', '2016-05-04 19:27:03', '2016-10-06', 'N', 'Y', 'MAIN', NULL, 240, 823767),
(23, 'SP100311-280', 608001, 'STORED', NULL, NULL, NULL, NULL, NULL, NULL, 919909, '2016-04-30 18:27:44', '2016-05-04 19:25:45', 'Porky Pig', 'Donald Duck', 'FAL-13', NULL, '2017-09-30', 'N', 'Y', 'MAIN', NULL, 241, NULL),
(24, '00614047661029', 40051, 'EXPIRED', NULL, NULL, NULL, NULL, NULL, NULL, 915054, '2015-03-20 05:00:00', '2015-05-01 02:13:29', 'Daffy Duck', 'Bugs Bunny', 'FAL-13', NULL, '2015-08-21', 'N', 'Y', 'WCC', NULL, 239, NULL),
(25, 'IBM1342-454-006', 371609, 'RECEIVED', NULL, NULL, NULL, NULL, NULL, NULL, 875535, '2016-05-05 00:18:05', NULL, 'Porky Pig', NULL, 'PLIF-13', NULL, '2016-09-08', 'N', 'Y', 'MAIN', NULL, 241, NULL),
(26, '180212795', 40052, 'IMPLANTED', 'N', NULL, NULL, NULL, NULL, '482077', 864598, '2016-05-05 00:23:06', '2016-05-04 19:33:02', 'Foghorn Leghorn', 'Daffy Duck', 'FAL-13', '2016-05-04 19:33:28', '2016-12-21', 'N', 'Y', 'WCC', NULL, 241, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `passwordhistory`
--

CREATE TABLE `passwordhistory` (
  `PasswordID` int(10) UNSIGNED NOT NULL,
  `AccountID` int(10) UNSIGNED NOT NULL,
  `Password` varchar(255) NOT NULL,
  `DateChanged` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passwordhistory`
--

INSERT INTO `passwordhistory` (`PasswordID`, `AccountID`, `Password`, `DateChanged`) VALUES
(9, 10, '$2y$10$NS8qaFymWbIQ0tnPp.Bln.OyDOmEZOpVhV6dzTtOmIN0dtHVnu8xC', '2019-02-01'),
(8, 11, '$2y$10$NS8qaFymWbIQ0tnPp.Bln.OyDOmEZOpVhV6dzTtOmIN0dtHVnu8xC', '2016-04-30'),
(10, 12, '$2y$10$NS8qaFymWbIQ0tnPp.Bln.OyDOmEZOpVhV6dzTtOmIN0dtHVnu8xC', '2016-04-30'),
(12, 12, '$2y$10$NS8qaFymWbIQ0tnPp.Bln.OyDOmEZOpVhV6dzTtOmIN0dtHVnu8xC', '2016-05-04'),
(13, 12, '$2y$10$uK6dPt/Xg8WP8q88.Ma9OuoSNB2t9dw3i35YLpvn0v5CFUFMquYpq', '2016-05-04'),
(14, 13, '$2y$10$b1BGo.JWspJlNwF/lrlXpeeLE5.oD8scGm5r93pGH1xSh/BEie69S', '2016-05-04'),
(11, 13, '$2y$10$NS8qaFymWbIQ0tnPp.Bln.OyDOmEZOpVhV6dzTtOmIN0dtHVnu8xC', '2016-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `secanswers`
--

CREATE TABLE `secanswers` (
  `AccountID` int(10) UNSIGNED NOT NULL,
  `quesNum` int(10) DEFAULT NULL,
  `question` varchar(100) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secanswers`
--

INSERT INTO `secanswers` (`AccountID`, `quesNum`, `question`, `answer`) VALUES
(11, 1, 'What is the name of your first school?', '$2y$10$66n7QJnCmDrFbpGLiSTFEe6fJPN3bxszI8GNXODoJGXw2VrOm50.G'),
(11, 2, 'What is your favorite vacation spot?', '$2y$10$8QqpADmvTCo7iqDFMhzvaOsifzQtG0tshx4URBDRRGjbsaZTar1Eq'),
(11, 3, 'What is your mothers maiden name?', '$2y$10$POeXJXDC/j3ZSglQYYBT8OvC5dPQWaSwys2kLYAZTSvKrFFlMzOg.'),
(10, 1, 'What is the name of your first school?', '$2y$10$PpVOco5vrTBAvQ662FHkxeSz2sYAUdM6yfG6lcunwuNdHrvR5GfD.'),
(10, 2, 'What is your favorite vacation spot?', '$2y$10$8C221nogADwHkRMnuO6PieyzgiFotCP4vw7IR4AjoebFKIWZXDjau'),
(10, 4, 'What is your first pets name?', '$2y$10$/9bU0chyriXDlDuvL5in2u84HYEpz9997dPKtXlgECvGkh6uzPz0C'),
(12, 1, 'What is the name of your first school?', '$2y$10$/xepGl3kvc0vPBx7buZOme8BaPpXn3wfo6oLMGeN3olK2d8WJXKMe'),
(12, 2, 'What is your favorite vacation spot?', '$2y$10$kX7TBlR26dgb/KrDJ8QBkeBnASQ.d/2IYWDzkLuDoTFUxthv9ePHC'),
(12, 6, 'What is the name of your favorite restaurant?', '$2y$10$e7.RAxZyryzV0kD.kI/ow.CdqMMoimV9wwiWFudj1xRnSjQSeWMS.'),
(13, 10, 'What is the name of the street on which you lived when you were 5 years old?', '$2y$10$.TWJlf7qKEmcvGFoeN8PEe4.oiXa7nyCbu0Ga9eeGA0l4nverFWd.'),
(13, 9, 'What is the city of your first school?', '$2y$10$UoYISMZY/Erpm2fFq7GZPOcY4F7S5iAP3XPBPNudlDLNJg11iNulC'),
(13, 1, 'What is the name of your first school?', '$2y$10$66n7QJnCmDrFbpGLiSTFEe6fJPN3bxszI8GNXODoJGXw2VrOm50.G'),
(9, 1, 'What is the name of your first school?', '$2y$10$UjBgryWU5WdreH3C6Un3sOd0karJD2n9X9POQFroiyc1NSjc8bCoS'),
(9, 2, 'What is your favorite vacation spot?', '$2y$10$5BK2LjAeoaIIL9KLyNOt2e0iuu8rzr/aAXUIyrvnyaWkVk0e177LK'),
(9, 3, 'What is your mothers maiden name?', '$2y$10$n3ZCZWeIz8MjV2aSNSDIYOKKhzB.yO.4eQ5StBq0pmi0wve6P1MOO');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(10) UNSIGNED NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `JobTitle` varchar(50) NOT NULL,
  `hospitalBranch` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `FirstName`, `LastName`, `JobTitle`, `hospitalBranch`) VALUES
(30, 'Bugs', 'Bunny', 'Administrator', 'MAIN'),
(31, 'Donald', 'Duck', 'Operating Room Coordinator', 'MAIN'),
(32, 'Daffy', 'Duck', 'Operating Room Coordinator', 'WCC'),
(33, 'Porky', 'Pig', 'Receiving', 'MAIN'),
(34, 'Foghorn', 'Leghorn', 'Receiving', 'WCC'),
(35, 'Bruce', 'Wayne', 'Operating Room Coordinator', 'MAIN'),
(36, 'Peter', 'Parker', 'Receiving', 'MAIN'),
(37, 'Lois', 'Lane', 'Operating Room Coordinator', 'WCC'),
(38, 'Clark', 'Kent', 'Receiving', 'WCC'),
(39, 'MIckey', 'Mouse', 'Administrator', 'Main');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendorID` int(11) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `vendorNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendorID`, `companyName`, `vendorNumber`) VALUES
(238, 'Osprey', 1),
(239, 'MTF', 2),
(240, 'Seaspine', 3),
(241, 'Lifecell', 4),
(243, 'Minsurg', 220),
(244, 'Lifenet', 23264);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AccountID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentnum`),
  ADD KEY `implantNum` (`implantNum`);

--
-- Indexes for table `implant_log`
--
ALTER TABLE `implant_log`
  ADD PRIMARY KEY (`implantNum`),
  ADD KEY `VID` (`VID`);

--
-- Indexes for table `passwordhistory`
--
ALTER TABLE `passwordhistory`
  ADD PRIMARY KEY (`PasswordID`),
  ADD UNIQUE KEY `AccountID` (`AccountID`,`Password`,`DateChanged`);

--
-- Indexes for table `secanswers`
--
ALTER TABLE `secanswers`
  ADD KEY `AccountID` (`AccountID`),
  ADD KEY `AccountID_2` (`AccountID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `AccountID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentnum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `implant_log`
--
ALTER TABLE `implant_log`
  MODIFY `implantNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `passwordhistory`
--
ALTER TABLE `passwordhistory`
  MODIFY `PasswordID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`implantNum`) REFERENCES `implant_log` (`implantNum`) ON UPDATE CASCADE;

--
-- Constraints for table `implant_log`
--
ALTER TABLE `implant_log`
  ADD CONSTRAINT `implant_log_ibfk_1` FOREIGN KEY (`VID`) REFERENCES `vendors` (`vendorID`) ON UPDATE CASCADE;

--
-- Constraints for table `passwordhistory`
--
ALTER TABLE `passwordhistory`
  ADD CONSTRAINT `PasswordHist_Account_FK` FOREIGN KEY (`AccountID`) REFERENCES `account` (`AccountID`) ON UPDATE CASCADE;

--
-- Constraints for table `secanswers`
--
ALTER TABLE `secanswers`
  ADD CONSTRAINT `secanswers_ibfk_1` FOREIGN KEY (`AccountID`) REFERENCES `account` (`AccountID`) ON DELETE CASCADE;
--
-- Database: `test_elias`
--
CREATE DATABASE IF NOT EXISTS `test_elias` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test_elias`;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(255) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`, `student_id`) VALUES
(5, 'Calc I', 5),
(6, 'Trigonometry', 5),
(7, 'Linear Algebra', 5),
(8, 'Networking', 2),
(9, 'Programming I', 2),
(21, 'Data Analytics', 13),
(23, 'Biology 101', 14),
(24, 'Zoology', 14),
(25, 'Data Struct', 1),
(28, 'Spanish I', 15),
(29, 'English I', 15),
(34, 'asdf', 18),
(38, 'Chemistry', 19),
(39, 'Spanish I', 19),
(40, 'English I', 19);

-- --------------------------------------------------------

--
-- Stand-in structure for view `first_view`
-- (See below for the actual view)
--
CREATE TABLE `first_view` (
`user_id` int(11)
,`email` varchar(255)
,`first_name` varchar(255)
,`last_name` varchar(255)
,`user_password` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `major_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`major_name`) VALUES
('BIOL'),
('MATH'),
('CS'),
('IT');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `major` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `username`, `major`) VALUES
(1, 'Elias', 'CS'),
(2, 'Obama', 'IT'),
(3, 'Jackson', 'CS'),
(4, 'Elijah', 'BIOL'),
(5, 'Kim', 'MATH'),
(7, 'Sijalu', 'BIOL'),
(8, 'Bryan', 'BIOL'),
(9, 'Sam', 'MATH'),
(11, 'Kareem', 'SPSC'),
(13, 'Ryan', 'CS'),
(14, 'Pierce', 'BIOL'),
(15, 'Ezekial', 'SPAN'),
(16, 'Man', ''),
(17, 'Man', 'CHEM'),
(18, 'asdf', 'asdf'),
(19, 'Tom ', 'MATH');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `first_name`, `last_name`, `user_password`) VALUES
(19, 'ep943087@cameron.edu', 'Elias', 'Proctor', '$2y$10$tyg7e.DkopcajQfRsdUQFuclAbSx1r/dtJkXExJfHhJDGL3yYbMqW'),
(20, 'a@a', '\'', '\'', '$2y$10$k24awDP1VLH.CaJVkAHNy.bWeVPGP2KP5lU0d2lj02Bf3F0ilbLpq'),
(23, 'student@student', 'student@student', 'student@student', '$2y$10$g45.uK1BDeAXbObuWGr0JOLLhZAEe5M7o2wy5RKkVAEjjg5eYsQZm'),
(24, 'admin@admin', 'admin@admin', 'admin@admin', '$2y$10$uUrAGIPGw6DmWama7W69VuwIIwhhdxOGUZhsl3uoLFiSvMQgkkjhO'),
(25, 'secretary@secretary', 'asdf', 'asdf', '$2y$10$JWzwsAdaxyiJ4g66OvUWK.QBydwDjN.5iYLKvnPa/rwunAuS.lVye'),
(26, 'Chair@Chair', 'asdf', 'asdf', '$2y$10$DZBWwyhBk435RnW.5ipSG.JEnqMbH5Sz/NQnzJewaW0Q0PUhy4GSy'),
(27, 'instructor@instructor', 'instructor', 'instrucotr', '$2y$10$hJcv8kOJMN///uDINf7fhuk/WHxH4mYo0tNR5vgeFdqlQIVKEkw8i');

-- --------------------------------------------------------

--
-- Structure for view `first_view`
--
DROP TABLE IF EXISTS `first_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`cs02`@`localhost` SQL SECURITY DEFINER VIEW `first_view`  AS SELECT `users`.`user_id` AS `user_id`, `users`.`email` AS `email`, `users`.`first_name` AS `first_name`, `users`.`last_name` AS `last_name`, `users`.`user_password` AS `user_password` FROM `users` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
