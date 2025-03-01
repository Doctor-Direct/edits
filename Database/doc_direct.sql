-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2025 at 06:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doc_direct`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appo_id` varchar(20) NOT NULL,
  `appo_name` varchar(100) NOT NULL,
  `patient_id` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appo_id`, `appo_name`, `patient_id`, `date`, `time`) VALUES
('APID20250101001', 'Kavinda Perera', 'PID2025010100001', '2025-01-10', '10:00:00'),
('APID20250101002', 'Nirosha Silva', 'PID2025010100002', '2025-01-11', '11:00:00'),
('APID20250101003', 'Ravindu Fernando', 'PID2025010100003', '2025-01-12', '09:30:00'),
('APID20250101004', 'Suresh Kumar', 'PID2025010100004', '2025-01-13', '14:00:00'),
('APID20250101005', 'Tharushi Rathnayake', 'PID2025010100005', '2025-01-14', '08:00:00'),
('APID20250101006', 'Hasini Gunasekara', 'PID2025010100006', '2025-01-15', '10:30:00'),
('APID20250101007', 'Kasun Jayasuriya', 'PID2025010100007', '2025-01-16', '12:00:00'),
('APID20250101008', 'Dilini Fonseka', 'PID2025010100008', '2025-01-17', '09:15:00'),
('APID20250101009', 'Dhananjaya Wickramasinghe', 'PID2025010100009', '2025-01-18', '15:30:00'),
('APID20250101010', 'Heshan Maduranga', 'PID2025010100010', '2025-01-19', '11:30:00'),
('APID20250101011', 'Ishara Weerakoon', 'PID2025010100011', '2025-01-20', '13:00:00'),
('APID20250101012', 'Kalpani Senanayake', 'PID2025010100012', '2025-01-21', '10:00:00'),
('APID20250101013', 'Chamath Silva', 'PID2025010100013', '2025-01-22', '16:00:00'),
('APID20250101014', 'Samanthi Rajapakse', 'PID2025010100014', '2025-01-23', '09:45:00'),
('APID20250101015', 'Rukshan Dias', 'PID2025010100015', '2025-01-24', '14:30:00'),
('APID20250101016', 'Thilini Perera', 'PID2025010100016', '2025-01-25', '11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `area_id` varchar(10) NOT NULL,
  `area_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`area_id`, `area_name`) VALUES
