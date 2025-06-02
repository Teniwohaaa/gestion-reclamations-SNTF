--  nom de la base de données : sntf_reclamations

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('voyageur', 'agent', 'admin') DEFAULT 'voyageur',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reclamations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    type VARCHAR(100),
    description TEXT,
    piece_jointe VARCHAR(255),
    statut ENUM('en_attente', 'en_cours', 'traitee', 'cloturee') DEFAULT 'en_attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE reclamation_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reclamation_id INT,
    agent_id INT,
    commentaire TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (reclamation_id) REFERENCES reclamations(id) ON DELETE CASCADE,
    FOREIGN KEY (agent_id) REFERENCES users(id) ON DELETE SET NULL
);

INSERT INTO users (name, email, password, role)
VALUES 
('Admin', 'admin@sntf.dz', SHA1('admin123'), 'admin'),
('Agent', 'agent@sntf.dz', SHA1('agent123'), 'agent');