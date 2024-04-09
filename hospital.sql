-- Table pour stocker les informations des patients
CREATE TABLE Patients (
    patient_id SERIAL PRIMARY KEY,
    nom VARCHAR(100),
    code_3_lettres VARCHAR(3),
    gravite_blessure VARCHAR(50),
    heure_arrivee TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table pour stocker les informations des administrateurs
CREATE TABLE Admins (
    admin_id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password_hash VARCHAR(100) -- Stockage du hash du mot de passe
);

-- Table pour stocker les informations des utilisateurs
CREATE TABLE Utilisateurs (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password_hash VARCHAR(100) -- Stockage du hash du mot de passe
);

-- Ajouter un administrateur avec un mot de passe haché
INSERT INTO Admins (username, password_hash) VALUES ('admin1', crypt('motdepasse', gen_salt('bf')));

-- Table pour enregistrer les activités de connexion et d'actions des utilisateurs
CREATE TABLE Logs (
    log_id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES Admins(admin_id) ON DELETE CASCADE, -- Référence à l'utilisateur connecté
    action VARCHAR(100),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
