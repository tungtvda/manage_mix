-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 25 Novembre 2016 à 10:49
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

-- --------------------------------------------------------

--
-- Structure de la table `permison_form`
--

CREATE TABLE `permison_form` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `permison_form`
--

INSERT INTO `permison_form` (`id`, `module_id`, `name`, `url`, `status`, `position`) VALUES
(1, 1, 'Chọn danh mục cấp 2', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `permison_module`
--

CREATE TABLE `permison_module` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `permison_module`
--

INSERT INTO `permison_module` (`id`, `name`, `url`, `status`, `position`) VALUES
(1, 'Chọn danh mục cấp 1', NULL, 0, 0),
(2, 'Khách hàng', NULL, 1, 1),
(3, 'Nhân viên', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `permison_module` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permison_form` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permison_action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mr` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobi` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_token` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_chucvu`
--

CREATE TABLE `user_chucvu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_phongban`
--

CREATE TABLE `user_phongban` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `permison_form`
--
ALTER TABLE `permison_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `permison_module`
--
ALTER TABLE `permison_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user_chucvu`
--
ALTER TABLE `user_chucvu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user_phongban`
--
ALTER TABLE `user_phongban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
