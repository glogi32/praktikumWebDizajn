-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2021 at 01:00 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electronic_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `komentar_id` int(11) NOT NULL,
  `tekst` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `vreme` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `proizvod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`komentar_id`, `tekst`, `vreme`, `korisnik_id`, `proizvod_id`) VALUES
(1, 'Odlican proizviod!!!', 1555788068, 7, 12),
(2, 'asrasr', 1555788096, 7, 12),
(3, 'Veoma dobar telefon!!!!', 1555788135, 7, 12),
(4, 'KOmentar 1!', 1555788212, 1, 12),
(5, 'Odlican telefon!!!!!!!!!!', 1555788237, 1, 12),
(6, 'asrasassarrsrqrqwrqwrqwrqwrqwrqwrqwrwqrqwrqwrqwrqwrqwr', 1555788377, 1, 12),
(7, 'Komentar2', 1555788515, 1, 12),
(8, 'asrasrasrasrsarsar', 1555790598, 1, 14),
(9, 'asasrsrasrsar', 1555855497, 1, 17),
(10, 'askdjlkasjdklasdj', 1560352669, 1, 14),
(11, 'asdasdasdsa', 1560549290, 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `korisnik_id` int(11) NOT NULL,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sifra` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `uloga_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`korisnik_id`, `ime`, `prezime`, `email`, `sifra`, `uloga_id`) VALUES
(1, 'admin12', 'admin1', 'admin1@gmail.com', '09a90798eef16417feb25e1a47319c11', 1),
(2, 'admin2', 'admin2', 'admin2@gmail.com', 'c84258e9c39059a89ab77d846ddab909', 1),
(3, 'korisnik1', 'korisnik1', 'korisnik1@gmail.com', 'affc2dc1a3f9fb05392d3cb0a784ff61', 2),
(4, 'Nemanja', 'Glogovac', 'asda@gmail.com', 'adbf5a778175ee757c34d0eba4e932bc', 1),
(7, 'prodavac1', 'prodavac1', 'prodavac1@gmail.com', 'f078b5a17530da3d96f782bf4b10ea77', 3),
(13, 'Nemanja', 'Glogovac', 'user2@gmail.com', '09a90798eef16417feb25e1a47319c11', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ocene`
--

