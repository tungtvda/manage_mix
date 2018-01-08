-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 09 Février 2017 à 10:29
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `manage_mix`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `TenDangNhap` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MatKhau` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`Id`, `TenDangNhap`, `Full_name`, `MatKhau`) VALUES
(2, 'tungtv', 'Trần Văn Tùng', '1ef26373d3c9447baae66eabd52b1e0e9dc1b702c2f51d5322a67f1c42cf6f3ef0d513d04624c3bfee41b848cac59f4e6c29bf915d10c820c6c883bee00d3afb');

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `mr` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` int(11) NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `director_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobi` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skype` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_group` int(11) NOT NULL,
  `resources_to` int(11) NOT NULL,
  `chuc_vu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phong_ban` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nganh_nghe` int(11) NOT NULL,
  `account_number_bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `open_bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date NOT NULL,
  `cmnd` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_range_cmnd` date NOT NULL,
  `issued_by_cmnd` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_passport` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_range_passport` date NOT NULL,
  `issued_by_passport` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiration_date_passport` date NOT NULL,
  `gender` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `note` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `customer_career`
--

CREATE TABLE `customer_career` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `customer_category`
--

CREATE TABLE `customer_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `customer_resources_to`
--

CREATE TABLE `customer_resources_to` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `customer_visa`
--

CREATE TABLE `customer_visa` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_visa_card` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` int(11) NOT NULL,
  `date_range` date NOT NULL,
  `expiration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permison_action`
--

CREATE TABLE `permison_action` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `permison_action`
--

INSERT INTO `permison_action` (`id`, `name`, `module_id`, `form_id`, `status`, `position`, `note`) VALUES
(1, 'Thêm', 3, 2, 1, 2, 'Thêm nhân viên'),
(2, 'Sửa', 3, 2, 1, 2, 'Sửa thông tin nhân viên'),
(3, 'Xóa', 3, 2, 1, 3, 'Xóa nhân viên'),
(4, 'Phân quyền', 3, 2, 1, 4, 'Phần quyền nhân viên'),
(5, 'Danh sách nhân viên', 3, 2, 1, 1, 'Danh sách nhân viên'),
(6, 'Xem', 5, 1, 1, 1, 'Xem trang chủ'),
(7, 'Danh sách chức vụ nhân viên', 3, 4, 1, 1, 'Danh sách chức vụ nhân viên'),
(8, 'Thêm', 3, 4, 1, 2, 'Thêm chức vụ nhân viên'),
(9, 'Sửa', 3, 4, 1, 3, 'Sửa chức vụ nhân viên'),
(10, 'Xóa', 3, 4, 1, 4, 'Xóa chức vụ nhân viên'),
(11, 'Danh sách phòng ban', 3, 3, 1, 1, 'Danh sách phòng ban'),
(12, 'Thêm', 3, 3, 1, 2, 'Thêm phòng ban nhân viên'),
(13, 'Sửa', 3, 3, 1, 3, 'Sửa phòng ban nhân viên'),
(14, 'Xóa', 3, 3, 1, 4, 'Xóa phòng ban nhân viên');

-- --------------------------------------------------------

--
-- Structure de la table `permison_form`
--

CREATE TABLE `permison_form` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_count` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dk_count` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `permison_form`
--

