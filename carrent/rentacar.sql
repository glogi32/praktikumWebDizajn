-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2020 at 01:07 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentacar`
--

-- --------------------------------------------------------

--
-- Table structure for table `automobili`
--

CREATE TABLE `automobili` (
  `auto_id` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vrata` int(11) NOT NULL,
  `sedista` int(11) NOT NULL,
  `prtljag` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `menjac` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `starost` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `ocena` int(11) NOT NULL DEFAULT '1',
  `slika` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `izabrani` int(11) DEFAULT NULL,
  `pozadina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `automobili`
--

INSERT INTO `automobili` (`auto_id`, `naziv`, `vrata`, `sedista`, `prtljag`, `menjac`, `starost`, `cena`, `ocena`, `slika`, `alt`, `izabrani`, `pozadina`) VALUES
(1, 'Range Rover S7', 4, 5, '2 Suitcase/2 Bags', 'automatic', 12, 150, 3, 'public/vendor/images/img_3.jpg', 'Range Rover S7', NULL, 0),
(2, 'Range Rover S7', 4, 5, '2 Suitcase/2 Bags', 'automatic', 12, 150, 4, 'public/vendor/images/img_3.jpg', 'Range Rover S7', NULL, 0),
(3, 'Range Rover S3', 4, 4, '2 Suitcase/2 Bags', 'manual', 15, 350, 5, 'public/vendor/images/img_1.jpg', 'Range Rover S3', NULL, 0),
(6, 'Range Rover S64 Coupe', 4, 5, '2 Suitcase/1 Bags', 'automatic', 8, 150, 2, 'public/vendor/images/img_2.jpg', 'Range Rover S64 Coupe', 1, 0),
(7, 'Range Rover S60 Coupe', 4, 4, '2 Suitcase/1 Bags', 'manual', 15, 100, 5, 'public/vendor/images/img_1.jpg', 'Range Rover S60 Coupe', 1, 0),
(8, 'Range Rover S7', 4, 6, '2 Suitcase/2 Bags', 'automatic', 12, 170, 5, 'public/vendor/images/hero_1.jpg', 'Range Rover S7', 1, 0),
(14, 'Range Rover S10', 6, 6, '2 suitcase/2 bags', 'automatic', 2, 199, 5, 'public/vendor/images/cars/1582151832_hero_1.jpg', 'hero_1.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `komentar_id` int(11) NOT NULL,
  `tekst` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `vreme` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`komentar_id`, `tekst`, `vreme`, `korisnik_id`, `post_id`) VALUES
(1, 'asdasdasdasdasd', 1582393729, 25, 11),
(2, 'sadasdasdasd', 1582393734, 25, 11),
(3, 'asdasdasdasdasdasdasd', 1582394323, 30, 11),
(4, 'asrasrsarassarasrsar', 1582394328, 30, 11),
(5, 'asdasd', 1582395700, 30, 10),
(6, 'asasdasdasdasd', 1582395712, 30, 10);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `korisnik_id` int(11) NOT NULL,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `oAutoru` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `uloga_id` int(11) NOT NULL,
  `slika` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`korisnik_id`, `ime`, `prezime`, `email`, `password`, `oAutoru`, `uloga_id`, `slika`, `alt`) VALUES
(21, 'Pera', 'Peric', 'pera123@gmail.com', '09a90798eef16417feb25e1a47319c11', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 2, 'public/vendor/images/person_1.jpg', '1581778748_default_slika'),
(25, 'Pera', 'Peric', 'admin1@gmail.com', 'e00cf25ad42683b3df678c61f42c6bda', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 1, 'public/vendor/images/person_1.jpg', '1581865166_default_slika'),
(26, 'Nemanjaasdad', 'Glogovac', 'asda23@gmail.com', '09a90798eef16417feb25e1a47319c11', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 1, 'public/vendor/images/default.jpg', '1581895780_default_slika'),
(27, 'Nemanja', 'Glogovac', 'admin2@gmail.com', '09a90798eef16417feb25e1a47319c11', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 1, 'public/vendor/images/default.jpg', '1581897042_default_slika'),
(28, 'Nemanja', 'Glogovac', 'admin3@gmail.com', '09a90798eef16417feb25e1a47319c11', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 1, 'public/vendor/images/default.jpg', '1581897094_default_slika'),
(29, 'Asdkasda', 'Aeasrja', 'asda111@gmail.com', '09a90798eef16417feb25e1a47319c11', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 1, 'public/vendor/images/users/1581942612_person_2.jpg', '1581942612_person_2.jpg'),
(30, 'Nemanja', 'Glogovac', 'korisnik1@gmail.com', 'affc2dc1a3f9fb05392d3cb0a784ff61', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 2, 'public/vendor/images/default.jpg', '1581969290_default_slika'),
(31, 'Ime1', 'Prezime1', 'admin4@gmail.com', '09a90798eef16417feb25e1a47319c11', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 2, 'public/vendor/images/users/1582359907_person_2.jpg', '1582359907_person_2.jpg'),
(32, 'Pera', 'Peric', 'korisnik3@gmail.com', '09a90798eef16417feb25e1a47319c11', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 2, 'public/vendor/images/users/1582390604_person_4.jpg', '1582390604_person_4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `postovi`
--

CREATE TABLE `postovi` (
  `post_id` int(11) NOT NULL,
  `naslov` varchar(350) COLLATE utf8_unicode_ci NOT NULL,
  `tekst` varchar(3600) COLLATE utf8_unicode_ci NOT NULL,
  `skracen_tekst` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vreme_objave` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `izabrani` smallint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `postovi`
