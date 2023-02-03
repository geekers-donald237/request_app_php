-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 22 jan. 2023 à 14:59
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ict201`
--

-- --------------------------------------------------------

--
-- Structure de la table `corbeille`
--

CREATE TABLE `corbeille` (
  `id` int(11) NOT NULL,
  `idRequeteC` int(11) NOT NULL,
  `objetC` varchar(256) NOT NULL,
  `LibelleC` varchar(256) NOT NULL,
  `ValiderC` tinyint(4) NOT NULL,
  `RemarqueC` varchar(256) NOT NULL,
  `MatriculeC` varchar(256) NOT NULL,
  `CodeueC` varchar(256) NOT NULL,
  `idEnseignantC` int(11) NOT NULL,
  `DateRequeteC` timestamp NULL DEFAULT NULL,
  `DateSup` timestamp NULL DEFAULT current_timestamp(),
  `DateReponseC` timestamp NULL DEFAULT NULL,
  `PiecesJointesC` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `corbeille`
--

INSERT INTO `corbeille` (`id`, `idRequeteC`, `objetC`, `LibelleC`, `ValiderC`, `RemarqueC`, `MatriculeC`, `CodeueC`, `idEnseignantC`, `DateRequeteC`, `DateSup`, `DateReponseC`, `PiecesJointesC`) VALUES
(2, 3, 'probleme de matricule', 'Monsieur (ou Madame),\r\n\r\nJ&#039;ai l&#039;honneur de venir très respectueusement auprès de votre haute bienveillance solliciter ...(à completer)\r\n\r\nEn effet, je suis étudiant(e) en dd, ...(à completer)\r\n\r\nDans l&#039;attente d&#039;une suite favorable, veu', 1, ' ', '20q2024', 'ICT201', 9, '2023-01-17 09:37:42', '2023-01-17 09:39:19', '2023-01-17 09:37:56', 'Et3-Intro.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `idEnseignant` int(11) NOT NULL,
  `NomEnseignant` varchar(225) NOT NULL,
  `AdresseEmail` varchar(50) NOT NULL,
  `MdpEnseignant` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`idEnseignant`, `NomEnseignant`, `AdresseEmail`, `MdpEnseignant`) VALUES
(1, 'Nzekon Armel', 'ArmelZekon@facsciences-uy1.cm', 'armelnzekon'),
(2, 'Messi Nguelle Thomas', 'thomasmessi@facsciences-uy1.cm', 'thomasmessi'),
(3, 'Tchio Corneille', 'corneilletchio@facsciences-uy1.cm', 'corneilletchio'),
(4, 'Mbang Joseph', 'josephmbang@facsciences-uy1.cm', 'josephmbang'),
(5, 'Nguefack Bertrand', 'bertrandnguefack@facsciences-uy1.cm', 'bertrandnguefack'),
(6, 'Tamo', 'tamo@facsciences-uy1.cm', 'tamo'),
(7, 'Musima', 'musima@facsciences-uy1.cm', 'musima'),
(8, 'Biyong', 'biyong@facsciences-uy1.cm', 'biyong'),
(9, 'Moyou', 'moyou@facsciences-uy1.cm', 'moyou'),
(10, 'Sevany Sandjo', 'sandjosevany@facsciences-uy1.cm', 'sandjosevany'),
(11, 'Cactcha David', 'davidcactcha@facsciences-uy1.cm', 'davidcactcha'),
(12, 'Monthe Valery', 'valerymonthe@facsciences-uy1.cm', 'valerymonthe'),
(13, 'Nkondock Bahanag', 'bahanagnkondock@facsciences-uy1.cm', 'bahanagnkondock'),
(14, 'Videme Olivier', 'oliviervideme@facsciences-uy1.cm', 'oliviervideme'),
(15, 'Nkouandou Aboubacar', 'aboubacarnkouandou@facsciences-uy1.cm', 'aboubacarnkouandou'),
(16, 'Kehbuma', 'kehbuma@facsciences-uy1.cm', 'kehbuma'),
(17, 'Aminou Alidou', 'alidouaminou@facsciences-uy1.cm', 'alidouaminou'),
(18, 'Njine', 'njine@facsciences-uy1.cm', 'njine'),
(19, 'Kutche Justin', 'justinkutche@facsciences-uy1.cm', 'justinkutche'),
(20, 'Tapamo', 'tapamo@facsciences-uy1.cm', 'tapamo');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `Matricule` char(7) NOT NULL,
  `NomEtudiant` varchar(225) NOT NULL,
  `PrenomEtudiant` varchar(225) NOT NULL,
  `MdpEtudiant` varchar(30) NOT NULL,
  `AdresseEmailEtudiant` varchar(30) NOT NULL,
  `Idniveau` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`Matricule`, `NomEtudiant`, `PrenomEtudiant`, `MdpEtudiant`, `AdresseEmailEtudiant`, `Idniveau`) VALUES
('20q2024', 'albamn', 'happi', '1234', 'alban@gmail.com', 2),
('20q2915', 'tientcheu', 'emmanuel', 'emma', 'tientcheu@gmail.com', 3),
('20u2222', 'yasser', 'arafat', 'arafat', 'arafat@gmail.com', 1),
('21Q2915', 'Mba Nandjou', 'Sophia', '2004', 'mbasophia@fac-sciences.cm', 2);

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `idFiliere` int(11) NOT NULL,
  `NomFiliere` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`idFiliere`, `NomFiliere`) VALUES
(1, 'ICT4D');

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `idNiveau` int(11) NOT NULL,
  `NomNiveau` varchar(20) NOT NULL,
  `idFiliere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`idNiveau`, `NomNiveau`, `idFiliere`) VALUES
