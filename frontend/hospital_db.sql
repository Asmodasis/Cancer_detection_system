SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
-- Database: `hospital_db`
--
-- --------------------------------------------------------
--
-- Table structure for table `admins`
--
CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` tinyint NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `admins` (`id`, `name`, `email`, `password`, `phone`, `role`, `created`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$BwEl8z7S9gcHbqFQIvAyd.8O.TshpLLvdBbpXYEIZtQIobYvvDCPy', '17148334897', '1', '2020-11-21 13:12:18');
-- --------------------------------------------------------
--
-- Table structure for table `doctors`
--
CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `specialist` varchar(255) NOT NULL,
  `role` tinyint NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Create first doctor into doctors table
--
INSERT INTO `doctors` (`id`, `name`, `email`, `password`, `phone`, `specialist`, `role`,`created`) VALUES
(1, 'Test Doctor', 'testdoctor@gmail.com', '$2y$10$BwEl8z7S9gcHbqFQIvAyd.8O.TshpLLvdBbpXYEIZtQIobYvvDCPy', '17758888886', 'Heart', '2', '2020-11-21 13:12:18');
-- --------------------------------------------------------
--
-- Table structure for table `nurses`
--
CREATE TABLE `nurses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` bit NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Create first nurse into nurse table
--
INSERT INTO `nurses` (`id`, `name`, `email`, `password`, `phone`, `role`, `created`) VALUES
(1, 'Test Nurse', 'testnurse@gmail.com', '$2y$10$BwEl8z7S9gcHbqFQIvAyd.8O.TshpLLvdBbpXYEIZtQIobYvvDCPy', '17758888887', '3', '2020-11-21 13:12:18');
-- --------------------------------------------------------
--
-- Table structure for table `patients`
--
CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` int(11) NOT NULL,
  `health_condition` varchar(255) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `nurse_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Create first patient in patients table
--
INSERT INTO `patients` (`id`, `name`, `phone`, `gender`, `health_condition`, `doctor_id`, `nurse_id`, `created`) VALUES
(1, 'Test Patient', '17758888888', 1, 'Breast Cancer', 1, 1, '2020-11-21 13:12:18');
-- --------------------------------------------------------
--
-- Table structure for table `images`
--
CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `cancerous` tinyint NOT NULL,
  `url` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--
--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `nurse_id` (`nurse_id`);
--
--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `nurses`
--
ALTER TABLE `nurses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- Constraints for dumped tables
--
--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `patients_ibfk_2` FOREIGN KEY (`nurse_id`) REFERENCES `nurses` (`id`);
 --
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);
COMMIT;