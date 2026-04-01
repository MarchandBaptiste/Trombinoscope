-- 1. Création de la base de données
CREATE DATABASE IF NOT EXISTS `trombinoscope_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `trombinoscope_db`;

-- 2. Création de la table students
CREATE TABLE IF NOT EXISTS students (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

-- 3. Insertion de données de test (pour le premier affichage)
INSERT INTO
    `students` (`first_name`, `last_name`, `email`)
VALUES
    ('Jean', 'Dupont', 'jean.dupont@example.com'),
    ('Marie', 'Curie', 'm.curie@science.fr'),
    ('Lucas', 'Martin', 'l.martin@test.com'),
    ('Sarah', 'Connor', 's.connor@skynet.com');