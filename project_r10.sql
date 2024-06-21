-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21 يونيو 2024 الساعة 04:39
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_r10`
--

-- --------------------------------------------------------

--
-- بنية الجدول `category`
--

CREATE TABLE `category` (
  `cat_name` varchar(225) NOT NULL,
  `id` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `category`
--

INSERT INTO `category` (`cat_name`, `id`) VALUES
('Human Resource', 8),
('Graphic Design', 10);

-- --------------------------------------------------------

--
-- بنية الجدول `courses`
--

CREATE TABLE `courses` (
  `id` int(1) NOT NULL,
  `Title` varchar(225) NOT NULL,
  `Content` varchar(225) NOT NULL,
  `Location` varchar(225) NOT NULL,
  `Price` int(255) NOT NULL,
  `Active` tinyint(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Category_id` int(11) NOT NULL,
  `click_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `courses`
--

INSERT INTO `courses` (`id`, `Title`, `Content`, `Location`, `Price`, `Active`, `Image`, `Category`, `Date`, `Category_id`, `click_count`) VALUES
(34, 'Data Analysis using R', 'Data Analysis using R', 'Remote', 123, 0, '', '', '2024-07-05', 8, 2),
(35, 'Accounting using Excel', 'Contents of Accounting using Excel', 'Remote', 120, 1, 'صورة3.png', '', '2024-08-22', 8, 1),
(36, 'Quality Mangments', 'Contents Quality Mangments', 'Remote', 121, 1, 'صورة3.png', '', '2024-08-16', 8, 4),
(37, 'Writing CV', 'Contents Writing CV', 'Remote', 144, 1, 'صورة3.png', '', '2024-07-18', 8, 2),
(39, 'Email Microcopy', 'Contents Email Microcopy', 'Remote', 123, 1, 'صورة3.png', '', '2024-09-26', 8, 0),
(40, 'Intro to adobe Photosop', 'Contents Intro to adobe Photosop', 'Remote', 140, 1, 'Screenshot 2024-01-31 212322.png', '', '2024-09-28', 10, 0),
(41, 'Writing screen play', 'Contents Writing screen play', 'Remote', 115, 1, 'Screenshot 2024-02-04 202905.png', '', '2024-05-01', 8, 0);

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Email` varchar(225) NOT NULL,
  `Active` tinyint(4) NOT NULL,
  `Password` varchar(225) NOT NULL,
  `username` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `Email`, `Active`, `Password`, `username`) VALUES
(1, 'fatma', 'fatemah.it@gmail.com', 1, '$2y$10$x00F9VPRYPxeQH88TdBQU.I38D3P7JrRekLvBnObKcDj7dgVVF/9K', '19420391'),
(2, 'yao', 'fatemah.it@gmail.com', 0, '$2y$10$M/0iSdK7WG/RWaYFvfBIMu1oTzifATjsOIFhL6MJm5bqBzlOATe0y', '19420391'),
(3, 'ddd', 'inu@ggg.com', 0, '$2y$10$WZbQqdHFUEvh3uu6VM7Hw.BeFsxVNfWoBVHBtUlJD97P/mGcEm3Mm', '19420391'),
(4, 'fatma', 'ino20012@gmail.com', 1, '$2y$10$3W5fENXhIjAfJQWWPhTzLeICMAfMGLrUnNNFY2K9Br.3ZgNdDMII2', 'xxfatj'),
(5, 'fatma', 'fatemah.it@gmail.com', 1, '$2y$10$JA9ipNxHzwUgyiHSKkjl2OgH6tPliInLPrQ9cYLg1PqKPKe1aIoti', 'xxfatj'),
(6, 'ddd', 'inu@ggg.com', 0, '$2y$10$/5GC0ZrXFNASHZe9To0CWuo5Ag7/NYIsQib8zwZbi3veU2cxJSw8S', '19420391'),
(7, 'AOU grads', 'inu@ggg.com', 0, '$2y$10$Xk974ucQZQZ5Jh6mSv/.7ud86QvzSfrqT8Mu1ufRGBQWh3tpp2Xze', 'fatemah.it@gmail.com'),
(8, 'SSSSS', 'fatemah.it@gmail.com', 0, '$2y$10$JH8mqKyCs9paK1Fz708bVOPhJtJ/bX112esMFJylbgJQ.WxRNYbIm', 'hala'),
(9, 'ddd', 'inu@ggg.com', 0, '$2y$10$OfZFTJ0V233aAQ.R8iPKZ.GBipAF2Mcl7TPGrFSvPpvZQUAsXu7l2', 'xxfatj'),
(10, 'ddd', 'inu@ggg.com', 0, '$2y$10$IVQmAFsALA0bwhglFUVHz.KY7uQATk9Ta.BvK5vdbA.1Ejt8um5OS', 'xxfatj'),
(11, 'fatma', 'ino20012@gmail.com', 0, '$2y$10$8JMI3jQLxORRrIree4wJueEWbCkmiCGR98Vnd5GKZemHUPlfjYESO', 'fatemah.it@gmail.com'),
(12, 'fatma', 'ino20012@gmail.com', 0, '$2y$10$w4cmby4cFw75Os/q8K94FeYmiFKPLw3zwJ5gfkeUpA7eFy93rHu7W', 'fatemah.it@gmail.com'),
(13, 'fatma', 'ino20012@gmail.com', 0, '$2y$10$HEhRNZU4ytAd34ePjRWHROnO.7Ow/AOYONWAC.d/.WfB6zC52doc.', 'fatemah.it@gmail.com'),
(14, 'asma', 'asmaa@12.com', 1, '$2y$10$kKqkZ0Z8.QDU.fmX0zxXL.hhpUeCD8rjT2qFUd/itltoOkfu57HbS', 'asmaa'),
(15, 'asma', 'asmaa@12.com', 1, '$2y$10$4r3Oshy1NJ0PWSJyRU46E.qPeM5yMEjAUMOZmAGw4fq6PYHxU0jfq', 'asmaa'),
(16, 'asma', 'asmaa@12.com', 1, '$2y$10$74huCm3aZHt6jv0Z4ejSc.c.4vw0Z66Rta2E0V7.Gq0pe39RbMup6', 'asmaa'),
(17, 'hey', 'faxxtemah.it@gmail.com', 0, '$2y$10$gHLV6WC4Wfnh9wYJKZN4pu0tcGfHp1RqeyUSgBNu4JkyuBrQAUg3O', 'xxx');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`Category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`Category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
