<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<link rel="stylesheet" href="Styles/style.css">
<style>
/* === Header === */
.header-sntf {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    background: var(--primary-color);
    padding: 0 40px 0 60px;
    height: 80px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    height: 100%;
}

.logo img {

    height: 30px;
    width: auto;
}

.navbar-links ul {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 16px;
}

.navbar-links li {
    margin: 0;
}

.navbar-links a {
    color: var(--white);
    font-family: "Montserrat-Medium", sans-serif;
    font-size: 16px;
    line-height: 19.2px;
    font-weight: 500;
    padding: 8px 16px;
    transition: var(--transition);
    border-radius: 4px;
}

.navbar-links a:hover {
    color: var(--primary-color);
    background: var(--white);
    text-decoration: none;
}

/* User Actions - Updated to match new style */
.user-actions {
    display: flex;
    align-items: center;
    gap: 16px;
}

.login-btn,
.dropbtn {
    color: var(--white);
    font-family: "Montserrat-Medium", sans-serif;
    font-size: 16px;
    line-height: 19.2px;
    font-weight: 500;
    padding: 8px 16px;
    transition: var(--transition);
    border-radius: 4px;
    display: flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    border: none;
    cursor: pointer;
}

.login-btn:hover,
.dropbtn:hover {
    color: var(--primary-color);
    background: var(--white);
}

.login-btn img,
.dropbtn img {
    width: 20px;
    height: 20px;
}

/* Dropdown Styles - Updated */
.user-dropdown {
    position: relative;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: var(--white);
    min-width: 200px;
    box-shadow: var(--shadow);
    z-index: 1;
    border-radius: 4px;
    overflow: hidden;
}

.dropdown-content a {
    color: var(--primary-color);
    padding: 12px 16px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    transition: var(--transition);
}

.dropdown-content a:hover {
    background-color: var(--bg-light);
}

.user-dropdown:hover .dropdown-content {
    display: block;
}

.icon {
    width: 20px;
    height: 20px;
    object-fit: contain;
}
</style>

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
            <?php if (isset($_SESSION['name'])): ?>
            <div class="user-dropdown">
                <button class="dropbtn">
                    <img src="images/user.png" alt="User" class="icon">
                    <span><?php echo $_SESSION['name']; ?></span>
                </button>
                <div class="dropdown-content">
                    <?php if ($_SESSION['role'] === 'voyageur'): ?>
                    <a href="suivi_reclamation.php">
                        <img src="images/suiv-reclamation.png" alt="Suivi" class="icon">
                        Suivi Reclamation
                    </a>
                    <?php elseif ($_SESSION['role'] === 'agent'): ?>
                    <a href="agents.php">
                        <img src="images/agent.png" alt="Agent" class="icon">
                        Mes Réservations
                    </a>
                    <?php else: ?>
                    <a href="admin.php">
                        <img src="images/admin.png" alt="Admin" class="icon">
                        Mes Réservations
                    </a>
                    <?php endif; ?>
                    <a href="logout.php">
                        <img src="images/sign-out.png" alt="Logout" class="icon">
                        Se déconnecter
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