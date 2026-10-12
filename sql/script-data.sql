USE touche_pas_klaxon;

-- Agences
INSERT INTO agence (nom) VALUES
('Paris'),
('Lyon'),
('Marseille'),
('Toulouse'),
('Nice'),
('Nantes'),
('Strasbourg'),
('Montpellier'),
('Bordeaux'),
('Lille'),
('Rennes'),
('Reims');

-- Utilisateurs (mot de passe = "password")
INSERT INTO utilisateur (nom, prenom, email, telephone, mot_de_passe, role) VALUES
('Martin', 'Alexandre', 'alexandre.martin@email.fr', '0612345678', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Dubois', 'Sophie', 'sophie.dubois@email.fr', '0698765432', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Bernard', 'Julien', 'julien.bernard@email.fr', '0622446688', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Moreau', 'Camille', 'camille.moreau@email.fr', '0611223344', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Lefèvre', 'Lucie', 'lucie.lefevre@email.fr', '0777889900', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Leroy', 'Thomas', 'thomas.leroy@email.fr', '0655443322', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Roux', 'Chloé', 'chloe.roux@email.fr', '0633221199', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Petit', 'Maxime', 'maxime.petit@email.fr', '0766778899', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Garnier', 'Laura', 'laura.garnier@email.fr', '0688776655', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Dupuis', 'Antoine', 'antoine.dupuis@email.fr', '0744556677', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Lefebvre', 'Emma', 'emma.lefebvre@email.fr', '0699887766', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Fontaine', 'Louis', 'louis.fontaine@email.fr', '0655667788', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Chevalier', 'Clara', 'clara.chevalier@email.fr', '0788990011', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Robin', 'Nicolas', 'nicolas.robin@email.fr', '0644332211', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Gauthier', 'Marine', 'marine.gauthier@email.fr', '0677889922', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Fournier', 'Pierre', 'pierre.fournier@email.fr', '0722334455', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Girard', 'Sarah', 'sarah.girard@email.fr', '0688665544', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Lambert', 'Hugo', 'hugo.lambert@email.fr', '0611223366', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Masson', 'Julie', 'julie.masson@email.fr', '0733445566', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Henry', 'Arthur', 'arthur.henry@email.fr', '0666554433', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Admin', 'Admin', 'admin@email.fr', '0600000000', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Quelques trajets d'exemple (dates dans le futur)
INSERT INTO trajet (id_utilisateur, id_agence_depart, id_agence_arrivee, date_heure_depart, date_heure_arrivee, places_total, places_dispo) VALUES
(1, 1, 2, '2026-10-15 08:00:00', '2026-10-15 12:00:00', 4, 3),
(2, 2, 3, '2026-10-16 09:30:00', '2026-10-16 14:00:00', 3, 2),
(3, 1, 4, '2026-10-17 07:00:00', '2026-10-17 13:30:00', 4, 4),
(4, 5, 1, '2026-10-18 10:00:00', '2026-10-18 16:00:00', 2, 1),
(5, 3, 6, '2026-10-20 08:30:00', '2026-10-20 15:00:00', 3, 3);