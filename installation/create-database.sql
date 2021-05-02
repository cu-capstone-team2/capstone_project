-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2021 at 08:12 PM
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
(34, 'Via Zoom', b'1', '2021-04-28', 1, 4, 6),
(35, '', b'1', '2021-05-03', 1, 4, 6);

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
(35, 'MW', 75, 1, 3, 28, 36),
(36, 'TR', 75, 7, 14, 18, 32);

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
(1, 25),
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
(7),
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
('kducLCh34BGBqYCEkOjB0ZukSUmOHqdURJGaivAfmFCua7anSC', 1, NULL, b'1'),
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
(14, 'Zane', 'Gaines', 'zanegaines@cameron.edu', 'senior', 6545, 'zanegaines14', '\'\'', b'1', 1, 32),
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
-- AUTO_INCREMENT for table `Appointment`
--
ALTER TABLE `Appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `Class`
--
ALTER TABLE `Class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `Timeslot`
--
ALTER TABLE `Timeslot`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
