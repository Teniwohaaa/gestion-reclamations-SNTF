<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Redirect if not logged in or doesn't have proper role
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user data
$user_name = htmlspecialchars($_SESSION['name']);
$user_initials = substr($user_name, 0, 2);
$user_role = $_SESSION['role'];
?>

<style>
/* Dashboard Header Styles */
.dashboard-header {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    background: var(--primary-color);
    padding: 0 40px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.dashboard-header-left {
    display: flex;
    align-items: center;
    gap: 24px;
}

.dashboard-logo img {
    height: 30px;
    width: auto;
}

.dashboard-header-right {
    display: flex;
    align-items: center;
    gap: 24px;
}

.notification-bell {
    position: relative;
    cursor: pointer;
}

.notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ef4444;
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: bold;
}

.user-menu-dashboard {
    position: relative;
}

.user-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    border: none;
    color: white;
    font-family: "Montserrat-Medium", sans-serif;
    font-size: 16px;
    cursor: pointer;
}

.user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: white;
    color: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.user-dropdown-dashboard {
    position: absolute;
    right: 0;
    top: 50px;
    background: white;
    min-width: 200px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border-radius: 6px;
    overflow: hidden;
    display: none;
    z-index: 1001;
}

.user-menu-dashboard:hover .user-dropdown-dashboard {
    display: block;
}

.dropdown-item {
    padding: 12px 16px;
    color: var(--primary-color);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s;
}

.dropdown-item:hover {
    background: #f3f4f6;
}

.dropdown-item img {
    width: 18px;
    height: 18px;
}

.dropdown-divider {
    height: 1px;
    background: #e5e7eb;
    margin: 4px 0;
}
</style>

<header class="dashboard-header">
    <div class="dashboard-header-left">
        <div class="dashboard-logo">
            <a href="index.php">
                <img src="images/SNTFlogo.png" alt="SNTF Logo">
            </a>
        </div>
    </div>

    <div class="dashboard-header-right">
        <div class="notification-bell">
            <img src="images/bell-icon.png" alt="Notifications" width="24">
            <div class="notification-badge">3</div>
        </div>

        <div class="user-menu-dashboard">
            <button class="user-btn">
                <div class="user-avatar"><?= $user_initials ?></div>
                <span><?= $user_name ?></span>
                <img src="images/chevron-down.png" alt="Menu" width="16">
            </button>

            <div class="user-dropdown-dashboard">
                <?php if ($user_role === 'admin'): ?>
                <a href="admin.php" class="dropdown-item">
                    <img src="images/dashboard-icon.png" alt="Dashboard">
                    Tableau de bord
                </a>
                <a href="manage-users.php" class="dropdown-item">
                    <img src="images/users-icon.png" alt="Users">
                    Gestion des utilisateurs
                </a>
                <?php elseif ($user_role === 'agent'): ?>
                <a href="agent.php" class="dropdown-item">
                    <img src="images/dashboard-icon.png" alt="Dashboard">
                    Tableau de bord
                </a>
                <a href="manage-complaints.php" class="dropdown-item">
                    <img src="images/complaints-icon.png" alt="Complaints">
                    Gestion des réclamations
                </a>
                <?php endif; ?>

                <div class="dropdown-divider"></div>

                <a href="profile.php" class="dropdown-item">
                    <img src="images/profile-icon.png" alt="Profile">
                    Mon profil
                </a>

                <a href="logout.php" class="dropdown-item">
                    <img src="images/logout-icon.png" alt="Logout">
                    Déconnexion
                </a>
            </div>
        </div>
    </div>
</header>