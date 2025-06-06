<?php
/**
 * Page de suivi des réclamations
 * 
 * Permet aux utilisateurs de:
 * - Rechercher une réclamation par son numéro
 * - Visualiser l'état d'avancement
 * - Consulter les notifications
 * - Ajouter des commentaires
 *
 * @package SNTF
 * @subpackage Reclamations
 * @author SNTF Dev Team
 * @version 1.0
 */

session_start();
include 'includes/header.php'; 
?>
<!DOCTYPE html>
<html lang="fr">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Suivi reclamations</title>

<link rel="stylesheet" href="Styles/suivireclamation.css">


<div class="complaint-tracking">
    <div class="hero-section">
        <div class="tracking-container">
            <h1>Suivi de Réclamation</h1>
            <p>Consultez l'état de votre réclamation et les notifications</p>
        </div>
    </div>

    <div class="tracking-container">
        <div class="search-section complaint-card">
            <div class="complaint-card-header">
                <h2 class="complaint-card-title">Rechercher votre réclamation</h2>
            </div>
            <p class="complaint-description">Entrez votre numéro de référence pour suivre l'état de votre réclamation
            </p>

            <form class="search-form">
                <div class="form-group">
                    <label for="reference" class="form-label">Numéro de référence</label>
                    <input type="text" id="reference" class="form-control" placeholder="Ex: REC-2023-12345">
                </div>
                <button type="submit" class="submit-button">Rechercher</button>
            </form>
        </div>

        <div class="complaint-details complaint-card">
            <div class="complaint-card-header">
                <h2 class="complaint-card-title">Détails de la réclamation</h2>
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
                <h3 class="progress-title">Progression de votre réclamation</h3>

                <div class="progress-steps">
                    <div class="step">
                        <div class="step-indicator">
                            <div class="circle completed">
                                <svg class="check-icon" viewBox="0 0 24 24" width="16" height="16">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"
                                        fill="currentColor" />
                                </svg>
                            </div>
                            <div class="line"></div>
                        </div>
                        <div class="step-content">
                            <h4 class="step-title">Réclamation soumise</h4>
                            <span class="step-date">15/11/2023 à 14:32</span>
                            <p class="step-description">Votre réclamation a été reçue et enregistrée dans notre système.
                            </p>
                        </div>
                    </div>

                    <div class="step">
                        <div class="step-indicator">
                            <div class="circle completed">
                                <svg class="check-icon" viewBox="0 0 24 24" width="16" height="16">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"
                                        fill="currentColor" />
                                </svg>
                            </div>
                            <div class="line"></div>
                        </div>
                        <div class="step-content">
                            <h4 class="step-title">En cours d'analyse</h4>
                            <span class="step-date">16/11/2023 à 09:15</span>
                            <p class="step-description">Votre réclamation est en cours d'analyse par notre service
                                client.</p>
                        </div>
                    </div>

                    <div class="step">
                        <div class="step-indicator">
                            <div class="circle active">3</div>
                            <div class="line pending"></div>
                        </div>
                        <div class="step-content">
                            <h4 class="step-title">Examen approfondi</h4>
                            <span class="step-date">En attente</span>
                            <p class="step-description">Votre réclamation sera examinée par le service concerné.</p>
                        </div>
                    </div>

                    <div class="step">
                        <div class="step-indicator">
                            <div class="circle pending">4</div>
                        </div>
                        <div class="step-content">
                            <h4 class="step-title">Résolution</h4>
                            <span class="step-date">En attente</span>
                            <p class="step-description">Votre réclamation sera résolue et une réponse vous sera
                                communiquée.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="notifications complaint-card">
            <div class="complaint-card-header">
                <h2 class="complaint-card-title">Notifications</h2>
            </div>

            <div class="notification-list">
                <div class="notification">
                    <div class="notification-header">
                        <div class="notification-type">
                            <svg class="icon" viewBox="0 0 24 24" width="20" height="20">
                                <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"
                                    fill="currentColor" />
                            </svg>
                            Message du service client
                        </div>
                        <span class="notification-date">16/11/2023 à 09:15</span>
                    </div>
                    <div class="notification-content">
                        Bonjour, nous avons bien reçu votre réclamation concernant le retard du train n°1234. Notre
                        équipe analyse actuellement les circonstances de cet incident. Nous reviendrons vers vous dans
                        les plus brefs délais.
                    </div>
                </div>

                <div class="notification">
                    <div class="notification-header">
                        <div class="notification-type">
                            <svg class="icon" viewBox="0 0 24 24" width="20" height="20">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"
                                    fill="currentColor" />
                                <path
                                    d="M12 17c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1s-1 .45-1 1v4c0 .55.45 1 1 1zm-1-8h2v2h-2z"
                                    fill="currentColor" />
                            </svg>
                            Mise à jour de statut
                        </div>
                        <span class="notification-date">15/11/2023 à 14:32</span>
                    </div>
                    <div class="notification-content">
                        Votre réclamation a été enregistrée avec succès. Un numéro de référence REC-2023-12345 vous a
                        été attribué. Veuillez conserver ce numéro pour suivre l'évolution de votre dossier.
                    </div>
                </div>
            </div>
        </div>

        <div class="response complaint-card">
            <div class="complaint-card-header">
                <h2 class="complaint-card-title">Ajouter un commentaire</h2>
            </div>
            <p class="complaint-description">Vous pouvez ajouter des informations complémentaires à votre réclamation
            </p>

            <form class="response-form">
                <div class="form-group">
                    <label for="comment" class="form-label">Votre commentaire</label>
                    <textarea id="comment" class="textarea" rows="5"
                        placeholder="Écrivez votre commentaire ici..."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Pièces jointes (optionnel)</label>
                    <div class="upload-area">
                        <svg class="upload-icon" viewBox="0 0 24 24" width="24" height="24">
                            <path
                                d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"
                                fill="currentColor" />
                        </svg>
                        <span>Cliquez ou glissez des fichiers ici</span>
                        <input type="file" class="file-input">
                    </div>
                </div>

                <button type="submit" class="submit-button">Envoyer</button>
            </form>
        </div>

        <div class="help-section">
            <div class="help-header">
                <svg class="help-icon" viewBox="0 0 24 24" width="24" height="24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"
                        fill="currentColor" />
                </svg>
                <h3 class="help-title">Besoin d'aide?</h3>
            </div>
            <p class="help-text">Si vous avez des questions concernant votre réclamation, n'hésitez pas à contacter
                notre service client
                au 021 XX XX XX (du lundi au vendredi, de 8h à 17h) ou par email à reclamations@sntf.dz</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>