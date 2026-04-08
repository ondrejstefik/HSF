CREATE DATABASE IF NOT EXISTS hsf_catalog CHARACTER SET utf8mb4 COLLATE utf8mb4_slovak_ci;
USE hsf_catalog;

CREATE TABLE IF NOT EXISTS produkty (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nazov VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL,
    kategoria VARCHAR(100) NOT NULL,
    kratky_popis VARCHAR(255) NOT NULL,
    popis TEXT NOT NULL,
    material VARCHAR(150) NOT NULL,
    rozmery VARCHAR(100) NOT NULL,
    cena_od DECIMAL(10,2) NOT NULL,
    hlavny_obrazok VARCHAR(255) DEFAULT NULL,
    aktivny TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS moridla (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nazov VARCHAR(100) NOT NULL,
    hex_farba VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS produkt_moridla (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produkt_id INT NOT NULL,
    moridlo_id INT NOT NULL,
    FOREIGN KEY (produkt_id) REFERENCES produkty(id) ON DELETE CASCADE,
    FOREIGN KEY (moridlo_id) REFERENCES moridla(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS spravy (
    id INT AUTO_INCREMENT PRIMARY KEY,
    meno VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    sprava TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO produkty (nazov, slug, kategoria, kratky_popis, popis, material, rozmery, cena_od, hlavny_obrazok, aktivny) VALUES
('Dubový jedálenský stôl Orava', 'dubovy-jedalensky-stol-orava', 'Stoly', 'Masívny jedálenský stôl vhodný do moderného aj rustikálneho interiéru.', 'Jedálenský stôl z dubového masívu s dôrazom na pevnosť, prirodzenú kresbu dreva a poctivé remeselné spracovanie.', 'Dubový masív', '180 x 90 x 75 cm', 890.00, 'stol-orava.jpg', 1),
('Konferenčný stolík Tatran', 'konferencny-stolik-tatran', 'Stolíky', 'Elegantný konferenčný stolík s jemne zaoblenými hranami.', 'Konferenčný stolík vhodný do obývacej izby. Kombinuje jednoduchý tvar, ručné opracovanie a nadčasový vzhľad.', 'Bukový masív', '110 x 60 x 45 cm', 340.00, 'stolik-tatran.jpg', 1),
('Komoda Liptov', 'komoda-liptov', 'Komody', 'Praktická komoda s dostatkom úložného priestoru.', 'Komoda z masívu so zásuvkami a dvierkami. Vhodná do spálne, obývačky aj predsiene.', 'Dubový masív', '140 x 45 x 85 cm', 760.00, 'komoda-liptov.jpg', 1),
('Nočný stolík Fatra', 'nocny-stolik-fatra', 'Nočné stolíky', 'Jednoduchý a elegantný nočný stolík do spálne.', 'Nočný stolík s praktickou zásuvkou a odkladacím priestorom. Minimalistický vzhľad a kvalitné opracovanie.', 'Smrekový masív', '50 x 40 x 55 cm', 170.00, 'nocny-stolik-fatra.jpg', 1),
('Lavica Horec', 'lavica-horec', 'Lavice', 'Masívna lavica vhodná do predsiene alebo jedálne.', 'Ručne vyrábaná lavica s pevným sedákom a výraznou kresbou dreva.', 'Dubový masív', '120 x 35 x 45 cm', 250.00, 'lavica-horec.jpg', 1),
('Polica Klenot', 'polica-klenot', 'Police', 'Nástenná polica s jednoduchým čistým dizajnom.', 'Praktická polica vhodná do obývacej izby, pracovne alebo chodby.', 'Bukový masív', '100 x 20 x 25 cm', 95.00, 'polica-klenot.jpg', 1);

INSERT INTO moridla (nazov, hex_farba) VALUES
('Prírodný dub', '#b88a5a'),
('Svetlý orech', '#8c6239'),
('Tmavý orech', '#5b3a29'),
('Gaštan', '#7a4e2d'),
('Eben', '#2b211c'),
('Biela lazúra', '#e9e3d8');

INSERT INTO produkt_moridla (produkt_id, moridlo_id) VALUES
(1,1),(1,2),(1,3),(1,4),
(2,1),(2,2),(2,3),
(3,1),(3,2),(3,3),(3,6),
(4,1),(4,4),(4,6),
(5,1),(5,2),(5,5),
(6,1),(6,3),(6,6);