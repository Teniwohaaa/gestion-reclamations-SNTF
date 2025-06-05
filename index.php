<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Accueil - SNTF</title>
    <link rel="stylesheet" href="Styles/style.css" />
</head>

<body>
    <div class="sntf-homepage">
        <?php 
        session_start();
        include 'includes/header.php';?>

        <section class="hero">
            <img src="images/Heroimg.jpg" alt="Train SNTF" class="hero-image" />
            <div class="hero-text">
                <h1>Service Client SNTF</h1>
                <p>À l'écoute de nos voyageurs pour un service ferroviaire de qualité</p>
                <div class="hero-buttons">
                    <a href="reclamation.php" class="btn primary">Soumettre une réclamation</a>
                    <a href="suivi_reclamation.php" class="btn secondary">Suivre ma réclamation</a>
                </div>
            </div>
        </section>

        <main>
            <section id="services" class="services">
                <h2 class="section-title">Nos Services</h2>
                <p class="section-description">
                    Découvrez les différents services que nous proposons pour améliorer
                    votre expérience de voyage.
                </p>
                <div class="service-cards">
                    <div class="card">
                        <div class="img-container">
                            <img src="images/service1.jpg" alt="Formulaire de réclamation" class="card-img" />
                        </div>
                        <h3 class="card-title">Réclamations</h3>
                        <p class="card-description">
                            Soumettez vos réclamations concernant nos services ferroviaires
                            et suivez leur traitement en temps réel.
                        </p>
                        <a href="#" class="card-link">En savoir plus</a>
                    </div>
                    <div class="card">
                        <div class="img-container">
                            <img src="images/service2.jpg" alt="Suggestions des usagers" class="card-img" />
                        </div>
                        <h3 class="card-title">Suggestions</h3>
                        <p class="card-description">
                            Partagez vos idées et suggestions pour nous aider à améliorer
                            continuellement nos services.
                        </p>
                        <a href="#" class="card-link">En savoir plus</a>
                    </div>
                    <div class="card">
                        <div class="img-container">
                            <img src="images/service3.jpg" alt="Service d’assistance" class="card-img" />
                        </div>
                        <h3 class="card-title">Assistance</h3>
                        <p class="card-description">
                            Obtenez de l'aide pour vos voyages, billets ou tout autre besoin
                            lié à nos services ferroviaires.
                        </p>
                        <a href="#" class="card-link">En savoir plus</a>
                    </div>
                </div>
            </section>
            <!-- comment sa marche -->
            <section class="tutoriel">
                <div class="process-section">
                    <div class="section-header">
                        <div class="section-title">Comment ça marche</div>
                        <div class="section-subtitle">
                            Processus simple en 4 étapes pour soumettre et suivre votre
                            réclamation
                        </div>
                    </div>
                    <div class="process-steps">
                        <div class="step-1">
                            <div class="step-icon">
                                <div class="number">1</div>
                            </div>
                            <div class="step-title">Créez votre compte</div>
                            <div class="step-description">
                                Inscrivez-vous sur notre plateforme pour accéder à tous les
                                services
                            </div>
                        </div>
                        <div class="step-2">
                            <div class="step-icon">
                                <div class="number">2</div>
                            </div>
                            <div class="step-title">Soumettez votre réclamation</div>
                            <div class="step-description">
                                Remplissez le formulaire avec tous les détails nécessaires
                            </div>
                        </div>
                        <div class="step-3">
                            <div class="step-icon">
                                <div class="number">3</div>
                            </div>
                            <div class="step-title">Suivez le traitement</div>
                            <div class="step-description">
                                Consultez l'état de votre réclamation en temps réel
                            </div>
                        </div>
                        <div class="step-4">
                            <div class="step-icon">
                                <div class="number">4</div>
                            </div>
                            <div class="step-title">Recevez une réponse</div>
                            <div class="step-description">
                                Obtenez une résolution à votre problème par notre équipe
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="quick-access">
                <h2 class="section-title">Accès Rapide</h2>
                <p class="section-description">
                    Accédez rapidement aux fonctionnalités principales de notre
                    plateforme.
                </p>
                <div class="quick-cards">
                    <div class="quick-card">
                        <img src="images/quickico1.png" alt="Nouvelle réclamation" class="quick-icon" />
                        <a href="reclamation.php" class="quick-link">Nouvelle réclamation</a>
                    </div>
                    <div class="quick-card">
                        <img src="images/quickico2.png" alt="Suivi de réclamation" class="quick-icon" />
                        <a href="suividerec.php" class="quick-link">Suivi de réclamation</a>
                    </div>
                    <div class="quick-card">
                        <img src="images/quickico3.png" alt="FAQ" class="quick-icon" />
                        <a href="#" class="quick-link">FAQ</a>
                    </div>
                    <div class="quick-card">
                        <img src="images/quickico4.png" alt="Contact" class="quick-icon" />
                        <a href="#" class="quick-link">Contact</a>
                    </div>
                </div>
            </section>

            <section class="testimonials">
                <h2 class="section-title">Témoignages</h2>
                <p class="section-description">
                    Découvrez ce que nos clients disent de nous
                </p>
                <div class="testimonial-cards">
                    <div class="testimonial-card">
                        <img src="images/quoteico.png" alt="Citation" class="quote-icon" />
                        <p class="testimonial-text">
                            J'ai soumis une réclamation concernant un retard de train et
                            j'ai été agréablement surpris par la rapidité de traitement et
                            la solution proposée.
                        </p>
                        <div class="testimonial-author">
                            <div class="avatar">
                                <div class="initials">KM</div>
                            </div>
                            <div class="author-info">
                                <span class="name">Karim Meziane</span>
                                <span class="location">Alger</span>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-card">
                        <img src="images/quoteico.png" alt="Citation" class="quote-icon" />
                        <p class="testimonial-text">
                            Le système de suivi en ligne est très pratique. J'ai pu suivre
                            l'évolution de ma réclamation à chaque étape et recevoir des
                            notifications.
                        </p>
                        <div class="testimonial-author">
                            <div class="avatar">
                                <div class="initials">FB</div>
                            </div>
                            <div class="author-info">
                                <span class="name">Fatima Benali</span>
                                <span class="location">Oran</span>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-card">
                        <img src="images/quoteico.png" alt="Citation" class="quote-icon" />
                        <p class="testimonial-text">
                            Le service client a été très réactif et professionnel. Ma
                            suggestion d'amélioration a même été prise en compte pour les
                            futurs services.
                        </p>
                        <div class="testimonial-author">
                            <div class="avatar">
                                <div class="initials">YB</div>
                            </div>
                            <div class="author-info">
                                <span class="name">Youcef Bouaziz</span>
                                <span class="location">Constantine</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="cta-section">
                <h2 class="cta-title">
                    Prêt à nous faire part de votre expérience ?
                </h2>
                <p class="cta-text">
                    Votre avis est important pour nous aider à améliorer nos services
                </p>
                <div class="cta-buttons">
                    <a href="reclamation.php" class="btn primary">Soumettre une réclamation</a>
                    <a href="#" class="btn secondary">Partager une suggestion</a>
                </div>
            </section>
        </main>
        <br />
        <br />
        <br />
        <br />
        <?php include 'includes/footer.php';?>
    </div>
</body>

</html>