INSERT INTO `permison_form` (`id`, `module_id`, `name`, `url`, `action_count`, `dk_count`, `active`, `status`, `position`) VALUES
(1, 1, 'Chọn danh mục cấp 2', NULL, NULL, NULL, NULL, 0, 0),
(2, 3, 'Quản lý nhân viên', 'nhan-vien/', 'user_count', 'status=1', 'user_list', 1, 1),
(3, 3, 'Quản lý phòng ban', 'phong-ban/', 'user_phongban_count', '', '', 1, 2),
(4, 3, 'Chức vụ', 'chu-vu/', 'user_chucvu_count', '', 'chuc_vu_user', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `permison_module`
--

CREATE TABLE `permison_module` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_count` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dk_count` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `permison_module`
--

INSERT INTO `permison_module` (`id`, `name`, `icon`, `url`, `action_count`, `dk_count`, `active`, `status`, `position`) VALUES
(1, 'Chọn danh mục cấp 1', NULL, NULL, NULL, NULL, NULL, 0, 0),
(2, 'Khách hàng', '', 'khach-hang/', '', NULL, 'khach_hang', 1, 1),
(3, 'Nhân viên', 'fa-users', 'nhan-vien/', '', NULL, 'user', 1, 2),
(4, 'Phản hồi khách hàng', 'fa-weixin', 'phan-hoi-khach-hang/', '', NULL, 'phan_hoi', 1, 3),
(5, ' Dashboard', 'fa-tachometer', '', NULL, NULL, 'trangchu', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_role` int(11) NOT NULL,
  `permison_module` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permison_form` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permison_action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mr` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobi` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_two_steps` tinyint(1) NOT NULL,
  `code_login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phong_ban` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chuc_vu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nganh_nghe` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guides` tinyint(1) NOT NULL,
  `guide_card_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cmnd` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_range_cmnd` date NOT NULL,
  `issued_by_cmnd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_passport` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_range_passport` date NOT NULL,
  `issued_by_passport` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiration_date_passport` date NOT NULL,
  `dan_toc` int(11) NOT NULL,
  `ho_khau_tt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hon_nhan` int(11) NOT NULL,
  `bang_cap` int(11) NOT NULL,
  `language` int(11) NOT NULL,
  `account_number_bank` int(11) NOT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `open_bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `religion` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `token_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_token` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `name`, `user_role`, `permison_module`, `permison_form`, `permison_action`, `mr`, `address`, `phone`, `mobi`, `user_name`, `user_code`, `user_email`, `password`, `login_two_steps`, `code_login`, `phong_ban`, `chuc_vu`, `nganh_nghe`, `gender`, `birthday`, `avatar`, `guides`, `guide_card_number`, `tax_code`, `cmnd`, `date_range_cmnd`, `issued_by_cmnd`, `number_passport`, `date_range_passport`, `issued_by_passport`, `expiration_date_passport`, `dan_toc`, `ho_khau_tt`, `hon_nhan`, `bang_cap`, `language`, `account_number_bank`, `bank`, `open_bank`, `religion`, `note`, `status`, `created`, `token_code`, `time_token`, `updated`, `created_by`, `updated_by`) VALUES
(1, 'Trần Văn Tùng', 1, '5,3,3,3,3,3,3,3,3,3', '2,2,2,2,2,4,4,4,4', '6,4,3,2,1,5,10,9,8,7', 'Mr', 'Đông Anh, Hà Nội', '', '', 'tungtv', 'mix_002', 'tungtv.soict@gmail.com', '7f95556b24cce073d158beea396fa3b0c27d8c3737ffccca605d96a4aef90134edcaa30b833afb8c04d819aceb3d703a270258fca3f4905c7f0fe3af307c3af7', 0, 'fc0kWjtZQcTtNQQ', '', '', 0, 0, '0000-00-00', '/view/default/themes/uploads/tungtvsoictgmailcom/avatar.jpg', 0, '', '', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '', 0, 0, 0, 0, '', '', 0, '', 1, '2016-11-26 09:05:49', '', '2017-02-09 16:25:24', '0000-00-00 00:00:00', 0, NULL),
(12, 'Trần Thanh Tuyền', 1, '5,3,3,3,3,3,3,3,3,3,3,3,3,3', '2,2,2,2,2,3,3,3,3,4,4,4,4', '6,5,1,2,3,4,11,12,13,14,7,8,9,10', 'Mrs', 'Đông Anh, Hà Nội', '0123456789', '', 'tuyentt', 'mix_001', 'tuyenit.sp2@gmail.com', '7f95556b24cce073d158beea396fa3b0c27d8c3737ffccca605d96a4aef90134edcaa30b833afb8c04d819aceb3d703a270258fca3f4905c7f0fe3af307c3af7', 0, '', '', '', 0, 0, '1994-12-21', '/view/default/themes/uploads/tuyenitsp2gmailcom/1486626864.jpg', 0, '', '', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '', 0, 0, 0, 0, '', '', 0, '', 1, '2017-02-09 14:54:23', '', '2017-02-09 14:55:51', '2017-02-09 14:54:23', 1, ''),
(13, 'Nguyên Văn Nam', 1, '5,3,3,3,3,3,3,3,3,3,3,3,3,3', '2,2,2,2,2,3,3,3,3,4,4,4,4', '6,5,1,2,3,4,11,12,13,14,7,8,9,10', 'Mr', 'hà noi', '123456789', '', 'namnv', 'mix_003', 'nam.soictda@gmail.com', '7f95556b24cce073d158beea396fa3b0c27d8c3737ffccca605d96a4aef90134edcaa30b833afb8c04d819aceb3d703a270258fca3f4905c7f0fe3af307c3af7', 0, '', '', '', 0, 0, '1990-02-16', '/view/default/themes/uploads/namsoictdagmailcom/1486629912.jpg', 0, '', '', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '', 0, 0, 0, 0, '', '', 0, '', 1, '2017-02-09 15:45:12', '', '2017-02-09 16:14:39', '2017-02-09 15:45:12', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `user_chucvu`
--

CREATE TABLE `user_chucvu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user_chucvu`
--

INSERT INTO `user_chucvu` (`id`, `name`, `position`, `description`) VALUES
(1, 'Tổng giám đốc', 1, NULL),
(2, 'Giám đốc điều hành', 2, NULL),
(3, 'Phó giám đốc', 3, NULL),
(4, 'Trưởng phòng', 4, NULL),
(5, 'Phó phòng', 5, NULL),
(6, 'Nhân viên', 6, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_phongban`
--

CREATE TABLE `user_phongban` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user_phongban`
--

INSERT INTO `user_phongban` (`id`, `name`, `position`, `description`) VALUES
(1, 'BGD', 1, 'Ban giám đốc'),
(2, 'Hành chính - Nhân sự', 2, 'Hành chính - Nhân sự'),
(3, 'Marketing', 3, 'Marketing'),
(4, 'Outbound', 4, 'Outbound'),
(5, 'Nội địa', 5, 'Nội địa'),
(6, 'Kinh doanh', 6, 'Kinh doanh'),
(7, 'Inbound', 7, 'Inbound'),
(8, 'Kế toán', 8, 'Kế toán');

-- --------------------------------------------------------

--
-- Structure de la table `user_visa`
--

CREATE TABLE `user_visa` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_visa_card` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` int(11) NOT NULL,
  `date_range` date NOT NULL,
  `expiration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Index pour la table `customer_career`
--
ALTER TABLE `customer_career`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customer_category`
--
ALTER TABLE `customer_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customer_resources_to`
--
ALTER TABLE `customer_resources_to`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customer_visa`
--
ALTER TABLE `customer_visa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_visa_id_foreign` (`customer_id`);

--
-- Index pour la table `permison_action`
--
ALTER TABLE `permison_action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `form_id` (`form_id`);

--
-- Index pour la table `permison_form`
--
ALTER TABLE `permison_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Index pour la table `permison_module`
--
ALTER TABLE `permison_module`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_chucvu`
--
ALTER TABLE `user_chucvu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_phongban`
--
ALTER TABLE `user_phongban`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_visa`
--
ALTER TABLE `user_visa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_visa_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `customer_career`
--
ALTER TABLE `customer_career`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `customer_category`
--
ALTER TABLE `customer_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `customer_resources_to`
--
ALTER TABLE `customer_resources_to`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `customer_visa`
--
ALTER TABLE `customer_visa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `permison_action`
--
ALTER TABLE `permison_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `permison_form`
--
ALTER TABLE `permison_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `permison_module`
--
ALTER TABLE `permison_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `user_chucvu`
--
ALTER TABLE `user_chucvu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `user_phongban`
--
ALTER TABLE `user_phongban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `user_visa`
--
ALTER TABLE `user_visa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `customer_visa`
--
ALTER TABLE `customer_visa`
  ADD CONSTRAINT `customer_visa_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `permison_action`
--
ALTER TABLE `permison_action`
  ADD CONSTRAINT `permison_action_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `permison_module` (`id`),
  ADD CONSTRAINT `permison_action_ibfk_2` FOREIGN KEY (`form_id`) REFERENCES `permison_form` (`id`);

--
-- Contraintes pour la table `permison_form`
--
ALTER TABLE `permison_form`
  ADD CONSTRAINT `permison_form_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `permison_module` (`id`);

--
-- Contraintes pour la table `user_visa`
--
ALTER TABLE `user_visa`
  ADD CONSTRAINT `user_visa_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
