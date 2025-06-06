<?php
/**
 * Script de déconnexion
 * 
 * Ce script gère la déconnexion des utilisateurs en:
 * - Détruisant la session active
 * - Redirigeant vers la page de connexion
 *
 * @package SNTF
 * @subpackage Authentication
 * @author SNTF Dev Team
 * @version 1.0
 */

session_start();

/** Vide le tableau de session */
$_SESSION = array();

/** Détruit la session */
session_destroy();

/** Redirige vers la page de connexion */
header("Location: login.php");
exit();
?>