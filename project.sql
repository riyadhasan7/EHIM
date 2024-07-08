-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 07:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_misconduct`
--

CREATE TABLE `academic_misconduct` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `std_roll` varchar(50) DEFAULT NULL,
  `misconduct_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_misconduct`
--

INSERT INTO `academic_misconduct` (`id`, `exam_id`, `std_roll`, `misconduct_type`) VALUES
(5, 19, 'demo3', 'demo3'),
(6, 19, 'demo4', 'demo4'),
(7, 19, 'demo5', 'demo5'),
(8, 19, 'demo6', 'demo6');

-- --------------------------------------------------------

--
-- Table structure for table `exam_info`
--

CREATE TABLE `exam_info` (
  `id` int(11) NOT NULL,
  `module` varchar(255) NOT NULL,
  `exam_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `selected_proc` text DEFAULT NULL,
  `total_students` varchar(255) NOT NULL,
  `attended_students` varchar(255) NOT NULL,
  `emergency` varchar(50) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_info`
--

INSERT INTO `exam_info` (`id`, `module`, `exam_date`, `start_time`, `end_time`, `selected_proc`, `total_students`, `attended_students`, `emergency`) VALUES
(1, 'hjka', '2024-06-05', '20:10:00', '20:13:00', '0001001000', '', '0', 'no'),
(2, 'Programing with C', '2024-06-13', '17:07:00', '23:11:00', '0010111000', '', '0', 'no'),
(3, 'Programing with C', '2024-06-13', '17:07:00', '23:11:00', '0010111000', '', '0', 'no'),
(4, 'twwt', '2024-06-13', '17:07:00', '23:11:00', '0010111000', '', '0', 'no'),
(5, 'hello', '2024-07-10', '23:56:00', '12:53:00', '0001010000', '', '0', 'no'),
(6, 'math', '2024-07-02', '13:55:00', '13:56:00', '1010111000', '', '0', 'no'),
(7, 'Cse', '2024-07-02', '17:08:00', '17:10:00', '1101101111', '', '0', 'no'),
(8, 'agnegd', '2024-07-02', '17:08:00', '17:10:00', '', '', '0', 'no'),
(9, 'agnegd', '2024-07-02', '17:08:00', '17:10:00', '', '', '0', 'no'),
(10, 'Python', '2024-07-02', '17:08:00', '17:10:00', '1111111111', '', '0', 'no'),
(11, 'pysics', '2024-07-04', '11:32:00', '11:37:00', '1100111000', '', '0', 'no'),
(12, 'test1', '2024-07-04', '11:38:00', '11:48:00', '', '', '0', 'no'),
(13, 'test2', '2024-07-04', '11:46:00', '11:53:00', '1111111000', '', '0', 'no'),
(14, 'demo 6', '2024-07-07', '14:55:00', '15:56:00', '10011011', '', '0', 'no'),
(15, 'demo', '2024-07-07', '22:23:00', '22:28:00', '', '', '0', 'no'),
(16, 'demo10', '2024-07-07', '22:23:00', '22:28:00', '110001101', '', '0', 'no'),
(17, 'demo16', '2024-07-08', '09:37:00', '09:59:00', '1111101000', '', '0', 'no'),
(18, 'demo 10', '2024-07-08', '10:04:00', '11:01:00', '', '', '0', 'no'),
(19, 'demo112', '2024-07-08', '10:04:00', '10:10:00', '111100011', '12', '10', 'demo6');

-- --------------------------------------------------------

--
-- Table structure for table `loc_pro`
--

CREATE TABLE `loc_pro` (
  `id` int(11) NOT NULL,
  `proc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loc_pro`
--

INSERT INTO `loc_pro` (`id`, `proc`) VALUES
(11, 'Examination papers are prepared within the timetable set out in the assessment calendar approved by the Academic Board.'),
(12, 'Examination papers that contribute directly to an academic award are sent in draft to the external examiner for comment. Draft papers for both first sit and resit examinations are prepared and sent for comment to the external examiner at the same time.'),
(13, 'The academic member of staff responsible for the examination paper is responsible for checking and certifying the accuracy of the final version of the paper.'),
(14, 'The Examinations and Conferments Office must: arrange secure storage of draft and final approved examination papers and the copying of the final approved version of all examination papers; ensure that examination papers are available for collection on the day of the examination.'),
(15, 'No unauthorised member of staff can copy any papers before the day of the examination.'),
(16, 'The role of module coordinators is to write the examination paper (or arrange for it to be written) to respond to the comments of the external examiner and to check and certify the accuracy of the final paper. The module coordinator will determine what aids are permitted in the examination.'),
(17, 'The Examinations and Conferment Office publishes a university-wide timetable on MyLSBU. All exams are held in the examination periods set out in the assessment calendar. There is also an approved calendar for a course held outside the normal academic calendar. In exceptional cases the Head of Registry can authorise for an exam to be held at another time.'),
(18, 'Examinations for modules offered as part of combined degree Programmes must be scheduled within the normal teaching block for the module. In exceptional cases, with specific authorisation, they can be held outside the normal teaching block.'),
(19, 'The Examinations and Conferment Office arranges for specified rooms to be set aside for examination use. These rooms may only be used for examinations during the examinations period, and may not be used for teaching on courses that continue during the examination period.');

-- --------------------------------------------------------

--
-- Table structure for table `not_allowed`
--

CREATE TABLE `not_allowed` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `not_allowed`
--

INSERT INTO `not_allowed` (`id`, `exam_id`, `start_time`, `end_time`) VALUES
(1, 8, '20:08:00', '18:08:00'),
(2, 8, '17:24:00', '23:22:00'),
(3, 9, '19:36:00', '19:37:00'),
(5, 10, '20:08:00', '18:08:00'),
(6, 11, '11:33:00', '11:35:00'),
(7, 11, '11:35:00', '11:36:00'),
(8, 12, '11:38:00', '11:39:00'),
(9, 12, '11:40:00', '11:41:00'),
(10, 13, '11:48:00', '11:49:00'),
(11, 13, '11:50:00', '11:51:00'),
(12, 14, '14:58:00', '16:00:00'),
(13, 15, '22:25:00', '22:27:00'),
(14, 16, '22:25:00', '22:27:00'),
(15, 17, '09:39:00', '09:40:00'),
(16, 17, '09:56:00', '09:59:00'),
(17, 18, '10:02:00', '00:03:00'),
(18, 19, '10:05:00', '10:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `age`, `password`) VALUES
(1, ' aksga', 'hell0@g.com', 10, '$2y$10$VpT1g5H.5I.BgmZla2X6b.scBy8ryuNU4aHZJ41GGI/W.c5nNkr36'),
(2, 'kjega', 'a@a.a', 10, '$2y$10$UsmMgb7lo7TJFtneuWFe3uIl5soznb/7K.Klm755.NqOvFGNDkxCq'),
(3, 'abc', 'abe@a.a', 12, '$2y$10$CPjzoMV9ZAHIlVBbyqG4g./tPgbfUvJ7tPB0x4bwrYa3rla.kMbdC'),
(4, 'tamim', 't@t.t10', 10, '$2y$10$BQgDGq0bukQALvJY6Gt5X.JP/YVEoXldAk0gurL.cxk6JfOh91szK'),
(5, 'abc', 'abc@gmail.com', 10, '$2y$10$H7cDQEm18YoI2piXger9G.pAzXas9zX5wYfbdGfWqYa3fWmT5LxLK'),
(6, '', '', 0, '$2y$10$z.ZpCf3AwDTSrA8uoYcbqexVqSE8huKNdto3gs9.xjP7km7N9Kcaa'),
(7, 'hello', 'a@a.com', 23, '$2y$10$BgTZExvfNAX6FjgoI7qxs.jqiZjn97rT9xyyq2Hn/xSMGACZxcDV2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_misconduct`
--
ALTER TABLE `academic_misconduct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `exam_info`
--
ALTER TABLE `exam_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loc_pro`
--
ALTER TABLE `loc_pro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `not_allowed`
--
ALTER TABLE `not_allowed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_misconduct`
--
ALTER TABLE `academic_misconduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `exam_info`
--
ALTER TABLE `exam_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `loc_pro`
--
ALTER TABLE `loc_pro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `not_allowed`
--
ALTER TABLE `not_allowed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_misconduct`
--
ALTER TABLE `academic_misconduct`
  ADD CONSTRAINT `academic_misconduct_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam_info` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `not_allowed`
--
ALTER TABLE `not_allowed`
  ADD CONSTRAINT `not_allowed_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam_info` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
