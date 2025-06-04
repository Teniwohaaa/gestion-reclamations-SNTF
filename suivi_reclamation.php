<?php include 'includes/header.php'; ?>

<div class="complaint-tracking">
    <div class="hero-section">
        <div class="container">
            <h1>Suivi de Réclamation</h1>
            <p>Consultez l'état de votre réclamation et les notifications</p>
        </div>
    </div>

    <div class="container main-content">
        <div class="search-section card">
            <h2>Rechercher votre réclamation</h2>
            <p class="description">Entrez votre numéro de référence pour suivre l'état de votre réclamation</p>

            <form class="search-form">
                <div class="form-group">
                    <label for="reference">Numéro de référence</label>
                    <input type="text" id="reference" placeholder="Ex: REC-2023-12345">
                </div>
                <button type="submit" class="btn primary">Rechercher</button>
            </form>
        </div>

        <div class="complaint-details card">
            <div class="header">
                <h2>Détails de la réclamation</h2>
                <span class="status-badge">En traitement</span>
            </div>

            <div class="reference-info">
                <div class="info-row">
                    <span class="label">Numéro de référence:</span>
                    <span class="value">REC-2023-12345</span>
                </div>
                <div class="info-row">
                    <span class="label">Date de soumission:</span>
                    <span class="value">15/11/2023</span>
                </div>
                <div class="info-row">
                    <span class="label">Type de réclamation:</span>
                    <span class="value">Retard de train</span>
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
                            <span class="date">15/11/2023 à 14:32</span>
                            <p>Votre réclamation a été reçue et enregistrée dans notre système.</p>
                        </div>
                    </div>

                    <div class="step completed">
                        <div class="step-marker">
                            <svg class="check-icon" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                            </svg>
                        </div>
                        <div class="step-content">
                            <h4>En cours d'analyse</h4>
                            <span class="date">16/11/2023 à 09:15</span>
                            <p>Votre réclamation est en cours d'analyse par notre service client.</p>
                        </div>
                    </div>

                    <div class="step active">
                        <div class="step-marker">3</div>
                        <div class="step-content">
                            <h4>Examen approfondi</h4>
                            <span class="date">En attente</span>
                            <p>Votre réclamation sera examinée par le service concerné.</p>
                        </div>
                    </div>

                    <div class="step">
                        <div class="step-marker">4</div>
                        <div class="step-content">
                            <h4>Résolution</h4>
                            <span class="date">En attente</span>
                            <p>Votre réclamation sera résolue et une réponse vous sera communiquée.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="notifications card">
            <h2>Notifications</h2>

            <div class="notification-list">
                <div class="notification">
                    <div class="notification-header">
                        <div class="left">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z" />
                            </svg>
                            <span class="type">Message du service client</span>
                        </div>
                        <span class="date">16/11/2023 à 09:15</span>
                    </div>
                    <div class="notification-content">
                        Bonjour, nous avons bien reçu votre réclamation concernant le retard du train n°1234. Notre
                        équipe analyse actuellement les circonstances de cet incident. Nous reviendrons vers vous dans
                        les plus brefs délais.
                    </div>
                </div>

                <div class="notification">
                    <div class="notification-header">
                        <div class="left">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                <path
                                    d="M12 17c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1s-1 .45-1 1v4c0 .55.45 1 1 1zm-1-8h2v2h-2z" />
                            </svg>
                            <span class="type">Mise à jour de statut</span>
                        </div>
                        <span class="date">15/11/2023 à 14:32</span>
                    </div>
                    <div class="notification-content">
                        Votre réclamation a été enregistrée avec succès. Un numéro de référence REC-2023-12345 vous a
                        été attribué. Veuillez conserver ce numéro pour suivre l'évolution de votre dossier.
                    </div>
                </div>
            </div>
        </div>

        <div class="response card">
            <h2>Ajouter un commentaire</h2>
            <p class="description">Vous pouvez ajouter des informations complémentaires à votre réclamation</p>

            <form class="response-form">
                <div class="form-group">
                    <label for="comment">Votre commentaire</label>
                    <textarea id="comment" rows="5" placeholder="Écrivez votre commentaire ici..."></textarea>
                </div>

                <div class="form-group">
                    <label>Pièces jointes (optionnel)</label>
                    <div class="upload-area">
                        <svg class="upload-icon" viewBox="0 0 24 24">
                            <path
                                d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z" />
                        </svg>
                        <span>Cliquez ou glissez des fichiers ici</span>
                        <input type="file" class="file-input">
                    </div>
                </div>

                <button type="submit" class="btn primary">Envoyer</button>
            </form>
        </div>

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
</div>

<?php include 'includes/footer.php'; ?>

<style>
/* === Variables === */
:root {
    --primary-color: #184c7c;
    --primary-light: #00529b;
    --secondary-color: #3182ce;
    --white: #ffffff;
    --bg-light: #f9fafb;
    --border-color: #e5e7eb;
    --text-dark: #111827;
    --text-medium: #4b5563;
    --text-light: #6b7280;
    --success-color: #166534;
    --success-bg: #dcfce7;
}

