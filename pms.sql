-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2026 at 02:45 PM
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
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `email`, `password`, `phoneNumber`, `created_at`, `updated_at`) VALUES
(1, 'QuantumTech', 'quatech', 'admin@thequantumtech.com', '$2y$10$1V2k.cxUPIQPr/pioDWmxulHLrDdD3wXnTguXM2M0a1Qh9ROtrH2e', '1234567890', '2025-01-27 07:46:57', '2025-01-27 07:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `assigntasks`
--

CREATE TABLE `assigntasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `milestone_id` bigint(20) UNSIGNED DEFAULT NULL,
  `task_id` bigint(20) UNSIGNED DEFAULT NULL,
  `consultant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assigntasks`
--

INSERT INTO `assigntasks` (`id`, `project_id`, `milestone_id`, `task_id`, `consultant_id`, `status`, `created_by`, `updated_by`, `comments`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 11, 1, 9, 'In Progress', 'Rhiannon Anderson', 'Lewis Bednar', 'Error ipsum recusandae sint recusandae explicabo eaque nihil.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(2, 25, 3, 6, 10, 'In Progress', 'Pink O\'Connell', 'Ora Bartell', 'Unde vitae est dolores veritatis quia harum.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(3, 10, 5, 7, 7, 'In Progress', 'Dr. Tristian Stoltenberg PhD', 'Ima Rolfson', 'Sapiente facilis aut quis.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(4, 18, 19, 3, 1, 'Pending', 'Dr. Lonzo Wintheiser', 'Jamaal Koss', 'Sed ipsam itaque qui dolores.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(5, 18, 1, 8, 8, 'In Progress', 'Elinore Morar PhD', 'Everette Anderson Sr.', 'Ut debitis dolore officia ea illum dolor.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(6, 10, 14, 6, 10, 'Pending', 'Santina Trantow', 'Damaris Stark', 'Quia amet quo consequatur quod sed eaque dolorum nisi.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(7, 8, 6, 1, 6, 'Completed', 'Onie Schumm', 'Prof. Santos Botsford IV', 'Fugit necessitatibus occaecati omnis tempora.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(8, 21, 12, 10, 1, 'Completed', 'Immanuel Gutmann III', 'Kiana Olson', 'Eum in culpa non ut sed magnam officia.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(9, 18, 5, 3, 8, 'Pending', 'Georgianna Schneider', 'Doyle Kuphal DVM', 'Hic dolor dicta qui.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(10, 10, 16, 7, 6, 'In Progress', 'Elena Hills', 'Kavon Jacobson DVM', 'Molestiae iusto sapiente quis ea voluptatem delectus a.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(11, 5, 16, 5, 7, 'In Progress', 'Hilda Reichel', 'Stacy Barrows', 'Sit tenetur dolor sit quo velit facere ut.', '2025-04-16 01:24:42', '2025-04-16 01:24:42', NULL),
(12, 11, 10, 3, 6, 'Completed', 'Dr. Edgar Prosacco', 'Vena Swift', 'Accusantium aut consequuntur nihil earum repellendus commodi expedita.', '2025-04-16 01:24:42', '2025-04-16 01:24:42', NULL),
(13, 8, 2, 2, 3, 'In Progress', 'Salvador Lang', 'Prof. Immanuel Goyette Jr.', 'Quia optio ipsum enim aspernatur sed facere.', '2025-04-16 01:24:42', '2025-04-16 01:24:42', NULL),
(14, 20, 6, 10, 11, 'In Progress', 'Ms. Vivian Dach PhD', 'Rachel Dickinson', 'Sapiente est voluptas nesciunt est qui eius.', '2025-04-16 01:24:42', '2025-04-16 01:24:42', NULL),
(15, 20, 13, 8, NULL, 'In Progress', 'Payton Bauch', 'Prof. Casey Bauch Jr.', 'Aspernatur quis est eaque totam.', '2025-04-16 01:24:42', '2025-04-16 01:24:42', NULL),
(16, 24, 13, 5, 8, 'Pending', 'Bobby Feil', 'Prof. Meghan Ratke PhD', 'Voluptatem sed est commodi hic.', '2025-04-16 01:24:42', '2025-04-16 01:24:42', NULL),
(17, 20, 10, 2, 1, 'Completed', 'Dr. Marisol Dicki', 'Raoul Pacocha', 'Sunt fugit aut iure dolore eos inventore quisquam esse.', '2025-04-16 01:24:42', '2025-04-16 01:24:42', NULL),
(18, 23, 20, 4, 5, 'In Progress', 'Dr. Ayla Hettinger DVM', 'Avery Eichmann', 'Molestias id modi fugit nam sit esse.', '2025-04-16 01:24:42', '2025-04-16 01:24:42', NULL),
(19, 23, 5, 4, 5, 'In Progress', 'Prof. Velma Runte', 'Austen Satterfield', 'Alias ut rem voluptatum id.', '2025-04-16 01:24:42', '2025-04-16 01:24:42', NULL),
(20, 22, 5, 4, 8, 'Completed', 'Gregg Ward', 'Mekhi Gerlach', 'Consequatur voluptas recusandae aut quia.', '2025-04-16 01:24:42', '2025-04-16 01:24:42', NULL),
(21, 18, 21, 12, 1, 'To Do', 'admin@thequantumtech.com', NULL, 'dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy', '2025-04-29 05:01:10', '2025-04-29 05:01:10', NULL),
(22, 18, 21, 13, 1, 'To Do', 'admin@thequantumtech.com', NULL, 'dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy', '2025-04-29 05:03:22', '2025-04-29 05:03:22', NULL),
(23, 18, 21, 12, 11, 'To Do', 'admin@thequantumtech.com', NULL, NULL, '2025-05-06 00:22:03', '2025-05-06 00:22:03', NULL),
(24, 26, 22, 14, 15, 'To Do', 'admin@thequantumtech.com', NULL, 'design figma files', '2025-05-06 01:10:46', '2025-05-06 01:10:46', NULL),
(25, 26, 22, 15, 15, 'To Do', 'admin@thequantumtech.com', NULL, NULL, '2025-05-06 01:11:40', '2025-05-06 01:11:40', NULL),
(26, 26, 23, 16, 15, 'To Do', 'admin@thequantumtech.com', NULL, NULL, '2025-05-06 01:12:00', '2025-05-06 01:12:00', NULL),
(28, 27, 24, 17, 17, 'To Do', 'admin@thequantumtech.com', NULL, 'dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy', '2025-05-07 06:58:29', '2025-05-07 06:58:29', NULL),
(29, 27, 24, 17, 16, 'To Do', 'admin@thequantumtech.com', NULL, 'test dd', '2025-05-07 08:13:37', '2025-05-07 08:13:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assignteams`
--

CREATE TABLE `assignteams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `consultant_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assignteams`
--

INSERT INTO `assignteams` (`id`, `project_id`, `consultant_id`, `status`, `description`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 18, 11, 'inactive', 'Beatae totam repudiandae esse ad impedit aliquid. Quia adipisci alias omnis qui nemo doloribus rerum qui. Provident modi vero et.', 'Miss Pasquale Waelchi Sr.', 'Shanna Hickle', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(2, 14, 11, 'active', 'Iure et illo numquam aut qui impedit. Veritatis iure quia nemo omnis odio voluptatem. Beatae optio dolore sed odio blanditiis et ex molestiae.', 'Sierra Schmitt', 'Hallie Feil', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(3, 25, 11, 'active', 'Maiores facere iste molestias consequuntur expedita dolorem ea. Esse suscipit vel et quibusdam rem molestiae. Cupiditate reiciendis aperiam quaerat voluptatem. Enim sunt facere fugiat non error ut voluptatem. Consectetur voluptas quae impedit asperiores inventore sint.', 'Dr. Payton Stiedemann V', 'Garfield Marvin III', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(4, 25, 11, 'inactive', 'Accusantium dolorem error hic magnam soluta sit aspernatur. Ea quia enim veritatis dicta sequi distinctio nostrum. Reprehenderit sit sunt mollitia iusto eos sint eum. Autem blanditiis vitae qui soluta. Nemo in illum dolorem sunt.', 'Daija Goodwin DDS', 'Dahlia Jacobson', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(5, 21, 11, 'inactive', 'Quaerat aperiam debitis aut sed occaecati. Magni provident ratione itaque optio quia ut distinctio recusandae. Quia et adipisci laudantium quam esse autem ullam. Similique deserunt qui commodi qui nesciunt vero et enim.', 'Gayle Keebler', 'Herbert Williamson DDS', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(6, 10, 11, 'active', 'Hic voluptas commodi est architecto ea. Illo ab qui quia ipsa. Occaecati nesciunt et numquam voluptate et.', 'Kaelyn Schuppe', 'Carli Huels', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(7, 15, 11, 'inactive', 'Doloribus ad est sit velit inventore saepe. Ut et mollitia iusto rerum ut placeat voluptas. Possimus architecto iusto dolore culpa voluptas rerum mollitia. Omnis consequatur eos et corrupti rerum a quia delectus. Consequatur quasi voluptatem sequi voluptatum.', 'Ayla Robel', 'Marcel Powlowski', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(8, 21, 11, 'inactive', 'Sunt sint odit libero. Aliquam nihil porro consectetur labore. Excepturi et harum quae voluptas. Non animi sequi ullam eaque sed.', 'Mrs. Valerie Muller IV', 'Alexandria Luettgen', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(9, 5, 11, 'inactive', 'Velit est autem dolore officia. Vero officiis doloribus voluptas est.', 'Gilberto O\'Hara Sr.', 'Reinhold Bergnaum MD', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(10, 22, 11, 'active', 'Ea et fugit id voluptas recusandae illo temporibus. Non maxime quo ducimus fugit assumenda. Recusandae voluptas voluptatum provident qui dicta dolore impedit. Expedita est unde maiores officiis harum expedita. Ut quod a exercitationem.', 'Dorothy Schowalter', 'Jaeden Graham', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(11, 18, 1, NULL, NULL, 'admin@thequantumtech.com', NULL, NULL, '2025-04-29 05:00:39', '2025-04-29 05:00:39'),
(12, 26, 1, NULL, NULL, 'admin@thequantumtech.com', NULL, NULL, '2025-05-06 00:59:26', '2025-05-06 00:59:26'),
(13, 26, 15, NULL, NULL, 'admin@thequantumtech.com', NULL, NULL, '2025-05-06 01:00:21', '2025-05-06 01:00:21'),
(14, 26, 13, NULL, NULL, 'admin@thequantumtech.com', NULL, NULL, '2025-05-06 01:00:48', '2025-05-06 01:00:48'),
(15, 27, 17, NULL, 'dummmy dummmy dummmy dummmy dummmy dummmy dummmy dummmy dummmy dummmy dummmy dummmy dummmy dummmy', 'admin@thequantumtech.com', NULL, NULL, '2025-05-07 06:36:50', '2025-05-07 06:36:50'),
(20, 5, 1, NULL, 'dd', 'admin@thequantumtech.com', NULL, NULL, '2025-08-12 04:29:25', '2025-08-12 04:29:25'),
(21, 5, 17, NULL, 'dd', 'admin@thequantumtech.com', NULL, NULL, '2025-08-12 04:30:11', '2025-08-12 04:30:11'),
(22, 6, 1, NULL, 'dd', 'admin@thequantumtech.com', NULL, '2025-08-20 05:23:10', '2025-08-13 04:13:04', '2025-08-20 05:23:10'),
(23, 6, 1, NULL, 'dd', 'admin@thequantumtech.com', NULL, NULL, '2025-08-20 05:23:19', '2025-08-20 05:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `pan_number` varchar(255) NOT NULL,
  `gst_number` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `bank_account_no` varchar(255) NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `swift_code` varchar(255) NOT NULL,
  `sign` varchar(255) DEFAULT NULL,
  `signname` varchar(255) NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `email`, `logo`, `pan_number`, `gst_number`, `phone_number`, `address`, `status`, `bank_account_no`, `account_holder_name`, `branch_name`, `bank_name`, `ifsc_code`, `swift_code`, `sign`, `signname`, `prefix`, `created_at`, `updated_at`) VALUES
(21, 'Greenholt LLC', 'cloyd.runolfsson@schmidt.com', 'https://via.placeholder.com/200x200.png/00bb88?text=business+et', 'PXMJC97684W', '65AAAAA2378A2Z7', '(862) 440-1207', '4337 Wiegand Loop Suite 995\nPort Pamela, SC 71836-7597', 'active', '6569500457', 'Vivien Effertz', 'Grahamchester', 'Stanton, Jaskolski and Hane', '84340350376', '52656488', 'https://via.placeholder.com/150x50.png/00aa22?text=abstract+corrupti', 'Dr. Dedrick Schuster PhD', 'CMPJYP', '2025-04-15 07:31:19', '2025-04-15 07:31:19'),
(22, 'Koss, Brakus and Bednar', 'ovonrueden@bauch.com', 'https://via.placeholder.com/200x200.png/0011cc?text=business+perspiciatis', 'NXVGV78821S', '46AAAAA1913A4Z9', '+1 (380) 588-3906', '29484 Bailey Coves Apt. 403\nJohnsmouth, CO 42871', 'deactive', '05195154', 'Prof. Derrick Becker', 'Nigelshire', 'Herman-Johnston', '75940933703', '43058110', 'https://via.placeholder.com/150x50.png/0055cc?text=abstract+delectus', 'Mrs. Beverly Stroman', 'CMPLJP', '2025-04-15 07:31:19', '2025-04-15 07:31:19'),
(23, 'Crist-Kuhic', 'chelsie33@prosacco.com', 'https://via.placeholder.com/200x200.png/006600?text=business+commodi', 'THASE20505H', '46AAAAA8264A2Z0', '380-970-6458', '4898 Padberg Circle Suite 388\nPort Brigitteview, KY 59290-8955', 'active', '96252899181', 'Anderson Zemlak', 'Favianchester', 'Welch-Thiel', '39670904224', '82467719', 'https://via.placeholder.com/150x50.png/00bb00?text=abstract+minima', 'Teresa Jast', 'CMPDZZ', '2025-04-15 07:31:19', '2025-04-15 07:31:19'),
(24, 'Weimann, Becker and Corwin', 'roberts.alene@leuschke.com', 'https://via.placeholder.com/200x200.png/0077cc?text=business+esse', 'FZLES06963T', '25AAAAA7909A6Z1', '908-215-8372', '2895 Freeman Courts Suite 213\nEast Palmamouth, IL 17233', 'active', '62019128030379', 'Vivian Mills', 'South Juanitachester', 'Walker-Dach', '02610201398', '70876963', 'https://via.placeholder.com/150x50.png/00ffdd?text=abstract+aut', 'Gideon Larson', 'CMPIXQ', '2025-04-15 07:31:19', '2025-04-15 07:31:19'),
(25, 'Buckridge, Doyle and Gleason', 'vschroeder@wolff.com', 'https://via.placeholder.com/200x200.png/00dd11?text=business+et', 'EEXYN65315S', '35AAAAA8115A3Z1', '870-390-0711', '17220 Lon Villages\nWest Jazlyn, UT 36950', 'deactive', '7472954681', 'Kyler Fisher I', 'North Benny', 'Dickinson PLC', '52510385175', '21833569', 'https://via.placeholder.com/150x50.png/007722?text=abstract+nam', 'Rafaela Kirlin', 'CMPHDC', '2025-04-15 07:31:19', '2025-04-15 07:31:19'),
(26, 'Bode, D\'Amore and Kuhic', 'magdalena11@fritsch.com', 'https://via.placeholder.com/200x200.png/001144?text=business+aut', 'AWFWR11339M', '42AAAAA5924A8Z3', '(681) 821-1710', '32448 Cruickshank Stravenue Suite 254\nLake Kelley, RI 35283', 'active', '112547275', 'Tyrique Schimmel', 'North Berniceton', 'Weimann, Frami and Bednar', '24940199904', '72826391', 'https://via.placeholder.com/150x50.png/00aa99?text=abstract+tempore', 'Otho Rodriguez', 'CMPRRI', '2025-04-15 07:31:19', '2025-04-15 07:31:19'),
(27, 'Hodkiewicz-O\'Keefe', 'shania.ratke@krajcik.com', 'https://via.placeholder.com/200x200.png/00aa11?text=business+pariatur', 'AEVCO26145V', '86AAAAA9879A7Z0', '585.214.2596', '7299 Kristopher Loaf Suite 800\nWest Zechariah, WA 66428-9261', 'active', '02920174', 'Danial Feest', 'East Domenick', 'Boehm-Glover', '14730112704', '80141299', 'https://via.placeholder.com/150x50.png/004411?text=abstract+consectetur', 'Dayne Koss', 'CMPFSL', '2025-04-15 07:31:19', '2025-04-15 07:31:19'),
(28, 'Jaskolski Inc', 'oconner.lester@haley.com', 'https://via.placeholder.com/200x200.png/009944?text=business+amet', 'YEMRZ84484B', '52AAAAA7335A2Z5', '660.694.4861', '441 Donnelly Via Apt. 208\nMerlinfort, CT 14904-9707', 'active', '9548240813', 'Gino Leuschke V', 'South Everardofurt', 'O\'Keefe-Schamberger', '58330709066', '70556984', 'https://via.placeholder.com/150x50.png/0077ff?text=abstract+suscipit', 'Geovanny Lebsack', 'CMPRBZ', '2025-04-15 07:31:19', '2025-04-15 07:31:19'),
(29, 'Lockman, Abshire and Durgan', 'mcdermott.citlalli@mitchell.com', 'https://via.placeholder.com/200x200.png/0055cc?text=business+non', 'JORBM10354W', '82AAAAA7733A8Z4', '+1 (806) 941-8129', '5048 Maiya Shore\nNorth Stoneberg, NV 05503-2737', 'active', '63872149466397', 'Santina Hyatt', 'Muellerbury', 'Jast-Upton', '70040501154', '11222536', 'https://via.placeholder.com/150x50.png/00bb11?text=abstract+ut', 'Cheyanne Lang', 'CMPHVN', '2025-04-15 07:31:19', '2025-04-15 07:31:19'),
(30, 'Rolfson Group', 'hickle.adolphus@hegmann.net', 'https://via.placeholder.com/200x200.png/002233?text=business+et', 'DPJQE56552H', '83AAAAA7994A5Z8', '203.567.1067', '4640 Arch Motorway\nNorth Jeromy, CA 87656-8255', 'active', '140619915', 'Miss Maymie Frami', 'Chadland', 'Jones-Schumm', '97390890981', '02748194', 'https://via.placeholder.com/150x50.png/0000ff?text=abstract+sint', 'Loyal Pfannerstill Jr.', 'CMPJFE', '2025-04-15 07:31:19', '2025-04-15 07:31:19'),
(31, 'google', 'google@gmail.com', '1746082074_6813191a90665.jpg', '1234', '1234', '+919737720504', 'asd', 'active', '1234', 'sunder', 'bapunagar', 'BOI', '8', '12', '1746082074_6813191a93a4d.png', 'sunder', '123', '2025-05-01 01:17:54', '2025-05-01 01:17:54');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`, `state`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(103, '1', '1', 'admin@thequantumtech.com', NULL, '2025-09-04 05:09:12', '2025-09-04 05:09:12'),
(104, '2', '2', 'admin@thequantumtech.com', NULL, '2025-09-04 05:09:16', '2025-09-04 05:09:16'),
(105, '3', '3', 'admin@thequantumtech.com', NULL, '2025-09-04 05:09:21', '2025-09-04 05:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `country_holidays`
--

CREATE TABLE `country_holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country_holidays`
--

INSERT INTO `country_holidays` (`id`, `country_id`, `date`, `name`, `created_at`, `updated_at`) VALUES
(41, 103, '2025-09-01', '1', '2025-09-04 05:09:37', '2025-09-04 05:09:37'),
(42, 104, '2025-09-02', '2', '2025-09-04 05:09:45', '2025-09-04 05:09:45'),
(43, 105, '2025-09-03', '3', '2025-09-04 05:09:53', '2025-09-04 05:09:53'),
(50, 103, '2025-09-01', '11', '2025-09-08 07:32:00', '2025-09-08 07:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `currencys`
--

CREATE TABLE `currencys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencys`
--

INSERT INTO `currencys` (`id`, `country`, `code`, `symbol`, `created_at`, `updated_at`) VALUES
(3, 'india', 'INR', '₹', '2025-09-12 06:05:29', '2025-09-12 06:05:29'),
(4, 'dubal', 'AED', 'د.إ', '2025-09-12 06:06:18', '2025-09-12 06:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_phone_number` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `pan_number` varchar(255) NOT NULL,
  `tax_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `profile_picture`, `description`, `email`, `phone_number`, `national_id`, `address`, `company_name`, `company_phone_number`, `company_email`, `pan_number`, `tax_number`, `password`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'pranav', 'yadav', NULL, 'Adefrgthyrjtuk', 'admin@thequantumtech.com', '+919737720609', '22', 'zsxdfgh', 'zxcvbnm', '+919737720509', 'cgg@gmail.com', 'sdfgh', '22', '$2y$10$bLow1Il.H81exJ.s1r4y2O5Pw5oXwS.8fumzwQnzHkBHlQyUhzAvG', 'active', '2025-02-03 02:56:45', '2025-02-03 02:56:33', '2025-02-03 02:56:45'),
(2, 'pranav', 'yadav', '1739174517_133736186566861148.jpg', 'qwertydasa', 'pranav@gmail.com', '+919737720609', '22', 'w1', 'ewdqefwgtehryjtu', '+919737720609', 'pranav@gmail.com', 'sqwde', '1234', '$2y$10$ls6rnVel07TKjz3koc22/urxcAnkCaUMD1wXPHUE6iGCFnWn7Nr2q', 'active', NULL, '2025-02-06 04:32:49', '2025-02-06 04:32:49'),
(3, 'pranav', 'yadav', NULL, '\'\r\n\'ojilhukjgh', 'py@gmail.com', '+919737720598', '22', 'wdqefwrethyr', 'zxcvbnm', '+9197377205489', 'cglg@gmail.com', 'sdfgh', '22', '$2y$10$iXeY31BjLo5ZCD7wAiTah.4Xii.xJtxvcM45HMcDwWKVqOnJRAGkO', 'active', NULL, '2025-02-07 01:18:17', '2025-02-07 01:18:17'),
(4, 'Madisen', 'Muller', NULL, 'Eaque consectetur voluptas cumque doloribus numquam. Recusandae quis eaque quas et ipsa tenetur corrupti. Quisquam consequatur dicta dolorum consequatur quia.', 'gideon.altenwerth@example.org', '221-288-1278x2623', '29', '3985 Gleason Row\nWest Lempiside, NE 83654', 'Kuhic and Sons', 'Sipes Group', 'jberge@example.net', '698448', '', 'NULLfad9d2bfNULLe8e25ecf69fb493319e9ad5649288a', 'active', NULL, NULL, NULL),
(5, 'Carolina', 'Mann', NULL, 'Earum voluptas rerum dolorem aliquid id natus. Accusantium quia voluptatem officia debitis porro optio. Minus fugiat aut aut dolorem non. Voluptas a sed officia placeat non repellat quod.', 'derrick.bogisich@example.org', '(NULL57)141-8995', '94', '86246 Sarai Springs Apt. 463\nWindlerchester, ND 39285-1636', 'Beatty LLC', 'Bartell-Schoen', 'ecartwright@example.com', '838', '1NULL9', 'b425e37NULL354c8NULLe7fdaefNULLfNULL2f8bcfNULL2781ce31b', 'deactive', NULL, NULL, NULL),
(6, 'Madge', 'Yundt', NULL, 'Blanditiis exercitationem dolor eligendi sit. Consequuntur quia aut at repudiandae tenetur excepturi.', 'kayley48@example.com', '(NULLNULL6)143-8414', '84', '1175 Robel Center Apt. 166\nFlatleyview, ME NULL7391', 'Lueilwitz Ltd', 'Kassulke-Howell', 'finn.brekke@example.com', '9', '1', '42c4f8caaNULLc674NULL2fNULLa16fNULL75ff1cf29NULL2469184', 'active', NULL, NULL, NULL),
(7, 'Alek', 'Schuster', NULL, 'Qui ullam ullam perspiciatis dolor. Nihil cupiditate vitae autem saepe nostrum. Est saepe sed quia est iste est nobis. Vel sunt laborum possimus.', 'kohler.elissa@example.com', '885.142.2266', '22', '136 Powlowski Bypass\nLake Leastad, AZ 4NULL771', 'Hoeger, Cormier and Murazik', 'Welch, Bosco and Rau', 'schmeler.garret@example.net', '52828', '', '6381493ecf9221dNULL9397bbf7787dbdf729NULLde4b7', 'deactive', NULL, NULL, NULL),
(8, 'Minnie', 'Effertz', NULL, 'Consequuntur sapiente dolore quam error. Ad sint itaque corporis autem cumque. Quas omnis aspernatur earum commodi. Ex quidem molestias tempore consequatur nemo totam doloribus quisquam.', 'gutkowski.tatyana@example.net', '1-247-164-NULL5NULL1x6266', '46', '6NULL2 Brandyn Haven\nCroninbury, NV 92NULL29', 'Cremin, Pouros and Bernhard', 'Cruickshank, Lebsack and Walker', 'lexus89@example.org', '85893', '15', 'a11dNULL6fNULLa8d6ad78NULLbf8f4652b5f1865abde5d1NULL', 'deactive', NULL, NULL, NULL),
(9, 'Chasity', 'Lang', NULL, 'Assumenda consectetur est et harum voluptas cupiditate rem eligendi. Amet consequatur sunt et qui reiciendis enim qui autem.', 'cartwright.myriam@example.net', '36NULL-962-2NULL74x72348', '44', '57998 Mitchel Summit Suite 4NULLNULL\nCruickshankland, NM NULL7585', 'Pacocha-Stoltenberg', 'Schinner-Bernhard', 'hansen.dewayne@example.net', '4994', '663', '3NULL16d4b87a389b7b3e5fa27274NULL8ee2a1f47af3NULL', 'deactive', NULL, NULL, NULL),
(10, 'Camille', 'Wisoky', NULL, 'Itaque ipsam sit distinctio commodi aut omnis optio. Illum autem non quo repellat sapiente explicabo ipsam. Dolores tempora a recusandae alias nostrum nulla minima.', 'jerde.evalyn@example.net', '(998)914-4334x26361', '4NULL', '2743 Marjorie Street\nNew Ramonland, SD 78875-413NULL', 'Osinski PLC', 'Morar, Kuphal and Bahringer', 'dorothy.adams@example.net', '19', '295189', '9a5b16bbddf994bc6451d72d75c13e8NULL3NULL9d98c6', 'deactive', NULL, NULL, NULL),
(11, 'Lyla', 'McLaughlin', NULL, 'Maxime aliquid beatae aut sunt sit maiores aut. Illo dolorem accusamus architecto aut corporis minima. Ex laboriosam ex possimus non tempora illum.', 'haskell53@example.org', '775-8NULL9-3943x9362', '15', '85NULL Jaiden Mountains\nDuBuquetown, KS 87318', 'Volkman LLC', 'Schmidt, Kuhic and Gibson', 'jarrod32@example.org', '3683', '882', '223adNULLcf287d5e3bdc535dddf29635886de1f289', 'active', NULL, NULL, NULL),
(12, 'Jewell', 'Runte', NULL, 'Quasi voluptates pariatur illo cum quia ut. Et soluta ipsum in accusantium ex quis minima. Pariatur et praesentium beatae quaerat ea. Impedit suscipit voluptatibus explicabo omnis non.', 'kayden.schulist@example.com', '+49(2)6NULL1511NULL685', '93', '2NULL66 Gerlach Grove Suite 1NULL3\nBarrowsburgh, MN 7842NULL', 'Pacocha Inc', 'Windler, Kshlerin and Daniel', 'lydia.marks@example.com', '178NULL48', '38513413', '7eNULLcb2acNULL7ff1cedbd7565NULL39abbNULLc8649af3a25', 'active', NULL, NULL, NULL),
(13, 'Jerod', 'Borer', NULL, 'Et impedit deserunt et aut explicabo aut. Cupiditate non a ad dolorem dolorem. In pariatur sed quam labore. Animi necessitatibus sit doloribus enim eos vitae libero.', 'javier.fritsch@example.org', '1-363-NULL14-9536x4172', '43', 'NULL99 Erik Road Apt. 285\nNorth Henry, MO 93281-2561', 'Leffler and Sons', 'Bahringer PLC', 'treutel.henderson@example.com', '5832', '3', '537adace257fNULL3a8cee1d9NULLbfb9a29ed675599f1', 'deactive', NULL, NULL, NULL),
(34, 'Edwardo', 'Johns', 'https://via.placeholder.com/200x200.png/0011ff?text=people+sapiente', 'Ipsam vel tenetur neque et. Provident voluptatem unde eveniet eos ratione perferendis. Sequi sunt et id provident voluptas perspiciatis. Maiores laudantium quo officia.', 'kunde.abraham@example.org', '458-421-4753', '15249525735', '5548 Cloyd Radial\nCotybury, MO 72734-9551', 'Schulist, Homenick and Raynor', '+1-321-529-5823', 'schaden.moshe@olson.com', 'KCUUJ17650W', '444832T11762', '$2y$10$FQX.XgGC/j7EmSbj21CObOL23U2Dwhhmnbuno2XW.qhZvTeBoNL5a', 'deactive', NULL, NULL, NULL),
(35, 'Lillie', 'Osinski', 'https://via.placeholder.com/200x200.png/009966?text=people+illo', 'Vel architecto adipisci eligendi dolorum et. Tempora est voluptatem cupiditate modi incidunt dolor est perferendis. Odit qui optio eos sint.', 'wboyle@example.com', '+1-253-798-8735', '24470542672', '905 Dickinson Corners\nLesterton, IA 09073-2367', 'Schaden-Legros', '720.760.2883', 'ugusikowski@paucek.net', 'IXRGU78059L', '755573U06095', '$2y$10$1lXjC1XOXcGqP0P6HNBduOC7OsVT9Ke3b//xhNBR8EeYEFc1JqxmO', 'deactive', NULL, NULL, NULL),
(36, 'Sydnie', 'Purdy', 'https://via.placeholder.com/200x200.png/008844?text=people+et', 'Similique perspiciatis atque aspernatur. In odit quod tenetur a assumenda. Qui quia ducimus quisquam et eveniet sed earum modi.', 'zschmitt@example.com', '689.765.1167', '50886794311', '32395 Bauch Locks Suite 491\nWest Orrin, WV 61589', 'Smith, Zemlak and Osinski', '(435) 665-9004', 'bailey.loren@mante.com', 'VOLEO56493I', '894350W14671', '$2y$10$gnErrZ8LyH9uzhnLPQoMUusi1zJ0HXhbriSeMdPE5wHhX03SLavmm', 'deactive', NULL, NULL, NULL),
(37, 'Kaleb', 'Turner', 'https://via.placeholder.com/200x200.png/000077?text=people+ea', 'Incidunt quia quia incidunt quae ut. Et ullam blanditiis perspiciatis. Aperiam iure accusantium facere facere veritatis dolor nisi. Voluptatem voluptatem doloremque possimus iusto enim iste.', 'keagan27@example.com', '954-905-3281', '76039608061', '8370 Rose Plain\nNorth Terrance, ND 11098-3590', 'Kutch, Gerlach and Dicki', '364-410-3151', 'yost.sallie@jacobs.com', 'FUVPH83102T', '776486N29812', '$2y$10$6UnSlfX/hn4LVbs5D6ZJZ.c/f77WxCF/RvyGY85iDU6x4w5uAvxwK', 'deactive', NULL, NULL, NULL),
(38, 'Arnold', 'Kshlerin', 'https://via.placeholder.com/200x200.png/007799?text=people+tempora', 'In ut eveniet placeat omnis id repellat. Mollitia ut est eligendi minus. Aut porro quo consequatur ipsa. Eum illum aut magnam velit maiores cum laborum illo.', 'dario56@example.net', '1-715-694-6221', '82726736392', '227 Marie Isle\nEast Dulcemouth, OK 24389', 'Kerluke LLC', '+1.405.428.2887', 'minerva.kautzer@feeney.com', 'TSGPM65017S', '637575M71236', '$2y$10$Q3QZkvs2oCG3UGU4BeujVOXjynso1Jq.Hlc1JpLzKJH5BrjJPMeOq', 'deactive', NULL, NULL, NULL),
(39, 'Noemi', 'Howell', 'https://via.placeholder.com/200x200.png/00cc33?text=people+possimus', 'Rem consequuntur dolor cupiditate sunt hic. Deserunt quis recusandae sunt dignissimos facere. Quidem sequi voluptatem est aut animi necessitatibus consequatur. Quo et et placeat nam expedita qui.', 'ydach@example.org', '+13048693537', '13105846357', '534 Hamill Forge Apt. 036\nPort Burleyberg, IA 98505', 'McLaughlin, Stracke and Hirthe', '520.539.7940', 'michale88@thompson.com', 'YIRNZ35588Z', '297501Q33404', '$2y$10$hHH2V2kXjMX6/rWQcY3gvuNjlmoVZVjcxObCweQDJX8ECD4HehnGe', 'active', NULL, NULL, NULL),
(40, 'Nathen', 'Lueilwitz', 'https://via.placeholder.com/200x200.png/006622?text=people+quibusdam', 'Et nulla rerum delectus qui nemo magni soluta. Nemo ea culpa aut mollitia. Aliquam consequatur et rem vero doloribus dolorem quis.', 'ihickle@example.org', '339.594.0108', '27749222221', '942 Madonna Meadows\nLake Rolando, OK 05162-7139', 'Flatley-Schiller', '1-480-409-4209', 'schmeler.tiffany@mcclure.com', 'RDZLA59169U', '357649C45195', '$2y$10$bRbxtQtamV8oCmJhrXZgcu9xS38sUPOR/guDtMccDJS.EKEOz2m0W', 'deactive', NULL, NULL, NULL),
(41, 'Hardy', 'Heller', 'https://via.placeholder.com/200x200.png/004488?text=people+fugiat', 'Id neque quia illo deleniti provident cupiditate et. Ullam accusantium sit magnam dicta id enim. Voluptatibus numquam ut animi. Facilis et ipsam iste dicta.', 'ldach@example.org', '+16816254007', '63427635881', '814 Monica Estate\nWolfborough, CT 20024-7468', 'Champlin Ltd', '1-754-970-6062', 'emerald23@jerde.com', 'KESOQ67668X', '103346R41177', '$2y$10$L8akknFolti5tMRgcwE/Ruzia7O1q3aGss28ldIFxQ7sNz3XMWgce', 'deactive', NULL, NULL, NULL),
(42, 'Lura', 'Kreiger', 'https://via.placeholder.com/200x200.png/00ff11?text=people+voluptatum', 'Deleniti dolores deserunt molestiae voluptates perferendis omnis recusandae. Est dolores voluptates error possimus atque quas architecto dolorem. Nesciunt vero nihil quia architecto.', 'tlarson@example.org', '404.522.9942', '20737913048', '579 Bertram Pike Apt. 739\nLake Verlie, MI 43257-1119', 'Dickinson Ltd', '669-996-0559', 'eddie.mcclure@weimann.org', 'BETIO18475R', '472289M58874', '$2y$10$H.FZ2jHFwDFEqRsFuVRg.eDn3XhIOQoJPkaN4.H1jY1x32s4XRYYu', 'deactive', NULL, NULL, NULL),
(43, 'Ellie', 'Homenick', 'https://via.placeholder.com/200x200.png/006633?text=people+aut', 'Ut ratione recusandae sed odio quisquam nemo eveniet. Ut quis temporibus qui pariatur. Fugit repellat veritatis et vel. Excepturi qui eligendi praesentium omnis.', 'ghammes@example.com', '301-798-0611', '29328800034', '5196 Little Corner Suite 968\nWehnerfurt, IA 79417', 'Ondricka Inc', '(707) 867-2722', 'breichert@okeefe.com', 'LCAEL36723I', '874053M44011', '$2y$10$GPmfA5AhT/U4JZI.d7ytBuRJumItBEyGDQ2kz/yYLxzOyVjmJJfSG', 'active', NULL, NULL, NULL),
(44, 'jay', 'patel', NULL, 'SASDA', 'jay123@gmail.com', '+919737748526', '22', 'FEWRET', 'BMW', '+918757740215', 'bmw123@gmail.com', '1234', '123', '$2y$10$8dHF33of4khpDzqs7Y269.udsG9J2Rzb4gR1yZtgVdalHsQhuODj6', 'active', NULL, NULL, NULL),
(45, 'sujal', 'shah', NULL, 'dummy', 'sujal@gmail.com', '+918797752426', '22', 'dummy', 'wipro', '+918797750603', 'wipro@gmail.com', '1234', '1234', '$2y$10$t7X7Edjtz0B43WEQaMGpL.Kmcwj9.2anTO4YM3AiTKwB44iC0A21q', 'active', NULL, NULL, NULL),
(49, 'testp', 'testy', NULL, 'test', 'test@gmail.com', '+918123456789', '20', 'ahmedabad', 'testcompany', '+918123456789', 'testcompany@gmail.com', '1234', '1234', '$2y$10$/CI.b6xbTRQc5n4B3TEgMe/B.mwth4L0EHgD4zmFtSfJ.4efvaAEy', 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_company`
--

CREATE TABLE `customer_company` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_company`
--

INSERT INTO `customer_company` (`id`, `customer_id`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 44, 21, '2025-04-20 06:04:53', '2025-04-20 06:04:53'),
(2, 45, 31, '2025-05-01 01:25:40', '2025-05-01 01:25:40'),
(10, 49, 21, '2025-06-04 01:10:26', '2025-06-04 01:10:26'),
(11, 49, 22, '2025-06-04 01:10:26', '2025-06-04 01:10:26'),
(12, 49, 29, '2025-06-04 01:10:26', '2025-06-04 01:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_p_no` varchar(255) DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `invoice_due_date` date DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `milestone_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text DEFAULT NULL,
  `alltotal` decimal(10,2) NOT NULL,
  `gst` decimal(5,2) DEFAULT NULL,
  `grandtotal` decimal(10,2) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `status` enum('pending','paid','overdue') NOT NULL DEFAULT 'pending',
  `template` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `option_tex` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_p_no`, `invoice_date`, `invoice_due_date`, `company_id`, `customer_id`, `milestone_id`, `note`, `alltotal`, `gst`, `grandtotal`, `currency`, `prefix`, `status`, `template`, `invoice_number`, `created_at`, `updated_at`, `option_tex`) VALUES
(1, '112233', '2025-04-20', NULL, 21, 44, NULL, NULL, 1.00, 10.00, 1.10, '(INR)', 'CMPJYP', 'overdue', 1, 'CMPJYP_04_2025_1', '2025-04-20 06:08:22', '2025-08-19 07:55:26', 'gst'),
(2, '445566', '2025-04-20', NULL, 21, 44, NULL, NULL, 1.00, 18.00, 1.18, '(INR)', 'CMPJYP', 'overdue', 2, 'CMPJYP_04_2025_2', '2025-04-20 06:09:52', '2025-08-19 07:55:26', 'igst'),
(3, '001122', '2025-05-12', NULL, 31, 45, NULL, NULL, 1.00, NULL, 1.00, '(INR)', '123', 'overdue', 1, '123_05_2025_1', '2025-05-12 06:28:13', '2025-08-19 07:55:26', 'vat'),
(4, '1', '2025-09-12', NULL, 21, 44, NULL, NULL, 1.00, NULL, 1.00, '(INR)', 'CMPJYP', 'pending', 3, 'CMPJYP_09_2025_3', '2025-09-12 04:52:01', '2025-09-12 04:52:01', ''),
(5, '2', '2025-09-12', NULL, 31, 2, 25, NULL, 2000.00, NULL, 2000.00, 'INR', '123', 'pending', 1, '123_09_2025_2', '2025-09-12 06:30:02', '2025-09-12 06:30:02', 'gst'),
(6, '1', '2025-09-17', NULL, 31, 45, NULL, NULL, 12.00, NULL, 12.00, 'AED', '123', 'pending', 1, '123_09_2025_3', '2025-09-17 02:18:35', '2025-09-17 02:18:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `sr_no` int(11) NOT NULL,
  `description` text NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `sr_no`, `description`, `rate`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'adssqd', 1.00, 1, 1.00, '2025-04-20 06:08:22', '2025-04-20 06:08:22'),
(2, 2, 1, 'assd', 1.00, 1, 1.00, '2025-04-20 06:09:52', '2025-04-20 06:09:52'),
(3, 3, 1, '1', 1.00, 1, 1.00, '2025-05-12 06:28:13', '2025-05-12 06:28:13'),
(4, 4, 1, '1', 1.00, 1, 1.00, '2025-09-12 04:52:01', '2025-09-12 04:52:01'),
(5, 5, 1, 'dd', 2000.00, 1, 2000.00, '2025-09-12 06:30:02', '2025-09-12 06:30:02'),
(6, 6, 1, '1', 11.00, 1, 11.00, '2025-09-17 02:18:35', '2025-09-17 02:18:35'),
(7, 6, 11, '1', 1.00, 1, 1.00, '2025-09-17 02:18:35', '2025-09-17 02:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(19, '2014_10_12_000000_create_users_table', 1),
(20, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(21, '2019_08_19_000000_create_failed_jobs_table', 1),
(22, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(23, '2024_09_23_074048_create_admins_table', 1),
(24, '2024_09_25_071009_create_customers_table', 1),
(25, '2024_10_01_055802_create_vendors_table', 1),
(26, '2024_10_07_064624_create_project_managers_table', 1),
(27, '2024_10_10_082656_create_resources_table', 1),
(28, '2024_10_14_093349_create_projects_table', 1),
(29, '2024_10_15_070529_create_milestones_table', 1),
(30, '2024_10_25_075926_create_assignteams_table', 1),
(31, '2024_10_30_132047_create_tasks_table', 1),
(32, '2024_11_11_063213_create_assigntasks_table', 1),
(33, '2024_11_19_082024_add_amount_and_document_to_milestones_table', 1),
(34, '2024_11_20_073023_add_currency_to_projects_table', 1),
(35, '2024_11_28_055734_create_companies_table', 1),
(36, '2024_11_28_105756_create_invoices_table', 1),
(37, '2025_03_04_133325_create_customer_company_table', 2),
(38, '2025_03_05_085004_create_vendor_company_table', 2),
(39, '2025_03_06_114048_create_currency_table', 2),
(43, '2025_04_15_105126_create_timesheet_table', 3),
(44, '2025_08_11_125909_create_notifications_table', 4),
(61, '2025_08_29_065719_create_country_table', 5),
(62, '2025_08_29_080531_create_country_holidays_table', 5),
(65, '2025_08_29_091254_add_county_id_to_resources_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

CREATE TABLE `milestones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `milestone_name` varchar(255) NOT NULL,
  `milestone_date` date NOT NULL,
  `forecasting_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `project_id`, `milestone_name`, `milestone_date`, `forecasting_date`, `status`, `description`, `amount`, `document`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 10, 'Tempora quia iure.', '2025-05-01', NULL, 'Pending', 'Provident voluptates et cum illum et voluptates. Porro laudantium est magni iste placeat. Vel molestiae iure eligendi aut fuga hic.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(2, 15, 'Id nesciunt sunt facilis sed.', '2025-05-11', '2025-05-27', 'Pending', 'Impedit dolore possimus delectus deleniti aperiam eum ut iusto. Adipisci est aut nihil fugiat pariatur quibusdam aut ut. Quam ab sint animi aliquam. At corrupti et deleniti sunt similique.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(3, 5, 'Accusamus quo laudantium quia.', '2025-05-15', NULL, 'Pending', 'Velit dolorum voluptas aperiam natus provident doloribus iusto. Dolorum qui veniam laborum tenetur vitae dolores voluptatem. Sed reiciendis est nobis qui itaque quibusdam. Animi possimus veniam dolores nam suscipit sapiente cupiditate sequi.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(4, 12, 'Veritatis explicabo beatae sed earum.', '2025-03-20', NULL, 'Pending', 'Dolore mollitia aut cupiditate saepe id natus molestiae. Illo omnis molestias ipsum voluptatem. Libero eligendi a ut vero odit temporibus. Odio qui architecto ut autem non et consequatur et.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(5, 9, 'Sequi harum exercitationem.', '2025-03-22', NULL, 'In Progress', 'Aut tempore distinctio qui pariatur nulla. Iste consequatur et vitae possimus porro consequuntur omnis. Commodi et nihil architecto tempore voluptatem.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(6, 14, 'Ut eos voluptatibus.', '2025-05-12', NULL, 'Completed', 'Non praesentium ut autem ab rerum tenetur. Corporis cupiditate voluptatibus reprehenderit veritatis labore. Est aut laborum mollitia voluptatem.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(7, 14, 'Saepe reprehenderit ea soluta.', '2025-05-02', '2025-06-03', 'Completed', 'Excepturi vel est magni similique voluptas tempore. Qui ut illum maxime quia facere ut. Doloribus placeat alias sit debitis facere. Quasi maxime et aut magni fugit.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(8, 13, 'Eos quo id debitis sequi.', '2025-04-16', NULL, 'Pending', 'Sed consequatur ratione eveniet optio pariatur. Hic ullam aut deleniti dolorem id. Similique adipisci suscipit sit suscipit alias. Adipisci ullam repudiandae dolor quia qui occaecati.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(9, 11, 'Magni sit temporibus a.', '2025-05-06', NULL, 'Pending', 'Est minus consectetur et voluptas. Cupiditate sint sed et fuga. Veritatis aliquam omnis ratione et aut.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(10, 8, 'Voluptatum est cupiditate.', '2025-04-01', '2025-05-02', 'Completed', 'Soluta asperiores doloremque placeat voluptatibus aperiam aliquid. Ullam quis adipisci voluptatibus omnis vero iure. Ex quos omnis et iste eaque praesentium.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(11, 7, 'Ad non voluptate velit.', '2025-04-03', NULL, 'Completed', 'Nostrum ullam optio odit dolorum eos magnam. Illum natus hic provident adipisci est.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(12, 16, 'Laborum omnis molestiae enim.', '2025-05-07', '2025-05-25', 'Pending', 'Debitis sint ipsum et officiis autem possimus est. Vel in veniam dolor blanditiis rem. A nihil optio praesentium et ab nesciunt cum quisquam.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(13, 15, 'Neque dicta in.', '2025-04-23', '2025-05-11', 'Pending', 'Dolores excepturi cupiditate tenetur dolorem. Nostrum quo quis ex eos praesentium unde eos. Esse quia aliquid maxime repellendus culpa. Qui voluptates aut tempora minus.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(14, 16, 'Ullam aut perferendis velit.', '2025-03-31', NULL, 'Pending', 'Quam vel velit eum vel fuga quos ut nesciunt. Dolorem esse maiores et repellendus. Quaerat sed incidunt consectetur rerum aperiam minus. Fugiat ut error et incidunt laboriosam quia esse rerum.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(15, 20, 'Beatae delectus doloribus.', '2025-03-21', NULL, 'Pending', 'Pariatur dolor et consequatur aut ab dolor. Et cupiditate provident quia ullam libero ea. Mollitia ea hic doloremque et qui et. Exercitationem odio quia dignissimos quo quibusdam tempora.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(16, 13, 'Ullam nihil excepturi.', '2025-05-07', '2025-05-16', 'Pending', 'Dolores sed numquam repellat nostrum iure. Dicta accusamus amet id ab reprehenderit. Dolorem cum pariatur sunt animi eos. Omnis impedit non adipisci a. Dicta voluptatem alias eligendi perferendis aliquam illo.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(17, 10, 'Est voluptatem repellat quia.', '2025-05-05', '2025-05-11', 'Pending', 'Quis perferendis sapiente qui quidem ut aut ut voluptas. Voluptatibus laudantium a voluptas magnam optio. Voluptas voluptas voluptatem necessitatibus voluptas quo qui et deserunt. Esse aut assumenda non ab.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(18, 12, 'Dolor aut odio.', '2025-04-13', NULL, 'Pending', 'Rem fuga laborum molestiae nihil beatae ea modi ipsum. Voluptatem amet voluptas quae omnis doloribus suscipit. Repellat ut laborum reprehenderit adipisci est pariatur dolores.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(19, 11, 'Sed distinctio facilis.', '2025-03-18', NULL, 'In Progress', 'Nam autem asperiores esse qui. Voluptatem et quia ex quia minima ab.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(20, 21, 'Quis vel ducimus.', '2025-03-21', '2025-06-13', 'Completed', 'Dolores autem repellat repudiandae et voluptates. Molestias temporibus sequi qui dicta ad atque. Aut dolorem excepturi voluptatibus incidunt ipsam placeat et.', NULL, NULL, NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(21, 18, 'wordpress', '2025-04-06', '2025-04-07', 'Planning', 'dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy.', 20000.00, NULL, NULL, '2025-04-29 04:57:44', '2025-04-29 04:57:44'),
(22, 26, 'design figma pages', '2025-05-10', '2025-07-08', 'Planning', 'design 29 pages in figma useing doc', 40000.00, NULL, NULL, '2025-05-06 00:57:51', '2025-05-06 00:57:51'),
(23, 26, 'html pages', '2025-07-10', '2025-11-15', 'Planning', 'create html page using figma', 150000.00, NULL, NULL, '2025-05-06 00:59:02', '2025-05-06 00:59:02'),
(24, 27, 'login form', '2025-05-01', '2025-05-03', 'Planning', 'dummy dummy dummy dummy dummy dummy dummy dummy', 20000.00, NULL, NULL, '2025-05-07 06:32:43', '2025-05-07 06:32:43'),
(25, 5, 'dd', '2025-07-01', '2025-07-03', 'Planning', 'dd', 2000.00, 'docs/milestone-01-09-2025-25.pdf', NULL, '2025-07-28 07:55:24', '2025-09-01 05:22:01'),
(26, 5, 'dd2', '2025-07-04', '2025-07-05', 'In Progress', 'dd2', 2000.00, 'docs/milestone-15-09-2025-26.pdf', NULL, '2025-07-28 07:56:08', '2025-09-15 06:09:13'),
(27, 5, 'ddd3', '2025-07-06', '2025-07-07', 'Completed', 'dd3', 2000.00, NULL, NULL, '2025-07-28 07:56:35', '2025-07-28 07:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('1558018c-2a9b-4108-8166-2e30a04bf60b', 'App\\Notifications\\AssignTeamNotification', 'App\\Models\\Resource', 1, '{\"data\":\"jay patel (jay@gmail.com) assign to asd\"}', NULL, '2025-08-12 04:29:25', '2025-08-20 07:23:07'),
('324664b9-ad30-4500-9d24-419d42939c00', 'App\\Notifications\\AssignTeamNotification', 'App\\Models\\Resource', 1, '{\"data\":\"jay patel (jay@gmail.com) assign to Cum voluptatibus recusandae.\"}', NULL, '2025-08-20 05:23:21', '2025-08-20 07:23:11'),
('8a0f1e7e-750b-4c3f-b217-6b0241214fb3', 'App\\Notifications\\AssignTeamNotification', 'App\\Models\\Resource', 17, '{\"data\":\"anad_consul tripathi (anad_consul@gmail.com) assign to asd\"}', NULL, '2025-08-12 04:30:11', '2025-08-12 08:58:22'),
('f339b6e1-0cc0-442a-8cfe-3801474dc575', 'App\\Notifications\\AssignTeamNotification', 'App\\Models\\Resource', 1, '{\"data\":\"jay patel (jay@gmail.com) assign to Cum voluptatibus recusandae.\"}', NULL, '2025-08-13 04:13:08', '2025-08-20 07:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_manager_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('planning','in_progress','completed','hold') NOT NULL DEFAULT 'planning',
  `project_value` decimal(15,2) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `documents` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`documents`)),
  `notes` text DEFAULT NULL,
  `uniquename` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `description`, `customer_id`, `vendor_id`, `project_manager_id`, `start_date`, `end_date`, `status`, `project_value`, `currency`, `documents`, `notes`, `uniquename`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 'asd', 'dd', 2, 1, 2, '2025-02-18', '2025-07-23', 'planning', 20000.00, '(INR)', '[\"documents\\/Project Management System SOW.pdf\"]', 'dd', '', NULL, NULL, '2025-07-17 03:38:08'),
(6, 'Cum voluptatibus recusandae.', NULL, 39, 10, 4, '2025-02-22', '2025-05-09', 'in_progress', 276721.66, NULL, '\"[\\\"https:\\\\\\/\\\\\\/www.goyette.com\\\\\\/eaque-ipsam-est-ratione\\\",\\\"http:\\\\\\/\\\\\\/hammes.com\\\\\\/commodi-ea-sed-error-ipsa-sapiente-consequuntur\\\"]\"', 'Architecto eum placeat est veritatis perspiciatis officiis. Molestias repudiandae dicta molestiae omnis. Quos delectus et assumenda ad quia illum vero. Enim vel eos voluptatibus sint blanditiis odit. Illo adipisci suscipit optio qui qui ullam fugit.', 'ut-dignissimos-eum-atque', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(7, 'Accusantium et autem dolor.', NULL, 39, 9, 6, '2025-02-28', NULL, 'completed', 296481.02, NULL, '\"[\\\"http:\\\\\\/\\\\\\/price.org\\\\\\/\\\",\\\"http:\\\\\\/\\\\\\/reichert.com\\\\\\/beatae-alias-fuga-hic-architecto-saepe-doloribus-omnis\\\"]\"', NULL, 'consequatur-molestiae-nisi', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(8, 'In consequatur sed.', 'Odio nesciunt aut mollitia. Provident rerum ut in quo et sunt cumque. Voluptatem quia officia consequatur eos ducimus illum.', 2, 5, 3, '2025-03-19', NULL, 'completed', 163360.62, NULL, '\"[\\\"http:\\\\\\/\\\\\\/www.okuneva.com\\\\\\/\\\",\\\"http:\\\\\\/\\\\\\/www.runte.org\\\\\\/\\\"]\"', NULL, 'exercitationem-sequi-esse-sunt', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(9, 'Cumque molestias voluptates quo.', NULL, 43, 1, 3, '2025-03-17', '2025-06-02', 'planning', 386949.13, NULL, '\"[\\\"http:\\\\\\/\\\\\\/aufderhar.com\\\\\\/hic-corporis-velit-porro-perspiciatis-dolorem\\\",\\\"https:\\\\\\/\\\\\\/turcotte.com\\\\\\/consectetur-sunt-ut-eveniet-quibusdam-eveniet-nihil-ea.html\\\"]\"', 'Amet quasi error omnis voluptates nemo ut ullam. Quae qui illum maxime ut. Assumenda cupiditate facere voluptates dicta est ut quia. Nisi odio unde quisquam incidunt aspernatur ex.', 'et-aspernatur-velit', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(10, 'Voluptatibus aperiam est corporis.', 'Amet soluta voluptates perferendis voluptate officiis. Dolor est est modi ut. Provident vero non est est fuga maiores. Cumque dolores consequuntur sunt.', 35, 6, 7, '2025-03-27', '2025-07-02', 'completed', 192978.85, NULL, '\"[\\\"http:\\\\\\/\\\\\\/fadel.com\\\\\\/\\\",\\\"https:\\\\\\/\\\\\\/aufderhar.org\\\\\\/eaque-ut-aut-ullam-neque-quo-laudantium.html\\\"]\"', NULL, 'in-et-et-consequatur', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(11, 'Quia nihil quo.', NULL, 34, 8, 4, '2025-04-09', '2025-05-19', 'planning', 798986.86, NULL, '\"[\\\"https:\\\\\\/\\\\\\/fahey.com\\\\\\/assumenda-repellat-aliquid-assumenda-molestiae-alias.html\\\",\\\"http:\\\\\\/\\\\\\/www.johnson.biz\\\\\\/sunt-amet-ut-reprehenderit-non-voluptatem-possimus-consequatur\\\"]\"', NULL, 'omnis-eum-eos-ut', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(12, 'Corrupti amet esse.', 'Perferendis doloribus in quaerat enim. Sit et qui natus enim et aperiam voluptate. Expedita hic facere est eveniet soluta alias.', 7, 3, 10, '2025-03-25', '2025-04-07', 'completed', 933518.41, NULL, '\"[\\\"http:\\\\\\/\\\\\\/quitzon.biz\\\\\\/quaerat-incidunt-maiores-est-nihil-quis-dolores-sunt-sunt\\\",\\\"http:\\\\\\/\\\\\\/www.conn.org\\\\\\/\\\"]\"', NULL, 'asperiores-nemo-error', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(13, 'Voluptatum quam culpa.', 'Sit sint perspiciatis fugiat eligendi aut. Quisquam ut harum officiis et sit ea autem. Tempore dolore minus reiciendis similique voluptate.', 10, 1, 3, '2025-02-27', '2025-04-05', 'hold', 218770.07, NULL, '\"[\\\"http:\\\\\\/\\\\\\/www.bogisich.com\\\\\\/voluptatum-aut-recusandae-iusto-aut-vero-libero\\\",\\\"http:\\\\\\/\\\\\\/kessler.com\\\\\\/sapiente-molestias-consequuntur-sapiente-vel-ut-iusto.html\\\"]\"', 'Sequi est culpa perferendis aut necessitatibus. Id dolorem et asperiores non officia vel. Et doloremque amet debitis aperiam tempore qui.', 'placeat-magnam-enim', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(14, 'Similique sint repudiandae.', 'Vel est et nulla enim. Ut voluptatem rerum velit illum rerum quisquam. Veniam ea at expedita soluta totam cum vero. Autem aut blanditiis odio aperiam perspiciatis possimus.', 43, 7, 10, '2025-02-25', '2025-03-23', 'hold', 228625.42, NULL, '\"[\\\"http:\\\\\\/\\\\\\/little.com\\\\\\/voluptas-sunt-recusandae-nisi-molestiae-sit-ullam-omnis.html\\\",\\\"http:\\\\\\/\\\\\\/www.cartwright.info\\\\\\/vitae-quia-suscipit-et.html\\\"]\"', NULL, 'voluptatum-a-nulla', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(15, 'Architecto quia.', NULL, 11, 1, 5, '2025-02-19', NULL, 'planning', 37799.65, NULL, '\"[\\\"https:\\\\\\/\\\\\\/www.raynor.org\\\\\\/eum-ad-esse-nisi-non-cum-pariatur-pariatur\\\",\\\"http:\\\\\\/\\\\\\/swaniawski.net\\\\\\/magni-facere-vel-commodi-tempora-aut-minus-consequatur\\\"]\"', NULL, 'qui-iusto-tenetur-ipsum-quisquam', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(16, 'Illo voluptatem quidem.', 'Reiciendis excepturi libero dolorum repudiandae fugiat sed iure. Veritatis aperiam ea ea eos ipsum aut ipsam. Voluptatem veniam illum vel enim harum sunt.', 42, 8, 7, '2025-04-08', '2025-05-09', 'hold', 92779.01, NULL, '\"[\\\"http:\\\\\\/\\\\\\/hammes.org\\\\\\/\\\",\\\"https:\\\\\\/\\\\\\/lang.biz\\\\\\/in-nam-quidem-rerum-molestiae-praesentium.html\\\"]\"', NULL, 'quas-repellat-sint', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(17, 'Veritatis incidunt quo qui.', 'Voluptas repellendus et veniam inventore saepe ut. Recusandae error nemo et. Non aut quisquam qui quo ut velit eligendi. Dolor aliquid reprehenderit illo ipsam maiores sit voluptatem. Autem beatae excepturi soluta sunt.', 4, 10, 7, '2025-02-24', '2025-02-25', 'planning', 241935.78, NULL, '\"[\\\"http:\\\\\\/\\\\\\/okeefe.com\\\\\\/earum-quo-corrupti-aut-quos-vitae.html\\\",\\\"http:\\\\\\/\\\\\\/steuber.com\\\\\\/ab-aliquid-numquam-veniam-et\\\"]\"', 'Aliquid animi eum molestiae cum aliquid ullam quam. Aliquid tempore velit adipisci. Magni vel blanditiis ex sit rerum temporibus.', 'excepturi-non-quis', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(18, 'Quia dolorem tempora aut sapiente.', 'Expedita modi sed officiis cum reprehenderit. Sit officiis rerum eum. Ex velit dolores cum a voluptatibus.', 13, 3, 8, '2025-04-06', '2025-07-05', 'planning', 464475.42, NULL, '\"[\\\"http:\\\\\\/\\\\\\/zboncak.com\\\\\\/asperiores-distinctio-qui-amet\\\",\\\"http:\\\\\\/\\\\\\/www.lang.net\\\\\\/dolorum-doloremque-incidunt-quis-quo-aliquam\\\"]\"', NULL, 'rerum-eius-sequi', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(19, 'Sit aut harum ea.', 'Atque laborum nam quisquam nostrum dolores. Omnis ipsum est eaque veniam rerum totam. Blanditiis et fugit fugit autem amet.', 38, 6, 10, '2025-04-14', '2025-06-10', 'hold', 518477.27, NULL, '\"[\\\"http:\\\\\\/\\\\\\/rosenbaum.info\\\\\\/et-rerum-delectus-blanditiis-sapiente\\\",\\\"https:\\\\\\/\\\\\\/www.robel.info\\\\\\/eum-doloribus-laboriosam-molestiae-fugit-nostrum\\\"]\"', 'Dolore fuga unde dolorum est. Natus est esse nihil enim est similique voluptatibus voluptatum. Sint magnam accusamus minus nisi sit aperiam magnam doloribus.', 'ullam-eaque-voluptas', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(20, 'Eum amet repellendus veniam.', 'Eius nemo sunt corporis sunt reiciendis ut. Perspiciatis enim est ipsa fuga amet culpa. Cum rem sint qui est. Dolorum animi velit dignissimos quo voluptatibus qui accusantium.', 38, 8, 1, '2025-03-16', NULL, 'in_progress', 649223.82, NULL, '\"[\\\"http:\\\\\\/\\\\\\/schaefer.com\\\\\\/et-architecto-dolores-cum-nostrum-nobis-aperiam-facere-facere.html\\\",\\\"http:\\\\\\/\\\\\\/www.sauer.com\\\\\\/ut-voluptates-minus-fugit-sunt.html\\\"]\"', 'Et esse quibusdam dolores est. Omnis eligendi voluptatibus molestiae praesentium.', 'nostrum-accusamus-quis', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(21, 'Non inventore veniam.', NULL, 37, 5, 9, '2025-02-21', '2025-05-21', 'in_progress', 671442.00, NULL, '\"[\\\"http:\\\\\\/\\\\\\/www.stracke.net\\\\\\/ut-quia-consectetur-mollitia-sit-ipsum-asperiores-sint-sapiente\\\",\\\"http:\\\\\\/\\\\\\/white.com\\\\\\/\\\"]\"', NULL, 'laborum-et-voluptate', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(22, 'Iste sed esse et.', 'Repellendus aperiam eum fuga molestiae optio non corrupti. Quidem sed totam nesciunt omnis corporis ullam. Eius numquam autem consequatur et. Dolor id ea nobis.', 42, 6, 2, '2025-04-04', NULL, 'in_progress', 367240.97, NULL, '\"[\\\"https:\\\\\\/\\\\\\/www.kiehn.com\\\\\\/tempora-tempora-ducimus-quaerat-quia-autem\\\",\\\"http:\\\\\\/\\\\\\/www.quitzon.com\\\\\\/labore-saepe-et-cum-quasi-corporis-nihil-reiciendis\\\"]\"', 'Animi voluptas nostrum doloremque. Ea dolores consequatur voluptas non ea repellendus beatae dolorem. Quo quod ut incidunt ipsum.', 'eius-ratione', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(23, 'Consequatur hic nihil mollitia.', 'Dolores voluptatem veritatis temporibus similique in eaque. Dolorem itaque exercitationem dolor. Consectetur omnis harum quis qui aliquid cumque alias. Et iusto fugiat provident dolores. Unde accusamus iusto nostrum doloribus.', 38, 6, 4, '2025-03-29', NULL, 'hold', 829407.15, NULL, '\"[\\\"http:\\\\\\/\\\\\\/www.kris.com\\\\\\/\\\",\\\"http:\\\\\\/\\\\\\/www.goyette.biz\\\\\\/eum-voluptates-explicabo-corrupti-corporis\\\"]\"', 'Non dolore ratione voluptas. Quo et sit sint eius facere sit. Voluptate sint non non odit numquam qui esse. Ut in laboriosam molestiae impedit adipisci animi.', 'voluptatem-et-sit', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(24, 'Repellat reiciendis incidunt quo aliquam.', NULL, 12, 10, 10, '2025-02-27', '2025-04-07', 'hold', 303791.91, NULL, '\"[\\\"http:\\\\\\/\\\\\\/www.heathcote.com\\\\\\/dolor-et-quas-doloribus-id-exercitationem-esse-facilis-quia.html\\\",\\\"http:\\\\\\/\\\\\\/altenwerth.biz\\\\\\/\\\"]\"', 'Dolor non esse a. Repellendus asperiores a sit quia autem est. Ut aut inventore et voluptatibus est id quia. Odio aut sit et dolor dolor et doloremque.', 'delectus-vel-cumque', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(25, 'Dolorem est debitis voluptatem.', 'Voluptas natus sapiente iste eum dicta ut eius. Autem hic sapiente omnis corrupti. Rem dolor ut et nulla error.', 7, 5, 1, '2025-03-25', '2025-05-27', 'completed', 829013.98, NULL, '\"[\\\"http:\\\\\\/\\\\\\/www.nienow.biz\\\\\\/impedit-eaque-est-aliquid-perferendis-rerum-corporis.html\\\",\\\"http:\\\\\\/\\\\\\/www.stanton.net\\\\\\/dolorem-officiis-amet-dicta-dolores-quibusdam-et-aliquam\\\"]\"', 'Quisquam esse id at et voluptatem quam. Qui quia ducimus rerum et maiores. Ducimus aut eos quod dolorem eius enim est illum. Aut necessitatibus ipsam voluptates.', 'aut-culpa-repellat', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(26, 'web999', 'create WordPress website', 42, 8, 14, '2025-05-08', '2026-04-16', 'planning', 2000000.00, NULL, '[\"documents\\/CV.docx\"]', NULL, 'PR052527', NULL, '2025-05-06 00:56:24', '2025-05-06 00:56:24'),
(27, 'app devlopment', 'dummy dummy dummy dummy dummy dummy dummy dummy dummy', 2, 11, 16, '2025-05-01', '2025-06-07', 'in_progress', 20000.00, NULL, '[\"documents\\/vit.pdf\"]', 'dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy', 'PR052528', NULL, '2025-05-07 06:31:53', '2025-05-07 06:31:53');

-- --------------------------------------------------------

--
-- Table structure for table `project_managers`
--

CREATE TABLE `project_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`skills`)),
  `payment_type` enum('hourly','monthly') NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `pan_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_managers`
--

INSERT INTO `project_managers` (`id`, `first_name`, `last_name`, `birth_date`, `skills`, `payment_type`, `rate`, `email`, `phone_number`, `national_id`, `pan_number`, `address`, `username`, `profile_picture`, `password`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Noemie', 'Schroeder', '1990-03-04', '[\"PHP\", \"Laravel\", \"Vue.js\"]', 'monthly', 2.00, 'margot94@example.net', '+32(8)2377202176', '27', '', '3995 Johns Lights Apt. 884\nNorth Keithmouth, MN 28624', 'boyd.hills', NULL, '9f08f007a605d6923bb0fb146029a0651ea8bc0f', 'active', NULL, NULL, NULL),
(2, 'Beulah', 'Larson', '2004-08-04', '[\"PHP\", \"Laravel\", \"Vue.js\"]', 'hourly', 5.00, 'elena.haag@example.org', '1-048-257-2660x17390', '8', '7', '557 Fadel Brook Apt. 327\nWatsicaberg, WV 08197', 'marilyne.roberts', NULL, 'be982c0cead5b4eb79fd31038473de8d247d5677', 'active', NULL, NULL, NULL),
(3, 'Donavon', 'Wolff', '1995-05-08', '[\"PHP\", \"Laravel\", \"Vue.js\"]', 'monthly', 4.00, 'auer.oral@example.org', '879.867.5148x239', '74', '', '1453 Weber Stravenue\nLottieville, CT 00491', 'tyshawn45', NULL, '3126b83747ebf7bf155c329bb93b227919e4e2fd', 'inactive', NULL, NULL, NULL),
(4, 'Emmie', 'Mertz', '1974-08-01', '[\"PHP\", \"Laravel\", \"Vue.js\"]', 'hourly', 0.00, 'kernser@example.com', '732-316-6801', '19', '8', '8973 Berniece Fields\nNorth Lloydstad, MI 71267', 'unique.legros', NULL, '2644aaf0b4ff88d960124dd78fda19df45bac590', 'inactive', NULL, NULL, NULL),
(5, 'Gisselle', 'Hudson', '2003-11-15', '[\"PHP\", \"Laravel\", \"Vue.js\"]', 'hourly', 9.00, 'fharber@example.com', '1-914-198-5390', '25', '1', '64971 Abshire Locks Apt. 964\nNew Delores, MO 33449-2977', 'ygreen', NULL, '4ff9cf22e83feed52cf532c82333fe594549f5ee', 'active', NULL, NULL, NULL),
(6, 'Kylie', 'Mohr', '2017-05-27', '[\"PHP\", \"Laravel\", \"Vue.js\"]', 'monthly', 1.00, 'nicole.bailey@example.com', '+94(9)6983680188', '15', '2', '60399 Margaretta Falls\nEast Mallory, UT 46576-7717', 'mason.muller', NULL, '4669c0f0bbb6186647fc9f8f5fea5b330f3eb032', 'active', NULL, NULL, NULL),
(7, 'Lori', 'Mueller', '2004-10-10', '[\"PHP\", \"Laravel\", \"Vue.js\"]', 'hourly', 8.00, 'jayne.okeefe@example.com', '(368)926-7560', '81', '5', '501 Thomas Course\nRicehaven, ME 48489-6797', 'bradley.mitchell', NULL, 'd952b81adc76fbecb4c7f5bba54c520845c2c630', 'inactive', NULL, NULL, NULL),
(8, 'Addie', 'Davis', '1993-07-29', '[\"PHP\", \"Laravel\", \"Vue.js\"]', 'monthly', 3.00, 'rita.ward@example.com', '451-306-0991x07590', '72', '9', '32866 Lizeth Meadow\nVaughnfort, NJ 53592', 'pamela98', NULL, 'd78de269d5a847d8929e21fe1a8b231b8fa14bfd', 'inactive', NULL, NULL, NULL),
(9, 'Monserrate', 'Price', '2013-05-23', '[\"PHP\", \"Laravel\", \"Vue.js\"]', 'hourly', 1.00, 'camryn80@example.com', '017.809.4774x1023', '24', '8', '4144 Walsh Ferry Apt. 900\nLake Mallory, MN 41992', 'marianna.bradtke', NULL, 'c070556bc6ebca600830dbecf0cdda640dd666ef', 'inactive', NULL, NULL, NULL),
(10, 'Kiera', 'Stiedemann', '2010-03-01', '[\"PHP\", \"Laravel\", \"Vue.js\"]', 'monthly', 6.00, 'olson.alessandro@example.org', '692-437-6906x1287', '93', '6', '652 McCullough Plains\nWiegandmouth, ID 05857-4292', 'pwitting', NULL, '62daa3e65d11af8e26e12cfed1d86d6923ba5db9', 'active', NULL, NULL, NULL),
(11, 'Conner', 'Volkman', '2004-08-28', '[\"AWS\",\"React\"]', 'monthly', 8087.05, 'nelson.gorczany@example.net', '1-272-963-4520', '59649707437', 'LLUHR11207H', '606 Ena Ridges\nLittleport, AZ 34545-8920', 'ytowne', 'https://via.placeholder.com/200x200.png/00ccee?text=people+id', '$2y$10$IDouRkWbMB7SnXIjW2Csjebn9eQbcfrVoYEtaR/53/LBP1ywjMU/6', 'inactive', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(12, 'Grant', 'Romaguera', '1999-11-11', '[\"React\",\"Docker\",\"Node.js\"]', 'monthly', 3051.11, 'floyd.klein@example.net', '+15109723514', '37807171490', 'XBXTQ74555V', '62234 Mayert Vista Apt. 568\nNorth Jalonhaven, MO 20196', 'danielle18', 'https://via.placeholder.com/200x200.png/0077dd?text=people+quas', '$2y$10$EFmJBEsDytTyjnCV5KWf7uOFBxLhQyCyCLH3KDL4UCknSV4ZzQeNO', 'active', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(13, 'Isabell', 'Connelly', '1998-03-07', '[\"React\",\"AWS\",\"Node.js\"]', 'hourly', 3742.04, 'elisha.renner@example.com', '469-284-3712', '49644022901', 'AAPFO52763U', '202 Orn Turnpike Suite 570\nNorth Gerryberg, NH 23701-2218', 'king.emiliano', 'https://via.placeholder.com/200x200.png/004411?text=people+molestiae', '$2y$10$H1Ls5su7MZvihsTIlVjBO.cMCxmf2KD.asXfAxmuH/699PX/CMeZ2', 'inactive', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(14, 'Zita', 'Donnelly', '1981-02-10', '[\"Node.js\",\"Vue.js\",\"Docker\"]', 'hourly', 6727.78, 'lesley51@example.com', '870-677-9544', '66854713663', 'QRWGO12833S', '2068 Candice Loaf Suite 561\nEast Mercedes, HI 04625-0367', 'chelsea11', 'https://via.placeholder.com/200x200.png/006666?text=people+accusamus', '$2y$10$JozCCsfHSKVZPbX5nwtWhOOMyy9/UeI60X0y0v4f.zoGVuY/z..b.', 'inactive', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(15, 'Armani', 'Braun', '1982-06-29', '[\"React\",\"Node.js\",\"Laravel\"]', 'hourly', 8159.99, 'kristian67@example.com', '407.696.5557', '95787639631', 'UEGHO02778E', '6894 Isabella Light Suite 761\nSouth Leonora, TX 56893-9321', 'ahickle', 'https://via.placeholder.com/200x200.png/00ee55?text=people+adipisci', '$2y$10$0VZTwA1rCyAnaJB3d8H6OOBjz7rYRoXs61WlTX10H1Ihc4Syfc6zC', 'inactive', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(16, 'Delpha', 'Fadel', '2004-02-14', '[\"Node.js\",\"Laravel\",\"Vue.js\",\"AWS\"]', 'hourly', 4679.40, 'ashlynn.spinka@example.com', '352-515-2224', '21559687157', 'MBTDW21579O', '95883 Cormier Ways\nCoraville, IL 93743', 'rkuhlman', 'https://via.placeholder.com/200x200.png/003344?text=people+quaerat', '$2y$10$ZUKkOaaqCdY5bXiUQK6gN.xMda4SZaEOksRPoklMk1hzMWnLnmIqO', 'inactive', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(17, 'Gianni', 'Boyle', '1994-08-01', '[\"AWS\",\"Vue.js\"]', 'hourly', 3028.95, 'royce05@example.org', '+1-323-875-3136', '18306800048', 'QGFXF06524T', '39599 Odie Greens Apt. 716\nLake Mavis, AL 38691-6273', 'blick.tierra', 'https://via.placeholder.com/200x200.png/005599?text=people+vel', '$2y$10$oPH3YtjchKDPo6fO9dU3v.43spcPHZgmd.9RiqPzwxz42TRZLOTLC', 'inactive', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(18, 'Jonathan', 'Rodriguez', '1999-03-16', '[\"Laravel\",\"Node.js\",\"Docker\",\"AWS\"]', 'hourly', 3939.87, 'ikeebler@example.net', '+1 (640) 691-7015', '25009412107', 'VMKMT98497B', '6377 Mueller Ville\nSouth Lizzie, NV 88966-8327', 'ulises02', 'https://via.placeholder.com/200x200.png/00eeaa?text=people+distinctio', '$2y$10$0LudDUBQ/uUByqKq4ZitLuA67/put7.od0Z7EwPzQpa9Z8HCMVbw6', 'inactive', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(19, 'Sarina', 'Carroll', '1984-09-16', '[\"Laravel\",\"Docker\",\"Node.js\",\"AWS\"]', 'hourly', 1651.44, 'zaria.nikolaus@example.org', '+1-480-262-1703', '95332485671', 'AXSRG88331R', '20053 Shemar Brooks\nLake Afton, HI 07253-4052', 'mhudson', 'https://via.placeholder.com/200x200.png/006677?text=people+reiciendis', '$2y$10$fSDbw2abAMpntpcidStnkeE6wMq513b3.a2O61pj94Mn0IGdFhIIe', 'inactive', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(20, 'Lazaro', 'Bernier', '1973-01-05', '[\"Vue.js\",\"Laravel\",\"AWS\"]', 'monthly', 7302.16, 'runolfsson.meaghan@example.net', '626-645-3717', '86879256588', 'VWSPD19581Y', '3548 Wilderman Expressway\nGillianmouth, MI 29741', 'yweber', 'https://via.placeholder.com/200x200.png/0077dd?text=people+in', '$2y$10$H5Khv3dJxor1UfayXuhVFu2ceWF5kamUFo/njpDojV0yw/QE36A1e', 'active', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`skills`)),
  `payment_type` enum('hourly','monthly') NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `pan_number` varchar(255) NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `role` enum('consultant','senior_consultant','team_lead','senior_team_lead','project_manager','senior_project_manager','program_manager','senior_program_manager','vice_president','director','ceo') NOT NULL DEFAULT 'consultant',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `country_id`, `first_name`, `last_name`, `birth_date`, `skills`, `payment_type`, `rate`, `email`, `phone_number`, `national_id`, `pan_number`, `designation`, `address`, `username`, `profile_picture`, `password`, `created_by`, `updated_by`, `status`, `role`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'jay', 'patel', '2001-12-09', '[\"AWS\",\"Laravel\"]', 'monthly', 1625.98, 'jay@gmail.com', '+912283966368', '40453267084', 'CZNCE30479C', 'Communications Teacher', '45202 Casper Plaza Suite 605\r\nBergnaumhaven, VA 10787', 'allene.doyle', 'https://via.placeholder.com/200x200.png/009955?text=people+fugit', '$2y$10$eteG/o8Seq0VFdhoSQOTYeJDM3GXy00izhFVGlU5UyZnZnF.eyx5m', NULL, 'Treva Howe', 'active', 'consultant', NULL, '2025-04-15 07:31:20', '2025-06-03 06:22:41'),
(2, NULL, 'Jaleel', 'Hilpert', '1981-06-17', '[\"SQL\",\"Laravel\"]', 'monthly', 6552.96, 'mills.florian@example.com', '+16033168651', '46301136848', 'GDJKE26131C', NULL, '4316 Maymie Land\nErdmanview, ID 79805', 'jmosciski', 'https://via.placeholder.com/200x200.png/0077aa?text=people+omnis', '$2y$10$sJsbDBiY.H/v4Nmlx8KUjuveCXHs11IolvA5uJk9wXqW3hGSx1DQS', 'Joanie Powlowski', 'Dr. Wendell Schuster', 'inactive', 'project_manager', '2025-09-04 03:58:38', '2025-04-15 07:31:20', '2025-09-04 03:58:38'),
(3, NULL, 'Dulce', 'Volkman', '2001-11-09', '[\"Node.js\",\"AWS\"]', 'hourly', 2083.31, 'cummings.elisa@example.com', '+17605747174', '37245980526', 'ICWFJ89605C', 'Radiologic Technician', '10121 Anjali Plains\nSouth Bernadetteport, AL 69339', 'mercedes75', 'https://via.placeholder.com/200x200.png/00cc55?text=people+placeat', '$2y$10$S2banWMmThJ9d0XkFRoNmupadW2iiC05YGXI7zNO8f6/anYwa9a7G', 'Ms. Mertie Sipes MD', NULL, 'active', 'ceo', '2025-09-04 03:58:47', '2025-04-15 07:31:20', '2025-09-04 03:58:47'),
(4, NULL, 'Dante', 'McDermott', '1983-05-28', '[\"Laravel\",\"SQL\",\"Vue.js\"]', 'monthly', 6955.78, 'frederique98@example.net', '+1 (585) 736-9828', '05682676253', 'ARTOW05169S', NULL, '2559 Jacobi Drives Suite 459\nNorth Jaydon, MO 68027', 'maggie.howe', 'https://via.placeholder.com/200x200.png/00cc77?text=people+et', '$2y$10$Zk/7tnqI5YOqEZbJdQVqRea26f.E897UTlMhxIRdJwlWy8j578.aW', NULL, NULL, 'active', 'senior_project_manager', '2025-05-06 00:31:47', '2025-04-15 07:31:20', '2025-05-06 00:31:47'),
(5, NULL, 'Sean', 'Metz', '1983-06-22', '[\"Laravel\",\"Vue.js\",\"AWS\"]', 'monthly', 6921.62, 'oheller@example.net', '740-826-5794', '13394037476', 'CGTZG12724F', 'Prosthodontist', '641 Dorothea Summit Apt. 189\nPort Vedatown, IA 54195-3876', 'devin.stroman', 'https://via.placeholder.com/200x200.png/007755?text=people+tempora', '$2y$10$L7daubLd8bfvj91uq3ZqnOXj4eiostyaz.l0ynxh5K5JwqQexu7Xy', 'Kianna Kunze', 'Mr. Madison Schinner', 'active', 'senior_program_manager', '2025-05-06 00:31:35', '2025-04-15 07:31:20', '2025-05-06 00:31:35'),
(6, NULL, 'Fermin', 'Hickle', '1983-07-26', '[\"Laravel\",\"Vue.js\"]', 'hourly', 2946.29, 'wreichel@example.net', '(270) 264-3073', '51222285601', 'FQHAG91035D', 'Nuclear Power Reactor Operator', '2556 Goodwin Turnpike\nPort Derekshire, MS 00922', 'langworth.felipa', 'https://via.placeholder.com/200x200.png/0022dd?text=people+fuga', '$2y$10$zlfBdMHyHT3T8TWfuwf2Zeeb2rYihw7B8S1/zL61d0ReWrGy4fhAm', NULL, 'Abbey Hudson', 'active', 'project_manager', '2025-09-04 03:58:51', '2025-04-15 07:31:20', '2025-09-04 03:58:51'),
(7, NULL, 'Murphy', 'Harris', '1996-08-25', '[\"AWS\",\"Vue.js\",\"Laravel\",\"React\"]', 'hourly', 6071.52, 'weber.delia@example.com', '225.559.5091', '92076520388', 'OUJTA23072P', 'Transportation Worker', '21875 McClure Inlet\nSouth Princeborough, VT 43912-6041', 'shanna81', 'https://via.placeholder.com/200x200.png/005555?text=people+qui', '$2y$10$44G0Eu44tNqIT1GKhDPs0e9qSD6Mx4yr7jxnotDqP4vgF/EKY0HrO', NULL, NULL, 'active', 'senior_project_manager', '2025-05-06 00:30:50', '2025-04-15 07:31:20', '2025-05-06 00:30:50'),
(8, NULL, 'Sonya', 'Block', '1972-11-30', '[\"SQL\",\"Node.js\",\"Vue.js\"]', 'hourly', 4377.42, 'iconn@example.com', '701.812.5664', '06407035435', 'IHRFL57159Q', 'Electronics Engineering Technician', '9738 Aisha Burg Apt. 384\nEast Crawford, IA 47565', 'rheller', 'https://via.placeholder.com/200x200.png/00ff33?text=people+tempore', '$2y$10$Pv2rzOrBe8jh6NPzb/ZBveDJk9nF5b5S/7A9l0WKn6X.TJ3i5Oaoi', NULL, 'Mr. Jacey Schmitt', 'inactive', 'senior_consultant', '2025-05-06 00:31:06', '2025-04-15 07:31:20', '2025-05-06 00:31:06'),
(9, NULL, 'Kameron', 'Leuschke', '1984-08-15', '[\"Vue.js\",\"AWS\"]', 'hourly', 9080.04, 'alessandra61@example.org', '+918179902681', '92027392070', 'UUVPX49086N', NULL, '81887 Bill Inlet\r\nSkilesview, OR 80234', 'kessler.winifred', 'https://via.placeholder.com/200x200.png/00ffaa?text=people+beatae', '$2y$10$nWyGozd.WIV32AHUKq4K0ul7JO4jIX2I5p8RvhjxckHj9vND2EZSq', NULL, 'Matilda Ruecker II', 'active', 'consultant', NULL, '2025-04-15 07:31:20', '2025-05-06 00:21:54'),
(10, NULL, 'Zackery', 'Nolan', '1973-08-12', '[\"Vue.js\",\"SQL\",\"AWS\",\"Laravel\"]', 'monthly', 5349.73, 'dboehm@example.com', '1-423-490-1061', '72304727514', 'SYGLT30101Y', NULL, '42162 Wisozk Locks Suite 747\nLoweland, GA 34703-2711', 'nweber', 'https://via.placeholder.com/200x200.png/002266?text=people+fugit', '$2y$10$ctAj4HpKduAqp01rWgl1NuI2RAe3qR79gWzcxvfRf2lH.Zrw0wOXK', NULL, 'Dino Goodwin', 'inactive', 'senior_project_manager', '2025-05-06 00:30:29', '2025-04-15 07:31:20', '2025-05-06 00:30:29'),
(11, NULL, 'Carley', 'Doyle', '1996-03-20', '[\"Laravel\",\"React\",\"AWS\",\"SQL\"]', 'hourly', 5140.53, 'cielo.kulas@example.com', '641.532.2327', '40862365678', 'WZFQK78388Z', 'Electrotyper', '3844 Leuschke Mill Apt. 691\nWest Nevaville, MS 56541', 'buddy59', 'https://via.placeholder.com/200x200.png/00ee88?text=people+dolorem', '$2y$10$QxCV2kW1GgYwbhPpB9F0eeMaxyPv6BwuPnqrdZzFuwADMpFLfNt66', 'Mr. Elbert Dietrich', 'Rachael Emard', 'inactive', 'consultant', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20'),
(13, NULL, 'venam', 'nullo', '2025-05-07', '[\"html\",\"css\",\"java\"]', 'hourly', 40000.00, 'nullo@gmail.com', '+917600659551', '1681351813218', 'FAZX7860H', 'java developer', 'xyz ghar', 'ven013', NULL, '$2y$10$LDvXJrIGoAxFdWyGfN8.fOXoS8cPYDgK/lSEr5O/6eEuVjnqiJxTu', 'admin@thequantumtech.com', NULL, 'active', 'consultant', NULL, '2025-05-06 00:29:57', '2025-05-06 00:29:57'),
(14, NULL, 'nameless', 'god', '2010-02-06', '[\"html\"]', 'hourly', 500000.00, 'god@gmail.com', '+917600659558', '51651321651', '15151351385', 'backend developer', 'ghar xyz', 'nam014', NULL, '$2y$10$QbQnuXaZdS1WTw3t0dwdFOJPpY3btFtL4YBN24pZm.k.VbWmp3xca', 'admin@thequantumtech.com', NULL, 'active', 'project_manager', NULL, '2025-05-06 00:33:36', '2025-05-06 00:33:36'),
(15, NULL, 'denny', 'gom', '2025-05-04', '[\"css\",\"figma\"]', 'hourly', 15000.00, 'gom@gmail.com', '+918200288399', '1984651832183', '15151351385', 'java developer', 'xuz', 'den015', NULL, '$2y$10$H3MUyyf/4OP3luZs1jw1u.kph9VvnoDSd4tMaisIBG9R3bpnp/VL6', 'admin@thequantumtech.com', NULL, 'active', 'consultant', '2025-05-07 06:25:45', '2025-05-06 00:35:39', '2025-05-07 06:25:45'),
(16, NULL, 'anand', 'prajapati', '2025-05-05', '[\"html\",\"css\",\"javascript\"]', 'monthly', 20000.00, 'anand@gmail.com', '+918754126948', '22', '1234', 'senior devloper', 'ahmedabad', 'ana016', NULL, '$2y$10$WYpxc4//o1ZLu9RKEheeL.X77zMl5qzGo0uIik7.9E9PpxZlEekh2', 'admin@thequantumtech.com', NULL, 'active', 'project_manager', NULL, '2025-05-07 06:25:28', '2025-05-07 06:25:28'),
(17, NULL, 'anad_consul', 'tripathi', '2025-05-01', '[\"html\",\"css\",\"javascript\"]', 'hourly', 20000.00, 'anad_consul@gmail.com', '+918757945218', '22', '1234', 'backed devloper', 'ahmedabad', 'ana017', NULL, '$2y$10$48P0wqiyjSuZe9kBYQFTt.D9ykJVPwfoYPtzG.n8zmZMulJqMdh12', 'admin@thequantumtech.com', NULL, 'active', 'consultant', NULL, '2025-05-07 06:36:08', '2025-05-07 06:36:08'),
(19, NULL, 'testp', 'testy', '2025-06-17', '[\"test\"]', 'monthly', 20000.00, 'test@gmail.com', '+918123456789', '20', '1234', NULL, 'ahmedabad', 'tes018', NULL, '$2y$10$uHf4T2uJvNkN2nvDMwSV9O8RxwZv11hfjNUo3PQhuBT5TgJ42QC/m', 'admin@thequantumtech.com', NULL, 'active', 'senior_consultant', NULL, '2025-06-04 01:11:21', '2025-06-04 01:11:21'),
(21, 105, '1', '1', '2025-09-01', '[\"1\"]', 'hourly', 1.00, '1@gmail.com', '+911', '1', '11', '1', '1', '1020', NULL, '$2y$10$MdYseLxJFoLu.ny4kMBq6.2ub.UWDK2YBSssS91ewZ6ytaOIIcvO2', 'admin@thequantumtech.com', NULL, 'active', 'consultant', NULL, '2025-09-04 05:08:08', '2025-09-04 05:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `milestone_id` bigint(20) UNSIGNED DEFAULT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_description` text DEFAULT NULL,
  `status` enum('To Do','In Progress','Completed') NOT NULL DEFAULT 'To Do',
  `priority` enum('Low','Medium','High') NOT NULL DEFAULT 'Medium',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `estimated_hours` int(11) DEFAULT NULL,
  `dependencies` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `milestone_id`, `task_name`, `task_description`, `status`, `priority`, `start_date`, `end_date`, `estimated_hours`, `dependencies`, `created_by`, `updated_by`, `comments`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 16, 11, 'Cumque qui.', 'Iure incidunt recusandae vero ipsam iure saepe. Nam amet nostrum nulla eum dicta dolor explicabo. Laborum sunt quis porro rerum earum neque molestiae. Sed voluptas voluptatem officiis blanditiis velit aliquam quia.', 'Completed', 'High', '2015-04-12', '2025-05-09', 31, 'veritatis', 'Prof. Miller Barrows DVM', 'Litzy McKenzie', 'Et odit odit omnis necessitatibus.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(2, 17, 12, 'Aperiam aut mollitia quasi.', 'Sed soluta sint reprehenderit nostrum at vel. Nihil sint culpa cumque laboriosam et voluptatem sunt architecto. Aut sit ut amet ut ut. Reprehenderit minima voluptatem unde laudantium perferendis.', 'Completed', 'Low', '2018-01-22', '2025-06-11', 71, 'aut', 'Filiberto Schultz', 'Dr. Lelia Bayer Sr.', 'Iure aut sed repudiandae sit.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(3, 18, 13, 'Velit illum dolores.', 'Est at et qui facilis autem. Minima et quod molestiae quod eos reprehenderit. Sunt provident distinctio dolore deleniti. Accusantium neque mollitia in ut.', 'In Progress', 'High', '2010-01-03', '2025-05-28', 32, 'quidem', 'Karlie Connelly', 'Dr. Macey Parker', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(4, 19, 14, 'Quam aut officiis.', 'Deserunt est ab consectetur nulla fugit nihil. Recusandae numquam sed ullam quis magnam libero reprehenderit. Enim vel ea officia vero expedita voluptatum doloribus. Voluptatem debitis sequi laboriosam ipsam.', 'In Progress', 'Medium', '1981-01-24', '2025-05-23', 71, 'nisi', 'Ms. Josephine Rogahn II', 'Ewald Nicolas PhD', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(5, 20, 15, 'Illum quaerat.', 'Impedit dignissimos exercitationem suscipit cumque. Consequuntur eum sunt consequuntur nihil sit. Ipsa et eligendi tempora quas doloribus.', 'To Do', 'Low', '1990-08-25', '2025-05-13', 33, 'qui', 'Kaci Halvorson', 'Aida Kuhlman', 'Ut cumque dolor maxime animi asperiores tempora rerum assumenda.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(6, 21, 16, 'Atque doloremque est.', 'Deserunt sunt sed enim quia amet accusantium adipisci. Optio doloribus consequatur molestiae fugiat aut est.', 'In Progress', 'Medium', '2010-11-06', '2025-06-02', 39, 'autem', 'Kiara Gaylord', 'Fanny Gusikowski', 'Et optio in quo.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(7, 22, 17, 'Sit magni est in quam.', 'Optio autem ut quo ex. Provident autem qui quis officia veniam. Minus beatae eius corporis rerum nam odit totam. Voluptatem aliquid ut sunt sunt et pariatur eaque.', 'Completed', 'Low', '1992-12-31', '2025-06-08', 13, NULL, 'Jaquelin Tremblay Jr.', 'Ms. Maeve Farrell', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(8, 23, 18, 'Blanditiis nemo omnis blanditiis.', 'Cumque in et dolorum. Quod officiis et expedita consectetur et optio sint. Facilis at iste dolorum et. Maiores excepturi possimus pariatur aut.', 'To Do', 'Low', '1980-02-15', '2025-06-06', 54, 'iure', 'Jack Hilpert DDS', 'Crawford Jenkins', 'Nisi et et aliquid tempora.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(9, 24, 19, 'Quia ratione ipsum iusto.', 'Ut at earum vel sit laborum deserunt. Ut et et alias libero consequuntur autem. Iure aliquid non reiciendis non ducimus pariatur.', 'In Progress', 'High', '2018-07-09', '2025-06-09', 73, NULL, 'Dell Turner', 'Rhett Dicki', NULL, '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(10, 25, 20, 'Dolore consequatur nemo.', 'Qui dolorem labore non quia est. Inventore cum est amet labore. Quia nesciunt ducimus deleniti adipisci saepe voluptatem. Saepe sint magni provident est.', 'In Progress', 'Medium', '1970-02-02', '2025-06-01', 81, NULL, 'Prof. America Harber III', 'Hubert Lubowitz MD', 'Numquam consequatur enim occaecati.', '2025-04-15 07:31:20', '2025-04-15 07:31:20', NULL),
(11, 5, 3, 'learn web 3', 'dummy dummy', 'To Do', 'High', '2025-05-16', '2025-05-17', 10, NULL, 'admin@thequantumtech.com', NULL, NULL, '2025-04-29 04:29:11', '2025-04-29 04:29:11', NULL),
(12, 18, 21, 'devlop a web site', 'dummy dummy dummy dummy dummy dummy dummy dummy dummy', 'To Do', 'High', '2025-04-06', '2025-04-07', 10, 'server', 'admin@thequantumtech.com', NULL, 'dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy', '2025-04-29 04:59:14', '2025-04-29 04:59:14', NULL),
(13, 18, 21, 'devlop a web site 2', 'dummy dummy dummy dummy dummy dummy dummy dummy', 'To Do', 'High', '2025-04-06', '2025-04-07', 10, 'server', 'admin@thequantumtech.com', NULL, 'dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy dummy', '2025-04-29 05:03:01', '2025-04-29 05:03:01', NULL),
(14, 26, 22, 'design figma for mobile screen', 'create figma using client doc.', 'To Do', 'Low', '2025-05-10', '2025-06-19', 80, 'document', 'admin@thequantumtech.com', NULL, NULL, '2025-05-06 01:06:59', '2025-05-06 01:06:59', NULL),
(15, 26, 22, 'design figma for desktop  screen', 'create figma using document', 'To Do', 'Low', '2025-05-17', '2025-05-24', 48, 'document', 'admin@thequantumtech.com', NULL, NULL, '2025-05-06 01:08:18', '2025-05-06 01:08:18', NULL),
(16, 26, 23, 'create html pages', 'create html page using figma', 'To Do', 'Low', '2025-09-12', '2025-09-27', 80, 'figma file', 'admin@thequantumtech.com', NULL, NULL, '2025-05-06 01:09:57', '2025-05-06 01:09:57', NULL),
(17, 27, 24, 'decide flow', 'dummy dummy dummy dummy dummy dummy dummy dummy dummy', 'To Do', 'High', '2025-05-01', '2025-05-02', 16, 'high system configuration', 'admin@thequantumtech.com', NULL, 'dummy dummy dummy dummy dummy dummy dummy dummy', '2025-05-07 06:38:19', '2025-05-07 06:38:19', NULL),
(18, 5, 25, 'dd1', 'dd1', 'To Do', 'Low', '2025-07-01', '2025-07-01', 2, '1', 'admin@thequantumtech.com', NULL, '1', '2025-07-28 07:57:36', '2025-07-28 07:57:36', NULL),
(19, 5, 25, '2', '2', 'In Progress', 'Low', '2025-07-01', '2025-07-02', 2, '2', 'admin@thequantumtech.com', NULL, '2', '2025-07-28 08:25:56', '2025-07-28 08:26:14', NULL),
(20, 5, 25, '3', '3', 'Completed', 'High', '2025-07-02', '2025-07-03', 3, '3', 'admin@thequantumtech.com', NULL, '3', '2025-07-28 08:26:36', '2025-07-28 08:27:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timesheets`
--

CREATE TABLE `timesheets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assigntask_id` bigint(20) UNSIGNED NOT NULL,
  `comments` text DEFAULT NULL,
  `date` date NOT NULL,
  `hour` int(11) NOT NULL,
  `status` enum('pending','approve','recheck','reject') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timesheets`
--

INSERT INTO `timesheets` (`id`, `assigntask_id`, `comments`, `date`, `hour`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, '2025-04-27', 7, 'approve', '2025-04-29 06:05:47', '2025-04-29 06:05:47'),
(2, 4, NULL, '2025-04-20', 5, 'pending', '2025-04-29 06:05:59', '2025-04-29 06:05:59'),
(7, 21, NULL, '2025-04-28', 1, 'approve', '2025-04-30 05:03:13', '2025-04-30 05:03:13'),
(8, 22, NULL, '2025-04-22', 1, 'pending', '2025-04-30 05:03:27', '2025-05-06 07:44:05'),
(21, 21, NULL, '2025-04-27', 3, 'approve', '2025-05-02 04:18:04', '2025-05-02 04:18:04'),
(29, 4, NULL, '2025-05-04', 7, 'pending', '2025-05-05 00:54:36', '2025-05-05 00:54:36'),
(30, 22, NULL, '2025-05-04', 7, 'pending', '2025-05-05 00:54:36', '2025-05-05 00:54:36'),
(31, 22, NULL, '2025-05-05', 7, 'pending', '2025-05-05 00:54:36', '2025-05-05 00:54:36'),
(49, 21, NULL, '2025-05-04', 5, 'pending', '2025-05-06 07:46:13', '2025-05-06 08:11:11'),
(50, 21, NULL, '2025-05-05', 5, 'pending', '2025-05-06 07:46:13', '2025-05-06 07:46:13'),
(51, 21, NULL, '2025-05-06', 5, 'pending', '2025-05-06 07:46:13', '2025-05-06 07:46:13'),
(52, 21, NULL, '2025-05-07', 5, 'pending', '2025-05-06 07:46:13', '2025-05-06 07:48:02'),
(53, 21, NULL, '2025-05-08', 5, 'pending', '2025-05-06 07:46:13', '2025-05-06 07:46:13'),
(54, 21, NULL, '2025-05-10', 1, 'pending', '2025-05-06 07:46:13', '2025-05-06 07:48:02'),
(56, 8, NULL, '2025-05-11', 1, 'pending', '2025-05-12 08:50:11', '2025-05-12 08:50:11'),
(57, 17, NULL, '2025-05-11', 1, 'pending', '2025-05-12 08:50:11', '2025-05-12 08:50:11'),
(58, 17, NULL, '2025-05-12', 1, 'pending', '2025-05-12 08:50:11', '2025-05-12 08:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pan_number` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `bank_account_no` varchar(255) NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `Tax_number` varchar(255) DEFAULT NULL,
  `code_type` enum('both','IFSC','Swift') NOT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `swift_code` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `first_name`, `last_name`, `profile_picture`, `email`, `phone_number`, `national_id`, `address`, `pan_number`, `company_name`, `bank_account_no`, `account_holder_name`, `branch_name`, `bank_name`, `Tax_number`, `code_type`, `ifsc_code`, `swift_code`, `website`, `password`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Aisha', 'Beer', NULL, 'gdaugherty@example.org', '1-569-092-5659', '10', '7178 Rudolph Port Apt. 727\nVidalburgh, IN 13929-6614', '', 'Reichert, Green and Spencer', '135', '4814331', 'aut', 'ipsam', '5', 'both', 'ixmq', 'guhw', 'http://www.treutel.info/', 'b365c0ae30ccb2ce2fc0b6917bfeb4df87810eea', 'active', NULL, NULL, NULL),
(2, 'Valerie', 'Marquardt', NULL, 'rfranecki@example.org', '553-262-1939x237', '53', '672 Pascale Fall Apt. 163\nWest Bobbyport, CO 90109', '90000', 'Wisozk-Erdman', '3425', '', 'qui', 'culpa', '43', 'Swift', 'sshj', 'gvls', 'http://dubuque.com/', 'ba03cb6160f0580185419e1c031a92167cf65227', 'active', NULL, NULL, NULL),
(3, 'Emory', 'Botsford', NULL, 'adan75@example.com', '1-205-360-6847', '68', '3645 Farrell Bypass Apt. 508\nMarquesmouth, NV 70433', '88786', 'Leannon-Rippin', '83', '1291', 'velit', 'quisquam', '88', 'Swift', 'idsx', 'vwic', 'http://swaniawski.com/', '9a1937831b3297caeb4ed11bacf7dc52de5a07af', 'inactive', NULL, NULL, NULL),
(4, 'Raheem', 'Howell', NULL, 'jackie73@example.org', '01072214128', '41', '6500 Nicolette Pine Suite 902\nKariville, WY 05458', '7085', 'Beahan-Hessel', '854', '9278', 'iusto', 'quibusdam', '3', 'both', 'zfvq', 'jqca', 'http://www.considinejaskolski.com/', '2a825a1e5c0e6dd12e961894fa6ddab3e1680267', 'active', NULL, NULL, NULL),
(5, 'Gayle', 'Kiehn', NULL, 'jleuschke@example.net', '257-461-6495', '40', '909 Kshlerin Lake Suite 168\nGleichnerview, RI 58511-4112', '37', 'Connelly LLC', '97524', '534', 'nihil', 'neque', '502745737', 'Swift', 'veal', 'etlp', 'http://yundtmitchell.com/', '803f350fb074df76d35117d6095bdda8ae4decbc', 'active', NULL, NULL, NULL),
(6, 'Wiley', 'Runolfsdottir', NULL, 'helena99@example.com', '929-249-3633', '67', '389 Hartmann Station Suite 027\nBartonmouth, VA 93903', '17', 'Swaniawski LLC', '545938080', '9', 'nulla', 'itaque', '6230869', 'IFSC', 'gbdc', 'yazb', 'http://jakubowski.com/', '25fd015fe830d9de8185f719e7d1d2e6f1d0bffd', 'active', NULL, NULL, NULL),
(7, 'Tad', 'Lockman', NULL, 'john.mcglynn@example.net', '04400209458', '68', '87583 Gladys Unions\nLake Oral, KY 70305-2929', '796', 'Hills, Vandervort and Ankunding', '99', '1256', 'maiores', 'placeat', '23646747', 'Swift', 'vlsz', 'byfz', 'http://www.wiegand.com/', '3d881a472460d8c1db156c1a1f4126e910305b0c', 'active', NULL, NULL, NULL),
(8, 'Dayna', 'OKon', NULL, 'tobin.von@example.net', '04103300571', '2', '1061 Walker Mall\nJakubowskifort, CO 51486', '719654', 'Kutch-Kunde', '628387613', '242', 'id', 'mollitia', '44', 'both', 'fbyf', 'jdhe', 'http://kirlinweissnat.org/', '22650dc956ed92b7ad1909d7c34555e0c25591b1', 'inactive', NULL, NULL, NULL),
(9, 'Salvatore', 'Mraz', NULL, 'haskell.mccullough@example.com', '+13(5)1537091303', '14', '218 Gislason Square\nNew Aubree, IN 74831', '481311965', 'Veum-Franecki', '6', '60', 'non', 'inventore', '8', 'both', 'tnsa', 'lrwt', 'http://www.volkman.biz/', 'f18e1e6d5fb9f02066153788f78b876ba9718bf3', 'inactive', NULL, NULL, NULL),
(10, 'Lavinia', 'Paucek', NULL, 'ddibbert@example.org', '1-032-467-4763x7991', '19', '61859 Erick Heights Apt. 174\nNorth Reyes, LA 85918-5762', '', 'Wilderman-Wilderman', '379', '6897', 'eum', 'id', '3', 'IFSC', 'nifp', 'wpbr', 'http://www.ruecker.biz/', '3137df16fb73539fdac41664cf0f73c8b7190555', 'active', NULL, NULL, NULL),
(11, 'shubham', 'tripathi', NULL, 'shubham@gmail.com', '+917894581249', '22', 'ahmedabad', '1234', 'balagi', '123456789012', 'sunder', 'bapunagar', 'BOI', '1234', 'both', '1234', NULL, 'balagi.com', '$2y$10$7NtIX.14fP6cBa4Q/9ojVO/.e0C5X4rKHihFWnh.L1C6Ic9V2nbJq', 'active', NULL, '2025-05-07 06:29:42', '2025-05-07 06:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_company`
--

CREATE TABLE `vendor_company` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_company`
--

INSERT INTO `vendor_company` (`id`, `vendor_id`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 11, 31, '2025-05-07 06:29:42', '2025-05-07 06:29:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `assigntasks`
--
ALTER TABLE `assigntasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigntasks_project_id_foreign` (`project_id`),
  ADD KEY `assigntasks_milestone_id_foreign` (`milestone_id`),
  ADD KEY `assigntasks_task_id_foreign` (`task_id`),
  ADD KEY `assigntasks_consultant_id_foreign` (`consultant_id`);

--
-- Indexes for table `assignteams`
--
ALTER TABLE `assignteams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignteams_project_id_foreign` (`project_id`),
  ADD KEY `assignteams_consultant_id_foreign` (`consultant_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_country_state_unique` (`country`,`state`);

--
-- Indexes for table `country_holidays`
--
ALTER TABLE `country_holidays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_holidays_country_id_foreign` (`country_id`);

--
-- Indexes for table `currencys`
--
ALTER TABLE `currencys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_company_email_unique` (`company_email`);

--
-- Indexes for table `customer_company`
--
ALTER TABLE `customer_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_company_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_company_company_id_foreign` (`company_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milestones`
--
ALTER TABLE `milestones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `milestones_project_id_foreign` (`project_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_customer_id_foreign` (`customer_id`),
  ADD KEY `projects_vendor_id_foreign` (`vendor_id`),
  ADD KEY `projects_project_manager_id_foreign` (`project_manager_id`);

--
-- Indexes for table `project_managers`
--
ALTER TABLE `project_managers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_managers_email_unique` (`email`),
  ADD UNIQUE KEY `project_managers_username_unique` (`username`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resources_email_unique` (`email`),
  ADD UNIQUE KEY `resources_username_unique` (`username`),
  ADD KEY `resources_country_id_foreign` (`country_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_id_foreign` (`project_id`),
  ADD KEY `tasks_milestone_id_foreign` (`milestone_id`);

--
-- Indexes for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timesheets_assigntask_id_foreign` (`assigntask_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- Indexes for table `vendor_company`
--
ALTER TABLE `vendor_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_company_vendor_id_foreign` (`vendor_id`),
  ADD KEY `vendor_company_company_id_foreign` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assigntasks`
--
ALTER TABLE `assigntasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `assignteams`
--
ALTER TABLE `assignteams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `country_holidays`
--
ALTER TABLE `country_holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `currencys`
--
ALTER TABLE `currencys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `customer_company`
--
ALTER TABLE `customer_company`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `milestones`
--
ALTER TABLE `milestones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `project_managers`
--
ALTER TABLE `project_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `timesheets`
--
ALTER TABLE `timesheets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vendor_company`
--
ALTER TABLE `vendor_company`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigntasks`
--
ALTER TABLE `assigntasks`
  ADD CONSTRAINT `assigntasks_consultant_id_foreign` FOREIGN KEY (`consultant_id`) REFERENCES `resources` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `assigntasks_milestone_id_foreign` FOREIGN KEY (`milestone_id`) REFERENCES `milestones` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `assigntasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assigntasks_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assignteams`
--
ALTER TABLE `assignteams`
  ADD CONSTRAINT `assignteams_consultant_id_foreign` FOREIGN KEY (`consultant_id`) REFERENCES `resources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignteams_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `country_holidays`
--
ALTER TABLE `country_holidays`
  ADD CONSTRAINT `country_holidays_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_company`
--
ALTER TABLE `customer_company`
  ADD CONSTRAINT `customer_company_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_company_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `milestones`
--
ALTER TABLE `milestones`
  ADD CONSTRAINT `milestones_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_milestone_id_foreign` FOREIGN KEY (`milestone_id`) REFERENCES `milestones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD CONSTRAINT `timesheets_assigntask_id_foreign` FOREIGN KEY (`assigntask_id`) REFERENCES `assigntasks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendor_company`
--
ALTER TABLE `vendor_company`
  ADD CONSTRAINT `vendor_company_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vendor_company_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
