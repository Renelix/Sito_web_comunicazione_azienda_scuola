-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 04, 2025 alle 21:03
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alternanza`
--
CREATE DATABASE IF NOT EXISTS `alternanza` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `alternanza`;
-- --------------------------------------------------------

--
-- Struttura della tabella `anagrafica_studenti`
--

CREATE TABLE `anagrafica_studenti` (
  `Id_studente` int(11) NOT NULL,
  `Nome` varchar(25) NOT NULL,
  `Cognome` varchar(25) NOT NULL,
  `Data_nascita` date NOT NULL,
  `Sesso` varchar(1) NOT NULL,
  `Cod_classe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Struttura della tabella `azienda_richieste`
--

CREATE TABLE `azienda_richieste` (
  `Id_azienda_richieste` int(11) NOT NULL,
  `Descrizione` longtext NOT NULL,
  `N_studenti` int(11) NOT NULL,
  `Specializzazione_studenti` longtext NOT NULL,
  `Data_inizio_attivita` date NOT NULL,
  `Data_fine_attivivta` date NOT NULL,
  `Url_contratto` longtext NOT NULL,
  `Cod_azienda` int(11) NOT NULL,
  `Cod_tutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Struttura della tabella `aziende`
--

CREATE TABLE `aziende` (
  `Id_azienda` int(11) NOT NULL,
  `Denominazione_login` varchar(25) NOT NULL,
  `Password_login` varchar(50) NOT NULL,
  `Denominazione` varchar(25) NOT NULL,
  `Email_certificata` varchar(50) NOT NULL,
  `Telefono` bigint(25) DEFAULT NULL,
  `Stato_sede` varchar(25) NOT NULL,
  `Regione_sede` varchar(25) NOT NULL,
  `Provincia_sede` varchar(25) NOT NULL,
  `Citta_sede` varchar(25) NOT NULL,
  `Via_sede` longtext NOT NULL,
  `N_civico_sede` int(11) DEFAULT NULL,
  `Url_convenzione` longtext NOT NULL,
  `Cod_referente_aziendale` int(11) DEFAULT NULL,
  `Cod_responsabile` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Struttura della tabella `classi_studenti`
--

CREATE TABLE `classi_studenti` (
  `Id_classe` int(11) NOT NULL,
  `Grado` int(11) NOT NULL,
  `Sezione` varchar(5) NOT NULL,
  `Cod_indirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Struttura della tabella `indirizzi_studenti`
--

CREATE TABLE `indirizzi_studenti` (
  `Id_indirizzo` int(11) NOT NULL,
  `Denominazione` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Struttura della tabella `referenti_responsabili`
--

CREATE TABLE `referenti_responsabili` (
  `Id_referente_responsabile` int(11) NOT NULL,
  `Nome` varchar(25) NOT NULL,
  `Cognome` varchar(25) NOT NULL,
  `Data_nascita` date NOT NULL,
  `Sesso` varchar(1) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefono` bigint(25) NOT NULL,
  `Stato_residenza` varchar(25) NOT NULL,
  `Regione_residenza` varchar(25) NOT NULL,
  `Provincia_residenza` varchar(25) NOT NULL,
  `Citta_residenza` varchar(25) NOT NULL,
  `Indirizzo_residenza` longtext NOT NULL,
  `N_civico_residenza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Struttura della tabella `richieste_studenti`
--

CREATE TABLE `richieste_studenti` (
  `Id_richiesta_studente` int(11) NOT NULL,
  `Url_valutazione_aziendale` longtext DEFAULT NULL,
  `Cod_richiesta` int(11) NOT NULL,
  `Cod_studente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Struttura della tabella `tutor_pcto`
--

CREATE TABLE `tutor_pcto` (
  `Id_tutor_pcto` int(11) NOT NULL,
  `Nome` varchar(25) NOT NULL,
  `Cognome` varchar(25) NOT NULL,
  `Username_login` varchar(25) NOT NULL,
  `Password_login` varchar(50) NOT NULL,
  `Data_nascita` date NOT NULL,
  `Sesso` varchar(1) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefono` bigint(25) NOT NULL,
  `Stato_residenza` varchar(25) NOT NULL,
  `Regione_residenza` varchar(25) NOT NULL,
  `Provincia_residenza` varchar(25) NOT NULL,
  `Citta_residenza` varchar(25) NOT NULL,
  `Indirizzo_residenza` longtext NOT NULL,
  `N_civico_residenza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `anagrafica_studenti`
--
ALTER TABLE `anagrafica_studenti`
  ADD PRIMARY KEY (`Id_studente`),
  ADD KEY `Cod_classe` (`Cod_classe`);

--
-- Indici per le tabelle `azienda_richieste`
--
ALTER TABLE `azienda_richieste`
  ADD PRIMARY KEY (`Id_azienda_richieste`),
  ADD KEY `Cod_azienda` (`Cod_azienda`),
  ADD KEY `Cod_tutor` (`Cod_tutor`);

--
-- Indici per le tabelle `aziende`
--
ALTER TABLE `aziende`
  ADD PRIMARY KEY (`Id_azienda`),
  ADD KEY `Cod_responsabile` (`Cod_responsabile`),
  ADD KEY `Cod_referente_aziendale` (`Cod_referente_aziendale`);

--
-- Indici per le tabelle `classi_studenti`
--
ALTER TABLE `classi_studenti`
  ADD PRIMARY KEY (`Id_classe`),
  ADD KEY `Cod_indirizzo` (`Cod_indirizzo`);

--
-- Indici per le tabelle `indirizzi_studenti`
--
ALTER TABLE `indirizzi_studenti`
  ADD PRIMARY KEY (`Id_indirizzo`);

--
-- Indici per le tabelle `referenti_responsabili`
--
ALTER TABLE `referenti_responsabili`
  ADD PRIMARY KEY (`Id_referente_responsabile`);

--
-- Indici per le tabelle `richieste_studenti`
--
ALTER TABLE `richieste_studenti`
  ADD PRIMARY KEY (`Id_richiesta_studente`),
  ADD KEY `Cod_studente` (`Cod_studente`),
  ADD KEY `Cod_richiesta` (`Cod_richiesta`);

--
-- Indici per le tabelle `tutor_pcto`
--
ALTER TABLE `tutor_pcto`
  ADD PRIMARY KEY (`Id_tutor_pcto`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `azienda_richieste`
--
ALTER TABLE `azienda_richieste`
  MODIFY `Id_azienda_richieste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `aziende`
--
ALTER TABLE `aziende`
  MODIFY `Id_azienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `classi_studenti`
--
ALTER TABLE `classi_studenti`
  MODIFY `Id_classe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `indirizzi_studenti`
--
ALTER TABLE `indirizzi_studenti`
  MODIFY `Id_indirizzo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `referenti_responsabili`
--
ALTER TABLE `referenti_responsabili`
  MODIFY `Id_referente_responsabile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `richieste_studenti`
--
ALTER TABLE `richieste_studenti`
  MODIFY `Id_richiesta_studente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `tutor_pcto`
--
ALTER TABLE `tutor_pcto`
  MODIFY `Id_tutor_pcto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `anagrafica_studenti`
--
ALTER TABLE `anagrafica_studenti`
  ADD CONSTRAINT `anagrafica_studenti_ibfk_1` FOREIGN KEY (`Cod_classe`) REFERENCES `classi_studenti` (`Id_classe`);

--
-- Limiti per la tabella `azienda_richieste`
--
ALTER TABLE `azienda_richieste`
  ADD CONSTRAINT `azienda_richieste_ibfk_1` FOREIGN KEY (`Cod_azienda`) REFERENCES `aziende` (`Id_azienda`),
  ADD CONSTRAINT `azienda_richieste_ibfk_2` FOREIGN KEY (`Cod_tutor`) REFERENCES `tutor_pcto` (`Id_tutor_pcto`);

--
-- Limiti per la tabella `aziende`
--
ALTER TABLE `aziende`
  ADD CONSTRAINT `aziende_ibfk_1` FOREIGN KEY (`Cod_responsabile`) REFERENCES `referenti_responsabili` (`Id_referente_responsabile`),
  ADD CONSTRAINT `aziende_ibfk_2` FOREIGN KEY (`Cod_referente_aziendale`) REFERENCES `referenti_responsabili` (`Id_referente_responsabile`);

--
-- Limiti per la tabella `classi_studenti`
--
ALTER TABLE `classi_studenti`
  ADD CONSTRAINT `classi_studenti_ibfk_1` FOREIGN KEY (`Cod_indirizzo`) REFERENCES `indirizzi_studenti` (`Id_indirizzo`);

--
-- Limiti per la tabella `richieste_studenti`
--
ALTER TABLE `richieste_studenti`
  ADD CONSTRAINT `richieste_studenti_ibfk_1` FOREIGN KEY (`Cod_studente`) REFERENCES `anagrafica_studenti` (`Id_studente`),
  ADD CONSTRAINT `richieste_studenti_ibfk_2` FOREIGN KEY (`Cod_richiesta`) REFERENCES `azienda_richieste` (`Id_azienda_richieste`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
