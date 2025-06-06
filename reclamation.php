<?php
/**
 * Gestion des réclamations SNTF
 * 
 * Ce script gère le système de réclamations pour la SNTF, permettant aux utilisateurs
 * de soumettre leurs plaintes concernant les services ferroviaires.
 *
 * @package SNTF
 * @subpackage Reclamations
 * @author SNTF Dev Team
 * @version 1.0
 */

session_start();
require 'database/db_connect.php';

/**
 * Traitement du formulaire de réclamation
 * 
 * Gère la soumission du formulaire incluant:
 * - La validation des données
 * - L'upload de fichiers
 * - La création d'utilisateur si nécessaire
 * - L'enregistrement de la réclamation
 *
 * @param array $_POST Les données du formulaire
 * @param array $_FILES Les fichiers uploadés
 * @return void
 */
if(isset($_POST['submit'])){
    if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['phone']) && 
        isset($_POST['tripDate']) && isset($_POST['trainNumber']) && isset($_POST['departure']) && 
        isset($_POST['arrival']) && isset($_POST['complaintType']) && isset($_POST['description'])) {
        
        // Sanitize inputs
        $firstName = htmlspecialchars(trim($_POST['firstName']));
        $lastName = htmlspecialchars(trim($_POST['lastName']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $phone = htmlspecialchars(trim($_POST['phone']));
        $tripDate = $_POST['tripDate'];
        $trainNumber = htmlspecialchars(trim($_POST['trainNumber']));
        $departure = htmlspecialchars(trim($_POST['departure']));
        $arrival = htmlspecialchars(trim($_POST['arrival']));
        $complaintType = htmlspecialchars(trim($_POST['complaintType']));
        $description = htmlspecialchars(trim($_POST['description']));
        
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $pieceJointe = null;

        // Handle file upload
        if (!empty($_FILES['fileUpload']['name'])) {
            $uploadDir = 'uploads/reclamations/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $fileName = time() . '_' . basename($_FILES['fileUpload']['name']);
            $targetPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $targetPath)) {
                $pieceJointe = $targetPath;
            }
        }

        if ($userId === null) {
            // For non-logged-in users
            if (empty($firstName) || empty($lastName) || empty($email) || empty($tripDate) || 
                empty($trainNumber) || empty($departure) || empty($arrival) || 
                empty($complaintType) || empty($description)) {
                echo "Veuillez remplir tous les champs requis.";
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "L'adresse email n'est pas valide.";
                exit;
            }

            // Check if email exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $userId = $stmt->fetchColumn();
            } else {
                // Create new user with default password
                try {
                    $hashedPassword = password_hash('default_password', PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users (name, email, password, phone, role) VALUES (?, ?, ?, ?, 'voyageur')";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$firstName.' '.$lastName, $email, $hashedPassword, $phone]);
                    $userId = $conn->lastInsertId();
                } catch (PDOException $e) {
                    echo "Erreur lors de l'enregistrement de l'utilisateur: " . $e->getMessage();
                    exit;
                }
                
                // Create session for new user
                $_SESSION['user_id'] = $userId;
                $_SESSION['name'] = $firstName . ' ' . $lastName;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = 'voyageur';
                $_SESSION['phone'] = $phone;
            }
        }

        try {
            if ($userId) {
                $sql = "INSERT INTO reclamations (user_id, trip_date, train_number, departure, arrival, type, description, piece_jointe) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$userId, $tripDate, $trainNumber, $departure, $arrival, $complaintType, $description, $pieceJointe]);
            } else {
                $sql = "INSERT INTO reclamations (trip_date, train_number, departure, arrival, type, description, piece_jointe) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$tripDate, $trainNumber, $departure, $arrival, $complaintType, $description, $pieceJointe]);
            }
            
            // Get the reclamation ID for redirection
            $reclamationId = $conn->lastInsertId();
            $_SESSION['last_reclamation_id'] = $reclamationId;
            
            header("Location: suivi_reclamation.php?id=" . $reclamationId);
            exit;
        } catch (PDOException $e) {
            echo "Erreur lors de l'enregistrement de la réclamation: " . $e->getMessage();
            exit;
        }
    }
}

