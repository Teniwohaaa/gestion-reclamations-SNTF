<!--  on va faire le logout -->
<?php
session_start();
// Unset all session variables
session_unset();
// Destroy the session
session_destroy();
?>