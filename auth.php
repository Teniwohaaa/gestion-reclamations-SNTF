<?php
/**
 * Script d'authentification des utilisateurs
 * 
 * Gère le processus de connexion des utilisateurs en:
 * - Vérifiant les identifiants
 * - Créant la session utilisateur
 * - Redirigeant vers la page appropriée selon le rôle
 *
 * @package SNTF
 * @subpackage Authentication
 * @author SNTF Dev Team
 * @version 1.0
 */

session_start();
require 'database/db_connect.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

/**
 * Traitement de la connexion
 * 
 * @param string $email Email de l'utilisateur
 * @param string $password Mot de passe
 * @return void
 */
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $_SESSION['error'] = "Veuillez remplir tous les champs";
        header("Location: login.php");
        exit();
    }

    /** 
     * Validation et nettoyage des identifiants
     */
    $email = trim($_POST['email']);
    $password = sha1($_POST['password']); 

    try {
        /**
         * Vérification des identifiants dans la base de données
         */
        $stmt = $conn->prepare("SELECT id, name, email, role FROM users WHERE email = ? AND password = ?");
        $stmt->execute([$email, $password]);
        
        if ($stmt->rowCount() == 1) {
            /**
             * Création de la session utilisateur
             */
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