-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2024 at 10:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jaya_hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin`, `email`, `password`) VALUES
(1, 'A', 'A@gmail.com', 'A'),
(2, 'Worker Ken', 'ken@gmail.com', 'ken'),
(3, 'Worker George', 'georgework@gmail.com', 'george');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `patient_email` varchar(100) NOT NULL,
  `patient_phone` varchar(15) NOT NULL,
  `medical_condition` varchar(255) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `appointment_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `notes` text DEFAULT NULL,
  `prescription` text DEFAULT NULL,
  `status` enum('active','done') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_name`, `patient_email`, `patient_phone`, `medical_condition`, `doctor_name`, `appointment_date`, `created_at`, `notes`, `prescription`, `status`) VALUES
(1, 'Teh Tze Ken', '', '', 'I am having a fever', 'Dr. Emma Robinson', '2024-09-26', '2024-09-02 14:28:27', '2 times a day for 3 weeks straight. Consume until finished.', 'Latanoprost', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_medicines`
--

CREATE TABLE `appointment_medicines` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `ethnicity` varchar(50) NOT NULL,
  `specialized_area` varchar(100) NOT NULL,
  `languages_spoken` varchar(255) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `gender`, `ethnicity`, `specialized_area`, `languages_spoken`, `profile_img`, `bio`) VALUES
