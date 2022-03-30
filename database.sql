-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 30, 2022 at 07:27 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuwait_passport_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = inactive, 1 = active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Taurean Ankunding', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(2, 'Prof. Roel Romaguera Jr.', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(3, 'Davin Smith', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(4, 'Ms. Aida Hayes', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(5, 'Vivian Stroman Jr.', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `name`, `cost`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Estel Lubowitz', NULL, '1', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL),
(2, 'Micah Bartoletti Sr.', NULL, '1', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `express_services`
--

CREATE TABLE `express_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `passport_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_photocopy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kuwait_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bd_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `extended_to` date DEFAULT NULL,
  `special_skill` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residence` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `other_service_fee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `versetilo_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agency_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `govt_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consulttants_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_taken` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `deleted_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ems` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Express Service',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `immigration_govement_services`
--

CREATE TABLE `immigration_govement_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `passport_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_photocopy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kuwait_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bd_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `extended_to` date DEFAULT NULL,
  `special_skill` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residence` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `other_service_fee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `versetilo_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agency_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `govt_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consulttants_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_taken` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `deleted_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ems` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Immigration Govt. Service',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `last_login_infos`
--

CREATE TABLE `last_login_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `session_data` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `machine_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_string` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `legal_complaints_services`
--

CREATE TABLE `legal_complaints_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `passport_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_photocopy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kuwait_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bd_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `extended_to` date DEFAULT NULL,
  `special_skill` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residence` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `other_service_fee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `versetilo_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agency_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `govt_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consulttants_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_taken` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `deleted_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ems` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Legal Complaints Service',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lost_passports`
--

CREATE TABLE `lost_passports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_creator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `profession_id` bigint(20) UNSIGNED DEFAULT NULL,
  `passport_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `de_id_for_bio` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civil_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ems` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_photocopy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kuwait_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bd_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_skill` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residence` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` timestamp NULL DEFAULT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `delivery_branch` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gd_report_kuwait` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_form` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shift_to_admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = branch manager to admin ',
  `embassy_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = receive from admin , 3 = send to admin ',
  `branch_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = nothing , 1 = received from admin , 3 = delivery to user ',
  `is_delivered` tinyint(1) NOT NULL DEFAULT 0,
  `is_shifted_to_branch_manager` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_government_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_versatilo_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_fees_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_verify_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `bio_enrollment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_mrp_passport_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks_by` tinyint(1) DEFAULT NULL,
  `delivery_method` tinyint(1) DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Lost Passport',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_shifted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lost_passports`
--

INSERT INTO `lost_passports` (`id`, `user_creator_id`, `branch_id`, `deleted_by`, `profession_id`, `passport_type_id`, `de_id_for_bio`, `name`, `passport_number`, `civil_id`, `mailing_address`, `permanent_address`, `ems`, `profession_file`, `passport_photocopy`, `kuwait_phone`, `bd_phone`, `special_skill`, `residence`, `delivery_date`, `salary`, `date`, `dob`, `delivery_branch`, `gd_report_kuwait`, `application_form`, `shift_to_admin`, `embassy_status`, `branch_status`, `is_delivered`, `is_shifted_to_branch_manager`, `passport_type_title`, `passport_type_government_fee`, `passport_type_versatilo_fee`, `passport_type_fees_total`, `r_id`, `entry_person`, `otp`, `otp_verify_at`, `status`, `bio_enrollment_id`, `new_mrp_passport_no`, `remarks`, `remarks_by`, `delivery_method`, `model_name`, `created_at`, `updated_at`, `deleted_at`, `is_shifted`) VALUES
(1, 3, 1, NULL, 1, NULL, NULL, 'Prof. Kyle Auer Jr.', '445-687-1514', '1-610-879-8687', 'aron40@yahoo.com', 'Aruba', 'Tenetur.', NULL, NULL, '01777382007', '01777382007', NULL, 'Paraguay', '2022-04-04 02:25:23', '4', NULL, NULL, '4', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, '462', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(2, 2, 5, NULL, 1, NULL, NULL, 'Mathew McDermott', '(239) 784-8606', '(323) 616-5961', 'collier.tristian@yahoo.com', 'Saint Kitts and Nevis', 'Dicta eos.', NULL, NULL, '01777382007', '01777382007', NULL, 'Namibia', '2022-04-04 02:25:23', '4', NULL, NULL, '1', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '20', NULL, NULL, 1, NULL, NULL, '431', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(3, 2, 2, NULL, 1, NULL, NULL, 'Wava Jerde', '1-401-861-8472', '(661) 802-7412', 'victor.kuphal@hotmail.com', 'Saudi Arabia', 'Nobis.', NULL, NULL, '01777382007', '01777382007', NULL, 'Saint Lucia', '2022-04-04 02:25:23', '1', NULL, NULL, '3', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, '539', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(4, 2, 2, NULL, 1, NULL, NULL, 'Cesar Runolfsdottir', '1-712-273-5443', '+1.320.758.5396', 'brendon.hickle@bashirian.info', 'Liberia', 'Facilis.', NULL, NULL, '01777382007', '01777382007', NULL, 'Heard Island and McDonald Islands', '2022-04-04 02:25:23', '2', NULL, NULL, '3', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, '873', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(5, 3, 3, NULL, 1, NULL, NULL, 'Prof. Malcolm Hermann', '559-549-5963', '567.396.7038', 'qmuller@harvey.com', 'Samoa', 'Nam eum.', NULL, NULL, '01777382007', '01777382007', NULL, 'Svalbard & Jan Mayen Islands', '2022-04-04 02:25:23', '2', NULL, NULL, '4', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, '479', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(6, 3, 1, NULL, 1, NULL, NULL, 'Gerson D\'Amore', '(251) 837-3607', '(240) 932-0492', 'savanna.erdman@lehner.org', 'Finland', 'Iste.', NULL, NULL, '01777382007', '01777382007', NULL, 'Namibia', '2022-04-04 02:25:23', '2', NULL, NULL, '4', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, '548', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(7, 4, 5, NULL, 1, NULL, NULL, 'Josefa Goldner', '512-852-2290', '310-375-1047', 'uhomenick@harber.com', 'Botswana', 'Nemo.', NULL, NULL, '01777382007', '01777382007', NULL, 'Maldives', '2022-04-04 02:25:23', '4', NULL, NULL, '2', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '236', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(8, 3, 4, NULL, 1, NULL, NULL, 'Prof. Ludwig Hickle', '1-203-492-0085', '+12767346919', 'jalon.monahan@yahoo.com', 'Mauritania', 'Et.', NULL, NULL, '01777382007', '01777382007', NULL, 'Guatemala', '2022-04-04 02:25:23', '4', NULL, NULL, '1', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '125', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(9, 4, 4, NULL, 1, NULL, NULL, 'Cortez Watsica MD', '1-234-662-1084', '+12156838005', 'hnicolas@hotmail.com', 'Christmas Island', 'Alias.', NULL, NULL, '01777382007', '01777382007', NULL, 'Azerbaijan', '2022-04-04 02:25:23', '3', NULL, NULL, '2', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, '627', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(10, 2, 3, NULL, 1, NULL, NULL, 'Leo Schroeder', '434.923.8879', '1-715-291-8334', 'harber.jamir@conn.com', 'Guinea', 'Et eum.', NULL, NULL, '01777382007', '01777382007', NULL, 'Bhutan', '2022-04-04 02:25:23', '2', NULL, NULL, '1', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '20', NULL, NULL, 1, NULL, NULL, '846', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(11, 3, 1, NULL, 1, NULL, NULL, 'Jesse Stroman', '+1.857.500.6878', '(845) 803-4240', 'gianni.hand@zieme.com', 'Egypt', 'Molestiae.', NULL, NULL, '01777382007', '01777382007', NULL, 'Timor-Leste', '2022-04-04 02:25:23', '4', NULL, NULL, '4', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, '123', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(12, 1, 3, NULL, 1, NULL, NULL, 'Maybelle Hand', '+1.662.673.5942', '(332) 727-6594', 'alvis82@hotmail.com', 'Burundi', 'Qui.', NULL, NULL, '01777382007', '01777382007', NULL, 'Singapore', '2022-04-04 02:25:23', '4', NULL, NULL, '3', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '20', NULL, NULL, 1, NULL, NULL, '734', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(13, 1, 1, NULL, 1, NULL, NULL, 'Dr. Guadalupe Monahan', '228-245-8022', '978.515.6670', 'johnson05@yahoo.com', 'Switzerland', 'Eum.', NULL, NULL, '01777382007', '01777382007', NULL, 'Andorra', '2022-04-04 02:25:23', '2', NULL, NULL, '2', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '20', NULL, NULL, 1, NULL, NULL, '704', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(14, 4, 4, NULL, 1, NULL, NULL, 'Mervin Farrell I', '(564) 429-4321', '828.303.7527', 'jones.jerald@gleason.com', 'Bulgaria', 'Quia non.', NULL, NULL, '01777382007', '01777382007', NULL, 'Mongolia', '2022-04-04 02:25:23', '2', NULL, NULL, '2', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '20', NULL, NULL, 1, NULL, NULL, '762', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(15, 4, 5, NULL, 1, NULL, NULL, 'Hettie Effertz', '+1.831.645.0257', '+1 (628) 512-1693', 'grimes.madisen@gmail.com', 'Jamaica', 'Sit rerum.', NULL, NULL, '01777382007', '01777382007', NULL, 'Afghanistan', '2022-04-04 02:25:23', '2', NULL, NULL, '4', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, '719', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(16, 3, 5, NULL, 1, NULL, NULL, 'Dimitri Harber', '440.984.6083', '+1.239.259.4303', 'katheryn31@hotmail.com', 'Turkmenistan', 'Rerum.', NULL, NULL, '01777382007', '01777382007', NULL, 'Latvia', '2022-04-04 02:25:23', '4', NULL, NULL, '3', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, '292', NULL, NULL, 'Lost Passport', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `manual_passports`
--

CREATE TABLE `manual_passports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_creator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_branch` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `passport_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profession_id` bigint(20) UNSIGNED DEFAULT NULL,
  `de_id_for_bio` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civil_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `extended_to` timestamp NULL DEFAULT NULL,
  `kuwait_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bd_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` timestamp NULL DEFAULT NULL,
  `profession_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_form` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_photocopy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ems` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `post_office` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `shift_to_admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = branch manager to admin ',
  `embassy_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = receive from admin , 3 = send to admin ',
  `branch_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = nothing , 1 = received from admin , 3 = delivery to user ',
  `is_delivered` tinyint(1) NOT NULL DEFAULT 0,
  `is_shifted_to_branch_manager` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_government_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_versatilo_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_fees_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_verify_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `bio_enrollment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_mrp_passport_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks_by` tinyint(1) DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Manual Passport',
  `delivery_method` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_shifted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manual_passports`
--

INSERT INTO `manual_passports` (`id`, `user_creator_id`, `branch_id`, `delivery_branch`, `deleted_by`, `passport_type_id`, `profession_id`, `de_id_for_bio`, `name`, `passport_number`, `civil_id`, `mailing_address`, `expiry_date`, `extended_to`, `kuwait_phone`, `permanent_address`, `bd_phone`, `delivery_date`, `profession_file`, `application_form`, `passport_photocopy`, `salary`, `ems`, `date`, `post_office`, `dob`, `shift_to_admin`, `embassy_status`, `branch_status`, `is_delivered`, `is_shifted_to_branch_manager`, `passport_type_title`, `passport_type_government_fee`, `passport_type_versatilo_fee`, `passport_type_fees_total`, `r_id`, `entry_person`, `otp`, `otp_verify_at`, `status`, `bio_enrollment_id`, `new_mrp_passport_no`, `remarks`, `remarks_by`, `model_name`, `delivery_method`, `created_at`, `updated_at`, `deleted_at`, `is_shifted`) VALUES
(1, 2, NULL, 3, NULL, NULL, 2, NULL, 'Noemy Shanahan', '+1.831.571.3531', '1-936-258-2046', 'rohan.cordie@hammes.info', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '4', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '237', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(2, 1, NULL, 2, NULL, NULL, 2, NULL, 'Vidal Lemke', '(724) 767-7285', '425.449.7069', 'doyle.lang@king.info', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '4', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, '831', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(3, 1, NULL, 1, NULL, NULL, 2, NULL, 'Lydia Reynolds', '(216) 738-5828', '(262) 449-6096', 'rempel.lupe@monahan.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '3', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '20', NULL, NULL, 1, NULL, NULL, '771', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(4, 1, NULL, 1, NULL, NULL, 2, NULL, 'Mrs. Alda Lynch', '541.979.0961', '1-934-667-3785', 'norene.bernier@abshire.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '2', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '148', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(5, 3, NULL, 3, NULL, NULL, 2, NULL, 'Damaris Reilly', '+1-484-430-8757', '+1-669-908-5630', 'mohamed.cole@hotmail.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '3', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '834', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(6, 2, NULL, 1, NULL, NULL, 2, NULL, 'Mrs. Lue Mohr', '1-240-349-1540', '(409) 316-2350', 'darrell.hammes@veum.net', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '1', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, '794', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(7, 4, NULL, 4, NULL, NULL, 2, NULL, 'Prof. Rebecca Ferry', '906.952.7999', '573.599.9841', 'wilderman.johathan@zieme.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '4', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, '328', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(8, 3, NULL, 4, NULL, NULL, 2, NULL, 'Jason Senger', '1-773-710-0427', '312-577-5811', 'whitney03@lowe.info', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '1', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, '258', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(9, 1, NULL, 2, NULL, NULL, 2, NULL, 'Jennie Reinger', '1-857-597-4821', '480-460-5056', 'boris18@cummings.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '2', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, '391', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(10, 3, NULL, 3, NULL, NULL, 2, NULL, 'Elinor Jast', '+1 (281) 437-4952', '+1 (669) 379-0335', 'kyra.pfeffer@nikolaus.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '2', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, '191', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(11, 3, NULL, 2, NULL, NULL, 2, NULL, 'Kennedi Maggio', '(956) 643-6591', '+1 (484) 210-8075', 'noel.funk@hotmail.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '2', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, '696', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(12, 1, NULL, 2, NULL, NULL, 2, NULL, 'Patrick Kunze', '1-831-791-9106', '1-740-493-1303', 'hattie96@gmail.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '3', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, '548', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(13, 1, NULL, 1, NULL, NULL, 2, NULL, 'Kiel Hahn', '607-332-0606', '+1 (534) 488-2352', 'conn.lillian@runolfsdottir.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '4', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '246', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(14, 4, NULL, 1, NULL, NULL, 2, NULL, 'Tiara Bernier', '1-919-315-2034', '(334) 887-7807', 'rogelio23@hotmail.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '2', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, '754', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(15, 4, NULL, 4, NULL, NULL, 2, NULL, 'Thomas Sawayn Jr.', '626-440-3774', '+1-630-647-2509', 'hand.timmothy@yahoo.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '3', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, '223', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(16, 1, NULL, 3, NULL, NULL, 2, NULL, 'Clarissa Skiles', '(279) 621-7718', '(769) 379-9586', 'borer.shad@tromp.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-04-04 02:25:23', NULL, NULL, NULL, '3', 'MP1648617923Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, '523', NULL, 'Manual Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_18_051832_create_static_options_table', 1),
(6, '2021_12_04_104401_create_permission_tables', 1),
(7, '2021_12_05_094438_create_manual_passports_table', 1),
(8, '2021_12_05_103834_create_lost_passports_table', 1),
(9, '2021_12_06_063549_create_branches_table', 1),
(10, '2021_12_06_065649_create_others_table', 1),
(11, '2021_12_06_070647_create_professions_table', 1),
(12, '2021_12_06_070820_create_last_login_infos_table', 1),
(13, '2021_12_07_091317_create_renew_passports_table', 1),
(14, '2021_12_09_082625_create_passport_fees_table', 1),
(15, '2021_12_11_114402_create_user_types_table', 1),
(16, '2021_12_13_070101_create_salaries_table', 1),
(17, '2021_12_22_053253_create_new_born_baby_passports_table', 1),
(18, '2021_12_26_081000_create_other_service_fees_table', 1),
(19, '2021_12_26_084720_create_express_services_table', 1),
(20, '2021_12_26_085047_create_legal_complain_services_table', 1),
(21, '2021_12_26_094742_create_premier_services_table', 1),
(22, '2021_12_26_095550_create_immigration_govement_services_table', 1),
(23, '2022_01_13_060946_create_deliveries_table', 1),
(24, '2022_01_17_063937_passport_delivires', 1),
(25, '2022_01_24_094608_create_pricing_plans_table', 1),
(26, '2022_01_25_054253_create_services_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(4, 'App\\Models\\User', 12),
(4, 'App\\Models\\User', 13),
(4, 'App\\Models\\User', 14),
(4, 'App\\Models\\User', 15),
(4, 'App\\Models\\User', 16),
(5, 'App\\Models\\User', 17),
(5, 'App\\Models\\User', 18),
(5, 'App\\Models\\User', 19),
(5, 'App\\Models\\User', 20),
(5, 'App\\Models\\User', 21),
(6, 'App\\Models\\User', 22);

-- --------------------------------------------------------

--
-- Table structure for table `new_born_baby_passports`
--

CREATE TABLE `new_born_baby_passports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_creator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `profession_id` bigint(20) UNSIGNED DEFAULT NULL,
  `passport_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `de_id_for_bio` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civil_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ems` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_photocopy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_form` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kuwait_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bd_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_skill` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residence` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` timestamp NULL DEFAULT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `delivery_branch` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shift_to_admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = branch manager to admin ',
  `embassy_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = receive from admin , 3 = send to admin ',
  `branch_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = nothing , 1 = received from admin , 3 = delivery to user ',
  `is_delivered` tinyint(1) NOT NULL DEFAULT 0,
  `is_shifted_to_branch_manager` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_government_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_versatilo_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_fees_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_verify_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `bio_enrollment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_mrp_passport_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `dob_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks_by` tinyint(1) DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'New Born Baby Passport',
  `delivery_method` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_shifted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_born_baby_passports`
--

INSERT INTO `new_born_baby_passports` (`id`, `user_creator_id`, `branch_id`, `deleted_by`, `profession_id`, `passport_type_id`, `de_id_for_bio`, `name`, `passport_number`, `civil_id`, `mailing_address`, `permanent_address`, `ems`, `passport_photocopy`, `application_form`, `kuwait_phone`, `bd_phone`, `special_skill`, `residence`, `delivery_date`, `salary`, `date`, `delivery_branch`, `shift_to_admin`, `embassy_status`, `branch_status`, `is_delivered`, `is_shifted_to_branch_manager`, `passport_type_title`, `passport_type_government_fee`, `passport_type_versatilo_fee`, `passport_type_fees_total`, `r_id`, `entry_person`, `otp`, `otp_verify_at`, `status`, `bio_enrollment_id`, `new_mrp_passport_no`, `dob`, `dob_id`, `dob_file`, `remarks`, `remarks_by`, `model_name`, `delivery_method`, `created_at`, `updated_at`, `deleted_at`, `is_shifted`) VALUES
(1, 1, 1, NULL, 1, NULL, NULL, 'Breanna Sipes DDS', '779-998-5159', '+1-513-312-2017', 'lester21@ferry.com', 'Liberia', 'Aut.', NULL, NULL, '01777382007', '01777382007', NULL, 'French Polynesia', '2022-04-04 02:25:23', '4', NULL, '4', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '274', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(2, 3, 2, NULL, 1, NULL, NULL, 'Kyleigh Beier', '(269) 874-2275', '+1.734.399.7226', 'niko.kuphal@boyle.com', 'Malta', 'Et itaque.', NULL, NULL, '01777382007', '01777382007', NULL, 'Iceland', '2022-04-04 02:25:23', '2', NULL, '2', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '715', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(3, 1, 1, NULL, 1, NULL, NULL, 'Prof. Hollis Simonis', '+1-479-759-6088', '+1-567-995-8560', 'lonny.hickle@hotmail.com', 'Uzbekistan', 'Ad qui.', NULL, NULL, '01777382007', '01777382007', NULL, 'Christmas Island', '2022-04-04 02:25:23', '3', NULL, '2', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '275', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(4, 3, 5, NULL, 1, NULL, NULL, 'Marion Lang I', '(920) 408-4072', '(279) 353-9854', 'marc81@schulist.biz', 'Haiti', 'Nemo ut.', NULL, NULL, '01777382007', '01777382007', NULL, 'Malta', '2022-04-04 02:25:23', '1', NULL, '2', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '889', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(5, 1, 1, NULL, 1, NULL, NULL, 'Mr. Emmet Bradtke', '1-731-224-5322', '(747) 508-6437', 'yasmeen.zulauf@bashirian.com', 'Suriname', 'Dolor.', NULL, NULL, '01777382007', '01777382007', NULL, 'Ukraine', '2022-04-04 02:25:23', '3', NULL, '2', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '304', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(6, 1, 3, NULL, 1, NULL, NULL, 'Joana Langworth', '+1-951-302-9547', '+1-469-648-2451', 'lonnie57@hotmail.com', 'Tonga', 'Suscipit.', NULL, NULL, '01777382007', '01777382007', NULL, 'Israel', '2022-04-04 02:25:23', '1', NULL, '1', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '20', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '464', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(7, 3, 3, NULL, 1, NULL, NULL, 'Kaley Towne', '(908) 800-1591', '206-742-7242', 'trevion30@yahoo.com', 'Turkmenistan', 'Et nulla.', NULL, NULL, '01777382007', '01777382007', NULL, 'Armenia', '2022-04-04 02:25:23', '1', NULL, '2', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '300', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(8, 3, 5, NULL, 1, NULL, NULL, 'Devonte Hermiston', '+12087837077', '1-631-557-2355', 'hvandervort@yahoo.com', 'Cook Islands', 'Sunt odit.', NULL, NULL, '01777382007', '01777382007', NULL, 'Samoa', '2022-04-04 02:25:23', '2', NULL, '4', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '509', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(9, 4, 3, NULL, 1, NULL, NULL, 'Hadley Wisoky', '(534) 619-2928', '+1 (808) 900-9352', 'rowan85@oreilly.com', 'Israel', 'Commodi.', NULL, NULL, '01777382007', '01777382007', NULL, 'Bahamas', '2022-04-04 02:25:23', '4', NULL, '4', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '411', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(10, 4, 1, NULL, 1, NULL, NULL, 'Coleman Bradtke', '(810) 722-2865', '503.630.5904', 'mraz.broderick@yahoo.com', 'Lesotho', 'Non at.', NULL, NULL, '01777382007', '01777382007', NULL, 'Malaysia', '2022-04-04 02:25:23', '4', NULL, '4', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '271', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(11, 1, 5, NULL, 1, NULL, NULL, 'Josianne Marquardt', '(352) 471-0532', '+1-575-565-3814', 'elza53@gmail.com', 'Colombia', 'Soluta.', NULL, NULL, '01777382007', '01777382007', NULL, 'Kuwait', '2022-04-04 02:25:23', '4', NULL, '4', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '722', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(12, 4, 4, NULL, 1, NULL, NULL, 'Bettye Bahringer', '+1 (351) 967-8785', '+1-681-236-1383', 'minnie.ohara@breitenberg.com', 'Vanuatu', 'Molestiae.', NULL, NULL, '01777382007', '01777382007', NULL, 'Botswana', '2022-04-04 02:25:23', '2', NULL, '3', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '335', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(13, 2, 1, NULL, 1, NULL, NULL, 'Aniyah Konopelski', '1-678-841-4841', '505.337.5918', 'caesar.rohan@senger.biz', 'Latvia', 'Et.', NULL, NULL, '01777382007', '01777382007', NULL, 'Gibraltar', '2022-04-04 02:25:23', '3', NULL, '2', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '20', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '305', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(14, 4, 1, NULL, 1, NULL, NULL, 'Lorna Dietrich', '+1.262.821.9499', '+15612706353', 'frederique47@yahoo.com', 'British Virgin Islands', 'Dolor.', NULL, NULL, '01777382007', '01777382007', NULL, 'Saint Helena', '2022-04-04 02:25:23', '2', NULL, '4', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '574', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(15, 4, 4, NULL, 1, NULL, NULL, 'Anastasia Weimann', '1-585-923-1438', '605.381.7475', 'sydnee82@hotmail.com', 'Bulgaria', 'Officia.', NULL, NULL, '01777382007', '01777382007', NULL, 'Peru', '2022-04-04 02:25:23', '4', NULL, '2', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '594', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(16, 1, 3, NULL, 1, NULL, NULL, 'Erick Rolfson', '534.853.1133', '+1.321.478.5564', 'carlo.mitchell@lebsack.org', 'Pakistan', 'Autem.', NULL, NULL, '01777382007', '01777382007', NULL, 'Congo', '2022-04-04 02:25:23', '2', NULL, '2', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '375', NULL, 'New Born Baby Passport', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE `others` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `creator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `profession_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civil_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_photocopy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kuwait_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bd_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_skill` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residence` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ems` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` timestamp NULL DEFAULT NULL,
  `delivery_branch` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `entry_person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `others`
--

INSERT INTO `others` (`id`, `creator_id`, `branch_id`, `deleted_by`, `profession_id`, `name`, `passport_number`, `passport_type_id`, `civil_id`, `passport_photocopy`, `profession_file`, `mailing_address`, `kuwait_phone`, `permanent_address`, `bd_phone`, `special_skill`, `residence`, `salary`, `fee`, `remarks`, `ems`, `delivery_date`, `delivery_branch`, `dob`, `entry_person`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, NULL, 1, 'Prof. Tara Jakubowski III', '478.425.5135', NULL, '320.800.3632', NULL, NULL, 'jovani51@yahoo.com', '01777382007', 'Austria', '01777382007', NULL, 'Turks and Caicos Islands', '1', NULL, '180', 'EP1648617923Kuwait', '2022-04-04 02:25:23', '4', NULL, '18', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL),
(2, 1, NULL, NULL, 1, 'Retha Dibbert PhD', '1-405-891-8732', NULL, '+17862021204', NULL, NULL, 'tromp.leonie@yahoo.com', '01777382007', 'Swaziland', '01777382007', NULL, 'Ghana', '2', NULL, '247', 'EP1648617923Kuwait', '2022-04-04 02:25:23', '3', NULL, '17', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL),
(3, 1, NULL, NULL, 1, 'Rosario Frami', '+1-430-951-8405', NULL, '+1.913.421.9123', NULL, NULL, 'curt57@hotmail.com', '01777382007', 'Central African Republic', '01777382007', NULL, 'Guernsey', '2', NULL, '257', 'EP1648617923Kuwait', '2022-04-04 02:25:23', '2', NULL, '17', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL),
(4, 1, NULL, NULL, 1, 'Serenity Langosh Jr.', '573.446.0134', NULL, '828-219-3696', NULL, NULL, 'roberts.elinor@hotmail.com', '01777382007', 'Bhutan', '01777382007', NULL, 'Palau', '1', NULL, '588', 'EP1648617923Kuwait', '2022-04-04 02:25:23', '3', NULL, '19', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL),
(5, 1, NULL, NULL, 1, 'Mafalda Tremblay', '1-925-566-0817', NULL, '458-644-9365', NULL, NULL, 'abdullah81@hotmail.com', '01777382007', 'Samoa', '01777382007', NULL, 'Estonia', '1', NULL, '469', 'EP1648617923Kuwait', '2022-04-04 02:25:23', '5', NULL, '19', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL),
(6, 1, NULL, NULL, 1, 'Fanny Boyer', '480.726.1647', NULL, '801-374-7563', NULL, NULL, 'kevin94@hotmail.com', '01777382007', 'Liberia', '01777382007', NULL, 'Macao', '2', NULL, '312', 'EP1648617923Kuwait', '2022-04-04 02:25:23', '4', NULL, '19', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `other_service_fees`
--

CREATE TABLE `other_service_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `versetilo_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agency_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `govt_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consultants_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `other_service_fees`
--

INSERT INTO `other_service_fees` (`id`, `title`, `service_type`, `versetilo_fee`, `agency_fee`, `govt_fee`, `consultants_fee`, `other_fee`, `service_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'photo copy', 'premier-service', '60', '70', '80', '90', '0', '2', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(2, 'print', 'premier-service', '60', '70', '80', '90', '0', '2', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(3, 'food', 'express-service', '60', '70', '80', '90', '0', '2', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(4, 'divorce papers', 'legal-complaints-service', '60', '70', '80', '90', '0', '2', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(5, 'NID', 'immigration-govement-service', '60', '70', '80', '90', '0', '2', NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `passport_deliveries`
--

CREATE TABLE `passport_deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `passport_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT '0 menas renew, 1 means manual, 2 menas lost, 3 means new born baby',
  `delivery_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `passport_fees`
--

CREATE TABLE `passport_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `government_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `versatilo_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = inactive, 1 = active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passport_fees`
--

INSERT INTO `passport_fees` (`id`, `title`, `type`, `government_fee`, `versatilo_fee`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Caitlyn Stokes', 'lost-passport', '4704', '3257', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(2, 'Kathryn Thiel', 'lost-passport', '4064', '3708', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(3, 'Kali Boyle', 'lost-passport', '4565', '3261', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(4, 'Ansel Dietrich', 'lost-passport', '4917', '3000', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(5, 'Valentine Roob', 'lost-passport', '4414', '3511', 0, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(6, 'Prof. Antonette Schamberger PhD', 'manual-passport', '4369', '3186', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(7, 'Ms. Maryam Reichert IV', 'manual-passport', '4556', '3426', 0, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(8, 'Kelley Hane', 'manual-passport', '4825', '3157', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(9, 'Mr. Filiberto Erdman', 'manual-passport', '4048', '3736', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(10, 'Mrs. Dandre Wolff PhD', 'manual-passport', '4670', '3234', 0, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(11, 'Prof. Justus Emard', 'renew-passport', '4140', '3060', 0, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(12, 'Mrs. Deborah White PhD', 'renew-passport', '4889', '3892', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(13, 'Pamela Spinka', 'renew-passport', '4171', '3569', 0, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(14, 'Theresia DuBuque', 'renew-passport', '4881', '3152', 0, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(15, 'Miss Ernestine Bradtke MD', 'renew-passport', '4130', '3258', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(16, 'Hermann Huel', 'new-born-baby-passport', '4755', '3473', 0, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(17, 'Emerson Gleason', 'new-born-baby-passport', '4925', '3345', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(18, 'Cruz Mraz DVM', 'new-born-baby-passport', '4344', '3937', 0, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(19, 'Dr. Sydney Zulauf', 'new-born-baby-passport', '4739', '3659', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(20, 'Dr. Dejon Considine Jr.', 'new-born-baby-passport', '4438', '3155', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin-permission', 'web', '2022-03-30 02:25:21', '2022-03-30 02:25:21'),
(2, 'branch-manager-permission', 'web', '2022-03-30 02:25:21', '2022-03-30 02:25:21'),
(3, 'call-center-permission', 'web', '2022-03-30 02:25:21', '2022-03-30 02:25:21'),
(4, 'account-manager-permission', 'web', '2022-03-30 02:25:21', '2022-03-30 02:25:21'),
(5, 'data-enterer-permission', 'web', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(6, 'embassy-permission', 'web', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(7, 'normal-user-permission', 'web', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(8, 'corporate-user-permission', 'web', '2022-03-30 02:25:22', '2022-03-30 02:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `premier_services`
--

CREATE TABLE `premier_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `passport_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_photocopy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kuwait_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bd_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `extended_to` date DEFAULT NULL,
  `special_skill` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residence` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `other_service_fee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `versetilo_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agency_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `govt_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consulttants_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_taken` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `deleted_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ems` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Premier Service',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pricing_plans`
--

CREATE TABLE `pricing_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_samary` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professions`
--

CREATE TABLE `professions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professions`
--

INSERT INTO `professions` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Plumber', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(2, 'Painter', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(3, 'Factory Worker', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(4, 'Labour', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(5, 'Car Cleaner', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(6, 'Welder', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(7, 'Shafe', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(8, 'Driver', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(9, 'Office Assistant', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(10, 'Computer Operator', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(11, 'Cleaner', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(12, 'Data Enterer', 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `renew_passports`
--

CREATE TABLE `renew_passports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_creator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_branch` bigint(20) UNSIGNED DEFAULT NULL,
  `passport_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profession_id` bigint(20) UNSIGNED DEFAULT NULL,
  `de_id_for_bio` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civil_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_photocopy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_form` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kuwait_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bd_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_skill` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residence` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ems` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_manual` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_shifted_to_branch_manager` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_government_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_versatilo_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type_fees_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio_enrollment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_mrp_passport_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Renew Passport',
  `shift_to_admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = branch manager to admin ',
  `embassy_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = receive from admin , 3 = send to admin ',
  `branch_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = nothing , 1 = received from admin , 3 = delivery to user ',
  `is_delivered` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remarks_by` tinyint(1) DEFAULT NULL,
  `delivery_method` tinyint(1) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `extended_to` timestamp NULL DEFAULT NULL,
  `delivery_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_shifted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `renew_passports`
--

INSERT INTO `renew_passports` (`id`, `user_creator_id`, `deleted_by`, `branch_id`, `delivery_branch`, `passport_type_id`, `profession_id`, `de_id_for_bio`, `name`, `civil_id`, `passport_number`, `passport_photocopy`, `application_form`, `profession_file`, `mailing_address`, `kuwait_phone`, `permanent_address`, `bd_phone`, `special_skill`, `residence`, `salary`, `ems`, `is_manual`, `is_shifted_to_branch_manager`, `r_id`, `entry_person`, `passport_type_title`, `passport_type_government_fee`, `passport_type_versatilo_fee`, `passport_type_fees_total`, `remarks`, `bio_enrollment_id`, `new_mrp_passport_no`, `model_name`, `shift_to_admin`, `embassy_status`, `branch_status`, `is_delivered`, `status`, `remarks_by`, `delivery_method`, `dob`, `expiry_date`, `extended_to`, `delivery_date`, `created_at`, `updated_at`, `deleted_at`, `is_shifted`) VALUES
(1, 1, NULL, NULL, 3, NULL, 1, NULL, 'Mario Legros', '+1 (234) 613-3509', '+1 (610) 962-7917', NULL, NULL, NULL, 'frederic.schultz@feil.com', '01777382007', NULL, '01777382117', NULL, NULL, '2', 'EP1648617923Kuwait', NULL, NULL, '5', '18', NULL, NULL, NULL, NULL, '878', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(2, 2, NULL, NULL, 4, NULL, 1, NULL, 'Freeman Predovic', '+1-941-240-6500', '+1.351.896.7063', NULL, NULL, NULL, 'dkulas@russel.com', '01777382007', NULL, '01777382117', NULL, NULL, '2', 'EP1648617923Kuwait', NULL, NULL, '5', '17', NULL, NULL, NULL, NULL, '836', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(3, 1, NULL, NULL, 3, NULL, 1, NULL, 'Prof. Wiley Marquardt Sr.', '+1.201.431.3369', '+1-240-724-9822', NULL, NULL, NULL, 'amina17@cormier.com', '01777382007', NULL, '01777382117', NULL, NULL, '1', 'EP1648617923Kuwait', NULL, NULL, '5', '21', NULL, NULL, NULL, NULL, '436', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(4, 1, NULL, NULL, 4, NULL, 1, NULL, 'Bernardo Rath', '(763) 953-5049', '+1-539-974-3397', NULL, NULL, NULL, 'wwehner@gmail.com', '01777382007', NULL, '01777382117', NULL, NULL, '4', 'EP1648617923Kuwait', NULL, NULL, '5', '17', NULL, NULL, NULL, NULL, '541', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(5, 4, NULL, NULL, 3, NULL, 1, NULL, 'Tod Gleichner', '1-862-486-9079', '253-866-0369', NULL, NULL, NULL, 'ross.jenkins@yahoo.com', '01777382007', NULL, '01777382117', NULL, NULL, '2', 'EP1648617923Kuwait', NULL, NULL, '5', '17', NULL, NULL, NULL, NULL, '526', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(6, 1, NULL, NULL, 1, NULL, 1, NULL, 'Lula Block', '225-674-9210', '(424) 900-6729', NULL, NULL, NULL, 'terrance.satterfield@yahoo.com', '01777382007', NULL, '01777382117', NULL, NULL, '3', 'EP1648617923Kuwait', NULL, NULL, '5', '19', NULL, NULL, NULL, NULL, '277', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(7, 4, NULL, NULL, 5, NULL, 1, NULL, 'Flavie Sanford', '1-850-566-9128', '1-862-334-4199', NULL, NULL, NULL, 'steuber.jovanny@stroman.com', '01777382007', NULL, '01777382117', NULL, NULL, '3', 'EP1648617923Kuwait', NULL, NULL, '5', '19', NULL, NULL, NULL, NULL, '719', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(8, 4, NULL, NULL, 3, NULL, 1, NULL, 'Beau Hyatt', '1-828-985-2152', '+1-862-429-8225', NULL, NULL, NULL, 'enola.metz@goldner.info', '01777382007', NULL, '01777382117', NULL, NULL, '4', 'EP1648617923Kuwait', NULL, NULL, '5', '17', NULL, NULL, NULL, NULL, '600', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(9, 3, NULL, NULL, 5, NULL, 1, NULL, 'Janick Gibson', '651-599-5423', '337.421.9882', NULL, NULL, NULL, 'ywatsica@orn.org', '01777382007', NULL, '01777382117', NULL, NULL, '3', 'EP1648617923Kuwait', NULL, NULL, '5', '17', NULL, NULL, NULL, NULL, '381', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(10, 2, NULL, NULL, 4, NULL, 1, NULL, 'Prof. Cleve Vandervort MD', '+1-209-530-3204', '+1-351-481-2787', NULL, NULL, NULL, 'zboncak.adolf@mcglynn.info', '01777382007', NULL, '01777382117', NULL, NULL, '1', 'EP1648617923Kuwait', NULL, NULL, '5', '18', NULL, NULL, NULL, NULL, '452', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(11, 3, NULL, NULL, 3, NULL, 1, NULL, 'Hardy Koss', '(934) 608-7024', '785.598.9855', NULL, NULL, NULL, 'delores34@gmail.com', '01777382007', NULL, '01777382117', NULL, NULL, '3', 'EP1648617923Kuwait', NULL, NULL, '5', '18', NULL, NULL, NULL, NULL, '675', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(12, 2, NULL, NULL, 3, NULL, 1, NULL, 'Mrs. Carolyne Collins MD', '+1.347.204.8405', '+1.769.232.8673', NULL, NULL, NULL, 'astrid.wisoky@gmail.com', '01777382007', NULL, '01777382117', NULL, NULL, '4', 'EP1648617923Kuwait', NULL, NULL, '5', '17', NULL, NULL, NULL, NULL, '455', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(13, 4, NULL, NULL, 4, NULL, 1, NULL, 'Odie Thiel PhD', '(715) 810-5750', '(954) 439-5512', NULL, NULL, NULL, 'sedrick19@hotmail.com', '01777382007', NULL, '01777382117', NULL, NULL, '4', 'EP1648617923Kuwait', NULL, NULL, '5', '19', NULL, NULL, NULL, NULL, '598', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(14, 3, NULL, NULL, 5, NULL, 1, NULL, 'Meggie Swift', '+1 (318) 209-3252', '+1.979.504.4182', NULL, NULL, NULL, 'schmidt.simeon@hotmail.com', '01777382007', NULL, '01777382117', NULL, NULL, '2', 'EP1648617923Kuwait', NULL, NULL, '5', '17', NULL, NULL, NULL, NULL, '298', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(15, 4, NULL, NULL, 5, NULL, 1, NULL, 'Neva Luettgen', '+1 (978) 625-6116', '989.665.1386', NULL, NULL, NULL, 'trunolfsdottir@metz.com', '01777382007', NULL, '01777382117', NULL, NULL, '1', 'EP1648617923Kuwait', NULL, NULL, '5', '19', NULL, NULL, NULL, NULL, '565', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0),
(16, 2, NULL, NULL, 3, NULL, 1, NULL, 'Prof. Dillon Green', '+1-248-693-8710', '+12513216313', NULL, NULL, NULL, 'jschiller@beer.net', '01777382007', NULL, '01777382117', NULL, NULL, '1', 'EP1648617923Kuwait', NULL, NULL, '5', '17', NULL, NULL, NULL, NULL, '101', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-04-04 02:25:23', '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2022-03-30 02:25:21', '2022-03-30 02:25:21'),
(2, 'branch-manager', 'web', '2022-03-30 02:25:21', '2022-03-30 02:25:21'),
(3, 'call-center', 'web', '2022-03-30 02:25:21', '2022-03-30 02:25:21'),
(4, 'account-manager', 'web', '2022-03-30 02:25:21', '2022-03-30 02:25:21'),
(5, 'data-enterer', 'web', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(6, 'embassy', 'web', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(7, 'normal-user', 'web', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(8, 'corporate-user', 'web', '2022-03-30 02:25:22', '2022-03-30 02:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `title`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pattie Friesen PhD', 583, 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(2, 'Candido Schamberger', 532, 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(3, 'Leon Feil', 572, 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23'),
(4, 'Eulalia Volkman', 574, 1, '2022-03-30 02:25:23', '2022-03-30 02:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `static_options`
--

CREATE TABLE `static_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `static_options`
--

INSERT INTO `static_options` (`id`, `option_name`, `option_value`, `created_at`, `updated_at`) VALUES
(1, 'logo', 'uploads/images/logo.png', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(2, 'uae_office_link', 'https://versatilo.org/', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(3, 'kuwait_office_link', 'https://kuwaithc.versatilo.london/', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(4, 'bahrain_office_link', 'https://versatilo.london/', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(5, 'facebook_link', '#', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(6, 'instagram_link', '#', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(7, 'linkedin_link', '#', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(8, 'twitter_link', '#', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(9, 'no_image', 'uploads/images/setting/no-image.png', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(10, 'user', 'uploads/images/setting/user.png', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(11, 'banner_text', 'For title, select \"Header 2\" from style upper tab', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(12, 'banner_image', 'frontend_assets/img/Banner/banner-home.png', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(13, 'why_chose_section', 'We are simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(14, 'renew_passport_service_details', 'Individuals whose passports are expired or closed to the expiry date can get their passport renewal services through all our branches throughout Kuwait.', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(15, 'manual_passport_service_details', ' This service is mainly for individuals with urgent need of their passports whose expiry dates have been attained.', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(16, 'lost_passport_service_details', ' For those who have lost their passports and wish to get a new one, our happy centers can provide you with the necessary service to get issued with a new passport without you going to the embassy', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(17, 'new_born_passport_service_details', 'For any queries employees have either with their employers such as no salary\n        payment, or any abuse of their rights, our legal service and welfare department\n        is available and ready to see into restoring the joy of the complaining\n        employee. Also, individuals with cases including police or court that threatens\n        their peaceful stay in the Kuwait, can get solutions from our\n        legal team.', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(18, 'e_passport_service_details', '  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, hic?Lorem, ipsum dolor sit amet consectetur\n        adipisicing elit. Ducimus sapiente tempore ea et suscipit eius. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, hic?Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ducimus sapiente tempore ea et suscipit eius. Atque, hic?Lorem, ipsum dolor sit amet consectetur suscipitAtque, hic?', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(19, 'banner_btn_text', 'Check Passport', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(20, 'banner_btn_url', '#passport', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(21, 'footer_email', ' tfpsolutionsbd@gmail.com', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(22, 'footer_phone', ' +971 50 852 5155', '2022-03-30 02:25:22', '2022-03-30 02:25:22'),
(23, 'footer_address', '(Complex 9A, Nasser sports), Block-3(41), Street-Habeeb Manuawar, Office- Second Floor, Farwania, Kuwait', '2022-03-30 02:25:22', '2022-03-30 02:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kuwait_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_dtm` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_dtm` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ems` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `entry_status` tinyint(1) DEFAULT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `kuwait_phone`, `birth_date`, `birth_place`, `email`, `parent_id`, `branch_id`, `deleted_by`, `created_by`, `created_dtm`, `updated_by`, `updated_dtm`, `ems`, `otp`, `address`, `status`, `entry_status`, `user_type`, `password`, `image`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mr. Admin', '01700000000', NULL, NULL, NULL, 'admin@gmail.com', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'admin', '$2y$10$s/EFfYj6knO2BPmf/tFpheTgeXJ20kqMHTK3kKbk4mvZ8qA9nUY7K', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(2, 'Mr. Branch Manager 0', '(260) 312-6133', NULL, NULL, NULL, 'branch-manager0@gmail.com', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'branch-manager', '$2y$10$KloB26UZqtH6u5sTbXhzJu/t29FdBJd/KnvdS39H3p8Y.cYywa7qG', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(3, 'Mr. Branch Manager 1', '1-817-200-0166', NULL, NULL, NULL, 'branch-manager1@gmail.com', NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'branch-manager', '$2y$10$A.zPkWck9.KeUCgfbmI4ROIovORHh47ObsRxCGT0/rdI5yDC99WAq', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(4, 'Mr. Branch Manager 2', '(458) 831-7842', NULL, NULL, NULL, 'branch-manager2@gmail.com', NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'branch-manager', '$2y$10$pf5WjzYOEj9stCmUAtYOFOUU6suttVObMu/8EFZpsecIWWKJM1/oW', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(5, 'Mr. Branch Manager 3', '(619) 612-0898', NULL, NULL, NULL, 'branch-manager3@gmail.com', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'branch-manager', '$2y$10$bXTUqhLHw4XPv25L9G8a1O4emMAcpIZkgFxkS4Lk5Ir53wyGIDL5C', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(6, 'Mr. Branch Manager 4', '1-269-558-7698', NULL, NULL, NULL, 'branch-manager4@gmail.com', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'branch-manager', '$2y$10$tPvn4fJlOX1pM3JAhdTJKOcpHScsrSuRThdT3txdBTXwpwd4kxTrG', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(7, 'Mr. call center 0', '1-743-480-8437', NULL, NULL, NULL, 'call-center0@gmail.com', NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'call-center', '$2y$10$K.zcT9rEFOJQNgfYDeJo5ulMn1Q9TiniGtw1ZW/PYKA95lArWV5JW', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(8, 'Mr. call center 1', '+1.681.316.2486', NULL, NULL, NULL, 'call-center1@gmail.com', NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'call-center', '$2y$10$4pbCd2XhqN49MFB9ZJnS1OwzvSgTZfs2Q4NiGBgf39z5UUcHKpPXu', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(9, 'Mr. call center 2', '+1-606-620-4221', NULL, NULL, NULL, 'call-center2@gmail.com', NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'call-center', '$2y$10$pVSgwPzxYtpiXPhDZRISOe.3/sqcBo/nkXCfqVKCUB0F6XEwLhqCW', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(10, 'Mr. call center 3', '+1-620-398-5217', NULL, NULL, NULL, 'call-center3@gmail.com', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'call-center', '$2y$10$0YVsidsfrlPftiqe9Z5wAeHa53RP97.blsRHYlBYwyZLt7dhXxS9m', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(11, 'Mr. call center 4', '+1.816.904.9332', NULL, NULL, NULL, 'call-center4@gmail.com', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'call-center', '$2y$10$fXZl2g2MUVtgP9kGbr.ITuTgNeLsKIsQ9mDDRfKQdd5PctSyt.1VG', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(12, 'Mr. account manager 0', '(570) 737-9949', NULL, NULL, NULL, 'account-manager0@gmail.com', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'account-manager', '$2y$10$Z2bkpLP0rPFSYmeMsth3ZeYb8tXjEU71UVI2bp.gcdAsJu991AH3.', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(13, 'Mr. account manager 1', '650-793-5289', NULL, NULL, NULL, 'account-manager1@gmail.com', NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'account-manager', '$2y$10$L4SCMsiVkWq0bt/YLOuVeuT4tnszcgzSbuPv.SsROANvxkhBubRay', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(14, 'Mr. account manager 2', '+14585680059', NULL, NULL, NULL, 'account-manager2@gmail.com', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'account-manager', '$2y$10$5vU6j9OsUQXpgfNKuM1veeCuTvQNNZaJ6kyiC6pVzyohMCsBUkJSm', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(15, 'Mr. account manager 3', '1-336-425-9371', NULL, NULL, NULL, 'account-manager3@gmail.com', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'account-manager', '$2y$10$L1JwWgIHwV/cFAoFSioyPOiCPT0zSG5/PROBRTF9vV1M3aiU4Yqda', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(16, 'Mr. account manager 4', '1-445-241-0713', NULL, NULL, NULL, 'account-manager4@gmail.com', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'account-manager', '$2y$10$00hrCs0TJvvt/Gc1wdnvsOrCCCNYdx55FEtjt3MKG1p3rqR6u9fnK', NULL, NULL, '2022-03-30 02:25:22', '2022-03-30 02:25:22', NULL),
(17, 'Mr. data enterer 0', '1-513-905-9975', NULL, NULL, NULL, 'data-enterer0@gmail.com', 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'data-enterer', '$2y$10$K9ip9.ZdcCZPedLOVRRl..V72KJGdbVw5cQJjaVgz3AhCwKrrx/5y', NULL, NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL),
(18, 'Mr. data enterer 1', '1-747-681-4094', NULL, NULL, NULL, 'data-enterer1@gmail.com', 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'data-enterer', '$2y$10$uw1T6C9aXA1N0Mxk52JQR.oqDaUYsusDNkTnbzOb5iwjz6JKEgy.e', NULL, NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL),
(19, 'Mr. data enterer 2', '+1.601.234.5996', NULL, NULL, NULL, 'data-enterer2@gmail.com', 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'data-enterer', '$2y$10$sMmvCt.iEug8QQJToepJ9eBlHzCFmMrNvQDUV.IxYpczp5eRXH3vK', NULL, NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL),
(20, 'Mr. data enterer 3', '330.984.2615', NULL, NULL, NULL, 'data-enterer3@gmail.com', 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'data-enterer', '$2y$10$mHrEFBqNY6wl1UL1.5SlKeTmxHU93.a3eDHBZ2DgLhNu8GM7wYidO', NULL, NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL),
(21, 'Mr. data enterer 4', '364-843-6382', NULL, NULL, NULL, 'data-enterer4@gmail.com', 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'data-enterer', '$2y$10$L/3EsD0fQt2z9Z/FPnkr6.zenmii7IhjA9bEnvEK5M.2kYrG.ZJqa', NULL, NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL),
(22, 'Embassy', '+1-678-799-2934', NULL, NULL, NULL, 'embassy@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'embassy', '$2y$10$mrJ4Psgk2trR7J8wchoIYO5rUnPE5sLW6ZSaydoibOLEMHGGJKa/S', NULL, NULL, '2022-03-30 02:25:23', '2022-03-30 02:25:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `express_services`
--
ALTER TABLE `express_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `immigration_govement_services`
--
ALTER TABLE `immigration_govement_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `last_login_infos`
--
ALTER TABLE `last_login_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `legal_complaints_services`
--
ALTER TABLE `legal_complaints_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lost_passports`
--
ALTER TABLE `lost_passports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_passports`
--
ALTER TABLE `manual_passports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `new_born_baby_passports`
--
ALTER TABLE `new_born_baby_passports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_service_fees`
--
ALTER TABLE `other_service_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passport_deliveries`
--
ALTER TABLE `passport_deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passport_fees`
--
ALTER TABLE `passport_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `premier_services`
--
ALTER TABLE `premier_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing_plans`
--
ALTER TABLE `pricing_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renew_passports`
--
ALTER TABLE `renew_passports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_options`
--
ALTER TABLE `static_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `express_services`
--
ALTER TABLE `express_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `immigration_govement_services`
--
ALTER TABLE `immigration_govement_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `last_login_infos`
--
ALTER TABLE `last_login_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `legal_complaints_services`
--
ALTER TABLE `legal_complaints_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lost_passports`
--
ALTER TABLE `lost_passports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `manual_passports`
--
ALTER TABLE `manual_passports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `new_born_baby_passports`
--
ALTER TABLE `new_born_baby_passports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `other_service_fees`
--
ALTER TABLE `other_service_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `passport_deliveries`
--
ALTER TABLE `passport_deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passport_fees`
--
ALTER TABLE `passport_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `premier_services`
--
ALTER TABLE `premier_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pricing_plans`
--
ALTER TABLE `pricing_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professions`
--
ALTER TABLE `professions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `renew_passports`
--
ALTER TABLE `renew_passports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `static_options`
--
ALTER TABLE `static_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
