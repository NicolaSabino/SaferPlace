-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2016 at 11:46 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assegnazione`
--

CREATE TABLE `assegnazione` (
  `id` int(11) NOT NULL,
  `abilitato` tinyint(1) DEFAULT '1',
  `idPianoFuga` int(11) DEFAULT NULL,
  `idPosizione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `collocazione`
--

CREATE TABLE `collocazione` (
  `utente` varchar(20) NOT NULL,
  `idPosizione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `edificio`
--

CREATE TABLE `edificio` (
  `nome` varchar(20) NOT NULL,
  `mappa` varchar(200) NOT NULL,
  `informazioni` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edificio`
--

INSERT INTO `edificio` (`nome`, `mappa`, `informazioni`) VALUES
('Univpm', 'classico.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `nome` enum('incendio','crollo','allagamento','gas') NOT NULL,
  `idSegnalazione` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `domanda` text NOT NULL,
  `risposta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `domanda`, `risposta`) VALUES
(1, 'come si chiama zek?', 'zek'),
(2, 'e peppe ', 'è scemo'),
(3, 'come andiamo?', 'come una coccia');

-- --------------------------------------------------------

--
-- Table structure for table `gestione`
--

CREATE TABLE `gestione` (
  `utente` varchar(20) NOT NULL,
  `edificio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `piano`
--

CREATE TABLE `piano` (
  `id` int(11) NOT NULL,
  `edificio` varchar(30) NOT NULL,
  `numeroPiano` int(11) NOT NULL,
  `pianta` varchar(200) NOT NULL,
  `nstanze` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piano`
--

INSERT INTO `piano` (`id`, `edificio`, `numeroPiano`, `pianta`, `nstanze`) VALUES
(1, 'Univpm', 1, 'piano-1-stanze.jpg', 19),
(2, 'Univpm', 2, 'piano-2-stanze.jpg', 24);

-- --------------------------------------------------------

--
-- Table structure for table `pianodifuga`
--

CREATE TABLE `pianodifuga` (
  `id` int(11) NOT NULL,
  `pianta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posizione`
--

CREATE TABLE `posizione` (
  `id` int(11) NOT NULL,
  `zona` varchar(1) NOT NULL,
  `stanza` int(11) NOT NULL,
  `idPiano` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posizione`
--

INSERT INTO `posizione` (`id`, `zona`, `stanza`, `idPiano`) VALUES
(3, 'a', 11, 1),
(4, 'b', 9, 1),
(5, 'a', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `segnalazione`
--

CREATE TABLE `segnalazione` (
  `id` int(11) NOT NULL,
  `utente` varchar(20) NOT NULL,
  `idPosizione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `username` varchar(20) NOT NULL,
  `livello` enum('1','2','3') NOT NULL DEFAULT '1',
  `password` varchar(20) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `genere` enum('m','f') NOT NULL DEFAULT 'm',
  `eta` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`username`, `livello`, `password`, `cognome`, `nome`, `genere`, `eta`, `email`, `telefono`) VALUES
('Peppep94', '1', 'peppe', 'romani', 'giuseppe', 'm', 22, 'gromani14@gmail.com', '3277949953'),
('zek', '1', 'ciao', 'zechini', 'alessandro', 'm', 22, 'ale.giulia2005@libero.it', '3256731743');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assegnazione`
--
ALTER TABLE `assegnazione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPianoFuga` (`idPianoFuga`),
  ADD KEY `idPosizione_2` (`idPosizione`);

--
-- Indexes for table `collocazione`
--
ALTER TABLE `collocazione`
  ADD PRIMARY KEY (`utente`),
  ADD KEY `idPosizione` (`idPosizione`);

--
-- Indexes for table `edificio`
--
ALTER TABLE `edificio`
  ADD PRIMARY KEY (`nome`);

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSegnalazione` (`idSegnalazione`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gestione`
--
ALTER TABLE `gestione`
  ADD PRIMARY KEY (`utente`,`edificio`),
  ADD UNIQUE KEY `edificio` (`edificio`);

--
-- Indexes for table `piano`
--
ALTER TABLE `piano`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `edificio` (`edificio`,`numeroPiano`);

--
-- Indexes for table `pianodifuga`
--
ALTER TABLE `pianodifuga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `posizione`
--
ALTER TABLE `posizione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPiano` (`idPiano`);

--
-- Indexes for table `segnalazione`
--
ALTER TABLE `segnalazione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente` (`utente`),
  ADD KEY `idPosizione` (`idPosizione`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assegnazione`
--
ALTER TABLE `assegnazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `piano`
--
ALTER TABLE `piano`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pianodifuga`
--
ALTER TABLE `pianodifuga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posizione`
--
ALTER TABLE `posizione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `segnalazione`
--
ALTER TABLE `segnalazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assegnazione`
--
ALTER TABLE `assegnazione`
  ADD CONSTRAINT `assegnazione_ibfk_1` FOREIGN KEY (`idPianoFuga`) REFERENCES `pianodifuga` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `assegnazione_ibfk_2` FOREIGN KEY (`idPosizione`) REFERENCES `posizione` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `collocazione`
--
ALTER TABLE `collocazione`
  ADD CONSTRAINT `collocazione_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utente` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `collocazione_ibfk_2` FOREIGN KEY (`idPosizione`) REFERENCES `posizione` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`idSegnalazione`) REFERENCES `segnalazione` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `gestione`
--
ALTER TABLE `gestione`
  ADD CONSTRAINT `gestione_ibfk_1` FOREIGN KEY (`edificio`) REFERENCES `edificio` (`nome`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `gestione_ibfk_2` FOREIGN KEY (`utente`) REFERENCES `utente` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `piano`
--
ALTER TABLE `piano`
  ADD CONSTRAINT `piano_ibfk_1` FOREIGN KEY (`edificio`) REFERENCES `edificio` (`nome`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posizione`
--
ALTER TABLE `posizione`
  ADD CONSTRAINT `posizione_ibfk_1` FOREIGN KEY (`idPiano`) REFERENCES `piano` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `segnalazione`
--
ALTER TABLE `segnalazione`
  ADD CONSTRAINT `segnalazione_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utente` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `segnalazione_ibfk_2` FOREIGN KEY (`idPosizione`) REFERENCES `posizione` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
