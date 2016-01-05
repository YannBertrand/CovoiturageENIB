-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 15 Mai 2013 à 15:59
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `covoiturage`
--

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE IF NOT EXISTS `messagerie` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `sender` varchar(20) CHARACTER SET utf8 NOT NULL,
  `receiver` varchar(20) CHARACTER SET utf8 NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `sending_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `messagerie`
--

INSERT INTO `messagerie` (`id`, `sender`, `receiver`, `title`, `message`, `sending_date`) VALUES
(1, 'antoine', 'Carapuce', 'dgjomfsg', 'gfljimgjfg', '2013-05-10 12:25:18'),
(2, 'antoine', 'Carapuce', 'fglkgj', 'lkfjgfogjfog', '2013-05-10 15:24:48'),
(3, 'antoine', 'Pikachu', 'fghh', 'hghgdfgdf', '2013-05-10 15:24:56'),
(4, 'Pikachu', 'antoine', 'Yop', 'Bien ?', '2013-05-14 19:02:00'),
(5, 'Pikachu', 'Tortank', 'kikooo&amp;é&quot;''é&quot;-è_o', '&amp;é&quot;è', '2013-05-14 19:02:22');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `date`, `title`, `message`) VALUES
(1, '2013-05-10 13:01:31', '1ère news', 'Nous sommes heureux de vous annoncer que notre site de covoiturage est enfin en ligne, exempt de tous bugs ou problèmes (nan, je rigole...). Blabla bla blablabla bla blabla bla blabla bla blabla. jfgkjopgfjq.'),
(2, '2013-05-10 13:03:07', '2ème news', 'foijfdg  fj gofjgfdo gjfogqjmqgfjdfk mj kldqgfjfkldjgfsd kljqfdlkjfdlksjfklb jskjl kj j''écris de trucs qui ne veulent rien dire, ahahahaaha klgfjkglj ggmlfkjdsgfm.fdgkmjl jfjdg jgjfdsktlfmj. Le php c''est nul, il fait jour, j''écoute bornholm en codant, c''est chouette.'),
(3, '2013-05-10 13:06:32', '3ème news', 'foigjg jiogf jgflkgjfdgk gfosdgfjdglkfdjm dflkgjmds gfsj fklfgfd jgfdsml gfjlkfdjifodsjdvlj qlkdsnkfgkvlfjfdlk jsfkfljfdjkg fklvfkfjdkl jofe zoif jklfnvzlnv ozqvodsjg nvczjo oe aoj zljekaz');

-- --------------------------------------------------------

--
-- Structure de la table `passengers`
--

CREATE TABLE IF NOT EXISTS `passengers` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `trip_id` tinyint(4) NOT NULL,
  `pseudo` varchar(30) CHARACTER SET utf8 NOT NULL,
  `origin` varchar(100) CHARACTER SET utf8 NOT NULL,
  `destination` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `passengers`
--

INSERT INTO `passengers` (`id`, `trip_id`, `pseudo`, `origin`, `destination`) VALUES
(1, 1, 'Pikachu', '48.62857109999999, -2.834349800000041', '48.3603502, -4.5656347'),
(2, 1, 'Carapuce', '48.561366, -3.148352', '48.381351, -4.52864'),
(3, 2, 'Tortank', '48.390394, -4.486076', '48.51418, -2.765835'),
(4, 9, 'Pikachu', '48.62857109999999, -2.834349800000041', '48.3603502, -4.565634700000032'),
(5, 10, 'Pikachu', '48.3603502, -4.565634700000032', '48.62857109999999, -2.834349800000041'),
(6, 11, 'Pikachu', '48.3603502, -4.565634700000032', '48.381351, -4.528640099999961'),
(7, 12, 'Pikachu', '48.3603502, -4.565634700000032', '48.62857109999999, -2.834349800000041');

-- --------------------------------------------------------

--
-- Structure de la table `trips`
--

CREATE TABLE IF NOT EXISTS `trips` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `origin` varchar(100) CHARACTER SET utf8 NOT NULL,
  `destination` varchar(100) CHARACTER SET utf8 NOT NULL,
  `driver` varchar(30) CHARACTER SET utf8 NOT NULL,
  `departure` datetime NOT NULL,
  `frequency` set('','daily','weekly','bimonthly','monthly') CHARACTER SET utf8 NOT NULL,
  `car_capacity` tinyint(4) NOT NULL,
  `available_sits` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `trips`
--

INSERT INTO `trips` (`id`, `origin`, `destination`, `driver`, `departure`, `frequency`, `car_capacity`, `available_sits`) VALUES
(1, '48.62857109999999, -2.834349800000041', '48.3603502, -4.5656347', 'Pikachu', '2013-05-07 16:00:00', '', 5, 3),
(2, '48.390394, -4.486076', '48.51418, -2.765835', 'Tortank', '2013-05-08 15:00:00', '', 5, 4),
(6, '48.381351, -4.528640099999961', '48.3603502, -4.565634700000032', 'Pikachu', '2013-05-14 18:11:00', 'weekly', 5, 0),
(7, '48.62857109999999, -2.834349800000041', '48.381351, -4.528640099999961', 'Pikachu', '2013-05-14 18:11:00', '', 5, 0),
(8, '48.62857109999999, -2.834349800000041', '48.3603502, -4.565634700000032', 'Pikachu', '2013-05-14 18:21:00', '', 5, 4),
(9, '48.62857109999999, -2.834349800000041', '48.3603502, -4.565634700000032', 'Pikachu', '2013-05-14 18:21:00', '', 5, 4),
(10, '48.3603502, -4.565634700000032', '48.62857109999999, -2.834349800000041', 'Pikachu', '2013-05-22 19:00:00', '', 5, 4),
(11, '48.3603502, -4.565634700000032', '48.381351, -4.528640099999961', 'Pikachu', '2013-05-22 05:03:00', '', 10, 9),
(12, '48.3603502, -4.565634700000032', '48.62857109999999, -2.834349800000041', 'Pikachu', '2013-05-21 23:53:00', '', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(30) CHARACTER SET utf8 NOT NULL,
  `password` varchar(123) CHARACTER SET utf8 NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `enib_home_adress` varchar(100) CHARACTER SET utf8 NOT NULL,
  `enib_home_hidden_adress` varchar(100) CHARACTER SET utf8 NOT NULL,
  `home_adress` varchar(100) CHARACTER SET utf8 NOT NULL,
  `home_hidden_adress` varchar(100) CHARACTER SET utf8 NOT NULL,
  `inscription_date` datetime NOT NULL,
  `modification_date` datetime NOT NULL,
  `last_activity` datetime NOT NULL,
  `last_ip` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `password`, `firstname`, `lastname`, `email`, `enib_home_adress`, `enib_home_hidden_adress`, `home_adress`, `home_hidden_adress`, `inscription_date`, `modification_date`, `last_activity`, `last_ip`) VALUES
(1, 'Pikachu', '6e43f9d91d6ec11df333bb4a835be16607d01e05', 'Yann', 'Bertrand', 'y0bertra@enib.fr', '27 Rue Anatole France, Brest, France', '48.381351, -4.528640099999961', '6 Rue du Bignot, Ã‰tables-sur-Mer, France', '48.62857109999999, -2.834349800000041', '2013-05-01 23:58:32', '2013-05-14 16:19:45', '2013-05-15 17:54:13', '::1'),
(3, 'Carapuce', '90d72815bd028a15da2835b5c3bb4263f2d7b06f', '', '', 'carapuce@pokemon.com', '', '', '', '', '2013-05-02 15:58:46', '2013-05-02 15:58:46', '2013-05-02 15:59:35', ''),
(5, 'Tortank', 'fd716b9b036e5aa824b94172e06413eae561c60e', '', '', 'tortank@pokemon.com', 'Bourg-en-Bresse, France', '46.20279, 5.219245999999998', 'Bourg-en-Bresse, France', '46.20279, 5.219245999999998', '2013-05-02 16:01:38', '2013-05-03 16:18:02', '2013-05-03 16:23:54', '::1'),
(6, 'RÃ©ptincel', '20f9c912c4357f37b5550270b8c313b37fd87f83', '&lt;b&gt;Coucou&lt;/b&gt;', '', 'reptincel@pokemon.com', '', '', '', '', '2013-05-02 17:39:36', '2013-05-02 17:40:17', '2013-05-02 17:40:47', '::1'),
(8, 'dÃ©dÃ©du22', '1ebb7771cdaa317df2c8fd85bba13bf9abfa8184', 'Delphine', 'Bertrand', 'delphine.bertrand1606@laposte.net', '9 Place du Martray, TrÃ©guier, France', '48.7872236, -3.2302311999999347', '6 Rue du Bignot, Ã‰tables-sur-Mer, France', '48.62857109999999, -2.834349800000041', '2013-05-04 18:24:46', '2013-05-04 18:26:26', '2013-05-04 18:32:24', '::1'),
(9, 'antoine', '68b1776193d6603888cbbe1b6c740aeec284def7', '', '', 'dfglkg@enib.fr', '', '', '', '', '2013-05-10 12:25:06', '2013-05-10 12:25:06', '2013-05-10 15:44:58', '127.0.0.1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
