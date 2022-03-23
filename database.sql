-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 23, 2022 at 10:29 AM
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
(1, 'Mrs. Aryanna Bayer', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(2, 'Winifred Weber', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(3, 'Walker Stehr DVM', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(4, 'Prof. Timmothy Streich PhD', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(5, 'Kameron Armstrong', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56');

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
(1, 'Ms. Joanne Hansen DDS', NULL, '1', '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(2, 'Dennis Morissette', NULL, '1', '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL);

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
  `shift_to_admin` tinyint(1) NOT NULL DEFAULT 0,
  `embassy_status` tinyint(1) NOT NULL DEFAULT 0,
  `branch_status` tinyint(1) NOT NULL DEFAULT 0,
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
  `is_shifted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lost_passports`
--

INSERT INTO `lost_passports` (`id`, `user_creator_id`, `branch_id`, `deleted_by`, `profession_id`, `passport_type_id`, `de_id_for_bio`, `name`, `passport_number`, `civil_id`, `mailing_address`, `permanent_address`, `ems`, `profession_file`, `passport_photocopy`, `kuwait_phone`, `bd_phone`, `special_skill`, `residence`, `delivery_date`, `salary`, `date`, `dob`, `delivery_branch`, `gd_report_kuwait`, `application_form`, `shift_to_admin`, `embassy_status`, `branch_status`, `is_delivered`, `is_shifted_to_branch_manager`, `passport_type_title`, `passport_type_government_fee`, `passport_type_versatilo_fee`, `passport_type_fees_total`, `r_id`, `entry_person`, `otp`, `otp_verify_at`, `status`, `bio_enrollment_id`, `new_mrp_passport_no`, `remarks`, `remarks_by`, `delivery_method`, `model_name`, `is_shifted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 5, NULL, 1, NULL, NULL, 'Heloise Emmerich PhD', '1-908-413-3549', '+12062134991', 'abshire.stan@yahoo.com', 'United Arab Emirates', 'Fugiat.', NULL, NULL, '01777382007', '01777382007', NULL, 'Marshall Islands', '2022-03-28 06:28:56', '4', NULL, NULL, '4', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, '574', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(2, 2, 3, NULL, 1, NULL, NULL, 'Kenyon Schmidt Jr.', '+1-539-458-9391', '+1.217.347.3654', 'giuseppe.okeefe@yahoo.com', 'Russian Federation', 'Dolore.', NULL, NULL, '01777382007', '01777382007', NULL, 'Somalia', '2022-03-28 06:28:56', '4', NULL, NULL, '4', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, '516', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(3, 4, 5, NULL, 1, NULL, NULL, 'Alfonso Witting I', '434-877-9871', '+1-351-631-6395', 'emonahan@ebert.info', 'Fiji', 'Excepturi.', NULL, NULL, '01777382007', '01777382007', NULL, 'Togo', '2022-03-28 06:28:56', '4', NULL, NULL, '3', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, '579', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(4, 1, 2, NULL, 1, NULL, NULL, 'Thalia Beahan', '843-630-6496', '(906) 585-9087', 'rosalinda.dach@hotmail.com', 'Myanmar', 'Voluptas.', NULL, NULL, '01777382007', '01777382007', NULL, 'Netherlands Antilles', '2022-03-28 06:28:56', '1', NULL, NULL, '2', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '524', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(5, 2, 3, NULL, 1, NULL, NULL, 'Dorris Fisher', '937-633-0146', '+1-413-289-4411', 'cquitzon@yahoo.com', 'Equatorial Guinea', 'Officia.', NULL, NULL, '01777382007', '01777382007', NULL, 'Somalia', '2022-03-28 06:28:56', '2', NULL, NULL, '3', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, '214', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(6, 2, 3, NULL, 1, NULL, NULL, 'Mrs. Camylle Koelpin', '+12407932583', '(813) 945-0462', 'ogreenholt@yahoo.com', 'Bahamas', 'Cum quasi.', NULL, NULL, '01777382007', '01777382007', NULL, 'Gabon', '2022-03-28 06:28:56', '2', NULL, NULL, '2', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, '821', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(7, 1, 3, NULL, 1, NULL, NULL, 'Dr. Zoila Kohler', '1-847-402-5418', '(518) 549-5433', 'lfranecki@gmail.com', 'Poland', 'Culpa.', NULL, NULL, '01777382007', '01777382007', NULL, 'Austria', '2022-03-28 06:28:56', '2', NULL, NULL, '4', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, '342', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(8, 3, 3, NULL, 1, NULL, NULL, 'Dr. Yolanda Boehm', '+1 (360) 784-5805', '980-291-9439', 'rippin.darryl@hagenes.com', 'Lebanon', 'Provident.', NULL, NULL, '01777382007', '01777382007', NULL, 'Anguilla', '2022-03-28 06:28:56', '3', NULL, NULL, '4', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '280', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(9, 4, 4, NULL, 1, NULL, NULL, 'Mr. Jarrod Von', '(207) 425-5403', '+1-562-397-5197', 'angus51@towne.net', 'Croatia', 'Minus.', NULL, NULL, '01777382007', '01777382007', NULL, 'Latvia', '2022-03-28 06:28:56', '3', NULL, NULL, '2', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, '885', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(10, 1, 3, NULL, 1, NULL, NULL, 'Kendall Runolfsdottir', '+1-240-529-1775', '+1.458.527.4609', 'hkrajcik@gmail.com', 'Tuvalu', 'Sint.', NULL, NULL, '01777382007', '01777382007', NULL, 'Northern Mariana Islands', '2022-03-28 06:28:56', '3', NULL, NULL, '3', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '20', NULL, NULL, 1, NULL, NULL, '868', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(11, 1, 5, NULL, 1, NULL, NULL, 'Ayla Wiza DDS', '213-630-4090', '1-660-384-2879', 'lew.lueilwitz@reichert.net', 'Austria', 'Aliquam.', NULL, NULL, '01777382007', '01777382007', NULL, 'American Samoa', '2022-03-28 06:28:56', '4', NULL, NULL, '1', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, '626', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(12, 3, 3, NULL, 1, NULL, NULL, 'Harmony Grant', '1-341-867-3197', '629.863.8483', 'feest.felipa@gislason.com', 'Ukraine', 'Molestias.', NULL, NULL, '01777382007', '01777382007', NULL, 'Macao', '2022-03-28 06:28:56', '2', NULL, NULL, '3', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '845', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(13, 1, 2, NULL, 1, NULL, NULL, 'Jamey Schoen', '520.976.6666', '848-772-4385', 'hmills@leannon.com', 'Morocco', 'Deserunt.', NULL, NULL, '01777382007', '01777382007', NULL, 'Vanuatu', '2022-03-28 06:28:56', '2', NULL, NULL, '3', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, '482', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(14, 1, 2, NULL, 1, NULL, NULL, 'Mr. Miles Russel', '(360) 627-9457', '+1-702-520-0312', 'herminia.mueller@hotmail.com', 'Niger', 'Dolore.', NULL, NULL, '01777382007', '01777382007', NULL, 'Reunion', '2022-03-28 06:28:56', '2', NULL, NULL, '4', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, '172', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(15, 1, 5, NULL, 1, NULL, NULL, 'Dimitri Osinski', '641.532.1578', '651.857.7415', 'howell.teagan@pollich.com', 'Djibouti', 'Qui dicta.', NULL, NULL, '01777382007', '01777382007', NULL, 'Eritrea', '2022-03-28 06:28:56', '3', NULL, NULL, '4', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, '727', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(16, 2, 3, NULL, 1, NULL, NULL, 'Prof. Makenzie Leuschke', '239.683.2045', '1-972-713-8221', 'foster99@ernser.net', 'Cook Islands', 'Similique.', NULL, NULL, '01777382007', '01777382007', NULL, 'Sierra Leone', '2022-03-28 06:28:56', '1', NULL, NULL, '2', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, '138', NULL, NULL, 'Lost Passport', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL);

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
  `shift_to_admin` tinyint(1) NOT NULL DEFAULT 0,
  `embassy_status` tinyint(1) NOT NULL DEFAULT 0,
  `branch_status` tinyint(1) NOT NULL DEFAULT 0,
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
  `is_shifted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manual_passports`
--

INSERT INTO `manual_passports` (`id`, `user_creator_id`, `branch_id`, `delivery_branch`, `deleted_by`, `passport_type_id`, `profession_id`, `de_id_for_bio`, `name`, `passport_number`, `civil_id`, `mailing_address`, `expiry_date`, `extended_to`, `kuwait_phone`, `permanent_address`, `bd_phone`, `delivery_date`, `profession_file`, `application_form`, `passport_photocopy`, `salary`, `ems`, `date`, `post_office`, `dob`, `shift_to_admin`, `embassy_status`, `branch_status`, `is_delivered`, `is_shifted_to_branch_manager`, `passport_type_title`, `passport_type_government_fee`, `passport_type_versatilo_fee`, `passport_type_fees_total`, `r_id`, `entry_person`, `otp`, `otp_verify_at`, `status`, `bio_enrollment_id`, `new_mrp_passport_no`, `remarks`, `remarks_by`, `model_name`, `delivery_method`, `is_shifted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, NULL, 2, NULL, NULL, 2, NULL, 'Dr. Darlene Rempel', '+1.484.630.3377', '1-217-316-4633', 'cristopher69@yahoo.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '3', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, '693', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(2, 2, NULL, 4, NULL, NULL, 2, NULL, 'Mrs. Aleen Schuster', '+1-563-606-3370', '651-687-2561', 'vcorkery@hotmail.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '3', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '624', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(3, 1, NULL, 2, NULL, NULL, 2, NULL, 'Mina Romaguera', '765-257-8758', '623-240-5998', 'antwon84@yahoo.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '3', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, '839', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(4, 3, NULL, 2, NULL, NULL, 2, NULL, 'Mrs. Tressie Wilkinson V', '310-369-9721', '1-520-624-3469', 'rocky.schuppe@hotmail.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '2', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '612', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(5, 1, NULL, 4, NULL, NULL, 2, NULL, 'Mr. Harvey Schamberger', '+1.385.881.3408', '585-847-0875', 'lorna.herman@nitzsche.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '2', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '20', NULL, NULL, 1, NULL, NULL, '871', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(6, 4, NULL, 4, NULL, NULL, 2, NULL, 'Kevon Considine', '832-859-1596', '332.632.5521', 'anderson.garrick@yahoo.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '2', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '106', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(7, 4, NULL, 2, NULL, NULL, 2, NULL, 'Sheila Steuber Sr.', '959.870.8307', '+1-432-374-2367', 'adonis.ward@yahoo.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '2', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '20', NULL, NULL, 1, NULL, NULL, '765', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(8, 2, NULL, 4, NULL, NULL, 2, NULL, 'Travon Wisoky', '(559) 946-5239', '+1-276-690-5066', 'ledner.owen@gmail.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '4', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '583', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(9, 3, NULL, 1, NULL, NULL, 2, NULL, 'Ona Hamill', '+1-424-396-2042', '423-286-7483', 'iernser@gmail.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '1', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, '630', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(10, 2, NULL, 4, NULL, NULL, 2, NULL, 'Mr. Paxton Hammes IV', '479-612-9013', '1-865-877-1061', 'grady.sallie@gmail.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '4', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, '596', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(11, 3, NULL, 3, NULL, NULL, 2, NULL, 'Ronny Bins MD', '+1-956-299-4079', '(316) 924-0898', 'juliana05@gmail.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '4', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '493', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(12, 3, NULL, 1, NULL, NULL, 2, NULL, 'Zella Hegmann', '603.997.2382', '+1-702-660-2798', 'jgreenfelder@abbott.info', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '4', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, '622', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(13, 2, NULL, 4, NULL, NULL, 2, NULL, 'Mrs. Ada Tromp III', '1-737-284-4565', '+1.337.372.6490', 'tanya.reilly@hotmail.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '4', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '310', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(14, 4, NULL, 4, NULL, NULL, 2, NULL, 'April Deckow', '913-549-0411', '+1-509-217-6177', 'candelario40@nikolaus.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '4', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '143', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(15, 2, NULL, 1, NULL, NULL, 2, NULL, 'Prof. Ramiro Hand', '(574) 601-5614', '1-830-796-7620', 'odie32@yahoo.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '1', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, '248', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(16, 4, NULL, 2, NULL, NULL, 2, NULL, 'Cleta Bosco', '1-689-673-5668', '+1 (936) 512-6072', 'rutherford.jerrell@gmail.com', NULL, NULL, '01777382007', NULL, '01777382007', '2022-03-28 06:28:56', NULL, NULL, NULL, '3', 'MP1648027736Kuwait', NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, '200', NULL, 'Manual Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL);

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
  `shift_to_admin` tinyint(1) NOT NULL DEFAULT 0,
  `embassy_status` tinyint(1) NOT NULL DEFAULT 0,
  `branch_status` tinyint(1) NOT NULL DEFAULT 0,
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
  `is_shifted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_born_baby_passports`
--

INSERT INTO `new_born_baby_passports` (`id`, `user_creator_id`, `branch_id`, `deleted_by`, `profession_id`, `passport_type_id`, `de_id_for_bio`, `name`, `passport_number`, `civil_id`, `mailing_address`, `permanent_address`, `ems`, `passport_photocopy`, `application_form`, `kuwait_phone`, `bd_phone`, `special_skill`, `residence`, `delivery_date`, `salary`, `date`, `delivery_branch`, `shift_to_admin`, `embassy_status`, `branch_status`, `is_delivered`, `is_shifted_to_branch_manager`, `passport_type_title`, `passport_type_government_fee`, `passport_type_versatilo_fee`, `passport_type_fees_total`, `r_id`, `entry_person`, `otp`, `otp_verify_at`, `status`, `bio_enrollment_id`, `new_mrp_passport_no`, `dob`, `dob_id`, `dob_file`, `remarks`, `remarks_by`, `model_name`, `delivery_method`, `is_shifted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 4, NULL, 1, NULL, NULL, 'Prof. Marlon Kertzmann III', '+1 (972) 256-7378', '402.326.5806', 'elijah00@yahoo.com', 'Canada', 'Nesciunt.', NULL, NULL, '01777382007', '01777382007', NULL, 'South Africa', '2022-03-28 06:28:56', '4', NULL, '4', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '501', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(2, 1, 4, NULL, 1, NULL, NULL, 'Francesco Haley', '+16627478358', '347-630-7667', 'elisha19@yahoo.com', 'Germany', 'Sit aut.', NULL, NULL, '01777382007', '01777382007', NULL, 'Bulgaria', '2022-03-28 06:28:56', '4', NULL, '3', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '826', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(3, 1, 2, NULL, 1, NULL, NULL, 'Merlin McLaughlin', '+1 (804) 922-2452', '1-540-942-2721', 'goconner@mueller.com', 'Reunion', 'Odio.', NULL, NULL, '01777382007', '01777382007', NULL, 'Uzbekistan', '2022-03-28 06:28:56', '1', NULL, '1', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '900', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(4, 3, 2, NULL, 1, NULL, NULL, 'Axel Ferry PhD', '315-935-0474', '406-431-0775', 'mshanahan@hotmail.com', 'Thailand', 'Aliquid.', NULL, NULL, '01777382007', '01777382007', NULL, 'Fiji', '2022-03-28 06:28:56', '4', NULL, '2', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '483', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(5, 4, 5, NULL, 1, NULL, NULL, 'Destiny McDermott', '+1-501-506-8983', '(972) 535-8314', 'hand.bernardo@glover.org', 'Jamaica', 'Voluptas.', NULL, NULL, '01777382007', '01777382007', NULL, 'Mali', '2022-03-28 06:28:56', '4', NULL, '2', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '701', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(6, 4, 4, NULL, 1, NULL, NULL, 'Taya Walsh', '(520) 621-7062', '+1-918-226-0961', 'herbert57@hotmail.com', 'Thailand', 'Nulla.', NULL, NULL, '01777382007', '01777382007', NULL, 'Nepal', '2022-03-28 06:28:56', '2', NULL, '2', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '663', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(7, 1, 5, NULL, 1, NULL, NULL, 'Santiago Zulauf', '+1.731.470.2619', '562.524.1757', 'bruen.clarissa@hotmail.com', 'Andorra', 'Illum.', NULL, NULL, '01777382007', '01777382007', NULL, 'Iceland', '2022-03-28 06:28:56', '4', NULL, '4', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '343', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(8, 4, 4, NULL, 1, NULL, NULL, 'Dr. Clay Lebsack DVM', '346-239-1414', '(516) 264-4805', 'langworth.mabel@yahoo.com', 'Turks and Caicos Islands', 'Sed quia.', NULL, NULL, '01777382007', '01777382007', NULL, 'Portugal', '2022-03-28 06:28:56', '4', NULL, '1', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '850', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(9, 4, 3, NULL, 1, NULL, NULL, 'Mrs. Glenda Cartwright MD', '+16675233653', '(231) 564-4334', 'ebalistreri@ernser.com', 'Norfolk Island', 'Earum.', NULL, NULL, '01777382007', '01777382007', NULL, 'Central African Republic', '2022-03-28 06:28:56', '1', NULL, '1', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '271', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(10, 4, 5, NULL, 1, NULL, NULL, 'Gust Roob', '1-406-573-9290', '(360) 292-8764', 'sdubuque@kris.com', 'Maldives', 'Molestiae.', NULL, NULL, '01777382007', '01777382007', NULL, 'Burundi', '2022-03-28 06:28:56', '1', NULL, '4', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '20', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '291', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(11, 3, 5, NULL, 1, NULL, NULL, 'Jazmyne Lynch', '(283) 427-5612', '(847) 989-5990', 'lswift@gmail.com', 'Guernsey', 'Et.', NULL, NULL, '01777382007', '01777382007', NULL, 'Dominican Republic', '2022-03-28 06:28:56', '1', NULL, '4', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '20', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '525', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(12, 4, 3, NULL, 1, NULL, NULL, 'Tobin Walsh', '+1.610.920.6279', '+18456107067', 'houston.hane@hotmail.com', 'Norway', 'Excepturi.', NULL, NULL, '01777382007', '01777382007', NULL, 'Serbia', '2022-03-28 06:28:56', '4', NULL, '1', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '18', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '864', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(13, 2, 3, NULL, 1, NULL, NULL, 'Ethelyn Will', '+1.872.589.2628', '1-757-983-3815', 'monroe.jakubowski@reynolds.info', 'Sudan', 'Eveniet.', NULL, NULL, '01777382007', '01777382007', NULL, 'Italy', '2022-03-28 06:28:56', '3', NULL, '2', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '17', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '115', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(14, 2, 5, NULL, 1, NULL, NULL, 'Kaden Gerlach', '+1 (254) 410-3233', '1-321-822-5799', 'kreiger.armand@schaefer.org', 'Western Sahara', 'Vel et.', NULL, NULL, '01777382007', '01777382007', NULL, 'Guyana', '2022-03-28 06:28:56', '2', NULL, '2', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '849', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(15, 1, 1, NULL, 1, NULL, NULL, 'Prof. Harry Tromp DDS', '(734) 203-6157', '+1-646-727-5775', 'torp.kyra@yahoo.com', 'Russian Federation', 'Et iure.', NULL, NULL, '01777382007', '01777382007', NULL, 'El Salvador', '2022-03-28 06:28:56', '3', NULL, '1', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '5', '19', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '600', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(16, 2, 5, NULL, 1, NULL, NULL, 'Charley Halvorson', '408-581-9269', '+1-231-860-4487', 'vivien96@marvin.org', 'New Caledonia', 'Officia.', NULL, NULL, '01777382007', '01777382007', NULL, 'Taiwan', '2022-03-28 06:28:56', '2', NULL, '2', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '5', '21', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '495', NULL, 'New Born Baby Passport', NULL, 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL);

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
(1, 1, NULL, NULL, 1, 'Dr. Maddison Shanahan', '959.842.1275', NULL, '+1 (339) 943-9063', NULL, NULL, 'jazlyn13@schowalter.info', '01777382007', 'Iraq', '01777382007', NULL, 'Gabon', '2', NULL, '264', 'EP1648027736Kuwait', '2022-03-28 06:28:56', '4', NULL, '17', NULL, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(2, 1, NULL, NULL, 1, 'Daniella Ziemann', '+1 (872) 878-5341', NULL, '+1-919-544-3232', NULL, NULL, 'kuvalis.olen@hilpert.net', '01777382007', 'Central African Republic', '01777382007', NULL, 'Sao Tome and Principe', '3', NULL, '620', 'EP1648027736Kuwait', '2022-03-28 06:28:56', '3', NULL, '19', NULL, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(3, 1, NULL, NULL, 1, 'Alexander Altenwerth', '231-683-1692', NULL, '+1-283-460-5359', NULL, NULL, 'lschumm@gmail.com', '01777382007', 'Marshall Islands', '01777382007', NULL, 'Turkey', '2', NULL, '467', 'EP1648027736Kuwait', '2022-03-28 06:28:56', '3', NULL, '19', NULL, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(4, 1, NULL, NULL, 1, 'Margaret Smith', '+1 (434) 295-9593', NULL, '(580) 417-3370', NULL, NULL, 'okuvalis@windler.com', '01777382007', 'Czech Republic', '01777382007', NULL, 'Bulgaria', '4', NULL, '753', 'EP1648027736Kuwait', '2022-03-28 06:28:56', '4', NULL, '20', NULL, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(5, 1, NULL, NULL, 1, 'Everardo Ankunding II', '+14349314558', NULL, '+12549291274', NULL, NULL, 'eveline43@streich.com', '01777382007', 'Trinidad and Tobago', '01777382007', NULL, 'Panama', '1', NULL, '766', 'EP1648027736Kuwait', '2022-03-28 06:28:56', '4', NULL, '20', NULL, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(6, 1, NULL, NULL, 1, 'Mr. Jovan Dooley III', '+1-956-457-8343', NULL, '+1.970.326.3818', NULL, NULL, 'braden42@gmail.com', '01777382007', 'Micronesia', '01777382007', NULL, 'Aruba', '1', NULL, '374', 'EP1648027736Kuwait', '2022-03-28 06:28:56', '5', NULL, '19', NULL, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL);

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
(1, 'photo copy', 'premier-service', '60', '70', '80', '90', '0', '2', NULL, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(2, 'print', 'premier-service', '60', '70', '80', '90', '0', '2', NULL, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(3, 'food', 'express-service', '60', '70', '80', '90', '0', '2', NULL, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(4, 'divorce papers', 'legal-complaints-service', '60', '70', '80', '90', '0', '2', NULL, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(5, 'NID', 'immigration-govement-service', '60', '70', '80', '90', '0', '2', NULL, '2022-03-23 06:28:56', '2022-03-23 06:28:56');

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
(1, 'Sydni Hoeger', 'lost-passport', '4007', '3871', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(2, 'Miss Myrna Pagac', 'lost-passport', '4254', '3765', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(3, 'Sally Kozey', 'lost-passport', '4745', '3874', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(4, 'Else Feeney', 'lost-passport', '4820', '3875', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(5, 'Hassie Kuhn', 'lost-passport', '4316', '3283', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(6, 'Joe Ankunding', 'manual-passport', '4718', '3703', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(7, 'Ollie Barrows', 'manual-passport', '4095', '3701', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(8, 'Van Stoltenberg', 'manual-passport', '4601', '3588', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(9, 'Kellen Bechtelar', 'manual-passport', '4065', '3492', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(10, 'Carmel Reichert', 'manual-passport', '4035', '3349', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(11, 'Ashlee Lynch III', 'renew-passport', '4063', '3352', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(12, 'Laney Littel', 'renew-passport', '4343', '3832', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(13, 'Boris Rodriguez', 'renew-passport', '4570', '3884', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(14, 'Cindy Buckridge', 'renew-passport', '4573', '3592', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(15, 'Elnora Schneider', 'renew-passport', '4466', '3243', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(16, 'Prof. Daisy Macejkovic', 'new-born-baby-passport', '4882', '3301', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(17, 'Megane Feeney', 'new-born-baby-passport', '4259', '3761', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(18, 'Dolores Osinski', 'new-born-baby-passport', '4983', '3850', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(19, 'Delfina Carter', 'new-born-baby-passport', '4525', '3058', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(20, 'Otho Witting', 'new-born-baby-passport', '4628', '3669', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56');

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
(1, 'admin-permission', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(2, 'branch-manager-permission', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(3, 'call-center-permission', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(4, 'account-manager-permission', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(5, 'data-enterer-permission', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(6, 'embassy-permission', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(7, 'normal-user-permission', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(8, 'corporate-user-permission', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54');

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
(1, 'Plumber', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(2, 'Painter', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(3, 'Factory Worker', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(4, 'Labour', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(5, 'Car Cleaner', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(6, 'Welder', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(7, 'Shafe', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(8, 'Driver', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(9, 'Office Assistant', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(10, 'Computer Operator', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(11, 'Cleaner', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(12, 'Data Enterer', 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56');

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
  `shift_to_admin` tinyint(1) NOT NULL DEFAULT 0,
  `embassy_status` tinyint(1) NOT NULL DEFAULT 0,
  `branch_status` tinyint(1) NOT NULL DEFAULT 0,
  `is_delivered` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remarks_by` tinyint(1) DEFAULT NULL,
  `delivery_method` tinyint(1) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `extended_to` timestamp NULL DEFAULT NULL,
  `delivery_date` timestamp NULL DEFAULT NULL,
  `is_shifted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `renew_passports`
--

INSERT INTO `renew_passports` (`id`, `user_creator_id`, `deleted_by`, `branch_id`, `delivery_branch`, `passport_type_id`, `profession_id`, `de_id_for_bio`, `name`, `civil_id`, `passport_number`, `passport_photocopy`, `application_form`, `profession_file`, `mailing_address`, `kuwait_phone`, `permanent_address`, `bd_phone`, `special_skill`, `residence`, `salary`, `ems`, `is_manual`, `is_shifted_to_branch_manager`, `r_id`, `entry_person`, `passport_type_title`, `passport_type_government_fee`, `passport_type_versatilo_fee`, `passport_type_fees_total`, `remarks`, `bio_enrollment_id`, `new_mrp_passport_no`, `model_name`, `shift_to_admin`, `embassy_status`, `branch_status`, `is_delivered`, `status`, `remarks_by`, `delivery_method`, `dob`, `expiry_date`, `extended_to`, `delivery_date`, `is_shifted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, NULL, NULL, 2, NULL, 1, NULL, 'Dr. Michele Pouros', '908-832-9520', '1-828-772-2350', NULL, NULL, NULL, 'marc01@jacobson.com', '01777382007', NULL, '01777382117', NULL, NULL, '4', 'EP1648027736Kuwait', NULL, NULL, '5', '20', NULL, NULL, NULL, NULL, '497', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(2, 1, NULL, NULL, 4, NULL, 1, NULL, 'Elian Hoppe', '+1.251.637.5512', '+1-509-761-5366', NULL, NULL, NULL, 'genoveva.hegmann@gmail.com', '01777382007', NULL, '01777382117', NULL, NULL, '3', 'EP1648027736Kuwait', NULL, NULL, '5', '17', NULL, NULL, NULL, NULL, '169', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(3, 2, NULL, NULL, 2, NULL, 1, NULL, 'Araceli Wiza', '484-887-5581', '540.722.1191', NULL, NULL, NULL, 'ibatz@will.com', '01777382007', NULL, '01777382117', NULL, NULL, '4', 'EP1648027736Kuwait', NULL, NULL, '5', '21', NULL, NULL, NULL, NULL, '375', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(4, 3, NULL, NULL, 2, NULL, 1, NULL, 'Chaz Bechtelar DDS', '541.703.4138', '470.240.7676', NULL, NULL, NULL, 'frances.shanahan@lind.info', '01777382007', NULL, '01777382117', NULL, NULL, '2', 'EP1648027736Kuwait', NULL, NULL, '5', '17', NULL, NULL, NULL, NULL, '509', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(5, 3, NULL, NULL, 5, NULL, 1, NULL, 'Jimmy Koch', '(856) 475-7376', '(520) 735-0793', NULL, NULL, NULL, 'damian57@gmail.com', '01777382007', NULL, '01777382117', NULL, NULL, '2', 'EP1648027736Kuwait', NULL, NULL, '5', '17', NULL, NULL, NULL, NULL, '198', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(6, 3, NULL, NULL, 1, NULL, 1, NULL, 'Abel Zulauf', '+1.405.445.8577', '+14353351888', NULL, NULL, NULL, 'skris@tremblay.net', '01777382007', NULL, '01777382117', NULL, NULL, '2', 'EP1648027736Kuwait', NULL, NULL, '5', '20', NULL, NULL, NULL, NULL, '242', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(7, 1, NULL, NULL, 2, NULL, 1, NULL, 'Dr. Ayla Dicki', '1-478-774-5247', '402.602.4989', NULL, NULL, NULL, 'douglas.stewart@gmail.com', '01777382007', NULL, '01777382117', NULL, NULL, '2', 'EP1648027736Kuwait', NULL, NULL, '5', '20', NULL, NULL, NULL, NULL, '755', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(8, 2, NULL, NULL, 4, NULL, 1, NULL, 'Elyssa Hills', '503-835-6481', '+1.959.287.4898', NULL, NULL, NULL, 'brown.makenzie@barrows.biz', '01777382007', NULL, '01777382117', NULL, NULL, '1', 'EP1648027736Kuwait', NULL, NULL, '5', '19', NULL, NULL, NULL, NULL, '477', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(9, 3, NULL, NULL, 2, NULL, 1, NULL, 'Gloria Daugherty', '1-517-413-3021', '567-899-3470', NULL, NULL, NULL, 'hank65@kulas.com', '01777382007', NULL, '01777382117', NULL, NULL, '3', 'EP1648027736Kuwait', NULL, NULL, '5', '21', NULL, NULL, NULL, NULL, '452', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(10, 2, NULL, NULL, 5, NULL, 1, NULL, 'Mr. Spencer Schamberger', '619.839.9223', '820.971.8297', NULL, NULL, NULL, 'droberts@bradtke.info', '01777382007', NULL, '01777382117', NULL, NULL, '2', 'EP1648027736Kuwait', NULL, NULL, '5', '20', NULL, NULL, NULL, NULL, '877', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(11, 4, NULL, NULL, 2, NULL, 1, NULL, 'Cristal Lueilwitz', '+1 (810) 986-3549', '+1 (651) 239-7974', NULL, NULL, NULL, 'pollich.eino@koss.info', '01777382007', NULL, '01777382117', NULL, NULL, '4', 'EP1648027736Kuwait', NULL, NULL, '5', '19', NULL, NULL, NULL, NULL, '476', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(12, 4, NULL, NULL, 1, NULL, 1, NULL, 'Allie Heathcote III', '445-808-9202', '952-896-9141', NULL, NULL, NULL, 'harris.isabel@yahoo.com', '01777382007', NULL, '01777382117', NULL, NULL, '2', 'EP1648027736Kuwait', NULL, NULL, '5', '21', NULL, NULL, NULL, NULL, '102', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(13, 1, NULL, NULL, 2, NULL, 1, NULL, 'Jesse Sawayn', '1-714-289-2767', '+18109023521', NULL, NULL, NULL, 'beaulah.herzog@hotmail.com', '01777382007', NULL, '01777382117', NULL, NULL, '1', 'EP1648027736Kuwait', NULL, NULL, '5', '21', NULL, NULL, NULL, NULL, '565', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(14, 3, NULL, NULL, 5, NULL, 1, NULL, 'Dr. Keanu Swift II', '+1 (760) 596-9025', '1-267-977-6332', NULL, NULL, NULL, 'ndavis@kuvalis.com', '01777382007', NULL, '01777382117', NULL, NULL, '4', 'EP1648027736Kuwait', NULL, NULL, '5', '21', NULL, NULL, NULL, NULL, '483', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(15, 3, NULL, NULL, 2, NULL, 1, NULL, 'Forrest Casper', '+13464094360', '+1.850.564.2370', NULL, NULL, NULL, 'hoppe.marquise@hotmail.com', '01777382007', NULL, '01777382117', NULL, NULL, '1', 'EP1648027736Kuwait', NULL, NULL, '5', '17', NULL, NULL, NULL, NULL, '175', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(16, 4, NULL, NULL, 4, NULL, 1, NULL, 'Larissa McDermott V', '(443) 246-5350', '+1-831-415-5522', NULL, NULL, NULL, 'ibeier@gmail.com', '01777382007', NULL, '01777382117', NULL, NULL, '3', 'EP1648027736Kuwait', NULL, NULL, '5', '21', NULL, NULL, NULL, NULL, '803', NULL, NULL, 'Renew Passport', 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 06:28:56', 0, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL);

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
(1, 'admin', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(2, 'branch-manager', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(3, 'call-center', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(4, 'account-manager', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(5, 'data-enterer', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(6, 'embassy', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(7, 'normal-user', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(8, 'corporate-user', 'web', '2022-03-23 06:28:54', '2022-03-23 06:28:54');

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
(1, 'Miss Kari Kuphal', 517, 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(2, 'Minerva Kuvalis', 542, 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(3, 'Emie Wintheiser', 598, 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56'),
(4, 'Gunner Frami', 600, 1, '2022-03-23 06:28:56', '2022-03-23 06:28:56');

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
(1, 'logo', 'uploads/images/logo.png', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(2, 'no_image', 'uploads/images/setting/no-image.png', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(3, 'user', 'uploads/images/setting/user.png', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(4, 'banner_text', 'For title, select \"Header 2\" from style upper tab', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(5, 'banner_image', 'frontend_assets/img/Banner/banner-home.png', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(6, 'why_chose_section', 'Why chose use', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(7, 'banner_btn_text', 'Check Passport', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(8, 'banner_btn_url', '#passport', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(9, 'footer_email', ' tfpsolutionsbd@gmail.com', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(10, 'footer_phone', ' +971 50 852 5155', '2022-03-23 06:28:54', '2022-03-23 06:28:54'),
(11, 'footer_address', '(Complex 9A, Nasser sports), Block-3(41), Street-Habeeb Manuawar, Office- Second Floor, Farwania, Kuwait', '2022-03-23 06:28:54', '2022-03-23 06:28:54');

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
(1, 'Mr. Admin', '01700000000', NULL, NULL, NULL, 'admin@gmail.com', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'admin', '$2y$10$pQzDjxCoXFp0rJW2EIRDtuBeVd7uwM/5mPYUZ.9BdJUrJpBQ5zLYS', NULL, NULL, '2022-03-23 06:28:54', '2022-03-23 06:28:54', NULL),
(2, 'Mr. Branch Manager 0', '+18725245940', NULL, NULL, NULL, 'branch-manager0@gmail.com', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'branch-manager', '$2y$10$CkDMXdFUP7KZzYDheVNvp.mzlkQZMaDbYBXoXhbXSp5yEJpA.WWka', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(3, 'Mr. Branch Manager 1', '1-714-767-9174', NULL, NULL, NULL, 'branch-manager1@gmail.com', NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'branch-manager', '$2y$10$sNvBJwLBFk0y5dyRuh6jTeYdrUe4KWGBeJErzBQfn1cy36lLKgTCS', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(4, 'Mr. Branch Manager 2', '+1.510.978.0946', NULL, NULL, NULL, 'branch-manager2@gmail.com', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'branch-manager', '$2y$10$HWUb31Fpw4V.uorB8KnyCOjVXtWZsLB2wMbiYioFQ9aoudmXrUq5.', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(5, 'Mr. Branch Manager 3', '+1.480.919.6847', NULL, NULL, NULL, 'branch-manager3@gmail.com', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'branch-manager', '$2y$10$v8Zc1cilP8xv.aQ4o1ilNuOhzNlf9R5rdxWEK2RiPz8s9tLfcAdDK', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(6, 'Mr. Branch Manager 4', '(602) 703-6557', NULL, NULL, NULL, 'branch-manager4@gmail.com', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'branch-manager', '$2y$10$YMVMyh6l7fu9jyEBn5f1ZuEvyyoPiKVIbdOr36mzTO82dB7INzQda', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(7, 'Mr. call center 0', '+1-425-784-1539', NULL, NULL, NULL, 'call-center0@gmail.com', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'call-center', '$2y$10$qq6mMRvIL3A4nMK7VZxV2eEBn5HrvCy.EWwDvjshKSSIMew/TyzsS', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(8, 'Mr. call center 1', '857.808.8001', NULL, NULL, NULL, 'call-center1@gmail.com', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'call-center', '$2y$10$ZvZq0zy3/Q7sjGFQ0WdEje96Gbal7n5OGz0GDo7rzDY3mvBV8ZRy6', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(9, 'Mr. call center 2', '+1.574.851.0191', NULL, NULL, NULL, 'call-center2@gmail.com', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'call-center', '$2y$10$qke.dmg0ZPhZOg4jqAxlneQf82EEtiEChqCz3I3ckvmhXUjc11Twi', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(10, 'Mr. call center 3', '341.248.8025', NULL, NULL, NULL, 'call-center3@gmail.com', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'call-center', '$2y$10$xdPrjL7oeIb6Qqx394Q4x.OMOOeL7jFVO0O7uc/2virRR6oOkNmU2', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(11, 'Mr. call center 4', '+1.216.879.7165', NULL, NULL, NULL, 'call-center4@gmail.com', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'call-center', '$2y$10$IH3wyOjzN5vCZSXUxnUZVOB1ePEALDDTPYA29h8e0O/w4Yo9E0IlS', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(12, 'Mr. account manager 0', '410-628-8783', NULL, NULL, NULL, 'account-manager0@gmail.com', NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'account-manager', '$2y$10$pDyW30d1BHXmO8BLWt.Ou.zEF3pvaxD3E.RRrduspvYP08vy2jf22', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(13, 'Mr. account manager 1', '276.728.9014', NULL, NULL, NULL, 'account-manager1@gmail.com', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'account-manager', '$2y$10$tWFfPSJE/dEGNOqoNzUEr.NjZcGWMZC0Kn9s8.CHlrAdnc6T5JHo2', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(14, 'Mr. account manager 2', '+1-786-620-7874', NULL, NULL, NULL, 'account-manager2@gmail.com', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'account-manager', '$2y$10$BDALXHIHfZdOiMhv5qC.IuNjB3/jF0rQ6YIX2uLB71hEN2y.YwUpe', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(15, 'Mr. account manager 3', '959-991-0493', NULL, NULL, NULL, 'account-manager3@gmail.com', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'account-manager', '$2y$10$Z5wIR2YoTKYew2mE2RVEW.TVXuBLzH4xDAzZ7tns6zfkW515a8ON6', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(16, 'Mr. account manager 4', '+1-989-612-3922', NULL, NULL, NULL, 'account-manager4@gmail.com', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'account-manager', '$2y$10$cb1ekKygnC0CN8xEQIpLh.1gtxSosoHQIdrZybhRhiAReoc3WSWTO', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(17, 'Mr. data enterer 0', '863-228-8488', NULL, NULL, NULL, 'data-enterer0@gmail.com', 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'data-enterer', '$2y$10$3DQcG9S0jjuVagGcY0Ldy.sjABTD6PW/.yZkKsHacYqxDRz2RUn4y', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(18, 'Mr. data enterer 1', '(206) 498-3911', NULL, NULL, NULL, 'data-enterer1@gmail.com', 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'data-enterer', '$2y$10$82StCut/NgPze7Uenvuo8uW62AA5GPqqFAadatE5FyzyACwMH6N/i', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(19, 'Mr. data enterer 2', '279.735.0074', NULL, NULL, NULL, 'data-enterer2@gmail.com', 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'data-enterer', '$2y$10$cMb3dXv3/5RgXx4ApZkLIO/yK8GVc38a.ZIAQLqQSm.lJaipKqzmS', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(20, 'Mr. data enterer 3', '(303) 319-2075', NULL, NULL, NULL, 'data-enterer3@gmail.com', 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'data-enterer', '$2y$10$W3tYRWB3tMSqt7tUWmi/wu3rYFgtbKhEanxjoK64aJxOhfERWizUG', NULL, NULL, '2022-03-23 06:28:55', '2022-03-23 06:28:55', NULL),
(21, 'Mr. data enterer 4', '(901) 958-1790', NULL, NULL, NULL, 'data-enterer4@gmail.com', 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'data-enterer', '$2y$10$yuK7b6CGY9QS5o708u5/pOC4.euZ6gDVPiZHd8w.ayFFmvYi547qy', NULL, NULL, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL),
(22, 'Embassy', '564.636.1480', NULL, NULL, NULL, 'embassy@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'embassy', '$2y$10$3CLQkYqRldgfjH..qveEMOyo3D4mrqrybZmqU95nhx406PwisTrSm', NULL, NULL, '2022-03-23 06:28:56', '2022-03-23 06:28:56', NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
