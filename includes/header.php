<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<link rel="stylesheet" href="Styles/style.css">
<link rel="stylesheet" href="Styles/header.css">
<header class="header-sntf">
    <div class="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="images/SNTFlogo.png" alt="SNTF Logo">
            </a>
        </div>

        <nav class="navbar-links">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#">Horaires</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="reclamation.php">Réclamation</a></li>
            </ul>
        </nav>

        <div class="user-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
            <div class="user-dropdown">
                <button class="dropbtn">
                    <img src="images/user.png" alt="User" class="icon">
                    <span><?php echo htmlspecialchars($_SESSION['name'] ?? 'Utilisateur'); ?></span>
                </button>
                <div class="dropdown-content">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'voyageur'): ?>
                    <a href="suivi_reclamation.php">
                        <img src="images/suiv-reclamation.png" alt="Suivi" class="icon">
                        Suivi Réclamation
                    </a>
                    <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'agent'): ?>
                    <a href="agent.php">
                        <img src="images/agent.png" alt="Agent" class="icon">
                        Tableau de bord
                    </a>
                    <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <a href="admin.php">
                        <img src="images/admin.png" alt="Admin" class="icon">
                        Administration
                    </a>
                    <?php endif; ?>
                    <a href="logout.php">
                        <img src="images/sign-out.png" alt="Logout" class="icon">
                        Déconnexion
                    </a>
                </div>
            </div>
            <?php else: ?>
            <a href="login.php" class="login-btn">
                <img src="images/user.png" alt="Login" class="icon">
                <span>Connexion</span>
            </a>
            <?php endif; ?>
        </div>
    </div>
</header>