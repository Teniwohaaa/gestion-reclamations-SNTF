<?php 
   # Database connection script 
   # on va se connecter a la base de donnees via PDO
   $host = 'localhost';
   $db = 'sntf_reclamations';
   $user = 'root';
   $pass = '';
   
   try {
       $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
   } catch (PDOException $e) {
       die("Erreur : " . $e->getMessage());
   }
   
   
?>