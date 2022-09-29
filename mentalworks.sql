-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 09 Août 2022 à 09:52
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mentalworks`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `host_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id`, `email`, `phone_number`, `host_id`, `customer_id`) VALUES
(1, 'dyson@contact.fr', '344853614', 1, 1),
(2, 'ca@contact.fr', '344812514', 2, 2),
(3, 'citroen@contact.fr', '344813614', 3, 3),
(4, 'philips@contact.fr', '344818414', 4, 4),
(5, 'orpi@contact.fr', '344812314', 5, 5),
(6, 'saint-gobain@contact.fr', '344851354', 6, 6),
(7, 'pmu@contact.fr', '344100814', 7, 7),
(8, 'pocalin@contact.fr', '344817314', 8, 8),
(9, 'cofidis@contact.fr', '344853614', 9, 9),
(10, 'ipsec@contact.fr', '344853452', 10, 10);

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `customer`
--

INSERT INTO `customer` (`id`, `code`, `name`) VALUES
(1, 'CLIENT_1', 'DYSON'),
(2, 'CLIENT_2', 'CrÃ©dit Agricole'),
(3, 'CLIENT_3', 'CITROÃ‹N'),
(4, 'CLIENT_4', 'PHILIPS'),
(5, 'CLIENT_5', 'ORPI'),
(6, 'CLIENT_6', 'SAINT-GOBAIN'),
(7, 'CLIENT_7', 'PMU'),
(8, 'CLIENT_8', 'POCLAIN HYDRAULICS'),
(9, 'CLIENT_9', 'COFIDIS'),
(10, 'CLIENT_10', 'IPSEC');

-- --------------------------------------------------------

--
-- Structure de la table `environment`
--

CREATE TABLE `environment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `ssh_port` int(6) NOT NULL,
  `ssh_username` varchar(255) NOT NULL,
  `phpmyadmin_link` varchar(255) NOT NULL,
  `ip_restriction` tinyint(1) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `environment`
--

INSERT INTO `environment` (`id`, `name`, `link`, `ip_address`, `ssh_port`, `ssh_username`, `phpmyadmin_link`, `ip_restriction`, `project_id`) VALUES
(1, 'test1', 'test1', '172.04.04.04', 22, 'sshtest1', 'link1', 0, 1),
(2, 'test2', 'test2', '172.04.04.04', 22, 'sshtest2', 'link2', 0, 2),
(3, 'test3', 'test3', '172.04.04.04', 22, 'sshtest3', 'link3', 0, 3),
(4, 'test4', 'test4', '172.04.04.04', 22, 'sshtest4', 'link4', 0, 4),
(5, 'test5', 'test5', '172.04.04.04', 22, 'sshtest5', 'link5', 0, 5),
(6, 'test6', 'test6', '172.04.04.04', 22, 'sshtest6', 'link6', 0, 6),
(7, 'test7', 'test7', '172.04.04.04', 22, 'sshtest7', 'link7', 0, 7),
(8, 'test8', 'test8', '172.04.04.04', 22, 'sshtest8', 'link8', 0, 8),
(9, 'test9', 'test9', '172.04.04.04', 22, 'sshtest9', 'link9', 0, 9),
(10, 'test10', 'test10', '172.04.04.04', 22, 'sshtest10', 'link10', 0, 10);

-- --------------------------------------------------------

--
-- Structure de la table `host`
--

CREATE TABLE `host` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `host`
--

INSERT INTO `host` (`id`, `code`, `name`) VALUES
(1, 'HEBERGEUR_1', 'IONOS'),
(2, 'HEBERGEUR_2', 'HOSTINGER'),
(3, 'HEBERGEUR_3', 'GODADDY'),
(4, 'HEBERGEUR_4', 'HOSTGATOR'),
(5, 'HEBERGEUR_5', 'NETWORK SOLUTIONS'),
(6, 'HEBERGEUR_6', 'A2 HOSTING'),
(7, 'HEBERGEUR_7', 'INMOTION'),
(8, 'HEBERGEUR_8', 'WEBHOSTINGPAD'),
(9, 'HEBERGEUR_9', '007HEBERGEMENT'),
(10, 'HEBERGEUR_10', 'PLANETHOSTER');

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `lastpass_folder` varchar(255) NOT NULL,
  `link_mock_ups` varchar(255) NOT NULL,
  `managed_server` tinyint(1) NOT NULL,
  `notes` text NOT NULL,
  `host_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `project`
--

INSERT INTO `project` (`id`, `name`, `code`, `lastpass_folder`, `link_mock_ups`, `managed_server`, `notes`, `host_id`, `customer_id`) VALUES
(1, 'dyson-project', 'PROJECT_1', 'test1', 'test1', 1, 'test1', 1, 1),
(2, 'CA-project', 'PROCJECT_2', 'test2', 'test2', 1, 'test2', 2, 2),
(3, 'citroen-project', 'PROCJECT_3', 'test3', 'test3', 0, 'test3', 3, 3),
(4, 'philips-project', 'PROCJECT_4', 'test4', 'test4', 0, 'test4', 4, 4),
(5, 'orpi-project', 'PROCJECT_5', 'test5', 'test5', 1, 'test5', 5, 5),
(6, 'SG-project', 'PROCJECT_6', 'test6', 'test6', 1, 'test6', 6, 6),
(7, 'PMU-project', 'PROCJECT_7', 'test7', 'test7', 0, 'test7', 7, 7),
(8, 'poclain-project', 'PROCJECT_8', 'test8', 'test8', 1, 'test8', 8, 8),
(9, 'cofidis-project', 'PROCJECT_9', 'test9', 'test9', 1, 'test9', 9, 9),
(10, 'ipsec-project', 'PROCJECT_10', 'test10', 'test10', 1, 'test10', 10, 10);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `host_id` (`host_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `environment`
--
ALTER TABLE `environment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Index pour la table `host`
--
ALTER TABLE `host`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `host_id` (`host_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `environment`
--
ALTER TABLE `environment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `host`
--
ALTER TABLE `host`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `contact_ibfk_2` FOREIGN KEY (`host_id`) REFERENCES `host` (`id`);

--
-- Contraintes pour la table `environment`
--
ALTER TABLE `environment`
  ADD CONSTRAINT `environment_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Contraintes pour la table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`host_id`) REFERENCES `host` (`id`),
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
