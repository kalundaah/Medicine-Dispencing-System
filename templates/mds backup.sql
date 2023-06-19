-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 07:19 PM
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
-- Database: `mda`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocation`
--

CREATE TABLE `allocation` (
  `id` int(11) NOT NULL,
  `doctor` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `medicine` int(11) NOT NULL,
  `scenario` int(11) NOT NULL,
  `allocated` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `expected` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allocation`
--

INSERT INTO `allocation` (`id`, `doctor`, `patient`, `medicine`, `scenario`, `allocated`, `cost`, `expected`, `time`) VALUES
(1, 1, 1, 14, 1, 12, 96, '2023-04-28', '2023-04-24 11:19:50'),
(2, 1, 2, 14, 2, 12, 96, '2023-04-28', '2023-04-24 11:23:37'),
(3, 1, 2, 20, 3, 10, 40, '2023-05-21', '2023-05-19 07:33:28'),
(4, 1, 2, 5, 4, 40, 167080, '2023-05-20', '2023-05-19 08:10:08'),
(5, 1, 2, 6, 5, 20, 11180, '2023-05-24', '2023-05-19 08:10:28'),
(6, 1, 1, 9, 6, 20, 11180, '2023-05-24', '2023-05-19 08:11:18'),
(7, 1, 2, 1, 7, 20, 83540, '2023-05-25', '2023-05-19 08:22:46'),
(8, 1, 3, 2, 8, 10, 41770, '2023-05-21', '2023-05-19 09:57:14'),
(9, 3, 2, 5, 9, 20, 83540, '2023-06-03', '2023-05-30 14:57:33'),
(10, 3, 2, 7, 10, 12, 6708, '2023-06-02', '2023-05-30 15:08:02'),
(11, 3, 3, 15, 11, 10, 80, '2023-06-05', '2023-05-30 16:27:37'),
(12, 3, 2, 14, 12, 16, 128, '2023-06-06', '2023-05-30 16:28:02'),
(13, 3, 3, 20, 13, 40, 160, '2023-07-01', '2023-05-30 16:28:50'),
(14, 3, 3, 22, 14, 250, 1000, '2023-07-30', '2023-05-30 16:30:15'),
(15, 3, 2, 11, 15, 20, 160, '2023-07-21', '2023-05-30 16:31:09'),
(16, 3, 1, 3, 16, 20, 83540, '2023-07-21', '2023-05-30 16:31:59'),
(17, 3, 1, 3, 17, 20, 83540, '2023-07-21', '2023-05-30 16:32:05'),
(18, 3, 3, 4, 18, 20, 83540, '2023-07-01', '2023-05-30 16:32:46'),
(19, 3, 2, 27, 19, 20, 140, '2023-06-03', '2023-05-30 16:33:36'),
(20, 3, 3, 26, 20, 5, 35, '2023-06-03', '2023-05-30 16:35:22'),
(21, 1, 3, 8, 21, 30, 16770, '2023-06-14', '2023-05-30 16:36:00'),
(22, 1, 1, 12, 22, 20, 160, '2023-07-01', '2023-05-30 17:01:40'),
(23, 1, 2, 13, 23, 50, 400, '2023-07-01', '2023-05-30 17:02:19'),
(24, 1, 1, 21, 24, 20, 80, '2023-06-05', '2023-05-30 17:06:10'),
(25, 1, 2, 23, 25, 20, 80, '2023-06-06', '2023-05-30 17:06:31'),
(26, 1, 2, 24, 26, 30, 120, '2023-06-09', '2023-05-30 17:12:33'),
(27, 1, 2, 18, 27, 50, 200, '2023-05-31', '2023-05-30 17:13:16');

-- --------------------------------------------------------

