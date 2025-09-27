-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Wrz 28, 2025 at 12:00 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parasolove`
--
CREATE DATABASE IF NOT EXISTS `parasolove` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `parasolove`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `zip_code` int(6) NOT NULL,
  `street` varchar(45) NOT NULL,
  `apartment` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'kompaktowe'),
(2, 'klasyczne'),
(3, 'dziecięce');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `color`
--

CREATE TABLE `color` (
  `color_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `hex_code` varchar(255) NOT NULL COMMENT 'color hex code with #'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_id`, `name`, `hex_code`) VALUES
(1, 'Wielobarwny', 'linear-gradient(135deg, #40e0d0, #ff8c00, #ff0080)'),
(2, 'Przeźroczysty', 'linear-gradient(135deg, hsla(0, 0%, 100%, 1) 33%, hsla(0, 0%, 87%, 1) 50%, hsla(0, 0%, 100%, 1) 85%)'),
(3, 'Biały', '#ffffff'),
(4, 'Czarny', '#333333'),
(5, 'Niebieski', '#36CEDC'),
(6, 'Fioletowy', '#A587CA'),
(7, 'Zielony', '#8FE968'),
(8, 'Żółty', '#FFEA56'),
(9, 'Pomarańczowy', '#FFB750'),
(10, 'Czerwony', '#FE797B');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cupon`
--