('ARR0001A', 'Ampara'),
('ARR0002A', 'Anuradhapura'),
('ARR0003A', 'Badulla'),
('ARR0004A', 'Batticaloa'),
('ARR0005A', 'Colombo'),
('ARR0006A', 'Galle'),
('ARR0007A', 'Gampaha'),
('ARR0008A', 'Hambantota'),
('ARR0009A', 'Jaffna'),
('ARR0010A', 'Kalutara'),
('ARR0011A', 'Kandy'),
('ARR0012A', 'Kegalle'),
('ARR0013A', 'Kilinochchi'),
('ARR0014A', 'Kurunegala'),
('ARR0015A', 'Mannar'),
('ARR0016A', 'Matale'),
('ARR0017A', 'Matara'),
('ARR0018A', 'Monaragala'),
('ARR0019A', 'Mullaitivu'),
('ARR0020A', 'Nuwara Eliya'),
('ARR0021A', 'Polonnaruwa'),
('ARR0022A', 'Puttalam'),
('ARR0023A', 'Ratnapura'),
('ARR0024A', 'Trincomalee'),
('ARR0025A', 'Vavuniya'),
('ARR0026A', 'Kalmunai'),
('ARR0027A', 'Mihintale'),
('ARR0028A', 'Akurana'),
('ARR0029A', 'Colombo District'),
('ARR0030A', 'Nugegoda'),
('ARR0031A', 'Negombo'),
('ARR0032A', 'Beruwala'),
('ARR0033A', 'Gampola'),
('ARR0034A', 'Weligama'),
('ARR0035A', 'Ruhunu');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` varchar(10) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
('CAT0001', 'General Practitioner'),
('CAT0002', 'Pediatrician'),
('CAT0003', 'Cardiologist'),
('CAT0004', 'Dermatologist'),
('CAT0005', 'Gynecologist'),
('CAT0006', 'Orthopedist'),
('CAT0007', 'Neurologist'),
('CAT0008', 'Dentist'),
('CAT0009', 'Psychiatrist'),
('CAT0010', 'Surgeon'),
('CAT0011', 'Ophthalmologist'),
('CAT0012', 'ENT Specialist'),
('CAT0013', 'Urologist'),
('CAT0014', 'Endocrinologist'),
('CAT0015', 'Radiologist');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` varchar(20) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `doctor_contact` varchar(15) NOT NULL,
  `doctor_email` varchar(100) DEFAULT NULL,
  `doctor_address` varchar(255) DEFAULT NULL,
  `category_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `doctor_name`, `username`, `password`, `doctor_contact`, `doctor_email`, `doctor_address`, `category_id`) VALUES
('DID2025001', 'Sudheera Thamashi', 'kith', '1234', '0714562886', 'sudheerat12@gmail.com', 'No: 142, De Crester Rd, Kollupitiya, Colombo', 'CAT0001'),
('DID2025002', 'Chathurika Dilani', 'chathurika', 'password456', '0714562887', 'chathurika@gmail.com', 'No: 112, Colombo Rd, Galle', 'CAT0002'),
('DID2025003', 'Saman Perera', 'samanperera', 'password789', '0714562888', 'saman@gmail.com', 'No: 45, Kandy Rd, Kandy', 'CAT0003'),
('DID2025004', 'Anjali Nisansala', 'anjali', 'mypassword123', '0714562889', 'anjali@gmail.com', 'No: 30, Colpetty, Colombo', 'CAT0004'),
('DID2025005', 'Tissa Wijeratne', 'tissaw', 'password654', '0714562890', 'tissa@gmail.com', 'No: 78, Matara Rd, Matara', 'CAT0005'),
('DID2025006', 'Ravi Kumara', 'ravi_kumara', 'password321', '0714562891', 'ravi@gmail.com', 'No: 99, Kurunegala Rd, Kurunegala', 'CAT0006'),
('DID2025007', 'Rukmani Jayasinghe', 'rukmanijaya', 'mypassword654', '0714562892', 'rukmani@gmail.com', 'No: 55, Batticaloa Rd, Batticaloa', 'CAT0007'),
('DID2025008', 'Kumarasiri Premachandra', 'kumara', 'password101', '0714562893', 'kumarasiri@gmail.com', 'No: 60, Ratnapura Rd, Ratnapura', 'CAT0008'),
('DID2025009', 'Sajitha Liyanage', 'sajithaliyanage', 'password202', '0714562894', 'sajitha@gmail.com', 'No: 123, Galle Rd, Galle', 'CAT0009'),
('DID2025010', 'Pradeep Kumara', 'pradeepk', 'password303', '0714562895', 'pradeep@gmail.com', 'No: 110, Polonnaruwa Rd, Polonnaruwa', 'CAT0010'),
('DID2025011', 'Anushka Vidanapathirana', 'anushkav', 'password404', '0714562896', 'anushka@gmail.com', 'No: 28, Jaffna Rd, Jaffna', 'CAT0011'),
('DID2025012', 'Lakshmi Ranjani', 'lakshmir', 'password505', '0714562897', 'lakshmi@gmail.com', 'No: 88, Kegalle Rd, Kegalle', 'CAT0012'),
('DID2025013', 'Ruwan Wijewardene', 'ruwanw', 'password606', '0714562898', 'ruwan@gmail.com', 'No: 52, Gampaha Rd, Gampaha', 'CAT0013'),
('DID2025014', 'Madusha Pathirana', 'madusha', 'password707', '0714562899', 'madusha@gmail.com', 'No: 45, Kurunegala Rd, Kurunegala', 'CAT0014'),
('DID2025015', 'Heshani Nandana', 'heshani', 'password808', '0714562900', 'heshani@gmail.com', 'No: 16, Trincomalee Rd, Trincomalee', 'CAT0015'),
('DID2025016', 'Chandana Samarawickrama', 'chandana', 'password909', '0714562901', 'chandana@gmail.com', 'No: 101, Badulla Rd, Badulla', 'CAT0001');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `hos_id` varchar(20) NOT NULL,
  `hos_name` varchar(100) NOT NULL,
  `hos_contact` varchar(15) DEFAULT NULL,
  `hos_email` varchar(100) DEFAULT NULL,
  `hos_address` text DEFAULT NULL,
  `area_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hos_id`, `hos_name`, `hos_contact`, `hos_email`, `hos_address`, `area_id`) VALUES
('HOSID000101', 'Colombo General Hospital', '0112345678', 'info@colombogeneral.lk', 'No: 45, Galle Road, Colombo', 'ARR0005A'),
('HOSID000102', 'Kandy Hospital', '0812345678', 'info@kandyhospital.lk', 'No: 12, Hospital Street, Kandy', 'ARR0011A'),
('HOSID000103', 'Negombo District Hospital', '0312345678', 'contact@negombohospital.lk', 'No: 10, Beach Road, Negombo', 'ARR0007A'),
('HOSID000104', 'Matara Teaching Hospital', '0412345678', 'info@matarahospital.lk', 'No: 50, Lake Road, Matara', 'ARR0017A'),
('HOSID000105', 'Gampaha General Hospital', '0332345678', 'contact@gampahahospital.lk', 'No: 30, Gampaha Town, Gampaha', 'ARR0007A'),
('HOSID000106', 'Jaffna Teaching Hospital', '0212345678', 'info@jaffnahospital.lk', 'No: 15, Hospital Lane, Jaffna', 'ARR0009A'),
('HOSID000107', 'Kurunegala Hospital', '0372345678', 'contact@kurunegalahospital.lk', 'No: 25, Kurunegala Road, Kurunegala', 'ARR0014A'),
('HOSID000108', 'Batticaloa General Hospital', '0652345678', 'info@batticaloahospital.lk', 'No: 70, Main Street, Batticaloa', 'ARR0004A'),
('HOSID000109', 'Ratnapura District Hospital', '0452345678', 'contact@ratnapurahospital.lk', 'No: 22, Ratnapura Road, Ratnapura', 'ARR0023A'),
('HOSID000110', 'Kalutara General Hospital', '0342345678', 'info@kalutarahospital.lk', 'No: 18, Cross Road, Kalutara', 'ARR0010A'),
('HOSID000111', 'Badulla General Hospital', '0552345678', 'info@badullahospital.lk', 'No: 10, Main Road, Badulla', 'ARR0003A'),
('HOSID000112', 'Trincomalee District Hospital', '0262345678', 'contact@trincomaleehospital.lk', 'No: 35, Hospital Street, Trincomalee', 'ARR0024A'),
('HOSID000113', 'Hambantota General Hospital', '0472345678', 'info@hambantotahospital.lk', 'No: 45, Hambantota Town, Hambantota', 'ARR0008A'),
('HOSID000114', 'Colombo South Teaching Hospital', '0112341234', 'contact@colombosouthhospital.lk', 'No: 75, Galle Road, Colombo', 'ARR0005A'),
('HOSID000115', 'Nuwara Eliya District Hospital', '0522345678', 'info@nuwareliyahospital.lk', 'No: 20, Nuwara Eliya Road, Nuwara Eliya', 'ARR0020A'),
('HOSID000116', 'Colombo North Teaching Hospital', '0112378456', 'info@colombonorthhospital.lk', 'No: 55, Ward Place, Colombo', 'ARR0005A'),
('HOSID000117', 'Sri Jayawardenepura General Hospital', '0112335678', 'contact@srijayawardenepurahospital.lk', 'No: 35, Kotte Road, Sri Jayawardenepura', 'ARR0016A'),
('HOSID000118', 'Anuradhapura Teaching Hospital', '0252345678', 'info@anuradhapurahospital.lk', 'No: 60, Hospital Road, Anuradhapura', 'ARR0002A'),
('HOSID000119', 'Vavuniya District Hospital', '0242345678', 'contact@vavuniyahospital.lk', 'No: 27, Vavuniya Road, Vavuniya', 'ARR0025A'),
('HOSID000120', 'Polonnaruwa District Hospital', '0272345678', 'info@polonnaruwahospital.lk', 'No: 14, Main Street, Polonnaruwa', 'ARR0021A');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` varchar(20) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `patient_birthday` date NOT NULL,
  `patient_nic` varchar(12) NOT NULL,
  `patient_contact_number` varchar(15) DEFAULT NULL,
  `patient_email` varchar(100) DEFAULT NULL,
  `patient_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `patient_name`, `patient_birthday`, `patient_nic`, `patient_contact_number`, `patient_email`, `patient_address`) VALUES
('PID2025010100001', 'Kavinda Perera', '1990-05-21', '900521801V', '0712345678', 'kavinda.p@gmail.com', 'No: 12, Main Street, Colombo 01'),
('PID2025010100002', 'Nirosha Silva', '1988-12-15', '881215203V', '0778345621', 'nirosha.s@gmail.com', 'No: 34, Temple Road, Kandy'),
('PID2025010100003', 'Ravindu Fernando', '1995-08-10', '950810501V', '0759123456', 'ravindu.f@gmail.com', 'No: 56, Highlevel Road, Nugegoda'),
('PID2025010100004', 'Suresh Kumar', '1986-01-30', '860130701V', '0709345123', 'suresh.k@yahoo.com', 'No: 89, Beach Road, Negombo'),
('PID2025010100005', 'Tharushi Rathnayake', '1993-07-19', '930719405V', '0768123904', 'tharushi.r@gmail.com', 'No: 42, Lake View, Galle'),
('PID2025010100006', 'Hasini Gunasekara', '1989-11-25', '891125102V', '0779456712', 'hasini.g@gmail.com', 'No: 25, Circular Road, Matara'),
('PID2025010100007', 'Kasun Jayasuriya', '1992-04-18', '920418303V', '0728345091', 'kasun.j@outlook.com', 'No: 15, Hill Street, Ratnapura'),
('PID2025010100008', 'Dilini Fonseka', '1991-09-05', '910905604V', '0789345120', 'dilini.f@gmail.com', 'No: 18, Kings Street, Jaffna'),
('PID2025010100009', 'Dhananjaya Wickramasinghe', '1987-02-11', '870211508V', '0747890345', 'dhananjaya.w@gmail.com', 'No: 30, Galle Road, Mount Lavinia'),
('PID2025010100010', 'Heshan Maduranga', '1994-06-22', '940622901V', '0719234890', 'heshan.m@gmail.com', 'No: 22, Airport Road, Katunayake'),
('PID2025010100011', 'Ishara Weerakoon', '1990-03-01', '900301805V', '0768123056', 'ishara.w@ymail.com', 'No: 10, Temple Road, Anuradhapura'),
('PID2025010100012', 'Kalpani Senanayake', '1985-10-30', '851030203V', '0709123456', 'kalpani.s@gmail.com', 'No: 35, Colombo Street, Badulla'),
('PID2025010100013', 'Chamath Silva', '1996-12-25', '961225603V', '0758234901', 'chamath.s@outlook.com', 'No: 48, Main Street, Kurunegala'),
('PID2025010100014', 'Samanthi Rajapakse', '1983-11-12', '831112104V', '0789456123', 'samanthi.r@gmail.com', 'No: 55, Circular Road, Trincomalee'),
('PID2025010100015', 'Rukshan Dias', '1988-04-08', '880408307V', '0718345092', 'rukshan.d@yahoo.com', 'No: 40, High Court Road, Gampaha'),
('PID2025010100016', 'Thilini Perera', '1992-01-14', '920114203V', '0778345100', 'thilini.p@gmail.com', 'No: 60, Cross Road, Kalutara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appo_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`hos_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `patient_nic` (`patient_nic`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD CONSTRAINT `hospitals_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area` (`area_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