(1, 'Dr. Chen Wei', 'Male', 'Chinese ', 'Orthopedics', 'English, Mandarin', 'Dr Chen Wei.jpg', 'Dr. Chen Wei is a distinguished neurologist with a focus on neurodegenerative diseases. He earned his medical degree from Peking University and completed his residency at UCLA. Dr. Wei is dedicated to advancing the understanding and treatment of Alzheimer\'s and Parkinson\'s diseases. He is fluent in Mandarin and English, enabling effective communication with a broad range of patients.'),
(2, 'Dr. David Kim', 'Male', 'Korean', 'Dermatology', 'English, Korean', 'Dr David Kim.jpg', 'Dr. David Kim is a board-certified dermatologist known for his expertise in skin cancer and cosmetic dermatology. He graduated from Seoul National University and completed his residency at the University of California, San Francisco. Dr. Kim combines advanced medical knowledge with a patient-centric approach, ensuring high-quality care. He speaks Korean and English fluently.'),
(3, 'Dr. Alexander Johnson', 'Male', 'Caucasian', 'Neurology, Epileptology', 'English, German', 'Dr. Alexander Johnson.jpg', 'Dr. Alexander Johnson is a distinguished neurologist with a specialization in epileptology. He received his medical degree from Harvard Medical School and completed his residency at the University of Munich. Dr. Johnson is dedicated to advancing the treatment of epilepsy and improving patient outcomes through research and clinical practice. He is fluent in English and German.'),
(4, 'Dr. Sofia Ivanova', 'Female', 'Slavic', 'Pulmonology, Interventional Pulmonology', 'English, Russian', 'Dr. Sofia Ivanova.jpg', 'Dr. Sofia Ivanova is a leading pulmonologist specializing in interventional pulmonology. She earned her medical degree from Moscow State University and completed her residency at the Cleveland Clinic. Dr. Ivanova is known for her expertise in minimally invasive procedures for lung diseases and is committed to providing top-notch care to her patients. She is fluent in English and Russian.'),
(5, 'Dr. David Li', 'Male', 'East Asian', 'Radiology, Interventional Radiology', 'English, Mandarin', 'Dr. David Li.jpg', 'Dr. David Li is a highly skilled radiologist specializing in interventional radiology. He earned his medical degree from Shanghai Jiao Tong University and completed his residency at the University of Chicago Medical Center. Dr. Li is dedicated to using minimally invasive techniques to diagnose and treat various medical conditions. He is fluent in English and Mandarin.'),
(6, 'Dr. Emma Robinson', 'Female', 'Caucasian', 'Endocrinology, Diabetes and Metabolism', 'English, German', 'Dr. Emma Robinson.jpg', 'Dr. Emma Robinson is a leading endocrinologist specializing in diabetes and metabolism. She obtained her medical degree from the University of Heidelberg and completed her residency at Massachusetts General Hospital. Dr. Robinson is committed to improving the lives of patients with endocrine disorders through cutting-edge treatments and research. She is fluent in English and German.'),
(7, 'Dr. John Smith', 'Male', 'Caucasian', 'Orthopedics', 'English', 'Dr Smith.jpg', 'Dr. John Smith is a renowned orthopedic surgeon with over 20 years of experience. He completed his medical education at Johns Hopkins University and his residency at the Cleveland Clinic. Dr. Smith specializes in joint replacement and sports injuries, known for his meticulous surgical skills and patient-centered care. He has contributed to numerous research studies and is actively involved in orthopedic innovation.'),
(8, 'Dr. Carlos Lopez', 'Male', 'Hispanic', 'Anesthesiology', 'English, Spanish', 'Dr. Carlos Lopez.jpg', 'Dr. Carlos Lopez is a skilled anesthesiologist known for his expertise in pain management. He earned his medical degree from the University of Buenos Aires and completed his residency at the Mayo Clinic. Dr. Lopez is dedicated to ensuring patient comfort and safety during surgical procedures. He speaks Spanish and English fluently.'),
(9, 'Dr. Elena Petrova', 'Female', 'Eastern European', 'Obstetrics and Gynecology', 'English, Russian', 'Dr. Elena Petrova.jpg', 'Dr. Elena Petrova is a compassionate obstetrician and gynecologist dedicated to women\'s health. She earned her medical degree from Moscow State University and completed her residency at the University of California, San Francisco. Dr. Petrova is known for her gentle approach and expertise in high-risk pregnancies. She speaks Russian and English fluently.'),
(10, 'Dr. Emily Nguyen', 'Female', 'Vietnamese', 'Immunology', 'English, Vietnamese', 'Dr. Emily Nguyen.jpg', 'Dr. Emily Nguyen is a dedicated immunologist specializing in autoimmune disorders. She earned her medical degree from Hanoi Medical University and completed her residency at the University of California, San Francisco. Dr. Nguyen is committed to providing comprehensive care and advancing research in immunology. She speaks Vietnamese and English fluently.'),
(11, 'Dr. Fatima Al-Salem', 'Female', 'Middle Eastern', 'Endocrinology', 'English, Arabic', 'Dr. Fatima Al-Salem.jpg', 'Dr. Fatima Al-Salem is a highly respected endocrinologist specializing in diabetes and thyroid disorders. She graduated from Cairo University and completed her residency at the Mayo Clinic. Dr. Al-Salem is committed to providing personalized care and education to her patients, helping them manage their conditions effectively. She is fluent in Arabic and English.'),
(12, 'Dr. Isabelle Martin', 'Female', 'French', 'Pulmonology', 'English, French', 'Dr. Isabelle Martin.jpg', 'Dr. Isabelle Martin is a skilled pulmonologist specializing in respiratory diseases. She earned her medical degree from the University of Paris and completed her residency at the Cleveland Clinic. Dr. Martin is dedicated to providing comprehensive care for patients with chronic lung conditions. She speaks French and English fluently.'),
(13, 'Dr. Jose Martinez', 'Male', 'Hispanic', 'Urology', 'English, Spanish', 'Dr. Jose Martinez.jpg', 'Dr. Jose Martinez is a dedicated urologist specializing in male reproductive health and urinary tract disorders. He received his medical degree from the University of Madrid and completed his residency at the Mayo Clinic. Dr. Martinez is committed to providing personalized care and improving patient outcomes. He speaks Spanish and English fluently.'),
(14, 'Dr. Lucy Wang', 'Female', 'Chinese ', 'Ophthalmology', 'English, Mandarin', 'Dr. Lucy Wang.jpg', 'Dr. Lucy Wang is a skilled ophthalmologist with expertise in cataract and refractive surgery. She earned her medical degree from Beijing Medical University and completed her residency at Johns Hopkins University. Dr. Wang is dedicated to improving her patients\' vision and quality of life. She speaks Mandarin and English fluently.'),
(15, 'Dr. Maria Gonzalez', 'Female', 'Hispanic', 'Gastroenterology', 'English, Spanish', 'Dr. Maria Gonzalez.jpg', 'Dr. Maria Gonzalez is a dedicated gastroenterologist with expertise in digestive health. She earned her medical degree from the University of Madrid and completed her residency at Mount Sinai Hospital. Dr. Gonzalez is passionate about colorectal cancer prevention and patient education. She is fluent in Spanish and English, providing care to a diverse patient population.'),
(16, 'Dr. Michael Johnson', 'Male', 'African American', ' Psychiatry', 'English, Amharic', 'Dr. Michael Johnson.jpg', 'Dr. Michael Johnson is a dedicated psychiatrist with a focus on mood disorders and psychotherapy. He received his medical degree from Harvard Medical School and completed his residency at Massachusetts General Hospital. Dr. Johnson is known for his empathetic approach and commitment to mental health advocacy. He speaks English.'),
(17, 'Dr. Nabil Hussein', 'Male', 'Middle Eastern', 'Nephrology', 'English, Arabic', 'Dr. Nabil Hussein.jpg', 'Dr. Nabil Hussein is a renowned nephrologist with a focus on kidney disease and dialysis. He received his medical degree from Cairo University and completed his residency at Johns Hopkins University. Dr. Hussein is committed to improving patient outcomes through advanced treatment options and patient education. He speaks Arabic and English fluently.'),
(18, 'Dr. Priya Patel', 'Female', 'Indian', 'Pediatrics', 'English, Hindi', 'Dr. Priya Patel.jpg', 'Dr. Priya Patel is a compassionate pediatrician dedicated to the health and well-being of children. She received her medical degree from AIIMS, India, and completed her residency at Boston Children\'s Hospital. Dr. Patel is known for her gentle approach and expertise in pediatric infectious diseases. She is fluent in both English and Hindi, making her a valuable asset to diverse communities.'),
(19, 'Dr. Sergey Ivanov', 'Male', 'Russian', 'Radiology', 'English, Russian', 'Dr. Sergey Ivanov.jpg', 'Dr. Sergey Ivanov is a skilled radiologist with expertise in diagnostic imaging. He received his medical degree from Moscow State University and completed his residency at the Mayo Clinic. Dr. Ivanov is dedicated to providing accurate and timely diagnoses, utilizing the latest imaging technologies. He speaks Russian and English fluently.'),
(20, 'Dr. Hana Yamada', 'Female', 'Japanese', 'Cardiology', 'English, Japanese', 'Hana Yamada.jpg', 'Dr. Hana Yamada is a renowned cardiologist specializing in heart disease prevention and treatment. She earned her medical degree from Kyoto University and completed her residency at Cleveland Clinic. Dr. Yamada is known for her dedication to patient-centered care and her contributions to cardiology research. She speaks Japanese and English fluently.'),
(21, 'Dr. Amina Mohamed', 'Female', 'African', 'Oncology', 'English, Swahili', 'Dr. Amina Mohamed.jpg', 'Dr. Amina Mohamed is a compassionate oncologist specializing in breast cancer treatment. She earned her medical degree from the University of Nairobi and completed her residency at MD Anderson Cancer Center. Dr. Mohamed is dedicated to providing personalized care and support to her patients throughout their cancer journey. She is fluent in Swahili and English.');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_calls`
--

CREATE TABLE `emergency_calls` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `medical_condition` varchar(255) NOT NULL,
  `situation` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_calls`
