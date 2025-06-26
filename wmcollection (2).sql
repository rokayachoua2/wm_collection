-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306:127.0.0.1:3306
-- Généré le : jeu. 26 juin 2025 à 10:04
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
-- Base de données : `wmcollection`
--

-- --------------------------------------------------------

--
-- Structure de la table `cmd_entrer`
--

CREATE TABLE `cmd_entrer` (
  `id` int(11) NOT NULL,
  `date_entrer` timestamp NOT NULL DEFAULT current_timestamp(),
  `commentaire` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_commande` timestamp NOT NULL DEFAULT current_timestamp(),
  `statut` enum('en attente','en cours','livrée') DEFAULT 'en attente',
  `adresse_livraison` text DEFAULT NULL,
  `stat` enum('En attente','En cours','Expédiée','Livrée','Annulée') DEFAULT 'En attente',
  `paiement` enum('Non payé','Payé') DEFAULT 'Non payé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `user_id`, `date_commande`, `statut`, `adresse_livraison`, `stat`, `paiement`) VALUES
(1, 4, '2025-06-21 23:14:08', 'en attente', 'nador ', 'Livrée', 'Payé'),
(2, 4, '2025-06-24 10:33:08', 'en attente', 'cc', 'Livrée', 'Payé'),
(3, 4, '2025-06-24 13:53:32', 'en attente', 'basdah', 'Livrée', 'Payé'),
(4, 4, '2025-06-25 10:31:34', 'en attente', 'fggg', 'Livrée', 'Payé'),
(5, 1, '2025-06-25 21:18:36', 'en attente', 'ssss', 'Livrée', 'Payé'),
(6, 1, '2025-06-25 23:04:39', 'en attente', 'kenitra', 'Livrée', 'Payé');

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `taille_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `details_commande`
--

INSERT INTO `details_commande` (`id`, `commande_id`, `produit_id`, `quantite`, `prix`, `taille_id`) VALUES
(1, 1, 2, 1, 349.99, 2),
(2, 2, 1, 1, 129.99, 1),
(3, 2, 3, 1, 799.99, 1),
(4, 3, 1, 3, 129.99, 2),
(5, 3, 2, 1, 349.99, 2),
(6, 4, 1, 2, 129.99, 2),
(7, 4, 2, 3, 349.99, 3),
(8, 5, 1, 1, 129.99, 1),
(9, 6, 3, 1, 799.99, 1);

-- --------------------------------------------------------

--
-- Structure de la table `detail_entrer`
--

CREATE TABLE `detail_entrer` (
  `id` int(11) NOT NULL,
  `cmd_entrer_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_produit` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `id_produits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `prix` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id`, `id_user`, `prix`) VALUES
(1, 4, 349.99),
(2, 4, 929.98),
(3, 4, 739.96),
(4, 4, 1309.95),
(5, 1, 129.99),
(6, 1, 799.99);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_ajout` timestamp NOT NULL DEFAULT current_timestamp(),
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `image`, `date_ajout`, `stock`) VALUES
(1, 'T-shirt Blanc', 'T-shirt en coton blanc classique.\r\ntres bon qualite', 129.99, 'image10.jpeg', '2025-06-17 21:53:56', 50),
(2, 'Jean Slim', 'Jean slim bleu pour homme.', 349.99, 'image4.jpeg', '2025-06-17 21:53:56', 40),
(3, 'Veste en Cuir', 'Veste en cuir noir élégante.', 799.99, 'image3.jpeg', '2025-06-17 21:53:56', 20),
(4, 'prd1', 'lopsumbdchj hjechje evbchje ehebrhj ', 100.00, 'image1.jpeg', '2025-06-24 10:19:17', 10),
(5, 'prd2', 'lopsumbdchj hjechje evbchje ehebrhj lopsumbdchj hjechje evbchje ehebrhj lopsumbdchj hjechje evbchje ehebrhj ', 300.00, 'image2.jpeg', '2025-06-24 10:20:24', 20),
(6, 'prd3', 'lopsumbdchj hjechje evbchje ehebrhj lopsumbdchj hjechje evbchje ehebrhj lopsumbdchj hjechje evbchje ehebrhj ', 150.00, 'image3.jpeg', '2025-06-24 10:20:24', 15),
(7, 'prd4', 'lopsumbdchj hjechje evbchje ehebrhj lopsumbdchj hjechje evbchje ehebrhj lopsumbdchj hjechje evbchje ehebrhj ', 200.00, 'image4.jpeg', '2025-06-24 10:21:24', 9),
(8, 'prd5', 'lopsumbdchj hjechje evbchje ehebrhj lopsumbdchj hjechje evbchje ehebrhj lopsumbdchj hjechje evbchje ehebrhj ', 300.00, 'image5.jpeg', '2025-06-24 10:21:24', 25),
(9, 'prd6', 'ehcvhjeqbq hjfbqzu r3fvzu dhugzu ehcvhjeqbq hjfbqzu r3fvzu dhugzu ehcvhjeqbq hjfbqzu r3fvzu dhugzu ', 200.00, 'image6.jpeg', '2025-06-24 10:25:02', 30),
(10, 'prd7', 'ehcvhjeqbq hjfbqzu r3fvzu dhugzu ehcvhjeqbq hjfbqzu r3fvzu dhugzu ehcvhjeqbq hjfbqzu r3fvzu dhugzu ', 100.00, 'image7.jpeg', '2025-06-24 10:28:45', 15),
(12, 'prd8', 'ehcvhjeqbq hjfbqzu r3fvzu dhugzu ehcvhjeqbq hjfbqzu r3fvzu dhugzu ', 250.00, 'image8.jpeg', '2025-06-24 10:29:38', 14),
(13, 'prd9', 'ehcvhjeqbq hjfbqzu r3fvzu dhugzu ehcvhjeqbq hjfbqzu r3fvzu dhugzu ', 300.00, 'image9.jpeg', '2025-06-24 10:29:38', 11),
(16, 'hvhg', 'gchgh', 123.00, '685c8123eb694_img1.jpg', '2025-06-25 23:07:15', 23),
(17, 'T-shirt Blanc', 'bon qualite', 300.00, '685ceb939a174_image3.jpeg', '2025-06-26 06:41:23', 13);

-- --------------------------------------------------------

--
-- Structure de la table `produit_taille`
--

CREATE TABLE `produit_taille` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `taille_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit_taille`
--

INSERT INTO `produit_taille` (`id`, `produit_id`, `taille_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 2),
(5, 2, 3),
(6, 3, 1),
(7, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `tailles`
--

CREATE TABLE `tailles` (
  `id` int(11) NOT NULL,
  `nom` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tailles`
--

INSERT INTO `tailles` (`id`, `nom`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 's'),
(5, 'l');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adresse` text DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `role` enum('client','admin') DEFAULT 'client',
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `credit_client` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `email`, `password`, `adresse`, `telephone`, `role`, `date_creation`, `credit_client`) VALUES
(1, 'romayssae', 'romayssae@gmail.com', '1234', 'NADOR', '0645425037', 'client', '2025-06-18 15:46:05', 0.00),
(4, 'Admin Master', 'admin@gmail.com', '$2y$10$1./3mDa/N2FikEEFz.kBCOThDWEjRolgFdxXCmvK18a2XgUCEnw6C', 'Admin City', '0600000000', 'admin', '2025-06-18 20:55:18', 0.00),
(5, 'waei', 'waeil@gmail.com', '$2y$10$bfieg4v.zMGM6fymTEyq0uueyilEC6E8SUOs5Mp1FwWb4amMv9P8K', 'NADOR', '0645425037', 'client', '2025-06-18 21:33:56', 0.00),
(6, 'sanae belkhir', 'sanae@gmail.com', '$2y$10$Wq.Nw0rjJ8BmUHQiK32cfeoLFCrpZQHPL3i/uwX8ykXGE2oorOA9C', 'SAIDIA', '0645425037', 'client', '2025-06-21 22:15:26', 0.00),
(7, 'rokaya', 'rokaya@gmail.com', '1234', 'nador', '0754654321', 'admin', '2025-06-24 09:59:52', 0.00),
(8, 'rokaya', 'rokayaqueen16@gmail.com', '$2y$10$PiFjqpYH1BUn27BnxMv2TOO6CvMAV8dT/IN9PyfCDwJBOECuz2gVO', 'AIT AISSA NADOR', '0695372457', 'client', '2025-06-25 21:14:52', 0.00),
(9, 'ikrame', 'ikrame@gmail.com', '1234', 'kenitra', '0754654321', 'admin', '2025-06-25 22:05:48', 0.00);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cmd_entrer`
--
ALTER TABLE `cmd_entrer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commande_id` (`commande_id`),
  ADD KEY `produit_id` (`produit_id`),
  ADD KEY `taille_id` (`taille_id`);

--
-- Index pour la table `detail_entrer`
--
ALTER TABLE `detail_entrer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmd_entrer_id` (`cmd_entrer_id`),
  ADD KEY `produit_id` (`produit_id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit_taille`
--
ALTER TABLE `produit_taille`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produit_id` (`produit_id`),
  ADD KEY `taille_id` (`taille_id`);

--
-- Index pour la table `tailles`
--
ALTER TABLE `tailles`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT pour la table `cmd_entrer`
--
ALTER TABLE `cmd_entrer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `detail_entrer`
--
ALTER TABLE `detail_entrer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `produit_taille`
--
ALTER TABLE `produit_taille`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `tailles`
--
ALTER TABLE `tailles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD CONSTRAINT `details_commande_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`),
  ADD CONSTRAINT `details_commande_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`),
  ADD CONSTRAINT `details_commande_ibfk_3` FOREIGN KEY (`taille_id`) REFERENCES `tailles` (`id`);

--
-- Contraintes pour la table `detail_entrer`
--
ALTER TABLE `detail_entrer`
  ADD CONSTRAINT `detail_entrer_ibfk_1` FOREIGN KEY (`cmd_entrer_id`) REFERENCES `cmd_entrer` (`id`),
  ADD CONSTRAINT `detail_entrer_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `produit_taille`
--
ALTER TABLE `produit_taille`
  ADD CONSTRAINT `produit_taille_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`),
  ADD CONSTRAINT `produit_taille_ibfk_2` FOREIGN KEY (`taille_id`) REFERENCES `tailles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
