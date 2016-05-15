-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Mag 15, 2016 alle 17:20
-- Versione del server: 10.1.13-MariaDB
-- Versione PHP: 5.6.20

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
-- Struttura della tabella `assegnazione`
--

CREATE TABLE `assegnazione` (
  `id` int(11) NOT NULL,
  `abilitato` tinyint(1) DEFAULT '1',
  `idPianoFuga` int(11) DEFAULT NULL,
  `zona` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `assegnazione`
--

INSERT INTO `assegnazione` (`id`, `abilitato`, `idPianoFuga`, `zona`) VALUES
(1, 0, 1, 3),
(2, 0, 2, 4),
(3, 0, 3, 5),
(4, 0, 4, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `collocazione`
--

CREATE TABLE `collocazione` (
  `utente` varchar(20) NOT NULL,
  `idPosizione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `collocazione`
--

INSERT INTO `collocazione` (`utente`, `idPosizione`) VALUES
('giuliacocciona', 3),
('zek', 3),
('Peppep94', 4),
('nicolanabbo', 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `edificio`
--

CREATE TABLE `edificio` (
  `nome` varchar(20) NOT NULL,
  `mappa` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `edificio`
--

INSERT INTO `edificio` (`nome`, `mappa`) VALUES
('hanami', ''),
('univpm', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `nome` enum('incendio','crollo','allagamento','gas') NOT NULL,
  `idSegnalazione` int(11) DEFAULT NULL,
  `zona` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `domanda` text NOT NULL,
  `risposta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `faq`
--

INSERT INTO `faq` (`id`, `domanda`, `risposta`) VALUES
(1, 'come si chiama zek?', 'zek'),
(2, 'e peppe ', 'bo '),
(3, 'come andiamo?', 'come una coccia');

-- --------------------------------------------------------

--
-- Struttura della tabella `gestione`
--

CREATE TABLE `gestione` (
  `utente` varchar(20) NOT NULL,
  `edificio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `gestione`
--

INSERT INTO `gestione` (`utente`, `edificio`) VALUES
('giuliacocciona', 'univpm'),
('nicolanabbo', 'hanami');

-- --------------------------------------------------------

--
-- Struttura della tabella `piano`
--

CREATE TABLE `piano` (
  `id` int(11) NOT NULL,
  `edificio` varchar(30) NOT NULL,
  `numeroPiano` int(11) NOT NULL,
  `pianta` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `piano`
--

INSERT INTO `piano` (`id`, `edificio`, `numeroPiano`, `pianta`) VALUES
(1, 'univpm', 1, ''),
(2, 'univpm', 2, ''),
(3, 'hanami', 1, 'brrr'),
(4, 'hanami', 2, 'breweeew'),
(5, 'hanami', 3, 'nabbo');

-- --------------------------------------------------------

--
-- Struttura della tabella `pianodifuga`
--

CREATE TABLE `pianodifuga` (
  `id` int(11) NOT NULL,
  `pianta` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `pianodifuga`
--

INSERT INTO `pianodifuga` (`id`, `pianta`) VALUES
(1, 'ciao'),
(2, 'pianoA'),
(3, 'pianoB'),
(4, 'pianoC'),
(5, 'pianoD');

-- --------------------------------------------------------

--
-- Struttura della tabella `posizione`
--

CREATE TABLE `posizione` (
  `id` int(11) NOT NULL,
  `zona` int(3) NOT NULL,
  `stanza` int(11) NOT NULL,
  `idPiano` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `posizione`
--

INSERT INTO `posizione` (`id`, `zona`, `stanza`, `idPiano`) VALUES
(3, 1, 11, 2),
(4, 2, 9, 1),
(5, 3, 1, 1),
(6, 4, 5, 1),
(7, 5, 7, 3),
(8, 6, 93, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `segnalazione`
--

CREATE TABLE `segnalazione` (
  `id` int(11) NOT NULL,
  `utente` varchar(20) NOT NULL,
  `idPosizione` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `segnalazione`
--

INSERT INTO `segnalazione` (`id`, `utente`, `idPosizione`, `tipo`) VALUES
(1, 'giuliacocciona', 3, ''),
(2, 'nicolanabbo', 6, ''),
(3, 'Peppep94', 4, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `username` varchar(20) NOT NULL,
  `livello` enum('1','2','3') NOT NULL DEFAULT '1',
  `password` varchar(20) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `genere` enum('m','f') NOT NULL DEFAULT 'm',
  `eta` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `evacuare` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`username`, `livello`, `password`, `foto`, `cognome`, `nome`, `genere`, `eta`, `email`, `telefono`, `evacuare`) VALUES
('giuliacocciona', '2', 'dell', '', 'cocciona', 'giulia', 'm', 21, 'boh@boh.it', 'xperia sp', 0),
('nicolanabbo', '2', 'nabbonicola', '', 'nabbo', 'nicola', 'm', 21, 'nicola@nabbo.it', 's6', 0),
('Peppep94', '1', 'peppe', '', 'romani', 'giuseppe', 'm', 22, 'gromani14@gmail.com', 'nexus 6P', 0),
('zek', '1', 'ciao', '', 'zechini', 'alessandro', 'm', 22, 'ale.giulia2005@libero.it', 'nexus 5', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `zona`
--

CREATE TABLE `zona` (
  `id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `zona`
--

INSERT INTO `zona` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `assegnazione`
--
ALTER TABLE `assegnazione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPianoFuga` (`idPianoFuga`),
  ADD KEY `idPosizione_2` (`zona`);

--
-- Indici per le tabelle `collocazione`
--
ALTER TABLE `collocazione`
  ADD PRIMARY KEY (`utente`),
  ADD KEY `idPosizione` (`idPosizione`);

--
-- Indici per le tabelle `edificio`
--
ALTER TABLE `edificio`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSegnalazione` (`idSegnalazione`),
  ADD KEY `zona` (`zona`);

--
-- Indici per le tabelle `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `gestione`
--
ALTER TABLE `gestione`
  ADD PRIMARY KEY (`utente`,`edificio`),
  ADD UNIQUE KEY `edificio` (`edificio`);

--
-- Indici per le tabelle `piano`
--
ALTER TABLE `piano`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `edificio` (`edificio`,`numeroPiano`);

--
-- Indici per le tabelle `pianodifuga`
--
ALTER TABLE `pianodifuga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indici per le tabelle `posizione`
--
ALTER TABLE `posizione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPiano` (`idPiano`),
  ADD KEY `zona` (`zona`);

--
-- Indici per le tabelle `segnalazione`
--
ALTER TABLE `segnalazione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente` (`utente`),
  ADD KEY `idPosizione` (`idPosizione`),
  ADD KEY `id` (`id`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `assegnazione`
--
ALTER TABLE `assegnazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la tabella `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la tabella `piano`
--
ALTER TABLE `piano`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT per la tabella `pianodifuga`
--
ALTER TABLE `pianodifuga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT per la tabella `posizione`
--
ALTER TABLE `posizione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT per la tabella `segnalazione`
--
ALTER TABLE `segnalazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la tabella `zona`
--
ALTER TABLE `zona`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `assegnazione`
--
ALTER TABLE `assegnazione`
  ADD CONSTRAINT `assegnazione_ibfk_1` FOREIGN KEY (`idPianoFuga`) REFERENCES `pianodifuga` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `assegnazione_ibfk_2` FOREIGN KEY (`zona`) REFERENCES `zona` (`id`);

--
-- Limiti per la tabella `collocazione`
--
ALTER TABLE `collocazione`
  ADD CONSTRAINT `collocazione_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utente` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `collocazione_ibfk_2` FOREIGN KEY (`idPosizione`) REFERENCES `posizione` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`idSegnalazione`) REFERENCES `segnalazione` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `evento_ibfk_2` FOREIGN KEY (`zona`) REFERENCES `zona` (`id`);

--
-- Limiti per la tabella `gestione`
--
ALTER TABLE `gestione`
  ADD CONSTRAINT `gestione_ibfk_1` FOREIGN KEY (`edificio`) REFERENCES `edificio` (`nome`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `gestione_ibfk_2` FOREIGN KEY (`utente`) REFERENCES `utente` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `piano`
--
ALTER TABLE `piano`
  ADD CONSTRAINT `piano_ibfk_1` FOREIGN KEY (`edificio`) REFERENCES `edificio` (`nome`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `posizione`
--
ALTER TABLE `posizione`
  ADD CONSTRAINT `posizione_ibfk_1` FOREIGN KEY (`idPiano`) REFERENCES `piano` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posizione_ibfk_2` FOREIGN KEY (`zona`) REFERENCES `zona` (`id`);

--
-- Limiti per la tabella `segnalazione`
--
ALTER TABLE `segnalazione`
  ADD CONSTRAINT `segnalazione_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utente` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `segnalazione_ibfk_2` FOREIGN KEY (`idPosizione`) REFERENCES `posizione` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
