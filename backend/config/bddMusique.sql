-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 13 Novembre 2015 à 15:28
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bddMusique`
--

-- --------------------------------------------------------

--
-- Structure de la table `Admin`
--

CREATE TABLE `Admin` (
  `idAdmin` int(11) NOT NULL,
  `nameAdmin` varchar(45) DEFAULT NULL,
  `passwordAdmin` varchar(45) DEFAULT NULL,
  `emailAdmin` varchar(45) DEFAULT NULL,
  `registerDate` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Album`
--

CREATE TABLE `Album` (
  `idAlbum` int(11) NOT NULL,
  `nameAlbum` varchar(45) DEFAULT NULL,
  `publicationDate` varchar(45) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Artist`
--

CREATE TABLE `Artist` (
  `idArtist` int(11) NOT NULL,
  `artistName` varchar(45) NOT NULL,
  `startDate` date DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `numberOfAlbums` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `FriendsList`
--

CREATE TABLE `FriendsList` (
  `idUser` int(11) NOT NULL,
  `friendlyDate` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `LikeSong`
--

CREATE TABLE `LikeSong` (
  `idLikeSong` int(11) NOT NULL,
  `idUser` varchar(45) DEFAULT NULL,
  `idSong` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `PlayList`
--

CREATE TABLE `PlayList` (
  `idplaylist` int(11) NOT NULL,
  `nameplaylist` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `PlayListUser`
--

CREATE TABLE `PlayListUser` (
  `idPlayListUser` int(11) NOT NULL,
  `namePlayList` varchar(45) DEFAULT NULL,
  `Visisbility_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `PlayListUser_has_Song`
--

CREATE TABLE `PlayListUser_has_Song` (
  `PlayListUser_idPlayListUser` int(11) NOT NULL,
  `Song_idSong` int(11) NOT NULL,
  `Song_PlayList_idplaylist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Song`
--

CREATE TABLE `Song` (
  `idSong` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `kind` varchar(45) NOT NULL,
  `duration` varchar(45) DEFAULT NULL,
  `format` varchar(45) DEFAULT NULL,
  `PlayList_idplaylist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Song_has_Album`
--

CREATE TABLE `Song_has_Album` (
  `Song_idSong` int(11) NOT NULL,
  `Album_idAlbum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Song_has_Artist`
--

CREATE TABLE `Song_has_Artist` (
  `Song_idSong` int(11) NOT NULL,
  `Artist_idArtist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `idUser` int(11) NOT NULL,
  `nameUser` varchar(45) DEFAULT NULL,
  `passwordUser` varchar(45) DEFAULT NULL,
  `emailUser` varchar(45) DEFAULT NULL,
  `registerDate` varchar(45) DEFAULT NULL,
  `avatar` varchar(45) DEFAULT NULL,
  `FriendsList_idUser` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`idUser`, `nameUser`, `passwordUser`, `emailUser`, `registerDate`, `avatar`, `FriendsList_idUser`) VALUES
(1, 'david', 'pppp', 'eagledav90@yahoo.fr', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Visibility`
--

CREATE TABLE `Visibility` (
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Index pour la table `Album`
--
ALTER TABLE `Album`
  ADD PRIMARY KEY (`idAlbum`);

--
-- Index pour la table `Artist`
--
ALTER TABLE `Artist`
  ADD PRIMARY KEY (`idArtist`);

--
-- Index pour la table `FriendsList`
--
ALTER TABLE `FriendsList`
  ADD PRIMARY KEY (`idUser`);

--
-- Index pour la table `LikeSong`
--
ALTER TABLE `LikeSong`
  ADD PRIMARY KEY (`idLikeSong`);

--
-- Index pour la table `PlayList`
--
ALTER TABLE `PlayList`
  ADD PRIMARY KEY (`idplaylist`);

--
-- Index pour la table `PlayListUser`
--
ALTER TABLE `PlayListUser`
  ADD PRIMARY KEY (`idPlayListUser`,`Visisbility_level`),
  ADD KEY `fk_PlayListUser_Visisbility1_idx` (`Visisbility_level`);

--
-- Index pour la table `PlayListUser_has_Song`
--
ALTER TABLE `PlayListUser_has_Song`
  ADD PRIMARY KEY (`PlayListUser_idPlayListUser`,`Song_idSong`,`Song_PlayList_idplaylist`),
  ADD KEY `fk_PlayListUser_has_Song_Song1_idx` (`Song_idSong`,`Song_PlayList_idplaylist`),
  ADD KEY `fk_PlayListUser_has_Song_PlayListUser1_idx` (`PlayListUser_idPlayListUser`);

--
-- Index pour la table `Song`
--
ALTER TABLE `Song`
  ADD PRIMARY KEY (`idSong`,`PlayList_idplaylist`),
  ADD KEY `fk_Song_PlayList1_idx` (`PlayList_idplaylist`);

--
-- Index pour la table `Song_has_Album`
--
ALTER TABLE `Song_has_Album`
  ADD PRIMARY KEY (`Song_idSong`,`Album_idAlbum`),
  ADD KEY `fk_Song_has_Album_Album1_idx` (`Album_idAlbum`),
  ADD KEY `fk_Song_has_Album_Song1_idx` (`Song_idSong`);

--
-- Index pour la table `Song_has_Artist`
--
ALTER TABLE `Song_has_Artist`
  ADD PRIMARY KEY (`Song_idSong`,`Artist_idArtist`),
  ADD KEY `fk_Song_has_Artist_Artist1_idx` (`Artist_idArtist`),
  ADD KEY `fk_Song_has_Artist_Song_idx` (`Song_idSong`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`idUser`,`FriendsList_idUser`),
  ADD KEY `fk_User_FriendsList1_idx` (`FriendsList_idUser`);

--
-- Index pour la table `Visibility`
--
ALTER TABLE `Visibility`
  ADD PRIMARY KEY (`level`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Album`
--
ALTER TABLE `Album`
  MODIFY `idAlbum` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Artist`
--
ALTER TABLE `Artist`
  MODIFY `idArtist` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `FriendsList`
--
ALTER TABLE `FriendsList`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `LikeSong`
--
ALTER TABLE `LikeSong`
  MODIFY `idLikeSong` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `PlayList`
--
ALTER TABLE `PlayList`
  MODIFY `idplaylist` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `PlayListUser`
--
ALTER TABLE `PlayListUser`
  MODIFY `idPlayListUser` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Song`
--
ALTER TABLE `Song`
  MODIFY `idSong` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