/**
 * Fonction pour valider et nettoyer les entrées utilisateur
 *
 * @param string $data Donnée à nettoyer
 * @return string Donnée nettoyée
 */
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme de Réclamation SNTF</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Styles/reclamation.css">
</head>

<body>
    <div class="node-1">
        <?php include 'includes/header.php'; ?>
        <div class="hero-11">
            <h1>Plateforme de Réclamation</h1>
            <p>Nous sommes à votre écoute pour améliorer nos services</p>
        </div>

        <div class="content-14">
            <form class="form-container-15" action="reclamation.php" method="post" id="complaintForm"
                enctype="multipart/form-data">
                <h2>Soumettre une réclamation</h2>

                <?php if (!isset($_SESSION['user_id'])): ?>
                <div class="form-section">
                    <h3>Informations personnelles</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">Prénom</label>
                            <input type="text" id="firstName" name="firstName" class="form-control"
                                placeholder="Votre prénom" required>
                        </div>

                        <div class="form-group">
                            <label for="lastName">Nom</label>
                            <input type="text" id="lastName" name="lastName" class="form-control"
                                placeholder="Votre nom" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="exemple@email.com" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Téléphone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="0X XX XX XX XX">
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <input type="hidden" name="email" value="<?= htmlspecialchars($_SESSION['email']) ?>">
                <p class="logged-in-message">Vous êtes connecté en tant que
                    <?= htmlspecialchars($_SESSION['name']) ?></p>
                <?php endif; ?>

                <div class="form-section">
                    <h3>Détails de la réclamation</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="tripDate">Date du voyage</label>
                            <input type="date" id="tripDate" name="tripDate" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="trainNumber">Numéro du train</label>
                            <input type="text" id="trainNumber" name="trainNumber" class="form-control"
                                placeholder="Ex: 1234" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="departure">Gare de départ</label>
                            <input type="text" id="departure" name="departure" class="form-control"
                                placeholder="Ville de départ" required>
                        </div>

                        <div class="form-group">
                            <label for="arrival">Gare d'arrivée</label>
                            <input type="text" id="arrival" name="arrival" class="form-control"
                                placeholder="Ville d'arrivée" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="complaintType">Type de réclamation</label>
                        <select id="complaintType" name="complaintType" class="form-control" required>
                            <option value="" disabled selected>Sélectionnez un type</option>
                            <option value="retard">Retard de train</option>
                            <option value="proprete">Propreté du train</option>
                            <option value="service">Service à bord</option>
                            <option value="autre">Autre problème</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Description détaillée</label>
                        <textarea id="description" name="description" class="form-control"
                            placeholder="Décrivez votre problème en détail..." required></textarea>
                    </div>

                    <div class="form-group file-upload">
                        <label>Pièces jointes (optionnel)</label>
                        <label for="fileUpload" class="file-upload-label">
                            <div class="file-upload-icon">↑</div>
                            <p>Cliquez ou glissez des fichiers ici</p>
                            <input type="file" id="fileUpload" name="fileUpload" style="display: none;" multiple>
                        </label>
                    </div>
                </div>

                <div class="submit-btn">
                    <button type="submit" name="submit" class="btn-primary">Soumettre</button>
                </div>
            </form>

            <div class="info-cards">
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon">✓</div>
                        <h3 class="card-title">Suivi de réclamation</h3>
                    </div>
                    <p class="card-text">Suivez l'état de votre réclamation en utilisant le numéro de référence qui vous
                        sera envoyé par email.</p>
                </div>

                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon">?</div>
                        <h3 class="card-title">Besoin d'aide?</h3>
                    </div>
                    <p class="card-text">Notre service client est disponible au (213) 21 71 15 10 ou par email à
                        contact@sntf.dz</p>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>

</html>