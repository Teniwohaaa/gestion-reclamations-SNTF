-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 05 juin 2025 à 19:20
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sntf_reclamations`
--

-- --------------------------------------------------------

--
-- Structure de la table `reclamations`
--

CREATE TABLE `reclamations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `piece_jointe` varchar(255) DEFAULT NULL,
  `statut` enum('en_attente','en_cours','traitee','cloturee') DEFAULT 'en_attente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `trip_date` date DEFAULT NULL,
  `train_number` varchar(50) DEFAULT NULL,
  `departure` varchar(100) DEFAULT NULL,
  `arrival` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reclamations`
--

INSERT INTO `reclamations` (`id`, `user_id`, `type`, `description`, `piece_jointe`, `statut`, `created_at`, `updated_at`, `trip_date`, `train_number`, `departure`, `arrival`) VALUES
(5, 10, 'proprete', 'zzzzzzzz', NULL, 'en_attente', '2025-06-05 16:09:45', '2025-06-05 17:12:02', '2622-05-02', '123', 'ddddd', 'dddddd');

-- --------------------------------------------------------

--
-- Structure de la table `reclamation_comments`
--

CREATE TABLE `reclamation_comments` (
  `id` int(11) NOT NULL,
  `reclamation_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `commentaire` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('voyageur','agent','admin') DEFAULT 'voyageur',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin@sntf.dz', 'f865b53623b121fd34ee5426c792e5c33af8c227', NULL, 'admin', '2025-06-04 06:07:01'),
(2, 'Agent', 'agent@sntf.dz', 'abcd42066f55af2adfdfc8c4ba0ad5636fe0af29', NULL, 'agent', '2025-06-04 06:07:01'),
(10, 'zzzzzz zzzzzz', 'zzzz@gmail.com', '$2y$10$5qsnLp16KcFPBjM6MB71eeuQL4YfXy.G6d.us0iSGazS2JyStgcN2', '0799137620', 'voyageur', '2025-06-05 16:09:45');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `reclamations`
--
ALTER TABLE `reclamations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_reclamations_user_id` (`user_id`),
  ADD KEY `idx_reclamations_statut` (`statut`);

--
-- Index pour la table `reclamation_comments`
--
ALTER TABLE `reclamation_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reclamation_id` (`reclamation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `reclamations`
--
ALTER TABLE `reclamations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reclamation_comments`
--
ALTER TABLE `reclamation_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reclamations`
--
ALTER TABLE `reclamations`
  ADD CONSTRAINT `reclamations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reclamation_comments`
--
ALTER TABLE `reclamation_comments`
  ADD CONSTRAINT `reclamation_comments_ibfk_1` FOREIGN KEY (`reclamation_id`) REFERENCES `reclamations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reclamation_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
