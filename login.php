<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Plateforme SNTF</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Styles/reclamation.css">
</head>

<body>
    <div class="node-1">
        <?php include 'includes/header.php'; ?>

        <?php if (isset($_SESSION['error'])): ?>
        <div class="alert"
            style="background-color: #fee2e2; color: #dc2626; padding: 1rem; margin: 1rem auto; max-width: 600px; border-radius: 6px; text-align: center;">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
        <?php endif; ?>

        <div class="hero-11">
            <h1>Connexion</h1>
            <p>Accédez à votre espace personnel pour suivre vos réclamations</p>
        </div>

        <div class="content-14">
            <form class="form-container-15" action="auth.php" method="post">
                <h2>Se connecter</h2>

                <div class="form-section">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="exemple@email.com"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Votre mot de passe" required>
                    </div>
                </div>

                <div class="submit-btn">
                    <button type="submit" name="submit" class="btn-primary">Se connecter</button>
                </div>

                <p style="text-align: center; margin-top: 1rem; color: var(--text-rgb-75-85-99);">
                    Vous n'avez pas de compte ? <a href="reclamation.php"
                        style="color: var(--text-rgb-0-82-155);">Soumettre une réclamation</a>
                </p>

                <div class="auth-links">
                    <a href="register.php">Créer un compte</a>
                    <a href="forgot-password.php">Mot de passe oublié?</a>
                </div>
            </form>

            <div class="info-cards">
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-icon">?</div>
                        <h3 class="card-title">Besoin d'aide?</h3>
                    </div>
                    <p class="card-text">Si vous rencontrez des problèmes pour vous connecter, contactez notre service
                        client au 021 XX XX XX ou par email à support@sntf.dz</p>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>

</html>