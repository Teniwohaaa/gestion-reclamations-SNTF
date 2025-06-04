<?php
  require 'database/db_connect.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme de Réclamation SNTF</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Styles/reclamation.css">
</head>

<body>
    <div class="node-1">
        <?php include 'includes/header.php'; ?>
        <div class="hero-11">
            <h1>Plateforme de Réclamation</h1>
            <p>Nous sommes à votre écoute pour améliorer nos services</p>
        </div>

        <div class="content-14">
            <form class="form-container-15" action="process_reclamation.php" method="post" id="complaintForm"
                enctype="multipart/form-data">
                <h2>Soumettre une réclamation</h2>

                <?php if (!isset($_SESSION['user'])): ?>
                <div class="form-section">
                    <h3>Informations personnelles</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">Prénom</label>
                            <input type="text" id="firstName" name="firstName" class="form-control"
                                placeholder="Votre prénom" required>
                        </div>

                        <div class="form-group">
                            <label for="lastName">Nom</label>
                            <input type="text" id="lastName" name="lastName" class="form-control"
                                placeholder="Votre nom" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="exemple@email.com" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Téléphone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="0X XX XX XX XX">
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <input type="hidden" name="email" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>">
                <p class="logged-in-message">Vous êtes connecté en tant que
                    <?= htmlspecialchars($_SESSION['user']['name']) ?></p>
                <?php endif; ?>

                <div class="form-section">
                    <h3>Détails de la réclamation</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="tripDate">Date du voyage</label>
                            <input type="date" id="tripDate" name="tripDate" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="trainNumber">Numéro du train</label>
                            <input type="text" id="trainNumber" name="trainNumber" class="form-control"
                                placeholder="Ex: 1234" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="departure">Gare de départ</label>
                            <input type="text" id="departure" name="departure" class="form-control"
                                placeholder="Ville de départ" required>
                        </div>

                        <div class="form-group">
                            <label for="arrival">Gare d'arrivée</label>
                            <input type="text" id="arrival" name="arrival" class="form-control"
                                placeholder="Ville d'arrivée" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="complaintType">Type de réclamation</label>
                        <select id="complaintType" name="complaintType" class="form-control" required>
                            <option value="" disabled selected>Sélectionnez un type</option>
                            <option value="retard">Retard de train</option>
                            <option value="proprete">Propreté du train</option>
                            <option value="service">Service à bord</option>
                            <option value="autre">Autre problème</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Description détaillée</label>
                        <textarea id="description" name="description" class="form-control"
                            placeholder="Décrivez votre problème en détail..." required></textarea>
                    </div>

                    <div class="form-group file-upload">
                        <label>Pièces jointes (optionnel)</label>
                        <label for="fileUpload" class="file-upload-label">
                            <div class="file-upload-icon">↑</div>
                            <p>Cliquez ou glissez des fichiers ici</p>
                            <input type="file" id="fileUpload" name="fileUpload" style="display: none;" multiple>
                        </label>
                    </div>
                </div>

                <div class="submit-btn">
                    <button type="submit" class="btn-primary">Soumettre</button>
                </div>
            </form>

            <div class="info-cards">
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon">✓</div>
                        <h3 class="card-title">Suivi de réclamation</h3>
                    </div>
                    <p class="card-text">Suivez l'état de votre réclamation en utilisant le numéro de référence qui vous
                        sera envoyé par email.</p>
                </div>

                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon">?</div>
                        <h3 class="card-title">Besoin d'aide?</h3>
                    </div>
                    <p class="card-text">Notre service client est disponible au 021 XX XX XX ou par email à
                        support@sntf.dz</p>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script>
    // Only show the success message if it's not coming from a redirect
    if (!window.location.search.includes('success')) {
        document.getElementById('complaintForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Client-side validation
            if (this.checkValidity()) {
                this.submit();
            } else {
                alert('Veuillez remplir tous les champs obligatoires.');
            }
        });
    }

    // Handle file upload display
    const fileUpload = document.getElementById('fileUpload');
    const fileUploadLabel = fileUpload.parentElement;

    fileUpload.addEventListener('change', function() {
        if (this.files.length > 0) {
            fileUploadLabel.querySelector('p').textContent = `${this.files.length} fichier(s) sélectionné(s)`;
        }
    });

    // Handle drag and drop
    fileUploadLabel.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileUploadLabel.style.borderColor = 'var(--text-rgb-0-82-155)';
        fileUploadLabel.style.backgroundColor = 'rgba(0, 82, 155, 0.05)';
    });

    fileUploadLabel.addEventListener('dragleave', () => {
        fileUploadLabel.style.borderColor = 'var(--border-light)';
        fileUploadLabel.style.backgroundColor = 'var(--bg-light-gray)';
    });

    fileUploadLabel.addEventListener('drop', (e) => {
        e.preventDefault();
        fileUploadLabel.style.borderColor = 'var(--border-light)';
        fileUploadLabel.style.backgroundColor = 'var(--bg-light-gray)';
        fileUpload.files = e.dataTransfer.files;
        fileUpload.dispatchEvent(new Event('change'));
    });
    </script>
</body>

</html>