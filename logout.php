<!--  on va faire le logout -->
<?php
session_start();
// Unset all session variables
session_unset();
// Destroy the session
session_destroy();
// Add after session_destroy();
header("Location: login.php");
exit();
?>