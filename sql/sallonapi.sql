-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 27, 2018 at 06:46 PM
-- Server version: 10.2.3-MariaDB-log
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sallonapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
('572827c0-a615-11e8-b522-e7213d5e49c8', 'Parler Item', 'all kind of parler ltem.', '2018-08-22 14:12:02', '2018-08-22 19:24:39', '2018-08-22 19:24:39'),
('551d23c0-a619-11e8-8c20-7f1921ec829a', 'ppppp', 'test ppppp ppppppppppppppppppppppp', '2018-08-22 14:40:36', '2018-08-22 18:47:01', NULL),
('28674f10-a63e-11e8-996d-2bce1c234973', 'Parler Item1111', 'all kind of parler ltem11.', '2018-08-22 19:04:13', '2018-08-22 19:04:13', NULL),
('93f023c0-a642-11e8-9721-93b9c7020c30', 'Parler Item11111111', 'all kind of parler ltem11.11111', '2018-08-22 19:35:51', '2018-08-22 19:35:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE `category_post` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_post`
--

INSERT INTO `category_post` (`id`, `category_id`, `post_id`, `created_at`, `updated_at`) VALUES
('', '551d23c0-a619-11e8-8c20-7f1921ec829a', 'e1ff0fc0-a7ba-11e8-ad22-e1607eec476b', NULL, NULL),
('', '551d23c0-a619-11e8-8c20-7f1921ec829a', 'b7f9bf60-a7c7-11e8-9a9d-4b217373d54c', NULL, NULL),
('', '551d23c0-a619-11e8-8c20-7f1921ec829a', 'b7f9bf60-a7c7-11e8-9a9d-4b217373d54c', NULL, NULL),
('', '551d23c0-a619-11e8-8c20-7f1921ec829a', '04a86dc0-aa29-11e8-a8a8-8db9ba5126c2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(6, '2018_08_08_202458_create_table_users', 1),
(7, '2018_08_09_113240_create_posts_table', 1),
(8, '2018_08_22_054948_create_categories_table', 2),
(10, '2018_08_22_194258_create_category_post_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('08ffe891bc2b740ec1e1d260927a029aa7e528283add65dd226a475cf550c8a0a361691d4801d5fc', 8, 2, NULL, '[]', 1, '2018-08-22 14:00:32', '2018-08-22 14:00:32', '2019-08-22 14:00:32'),
('1c46224091f023ce02d51ced37cd6d1b157b586ba85381d8120665856f06189a2f59f08cf827ebdd', 8, 2, NULL, '[]', 1, '2018-08-22 05:13:33', '2018-08-22 05:13:33', '2019-08-22 05:13:33'),
('2c353681404a613712c4f31ff82dcbb50ff2571fea42b7dad6733a2545a392987adcb742977c700f', 8, 2, NULL, '[]', 1, '2018-08-22 05:13:59', '2018-08-22 05:13:59', '2019-08-22 05:13:59'),
('4fbf46527e4d5e7bc1b93ef45dbf472eb99ab26a91cc79246a51d94148b1da3f17fe6c09a7bd47f5', 8, 2, NULL, '[]', 1, '2018-08-24 07:00:28', '2018-08-24 07:00:28', '2019-08-24 07:00:28'),
('60391da0674ab8f1002db6cd08caad4e54e330e9400c2da3d790fd79bbe3cdf876c3ec45c9946691', 8, 2, NULL, '[]', 1, '2018-08-22 05:14:47', '2018-08-22 05:14:47', '2019-08-22 05:14:47'),
('64c1692a3b05995510972c8d386deaa9d25ed73a2f56ff75c299c1222a4aebb812f9f328f2b2abc9', 8, 2, NULL, '[]', 1, '2018-08-22 19:31:50', '2018-08-22 19:31:50', '2019-08-22 19:31:50'),
('823262b5cdb37a239c73ba08f5f5d7519f8aeaa75184942355f4fd0885631feed8dc8b82281709fe', 8, 2, NULL, '[]', 1, '2018-08-24 06:28:19', '2018-08-24 06:28:19', '2019-08-24 06:28:19'),
('8827f9ed8c6455418bab503edebb058c3c4bfa5f21330f78f839c4f8b9f0218f8551ea8758baff46', 8, 2, NULL, '[]', 0, '2018-08-27 18:36:00', '2018-08-27 18:36:00', '2019-08-27 18:36:00'),
('9b904ffbc8e7f734dbf94546a54724c100f9dded7aa66827b3bf0e5005a6b1cd8cba995552b25b72', 8, 2, NULL, '[]', 1, '2018-08-22 18:44:27', '2018-08-22 18:44:27', '2019-08-22 18:44:27'),
('a18370a0a079257d05047dca09dc24a94c8975383c24608c1e3b691fdd65613289187ab5494deee4', 8, 2, NULL, '[]', 1, '2018-08-25 19:14:58', '2018-08-25 19:14:58', '2019-08-25 19:14:58'),
('ccbc48b9dc8b42075e6ac5992c14dd539a220ffd6a42c68d8692e7f6ee00cc293e9294cd5757368a', 8, 2, NULL, '[]', 1, '2018-08-21 21:32:13', '2018-08-21 21:32:13', '2019-08-21 21:32:13'),
('cd5914f6afeb4daa0c214112e2b45d8363c96fd365145eb98d25c2ed4321d4d2e9bc9adf5321ce10', 8, 2, NULL, '[]', 1, '2018-08-24 16:08:17', '2018-08-24 16:08:17', '2019-08-24 16:08:17'),
('d1a7690036f76c0f01df08e3c2e5bac5e5b1967ef4d6e2e54d30df384981ab7b71827c1b7a7f920b', 8, 2, NULL, '[]', 1, '2018-08-22 20:23:57', '2018-08-22 20:23:57', '2019-08-22 20:23:57'),
('dfa6231bbf62b6f4921c6b84f1e48ec76cc2f536b7b063bd7660341edab4ed46ef49fcbba6f0f310', 8, 2, NULL, '[]', 1, '2018-08-21 21:31:10', '2018-08-21 21:31:10', '2019-08-21 21:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, 'a6d85a60-a584-11e8-bf00-17d4456e67a9', 'tapos', 'CqrDOT1RZUJJZwDk5n2J1qZRX6iBL8nt5VZey5mm', 'http://:/auth/callback', 0, 0, 0, '2018-08-21 20:57:09', '2018-08-21 20:57:09'),
(2, NULL, 'sanjib', 'ervexbDYA5m32TtsmI1b7HqU4A5TUPItmiaxEN5h', 'http://localhost', 0, 1, 0, '2018-08-21 20:59:24', '2018-08-21 20:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('0da65f9f1d08851ef59d6bc8c4764912938a78220020b26abd8fa60b0b3d612f575e45dbb3708491', '9b904ffbc8e7f734dbf94546a54724c100f9dded7aa66827b3bf0e5005a6b1cd8cba995552b25b72', 0, '2019-08-22 18:44:27'),
('1c271cd7e7552005e5713f726661fc10087ab53ede79c5a9d8413583f5bef1553fc4b23a98979d86', '08ffe891bc2b740ec1e1d260927a029aa7e528283add65dd226a475cf550c8a0a361691d4801d5fc', 0, '2019-08-22 14:00:32'),
('38d8f440da9cee040b5690729f507f586f5bc978d9d31967ee9ffb0f81982abd60b6d3b95c39935e', '8827f9ed8c6455418bab503edebb058c3c4bfa5f21330f78f839c4f8b9f0218f8551ea8758baff46', 0, '2019-08-27 18:36:01'),
('43749f4c755a38c15f1d8205c6af5232783abd9459a2b3d98e4dd6e596da970fdf92c04cd3ab8eb1', '823262b5cdb37a239c73ba08f5f5d7519f8aeaa75184942355f4fd0885631feed8dc8b82281709fe', 0, '2019-08-24 06:28:19'),
('4f02b6e06421214bc5b3ec5702c148b1b8f8c5406bd75b153688bf9ff1245ac0375f02316d801d00', 'cd5914f6afeb4daa0c214112e2b45d8363c96fd365145eb98d25c2ed4321d4d2e9bc9adf5321ce10', 0, '2019-08-24 16:08:17'),
('53142b617809b907e1e313115cc8e8032d061a565a49ac0129eb58cc4125e6d3a0e2fd130774676a', '2c353681404a613712c4f31ff82dcbb50ff2571fea42b7dad6733a2545a392987adcb742977c700f', 0, '2019-08-22 05:13:59'),
('6a258550da42f71499b058fe7030636b23967c28aeae78ad0ccf8220f70a663247762ff11627d316', '4fbf46527e4d5e7bc1b93ef45dbf472eb99ab26a91cc79246a51d94148b1da3f17fe6c09a7bd47f5', 0, '2019-08-24 07:00:28'),
('8acf3fb70fc6b63865bf9f1063f2e0b73600caa6d75987e04b56919fbd733909eebea4cfe4b869db', 'ccbc48b9dc8b42075e6ac5992c14dd539a220ffd6a42c68d8692e7f6ee00cc293e9294cd5757368a', 0, '2019-08-21 21:32:13'),
('8bca503b2c17de7bac745e507be38e99548e538aee0e4675b1c1c6391e9e590f355083b51ebaf69f', 'a18370a0a079257d05047dca09dc24a94c8975383c24608c1e3b691fdd65613289187ab5494deee4', 0, '2019-08-25 19:14:59'),
('9dddf6bf8a9a8aeb756b6cfba1749b81545ff7aa928eb0220779f49309873818a5196477d2ce5ef0', '1c46224091f023ce02d51ced37cd6d1b157b586ba85381d8120665856f06189a2f59f08cf827ebdd', 0, '2019-08-22 05:13:34'),
('b0c8c7c293d61f8ce885c60a9e4fb94f25c663d8793c2988b0fbdd82328640b5a89080e35fa03d4b', '64c1692a3b05995510972c8d386deaa9d25ed73a2f56ff75c299c1222a4aebb812f9f328f2b2abc9', 0, '2019-08-22 19:31:50'),
('b567afbd28975effdcaf6159b5522fc9b7681c64f0644b2f496bb1cef77cf7e30b23f255665fc2d2', 'd1a7690036f76c0f01df08e3c2e5bac5e5b1967ef4d6e2e54d30df384981ab7b71827c1b7a7f920b', 0, '2019-08-22 20:23:57'),
('cff593eb16fde03877531a762330756d55b0c1d305bf08ecdbe6de8dce94ccefb9f1dfbcd3d69bbb', 'dfa6231bbf62b6f4921c6b84f1e48ec76cc2f536b7b063bd7660341edab4ed46ef49fcbba6f0f310', 0, '2019-08-21 21:31:10'),
('dff034754186209d284e362282b93cfcf484e388be10927f2f876705c42e149a82370f56de42bf3e', '60391da0674ab8f1002db6cd08caad4e54e330e9400c2da3d790fd79bbe3cdf876c3ec45c9946691', 0, '2019-08-22 05:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `cover_image`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('e1ff0fc0-a7ba-11e8-ad22-e1607eec476b', 'test ', 'This is test post for your app', NULL, '8af110b0-a584-11e8-8cb1-1dda8293a939', '2018-08-24 16:29:33', '2018-08-24 16:29:33', NULL),
('b7f9bf60-a7c7-11e8-9a9d-4b217373d54c', 'test ', 'This is test post for your app', NULL, '8af110b0-a584-11e8-8cb1-1dda8293a939', '2018-08-24 18:01:26', '2018-08-24 18:01:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'false',
  `device_token` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_thumb` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone_no`, `remember_token`, `verified`, `verification_token`, `admin`, `device_token`, `image_thumb`, `created_at`, `updated_at`, `deleted_at`) VALUES
('fb279790-a76a-11e8-87f0-adae6e45d022', 'abcd', 'abcd@r-cis.com', '$2y$10$czBYU8RL9s8qh4K0qxuZgOSA9BPxL6gif4LgXXK.Evv6nSb3YdgUm', '+880184408012', NULL, '0', 'zyZpOGaLARJCfn90vJFmMtCJCRttKB5OWOL6Q6O4', 'false', NULL, NULL, '2018-08-24 06:57:35', '2018-08-24 06:57:35', NULL),
('8af110b0-a584-11e8-8cb1-1dda8293a939', 'sanjib', 'sanjib@r-cis.com', '$2y$10$Oug/XbGq5Ql31PkZ/gKbO.bE/6hm13N4lfIcOfvpUHEZgdrBq2IPy', '+8801844080126', NULL, '1', NULL, 'false', NULL, NULL, '2018-08-21 20:55:32', '2018-08-21 21:17:31', NULL),
('3e675670-a586-11e8-95fc-237da6d2c92e', 'pinku', 'tapo111@r-cis.com', '$2y$10$j8rlEpFgIbU9Cy.g1tudCOg4deqA5x3L9l/w.WD1FytQdhyP8zj4K', '+880184408011', NULL, '0', 'bNBELoOeoWzqjFU9VwPmrifxLOi8D1k0pFIgxZ30', 'false', NULL, NULL, '2018-08-21 21:07:42', '2018-08-21 21:07:42', NULL),
('a6d85a60-a584-11e8-bf00-17d4456e67a9', 'tapos', 'tapos@r-cis.com', '$2y$10$RN6EQIU5deC0.jKfXRKEP.gp3xgpfwX95Rdb1pVhzJpE5e7s5jmsO', '+8801844080121', NULL, '0', 'lgp0CXmaiJ9F8Z6OhQYEcIiOD82KoWPAwFWNUeF2', 'false', NULL, NULL, '2018-08-21 20:56:18', '2018-08-21 20:56:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