--

INSERT INTO `postovi` (`post_id`, `naslov`, `tekst`, `skracen_tekst`, `slika`, `alt`, `vreme_objave`, `korisnik_id`, `izabrani`) VALUES
(7, 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. ', 'A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth./\r\n\r\nEven the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar./\r\n\r\nThe Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way./\r\n\r\nWhen she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.\r\n/\r\nA small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth./\r\n\r\nEven the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar./\r\n\r\nThe Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way./\r\n\r\nWhen she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.', 'A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', 'public/vendor/images/posts/1582311713_post_2.jpg', 'post_2.jpg', 1582311713, 25, 1),
(8, 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 'A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth./\r\n\r\nEven the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar./\r\n\r\nThe Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way./\r\n\r\nWhen she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way./\r\n\r\nA small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth./\r\n\r\nEven the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar./\r\n\r\nThe Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way./\r\n\r\nWhen she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.', 'A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', 'public/vendor/images/posts/1582324710_post_4.jpg', 'post_4.jpg', 1582324710, 25, 1),
(9, 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 'A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth./\r\n\r\nEven the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar./\r\n\r\nThe Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way./\r\n\r\nWhen she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way./\r\n\r\nA small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth./\r\n\r\nEven the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar./\r\n\r\nThe Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way./\r\n\r\nWhen she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.', 'A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', 'public/vendor/images/posts/1582325029_post_6.jpg', 'post_6.jpg', 1582325029, 27, 0),
(10, 'There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book./\r\n\r\n It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n/\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English./\r\n\r\nMany desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'public/vendor/images/posts/1582327813_post_5.jpg', 'post_5.jpg', 1582327813, 25, 1),
(11, 'Contrary to popular belief, Lorem Ipsum is not simply random text.', 'It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. /\r\n\r\nThis book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', 'public/vendor/images/posts/1582327956_post_4.jpg', 'post_4.jpg', 1582327956, 27, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacije`
--

CREATE TABLE `rezervacije` (
  `id_rezervacije` int(11) NOT NULL,
  `pickup_adresa` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dropoff_adresa` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `from_datum` int(11) NOT NULL,
  `to_datum` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `auto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rezervacije`
--

INSERT INTO `rezervacije` (`id_rezervacije`, `pickup_adresa`, `dropoff_adresa`, `from_datum`, `to_datum`, `korisnik_id`, `auto_id`) VALUES
(7, 'Adresa1', 'Adresa2', 1582412400, 1583362800, 25, 3),
(8, 'Adresa3', 'Adresa4', 1583362800, 1586296800, 25, 3),
(9, 'Adresa3', 'Adresa2', 1583276400, 1583535600, 25, 8);

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE `uloge` (
  `uloga_id` int(11) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`uloga_id`, `naziv`) VALUES
(1, 'Administrator'),
(2, 'Korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `usluge`
--

CREATE TABLE `usluge` (
  `usluga_id` int(11) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tekst` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `klasa` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `izabrani` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usluge`
--

INSERT INTO `usluge` (`usluga_id`, `naziv`, `tekst`, `klasa`, `izabrani`) VALUES
(1, 'Car Key', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.', 'flaticon-car', NULL),
(2, 'Car Key', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.', 'flaticon-valet-1', NULL),
(3, 'Car Key', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.', 'flaticon-key', NULL),
(4, 'Repair', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.', 'flaticon-car-1', 1),
(5, 'Car Accessories', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.', 'flaticon-traffic', 1),
(6, 'Own a Car', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, laboriosam.', 'flaticon-valet', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `automobili`
--
ALTER TABLE `automobili`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`komentar_id`),
  ADD KEY `korisnik_id` (`korisnik_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`korisnik_id`),
  ADD KEY `uloga_id` (`uloga_id`);

--
-- Indexes for table `postovi`
--
ALTER TABLE `postovi`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD PRIMARY KEY (`id_rezervacije`),
  ADD KEY `korisnik_id` (`korisnik_id`),
  ADD KEY `auto_id` (`auto_id`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
  ADD PRIMARY KEY (`uloga_id`);

--
-- Indexes for table `usluge`
--
ALTER TABLE `usluge`
  ADD PRIMARY KEY (`usluga_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `automobili`
--
ALTER TABLE `automobili`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `komentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `korisnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `postovi`
--
ALTER TABLE `postovi`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rezervacije`
--
ALTER TABLE `rezervacije`
  MODIFY `id_rezervacije` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `uloge`
--
ALTER TABLE `uloge`
  MODIFY `uloga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usluge`
--
ALTER TABLE `usluge`
  MODIFY `usluga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `komentari_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `postovi` (`post_id`),
  ADD CONSTRAINT `komentari_ibfk_2` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`korisnik_id`);

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `korisnici_ibfk_1` FOREIGN KEY (`uloga_id`) REFERENCES `uloge` (`uloga_id`);

--
-- Constraints for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD CONSTRAINT `rezervacije_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`korisnik_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
