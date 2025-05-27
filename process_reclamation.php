<?php
session_start();
require_once 'database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $tripDate = $_POST['tripDate'];
    $trainNumber = $_POST['trainNumber'];
    $departure = $_POST['departure'];
    $arrival = $_POST['arrival'];
    $complaintType = $_POST['complaintType'];
    $description = $_POST['description'];
    
    // Check if user is logged in
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
    } else {
        // Create new user account
        $password = sha1(uniqid()); // Generate random password
        $name = $firstName . ' ' . $lastName;
        
        try {
            // Check if email already exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $existingUser = $stmt->fetch();
            
            if ($existingUser) {
                $user_id = $existingUser['id'];
            } else {
                // Create new user
                $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone) VALUES (?, ?, ?, ?)");
                $stmt->execute([$name, $email, $password, $phone]);
                $user_id = $conn->lastInsertId();
                
                // Log the user in
                $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
                $stmt->execute([$user_id]);
                $_SESSION['user'] = $stmt->fetch();
            }
        } catch (PDOException $e) {
            die("Error creating user: " . $e->getMessage());
        }
    }
    
    // Handle file upload
    $piece_jointe = null;
    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
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
        
        $_SESSION['success'] = "Votre réclamation a été soumise avec succès!";
        header("Location: suivi_reclamation.php");
        exit();
    } catch (PDOException $e) {
        die("Error submitting reclamation: " . $e->getMessage());
    }
}
?>