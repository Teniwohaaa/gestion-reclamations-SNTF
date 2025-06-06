<?php
/**
 * Interface agent pour la gestion des réclamations
 * 
 * Ce script gère l'interface agent permettant de:
 * - Visualiser les statistiques des réclamations
 * - Filtrer et rechercher les réclamations
 * - Mettre à jour le statut des réclamations
 * - Ajouter des commentaires
 *
 * @package SNTF
 * @subpackage Agent
 * @author SNTF Dev Team
 * @version 1.0
 */

require 'database/db_connect.php';

/**
 * Vérification de l'authentification et des droits d'accès
 */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'agent') {
    header("Location: login.php");
    exit();
}

// Récupération du nom de l'agent pour l'affichage
$agent_name = $_SESSION['name'];

/**
 * Récupération des statistiques du tableau de bord
 * 
 * @return array Les compteurs des différents types de réclamations
 */
try {
    // Total des réclamations
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM reclamations");
    $stmt->execute();
    $total_complaints = $stmt->fetch()['total'];

    // Réclamations en attente
    $stmt = $conn->prepare("SELECT COUNT(*) as pending FROM reclamations WHERE statut = 'en_attente'");
    $stmt->execute();
    $pending_complaints = $stmt->fetch()['pending'];

    // Réclamations résolues
    $stmt = $conn->prepare("SELECT COUNT(*) as resolved FROM reclamations WHERE statut = 'traitee'");
    $stmt->execute();
    $resolved_complaints = $stmt->fetch()['resolved'];

    // Réclamations en cours
    $stmt = $conn->prepare("SELECT COUNT(*) as in_progress FROM reclamations WHERE statut = 'en_cours'");
    $stmt->execute();
    $in_progress_complaints = $stmt->fetch()['in_progress'];
} catch (PDOException $e) {
    error_log("Error fetching statistics: " . $e->getMessage());
    $total_complaints = $pending_complaints = $resolved_complaints = $in_progress_complaints = 0;
}

/**
 * Gestion des filtres et récupération des réclamations
 * 
 * @param string $search Terme de recherche
 * @param string $status Statut des réclamations
 * @param string $type Type de réclamation
 * @return array Liste des réclamations filtrées
 */
$search = $_GET['search'] ?? '';
$status = $_GET['status'] ?? '';
$type = $_GET['type'] ?? '';

$where = [];
$params = [];

if (!empty($search)) {
    $where[] = "(r.id LIKE :search OR u.name LIKE :search OR u.email LIKE :search)";
    $params[':search'] = "%$search%";
}

if (!empty($status) && in_array($status, ['en_attente', 'en_cours', 'traitee', 'cloturee'])) {
    $where[] = "r.statut = :status";
    $params[':status'] = $status;
}

if (!empty($type)) {
    $where[] = "r.type = :type";
    $params[':type'] = $type;
}

$where_clause = $where ? "WHERE " . implode(" AND ", $where) : "";

