-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2021 at 12:21 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evesc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(14) NOT NULL,
  `role` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `email`, `password`, `telephone`, `role`) VALUES
(1, 'ABBASSI', 'Youssef', 'admin@admin.com', 'admin', '0670434988', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `commentaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `event_id`, `nom`, `commentaire`) VALUES
(1, 18, 'Youssef', 'Très bon evenement, je recommande vivement!'),
(2, 19, 'ABBASSI', 'Très bon commentaire!'),
(3, 27, 'salam', 'seminaire'),
(4, 27, 'salam', 'seminaire'),
(5, 27, 'smi', 'alalal'),
(6, 18, 'a', 'a'),
(7, 18, 's', 's'),
(8, 18, 's', 's'),
(9, 18, 's', 's'),
(10, 20, 'ABBASSI YOUSSEF', 'J\'aime trop cet evenement'),
(11, 24, 'Youssef', 'Quoi de mieux qu\'une TBOURIDA est à OUJDA!!!');

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evenement`
--

INSERT INTO `evenement` (`id`, `user_id`, `titre`, `type`, `ville`, `date`, `photo`, `description`, `approved`) VALUES
(18, 8, 'TBOURIDA - EDITION 13', 'Scientifique', 'CASABLANCA', '2021-04-08 03:50:00', 'TBOURIDA8.jpg', 'La Tbourida, dérivée de Baroud qui signifie « poudre à canon », est un art équestre ancien, datant du 15ème siècle. Elle est la reconstitution d’un assaut militaire de guerriers cavaliers arabes et berbères.\r\n\r\nDe génération en génération, la Tbourida conserve une forte dimension spirituelle, notamment du fait qu’elle met le cheval , animal sacré de l’islam, au centre d’un spectacle haletant et impressionnant.\r\n\r\nLa Tbourida éblouit le grand public marocain et international. Elle est associée aux festivités : moussems, fêtes agricoles et nombreuses fêtes nationales et familiales. Les internationaux la dénomment souvent « Fantasia », appellation d’origine latine, signifiant divertissement.\r\nRetrouvez l\'édition 13 de la TBOURIDA à Oujda et vivez la meilleure expérience!', 1),
(19, 8, 'PAINTBALL', 'Scientifique', 'Casablanca', '2021-04-06 02:46:00', 'Paintball8.jpg', 'aw', 0),
(20, 8, 'MERZOUGA DESERT - EDITION 4 ', 'Culturelle', 'MERZOUGA', '2021-04-06 05:43:00', 'MERZOUGA8.jpg', 'Merzouga est un petit village saharien situé dans le sud-est du Maroc, à 35 kilomètres de Moulay Ali Cherif, à 50 kilomètres de Erfoud, et à 50 kilomètres de la frontière algérienne, à 562 km de Marrakech, à 602 km de Rabat (capitale nationale), à 667 km de Casablanca, et à 669 km d\'Agadir (côte Atlantique).\r\nVenez vivre une expérience inédite !', 1),
(22, 8, 'PORTE OUVERTE UNIVERSITAIRE', 'Culturelle', 'QARTAJ', '2021-04-06 05:47:00', 'PORTE OUVERTE UNIVERSITAIRE8.png', 'dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dinsdo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! dindo is goood! ', 0),
(24, 8, 'TBOURIDA', 'Scientifique', 'Oujda', '2021-04-05 12:16:00', 'lot8.jpg', 'La Tbourida, dérivée de Baroud qui signifie « poudre à canon », est un art équestre ancien, datant du 15ème siècle. Elle est la reconstitution d’un assaut militaire de guerriers cavaliers arabes et berbères.\r\n\r\nDe génération en génération, la Tbourida conserve une forte dimension spirituelle, notamment du fait qu’elle met le cheval , animal sacré de l’islam, au centre d’un spectacle haletant et impressionnant.\r\n\r\nLa Tbourida éblouit le grand public marocain et international. Elle est associée aux festivités : moussems, fêtes agricoles et nombreuses fêtes nationales et familiales. Les internationaux la dénomment souvent « Fantasia », appellation d’origine latine, signifiant divertissement.\r\nRetrouvez l\'édition 13 de la TBOURIDA à Oujda et vivez la meilleure expérience!', 1),
(25, 8, 'AW', 'Scientifique', 'Oujda', '2021-04-07 04:16:00', 'aw8.jpg', 'aw', 0),
(27, 8, 'SEMAINAIRE', 'Culturelle', 'OUJDA', '2021-04-13 05:56:00', 'SEMAINAIRE8.png', 'SSS', 0),
(28, 8, 'GNAOUA', 'Culturelle', 'Agadir', '2021-04-21 06:57:00', 'gnbaoui8.jpg', 'Le Gnaoua (sing. Gnaoui, transcrit aussi sous l\'orthographe Gnaua, Gnawa, Guenaua, etc.), désigne à la fois un style musical du Maroc et les membres d\'origine d\'Afrique subsaharienne, principalement des descendants d\'esclaves, rassemblés dans des confréries musulmanes mystiques dans lesquelles la transe joue un rôle très important.\r\nVenez au festival d\'agadir le 04/21 et experiencez le meilleur show!', 1),
(45, 8, 'CASABLANCA', 'Scientifique', 'Go', '2021-04-15 10:52:00', 'CASABLANCA8.jpg', 'ass', 0),
(46, 8, 'LOV', 'Scientifique', 'Lov', '2021-04-01 10:52:00', 'lov8.jpg', 'asas', 0),
(48, 8, 'TBOURIDA - EDITION 16', 'Scientifique', 'Sidi Yehya', '2021-04-23 01:49:00', 'TBOURIDA - EDITION 16 8.jpg', 'La Tbourida, dérivée de Baroud qui signifie « poudre à canon », est un art équestre ancien, datant du 15ème siècle. Elle est la reconstitution d’un assaut militaire de guerriers cavaliers arabes et berbères.\r\n\r\nDe génération en génération, la Tbourida conserve une forte dimension spirituelle, notamment du fait qu’elle met le cheval , animal sacré de l’islam, au centre d’un spectacle haletant et impressionnant.\r\n\r\nLa Tbourida éblouit le grand public marocain et international. Elle est associée aux festivités : moussems, fêtes agricoles et nombreuses fêtes nationales et familiales. Les internationaux la dénomment souvent « Fantasia », appellation d’origine latine, signifiant divertissement.\r\nRetrouvez l\'édition 13 de la TBOURIDA à Oujda et vivez la meilleure expérience!', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`email`) VALUES
('email'),
('email'),
('abbassiyoussef@gmail.com'),
('abbassiyoussef739@gmail.com'),
('abbassiyoussef739@gmail.com'),
('youssef@gmail.com'),
('hamid');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(14) NOT NULL,
  `role` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `telephone`, `role`) VALUES
(1, 'Kifane', 'Yassine', 'kifane@gmail.com', '$2y$10$BRy489mCMPy8Skn7mT1qIefTB1217PYwgocWK15HjPEG6mwDQuF4K', '0670434988', 'u'),
(8, 'Ismaili', 'OMAR', 'hamid@gmail.com', '$2y$10$5lNm15k0S4qBkLCVYNhwQeof9oDUoI9AI1IK9YKf4g9bsZDfsuATO', '0670434988', 'u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_event` (`event_id`);

--
-- Indexes for table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_foreign_key_evenement` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_event` FOREIGN KEY (`event_id`) REFERENCES `evenement` (`id`);

--
-- Constraints for table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `fk_foreign_key_evenement` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