--

INSERT INTO `emergency_calls` (`id`, `full_name`, `medical_condition`, `situation`, `location`, `contact_info`, `created_at`) VALUES
(1, 'Arlont', 'Heart Attack', '1 first aider, his condition isnt good. theres alot of onlookers, about 5. He only has about 20 mins.', 'Latitude: 5.3410046, Longitude: 100.2896723', '018276488', '2024-08-19 12:56:50'),
(2, 'Teh Tze Ken', 'Cardiac Arrest', 'Alot of screaming', 'Latitude: 5.3372618, Longitude: 100.2784462', '012934004', '2024-08-19 13:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `username`, `email`, `feedback`, `created_at`) VALUES
(1, 'Teh Tze Ken', 'tzekeneci@gmail.com', 'I love this hospital!\\r\\n', '2024-08-19 07:40:36'),
(2, 'John Doe', 'johndoe@gmail.com', 'I love this hospital', '2024-08-19 07:41:47'),
(3, 'Jason', 'Spam@gmail.com', 'This is a great hospital website!', '2024-08-19 09:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_filename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `description`, `price`, `image_filename`) VALUES
(1, 'Paracetamol', 'Used to treat fever and mild to moderate pain.', 5.99, 'paracetamol.jpg'),
(2, 'Ibuprofen', 'Nonsteroidal anti-inflammatory drug (NSAID) for pain and inflammation.', 7.99, 'ibuprofen.jpg'),
(3, 'Aspirin', 'Used for pain, fever, and inflammation; also for cardiovascular protection.', 6.49, 'aspirin.jpg'),
(4, 'Amoxicillin', 'Antibiotic used to treat bacterial infections.', 12.99, 'amoxicillin.jpg'),
(5, 'Cough Syrup', 'Used to relieve coughing and sore throat.', 8.99, 'cough_syrup.jpg'),
(6, 'Loratadine', 'Antihistamine for allergy relief.', 9.49, 'loratadine.jpg'),
(7, 'Omeprazole', 'Proton pump inhibitor for reducing stomach acid.', 11.99, 'omeprazole.jpg'),
(8, 'Metformin', 'Used to manage type 2 diabetes.', 14.49, 'metformin.jpg'),
(9, 'Lisinopril', 'ACE inhibitor used for high blood pressure.', 13.99, 'lisinopril.jpg'),
(10, 'Simvastatin', 'Cholesterol-lowering medication.', 15.99, 'simvastatin.jpg'),
(11, 'Cetirizine', 'Antihistamine for allergy symptoms.', 10.99, 'cetirizine.jpg'),
(12, 'Hydrochlorothiazide', 'Diuretic used to treat high blood pressure and fluid retention.', 12.99, 'hydrochlorothiazide.jpg'),
(13, 'Fluoxetine', 'Antidepressant used to treat depression and anxiety.', 16.49, 'fluoxetine.jpg'),
(14, 'Prednisone', 'Corticosteroid used to reduce inflammation.', 14.99, 'prednisone.jpg'),
(15, 'Diphenhydramine', 'Antihistamine for allergy relief and sleep aid.', 8.49, 'diphenhydramine.jpg'),
(16, 'Clopidogrel', 'Antiplatelet drug used to prevent strokes and heart attacks.', 13.49, 'clopidogrel.jpg'),
(17, 'Zithromax', 'Antibiotic used to treat various infections.', 17.99, 'zithromax.jpg'),
(18, 'Tamsulosin', 'Used to treat symptoms of enlarged prostate.', 11.49, 'tamsulosin.jpg'),
(19, 'Doxycycline', 'Antibiotic used to treat a variety of infections.', 15.49, 'doxycycline.jpg'),
(20, 'Albuterol', 'Bronchodilator used to treat asthma and COPD.', 9.99, 'albuterol.jpg'),
(21, 'Gabapentin', 'Used to treat nerve pain and seizures.', 13.99, 'gabapentin.jpg'),
(22, 'Ranitidine', 'Used to reduce stomach acid and treat ulcers.', 7.49, 'ranitidine.jpg'),
(23, 'Tramadol', 'Pain medication used to treat moderate to severe pain.', 14.49, 'tramadol.jpg'),
(24, 'Venlafaxine', 'Antidepressant used to treat depression and anxiety disorders.', 16.99, 'venlafaxine.jpg'),
(25, 'Lorazepam', 'Used to treat anxiety and sleep disorders.', 12.49, 'lorazepam.jpg'),
(26, 'Losartan', 'Angiotensin II receptor blocker for high blood pressure.', 13.99, 'losartan.jpg'),
(27, 'Sildenafil', 'Used to treat erectile dysfunction.', 18.99, 'sildenafil.jpg'),
(28, 'Atorvastatin', 'Cholesterol-lowering medication.', 14.99, 'atorvastatin.jpg'),
(29, 'Ciproflxacin', 'Antibiotic used to treat various bacterial infections.', 17.49, 'ciprofloxacin.jpg'),
(30, 'Metoprolol', 'Beta-blocker used to treat high blood pressure and heart conditions.', 13.49, 'metoprolol.jpg'),
(31, 'Naproxen', 'NSAID used to treat pain and inflammation.', 9.99, 'naproxen.jpg'),
(32, 'Amlodipine', 'Calcium channel blocker used for high blood pressure.', 11.99, 'amlodipine.jpg'),
(33, 'Methylprednisolone', 'Corticosteroid used to treat inflammation and autoimmune conditions.', 16.49, 'methylprednisolone.jpg'),
(34, 'Ezetimibe', 'Used to lower cholesterol levels.', 15.49, 'ezetimibe.jpg'),
(35, 'Hydroxyzine', 'Antihistamine used to treat allergy symptoms and anxiety.', 10.49, 'hydroxyzine.jpg'),
(36, 'Warfarin', 'Anticoagulant used to prevent blood clots.', 13.99, 'warfarin.jpg'),
(37, 'Spironolactone', 'Diuretic used to treat high blood pressure and fluid retention.', 14.99, 'spironolactone.jpg'),
(38, 'Buspirone', 'Anti-anxiety medication used to treat generalized anxiety disorder.', 12.49, 'buspirone.jpg'),
(39, 'Finasteride', 'Used to treat enlarged prostate and hair loss.', 11.49, 'finasteride.jpg'),
(40, 'Latanoprost', 'Used to treat glaucoma by reducing eye pressure.', 15.99, 'latanoprost.jpg'),
(41, 'Furosemide', 'Diuretic used to treat fluid retention and high blood pressure.', 10.99, 'furosemide.jpg'),
(42, 'Clonazepam', 'Used to treat seizures and panic disorders.', 13.49, 'clonazepam.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `mykad` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `insurance` varchar(255) DEFAULT NULL,
  `allergies` text DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `past_medical_conditions` text DEFAULT NULL,
  `previous_surgeries` text DEFAULT NULL,
  `family_medical_history` text DEFAULT NULL,
  `emergency_contact_name` varchar(255) DEFAULT NULL,
  `emergency_contact_relationship` varchar(50) DEFAULT NULL,
  `emergency_contact_phone` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `consent_for_information_sharing` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone_number`, `age`, `mykad`, `address`, `insurance`, `allergies`, `gender`, `past_medical_conditions`, `previous_surgeries`, `family_medical_history`, `emergency_contact_name`, `emergency_contact_relationship`, `emergency_contact_phone`, `date_of_birth`, `medical_history`, `consent_for_information_sharing`) VALUES
(1, 'Teh Tze Ken', 'tzekeneci@gmail.com', 'kenkenken', '0173925380', 16, '69420', 'Sesame Street', 'AIA', 'Lactose Intolerance', 'Male', NULL, NULL, NULL, 'John Doe', 'Friend', '999', '2008-10-17', '\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nMonkeypox\r\nMonkeypox\r\nMonkeypox\r\nMonkeypox\r\nMonkeypox\r\nMonkeypox\r\nMonkeypox\r\nMonkeypox\r\nMonkeypox\r\nMonkeypox\r\nNo monkeypox\r\nPokkai\r\nPokkai\r\nPokkai\r\nno pok\r\nno pok\r\nPokkai\r\npupil\r\npupil\r\npupil\r\npupil\r\nHe has Monkey Pox\r\nParacetamol 2 times per day to ease fever for 3 weeks\r\nHe has Monkey Pox\r\nParacetamol 2 times per day to ease fever for 3 weeks\r\nHe has monkeypox\r\nParacetamol 2 times per week\r\nHe has monkeypox\r\nParacetamol 2 times per week\r\nHe has monkeypox\r\nParacetamol 2 times per week\r\nHe has monkeypox\r\nParacetamol 2 times per week\r\nHe has monkeypox\\r\\nParacetamol 2 times per week\r\nHe has monkeypox\\r\\nParacetamol 2 times per week\r\nHe has monkeypox\\r\\nParacetamol 2 times per week\r\nHe has monkeypox\\\\r\\\\nParacetamol 2 times per week\r\nHe has monkeypox\r\nHe has monkeypox\r\nHe has monkeypox\r\nHe has monkeypox\r\nHe has monkeypox\r\nHe has monkeypox\r\nHe has Monkeypox Paracetamol 2 times per day For 1 Week \r\n\r\n\r\n3 Doses Of Finasteride Per Day For 3 weeks\r\n3 Doses Of Finasteride Per Day For 3 weeks\r\n3 Doses Of Finasteride Per Day For 3 weeks\r\nAAA\r\nAAA\r\nAAA\nAAAA\nAAAA\nAAAA', 1),
(2, 'John Doe', 'john.doe@example.com', 'password123', '0123456789', 35, '901225-14-1234', '123 Main St, City, State, 12345', 'Company A', 'None', 'Male', 'Hypertension', 'Appendectomy', 'Heart Disease', 'Jane Doe', 'Spouse', '0198765432', '1989-12-25', 'Regular Checkups', 1),
(3, 'Emily Smith', 'emily.smith@example.com', 'password456', '0987654321', 28, '950315-06-5678', '456 Elm St, Town, Region, 67890', 'Company B', 'Penicillin', 'Female', 'Asthma', 'None', 'Diabetes', 'Michael Smith', 'Brother', '0176543210', '1995-03-15', 'Asthma Treatment', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_medicines`
--
ALTER TABLE `appointment_medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_calls`
--
ALTER TABLE `emergency_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `appointment_medicines`
--
ALTER TABLE `appointment_medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `emergency_calls`
--
ALTER TABLE `emergency_calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_medicines`
--
ALTER TABLE `appointment_medicines`
  ADD CONSTRAINT `appointment_medicines_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`),
  ADD CONSTRAINT `appointment_medicines_ibfk_2` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
