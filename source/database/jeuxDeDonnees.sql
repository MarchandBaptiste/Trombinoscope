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