(1, 'L1', 1),
(2, 'L2', 1),
(3, 'L3', 1);

-- --------------------------------------------------------

--
-- Structure de la table `requete`
--

CREATE TABLE `requete` (
  `idRequete` int(11) NOT NULL,
  `objet` varchar(256) NOT NULL,
  `Libelle` varchar(1024) NOT NULL,
  `Valider` tinyint(1) NOT NULL,
  `Remarque` varchar(225) NOT NULL,
  `Matricule` char(7) NOT NULL,
  `Codeue` varchar(11) NOT NULL,
  `IdEnseignant` int(11) NOT NULL,
  `Daterequete` timestamp NOT NULL DEFAULT current_timestamp(),
  `DateReponse` timestamp NOT NULL DEFAULT current_timestamp(),
  `PiecesJointes` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `requete`
--

INSERT INTO `requete` (`idRequete`, `objet`, `Libelle`, `Valider`, `Remarque`, `Matricule`, `Codeue`, `IdEnseignant`, `Daterequete`, `DateReponse`, `PiecesJointes`) VALUES
(1, 'absence de notes', 'Monsieur (ou Madame),\r\n\r\nJ&#039;ai l&#039;honneur de venir très respectueusement auprès de votre haute bienveillance solliciter ...(à completer)\r\n\r\nEn effet, je suis étudiant(e) en dd, ...(à completer)\r\n\r\nDans l&#039;attente d&#039;une suite favorable, veu', 1, ' ', '21Q2915', 'ICT201', 9, '2023-01-17 08:31:02', '2023-01-17 08:33:11', 'Et3-Intro.pdf'),
(2, 'absence de notes', 'Monsieur (ou Madame),\r\n\r\nJ&#039;ai l&#039;honneur de venir très respectueusement auprès de votre haute bienveillance solliciter ...(à completer)\r\n\r\nEn effet, je suis étudiant(e) en dd, ...(à completer)\r\n\r\nDans l&#039;attente d&#039;une suite favorable, veuillez agréer Monsieur, mes expressions les plus chaleureuses !', 1, ' ', '20q2024', 'ICT201', 9, '2023-01-17 09:32:57', '2023-01-17 09:34:02', 'Et3-Intro.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `ue`
--

CREATE TABLE `ue` (
  `CodeUE` varchar(11) NOT NULL,
  `LibelleUE` varchar(225) NOT NULL,
  `idEnseignant` int(11) NOT NULL,
  `idNiveau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ue`
--

INSERT INTO `ue` (`CodeUE`, `LibelleUE`, `idEnseignant`, `idNiveau`) VALUES
('ENG203', 'Anglais', 7, 2),
('ENG303', 'Anglais', 16, 3),
('FRAN203', 'Français', 8, 2),
('FRAN303', 'Français', 8, 3),
('ICT101', 'introduction to SI', 1, 1),
('ICT103', 'Introduction to C programming', 2, 1),
('ICT105', 'Algorithmique', 3, 1),
('ICT107', 'algerbre mathematiques', 5, 1),
('ICT109', ' maths logique', 4, 1),
('ICT111', 'Data Coding', 6, 1),
('ICT201', 'Introduction au Génie Logiciel', 9, 2),
('ICT203', 'Database Systems', 10, 2),
('ICT205', 'Introduction to .Net Programming', 11, 2),
('ICT207', 'Java Programming', 12, 2),
('ICT213', 'Securité et Management du Risque Informatique', 13, 2),
('ICT215', 'Résaux informatique', 14, 2),
('ICT217', 'Génie Logiciel', 15, 2),
('ICT301', 'Software architecture and designs', 12, 3),
('ICT303', 'Data communication', 17, 3),
('ICT305', 'WEB Application development', 18, 3),
('ICT307', 'Computer systems', 20, 3),
('ICT313', 'Cyber and internet security', 9, 3),
('ICT315', 'Network application development', 19, 3),
('ICT317', 'Information System', 10, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `corbeille`
--
ALTER TABLE `corbeille`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`idEnseignant`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`Matricule`),
  ADD KEY `Idniveau` (`Idniveau`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`idFiliere`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`idNiveau`),
  ADD KEY `idFiliere` (`idFiliere`);

--
-- Index pour la table `requete`
--
ALTER TABLE `requete`
  ADD PRIMARY KEY (`idRequete`),
  ADD KEY `Matricule` (`Matricule`),
  ADD KEY `Codeue` (`Codeue`),
  ADD KEY `IdEnseignat` (`IdEnseignant`);

--
-- Index pour la table `ue`
--
ALTER TABLE `ue`
  ADD PRIMARY KEY (`CodeUE`),
  ADD KEY `Idniveau` (`idNiveau`),
  ADD KEY `idEnseignant` (`idEnseignant`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `corbeille`
--
ALTER TABLE `corbeille`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `idEnseignant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `idFiliere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `requete`
--
ALTER TABLE `requete`
  MODIFY `idRequete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`Idniveau`) REFERENCES `niveau` (`idNiveau`);

--
-- Contraintes pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD CONSTRAINT `niveau_ibfk_1` FOREIGN KEY (`idFiliere`) REFERENCES `filiere` (`idFiliere`);

--
-- Contraintes pour la table `requete`
--
ALTER TABLE `requete`
  ADD CONSTRAINT `requete_ibfk_1` FOREIGN KEY (`Matricule`) REFERENCES `etudiant` (`Matricule`),
  ADD CONSTRAINT `requete_ibfk_2` FOREIGN KEY (`Codeue`) REFERENCES `ue` (`CodeUE`),
  ADD CONSTRAINT `requete_ibfk_3` FOREIGN KEY (`IdEnseignant`) REFERENCES `enseignant` (`idEnseignant`);

--
-- Contraintes pour la table `ue`
--
ALTER TABLE `ue`
  ADD CONSTRAINT `ue_ibfk_1` FOREIGN KEY (`idNiveau`) REFERENCES `niveau` (`idNiveau`),
  ADD CONSTRAINT `ue_ibfk_2` FOREIGN KEY (`idEnseignant`) REFERENCES `enseignant` (`idEnseignant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
