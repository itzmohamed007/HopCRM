-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- HÃ´te : localhost:8889
-- GÃ©nÃ©rÃ© le : sam. 22 juil. 2023 Ã  17:04
-- Version du serveur : 5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de donnÃ©es : `recrutement`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `cle` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `e_mail` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telephone_fixe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fonction` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- DÃ©chargement des donnÃ©es de la table `contact`
--

INSERT INTO `contact` (`id`, `created_at`, `updated_at`, `deleted_at`, `cle`, `organisation_id`, `e_mail`, `nom`, `prenom`, `telephone_fixe`, `service`, `fonction`) VALUES
(1, '2020-08-08 00:08:19', '2021-02-08 22:37:59', NULL, 'd1b6917849be3cfa7bdbbdb553204e98', 16, 'elodie.bouchet@tele2.fr', 'Bouchet', 'Ã‰lodie', '0733188380', '', 'Feutier'),
(2, '2020-09-06 00:08:19', '2020-12-14 14:55:01', NULL, 'cc60734a0a9f6a454dea3627a0359774', 27, 'arthur.martins@noos.fr', 'Martins', 'Arthur', '+33785246353', '', 'Fantaisiste'),
(3, '2020-11-26 00:08:19', '2021-01-08 15:55:49', NULL, '3feb401ef142f1404235d1625cf606e1', 24, 'martin.marechal@tele2.fr', 'Marechal', 'Martin', '0469306105', '', 'Ramasseur d\'asperges'),
(4, '2020-10-22 00:08:19', '2022-09-01 12:25:04', NULL, '9ac3756c402fa9f0691e7ceae9650d45', 5, 'olivier.jacob@sfr.fr', 'Jacob', 'Olivier', '0752174944', '', 'IngÃ©nieur gÃ©ologue'),
(5, '2020-11-19 00:08:19', '2021-01-21 16:58:57', NULL, 'b66967ad4b00bd1d65c3b19128e8bac8', 17, 'bertrand.masson@orange.fr', 'Masson', 'Bertrand', '+33591765827', '', 'DÃ©lÃ©guÃ© vÃ©tÃ©rinaire'),
(6, '2020-10-22 00:08:19', '2020-11-26 00:08:19', NULL, '6b68c6f7fe7cd261a1965af06381de34', 7, 'xavier.ribeiro@tele2.fr', 'Ribeiro', 'Xavier', '0160944311', '', 'Moniteur de sport'),
(7, '2020-11-15 00:08:19', '2021-01-21 17:01:48', NULL, 'aa009f7ce1c11c8c911cea6a5479a0f6', 13, 'andre.joly@free.fr', 'Joly', 'AndrÃ©', '0637354307', '', 'Monteur-frigoriste'),
(8, '2020-09-26 00:08:19', '2021-02-09 13:41:12', NULL, '24658682eeff6b0526e89ef82f26bff4', 13, 'lucas.georges@wanadoo.fr', 'Georges', 'Lucas', '0808578692', '', 'Chef de scierie'),
(9, '2020-09-01 00:08:19', '2020-11-26 00:08:19', NULL, '44fa684a7363846b3f27835dfa814f29', 24, 'leon.launay@free.fr', 'Launay', 'LÃ©on', '+33678645884', '', 'Animateur d\'Ã©comusÃ©e'),
(10, '2020-08-07 00:08:19', '2020-11-26 00:08:19', NULL, 'a0ef938c1f1855e5bf406ccf2ad4b4fc', 17, 'therese.blanc@orange.fr', 'Blanc', 'ThÃ©rÃ¨se', '+33463554993', '', 'Danseur'),
(11, '2020-11-06 00:08:19', '2020-11-26 00:08:19', NULL, '3621108a9d64167094846936a9934b3f', 14, 'henriette.bailly@noos.fr', 'Bailly', 'Henriette', '+33268901790', '', 'Assistant logistique'),
(12, '2020-08-30 00:08:19', '2020-11-26 00:08:29', NULL, 'd8ee92308b07a0928177e270941c018e', 17, 'anastasie.faivre@sfr.fr', 'Faivre', 'Anastasie', '0118635635', '', 'EmployÃ© d\'accueil'),
(13, '2020-08-20 00:08:19', '2020-11-26 00:08:19', NULL, '1631a2ee4db4e8e3191757345b21135b', 10, 'arthur.guillon@ifrance.com', 'Guillon', 'Arthur', '0511559175', '', 'OpÃ©rateur piquage'),
(14, '2020-08-11 00:08:19', '2020-11-26 00:08:19', NULL, '818220608d0ed675b39ad3d3d1562342', 1, 'david.goncalves@free.fr', 'Goncalves', 'David', '0470917410', '', 'ScÃ©nariste'),
(15, '2020-08-04 00:08:19', '2020-11-26 00:08:19', NULL, '3dc87cad47503f281279f7b23abe8006', 6, 'dominique.briand@orange.fr', 'Briand', 'Dominique', '0324497588', '', 'Recherche'),
(16, '2020-09-06 00:08:19', '2021-02-10 13:24:18', NULL, '2112cc52af37158ade3c4eed10a3c171', 26, 'gregoire.da_costa@tele2.fr', 'Da Costa', 'GrÃ©goire', '+33567015775', '', 'OpÃ©rateur vidÃ©o'),
(17, '2020-08-26 00:08:19', '2020-11-26 00:08:19', NULL, 'f460820087eabca7fd77b14a4195b1c4', 17, 'alexandria.bertrand@wanadoo.fr', 'Bertrand', 'Alexandria', '+33375590442', '', 'Vendeur en Ã©picerie'),
(18, '2020-09-16 00:08:19', '2021-01-21 17:18:05', NULL, '0720363a323fdb4278c78df6ee0df4c2', 4, 'margaux.traore@wanadoo.fr', 'Traore', 'Margaux', '+33803165315', '', 'Agent d\'enquÃªtes'),
(19, '2020-09-07 00:08:19', '2021-01-21 17:25:35', NULL, '464d88cc510be6e789b11b5e1191daf3', 3, 'nathalie.launay@tiscali.fr', 'Launay', 'Nathalie', '+33457387468', '', 'Lexicographe'),
(20, '2020-09-21 00:08:19', '2020-11-26 17:23:21', NULL, '1dc658860c397ca3e506ea3945e91011', 31, 'claire.brunet@bouygtel.fr', 'Brunet', 'Claire', '0791535793', '', 'DÃ©samianteur'),
(21, '2020-08-13 08:43:41', '2021-01-22 11:09:02', NULL, '8e1d55f19ccda6d43e5714fc5325207b', 21, 'dorothee.lacroix@ifrance.com', 'Lacroix', 'DorothÃ©e', '+33183703638', '', 'Testeur informatique'),
(22, '2020-10-12 08:43:41', '2020-11-26 08:43:41', NULL, '9337331e5ea4f1252b60aaa55a2e5603', 11, 'susan.lacroix@sfr.fr', 'Lacroix', 'Susan', '0339487066', '', 'Chasseur-bagagiste'),
(23, '2020-08-06 08:43:41', '2021-01-21 17:42:54', NULL, '063d05985622a3adf245f26bf4167f5a', 21, 'etienne.durand@hotmail.fr', 'Durand', 'Ã‰tienne', '+33753630551', '', 'Galeriste'),
(24, '2020-11-16 08:43:41', '2020-11-26 08:43:41', NULL, 'fb6ec34672bb9767b13d650dda6a5ebb', 10, 'isaac.olivier@sfr.fr', 'Olivier', 'Isaac', '0429318602', '', 'Verrier Ã  la calotte'),
(25, '2020-09-11 08:43:41', '2020-11-26 08:43:41', NULL, '169e88eaf5c238920d1deecf5e82d34e', 19, 'francois.francois@bouygtel.fr', 'Francois', 'FranÃ§ois', '0640650741', '', 'Appareilleur-gazier'),
(26, '2020-10-16 08:43:41', '2021-02-10 16:32:51', NULL, '8a7b7364693b61f8c0f5c6b4dd06e11a', 30, 'emile.ramos@laposte.net', 'Ramos', 'Ã‰mile', '0563008718', '', 'Semencier'),
(27, '2020-10-09 08:43:41', '2021-02-10 16:29:53', NULL, 'ae62b1c4a9796ae86c3205a8e8611563', 30, 'laure@webspirit.fr', 'Leroy', 'Ã‰lÃ©onore', '+33213908679', '', 'Coach sportif'),
(28, '2020-11-17 08:43:41', '2020-11-26 08:43:41', NULL, '3137b159d734ee211a8f2da48f8e74e0', 26, 'claude.brunel@wanadoo.fr', 'Brunel', 'Claude', '+33539203617', '', 'Turbinier'),
(29, '2020-11-21 08:43:41', '2020-11-26 08:43:41', NULL, '14e20f315b63a77cdf29e0b43f53c87c', 7, 'stephanie.raynaud@ifrance.com', 'Raynaud', 'StÃ©phanie', '+33171139273', '', 'Elastiqueur'),
(30, '2020-10-08 08:43:41', '2021-03-24 13:39:11', NULL, 'dafc3c973b6e9d16fc6c4fe22e918118', 21, 'benoit.guillon@ifrance.com', 'Guillon', 'BenoÃ®t', '0892390948', '', 'Miroitier'),
(31, '2020-09-13 08:43:41', '2021-02-10 22:15:06', NULL, '1af2f84bb50b803b9d7ca102c2318335', 22, 'alexandre.pierre@dbmail.com', 'Pierre', 'Alexandre', '0466418680', '', 'Technicien gÃ©omÃ¨tre'),
(32, '2020-10-22 08:43:41', '2020-11-26 08:43:41', NULL, 'ac8554afd54a8b2e5e8aebf96baeb82f', 13, 'bertrand.hamel@bouygtel.fr', 'Hamel', 'Bertrand', '0142928629', '', 'Marbrier-poseur'),
(33, '2020-09-12 08:43:41', '2020-11-26 08:43:41', NULL, '5096b67f5908147cebca974e2420c617', 28, 'benoit.vaillant@tiscali.fr', 'Vaillant', 'BenoÃ®t', '+33290504486', '', 'Technicien bovin'),
(34, '2020-08-28 08:43:41', '2020-11-26 08:43:41', NULL, 'c5c7a599ac6f35e6f80f07edcec3b817', 8, 'penelope.jourdan@live.com', 'Jourdan', 'PÃ©nÃ©lope', '+33919681186', '', 'VidÃ©o-jockey'),
(35, '2020-08-28 08:43:41', '2020-11-26 08:43:41', NULL, 'd4cbf97931205b2dfa73c38004617407', 20, 'marianne.antoine@tiscali.fr', 'Antoine', 'Marianne', '0367388146', '', 'Coutelier d\'art'),
(36, '2020-08-26 08:43:41', '2020-11-26 08:43:41', NULL, '85a505de32257497d53689ad4834b420', 9, 'rene.coulon@yahoo.fr', 'Coulon', 'RenÃ©', '+33807808114', '', 'Lexicographe'),
(37, '2020-08-28 08:43:42', '2021-02-08 15:10:57', NULL, 'c23f6456396e4b7d74d3832eccb74afd', 18, 'antoinette.laroche@live.com', 'Laroche', 'Antoinette', '+33804990426', '', 'Analyste tÃ©lÃ©matique'),
(38, '2020-10-14 08:43:42', '2020-11-26 08:43:42', NULL, 'c65874dd665a3a99d6d9fd920de5389b', 28, 'ines.peltier@sfr.fr', 'Peltier', 'InÃ¨s', '0733044873', '', 'DÃ©floqueur d\'amiante'),
(39, '2020-09-30 08:43:42', '2020-11-26 08:43:42', NULL, '640dfe1e5b8a922414796b4f5a9c84e8', 25, 'juliette.devaux@tiscali.fr', 'Devaux', 'Juliette', '+33897431701', '', 'PÃ©dopsychiatre'),
(40, '2020-10-03 08:43:42', '2021-01-28 15:57:09', NULL, 'bcc9cc70c5f351f4b8cdae4fb2bcf259', 7, 'audrey.charrier@laposte.net', 'Charrier', 'Audrey', '+33485654006', '', 'Ecotoxicologue'),
(72, '2021-02-10 22:17:38', '2021-02-10 22:17:38', NULL, '35d801b01bf3f48b2f4b755c0916d065', 26, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `organisation`
--

CREATE TABLE `organisation` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `cle` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adresse` text NOT NULL,
  `code_postal` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `statut` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `organisation`
