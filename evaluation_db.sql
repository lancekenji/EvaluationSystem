-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2023 at 01:05 PM
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
-- Database: `evaluation_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(3, 'A. COMMITMENT'),
(5, 'B. KNOWLEDGE OF SUBJECT'),
(6, 'C. TEACHING FOR INDEPENDENT LEARNING'),
(7, 'D. MANAGEMENT OF LEARNING ');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(256) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `description`) VALUES
(9, 'test1', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `evaluation_id` int(11) NOT NULL,
  `evaluation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`evaluation_id`, `evaluation_date`) VALUES
(1, '2023-06-12'),
(2, '2023-06-12'),
(3, '2023-06-12'),
(4, '2023-06-12'),
(5, '2023-06-12'),
(6, '2023-06-12'),
(7, '2023-06-12'),
(8, '2023-06-12'),
(9, '2023-06-12'),
(10, '2023-06-12'),
(11, '2023-06-12'),
(12, '2023-06-12'),
(13, '2023-06-12'),
(14, '2023-06-12'),
(15, '2023-06-12'),
(16, '2023-06-12'),
(17, '2023-06-12'),
(18, '2023-06-12'),
(19, '2023-06-12'),
(20, '2023-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_result`
--

CREATE TABLE `evaluation_result` (
  `response_id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `response_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation_result`
--

INSERT INTO `evaluation_result` (`response_id`, `evaluation_id`, `question_id`, `student_id`, `professor_id`, `response_value`) VALUES
(1, 1, 5, 3, 4, 5),
(2, 2, 6, 3, 4, 4),
(3, 3, 7, 3, 4, 3),
(4, 4, 8, 3, 4, 2),
(5, 5, 13, 3, 4, 1),
(6, 6, 14, 3, 4, 5),
(7, 7, 15, 3, 4, 4),
(8, 8, 16, 3, 4, 3),
(9, 9, 17, 3, 4, 2),
(10, 10, 18, 3, 4, 1),
(11, 11, 19, 3, 4, 5),
(12, 12, 20, 3, 4, 4),
(13, 13, 21, 3, 4, 3),
(14, 14, 22, 3, 4, 2),
(15, 15, 23, 3, 4, 1),
(16, 16, 24, 3, 4, 5),
(17, 17, 25, 3, 4, 4),
(18, 18, 26, 3, 4, 3),
(19, 19, 27, 3, 4, 2),
(20, 20, 28, 3, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `professor_id` int(11) NOT NULL,
  `fname` varchar(256) NOT NULL,
  `lname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`professor_id`, `fname`, `lname`, `email`, `password`, `department_id`) VALUES
(4, 'Lance Kenji1', 'Parce1', 'lancekenjiparce1@gmail.com', '05a671c66aefea124cc08b76ea6d30bb', 9),
(5, 'John', 'Kennedy', 'occgmf@sinaite.net', '05a671c66aefea124cc08b76ea6d30bb', 9);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `question_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `category_id`, `question_text`) VALUES
(5, 3, 'Demonstrates sensitivity to students\' ability to attend and absorb content information.'),
(6, 3, 'Integrates  sensitively  his/her  learning objectives  with those of the students in a collaborative process.'),
(7, 3, 'Makes self available to students beyond official time.'),
(8, 3, 'Regularly comes  to class on time, well-groomed and well- prepared to complete assigned responsibilities'),
(13, 3, 'Keeps accurate records of students\' performance and prompt submission of the same.'),
(14, 5, 'Demonstrates mastery of the subject matter (explain the subject matter without relying solely on the prescribed textbook).'),
(15, 5, 'Draws and share information on the state on the art of theory and practice In his/her discipline.'),
(16, 5, 'Integrates subject to practical circumstances and learning intents/purposes of students.'),
(17, 5, 'Explains the relevance of present topics to the previous lessons, and relates the subject matter to relevant current issues and/or daily life activities.'),
(18, 5, 'Demonstrates up to- date knowledge and/ or awareness on current trends and issues of the subject.'),
(19, 6, 'Creates teaching strategies that allow students to practice using concepts they need to understand (interactive discussion).'),
(20, 6, 'Enhances student  self-esteem and/or gives due recognition to students\' performance/potentials.'),
(21, 6, 'Allows students to create their own course with objectives and realistically defined student-professor rules and make them accountable for their performance.'),
(22, 6, 'Allows students to think independently and make their own decisions and holding  them accountable for their performance based largely on their success in executing decisions.'),
(23, 6, 'Encourages students to learn beyond what is required and help/guide the students how to apply the concepts learned'),
(24, 7, 'Creates  opportunities  for  intensive  and/or  extensive contribution of students in the class activities (e.g.breaks class into dyads, triads or buzz/task groups).'),
(25, 7, 'Assumes  roles as facilitator, resource person, coach, inquisitor,  integrator,  referee in drawing students  to contribute  to  knowledge  and  understanding of  the\r\nconcepts at hands.'),
(26, 7, 'Designs and implements learning conditions    and experience  that  promotes  healthy  exchange  and/or confrontations.'),
(27, 7, 'Structures/re-structures  learning and  teaching-learning context to enhance attainment of collective learning objectives.'),
(28, 7, 'Use  of  Instructional  Materials  ((audio/video  materials: fieldtrips, film showing, computer aided instruction and etc.) to reinforces learning processes.');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_name`) VALUES
(2, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `fname` varchar(256) NOT NULL,
  `lname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `year_level` varchar(256) NOT NULL,
  `department_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `fname`, `lname`, `email`, `password`, `year_level`, `department_id`, `section_id`) VALUES
(3, 'Lance Kenji', 'Parce', 'lancekenjiparce@gmail.com', '05a671c66aefea124cc08b76ea6d30bb', '2nd year', 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `name`) VALUES
(1, 'admin@admin.com', '098f6bcd4621d373cade4e832627b4f6', 'Admin'),
(4, 'Test@gmail.com1', '098f6bcd4621d373cade4e832627b4f6', 'test1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`evaluation_id`);

--
-- Indexes for table `evaluation_result`
--
ALTER TABLE `evaluation_result`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `evaluation_id` (`evaluation_id`),
  ADD KEY `professor_id` (`professor_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`professor_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `evaluation_result`
--
ALTER TABLE `evaluation_result`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `professor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evaluation_result`
--
ALTER TABLE `evaluation_result`
  ADD CONSTRAINT `evaluation_result_ibfk_1` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluation` (`evaluation_id`),
  ADD CONSTRAINT `evaluation_result_ibfk_2` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`professor_id`),
  ADD CONSTRAINT `evaluation_result_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`),
  ADD CONSTRAINT `evaluation_result_ibfk_4` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
