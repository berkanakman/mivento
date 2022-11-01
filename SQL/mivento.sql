-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 01 Kas 2022, 13:26:22
-- Sunucu sürümü: 8.0.31-0ubuntu0.20.04.1
-- PHP Sürümü: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `mivento`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `campaign`
--

CREATE TABLE `campaign` (
                            `id` int NOT NULL,
                            `name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
                            `date` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `employee`
--

CREATE TABLE `employee` (
                            `id` int NOT NULL,
                            `campaign_id` int NOT NULL,
                            `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `surname` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `employee_id` bigint NOT NULL,
                            `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `point` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `campaign`
--
ALTER TABLE `campaign`
    ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `employee`
--
ALTER TABLE `employee`
    ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `phone` (`phone`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `campaign`
--
ALTER TABLE `campaign`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `employee`
--
ALTER TABLE `employee`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
