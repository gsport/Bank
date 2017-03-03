-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Hoszt: 127.0.0.1
-- Létrehozás ideje: 2014. Máj 19. 08:52
-- Szerver verzió: 5.6.16
-- PHP verzió: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Adatbázis: `loginrendszer`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `oldal_nev` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nyilt_reg` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true',
  `max_users` mediumint(6) DEFAULT '5000',
  `kell_email` enum('igen','nem') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'igen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Az oldal fő beállításai';

--
-- A tábla adatainak kiíratása `settings`
--

INSERT INTO `settings` (`email`, `url`, `oldal_nev`, `nyilt_reg`, `max_users`, `kell_email`) VALUES
('zsolt.gyure96@gmail.com', 'http://localhost/loginrendszer/login', 'Oldal neve', 'true', 5000, 'nem'),
('zsolt.gyure96@gmail.com', 'http://localhost/loginrendszer/login', 'Oldal neve', 'true', 5000, 'nem');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pw` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `jogok` tinyint(1) NOT NULL DEFAULT '1',
  `status` enum('confirmed','progress') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'progress',
  `regido` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `pw`, `email`, `jogok`, `status`, `regido`, `last_login`, `ip`) VALUES
(1, 'user', '8b12c2ba316f0fa135bc55e6e9ffeafc907cbde9', 'asd@asd.com', 1, 'confirmed', '2014-05-17 10:21:37', '2014-05-18 20:25:01', '::1'),
(2, 'admin', '16ab659503e0a8cb62358cc22f4f04ea93e46a35', 'admin@admin.com', 2, 'confirmed', '2014-05-18 09:39:54', '2014-05-19 08:48:46', '::1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