--

INSERT INTO `organisation` (`id`, `created_at`, `updated_at`, `deleted_at`, `cle`, `nom`, `adresse`, `code_postal`, `ville`, `statut`) VALUES
(1, '2020-11-26 00:08:19', '2021-02-10 10:09:46', NULL, '850e8f3e0c62d21e31e15ee3fc66e02a', 'Leveque', '84, place de Lesage', '11076', 'Lenoir', 'CLIENT'),
(2, '2020-11-26 00:08:19', '2021-02-10 16:22:34', NULL, '7c59df2040df0cbac1ef2c3232433c23', 'Lemaitre Lefebvre S.A.R.L.', '21, boulevard Claude Dumas', '17915', 'Parent-la-ForÃªt', 'LEAD'),
(3, '2020-11-26 00:08:19', '2022-09-01 12:26:50', NULL, '1bf6aceb34ec5f72fec8f5225349dcc4', 'Gregoire SARL', '428, rue Ferreira', '39450', 'Dumont', 'CLIENT'),
(4, '2020-11-26 00:08:19', '2021-04-02 10:34:58', NULL, 'ce87d538d496114cdb8db4a4033e222c', 'Leroy Gaudin SAS', '55, rue de Becker', '00500', 'Fournier', 'CLIENT'),
(5, '2020-11-26 00:08:19', '2021-04-02 10:34:58', NULL, '9da098e53aa7e10a567fcb227205ea8a', 'Ruiz', '405, avenue Gaillard', '59521', 'Hamon', 'LEAD'),
(6, '2020-11-26 00:08:19', '2021-02-10 16:23:14', NULL, '3bf69025a439bfe3acc62ce7c8da3ec1', 'Leblanc', '937, rue Allain', '48100', 'Fontaine-sur-Ferrand', 'CLIENT'),
(7, '2020-11-26 00:08:19', '2021-02-10 16:03:44', NULL, '530160ff370b3141d318b49dbf6a7d70', 'Evrard et Fils', '1, rue de Fernandez', '45161', 'Poirier', 'CLIENT'),
(8, '2020-11-26 00:08:19', '2021-05-31 13:18:51', NULL, '35b5bfdbc45a8dbd75dc0bb38bdad0d1', 'Didier Allain S.A.R.L.', '636, place Benjamin Guerin', '14217', 'Adamdan', 'LEAD'),
(9, '2020-11-26 00:08:19', '2021-02-10 16:22:22', NULL, '53129dfc9d0dd27a0cb64ea9a925c9fb', 'De Sousa SARL', '73, chemin Ã‰milie Devaux', '62607', 'Garnier-sur-Mer', 'CLIENT'),
(10, '2020-11-26 08:43:41', '2021-02-10 16:21:59', NULL, '71bb9a28ed2d23a6212babd6ab382a5d', 'Baudry Prevost SAS', '326, avenue de Caron', '76170', 'Camus-sur-Gallet', 'LEAD'),
(11, '2020-11-26 08:43:41', '2021-02-10 22:17:38', NULL, '2811f474cf40b78d41621b0ce0c97b4f', 'LÃ©vÃ¨que Sud-Ouest', '96, avenue de Delorme', '11076', 'Camus Ville', 'CLIENT'),
(12, '2020-11-26 08:43:41', '2021-02-10 16:20:50', NULL, '29cebc05bb680d989cbca78294ebbf13', 'Fernandez', '9, rue Jacquet', '46187', 'Vidal', 'PROSPECT'),
(13, '2020-11-26 08:43:41', '2021-02-10 22:17:38', NULL, 'f0f84046be5401c9781432d99b9054e0', 'Hotel Mercure Toulouse St Georges', '8, rue Dominique Marques', '31000', 'Toulouse', 'CLIENT'),
(14, '2020-11-26 08:43:41', '2021-02-10 16:21:47', NULL, '9b7f81db911f7a5a3ec2739076ae8089', 'Chretien', '40, boulevard de Pinto', '37714', 'TurpinBourg', 'LEAD'),
(15, '2020-11-26 08:43:41', '2021-02-10 16:21:33', NULL, '9825e6b9381a6b5d2b5bc28369d26dc5', 'Ollivier Fischer SARL', 'impasse de Lombard', '19739', 'Fischerboeuf', 'LEAD'),
(16, '2020-11-26 08:43:41', '2021-02-10 16:21:19', NULL, '2a4725e20aa0e1c9afa53a2ceac4b749', 'Allard Durand S.A.R.L.', '6, impasse Guillot', '38002', 'Le Gall', 'CLIENT'),
(17, '2020-11-26 08:43:42', '2021-02-10 16:19:12', NULL, 'bffbe22a70facb899791cb57d3b4d342', 'Cohen Hebert S.A.R.L.', '3, chemin Barre', '28400', 'Marchand', 'PROSPECT'),
(18, '2020-11-26 08:43:42', '2021-02-10 16:21:08', NULL, 'fe3586667f6a0f2cec3cbed406140081', 'Gilles S.A.', 'boulevard Maillard', '23910', 'Pineau', 'LEAD'),
(19, '2021-08-03 08:11:07', '2021-08-03 09:32:06', NULL, '9eeaecf732114d2bffa3fd2249e45eb0', 'SARL BOUDOU', '10 RUE DE L ADONIS', '34300', 'AGDE', 'PROSPECT'),
(20, '2021-08-03 08:11:07', '2021-08-03 08:14:48', NULL, 'bac87046d16d7e404e221c3236d64d3e', 'CM-OPTIQUE', 'ROUTE DE SETE', '34300', 'AGDE', 'CLIENT'),
(21, '2021-08-03 08:11:07', '2021-08-03 08:11:07', NULL, 'a252e67342dab01ce22d9804535aeae8', 'SARL MARMOTTE', 'RUE DES NEREIDES', '34300', 'AGDE', 'CLIENT'),
(22, '2021-08-03 08:11:07', '2021-08-03 08:11:07', NULL, '4eb9948c074548afb9e6c974733d1f5e', 'G.F MAINTENANCE', '4 RUE D ORION', '34300', 'AGDE', 'LEAD'),
(23, '2021-08-03 08:11:07', '2021-08-03 08:11:07', NULL, 'e6a784f91bcc45f016c7ceffa04483e3', 'JMB HOLDING', 'ROUTE DE ROCHELONGUE', '34300', 'AGDE', 'PROSPECT'),
(24, '2021-08-03 08:11:07', '2021-08-03 08:11:07', NULL, 'c658df3da933af7dfffb01386f235a10', 'MONVIN', '31 AVENUE GENERAL DE GAULLE', '34300', 'AGDE', 'LEAD'),
(25, '2021-08-03 08:11:07', '2021-08-03 08:11:07', NULL, 'fa52df18e703638e7ded5e7d58d8e0d0', 'L3C', '14 RUE CAPITAINE VAISSEAU ESCANDE', '34300', 'AGDE', 'PROSPECT'),
(26, '2021-08-03 08:11:07', '2021-08-03 08:11:07', NULL, 'e938e411f729c404079e1d3731988b82', 'MOM THERON', '33 AVENUE DE LA BUTTE', '34300', 'AGDE', 'CLIENT'),
(27, '2021-08-03 08:11:07', '2021-08-03 08:11:07', NULL, '075bacd88b0b06001f3b5ea04b064d5c', 'L\'ARBRE A TIROIRS', 'LESTRADE', '12520', 'AGUESSAC', 'PROSPECT'),
(28, '2021-08-03 08:11:07', '2021-08-03 08:11:07', NULL, '474ad67bd56473fb26ce4bc704091c8b', 'MATCAM', 'PLACE ANATOLE FRANCE', '30220', 'AIGUES MORTES', 'CLIENT'),
(29, '2021-08-03 08:11:07', '2021-08-03 08:11:07', NULL, '2bc3ffcc65e9f50c4269837e82806da2', 'STELO', '271 AVENUE DES ARTISANS', '30220', 'AIGUES MORTES', 'CLIENT'),
(30, '2021-08-03 08:11:07', '2021-08-03 08:11:07', NULL, 'fb048c10c3c6b3ec555bdb1890c1c636', 'E.A.T. ENTREPRISE AIMARGUOISE DE TERRASSEMENT', '8 CHEMIN DE L ABRIVADO', '30470', 'AIMARGUES', 'CLIENT'),
(31, '2021-08-03 08:11:07', '2021-08-03 08:11:07', NULL, '13a421f8517379d10db4cdd19fa729f9', 'SARL JOUETTE', '125 RUE ANDRE MALRAUX', '30100', 'ALES', 'PROSPECT'),
(32, '2021-08-03 08:11:07', '2021-08-03 08:11:07', NULL, 'f713ab4d886839308ed6064b1d23c159', 'SASHOIL', '603 CHEMIN DE CHAUDEBOIS', '30100', 'ALES', 'PROSPECT');

--
-- Index pour les tables dÃ©chargÃ©es
--

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_cle_unique` (`cle`),
  ADD KEY `contact_e_mail_index` (`e_mail`),
  ADD KEY `deleted_at` (`deleted_at`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- Index pour la table `organisation`
--
ALTER TABLE `organisation`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `nom` (`nom`);

--
-- AUTO_INCREMENT pour les tables dÃ©chargÃ©es
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pour la table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;