CREATE TABLE `cupon` (
  `cupon_id` int(11) NOT NULL,
  `code` varchar(45) NOT NULL,
  `discount` int(2) NOT NULL,
  `active_to` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `cupon`
--

INSERT INTO `cupon` (`cupon_id`, `code`, `discount`, `active_to`) VALUES
(1, 'TESTCODE', 15, '2037-09-18'),
(3, 'OLDCODE', 10, '2015-06-01');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `address_id` int(11) NOT NULL,
  `cupon_id` int(11) DEFAULT NULL,
  `status` enum('pending','shipped','completed','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ordered_item`
--

CREATE TABLE `ordered_item` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `color_id` int(5) NOT NULL,
  `size_id` int(1) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `color_id`, `size_id`, `name`, `description`, `price`, `quantity`, `is_archived`) VALUES
(1, 2, 4, 2, 'Produkt testowy', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat placeat incidunt soluta temporibus fugit aperiam, neque sint? Rem quae commodi facere! Vitae, deleniti error? Beatae ducimus sequi consectetur voluptatum deserunt?', 49.99, 70, 1),
(650, 2, 2, 2, 'Kolorowy Model', 'Uniwersalny produkt dla każdego użytkownika.', 82.99, 16, 0),
(651, 3, 6, 2, 'Lekki Produkt', 'Idealny na deszczowe dni, wyróżnia się trwałością i elegancją.', 119.99, 263, 0),
(652, 3, 5, 1, 'Lekki Artykuł', 'Nowoczesny design, który przyciąga spojrzenia.', 70.99, 287, 0),
(653, 1, 6, 2, 'Solidny Dodatek', 'Świetny wybór na prezent, łączy styl z praktycznością.', 119.99, 166, 0),
(654, 3, 4, 2, 'Funkcjonalny Model', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 31.99, 79, 0),
(655, 2, 7, 2, 'Solidny Egzemplarz', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 72.99, 204, 0),
(656, 1, 2, 1, 'Komfortowy Parasol', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 69.99, 92, 0),
(657, 2, 7, 1, 'Lekki Model', 'Nowoczesny design, który przyciąga spojrzenia.', 136.99, 211, 0),
(658, 2, 6, 1, 'Stylowy Artykuł', 'Świetny wybór na prezent, łączy styl z praktycznością.', 69.99, 180, 0),
(659, 2, 10, 1, 'Komfortowy Artykuł', 'Świetny wybór na prezent, łączy styl z praktycznością.', 85.99, 20, 0),
(660, 3, 8, 1, 'Solidny Produkt', 'Świetny wybór na prezent, łączy styl z praktycznością.', 69.99, 362, 0),
(661, 1, 4, 2, 'Komfortowy Model', 'Sprawdzony w trudnych warunkach pogodowych.', 79.99, 17, 0),
(662, 2, 10, 1, 'Elegancki Akcesorium', 'Sprawdzony w trudnych warunkach pogodowych.', 133.99, 345, 0),
(663, 3, 10, 1, 'Nowoczesny Akcesorium', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 119.99, 189, 0),
(664, 2, 4, 1, 'Lekki Model', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 81.99, 324, 0),
(665, 3, 10, 1, 'Solidny Parasol', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 69.99, 119, 0),
(666, 3, 2, 1, 'Praktyczny Sprzęt', 'Nowoczesny design, który przyciąga spojrzenia.', 48.99, 99, 0),
(667, 2, 1, 2, 'Stylowy Model', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 79.99, 10, 0),
(668, 3, 3, 2, 'Lekki Parasol', 'Idealny na deszczowe dni, wyróżnia się trwałością i elegancją.', 69.99, 234, 0),
(669, 2, 2, 1, 'Elegancki Wzór', 'Sprawdzony w trudnych warunkach pogodowych.', 69.99, 141, 0),
(670, 2, 6, 2, 'Stylowy Parasol', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 149.99, 90, 0),
(671, 1, 3, 2, 'Solidny Artykuł', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 69.99, 182, 0),
(672, 2, 3, 1, 'Kolorowy Akcesorium', 'Uniwersalny produkt dla każdego użytkownika.', 119.99, 82, 0),
(673, 1, 6, 1, 'Elegancki Wyposażenie', 'Świetny wybór na prezent, łączy styl z praktycznością.', 122.99, 380, 0),
(674, 3, 10, 1, 'Lekki Egzemplarz', 'Nowoczesny design, który przyciąga spojrzenia.', 55.99, 277, 0),
(675, 1, 9, 1, 'Stylowy Egzemplarz', 'Idealny na deszczowe dni, wyróżnia się trwałością i elegancją.', 154.99, 168, 0),
(676, 2, 9, 1, 'Solidny Egzemplarz', 'Sprawdzony w trudnych warunkach pogodowych.', 69.99, 121, 0),
(677, 1, 10, 1, 'Komfortowy Produkt', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 54.99, 183, 0),
(678, 1, 4, 1, 'Praktyczny Sprzęt', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 79.99, 117, 0),
(679, 1, 1, 2, 'Wyjątkowy Egzemplarz', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 79.99, 170, 0),
(680, 1, 10, 1, 'Praktyczny Wyposażenie', 'Nowoczesny design, który przyciąga spojrzenia.', 128.99, 64, 0),
(681, 3, 8, 2, 'Funkcjonalny Dodatek', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 32.99, 386, 0),
(682, 3, 9, 1, 'Praktyczny Artykuł', 'Uniwersalny produkt dla każdego użytkownika.', 117.99, 270, 0),
(683, 1, 7, 1, 'Lekki Wyposażenie', 'Uniwersalny produkt dla każdego użytkownika.', 69.99, 163, 0),
(684, 1, 4, 1, 'Funkcjonalny Artykuł', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 69.99, 6, 0),
(685, 2, 8, 2, 'Solidny Model', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 63.99, 269, 0),
(686, 3, 3, 2, 'Nowoczesny Parasol', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 139.99, 341, 0),
(687, 1, 10, 1, 'Stylowy Egzemplarz', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 133.99, 7, 0),
(688, 2, 10, 2, 'Nowoczesny Wyposażenie', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 69.99, 209, 0),
(689, 3, 9, 2, 'Solidny Sprzęt', 'Lekki i poręczny – zawsze zmieści się w torbie.', 69.99, 61, 0),
(690, 2, 10, 1, 'Funkcjonalny Dodatek', 'Sprawdzony w trudnych warunkach pogodowych.', 69.99, 82, 0),
(691, 2, 3, 2, 'Funkcjonalny Produkt', 'Świetny wybór na prezent, łączy styl z praktycznością.', 159.99, 277, 0),
(692, 3, 10, 1, 'Solidny Artykuł', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 19.99, 188, 0),
(693, 3, 2, 2, 'Wyjątkowy Produkt', 'Sprawdzony w trudnych warunkach pogodowych.', 298.99, 126, 0),
(694, 1, 9, 2, 'Wyjątkowy Wzór', 'Uniwersalny produkt dla każdego użytkownika.', 48.99, 92, 0),
(695, 3, 6, 1, 'Komfortowy Model', 'Lekki i poręczny – zawsze zmieści się w torbie.', 31.99, 89, 0),
(696, 1, 5, 2, 'Funkcjonalny Dodatek', 'Idealny na deszczowe dni, wyróżnia się trwałością i elegancją.', 119.99, 149, 0),
(697, 3, 1, 1, 'Komfortowy Egzemplarz', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 134.99, 326, 0),
(698, 1, 10, 2, 'Nowoczesny Sprzęt', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 119.99, 157, 0),
(699, 2, 4, 1, 'Solidny Egzemplarz', 'Uniwersalny produkt dla każdego użytkownika.', 70.99, 332, 0),
(700, 2, 2, 1, 'Nowoczesny Produkt', 'Uniwersalny produkt dla każdego użytkownika.', 94.99, 177, 0),
(701, 1, 1, 2, 'Lekki Akcesorium', 'Lekki i poręczny – zawsze zmieści się w torbie.', 69.99, 169, 0),
(702, 2, 5, 2, 'Elegancki Parasol', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 69.99, 320, 0),
(703, 2, 10, 2, 'Praktyczny Akcesorium', 'Idealny na deszczowe dni, wyróżnia się trwałością i elegancją.', 69.99, 287, 0),
(704, 1, 4, 2, 'Solidny Sprzęt', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 147.99, 205, 0),
(705, 3, 8, 1, 'Kolorowy Artykuł', 'Nowoczesny design, który przyciąga spojrzenia.', 69.99, 160, 0),
(706, 1, 10, 1, 'Lekki Parasol', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 119.99, 280, 0),
(707, 1, 3, 2, 'Lekki Produkt', 'Uniwersalny produkt dla każdego użytkownika.', 13.99, 204, 0),
(708, 1, 5, 1, 'Nowoczesny Produkt', 'Sprawdzony w trudnych warunkach pogodowych.', 134.99, 221, 0),
(709, 3, 6, 2, 'Stylowy Wyposażenie', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 107.99, 368, 0),
(710, 2, 4, 2, 'Wyjątkowy Sprzęt', 'Lekki i poręczny – zawsze zmieści się w torbie.', 49.99, 60, 0),
(711, 2, 1, 2, 'Stylowy Artykuł', 'Nowoczesny design, który przyciąga spojrzenia.', 69.99, 283, 0),
(712, 3, 7, 2, 'Lekki Parasol', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 107.99, 73, 0),
(713, 3, 5, 1, 'Funkcjonalny Wzór', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 79.99, 185, 0),
(714, 1, 5, 1, 'Wyjątkowy Model', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 118.99, 139, 0),
(715, 1, 5, 1, 'Kolorowy Sprzęt', 'Świetny wybór na prezent, łączy styl z praktycznością.', 65.99, 64, 0),
(716, 1, 2, 1, 'Solidny Wyposażenie', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 53.99, 131, 0),
(717, 2, 10, 2, 'Komfortowy Dodatek', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 79.99, 246, 0),
(718, 3, 2, 2, 'Stylowy Dodatek', 'Sprawdzony w trudnych warunkach pogodowych.', 79.99, 367, 0),
(719, 2, 7, 2, 'Kolorowy Wzór', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 85.99, 218, 0),
(720, 3, 9, 2, 'Nowoczesny Akcesorium', 'Nowoczesny design, który przyciąga spojrzenia.', 69.99, 375, 0),
(721, 3, 6, 1, 'Funkcjonalny Wyposażenie', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 32.99, 210, 0),
(722, 2, 4, 2, 'Elegancki Egzemplarz', 'Nowoczesny design, który przyciąga spojrzenia.', 21.99, 128, 0),
(723, 3, 7, 1, 'Elegancki Dodatek', 'Lekki i poręczny – zawsze zmieści się w torbie.', 249.99, 237, 0),
(724, 3, 1, 2, 'Solidny Dodatek', 'Nowoczesny design, który przyciąga spojrzenia.', 140.99, 167, 0),
(725, 3, 4, 1, 'Nowoczesny Akcesorium', 'Nowoczesny design, który przyciąga spojrzenia.', 119.99, 245, 0),
(726, 2, 4, 1, 'Stylowy Parasol', 'Lekki i poręczny – zawsze zmieści się w torbie.', 117.99, 12, 0),
(727, 3, 5, 2, 'Funkcjonalny Parasol', 'Lekki i poręczny – zawsze zmieści się w torbie.', 79.99, 262, 0),
(728, 2, 5, 1, 'Komfortowy Dodatek', 'Idealny na deszczowe dni, wyróżnia się trwałością i elegancją.', 92.99, 72, 0),
(729, 2, 3, 2, 'Elegancki Parasol', 'Uniwersalny produkt dla każdego użytkownika.', 69.99, 280, 0),
(730, 1, 2, 2, 'Wyjątkowy Akcesorium', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 69.99, 352, 0),
(731, 3, 9, 1, 'Komfortowy Parasol', 'Lekki i poręczny – zawsze zmieści się w torbie.', 142.99, 93, 0),
(732, 1, 10, 2, 'Solidny Akcesorium', 'Idealny na deszczowe dni, wyróżnia się trwałością i elegancją.', 79.99, 209, 0),
(733, 1, 10, 2, 'Lekki Model', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 79.99, 191, 0),
(734, 1, 4, 2, 'Elegancki Produkt', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 79.99, 186, 0),
(735, 2, 8, 1, 'Praktyczny Model', 'Idealny na deszczowe dni, wyróżnia się trwałością i elegancją.', 41.99, 31, 0),
(736, 2, 2, 2, 'Kolorowy Egzemplarz', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 49.99, 158, 0),
(737, 1, 8, 2, 'Lekki Parasol', 'Idealny na deszczowe dni, wyróżnia się trwałością i elegancją.', 69.99, 49, 0),
(738, 3, 6, 2, 'Kolorowy Model', 'Sprawdzony w trudnych warunkach pogodowych.', 137.99, 232, 0),
(739, 1, 4, 1, 'Funkcjonalny Egzemplarz', 'Nowoczesny design, który przyciąga spojrzenia.', 128.99, 101, 0),
(740, 1, 5, 2, 'Funkcjonalny Dodatek', 'Świetny wybór na prezent, łączy styl z praktycznością.', 150.99, 196, 0),
(741, 2, 2, 1, 'Nowoczesny Dodatek', 'Uniwersalny produkt dla każdego użytkownika.', 299.99, 141, 0),
(742, 2, 8, 2, 'Nowoczesny Akcesorium', 'Uniwersalny produkt dla każdego użytkownika.', 157.99, 149, 0),
(743, 3, 5, 2, 'Nowoczesny Wzór', 'Uniwersalny produkt dla każdego użytkownika.', 79.99, 185, 0),
(744, 3, 4, 2, 'Praktyczny Wzór', 'Nowoczesny design, który przyciąga spojrzenia.', 190.99, 238, 0),
(745, 2, 8, 1, 'Solidny Model', 'Nowoczesny design, który przyciąga spojrzenia.', 85.99, 385, 0),
(746, 3, 3, 1, 'Funkcjonalny Egzemplarz', 'Sprawdzony w trudnych warunkach pogodowych.', 249.99, 44, 0),
(747, 3, 6, 1, 'Wyjątkowy Akcesorium', 'Sprawdzony w trudnych warunkach pogodowych.', 79.99, 302, 0),
(748, 2, 7, 1, 'Lekki Egzemplarz', 'Nowoczesny design, który przyciąga spojrzenia.', 27.99, 63, 0),
(749, 2, 3, 1, 'Elegancki Dodatek', 'Idealny na deszczowe dni, wyróżnia się trwałością i elegancją.', 12.99, 225, 0),
(750, 2, 9, 1, 'Komfortowy Akcesorium', 'Lekki i poręczny – zawsze zmieści się w torbie.', 60.99, 357, 0),
(751, 2, 1, 1, 'Praktyczny Dodatek', 'Uniwersalny produkt dla każdego użytkownika.', 79.99, 198, 0),
(752, 2, 8, 2, 'Komfortowy Sprzęt', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 79.99, 97, 0),
(753, 2, 6, 2, 'Nowoczesny Dodatek', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 114.99, 398, 0),
(754, 2, 3, 2, 'Stylowy Wyposażenie', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 147.99, 48, 0),
(755, 1, 2, 1, 'Kolorowy Model', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 25.99, 190, 0),
(756, 1, 6, 2, 'Elegancki Wzór', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 16.99, 78, 0),
(757, 3, 6, 1, 'Nowoczesny Wzór', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 195.99, 172, 0),
(758, 3, 7, 2, 'Solidny Parasol', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 79.99, 56, 0),
(759, 3, 1, 1, 'Nowoczesny Akcesorium', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 103.99, 294, 0),
(760, 1, 9, 2, 'Nowoczesny Egzemplarz', 'Uniwersalny produkt dla każdego użytkownika.', 69.99, 189, 0),
(761, 1, 7, 2, 'Kolorowy Sprzęt', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 14.99, 293, 0),
(762, 1, 7, 1, 'Stylowy Artykuł', 'Uniwersalny produkt dla każdego użytkownika.', 105.99, 155, 0),
(763, 3, 8, 1, 'Stylowy Wzór', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 69.99, 61, 0),
(764, 1, 7, 2, 'Nowoczesny Akcesorium', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 99.99, 363, 0),
(765, 3, 1, 1, 'Nowoczesny Model', 'Uniwersalny produkt dla każdego użytkownika.', 119.99, 95, 0),
(766, 3, 4, 2, 'Komfortowy Parasol', 'Lekki i poręczny – zawsze zmieści się w torbie.', 43.99, 220, 0),
(767, 2, 7, 2, 'Elegancki Wzór', 'Nowoczesny design, który przyciąga spojrzenia.', 53.99, 280, 0),
(768, 3, 7, 1, 'Praktyczny Wyposażenie', 'Idealny na deszczowe dni, wyróżnia się trwałością i elegancją.', 144.99, 145, 0),
(769, 3, 8, 2, 'Praktyczny Sprzęt', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 79.99, 399, 0),
(770, 3, 3, 2, 'Wyjątkowy Dodatek', 'Sprawdzony w trudnych warunkach pogodowych.', 129.99, 353, 0),
(771, 2, 5, 2, 'Lekki Wzór', 'Uniwersalny produkt dla każdego użytkownika.', 195.99, 88, 0),
(772, 1, 2, 1, 'Stylowy Wzór', 'Uniwersalny produkt dla każdego użytkownika.', 39.99, 294, 0),
(773, 3, 9, 1, 'Elegancki Egzemplarz', 'Uniwersalny produkt dla każdego użytkownika.', 156.99, 391, 0),
(774, 2, 6, 1, 'Lekki Produkt', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 119.99, 392, 0),
(775, 2, 9, 1, 'Solidny Akcesorium', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 141.99, 371, 0),
(776, 2, 5, 1, 'Solidny Egzemplarz', 'Nowoczesny design, który przyciąga spojrzenia.', 69.99, 352, 0),
(777, 3, 1, 2, 'Funkcjonalny Wyposażenie', 'Uniwersalny produkt dla każdego użytkownika.', 81.99, 143, 0),
(778, 1, 1, 1, 'Nowoczesny Produkt', 'Nowoczesny design, który przyciąga spojrzenia.', 196.99, 80, 0),
(779, 3, 10, 2, 'Stylowy Akcesorium', 'Świetny wybór na prezent, łączy styl z praktycznością.', 299.99, 43, 0),
(780, 1, 1, 1, 'Wyjątkowy Egzemplarz', 'Uniwersalny produkt dla każdego użytkownika.', 94.99, 307, 0),
(781, 3, 10, 1, 'Funkcjonalny Artykuł', 'Lekki i poręczny – zawsze zmieści się w torbie.', 103.99, 345, 0),
(782, 3, 3, 1, 'Kolorowy Wyposażenie', 'Idealny na deszczowe dni, wyróżnia się trwałością i elegancją.', 19.99, 340, 0),
(783, 1, 7, 2, 'Komfortowy Model', 'Sprawdzony w trudnych warunkach pogodowych.', 91.99, 70, 0),
(784, 3, 2, 2, 'Komfortowy Wzór', 'Świetny wybór na prezent, łączy styl z praktycznością.', 119.99, 384, 0),
(785, 3, 10, 2, 'Wyjątkowy Akcesorium', 'Nowoczesny design, który przyciąga spojrzenia.', 69.99, 101, 0),
(786, 3, 4, 1, 'Solidny Akcesorium', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 299.99, 116, 0),
(787, 1, 3, 1, 'Nowoczesny Egzemplarz', 'Świetny wybór na prezent, łączy styl z praktycznością.', 28.99, 353, 0),
(788, 3, 3, 2, 'Stylowy Wyposażenie', 'Lekki i poręczny – zawsze zmieści się w torbie.', 79.99, 84, 0),
(789, 2, 7, 1, 'Solidny Wzór', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 84.99, 301, 0),
(790, 1, 4, 2, 'Funkcjonalny Dodatek', 'Nowoczesny design, który przyciąga spojrzenia.', 79.99, 310, 0),
(791, 3, 7, 1, 'Elegancki Parasol', 'Nowoczesny design, który przyciąga spojrzenia.', 119.99, 64, 0),
(792, 3, 5, 2, 'Komfortowy Akcesorium', 'Lekki i poręczny – zawsze zmieści się w torbie.', 139.99, 183, 0),
(793, 1, 8, 2, 'Lekki Sprzęt', 'Nowoczesny design, który przyciąga spojrzenia.', 71.99, 309, 0),
(794, 3, 4, 2, 'Elegancki Artykuł', 'Sprawdzony w trudnych warunkach pogodowych.', 249.99, 13, 0),
(795, 2, 1, 1, 'Elegancki Sprzęt', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 79.99, 165, 0),
(796, 3, 4, 1, 'Lekki Dodatek', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 79.99, 365, 0),
(797, 2, 5, 1, 'Lekki Model', 'Świetny wybór na prezent, łączy styl z praktycznością.', 115.99, 2, 0),
(798, 1, 3, 2, 'Funkcjonalny Wzór', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 69.99, 106, 0),
(799, 2, 1, 1, 'Praktyczny Sprzęt', 'Świetny wybór na prezent, łączy styl z praktycznością.', 192.99, 107, 0),
(800, 1, 2, 2, 'Stylowy Egzemplarz', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 12.99, 259, 0),
(801, 1, 4, 1, 'Solidny Artykuł', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 25.99, 175, 0),
(802, 3, 2, 1, 'Lekki Akcesorium', 'Świetny wybór na prezent, łączy styl z praktycznością.', 111.99, 160, 0),
(803, 1, 3, 1, 'Solidny Akcesorium', 'Nowoczesny design, który przyciąga spojrzenia.', 69.99, 47, 0),
(804, 1, 3, 2, 'Praktyczny Model', 'Świetny wybór na prezent, łączy styl z praktycznością.', 42.99, 279, 0),
(805, 1, 5, 2, 'Elegancki Wzór', 'Nowoczesny design, który przyciąga spojrzenia.', 17.99, 331, 0),
(806, 1, 7, 1, 'Komfortowy Wyposażenie', 'Lekki i poręczny – zawsze zmieści się w torbie.', 27.99, 400, 0),
(807, 3, 7, 2, 'Solidny Produkt', 'Lekki i poręczny – zawsze zmieści się w torbie.', 119.99, 21, 0),
(808, 2, 10, 1, 'Stylowy Wyposażenie', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 42.99, 27, 0),
(809, 2, 1, 1, 'Nowoczesny Wzór', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 79.99, 99, 0),
(810, 1, 10, 2, 'Wyjątkowy Model', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 69.99, 195, 0),
(811, 2, 8, 1, 'Praktyczny Parasol', 'Świetny wybór na prezent, łączy styl z praktycznością.', 119.99, 285, 0),
(812, 2, 8, 2, 'Nowoczesny Egzemplarz', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 121.99, 30, 0),
(813, 1, 8, 1, 'Funkcjonalny Dodatek', 'Sprawdzony w trudnych warunkach pogodowych.', 11.99, 51, 0),
(814, 3, 9, 2, 'Elegancki Parasol', 'Świetny wybór na prezent, łączy styl z praktycznością.', 102.99, 336, 0),
(815, 1, 9, 1, 'Wyjątkowy Wzór', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 79.99, 193, 0),
(816, 1, 9, 2, 'Elegancki Dodatek', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 119.99, 384, 0),
(817, 2, 4, 2, 'Stylowy Egzemplarz', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 126.99, 13, 0),
(818, 3, 2, 1, 'Wyjątkowy Model', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 79.99, 199, 0),
(819, 1, 10, 2, 'Stylowy Artykuł', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 119.99, 48, 0),
(820, 2, 10, 2, 'Kolorowy Produkt', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 25.99, 400, 0),
(821, 1, 9, 1, 'Kolorowy Artykuł', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 18.99, 117, 0),
(822, 2, 4, 2, 'Nowoczesny Wyposażenie', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 69.99, 137, 0),
(823, 1, 8, 2, 'Lekki Artykuł', 'Świetny wybór na prezent, łączy styl z praktycznością.', 77.99, 260, 0),
(824, 2, 2, 2, 'Kolorowy Akcesorium', 'Nowoczesny design, który przyciąga spojrzenia.', 14.99, 219, 0),
(825, 3, 6, 2, 'Komfortowy Parasol', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 130.99, 249, 0),
(826, 1, 3, 1, 'Wyjątkowy Akcesorium', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 111.99, 182, 0),
(827, 2, 7, 2, 'Solidny Wyposażenie', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 42.99, 162, 0),
(828, 2, 9, 1, 'Komfortowy Akcesorium', 'Lekki i poręczny – zawsze zmieści się w torbie.', 69.99, 133, 0),
(829, 2, 3, 1, 'Nowoczesny Parasol', 'Lekki i poręczny – zawsze zmieści się w torbie.', 69.99, 270, 0),
(830, 2, 4, 1, 'Nowoczesny Sprzęt', 'Uniwersalny produkt dla każdego użytkownika.', 199.99, 34, 0),
(831, 3, 5, 1, 'Wyjątkowy Dodatek', 'Nowoczesny design, który przyciąga spojrzenia.', 113.99, 215, 0),
(832, 1, 6, 2, 'Nowoczesny Artykuł', 'Lekki i poręczny – zawsze zmieści się w torbie.', 194.99, 43, 0),
(833, 3, 3, 1, 'Stylowy Egzemplarz', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 79.99, 27, 0),
(834, 2, 9, 2, 'Nowoczesny Wzór', 'Lekki i poręczny – zawsze zmieści się w torbie.', 69.99, 128, 0),
(835, 2, 6, 2, 'Komfortowy Parasol', 'Nowoczesny design, który przyciąga spojrzenia.', 79.99, 217, 0),
(836, 3, 1, 2, 'Funkcjonalny Produkt', 'Świetny wybór na prezent, łączy styl z praktycznością.', 69.99, 109, 0),
(837, 1, 3, 1, 'Solidny Sprzęt', 'Sprawdzony w trudnych warunkach pogodowych.', 132.99, 177, 0),
(838, 2, 7, 1, 'Solidny Wyposażenie', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 79.99, 363, 0),
(839, 1, 6, 1, 'Lekki Sprzęt', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 69.99, 334, 0),
(840, 1, 2, 2, 'Lekki Parasol', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 153.99, 341, 0),
(841, 3, 7, 2, 'Stylowy Wzór', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 69.99, 145, 0),
(842, 3, 6, 2, 'Nowoczesny Wyposażenie', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 194.99, 35, 0),
(843, 2, 4, 1, 'Lekki Parasol', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 146.99, 209, 0),
(844, 1, 8, 1, 'Kolorowy Produkt', 'Wykonany z wysokiej jakości materiałów, odporny na uszkodzenia.', 189.99, 285, 0),
(845, 1, 5, 2, 'Elegancki Sprzęt', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 79.99, 103, 0),
(846, 3, 10, 2, 'Komfortowy Akcesorium', 'Uniwersalny produkt dla każdego użytkownika.', 69.99, 155, 0),
(847, 1, 8, 1, 'Kolorowy Produkt', 'Sprawdzony w trudnych warunkach pogodowych.', 188.99, 111, 0),
(848, 2, 3, 2, 'Elegancki Wzór', 'Lekki i poręczny – zawsze zmieści się w torbie.', 156.99, 67, 0),
(849, 1, 6, 1, 'Komfortowy Akcesorium', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 79.99, 27, 0),
(850, 3, 3, 1, 'Komfortowy Dodatek', 'Nowoczesny design, który przyciąga spojrzenia.', 69.99, 16, 0),
(851, 3, 4, 1, 'Solidny Produkt', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 44.99, 131, 0),
(852, 2, 1, 2, 'Stylowy Wyposażenie', 'Sprawdzony w trudnych warunkach pogodowych.', 69.99, 268, 0),
(853, 2, 5, 2, 'Lekki Akcesorium', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 119.99, 381, 0),
(854, 1, 1, 1, 'Kolorowy Artykuł', 'Lekki i poręczny – zawsze zmieści się w torbie.', 79.99, 206, 0),
(855, 2, 6, 1, 'Praktyczny Model', 'Zapewnia doskonałą ochronę przed deszczem i wiatrem.', 79.99, 377, 0),
(856, 1, 4, 1, 'Wyjątkowy Egzemplarz', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 79.99, 328, 0),
(857, 1, 7, 1, 'Solidny Dodatek', 'Lekki i poręczny – zawsze zmieści się w torbie.', 119.99, 253, 0),
(858, 1, 6, 2, 'Wyjątkowy Sprzęt', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 159.99, 185, 0),
(859, 3, 7, 2, 'Stylowy Artykuł', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 119.99, 375, 0),
(860, 3, 10, 1, 'Solidny Sprzęt', 'Sprawdzony w trudnych warunkach pogodowych.', 49.99, 64, 0),
(861, 2, 9, 2, 'Solidny Dodatek', 'Uniwersalny produkt dla każdego użytkownika.', 79.99, 192, 0),
(862, 1, 1, 2, 'Praktyczny Akcesorium', 'Łatwy w obsłudze, otwierany jednym przyciskiem.', 92.99, 311, 0),
(863, 2, 9, 2, 'Kolorowy Parasol', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 119.99, 251, 0),
(864, 2, 8, 2, 'Wyjątkowy Akcesorium', 'Połączenie funkcjonalności z wyjątkowym wyglądem.', 69.99, 378, 0),
(865, 3, 7, 2, 'Elegancki Egzemplarz', 'Idealny na deszczowe dni, wyróżnia się trwałością i elegancją.', 79.99, 283, 0);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `product_count`
-- (See below for the actual view)
--
CREATE TABLE `product_count` (
`cat_id` int(11)
,`col_id` int(11)
,`siz_id` int(1)
,`category` varchar(45)
,`color` varchar(20)
,`size` varchar(20)
,`product_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `role`
--

CREATE TABLE `role` (
  `role_id` int(1) NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'client'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `size`
--

CREATE TABLE `size` (
  `size_id` int(1) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_id`, `name`) VALUES
(1, 'Mały'),
(2, 'Duży');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` text NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password_hash`, `role_id`) VALUES
(1, 'administrator@parasolove.pl', '7186ebfb69adb98029cce10975245bf1e6c44194', 2),
(2, 'sprzedawca@parasolove.pl', '7186ebfb69adb98029cce10975245bf1e6c44194', 2),
(3, 'jankowalski@poczta.pl', '4af8de0d0c2842f190cbcb9291541de03aa9377d', 1);

-- --------------------------------------------------------

--
-- Struktura widoku `product_count`
--
DROP TABLE IF EXISTS `product_count`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_count`  AS SELECT `c`.`category_id` AS `cat_id`, `co`.`color_id` AS `col_id`, `s`.`size_id` AS `siz_id`, `c`.`name` AS `category`, `co`.`name` AS `color`, `s`.`name` AS `size`, count(`p`.`product_id`) AS `product_count` FROM (((`product` `p` join `category` `c` on(`p`.`category_id` = `c`.`category_id`)) join `color` `co` on(`p`.`color_id` = `co`.`color_id`)) join `size` `s` on(`p`.`size_id` = `s`.`size_id`)) GROUP BY `c`.`name`, `co`.`name`, `s`.`name` ORDER BY `c`.`category_id` ASC ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeksy dla tabeli `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indeksy dla tabeli `cupon`
--
ALTER TABLE `cupon`
  ADD PRIMARY KEY (`cupon_id`);

--
-- Indeksy dla tabeli `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `cupon_id` (`cupon_id`);

--
-- Indeksy dla tabeli `ordered_item`
--
ALTER TABLE `ordered_item`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeksy dla tabeli `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indeksy dla tabeli `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeksy dla tabeli `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cupon`
--
ALTER TABLE `cupon`
  MODIFY `cupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=866;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `size_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`cupon_id`) REFERENCES `cupon` (`cupon_id`);

--
-- Constraints for table `ordered_item`
--
ALTER TABLE `ordered_item`
  ADD CONSTRAINT `ordered_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `ordered_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `color` (`color_id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `size` (`size_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
