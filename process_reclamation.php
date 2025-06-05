<?php
session_start();
require_once 'database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $required = ['firstName', 'lastName', 'email', 'tripDate', 'trainNumber', 'departure', 'arrival', 'complaintType', 'description'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            $_SESSION['error'] = "Veuillez remplir tous les champs obligatoires";
            header("Location: reclamation.php");
            exit();
        }
    }

    // Get form data
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone'] ?? '');
    $tripDate = $_POST['tripDate'];
    $trainNumber = trim($_POST['trainNumber']);
    $departure = trim($_POST['departure']);
    $arrival = trim($_POST['arrival']);
    $complaintType = $_POST['complaintType'];
    $description = trim($_POST['description']);
    $name = $firstName . ' ' . $lastName;

    // Handle user
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        try {
            // Check if email exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch();
                $user_id = $user['id'];
            } else {
                // Create new user with random password
                $password = sha1(uniqid());
                $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone) VALUES (?, ?, ?, ?)");
                $stmt->execute([$name, $email, $password, $phone]);
                $user_id = $conn->lastInsertId();
            }
        } catch (PDOException $e) {
            error_log("User creation error: " . $e->getMessage());
            $_SESSION['error'] = "Une erreur est survenue lors de la création du compte";
            header("Location: reclamation.php");
            exit();
        }
    }

    // Handle file upload
    $piece_jointe = null;
    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $fileName = uniqid() . '_' . basename($_FILES['fileUpload']['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $targetPath)) {
            $piece_jointe = $targetPath;
        }
    }

    // Insert reclamation
    try {
        $stmt = $conn->prepare("INSERT INTO reclamations (user_id, type, description, piece_jointe) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $complaintType, $description, $piece_jointe]);
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
        }
        $_SESSION['success'] = "Votre réclamation a été soumise avec succès! Numéro de référence: " . $conn->lastInsertId();
        header("Location: suivi_reclamation.php");
        exit();
    } catch (PDOException $e) {
        error_log("Reclamation submission error: " . $e->getMessage());
        $_SESSION['error'] = "Une erreur est survenue lors de la soumission de votre réclamation";
        header("Location: reclamation.php");
        exit();
    }
}

header("Location: reclamation.php");
exit();
?>