<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plateforme de Réclamation SNTF</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="Styles/style.css">
  <style>
    :root {
      --font-family-montserrat: 'Montserrat', sans-serif;
      --text-white: rgba(255, 255, 255, 1);
      --text-rgb-24-76-124: rgba(24, 76, 124, 1);
      --text-rgb-0-82-155: rgba(0, 82, 155, 1);
      --text-rgb-51-51-51: rgba(51, 51, 51, 1);
      --text-rgb-75-85-99: rgba(75, 85, 99, 1);
      --text-rgb-156-163-175: rgba(156, 163, 175, 1);
      --bg-light-blue: rgba(240, 249, 255, 1);
      --bg-light-gray: rgba(249, 250, 251, 1);
      --border-light: rgba(229, 231, 235, 1);
      --primary-blue: rgba(24, 76, 124, 1);
    }

    /* CSS Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: var(--font-family-montserrat);
      width: 100%;
      min-height: 100vh;
      overflow-x: hidden;
      background-color: #f5f5f5;
      color: var(--text-rgb-51-51-51);
    }

    /* Hero Section */
    .hero-11 {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 4rem 2rem;
      width: 100%;
      background-color: var(--text-rgb-0-82-155);
      color: var(--text-white);
      text-align: center;
    }

    .hero-11 h1 {
      font-weight: 700;
      font-size: 2.5rem;
      margin-bottom: 1rem;
    }

    .hero-11 p {
        color: var(--text-white);
      font-weight: 400;
      font-size: 1.2rem;
      max-width: 600px;
    }

    /* Main Content */
    .content-14 {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 3rem;
      padding: 3rem 2rem;
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
    }

    /* Form Container */
    .form-container-15 {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      padding: 2rem;
      width: 100%;
      background-color: var(--text-white);
      border: 1px solid var(--border-light);
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .form-container-15 h2 {
      font-weight: 700;
      font-size: 1.5rem;
      color: var(--text-rgb-0-82-155);
    }

    /* Form Sections */
    .form-section {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      width: 100%;
    }

    .form-section h3 {
      font-weight: 700;
      font-size: 1.1rem;
      color: var(--text-rgb-51-51-51);
    }

    /* Form Rows */
    .form-row {
      display: flex;
      gap: 1rem;
      width: 100%;
    }

    @media (max-width: 768px) {
      .form-row {
        flex-direction: column;
      }
    }

    /* Form Fields */
    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      flex: 1;
    }

    .form-group label {
      font-weight: 500;
      font-size: 0.875rem;
      color: var(--text-rgb-75-85-99);
    }

    .form-control {
      display: flex;
      align-items: center;
      padding: 0.75rem 1rem;
      width: 100%;
      background-color: var(--bg-light-gray);
      border: 1px solid var(--border-light);
      border-radius: 6px;
      min-height: 44px;
      font-family: var(--font-family-montserrat);
      font-size: 0.875rem;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--text-rgb-0-82-155);
      box-shadow: 0 0 0 2px rgba(0, 82, 155, 0.2);
    }

    textarea.form-control {
      min-height: 120px;
      resize: vertical;
    }

    select.form-control {
      appearance: none;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 1rem center;
      background-size: 1em;
    }

    .file-upload {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .file-upload-label {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 2rem 1rem;
      background-color: var(--bg-light-gray);
      border: 1px dashed var(--border-light);
      border-radius: 6px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-align: center;
    }

    .file-upload-label:hover {
      border-color: var(--text-rgb-0-82-155);
    }

    .file-upload-icon {
      font-size: 1.5rem;
      color: var(--text-rgb-75-85-99);
      margin-bottom: 0.5rem;
    }

    /* Submit Button */
    .submit-btn {
      display: flex;
      justify-content: center;
      width: 100%;
      margin-top: 1rem;
    }

    .btn-primary {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 0.75rem 2rem;
      background-color: var(--primary-blue);
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-weight: 700;
      font-size: 1rem;
      font-family: var(--font-family-montserrat);
    }

    .btn-primary:hover {
      background-color: #1a5a8f;
    }

    /* Info Cards */
    .info-cards {
      display: flex;
      gap: 1.5rem;
      width: 100%;
      max-width: 1000px;
    }

    @media (max-width: 768px) {
      .info-cards {
        flex-direction: column;
      }
    }

    .info-card {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      padding: 1.5rem;
      flex: 1;
      background-color: var(--bg-light-blue);
      border-radius: 8px;
    }

    .card-header {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .card-icon {
      width: 24px;
      height: 24px;
      background-color: var(--text-rgb-0-82-155);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 0.8rem;
    }

    .card-title {
      font-weight: 700;
      font-size: 1.1rem;
      color: var(--text-rgb-0-82-155);
    }

    .card-text {
      font-weight: 400;
      font-size: 0.875rem;
      color: var(--text-rgb-75-85-99);
    }

  </style>
</head>
<body>
<div class="node-1">
    <?php include 'includes/header.php';?>
  <div class="hero-11">
    <h1>Plateforme de Réclamation</h1>
    <p>Nous sommes à votre écoute pour améliorer nos services</p>
  </div>
  
  <div class="content-14">
    <form class="form-container-15" id="complaintForm">
      <h2>Soumettre une réclamation</h2>
      
      <div class="form-section">
        <h3>Informations personnelles</h3>
        
        <div class="form-row">
          <div class="form-group">
            <label for="firstName">Prénom</label>
            <input type="text" id="firstName" class="form-control" placeholder="Votre prénom" required>
          </div>
          
          <div class="form-group">
            <label for="lastName">Nom</label>
            <input type="text" id="lastName" class="form-control" placeholder="Votre nom" required>
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" class="form-control" placeholder="exemple@email.com" required>
          </div>
          
          <div class="form-group">
            <label for="phone">Téléphone</label>
            <input type="tel" id="phone" class="form-control" placeholder="0X XX XX XX XX">
          </div>
        </div>
      </div>
      
      <div class="form-section">
        <h3>Détails de la réclamation</h3>
        
        <div class="form-row">
          <div class="form-group">
            <label for="tripDate">Date du voyage</label>
            <input type="date" id="tripDate" class="form-control" required>
          </div>
          
          <div class="form-group">
            <label for="trainNumber">Numéro du train</label>
            <input type="text" id="trainNumber" class="form-control" placeholder="Ex: 1234" required>
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label for="departure">Gare de départ</label>
            <input type="text" id="departure" class="form-control" placeholder="Ville de départ" required>
          </div>
          
          <div class="form-group">
            <label for="arrival">Gare d'arrivée</label>
            <input type="text" id="arrival" class="form-control" placeholder="Ville d'arrivée" required>
          </div>
        </div>
        
        <div class="form-group">
          <label for="complaintType">Type de réclamation</label>
          <select id="complaintType" class="form-control" required>
            <option value="" disabled selected>Sélectionnez un type</option>
            <option value="retard">Retard de train</option>
            <option value="proprete">Propreté du train</option>
            <option value="service">Service à bord</option>
            <option value="autre">Autre problème</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="description">Description détaillée</label>
          <textarea id="description" class="form-control" placeholder="Décrivez votre problème en détail..." required></textarea>
        </div>
        
        <div class="form-group file-upload">
          <label>Pièces jointes (optionnel)</label>
          <label for="fileUpload" class="file-upload-label">
            <div class="file-upload-icon">↑</div>
            <p>Cliquez ou glissez des fichiers ici</p>
            <input type="file" id="fileUpload" style="display: none;" multiple>
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
        <p class="card-text">Suivez l'état de votre réclamation en utilisant le numéro de référence qui vous sera envoyé par email.</p>
      </div>
      
      <div class="info-card">
        <div class="card-header">
          <div class="card-icon">?</div>
          <h3 class="card-title">Besoin d'aide?</h3>
        </div>
        <p class="card-text">Notre service client est disponible au 021 XX XX XX ou par email à support@sntf.dz</p>
      </div>
    </div>
  </div>
</div>
<?php include 'includes/footer.php';?>
<script>
  document.getElementById('complaintForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Votre réclamation a été soumise avec succès!');
    this.reset();
  });

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