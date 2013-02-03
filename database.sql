-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Temps de generació: 03-02-2013 a les 17:05:42
-- Versió del servidor: 5.5.25
-- Versió de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de dades: `videojocs`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `missatge_tasca`
--

CREATE TABLE `missatge_tasca` (
  `pk_msg` int(5) NOT NULL AUTO_INCREMENT,
  `fk_usuari` int(5) NOT NULL,
  `fk_tasca` int(5) NOT NULL,
  `data` datetime NOT NULL,
  `msg` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`pk_msg`),
  KEY `fk_usuari` (`fk_usuari`,`fk_tasca`),
  KEY `fk_tasca` (`fk_tasca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `sprint`
--

CREATE TABLE `sprint` (
  `pk_sprint` int(5) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `data_finalitzacio` date NOT NULL,
  PRIMARY KEY (`pk_sprint`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

--
-- Bolcant dades de la taula `sprint`
--

INSERT INTO `sprint` (`pk_sprint`, `nom`, `data_finalitzacio`) VALUES
(1, 'Sprint 2', '2013-02-25');

-- --------------------------------------------------------

--
-- Estructura de la taula `tasca`
--

CREATE TABLE `tasca` (
  `pk_tasca` int(5) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `explicacio` text COLLATE utf8_spanish2_ci NOT NULL,
  `data_fi` date NOT NULL,
  `fk_sprint` int(5) NOT NULL,
  `completada` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pk_tasca`),
  KEY `fk_sprint` (`fk_sprint`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=25 ;

--
-- Bolcant dades de la taula `tasca`
--

INSERT INTO `tasca` (`pk_tasca`, `nom`, `explicacio`, `data_fi`, `fk_sprint`, `completada`) VALUES
(3, 'Game design del stage 1', 'Game design del stage 1. Primera etapa del joc. Aprenentatge dels game mechanics', '2013-01-21', 1, 1),
(4, 'Reunió per adaptar els dissenys finals per al game design', 'Reunió entre el game designer i el level designer per tal d''explicar-li la idea i el level designer pugui plasmar amb disseny el que el game designer té al cap.', '0000-00-00', 1, 1),
(7, 'Programació del personatge. ', 'Carregar animacions quan el controlador d''events detecti alguna interacció amb el personatge. Pendent de desglossar amb mini-tasques', '0000-00-00', 1, 0),
(8, 'Level design', 'Level design. Disseny especific de com serà l''escenari', '0000-00-00', 1, 1),
(9, 'Reunió per mostrar els els levels designs', 'La reunió servirà per a que tot l''equip es faci una idea de com serà el disseny del joc. La Level designer prendrà el mando i explicarà a hom com anirà tot. Serà important que al Designer li quedin tots els conceptes clars.', '0000-00-00', 1, 1),
(10, 'Environtment development', 'Programació de l''animació de l''environtment independent de la interacció amb l''escena. *Pendent de que es facin mini-tasques\r\n', '0000-00-00', 1, 0),
(11, 'Reunió per saber com gestionar els events', 'En aquesta reunió s''explicarà com Unity gestiona els events i com s''ha dut a terme el cotnrolador que ho fa. Així doncs serà important el paper del programador que hagi realitzat el control d''events.', '0000-00-00', 1, 0),
(12, 'Diagrama de classes', 'Es farà un diagrama de classes de tot el joc. Haurà de formar-hi part qualsevol cosa que estigui dins el joc.', '0000-00-00', 1, 0),
(13, 'Programació de la IA de l''esquirol', 'Serà la programació de IA d''aquest stage. ', '0000-00-00', 1, 0),
(14, 'Models environtment Stage 1', 'S''hauran d''aconseguir tots els models que s''usaran per l''stage1. Entre ells hi haurà: Pedres, Arbres, Herbes, muntanyes, etc.', '0000-00-00', 1, 0),
(15, 'Creació/Cerca de paissatges 2D', 'S''haurà de fer una búsqueda o crear paissatges 2D que formaran part del fons de l''stage1. S''hauran de separar amb varies capes per donar sensació de profunditat.', '0000-00-00', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `tasca_x_usuari`
--

CREATE TABLE `tasca_x_usuari` (
  `fk_tasca` int(5) NOT NULL,
  `fk_usuari` int(5) NOT NULL,
  `temps_dedicat` int(5) NOT NULL,
  KEY `fk_tasca` (`fk_tasca`,`fk_usuari`),
  KEY `fk_usuari` (`fk_usuari`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Bolcant dades de la taula `tasca_x_usuari`
--

INSERT INTO `tasca_x_usuari` (`fk_tasca`, `fk_usuari`, `temps_dedicat`) VALUES
(3, 1, 10),
(4, 1, 1),
(4, 3, 0),
(7, 1, 0),
(8, 2, 0),
(9, 1, 0),
(9, 2, 0),
(9, 3, 0),
(9, 4, 0),
(9, 5, 0),
(10, 3, 0),
(11, 1, 2),
(11, 3, 0),
(11, 4, 0),
(11, 5, 0),
(11, 2, 0),
(12, 2, 0),
(12, 5, 0),
(13, 2, 0),
(14, 4, 0),
(15, 4, 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `usuari`
--

CREATE TABLE `usuari` (
  `pk_usuari` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `cognoms` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `perfil` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`pk_usuari`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=6 ;

--
-- Bolcant dades de la taula `usuari`
--

INSERT INTO `usuari` (`pk_usuari`, `nom`, `cognoms`, `perfil`) VALUES
(1, 'David', 'González Shannon', 'Game designer - Developer'),
(2, 'Anna', 'Fusté Lleixà', 'Developer'),
(3, 'Judith', 'Amores', 'Artist - Developer'),
(4, 'Sergi', 'Lorenzo', 'Artist'),
(5, 'Jordi', 'Llobet Torrens', 'Project Manager');

--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `missatge_tasca`
--
ALTER TABLE `missatge_tasca`
  ADD CONSTRAINT `missatge_tasca_ibfk_2` FOREIGN KEY (`fk_tasca`) REFERENCES `tasca` (`pk_tasca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `missatge_tasca_ibfk_1` FOREIGN KEY (`fk_usuari`) REFERENCES `usuari` (`pk_usuari`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `tasca`
--
ALTER TABLE `tasca`
  ADD CONSTRAINT `tasca_ibfk_1` FOREIGN KEY (`fk_sprint`) REFERENCES `sprint` (`pk_sprint`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per la taula `tasca_x_usuari`
--
ALTER TABLE `tasca_x_usuari`
  ADD CONSTRAINT `tasca_x_usuari_ibfk_1` FOREIGN KEY (`fk_tasca`) REFERENCES `tasca` (`pk_tasca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasca_x_usuari_ibfk_2` FOREIGN KEY (`fk_usuari`) REFERENCES `usuari` (`pk_usuari`) ON DELETE CASCADE ON UPDATE CASCADE;
