-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 09, 2026 at 01:18 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trombinoscope_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `login`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$/tEsMzlag32CAj3KlPPDguqr2wB2su1DHJTbeZmSpRQRbfIRJSvJm', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `level_id` int NOT NULL,
  `speciality_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `start_date`, `end_date`, `name`, `level_id`, `speciality_id`) VALUES
(1, '2025-09-01', '2026-06-30', 'B1', 1, NULL),
(2, '2025-09-01', '2026-06-30', 'B2 Développement', 2, 1),
(3, '2025-09-01', '2026-06-30', 'B2 Design', 2, 2),
(4, '2025-09-01', '2026-06-30', 'B3 Développement', 3, 1),
(5, '2026-09-01', '2026-06-30', 'B3 Design', 3, 2),
(6, '2025-09-01', '2026-06-30', 'B3 Marketing', 3, 3),
(7, '2025-09-01', '2026-06-30', 'M Développement', 4, 1),
(8, '2025-09-01', '2026-06-30', 'M Design', 4, 2),
(9, '2025-09-01', '2026-06-30', 'M Marketing', 4, 3),
(10, '2025-09-01', '2026-06-30', 'M2 Développement', 5, 1),
(11, '2025-09-01', '2026-06-30', 'M2 Design', 5, 2),
(12, '2025-09-01', '2026-06-30', 'M2 Marketing', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `level_id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`level_id`, `name`) VALUES
(1, 'B1'),
(2, 'B2'),
(3, 'B3'),
(4, 'Master 1'),
(5, 'Master 2');

-- --------------------------------------------------------

--
-- Table structure for table `speciality`
--

CREATE TABLE `speciality` (
  `speciality_id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `speciality`
--

INSERT INTO `speciality` (`speciality_id`, `name`) VALUES
(1, 'Développement'),
(2, 'Design'),
(3, 'Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) NOT NULL,
  `is_delegate` tinyint(1) DEFAULT NULL,
  `is_alternance` tinyint(1) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'en_attente',
  `submitted_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `class_id` int NOT NULL,
  `admin_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `first_name`, `last_name`, `email`, `slogan`, `photo_path`, `is_delegate`, `is_alternance`, `status`, `submitted_at`, `class_id`, `admin_id`) VALUES
(44, 'Emma', 'Richard', 'Richard@gmail.com', 'Moins il y a de clics, mieux lutilisateur se porte.', 'uploads/photo_69d7a5bb1791e9.84339758.jpg', 1, NULL, 'valide', '2026-04-09 11:30:40', 1, NULL),
(45, 'Hugo', 'Durand', 'Richard@gmail.com', 'Le code propre est un code qui se lit comme un livre.', 'uploads/photo_69d771e1075614.48814780.jpg', 0, NULL, 'valide', '2026-04-09 11:31:13', 1, NULL),
(46, 'Chloé', 'Moreau', 'Richard@gmail.com', 'Le pixel perfect ou rien.', 'uploads/photo_69d771fb27bc29.31679290.jpg', 0, NULL, 'valide', '2026-04-09 11:31:39', 1, NULL),
(47, 'Alice', 'Laurent', 'alice@gmail.com', 'Laccessibilité nest pas une option, est un droit.', 'uploads/photo_69d772b9e37780.99341012.jpg', 0, NULL, 'valide', '2026-04-09 11:34:49', 1, NULL),
(48, 'Enzo', 'Lefebvre', 'alice@gmail.com', 'Le Dark Mode devrait être la norme partout.', 'uploads/photo_69d772d386d554.88292584.jpg', 0, NULL, 'valide', '2026-04-09 11:35:15', 1, NULL),
(49, 'Manon', 'Michel', 'Michel@gmail.com', 'Une interface doit être invisible pour être efficace', 'uploads/photo_69d77317e43a10.78795959.jpg', 1, NULL, 'valide', '2026-04-09 11:36:23', 1, NULL),
(50, 'Louis', 'Garcia', 'Michel@gmail.com', 'Le meilleur framework, c&#39;est celui que tu maîtrises.', 'uploads/photo_69d7733cd03bd4.08342874.webp', 0, NULL, 'valide', '2026-04-09 11:37:00', 3, NULL),
(51, 'Jade', 'David', 'David@gmail.com', 'L&#38;#39;espace vide est aussi important que le contenu.', 'uploads/photo_69d773b82fba18.17370308.jpg', 1, NULL, 'valide', '2026-04-09 11:39:04', 6, NULL),
(52, 'Arthur', 'Bertrand', 'Bertrand@gmail.com', 'On déploie vendredi ? Même pas peur', 'uploads/photo_69d773de68f166.94945155.jpg', 1, NULL, 'valide', '2026-04-09 11:39:42', 11, NULL),
(53, 'Florian', 'Martin', 'florian@gmail.com', 'Faut être genitl', 'uploads/photo_69d7a5d6ccc057.19749709.jpg', 0, NULL, 'valide', '2026-04-09 12:21:03', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teaches`
--

CREATE TABLE `teaches` (
  `teacher_id` int NOT NULL,
  `class_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `level_id` (`level_id`),
  ADD KEY `speciality_id` (`speciality_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `speciality`
--
ALTER TABLE `speciality`
  ADD PRIMARY KEY (`speciality_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `teaches`
--
ALTER TABLE `teaches`
  ADD PRIMARY KEY (`teacher_id`,`class_id`),
  ADD KEY `class_id` (`class_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `level_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `speciality`
--
ALTER TABLE `speciality`
  MODIFY `speciality_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `level` (`level_id`),
  ADD CONSTRAINT `class_ibfk_2` FOREIGN KEY (`speciality_id`) REFERENCES `speciality` (`speciality_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `teaches`
--
ALTER TABLE `teaches`
  ADD CONSTRAINT `teaches_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`),
  ADD CONSTRAINT `teaches_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
