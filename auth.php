<?php
session_start();
require 'database/db_connect.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $_SESSION['error'] = "Veuillez remplir tous les champs";
        header("Location: login.php");
        exit();
    }

    $email = trim($_POST['email']);
    $password = sha1($_POST['password']); 

    try {
        $stmt = $conn->prepare("SELECT id, name, email, role FROM users WHERE email = ? AND password = ?");
        $stmt->execute([$email, $password]);
        
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch();
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            
            switch ($user['role']) {
                case 'admin':
                    header("Location: admin.php");
                    break;
                case 'agent':
                    header("Location: agent.php");
                    break;
                default:
                    header("Location: index.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Email ou mot de passe incorrect";
            header("Location: login.php");
            exit();
        }
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        $_SESSION['error'] = "Une erreur est survenue";
        header("Location: login.php");
        exit();
    }
}

header("Location: login.php");
exit();
?>