CREATE TABLE `ocene` (
  `ocena_id` int(11) NOT NULL,
  `ocena` int(11) NOT NULL,
  `proizvod_id` int(11) NOT NULL,
  `vreme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocene`
--

INSERT INTO `ocene` (`ocena_id`, `ocena`, `proizvod_id`, `vreme`) VALUES
(1, 4, 12, 1555806214),
(2, 2, 12, 1555806232),
(3, 5, 12, 1555806234),
(4, 2, 13, 1555806264),
(5, 5, 13, 1555806267),
(6, 3, 13, 1555806268),
(7, 1, 13, 1555806270),
(8, 4, 13, 1555806272),
(9, 2, 14, 1555806282),
(10, 3, 14, 1555806284),
(11, 3, 14, 1555806285),
(12, 5, 16, 1555806292),
(13, 4, 16, 1555806293),
(14, 5, 16, 1555806294),
(15, 4, 16, 1555806295),
(16, 3, 16, 1555806296),
(17, 1, 15, 1555806302),
(18, 1, 15, 1555806303),
(19, 1, 15, 1555806306),
(20, 5, 19, 1555808715),
(21, 4, 19, 1555808717),
(22, 5, 19, 1555808718),
(23, 5, 19, 1555808720),
(24, 4, 19, 1555808722),
(25, 3, 18, 1555851195),
(26, 5, 20, 1555853872),
(27, 2, 20, 1555853874),
(28, 4, 20, 1555853876),
(29, 2, 17, 1555853892),
(30, 3, 14, 1555857945),
(31, 5, 14, 1555857950),
(32, 3, 13, 1560339517),
(33, 4, 13, 1560339519),
(34, 2, 12, 1560339640),
(35, 4, 12, 1560339642),
(36, 3, 13, 1560549269),
(37, 4, 13, 1560549271),
(38, 5, 13, 1560549273),
(39, 2, 21, 1560557702),
(40, 5, 21, 1560557705),
(41, 5, 19, 1615246813),
(42, 3, 19, 1615246815);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `proizvod_id` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `ekran` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `procesor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kamera` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ram` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tip_id` int(11) NOT NULL,
  `proizvodjac_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`proizvod_id`, `naziv`, `cena`, `ekran`, `procesor`, `kamera`, `ram`, `tip_id`, `proizvodjac_id`) VALUES
(12, 'Apple iPhone X', '3500.00', '5.7\" IPS HD display with 564 ppi', 'Quad-core (2x2.35 GHz Kryo & 2x1.6 GHz Kryo)', 'Dual 13MP rear. 5MP front', '6GB', 1, 4),
(13, 'Samsung Galaxy Note 9', '3500.00', '5.7\" IPS HD display with 564 ppi', 'Quad-core (2x2.35 GHz Kryo & 2x1.6 GHz Kryo)', 'Dual 13MP rear. 5MP front', '6GB', 2, 2),
(14, 'Samsung Galaxy J7 Star', '199.00', '5.5\" HD touch screen', '1.6GHz processor', '13MP rear, 13MP front', '2GB', 1, 2),
(15, 'Apple iPhone 8', '599.00', '4.7\" Retina HD IPS display', 'A11 Bionic Chip', '12MP rear, 7MP front', '2GB', 1, 4),
(16, 'LG G6', '399.00', '5.7\" IPS HD display with 564 ppi', 'Quad-core (2x2.35 GHz Kryo & 2x1.6 GHz Kryo)', 'Dual 13MP rear. 5MP front', '4GB', 1, 3),
(17, 'LG V30 Plus', '499.00', '6.0\" QHD+ OLED Display; 538 ppi', '2.45 GHz x 4 + 1.9 GHz x 4 Octa-Core', '16MP + 13MP Wide Angle cameras (rear)', '4GB', 1, 3),
(18, 'Samsung Galaxy S9', '699.00', '5.8\" Super AMOLED with 16M colors and 570 ppi', 'Octa-core (4x2.7 GHz Kryo 385 Gold & 4x1.7 GHz Kry', '12MP rear, 8MP front', '4GB', 1, 2),
(19, 'Samsung Galaxy S10', '899.00', '6.1\" Dynamic AMOLED Display', 'Octa-core (1x2.8 GHz Kryo 485 & 3x2.4 GHz Kryo 485', 'Triple 12MP, 12MP & 16MP rear. 10MP front.', '6GB', 1, 2),
(20, 'Motorola Z3 Play', '549.00', '6.01\" HD IPS LCD', 'Octa-core 1.8 GHz', '12MP rear, 8MP front', '4GB', 1, 5),
(21, 'LG K30', '159.00', '5.3\" HD touchscreen (720x1280)', '1.4 GHz Quad-Core', '13MP rear, 5MP front', '2GB', 1, 3),
(23, 'Google Pixel 3 XL', '599.00', '5.7\" IPS HD display with 564 ppi', 'Quad-core (2x2.35 GHz Kryo & 2x1.6 GHz Kryo)', '12MP rear, 8MP front', '3GB', 1, 1),
(24, 'Google Pixel 3a XL', '529.00', 'Fullscreen 6.0\" FHD+ OLED with 402 ppi', '2.0GHz + 1.7GHz, 64Bit Octa-Core', '12.2MP dual rear cameras, 8MP wide-angle front cam', '4GB', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodjaci`
--

CREATE TABLE `proizvodjaci` (
  `proizvodjac_id` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvodjaci`
--

INSERT INTO `proizvodjaci` (`proizvodjac_id`, `naziv`) VALUES
(1, 'Google'),
(2, 'Samsung'),
(3, 'LG'),
(4, 'Apple'),
(5, 'Motorola');

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `slika_id` int(11) NOT NULL,
  `alt` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `src` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `proizvod_id` int(11) NOT NULL,
  `vreme_objave` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`slika_id`, `alt`, `src`, `proizvod_id`, `vreme_objave`) VALUES
(12, 'Apple iPhone X', 'assets/img/products_img/1555629208_iPhone_X_large.jpg', 12, 1555629208),
(13, 'Samsung Galaxy Note 9', 'assets/img/products_img/1555629226_Samsung_Galaxy_Note_9_large.jpg', 13, 1555629226),
(14, 'Samsung Galaxy J7 Star', 'assets/img/products_img/1555697670_j7_star_large.jpg', 14, 1555697670),
(15, 'Apple iPhone 8', 'assets/img/products_img/1555697787_s8_large.jpg', 15, 1555697787),
(16, 'LG G6', 'assets/img/products_img/1555698261_LG_C6_Platinum_large.jpg', 16, 1555698261),
(17, 'LG V30 Plus', 'assets/img/products_img/1555698366_lg_v30_plus_large.jpg', 17, 1555698366),
(18, 'Samsung Galaxy S9', 'assets/img/products_img/1555700347_Samsung_Galaxy_Note_9_large.jpg', 18, 1555700347),
(19, 'Samsung Galaxy S10', 'assets/img/products_img/1555717485_s10_large.jpg', 19, 1555717485),
(20, 'Motorola Z3 Play', 'assets/img/products_img/1555718044_p-18293.jpg', 20, 1555718044),
(23, 'Google Pixel 3 XL', 'assets/img/products_img/1560558491_Pixel_3_XL_large.jpg', 23, 1560558491),
(24, 'Google Pixel 3a XL', 'assets/img/products_img/1560558621_google_pixel_3a_xl_black_large-01.jpg', 24, 1560558621);

-- --------------------------------------------------------

--
-- Table structure for table `tip`
--

CREATE TABLE `tip` (
  `tip_id` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tip`
--

INSERT INTO `tip` (`tip_id`, `naziv`) VALUES
(1, 'Mobile'),
(2, 'Tablets'),
(3, 'Appliances'),
(4, 'Games & Entertainment');

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE `uloge` (
  `uloga_id` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`uloga_id`, `naziv`) VALUES
(1, 'Administrator'),
(2, 'Korisnik'),
(3, 'Prodavac');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`komentar_id`),
  ADD KEY `korisnik_id` (`korisnik_id`),
  ADD KEY `proizvod_id` (`proizvod_id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`korisnik_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `uloga_id` (`uloga_id`);

--
-- Indexes for table `ocene`
--
ALTER TABLE `ocene`
  ADD PRIMARY KEY (`ocena_id`),
  ADD KEY `proizvod_id` (`proizvod_id`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`proizvod_id`),
  ADD KEY `tip_id` (`tip_id`),
  ADD KEY `proizvodjac_id` (`proizvodjac_id`);

--
-- Indexes for table `proizvodjaci`
--
ALTER TABLE `proizvodjaci`
  ADD PRIMARY KEY (`proizvodjac_id`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`slika_id`),
  ADD KEY `proizvod_id` (`proizvod_id`);

--
-- Indexes for table `tip`
--
ALTER TABLE `tip`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
  ADD PRIMARY KEY (`uloga_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `komentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `korisnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ocene`
--
ALTER TABLE `ocene`
  MODIFY `ocena_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `proizvod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `proizvodjaci`
--
ALTER TABLE `proizvodjaci`
  MODIFY `proizvodjac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `slika_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tip`
--
ALTER TABLE `tip`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uloge`
--
ALTER TABLE `uloge`
  MODIFY `uloga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `komentari_ibfk_1` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvodi` (`proizvod_id`),
  ADD CONSTRAINT `komentari_ibfk_2` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`korisnik_id`);

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `korisnici_ibfk_1` FOREIGN KEY (`uloga_id`) REFERENCES `uloge` (`uloga_id`);

--
-- Constraints for table `ocene`
--
ALTER TABLE `ocene`
  ADD CONSTRAINT `ocene_ibfk_1` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvodi` (`proizvod_id`);

--
-- Constraints for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD CONSTRAINT `proizvodi_ibfk_1` FOREIGN KEY (`tip_id`) REFERENCES `tip` (`tip_id`),
  ADD CONSTRAINT `proizvodi_ibfk_2` FOREIGN KEY (`proizvodjac_id`) REFERENCES `proizvodjaci` (`proizvodjac_id`);

--
-- Constraints for table `slike`
--
ALTER TABLE `slike`
  ADD CONSTRAINT `slike_ibfk_1` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvodi` (`proizvod_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
