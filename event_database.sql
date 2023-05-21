-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 07:03 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `Coach_ID` varchar(11) NOT NULL,
  `Fname` text NOT NULL,
  `Mname` text NOT NULL,
  `Lname` text NOT NULL,
  `Email` text NOT NULL,
  `Phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`Coach_ID`, `Fname`, `Mname`, `Lname`, `Email`, `Phone`) VALUES
('6469b277210', 'MrJim', '', 'Dev', 'mrjim@gmail.com', '09454279198'),
('646a03c66e8', 'Ed', '', 'Sheeran', 'edsheeran@gmail.com', '09452748495'),
('646a046c95f', 'Justin', '', 'Bieber', 'justin@gmail.com', '09657838945'),
('646a04a2192', 'Shawn', '', 'Mendes', 'shawn@gmail.com', '09542348455');

-- --------------------------------------------------------

--
-- Table structure for table `convenors`
--

CREATE TABLE `convenors` (
  `Convenor_ID` varchar(11) NOT NULL,
  `Fname` text NOT NULL,
  `Mname` text NOT NULL,
  `Lname` text NOT NULL,
  `Email` text NOT NULL,
  `Phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `convenors`
--

INSERT INTO `convenors` (`Convenor_ID`, `Fname`, `Mname`, `Lname`, `Email`, `Phone`) VALUES
('646a04e1f0b', 'John', '', 'Doe', 'johndoe@gmail.com', '095427834894'),
('646a05345de', 'David', '', 'Anderson', 'anderson@gmail.com', '09537478923'),
('646a05549fb', 'Elon', '', 'Musk', 'elon@gmail.com', '08542345434'),
('646a0567bb0', 'Jeff', '', 'Bezos', 'jeff@gmail.com', '09544234434'),
('646a059a61d', 'Bill', 'Doe', 'Gates', 'bill@gmail.com', '09542355384');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `Event_ID` varchar(11) NOT NULL,
  `Event_Name` text NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `Location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`Event_ID`, `Event_Name`, `Start_Date`, `End_Date`, `Location`) VALUES
('646a07a7ceb', 'Championship Cup', '2023-05-01', '2023-05-06', '123 Main Street, Cityville, Stateville, Countryville'),
('646a07da9e8', 'Victory Challenge', '2023-05-07', '2023-05-13', '789 Oak Boulevard, Villageton, Stateville, Countryville');

-- --------------------------------------------------------

--
-- Table structure for table `event_convenors`
--

CREATE TABLE `event_convenors` (
  `Event_ID` varchar(11) NOT NULL,
  `Convenor_ID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_convenors`
--

INSERT INTO `event_convenors` (`Event_ID`, `Convenor_ID`) VALUES
('646a07a7ceb', '646a04e1f0b'),
('646a07a7ceb', '646a05345de'),
('646a07da9e8', '646a0567bb0'),
('646a07da9e8', '646a059a61d');

-- --------------------------------------------------------

--
-- Table structure for table `event_teams`
--

CREATE TABLE `event_teams` (
  `Event_ID` varchar(11) NOT NULL,
  `Team_ID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_teams`
--

INSERT INTO `event_teams` (`Event_ID`, `Team_ID`) VALUES
('646a07a7ceb', '646a020d106'),
('646a07a7ceb', '646a077e523'),
('646a07da9e8', '646a020d106'),
('646a07da9e8', '646a076c476'),
('646a07da9e8', '646a077e523');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `Player_ID` varchar(11) NOT NULL,
  `Fname` text NOT NULL,
  `Mname` text NOT NULL,
  `Lname` text NOT NULL,
  `BirthDate` text NOT NULL,
  `Gender` text NOT NULL,
  `Age` text NOT NULL,
  `Email` text NOT NULL,
  `Phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`Player_ID`, `Fname`, `Mname`, `Lname`, `BirthDate`, `Gender`, `Age`, `Email`, `Phone`) VALUES
('6469b261a9a', 'James Alein', 'Redoble', 'Ocampo', '2023-05-15', 'Male', '34', 'james@gmail.com', '09454279198'),
('646a02d4eb0', 'Emily', '', 'Johnson', '2023-05-17', 'Female', '18', 'mrjim.development@gmail.com', '09454279198'),
('646a030b215', 'Adrian', '', 'Alegarbes', '2023-05-02', 'Male', '21', 'adrian@gmail.com', '09532837582'),
('646a03447b1', 'Allen', '', 'Tiempo', '2023-05-24', 'Male', '21', 'allen@gmail.com', '09237584931'),
('646a03a7efb', 'Christian', 'Nacua', 'Cantiveros', '2023-05-09', 'Male', '21', 'christian@gmail.com', '09423342456'),
('646a057e8e9', 'Mark', '', 'Zuckerberg', '2023-05-07', 'Male', '34', 'mark@gmail.com', '09344452486');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `Team_ID` varchar(11) NOT NULL,
  `Team_Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`Team_ID`, `Team_Name`) VALUES
('646a020d106', 'Los Angeles Lakers'),
('646a076c476', 'Boston Celtics'),
('646a077e523', 'Golden State Warriors');

-- --------------------------------------------------------

--
-- Table structure for table `team_coaches`
--

CREATE TABLE `team_coaches` (
  `Team_ID` varchar(11) NOT NULL,
  `Coach_ID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_coaches`
--

INSERT INTO `team_coaches` (`Team_ID`, `Coach_ID`) VALUES
('646a020d106', '6469b277210'),
('646a020d106', '646a03c66e8'),
('646a076c476', '6469b277210'),
('646a076c476', '646a03c66e8');

-- --------------------------------------------------------

--
-- Table structure for table `team_players`
--

CREATE TABLE `team_players` (
  `Team_ID` varchar(11) NOT NULL,
  `Player_ID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_players`
--

INSERT INTO `team_players` (`Team_ID`, `Player_ID`) VALUES
('646a020d106', '6469b261a9a'),
('646a020d106', '646a02d4eb0'),
('646a076c476', '646a02d4eb0'),
('646a077e523', '646a030b215'),
('646a077e523', '646a03447b1'),
('646a077e523', '646a03a7efb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`Coach_ID`);

--
-- Indexes for table `convenors`
--
ALTER TABLE `convenors`
  ADD PRIMARY KEY (`Convenor_ID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`Event_ID`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`Player_ID`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`Team_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_convenors`
--
ALTER TABLE `event_convenors`
  ADD CONSTRAINT `Event_Convenors_FK1` FOREIGN KEY (`Convenor_ID`) REFERENCES `convenors` (`Convenor_ID`),
  ADD CONSTRAINT `Event_Convenors_FK2` FOREIGN KEY (`Event_ID`) REFERENCES `events` (`Event_ID`);

--
-- Constraints for table `event_teams`
--
ALTER TABLE `event_teams`
  ADD CONSTRAINT `Event_Teams_FK1` FOREIGN KEY (`Event_ID`) REFERENCES `events` (`Event_ID`),
  ADD CONSTRAINT `Event_Teams_FK2` FOREIGN KEY (`Team_ID`) REFERENCES `teams` (`Team_ID`);

--
-- Constraints for table `team_coaches`
--
ALTER TABLE `team_coaches`
  ADD CONSTRAINT `Team_Coaches_FK2` FOREIGN KEY (`Team_ID`) REFERENCES `teams` (`Team_ID`);

--
-- Constraints for table `team_players`
--
ALTER TABLE `team_players`
  ADD CONSTRAINT `Team_Players_FK2` FOREIGN KEY (`Team_ID`) REFERENCES `teams` (`Team_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
