-- Database setup script voor Kaartenbak P.J. Ros
-- Run dit script in phpMyAdmin of MySQL client

-- Maak database aan
CREATE DATABASE IF NOT EXISTS ros CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE ros;

-- Maak tabel 'kernen' aan
CREATE TABLE IF NOT EXISTS kernen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL UNIQUE,
    content LONGTEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Voeg voorbeelddata in (optioneel)
INSERT INTO kernen (title, content) VALUES
('000. Genesis', 'Genesis kaart inhoud hier...'),
('000. Registers', 'Registers kaart inhoud hier...'),
('000. Synoptici', 'Synoptici kaart inhoud hier...'),
('0000. Kernwoorden', 'Kernwoorden kaart inhoud hier...'),
('01. Gen. 01', 'Genesis 1 kaart inhoud hier...'),
('01. Gen. 01:01-02', 'Genesis 1:1-2 kaart inhoud hier...'),
('01. Gen. 01:01-03', 'Genesis 1:1-3 kaart inhoud hier...'),
('01. Gen. 01:01-04', 'Genesis 1:1-4 kaart inhoud hier...'),
('01. Gen. 01:01-19', 'Genesis 1:1-19 kaart inhoud hier...'),
('01. Gen. 01:02, 07', 'Genesis 1:2, 7 kaart inhoud hier...'),
('01. Gen. 01:04-05', 'Genesis 1:4-5 kaart inhoud hier...'),
('01. Gen. 01:09-13', 'Genesis 1:9-13 kaart inhoud hier...'),
('01. Gen. 01:14-16', 'Genesis 1:14-16 kaart inhoud hier...'),
('01. Gen. 01:20 - 02:02', 'Genesis 1:20 - 2:2 kaart inhoud hier...'),
('01. Gen. 01:24-26', 'Genesis 1:24-26 kaart inhoud hier...'),
('01. Gen. 01:26-31', 'Genesis 1:26-31 kaart inhoud hier...'),
('01. Gen. 02:01 en 02', 'Genesis 2:1-2 kaart inhoud hier...');

-- Toon de tabel
SELECT * FROM kernen;
