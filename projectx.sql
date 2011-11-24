-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Skapad: 24 november 2011 kl 15:27
-- Serverversion: 5.1.54
-- PHP-version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `projectx`
--

-- --------------------------------------------------------

--
-- Struktur för tabell `snippet`
--

CREATE TABLE IF NOT EXISTS `snippet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(50) NOT NULL,
  `code` varchar(2500) NOT NULL,
  `title` varchar(50) NOT NULL,
  `desc` varchar(500) NOT NULL,
  `language` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Data i tabell `snippet`
--

INSERT INTO `snippet` (`id`, `author`, `code`, `title`, `desc`, `language`) VALUES
(1, 'Kim Åström', 'selector {   filter: alpha(opacity=60); /* MSIE/PC */   -moz-opacity: 0.6; /* Mozilla 1.6 and older */   opacity: 0.6; }', 'opacityHack', 'a hack for op', 'css');
