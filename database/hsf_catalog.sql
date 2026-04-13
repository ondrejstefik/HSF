-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Sun 12.Apr 2026, 17:22
-- Verzia serveru: 10.4.32-MariaDB
-- Verzia PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `hsf_catalog`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `moridla`
--

CREATE TABLE `moridla` (
  `id` int(11) NOT NULL,
  `nazov` varchar(100) NOT NULL,
  `hex_farba` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `moridla`
--

INSERT INTO `moridla` (`id`, `nazov`, `hex_farba`) VALUES
(1, 'Prírodný dub', '#b88a5a'),
(2, 'Svetlý orech', '#8c6239'),
(3, 'Tmavý orech', '#5b3a29'),
(4, 'Gaštan', '#7a4e2d'),
(5, 'Eben', '#2b211c'),
(6, 'Biela lazúra', '#e9e3d8');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazov` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `kategoria` varchar(100) NOT NULL,
  `kratky_popis` varchar(255) NOT NULL,
  `popis` text NOT NULL,
  `material` varchar(150) NOT NULL,
  `rozmery` varchar(100) NOT NULL,
  `cena_od` decimal(10,2) NOT NULL,
  `hlavny_obrazok` varchar(255) DEFAULT NULL,
  `aktivny` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `produkty`
--

INSERT INTO `produkty` (`id`, `nazov`, `slug`, `kategoria`, `kratky_popis`, `popis`, `material`, `rozmery`, `cena_od`, `hlavny_obrazok`, `aktivny`, `created_at`) VALUES
(1, 'Dubový jedálenský stôl Orava', 'dubovy-jedalensky-stol-orava', 'Stoly', 'Masívny jedálenský stôl vhodný do moderného aj rustikálneho interiéru.', 'Jedálenský stôl z dubového masívu s dôrazom na pevnosť, prirodzenú kresbu dreva a poctivé remeselné spracovanie.', 'Dubový masív', '180 x 90 x 75 cm', 890.00, 'stol-orava.webp', 1, '2026-03-30 14:21:46'),
(2, 'Konferenčný stolík Tatran', 'konferencny-stolik-tatran', 'Stolíky', 'Elegantný konferenčný stolík s jemne zaoblenými hranami.', 'Konferenčný stolík vhodný do obývacej izby. Kombinuje jednoduchý tvar, ručné opracovanie a nadčasový vzhľad.', 'Bukový masív', '110 x 60 x 45 cm', 340.00, 'stolik-tatran.webp', 1, '2026-03-30 14:21:46'),
(3, 'Komoda Liptov', 'komoda-liptov', 'Komody', 'Praktická komoda s dostatkom úložného priestoru.', 'Komoda z masívu so zásuvkami a dvierkami. Vhodná do spálne, obývačky aj predsiene.', 'Dubový masív', '140 x 45 x 85 cm', 760.00, 'komoda-liptov.webp', 1, '2026-03-30 14:21:46'),
(4, 'Nočný stolík Fatra', 'nocny-stolik-fatra', 'Nočné stolíky', 'Jednoduchý a elegantný nočný stolík do spálne.', 'Nočný stolík s praktickou zásuvkou a odkladacím priestorom. Minimalistický vzhľad a kvalitné opracovanie.', 'Smrekový masív', '50 x 40 x 55 cm', 170.00, 'nocny-stolik-fatra.webp', 1, '2026-03-30 14:21:46'),
(5, 'Lavica Horec', 'lavica-horec', 'Lavice', 'Masívna lavica vhodná do predsiene alebo jedálne.', 'Ručne vyrábaná lavica s pevným sedákom a výraznou kresbou dreva.', 'Dubový masív', '120 x 35 x 45 cm', 250.00, 'lavica-horec.webp', 1, '2026-03-30 14:21:46'),
(6, 'Polica Klenot', 'polica-klenot', 'Police', 'Nástenná polica s jednoduchým čistým dizajnom.', 'Praktická polica vhodná do obývacej izby, pracovne alebo chodby.', 'Bukový masív', '100 x 20 x 25 cm', 95.00, 'polica-klenot.webp', 1, '2026-03-30 14:21:46'),
(7, 'Stôl Tatran', 'stol-tatran', 'Stoly', 'Vhodný do jedálne, alebo predsiene.', 'Rustikálny jedálenský stôl z tvrdého masívu s dôrazom na pevnosť, prirodzenú kresbu dreva a poctivé remeselné spracovanie.', 'Dub, alebo buk', '180 x 90 x 75 cm', 1000.00, 'tatran-stol.webp', 1, '2026-04-10 09:44:20'),
(9, 'Stôl Fatran', 'stol-fatran', 'Stoly', 'Veľký jedálenský stôl s mohutnou podnožou a výrazným rustikálnym charakterom.', 'Masívny jedálenský stôl vhodný do priestranných interiérov. Vyniká pevnou konštrukciou, stabilnou mohutnou podnožou a dôrazom na prirodzenú krásu dreva. Hodí sa do tradičných aj moderných priestorov s dôrazom na poctivé remeslo.', 'Dubový masív', '200 x 100 x 76 cm', 1290.00, 'stol-fatran.webp', 1, '2026-04-10 10:09:28'),
(10, 'Stôl Kysuce', 'stol-kysuce', 'Stoly', 'Užší dlhý stôl s prirodzenou hranou a robustnými nohami.', 'Ručne vyrábaný masívny stôl s elegantne predĺženou doskou a zachovanou prirodzenou hranou dreva. Robustné nohy zabezpečujú stabilitu a výrazný remeselný vzhľad. Ideálny do jedálne, pracovne alebo reprezentatívneho priestoru.', 'Dubový masív', '180 x 85 x 76 cm', 1180.00, 'stol-kysuce.webp', 1, '2026-04-10 10:09:28'),
(11, 'Stôl Liptov', 'stol-liptov', 'Stoly', 'Masívny stôl s dvoma plnými blokovými nohami a výrazným moderným vzhľadom.', 'Pevný stôl z masívu navrhnutý s dôrazom na jednoduchosť, stabilitu a dominantný dizajn. Charakteristické dve plné blokové nohy dodávajú stolu moderný, no zároveň remeselne poctivý vzhľad. Vhodný do jedální aj štýlových kancelárií.', 'Dubový masív', '190 x 95 x 76 cm', 1350.00, 'stol-liptov.webp', 1, '2026-04-10 10:09:28'),
(12, 'Stôl Zuberec', 'stol-zuberec', 'Stoly', 'Stôl zo starých trámov so surovým povrchom a tradičným horským štýlom.', 'Autentický stôl vyrobený zo starých trámov, ktorý zachováva surovosť materiálu, prirodzenú kresbu dreva a tradičný horský charakter. Vhodný do chalúp, vidieckych interiérov aj rustikálnych priestorov, kde vynikne jeho jedinečný pôvod a remeselné spracovanie.', 'Staré drevo / dubový masív', '200 x 95 x 76 cm', 1490.00, 'stol-zuberec.webp', 1, '2026-04-10 10:09:28'),
(13, 'Vešiak Kysuce', 'vesiak-kysuce', 'Doplnky', 'Masívny drevený vešiak vhodný do predsiene.', 'Ručne vyrábaný vešiak z masívneho dreva, ideálny do chodby alebo predsiene. Kombinuje praktickosť s rustikálnym dizajnom a kvalitným spracovaním.', 'Dubový masív', '80 x 20 x 180 cm', 180.00, 'vesiak-kysuce.webp', 1, '2026-04-10 19:03:22'),
(14, 'Nočný stolík Kysuce', 'nocny-stolik-kysuce', 'Nočné stolíky', 'Elegantný nočný stolík s praktickým úložným priestorom.', 'Nočný stolík z masívneho dreva vhodný do každej spálne. Ponúka kombináciu jednoduchého dizajnu a funkčnosti s dôrazom na detail.', 'Dubový masív', '50 x 40 x 55 cm', 220.00, 'nocny-stolik-kysuce.webp', 1, '2026-04-10 19:03:22'),
(15, 'Komoda Kysuce', 'komoda-kysuce', 'Komody', 'Praktická komoda s dostatkom úložného priestoru.', 'Masívna komoda vhodná do obývačky alebo spálne. Obsahuje zásuvky a skrinky pre maximálnu praktickosť a čistý dizajn.', 'Dubový masív', '120 x 45 x 85 cm', 780.00, 'komoda-kysuce.webp', 1, '2026-04-10 19:03:22'),
(16, 'Skriňa Kysuce', 'skrina-kysuce', 'Skrine', 'Veľká masívna skriňa vhodná do spálne alebo predsiene.', 'Ručne vyrábaná skriňa z masívneho dreva s dôrazom na pevnosť, stabilitu a dlhú životnosť. Ideálna pre uskladnenie oblečenia.', 'Dubový masív', '200 x 60 x 210 cm', 1650.00, 'skrina-kysuce.webp', 1, '2026-04-10 19:03:22'),
(17, 'Postel Kysuce', 'postel-kysuce', 'Postele', 'Krásna postel z masivu', 'Táto postel bude super pre rôznorodé dospelácke aktivity spojené s vášňou a chuťou do života.', 'dub', '200x160; 200x180; 200x200;', 1020.00, 'postel-kysuce.webp', 1, '2026-04-11 05:09:27');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `produkt_moridla`
--

CREATE TABLE `produkt_moridla` (
  `id` int(11) NOT NULL,
  `produkt_id` int(11) NOT NULL,
  `moridlo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `produkt_moridla`
--

INSERT INTO `produkt_moridla` (`id`, `produkt_id`, `moridlo_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 1),
(6, 2, 2),
(7, 2, 3),
(8, 3, 1),
(9, 3, 2),
(10, 3, 3),
(11, 3, 6),
(12, 4, 1),
(13, 4, 4),
(14, 4, 6),
(15, 5, 1),
(16, 5, 2),
(17, 5, 5),
(18, 6, 1),
(19, 6, 3),
(20, 6, 6);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `spravy`
--

CREATE TABLE `spravy` (
  `id` int(11) NOT NULL,
  `meno` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `sprava` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `spravy`
--

INSERT INTO `spravy` (`id`, `meno`, `email`, `sprava`, `created_at`) VALUES
(1, 'Ondrej Štefik', 'stefik.ondrej@gmail.com', 'qweqwe', '2026-04-10 18:41:01'),
(2, 'Ondrej Štefik', 'stefik.ondrej@gmail.com', 'qweqwe', '2026-04-10 18:48:26'),
(3, 'Ondrej Štefik', 'stefik.ondrej@gmail.com', 'qweqwe', '2026-04-10 18:48:43'),
(4, 'Ondrej Štefik', 'stefik.ondrej@gmail.com', 'we12e', '2026-04-10 18:48:50');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `moridla`
--
ALTER TABLE `moridla`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `produkt_moridla`
--
ALTER TABLE `produkt_moridla`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produkt_id` (`produkt_id`),
  ADD KEY `moridlo_id` (`moridlo_id`);

--
-- Indexy pre tabuľku `spravy`
--
ALTER TABLE `spravy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `moridla`
--
ALTER TABLE `moridla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pre tabuľku `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pre tabuľku `produkt_moridla`
--
ALTER TABLE `produkt_moridla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pre tabuľku `spravy`
--
ALTER TABLE `spravy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `produkt_moridla`
--
ALTER TABLE `produkt_moridla`
  ADD CONSTRAINT `produkt_moridla_ibfk_1` FOREIGN KEY (`produkt_id`) REFERENCES `produkty` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produkt_moridla_ibfk_2` FOREIGN KEY (`moridlo_id`) REFERENCES `moridla` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