--
-- Stand-in structure for view `anaesthetic`
-- (See below for the actual view)
--
CREATE TABLE `anaesthetic` (
`name` varchar(255)
,`revenue` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `antiallergies`
-- (See below for the actual view)
--
CREATE TABLE `antiallergies` (
`name` varchar(255)
,`revenue` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `antidotes`
-- (See below for the actual view)
--
CREATE TABLE `antidotes` (
`name` varchar(255)
,`revenue` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phonenos` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `firstname`, `lastname`, `phonenos`, `age`, `email`, `password`, `date_added`) VALUES
(1, 'neville', 'kalunda', '0712345678', 20, 'kalnev@example.com', 'password', '2023-04-24 07:02:09'),
(2, 'peter', 'makach', '0111234567', 21, 'pemak@example.com', 'password', '2023-05-19 08:04:00'),
(3, 'edwin', 'chwaga', '0131637547', 25, 'edchag@example.com', 'password', '2023-05-19 08:06:09');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) DEFAULT 6,
  `cost` int(11) NOT NULL,
  `availableamt` int(11) NOT NULL DEFAULT 0,
  `totalsold` int(11) NOT NULL DEFAULT 0,
  `revenue` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `type`, `cost`, `availableamt`, `totalsold`, `revenue`) VALUES
(1, 'halothane', 1, 4177, 230, 20, 83540),
(2, 'isoflurane', 1, 4177, 240, 10, 41770),
(3, 'medical air', 1, 4177, 210, 40, 167080),
(4, 'nitrous oxide', 1, 4177, 230, 20, 83540),
(5, 'oxygen', 1, 4177, 190, 60, 250620),
(6, 'atracurium', 2, 559, 230, 20, 11180),
(7, 'cisatracurium', 2, 559, 238, 12, 6708),
(8, 'dantrolene', 2, 559, 220, 30, 16770),
(9, 'glycopyrronium', 2, 559, 230, 20, 11180),
(10, 'neostigmine', 2, 559, 250, 0, 0),
(11, 'acetylsaliclylic', 3, 8, 230, 20, 160),
(12, 'celecoxib', 3, 8, 230, 20, 160),
(13, 'Dexketoprofen', 3, 8, 200, 50, 400),
(14, 'Ibuprofen', 3, 8, 210, 40, 320),
(15, 'paracetamol', 3, 8, 240, 10, 80),
(16, 'chlorpheniramine', 4, 4, 250, 0, 0),
(17, 'dexamethasone', 4, 4, 250, 0, 0),
(18, 'adrenaline', 4, 4, 200, 50, 200),
(19, 'hydrocortisone', 4, 4, 250, 0, 0),
(20, 'Loratadine', 4, 4, 200, 50, 200),
(21, 'acetylcysteine', 5, 4, 230, 20, 80),
(22, 'atropine sulphate', 5, 4, 0, 250, 1000),
(23, 'Benztropine', 5, 4, 230, 20, 80),
(24, 'Calcium folinate', 5, 4, 220, 30, 120),
(25, 'Calcium gluconate', 5, 4, 250, 0, 0),
(26, 'cetrizine', 6, 7, 245, 5, 35),
(27, 'Panadol', 6, 7, 230, 20, 140);

-- --------------------------------------------------------

--
-- Stand-in structure for view `medicine reorder`
-- (See below for the actual view)
--
CREATE TABLE `medicine reorder` (
`name` varchar(255)
,`availableamt` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `medicinetype`
--

CREATE TABLE `medicinetype` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicinetype`
--

INSERT INTO `medicinetype` (`id`, `type`) VALUES
(1, 'anaesthetic'),
(2, 'muscle relaxants'),
(3, 'pain management'),
(4, 'antiallergies'),
(5, 'antidotes'),
(6, 'other');

-- --------------------------------------------------------

--
-- Stand-in structure for view `muscle relaxants`
-- (See below for the actual view)
--
CREATE TABLE `muscle relaxants` (
`name` varchar(255)
,`revenue` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `other`
-- (See below for the actual view)
--
CREATE TABLE `other` (
`name` varchar(255)
,`revenue` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pain management`
-- (See below for the actual view)
--
CREATE TABLE `pain management` (
`name` varchar(255)
,`revenue` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phonenos` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `firstname`, `lastname`, `phonenos`, `password`, `dob`, `email`, `date_added`) VALUES
(1, 'david ', 'allen', '0787654321', 'password', '2003-01-21', 'dave@example.com', '2023-04-24 07:12:44'),
(2, 'taylor', 'omondi', '0724681357', 'password', '2004-05-01', 'tayomo@example.com', '2023-04-24 11:22:53'),
(3, 'ruai', 'dak', '0713572468', 'password', '2001-01-01', 'ruaidak@example.com', '2023-05-02 10:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `scenario`
--

CREATE TABLE `scenario` (
  `id` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `doctor` int(11) NOT NULL,
  `symptoms` varchar(255) NOT NULL,
  `diagnosis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scenario`
--

INSERT INTO `scenario` (`id`, `patient`, `doctor`, `symptoms`, `diagnosis`) VALUES
(1, 1, 1, 'fever, coughing, loss of appetite', 'malaria'),
(2, 2, 1, 'sore throat,cold', 'cold'),
(3, 2, 1, 'sore throat', 'Cold'),
(4, 2, 1, 'sore throat,cold', 'asthma'),
(5, 2, 1, 'sore throat,cold', 'asthma'),
(6, 1, 1, 'pain in muscles', 'muscles'),
(7, 2, 1, 'dqwdawd', 'dawdwd'),
(8, 3, 1, 'nausea', 'dehydration'),
(9, 2, 3, 'sore throat,cold', 'asthma'),
(10, 2, 3, 'pain in muscles', 'sore muscle'),
(11, 3, 3, 'Fever', 'Viral Infection'),
(12, 2, 3, 'Pain and Inflammation', 'Musculoskeletal Injury'),
(13, 3, 3, 'Allergic Rhinitis', 'Allergic Reaction'),
(14, 3, 3, 'Anaemia', 'Iron Deficiency Anemia'),
(15, 2, 3, 'sore throat', 'allergic to ginger'),
(16, 1, 3, 'Lack of breath', 'Respiratory blockage'),
(17, 1, 3, 'Lack of breath', 'Respiratory blockage'),
(18, 3, 3, 'Swollen Abdomen', 'Surgery'),
(19, 2, 3, 'Headache', 'Stress'),
(20, 3, 3, 'sneezing', 'cold'),
(21, 3, 1, 'Swore leg', 'Injury'),
(22, 1, 1, 'sneezing', 'allergy'),
(23, 2, 1, 'blocked trachea', 'allergy'),
(24, 1, 1, 'fever, weak,low pressure', 'Blood infection'),
(25, 2, 1, 'fever, coughing, loss of appetite', 'infection'),
(26, 2, 1, 'fever, coughing, loss of appetite', 'infection'),
(27, 2, 1, 'low pressure', 'resusitation');

-- --------------------------------------------------------

--
-- Structure for view `anaesthetic`
--
DROP TABLE IF EXISTS `anaesthetic`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `anaesthetic`  AS SELECT `medicine`.`name` AS `name`, `medicine`.`revenue` AS `revenue` FROM `medicine` WHERE `medicine`.`type` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `antiallergies`
--
DROP TABLE IF EXISTS `antiallergies`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antiallergies`  AS SELECT `medicine`.`name` AS `name`, `medicine`.`revenue` AS `revenue` FROM `medicine` WHERE `medicine`.`type` = 4 ;

-- --------------------------------------------------------

--
-- Structure for view `antidotes`
--
DROP TABLE IF EXISTS `antidotes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `antidotes`  AS SELECT `medicine`.`name` AS `name`, `medicine`.`revenue` AS `revenue` FROM `medicine` WHERE `medicine`.`type` = 5 ;

-- --------------------------------------------------------

--
-- Structure for view `medicine reorder`
--
DROP TABLE IF EXISTS `medicine reorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `medicine reorder`  AS SELECT `medicine`.`name` AS `name`, `medicine`.`availableamt` AS `availableamt` FROM `medicine` ORDER BY `medicine`.`availableamt` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `muscle relaxants`
--
DROP TABLE IF EXISTS `muscle relaxants`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `muscle relaxants`  AS SELECT `medicine`.`name` AS `name`, `medicine`.`revenue` AS `revenue` FROM `medicine` WHERE `medicine`.`type` = 2 ;

-- --------------------------------------------------------

--
-- Structure for view `other`
--
DROP TABLE IF EXISTS `other`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `other`  AS SELECT `medicine`.`name` AS `name`, `medicine`.`revenue` AS `revenue` FROM `medicine` WHERE `medicine`.`type` = 6 ;

-- --------------------------------------------------------

--
-- Structure for view `pain management`
--
DROP TABLE IF EXISTS `pain management`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pain management`  AS SELECT `medicine`.`name` AS `name`, `medicine`.`revenue` AS `revenue` FROM `medicine` WHERE `medicine`.`type` = 3 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocation`
--
ALTER TABLE `allocation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor` (`doctor`),
  ADD KEY `medicine` (`medicine`),
  ADD KEY `patient` (`patient`),
  ADD KEY `scenario` (`scenario`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `medicinetype`
--
ALTER TABLE `medicinetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scenario`
--
ALTER TABLE `scenario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor` (`doctor`),
  ADD KEY `patient` (`patient`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocation`
--
ALTER TABLE `allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `medicinetype`
--
ALTER TABLE `medicinetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scenario`
--
ALTER TABLE `scenario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allocation`
--
ALTER TABLE `allocation`
  ADD CONSTRAINT `allocation_ibfk_1` FOREIGN KEY (`doctor`) REFERENCES `doctor` (`id`),
  ADD CONSTRAINT `allocation_ibfk_2` FOREIGN KEY (`medicine`) REFERENCES `medicine` (`id`),
  ADD CONSTRAINT `allocation_ibfk_3` FOREIGN KEY (`patient`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `allocation_ibfk_4` FOREIGN KEY (`scenario`) REFERENCES `scenario` (`id`);

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`type`) REFERENCES `medicinetype` (`id`);

--
-- Constraints for table `scenario`
--
ALTER TABLE `scenario`
  ADD CONSTRAINT `scenario_ibfk_1` FOREIGN KEY (`doctor`) REFERENCES `doctor` (`id`),
  ADD CONSTRAINT `scenario_ibfk_2` FOREIGN KEY (`patient`) REFERENCES `patient` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
