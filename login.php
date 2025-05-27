
<?php
// login.php
session_start();

?>
<?php include 'includes/header.php'; ?>
<form action="auth.php" method="POST">
    Email: <input type="email" name="email"><br>
    Mot de passe: <input type="password" name="password"><br>
    <button type="submit">Se connecter</button>
</form>
<?php include 'includes/footer.php'; ?>