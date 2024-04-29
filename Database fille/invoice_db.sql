--
-- Database: `pharmacy-db`
--
CREATE DATABASE IF NOT EXISTS `pharmacy-db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pharmacy-db`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Security_Code` int(55) NOT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Security_Code`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Administrator', 'admin', 0771234567, 1111, 'admin@gmail.com', 'Password@123', '2024-04-05 05:38:23');

-- --------------------------------------------------------
--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--