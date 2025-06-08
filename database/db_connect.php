<?php
/**
 * Configuration et connexion à la base de données
 * 
 * Ce script établit la connexion à la base de données MySQL en utilisant PDO
 * et définit les paramètres de configuration essentiels.
 *
 * @package SNTF
 * @subpackage Database
 * @author SNTF Dev Team
 * @version 1.0
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 

/** 
 * Paramètres de connexion à la base de données
 */
$host = 'localhost';
$db = 'sntf_reclamations';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

/**
 * Configuration du DSN et des options PDO
 */
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

/**
 * Tentative de connexion à la base de données
 */
try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    error_log("Erruer durant la connection a la base de données: " . $e->getMessage());
    die("Une erreur est survenue. Veuillez réessayer plus tard.");
}
?>