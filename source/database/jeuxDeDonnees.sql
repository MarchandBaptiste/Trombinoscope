INSERT INTO Level (name) 
VALUES 
('Première année'), 
('Deuxième année');

INSERT INTO Speciality (name) 
VALUES 
('Développement Web'), 
('Réseaux et Sécurité');

INSERT INTO Class (start_date, end_date, name, level_id, speciality_id) 
VALUES 
('2025-09-01', '2026-06-30', 'Promo A - Dev', 1, 1),
('2025-09-01', '2026-06-30', 'Promo B - Réseaux', 2, 2);

INSERT INTO Student (first_name, last_name, email, slogan, photo_path, is_delegate, is_alternance, status, class_id, admin_id) 
VALUES 
('Jean', 'Dupont', 'jean.dupont@email.fr', 'Toujours à fond', '/images/students/jean.jpg', TRUE, FALSE, 'valide', 1, 1),
('Marie', 'Martin', 'marie.martin@email.fr', 'La tech avant tout', '/images/students/marie.jpg', FALSE, TRUE, 'valide', 2, 1),
('Lucas', 'Bernard', 'lucas.bernard@email.fr', 'Code is poetry', '/images/students/lucas.jpg', FALSE, FALSE, 'en_attente', 1, NULL),
('Sophie', 'Petit', 'sophie.petit@email.fr', NULL, '/images/students/sophie.jpg', TRUE, TRUE, 'refuse', 2, 1),
('Thomas', 'Robert', 'thomas.robert@email.fr', 'Objectif diplôme', '/images/students/thomas.jpg', FALSE, FALSE, 'en_attente', 1, NULL);

-- Vider les tables existantes
DELETE FROM class;
DELETE FROM speciality;
DELETE FROM level;

-- Remettre les auto-increments à zéro
ALTER TABLE level AUTO_INCREMENT = 1;
ALTER TABLE speciality AUTO_INCREMENT = 1;
ALTER TABLE class AUTO_INCREMENT = 1;

-- Niveaux
INSERT INTO level (name) VALUES ('B1');
INSERT INTO level (name) VALUES ('B2');
INSERT INTO level (name) VALUES ('B3');
INSERT INTO level (name) VALUES ('Master');

-- Spécialités
INSERT INTO speciality (name) VALUES ('Développement');
INSERT INTO speciality (name) VALUES ('Design');
INSERT INTO speciality (name) VALUES ('Marketing');

-- Classes
-- B1 (pas de spécialité, tout le monde ensemble)
INSERT INTO class (name, level_id, speciality_id, start_date, end_date) VALUES ('B1', 1, NULL, '2025-09-01', '2026-06-30');

-- B2
INSERT INTO class (name, level_id, speciality_id, start_date, end_date) VALUES ('B2 Développement', 2, 1, '2025-09-01', '2026-06-30');
INSERT INTO class (name, level_id, speciality_id, start_date, end_date) VALUES ('B2 Design', 2, 2, '2025-09-01', '2026-06-30');

-- B3
INSERT INTO class (name, level_id, speciality_id, start_date, end_date) VALUES ('B3 Développement', 3, 1, '2025-09-01', '2026-06-30');
INSERT INTO class (name, level_id, speciality_id, start_date, end_date) VALUES ('B3 Design', 3, 2, '2025-09-01', '2026-06-30');
INSERT INTO class (name, level_id, speciality_id, start_date, end_date) VALUES ('B3 Marketing', 3, 3, '2025-09-01', '2026-06-30');

-- Master
INSERT INTO class (name, level_id, speciality_id, start_date, end_date) VALUES ('Master Développement', 4, 1, '2025-09-01', '2026-06-30');
INSERT INTO class (name, level_id, speciality_id, start_date, end_date) VALUES ('Master Design', 4, 2, '2025-09-01', '2026-06-30');
INSERT INTO class (name, level_id, speciality_id, start_date, end_date) VALUES ('Master Marketing', 4, 3, '2025-09-01', '2026-06-30');