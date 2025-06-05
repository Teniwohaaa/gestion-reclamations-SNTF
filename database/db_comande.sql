CREATE DATABASE IF NOT EXISTS sntf_reclamations;
USE sntf_reclamations;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    role ENUM('voyageur', 'agent', 'admin') DEFAULT 'voyageur',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reclamations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    type VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    piece_jointe VARCHAR(255),
    statut ENUM('en_attente', 'en_cours', 'traitee', 'cloturee') DEFAULT 'en_attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE reclamation_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reclamation_id INT,
    user_id INT,
    commentaire TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (reclamation_id) REFERENCES reclamations(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

ALTER TABLE reclamations 
ADD COLUMN trip_date DATE,
ADD COLUMN train_number VARCHAR(50),
ADD COLUMN departure VARCHAR(100),
ADD COLUMN arrival VARCHAR(100);

CREATE INDEX idx_reclamations_user_id ON reclamations(user_id);
CREATE INDEX idx_reclamations_statut ON reclamations(statut);

INSERT INTO users (name, email, password, role) VALUES 
('Admin', 'admin@sntf.dz', SHA1('admin123'), 'admin'),
('Agent', 'agent@sntf.dz', SHA1('agent123'), 'agent');