/* === Base Styles === */
.complaint-tracking {
    font-family: "Montserrat", sans-serif;
    color: var(--text-dark);
    background: var(--white);
    min-height: 100vh;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.card {
    background: var(--white);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 32px;
    margin-bottom: 24px;
}

h1,
h2,
h3,
h4 {
    color: var(--primary-color);
    font-weight: 700;
    margin: 0 0 16px 0;
}

h1 {
    font-size: 2.5rem;
    line-height: 1.2;
}

h2 {
    font-size: 1.75rem;
}

h3 {
    font-size: 1.5rem;
}

h4 {
    font-size: 1.25rem;
}

p,
.description {
    color: var(--text-medium);
    font-size: 1rem;
    line-height: 1.5;
    margin: 0 0 16px 0;
}

/* === Hero Section === */
.hero-section {
    background: linear-gradient(270deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: var(--white);
    padding: 80px 0;
    text-align: center;
}

.hero-section h1,
.hero-section p {
    color: var(--white);
}

/* === Form Styles === */
.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: var(--text-medium);
}

input[type="text"],
textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid var(--border-color);
    border-radius: 6px;
    background: var(--bg-light);
    font-family: inherit;
    font-size: 1rem;
}

textarea {
    min-height: 120px;
    resize: vertical;
}

/* === Buttons === */
.btn {
    display: inline-block;
    padding: 12px 24px;
    border-radius: 6px;
    font-weight: 600;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
}

.btn.primary {
    background: var(--primary-color);
    color: var(--white);
}

.btn.primary:hover {
    background: var(--primary-light);
}

/* === Status Badge === */
.status-badge {
    background: var(--success-bg);
    color: var(--success-color);
    padding: 4px 12px;
    border-radius: 16px;
    font-weight: 500;
    font-size: 0.875rem;
}

/* === Reference Info === */
.reference-info {
    background: var(--bg-light);
    border-radius: 6px;
    padding: 16px;
    margin-bottom: 24px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid var(--border-color);
}

.info-row:last-child {
    border-bottom: none;
}

.label {
    color: var(--text-medium);
    font-weight: 500;
}

.value {
    color: var(--text-dark);
    font-weight: 600;
}

/* === Timeline === */
.timeline {
    position: relative;
    padding-left: 24px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 12px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: var(--border-color);
}

.step {
    position: relative;
    padding-bottom: 24px;
    padding-left: 32px;
}

.step:last-child {
    padding-bottom: 0;
}

.step-marker {
    position: absolute;
    left: -24px;
    top: 0;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
}

.step.completed .step-marker {
    background: var(--primary-color);
    color: var(--white);
}

.step.active .step-marker {
    background: var(--white);
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
    font-weight: 600;
}

.step:not(.completed):not(.active) .step-marker {
    background: var(--border-color);
    color: var(--text-light);
}

.check-icon {
    width: 16px;
    height: 16px;
    fill: currentColor;
}

.step-content {
    padding-top: 4px;
}

.step-date {
    color: var(--text-light);
    font-size: 0.875rem;
    margin-bottom: 8px;
    display: block;
}

/* === Notifications === */
.notification {
    background: var(--bg-light);
    border-radius: 6px;
    padding: 16px;
    margin-bottom: 16px;
}

.notification:last-child {
    margin-bottom: 0;
}

.notification-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.left {
    display: flex;
    align-items: center;
}

.icon {
    width: 20px;
    height: 20px;
    margin-right: 12px;
    fill: var(--primary-color);
}

.notification-type {
    font-weight: 600;
    color: var(--primary-color);
}

.notification-date {
    color: var(--text-light);
    font-size: 0.875rem;
}

.notification-content {
    color: var(--text-medium);
    font-size: 0.875rem;
    line-height: 1.5;
}

/* === File Upload === */
.upload-area {
    border: 2px dashed var(--border-color);
    border-radius: 6px;
    padding: 24px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.upload-area:hover {
    border-color: var(--primary-color);
}

.upload-icon {
    width: 24px;
    height: 24px;
    margin-bottom: 8px;
    fill: var(--text-light);
}

.file-input {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: 0;
    cursor: pointer;
}

/* === Help Section === */
.help-section {
    background: #f0f9ff;
}

.help-section .header {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
}

.help-icon {
    width: 24px;
    height: 24px;
    margin-right: 12px;
    fill: var(--primary-color);
}

.header-sntf {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    background: var(--primary-color);
    padding: 0 40px 0 60px;
    height: 50px;
}

.navbar {

    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0;
    height: 100%;
}

.logo img {
    height: 30px;
    width: auto;
    margin: 0;
}

.navbar-links ul {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 32px;
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
}

.navbar-links a:hover {
    color: var(--primary-light);
    text-decoration: none;
    background: var(--white);
    border-radius: 4px;
}
</style>