try {
    $stmt = $conn->prepare("
        SELECT r.*, u.name as user_name, u.email as user_email 
        FROM reclamations r
        JOIN users u ON r.user_id = u.id
        $where_clause
        ORDER BY r.created_at DESC
        LIMIT 10
    ");
    
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    $stmt->execute();
    $complaints = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log("Error fetching complaints: " . $e->getMessage());
    $complaints = [];
}

/**
 * Mise à jour du statut d'une réclamation
 * 
 * @param int $complaint_id ID de la réclamation
 * @param string $status Nouveau statut
 * @param string $comment Commentaire optionnel
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complaint_id']) && isset($_POST['status'])) {
    $complaint_id = $_POST['complaint_id'];
    $status = $_POST['status'];
    $comment = $_POST['comment'] ?? '';
    
    try {
        //mis a jour du statut de la réclamation
        $stmt = $conn->prepare("UPDATE reclamations SET statut = ?, updated_at = NOW() WHERE id = ?");
        $stmt->execute([$status, $complaint_id]);
        
        // ajout d'un commentaire si fourni
        if (!empty($comment)) {
            $stmt = $conn->prepare("INSERT INTO reclamation_comments (reclamation_id, user_id, commentaire) VALUES (?, ?, ?)");
            $stmt->execute([$complaint_id, $_SESSION['user_id'], $comment]);
        }
        
        $_SESSION['success'] = "Réclamation mise à jour avec succès";
        header("Location: agent.php");
        exit();
    } catch (PDOException $e) {
        error_log("Error updating complaint: " . $e->getMessage());
        $_SESSION['error'] = "Erreur lors de la mise à jour de la réclamation";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Agent - SNTF</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Styles/style.css">
    <link rel="stylesheet" href="Styles/header.css">
    <link rel="stylesheet" href="Styles/agent.css">
</head>

<body>
    <header class=" header-sntf">
        <div class="navbar">
            <div class="logo">
                <a href="index.php">
                    <img src="images/SNTFlogo.png" alt="SNTF Logo" />
                </a>
            </div>

            <div class="user-actions">
                <div class="user-dropdown">
                    <button class="dropbtn">
                        <img src="images/user.png" alt="User" class="icon" />
                        <span>Agent</span>
                    </button>
                    <div class="dropdown-content">
                        <a href="index.php">
                            <img src="images/dasboard/acceuil.png" alt="Home" class="icon" />
                            Accueil
                        </a>
                        <a href="logout.php">
                            <img src="images/sign-out.png" alt="Logout" class="icon" />
                            Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class=" agent-backend">
        <div class="header">
            <img class="image-1" src="images/SNTFlogo.png" alt="SNTF Logo" style="height: 45px;">
            <div class="user-menu">
                <div class="avatar">
                    <div class="initials"><?= substr($agent_name, 0, 2) ?></div>
                </div>
                <div class="user-name"><?= htmlspecialchars($agent_name) ?></div>
                <a href="logout.php" style="color: white; margin-left: 16px;">Déconnexion</a>
            </div>
        </div>

        <div class="content-area">
            <div class="sidebar">
                <div class="navigation">
                    <div class="menu-principal">MENU PRINCIPAL</div>
                    <a href="agent.php" class="nav-item active">
                        <span>Tableau de bord</span>
                    </a>
                    <a href="#" class="nav-item">
                        <span>Comptes Voyageurs</span>
                    </a>
                    <a href="#" class="nav-item">
                        <span>Réclamations</span>
                    </a>
                    <a href="#" class="nav-item">
                        <span>Rapports</span>
                    </a>
                </div>
            </div>

            <div class="main-content">
                <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>

                <div class="page-header">
                    <div class="left">
                        <h1 class="page-title">Gestion des Réclamations</h1>
                        <p class="page-description">Consultez et traitez les réclamations des clients</p>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary">Exporter</button>
                    </div>
                </div>

                <div class="stats-cards">
                    <div class="stat-card">
                        <div class="card-content">
                            <div class="card-label">Total des réclamations</div>
                            <div class="card-value"><?= $total_complaints ?></div>
                            <div class="card-trend trend-up">
                                +12% ce mois
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="card-content">
                            <div class="card-label">En attente</div>
                            <div class="card-value"><?= $pending_complaints ?></div>
                            <div class="card-trend trend-down">
                                -8% ce mois
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="card-content">
                            <div class="card-label">En cours</div>
                            <div class="card-value"><?= $in_progress_complaints ?></div>
                            <div class="card-trend trend-up">
                                +24% ce mois
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="card-content">
                            <div class="card-label">Résolues</div>
                            <div class="card-value"><?= $resolved_complaints ?></div>
                            <div class="card-trend trend-up">
                                +5% ce mois
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filters">
                    <div class="filter-header">
                        <div class="left2">
                            <h3 class="filter-title">Filtres et recherche</h3>
                        </div>
                        <a href="agent.php" class="reset">Réinitialiser</a>
                    </div>

                    <form method="GET" class="filter-options">
                        <div class="filter-group">
                            <label class="filter-label">Recherche</label>
                            <input type="text" name="search" class="filter-input" placeholder="Rechercher..."
                                value="<?= htmlspecialchars($search) ?>">
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Statut</label>
                            <select name="status" class="filter-input">
                                <option value="">Tous les statuts</option>
                                <option value="en_attente" <?= $status === 'en_attente' ? 'selected' : '' ?>>En attente
                                </option>
                                <option value="en_cours" <?= $status === 'en_cours' ? 'selected' : '' ?>>En cours
                                </option>
                                <option value="traitee" <?= $status === 'traitee' ? 'selected' : '' ?>>Résolue</option>
                                <option value="cloturee" <?= $status === 'cloturee' ? 'selected' : '' ?>>Clôturée
                                </option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Type</label>
                            <select name="type" class="filter-input">
                                <option value="">Tous les types</option>
                                <option value="retard" <?= $type === 'retard' ? 'selected' : '' ?>>Retard</option>
                                <option value="proprete" <?= $type === 'proprete' ? 'selected' : '' ?>>Propreté</option>
                                <option value="service" <?= $type === 'service' ? 'selected' : '' ?>>Service</option>
                                <option value="autre" <?= $type === 'autre' ? 'selected' : '' ?>>Autre</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary" style="height: 40px;">Filtrer</button>
                        </div>
                    </form>
                </div>

                <div class="complaints-table">
                    <div class="table-header">
                        <div>#</div>
                        <div>Référence</div>
                        <div>Client</div>
                        <div>Type</div>
                        <div>Date</div>
                        <div>Statut</div>
                        <div>Actions</div>
                    </div>

                    <?php foreach ($complaints as $complaint): ?>
                    <div class="table-row">
                        <div><?= $complaint['id'] ?></div>
                        <div>REC-<?= $complaint['id'] ?></div>
                        <div>
                            <div class="client-name"><?= htmlspecialchars($complaint['user_name']) ?></div>
                            <div class="client-email"><?= htmlspecialchars($complaint['user_email']) ?></div>
                        </div>
                        <div>
                            <?php 
                                    $types = [
                                        'retard' => 'Retard',
                                        'proprete' => 'Propreté',
                                        'service' => 'Service',
                                        'autre' => 'Autre'
                                    ];
                                    echo $types[$complaint['type']] ?? $complaint['type'];
                                ?>
                        </div>
                        <div><?= date('d/m/Y', strtotime($complaint['created_at'])) ?></div>
                        <div>
                            <?php
                                    $status_classes = [
                                        'en_attente' => 'status-pending',
                                        'en_cours' => 'status-in-progress',
                                        'traitee' => 'status-resolved',
                                        'cloturee' => 'status-closed'
                                    ];
                                    $status_texts = [
                                        'en_attente' => 'En attente',
                                        'en_cours' => 'En cours',
                                        'traitee' => 'Résolue',
                                        'cloturee' => 'Clôturée'
                                    ];
                                ?>
                            <span class="status-badge <?= $status_classes[$complaint['statut']] ?>">
                                <?= $status_texts[$complaint['statut']] ?>
                            </span>
                        </div>
                        <div style="display: flex; gap: 8px;">
                            <button class="action-button view-btn" data-id="<?= $complaint['id'] ?>">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                            <button class="action-button edit-btn" data-id="<?= $complaint['id'] ?>">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <div class="table-footer">
                        <div class="pagination">
                            <button class="page-button">&lt;</button>
                            <button class="page-button active">1</button>
                            <button class="page-button">2</button>
                            <button class="page-button">3</button>
                            <button class="page-button">&gt;</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Complaint Modal -->
    <div id="complaintModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Détails de la réclamation</h3>
                <span class="close-button">&times;</span>
            </div>
            <div id="modalBody">
                <!-- Content will be loaded via AJAX -->
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Modifier la réclamation</h3>
                <span class="close-button">&times;</span>
            </div>
            <form id="editForm" method="POST">
                <input type="hidden" name="complaint_id" id="editComplaintId">

                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <select name="status" class="form-control" id="editStatus">
                        <option value="en_attente">En attente</option>
                        <option value="en_cours">En cours</option>
                        <option value="traitee">Résolue</option>
                        <option value="cloturee">Clôturée</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Commentaire</label>
                    <textarea name="comment" class="form-control" rows="4"
                        placeholder="Ajouter un commentaire..."></textarea>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 8px;">
                    <button type="button" class="btn btn-secondary close-edit-btn">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    /**
     * Gestion des modales pour les réclamations
     * 
     * Initialise les fonctionnalités des modales de visualisation
     * et de modification des réclamations
     */

    // Sélection des éléments DOM
    const modal = document.getElementById('complaintModal');
    const editModal = document.getElementById('editModal');
    const modalBody = document.getElementById('modalBody');
    const closeButtons = document.querySelectorAll('.close-button, .close-edit-btn');
    const viewButtons = document.querySelectorAll('.view-btn');
    const editButtons = document.querySelectorAll('.edit-btn');

    /**
     * Gestionnaire d'ouverture de la modale de visualisation
     * Charge les détails de la réclamation via AJAX
     */
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const complaintId = this.getAttribute('data-id');

            // Load complaint details via AJAX
            fetch(`get_complaint_details.php?id=${complaintId}`)
                .then(response => response.text())
                .then(data => {
                    modalBody.innerHTML = data;
                    modal.style.display = 'flex';
                });
        });
    });

    /**
     * Gestionnaire d'ouverture de la modale d'édition
     */
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const complaintId = this.getAttribute('data-id');
            document.getElementById('editComplaintId').value = complaintId;
            editModal.style.display = 'flex';
        });
    });

    /**
     * Gestionnaires de fermeture des modales
     */
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            modal.style.display = 'none';
            editModal.style.display = 'none';
        });
    });

    /**
     * Fermeture des modales lors d'un clic à l'extérieur
     */
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
        if (event.target === editModal) {
            editModal.style.display = 'none';
        }
    });
    </script>
</body>

</html>