<?php
session_start();
require 'database/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

try {
    // Get user's reclamations
    $stmt = $conn->prepare("SELECT r.*, COUNT(c.id) as comment_count 
                           FROM reclamations r
                           LEFT JOIN reclamation_comments c ON r.id = c.reclamation_id
                           WHERE r.user_id = ?
                           GROUP BY r.id
                           ORDER BY r.created_at DESC");
    $stmt->execute([$_SESSION['user_id']]);
    $reclamations = $stmt->fetchAll();

    // Get specific reclamation if ID provided
    $selectedComplaint = null;
    $comments = [];
    if (isset($_GET['id'])) {
        $stmt = $conn->prepare("SELECT * FROM reclamations WHERE id = ? AND user_id = ?");
        $stmt->execute([$_GET['id'], $_SESSION['user_id']]);
        $selectedComplaint = $stmt->fetch();
        
        if ($selectedComplaint) {
            // Get comments
            $stmt = $conn->prepare("SELECT c.*, u.name as user_name 
                                   FROM reclamation_comments c
                                   LEFT JOIN users u ON c.user_id = u.id
                                   WHERE c.reclamation_id = ?
                                   ORDER BY c.created_at DESC");
            $stmt->execute([$selectedComplaint['id']]);
            $comments = $stmt->fetchAll();
        }
    }

    // Handle comment submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
        if ($selectedComplaint) {
            $comment = trim($_POST['comment']);
            
            if (!empty($comment)) {
                $stmt = $conn->prepare("INSERT INTO reclamation_comments (reclamation_id, user_id, commentaire) VALUES (?, ?, ?)");
                $stmt->execute([$selectedComplaint['id'], $_SESSION['user_id'], $comment]);
                
                $_SESSION['success'] = "Votre commentaire a été ajouté avec succès";
                header("Location: suivi_reclamation.php?id=" . $selectedComplaint['id']);
                exit();
            }
        }
    }
} catch (PDOException $e) {
    error_log("Reclamation tracking error: " . $e->getMessage());
    $_SESSION['error'] = "Une erreur est survenue lors du chargement des données";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi de Réclamation - SNTF</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Styles/suivireclamation.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="hero-section">
        <div class="container">
            <h1>Suivi de Réclamation</h1>
            <p>Consultez l'état de votre réclamation et les notifications</p>
        </div>
    </div>

    <div class="container">
        <!-- Affichage des messages -->
        <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="search-section card">
            <h2>Rechercher votre réclamation</h2>
            <p class="description">Entrez votre numéro de référence pour suivre l'état de votre réclamation</p>

            <form class="search-form" method="GET">
                <div class="form-group">
                    <label for="reference">Numéro de référence</label>
                    <input type="text" id="reference" name="id" placeholder="Ex: 123"
                        value="<?= isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '' ?>">
                </div>
                <button type="submit" class="btn primary">Rechercher</button>
            </form>
        </div>

        <?php if ($selectedComplaint): ?>
        <!-- Détails de la réclamation sélectionnée -->
        <div class="complaint-details card">
            <div class="header">
                <h2>Détails de la réclamation</h2>
                <span class="status-badge">
                    <?= ucfirst(str_replace('_', ' ', $selectedComplaint['statut'])) ?>
                </span>
            </div>

            <div class="reference-info">
                <div class="info-row">
                    <span class="label">Numéro de référence:</span>
                    <span class="value"><?= $selectedComplaint['id'] ?></span>
                </div>
                <div class="info-row">
                    <span class="label">Date de soumission:</span>
                    <span class="value"><?= date('d/m/Y H:i', strtotime($selectedComplaint['created_at'])) ?></span>
                </div>
                <div class="info-row">
                    <span class="label">Type de réclamation:</span>
                    <span class="value">
                        <?php 
                                $types = [
                                    'retard' => 'Retard de train',
                                    'proprete' => 'Propreté du train',
                                    'service' => 'Service à bord',
                                    'autre' => 'Autre problème'
                                ];
                                echo $types[$selectedComplaint['type']] ?? $selectedComplaint['type'];
                            ?>
                    </span>
                </div>
            </div>

            <div class="progress-tracker">
                <h3>Progression de votre réclamation</h3>

                <div class="timeline">
                    <div class="step completed">
                        <div class="step-marker">
                            <svg class="check-icon" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                            </svg>
                        </div>
                        <div class="step-content">
                            <h4>Réclamation soumise</h4>
                            <span
                                class="date"><?= date('d/m/Y à H:i', strtotime($selectedComplaint['created_at'])) ?></span>
                            <p>Votre réclamation a été reçue et enregistrée dans notre système.</p>
                        </div>
                    </div>

                    <?php if ($selectedComplaint['statut'] !== 'en_attente'): ?>
                    <div class="step completed">
                        <div class="step-marker">
                            <svg class="check-icon" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                            </svg>
                        </div>
                        <div class="step-content">
                            <h4>En cours d'analyse</h4>
                            <span
                                class="date"><?= date('d/m/Y à H:i', strtotime($selectedComplaint['updated_at'])) ?></span>
                            <p>Votre réclamation est en cours d'analyse par notre service client.</p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div
                        class="step <?= in_array($selectedComplaint['statut'], ['traitee', 'cloturee']) ? 'completed' : ($selectedComplaint['statut'] === 'en_cours' ? 'active' : '') ?>">
                        <div class="step-marker">
                            <?= in_array($selectedComplaint['statut'], ['traitee', 'cloturee']) ? 
                                    '<svg class="check-icon" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>' : 
                                    '3' ?>
                        </div>
                        <div class="step-content">
                            <h4>Examen approfondi</h4>
                            <span class="date">
                                <?= in_array($selectedComplaint['statut'], ['traitee', 'cloturee']) ? 
                                        date('d/m/Y à H:i', strtotime($selectedComplaint['updated_at'])) : 
                                        'En attente' ?>
                            </span>
                            <p>Votre réclamation sera examinée par le service concerné.</p>
                        </div>
                    </div>

                    <div
                        class="step <?= $selectedComplaint['statut'] === 'cloturee' ? 'completed' : ($selectedComplaint['statut'] === 'traitee' ? 'active' : '') ?>">
                        <div class="step-marker">
                            <?= $selectedComplaint['statut'] === 'cloturee' ? 
                                    '<svg class="check-icon" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>' : 
                                    '4' ?>
                        </div>
                        <div class="step-content">
                            <h4>Résolution</h4>
                            <span class="date">
                                <?= $selectedComplaint['statut'] === 'cloturee' ? 
                                        date('d/m/Y à H:i', strtotime($selectedComplaint['updated_at'])) : 
                                        'En attente' ?>
                            </span>
                            <p>Votre réclamation sera résolue et une réponse vous sera communiquée.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="notifications card">
            <h2>Notifications</h2>

            <div class="notification-list">
                <?php if (count($comments) > 0): ?>
                <?php foreach ($comments as $comment): ?>
                <div class="notification">
                    <div class="notification-header">
                        <div class="left">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z" />
                            </svg>
                            <span class="notification-type">
                                <?= $comment['agent_name'] ? 'Message de ' . htmlspecialchars($comment['agent_name']) : 'Votre commentaire' ?>
                            </span>
                        </div>
                        <span
                            class="notification-date"><?= date('d/m/Y à H:i', strtotime($comment['created_at'])) ?></span>
                    </div>
                    <div class="notification-content">
                        <?= nl2br(htmlspecialchars($comment['commentaire'])) ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <p>Aucune notification pour le moment.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="response card">
            <h2>Ajouter un commentaire</h2>
            <p class="description">Vous pouvez ajouter des informations complémentaires à votre réclamation</p>

            <form class="response-form" method="POST">
                <div class="form-group">
                    <label for="comment">Votre commentaire</label>
                    <textarea id="comment" name="comment" rows="5" placeholder="Écrivez votre commentaire ici..."
                        required></textarea>
                </div>

                <button type="submit" class="btn primary">Envoyer</button>
            </form>
        </div>
        <?php elseif (count($reclamations) > 0): ?>
        <!-- Liste des réclamations si aucune sélectionnée -->
        <div class="card">
            <h2>Vos Réclamations</h2>
            <table>
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reclamations as $reclamation): ?>
                    <tr>
                        <td><?= $reclamation['id'] ?></td>
                        <td>
                            <?php 
                                    $types = [
                                        'retard' => 'Retard',
                                        'proprete' => 'Propreté',
                                        'service' => 'Service',
                                        'autre' => 'Autre'
                                    ];
                                    echo $types[$reclamation['type']] ?? $reclamation['type'];
                                ?>
                        </td>
                        <td><?= date('d/m/Y', strtotime($reclamation['created_at'])) ?></td>
                        <td>
                            <span class="status-badge">
                                <?= ucfirst(str_replace('_', ' ', $reclamation['statut'])) ?>
                            </span>
                        </td>
                        <td>
                            <a href="suivi_reclamation.php?id=<?= $reclamation['id'] ?>" class="btn primary">Voir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="card">
            <h2>Vos Réclamations</h2>
            <p>Vous n'avez aucune réclamation pour le moment.</p>
        </div>
        <?php endif; ?>

        <div class="help-section card">
            <div class="header">
                <svg class="help-icon" viewBox="0 0 24 24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z" />
                </svg>
                <h3>Besoin d'aide?</h3>
            </div>
            <p>Si vous avez des questions concernant votre réclamation, n'hésitez pas à contacter notre service client
                au 021 XX XX XX (du lundi au vendredi, de 8h à 17h) ou par email à reclamations@sntf.dz</p>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>