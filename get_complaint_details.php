<?php
session_start();
require_once 'database/db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'agent') {
    die("Unauthorized access");
}

if (!isset($_GET['id'])) {
    die("Missing complaint ID");
}

$complaint_id = $_GET['id'];

try {
    // Get complaint details
    $stmt = $conn->prepare("
        SELECT r.*, u.name as user_name, u.email as user_email 
        FROM reclamations r
        JOIN users u ON r.user_id = u.id
        WHERE r.id = ?
    ");
    $stmt->execute([$complaint_id]);
    $complaint = $stmt->fetch();

    if (!$complaint) {
        die("Complaint not found");
    }

    // Get comments
    $stmt = $conn->prepare("
        SELECT c.*, u.name as author_name 
        FROM reclamation_comments c
        JOIN users u ON c.user_id = u.id
        WHERE c.reclamation_id = ?
        ORDER BY c.created_at DESC
    ");
    $stmt->execute([$complaint_id]);
    $comments = $stmt->fetchAll();

    // Complaint types mapping
    $types = [
        'retard' => 'Retard de train',
        'proprete' => 'Propreté du train',
        'service' => 'Service à bord',
        'autre' => 'Autre problème'
    ];

    // Status mapping
    $statuses = [
        'en_attente' => 'En attente',
        'en_cours' => 'En cours',
        'traitee' => 'Résolue',
        'cloturee' => 'Clôturée'
    ];
    ?>
<link rel="stylesheet" href="Styles/style.css" />
<div class="complaint-details">
    <div class="form-group">
        <label class="form-label">Référence</label>
        <div>REC-<?= $complaint['id'] ?></div>
    </div>

    <div class="form-group">
        <label class="form-label">Client</label>
        <div><?= htmlspecialchars($complaint['user_name']) ?> (<?= htmlspecialchars($complaint['user_email']) ?>)</div>
    </div>

    <div class="form-group">
        <label class="form-label">Type</label>
        <div><?= $types[$complaint['type']] ?? $complaint['type'] ?></div>
    </div>

    <div class="form-group">
        <label class="form-label">Date</label>
        <div><?= date('d/m/Y H:i', strtotime($complaint['created_at'])) ?></div>
    </div>

    <div class="form-group">
        <label class="form-label">Statut</label>
        <div><?= $statuses[$complaint['statut']] ?? $complaint['statut'] ?></div>
    </div>

    <div class="form-group">
        <label class="form-label">Description</label>
        <div style="padding: 8px; background: #f9fafb; border-radius: 4px;">
            <?= nl2br(htmlspecialchars($complaint['description'])) ?>
        </div>
    </div>

    <?php if ($complaint['piece_jointe']): ?>
    <div class="form-group">
        <label class="form-label">Pièce jointe</label>
        <div>
            <a href="<?= htmlspecialchars($complaint['piece_jointe']) ?>" target="_blank">Voir le fichier</a>
        </div>
    </div>
    <?php endif; ?>

    <div class="form-group">
        <label class="form-label">Historique des commentaires</label>
        <div style="max-height: 200px; overflow-y: auto; border: 1px solid #e5e7eb; border-radius: 4px; padding: 8px;">
            <?php if (count($comments) > 0): ?>
            <?php foreach ($comments as $comment): ?>
            <div style="margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #f3f4f6;">
                <div style="font-weight: 500;"><?= htmlspecialchars($comment['author_name']) ?></div>
                <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px;">
                    <?= date('d/m/Y H:i', strtotime($comment['created_at'])) ?>
                </div>
                <div><?= nl2br(htmlspecialchars($comment['commentaire'])) ?></div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div style="color: #6b7280; text-align: center;">Aucun commentaire</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php } catch (PDOException $e) {
    error_log("Error fetching complaint details: " . $e->getMessage());
    echo "<div class='alert alert-error'>Erreur lors du chargement des détails</div>";
}
?>