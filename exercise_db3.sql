-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2022 at 04:28 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exercise_db3`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_selector_p`
--

CREATE TABLE `form_selector_p` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_estonian_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_estonian_ci;

--
-- Dumping data for table `form_selector_p`
--

INSERT INTO `form_selector_p` (`id`, `name`, `parent_id`) VALUES
(1, 'Manufacturing', NULL),
(2, 'Service', NULL),
(3, 'Other', NULL),
(5, 'Printing', 1),
(6, 'Food and Beverage', 1),
(7, 'Textile and Clothing', 1),
(8, 'Wood', 1),
(9, 'Plastic and Rubber', 1),
(11, 'Metalworking', 1),
(12, 'Machinery', 1),
(13, 'Furniture', 1),
(18, 'Electronics and Optics', 1),
(19, 'Construction materials', 1),
(21, 'Transport and Logistics', 2),
(22, 'Tourism', 2),
(25, 'Business services', 2),
(28, 'Information Technology and Telecommunications', 2),
(29, 'Energy technology', 3),
(33, 'Environment', 3),
(35, 'Engineering', 2),
(37, 'Creative industries', 3),
(39, 'Milk &amp; dairy products', 6),
(40, 'Meat &amp; meat products', 6),
(42, 'Fish &amp; fish products', 6),
(43, 'Beverages', 6),
(44, 'Clothing', 7),
(45, 'Textile', 7),
(47, 'Wooden houses', 8),
(51, 'Wooden building materials', 8),
(53, 'Plastics welding and processing', 559),
(54, 'Packaging', 9),
(55, 'Blowing', 559),
(57, 'Moulding', 559),
(62, 'Forgings, Fasteners', 542),
(66, 'MIG, TIG, Aluminum welding', 542),
(67, 'Construction of metal structures', 11),
(69, 'Gas, Plasma, Laser cutting', 542),
(75, 'CNC-machining', 542),
(91, 'Machinery equipment/tools', 12),
(93, 'Metal structures', 12),
(94, 'Machinery components', 12),
(97, 'Maritime', 12),
(98, 'Kitchen', 13),
(99, 'Project furniture', 13),
(101, 'Living room', 13),
(111, 'Air', 21),
(112, 'Road', 21),
(113, 'Water', 21),
(114, 'Rail', 21),
(121, 'Software, Hardware', 28),
(122, 'Telecommunications', 28),
(141, 'Translation services', 2),
(145, 'Labelling and packaging printing', 5),
(148, 'Advertising', 5),
(150, 'Book/Periodicals printing', 5),
(224, 'Manufacture of machinery', 12),
(227, 'Repair and maintenance service', 12),
(230, 'Ship repair and conversion', 97),
(263, 'Houses and buildings', 11),
(267, 'Metal products', 11),
(269, 'Boat/Yacht building', 97),
(271, 'Aluminium and steel workboats', 97),
(337, 'Other (Wood)', 8),
(341, 'Outdoor', 13),
(342, 'Bakery &amp; confectionery products', 6),
(378, 'Sweets &amp; snack food', 6),
(385, 'Bedroom', 13),
(389, 'Bathroom/sauna', 13),
(390, 'Children\'s room', 13),
(392, 'Office', 13),
(394, 'Other (Furniture)', 13),
(437, 'Other', 6),
(508, 'Other', 12),
(542, 'Metal works', 11),
(556, 'Plastic goods', 9),
(559, 'Plastic processing technology', 9),
(560, 'Plastic profiles', 9),
(576, 'Programming, Consultancy', 28),
(581, 'Data processing, Web portals, E-marketing', 28);

-- --------------------------------------------------------

--
-- Table structure for table `selector_to_user`
--

CREATE TABLE `selector_to_user` (
  `id` int(6) UNSIGNED NOT NULL,
  `selector_id` int(11) DEFAULT NULL,
  `user_submit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_estonian_ci;

--
-- Dumping data for table `selector_to_user`
--

INSERT INTO `selector_to_user` (`id`, `selector_id`, `user_submit_id`) VALUES
(3, 18, 1),
(4, 19, NULL),
(5, 18, NULL),
(8, 19, NULL),
(9, 6, NULL),
(74, 1, 2),
(75, 1, NULL),
(78, 19, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_submit`
--

CREATE TABLE `user_submit` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_estonian_ci DEFAULT NULL,
  `agree` tinyint(1) DEFAULT NULL,
  `selector_to_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_estonian_ci;

--
-- Dumping data for table `user_submit`
--

INSERT INTO `user_submit` (`id`, `name`, `agree`, `selector_to_user_id`) VALUES
(2, 'Magnus', 1, NULL),
(3, 'Magnus1', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_selector_p`
--
ALTER TABLE `form_selector_p`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selector_to_user`
--
ALTER TABLE `selector_to_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_submit`
--
ALTER TABLE `user_submit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_selector_p`
--
ALTER TABLE `form_selector_p`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=582;

--
-- AUTO_INCREMENT for table `selector_to_user`
--
ALTER TABLE `selector_to_user`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `user_submit`
--
ALTER TABLE `user_submit`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
