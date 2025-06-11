# Plateforme de Réclamation - SNTF

Dans le cadre de sa stratégie de modernisation et de rapprochement avec les usagers, la SNTF (Société Nationale des Transports Ferroviaires) souhaite tirer parti de la démocratisation des technologies numériques pour s'engager pleinement dans la dynamique du e-transport en Algérie.

Afin d’améliorer la qualité des services publics et offrir aux voyageurs un canal de communication simple et accessible, la SNTF lance un appel d’offres pour le développement d’une application Web dédiée à la gestion des réclamations des voyageurs.

L'application permettra aux voyageurs de soumettre facilement leurs plaintes ou signalements liés aux services de la société (retards, comportement du personnel, propreté des gares, etc). Cette plateforme offrira également aux agents de la SNTF des outils adaptés (tri, filtrage, tableaux de bords) pour traiter efficacement les demandes, assurer leur suivi, et garantir une réponse rapide et structurée.

# Fonctionnalités principales :

- soumission d'une réclamation
- Connexion pour les voyageurs, agents, et administrateurs
- Interface simple pour consulter et suivre les réclamations
- Tableau de bord pour agents
- Tableau de bord pour administrateurs
- Base de données relationnelle SQL

# Comment utiliser ce site:

### Voyageurs

1. Accédez au site via votre navigateur.
2. Rempliser une reclamation ou connectez-vous.
3. Soumettez une réclamation :
   - Sélectionnez le type de problème (retard, comportement du personnel, propreté, etc.).
   - Décrivez les faits de manière claire et précise.
   - Ajoutez des fichiers ou images si nécessaire.
4. Suivez l’état de votre réclamation depuis votre espace personnel :
   - `En attente`, `En cours`, `Résolue`.
### Agents

1. Accédez au site via votre navigateur.
2. Connectez-vous à votre espace personnel.
3. Accédez à votre tableau de bord :
   - Consulter et filtrer les réclamations.
   - Gérer les utilisateurs.
   - Envoyer des rapports.
   - Suivre l’évolution des réclamations.

### Administrateurs

1. Accédez au site via votre navigateur.
2. Connectez-vous à votre espace administrateur.
3. Tableau de bord administrateur :
   - Gestion avancée des utilisateurs et des agents.
   - Visualisation globale de l’ensemble des réclamations.
   - Accès aux statistiques et aux rapports.
   - Paramétrage et configuration du système.

# Technologies :

- **Frontend** : HTML, CSS, JavaScript
- **Backend** : PHP (procédural)
- **Base de données** : MySQL (gérée via phpMyAdmin)
- **Langage secondaire** : Python (utilisé pour les tests fonctionnels)
- **SQL**
- GitHub
- Outils de maquettage : Figma (maquette)
- Outils de documentation : Latex, phpDoumentor
- Tests fonctionnels : Selenium

## Environnement de développement

- **Éditeur de code** : Visual Studio Code
- **Serveur local** : XAMPP
  - Apache
  - phpMyAdmin

# Documentation :

- Lien vers la documentation technique [ici](https://github.com/Teniwohaaa/gestion-reclamations-SNTF/raw/main/docs/Documentation.pdf)
- La Documetation Php a etais generer avec phpdocumentor.
- La Documentatione est dans `docs/`.
- veuiller ouvrire `docs/index.html` dans votre navigateur pour la consuler.

# Maquette:

La maquette de ce projet a été réalisée sur [Figma](https://www.figma.com/design/1W9omYV5qntg2eFAaeD6Sq/Project_SNTF?m=auto&t=bFPPvW3IFLarsobs-1).

# Importer la base de données:

1. Aller sur [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Cliquer sur **"Nouvelle base de données"** dans le menu de gauche.
3. Entrer un nom pour la base (ex: `sntf_reclamations`) et cliquer sur **"Créer"**.
4. Une fois la base créée, cliquer sur l’onglet **"Importer"**.
5. Cliquer sur **"Choisir un fichier"** et sélectionner le fichier `sntf_reclamations.sql`.
6. Cliquer sur **"Exécuter"** pour lancer l'importation.

### Remarques

- Si une base de données du même nom existe déjà, vous pouvez la supprimer avant de réimporter.
- Cette méthode fonctionne sous XAMPP, WAMP, MAMP, ou tout serveur local utilisant phpMyAdmin.

# Test fonctionnel automatisé (Selenium)

Un test fonctionnel a été réalisé avec l’outil Selenium afin de simuler un utilisateur se connectant via l’interface du site.

### Script :

Deux scripts de test fonctionnel ont été réalisés à l’aide de **Selenium** :

- `login_test.py` : teste la page de connexion (`login.php`)
- `reclamation_test.py` : teste le formulaire de réclamation (`reclamation.php`)

### Description :

Chaque script contient **deux scénarios** :

1. Scénario réussi — l’utilisateur saisit des informations valides, la connexion ou la soumission est acceptée.
2. Scénario échoué — l’utilisateur saisit des informations invalides, un message d’erreur s’affiche.

Ces tests permettent de vérifier que les formulaires fonctionnent correctement en conditions réelles.

### Lancer le test :

utilisez l'une des commandes Pour lancer les tests:

```bash
python login_test.py

python reclamation_test.py
```

**Note**: Assurez-vous que Selenium WebDriver est correctement installé et configuré avant d'exécuter les tests.

# Auteur :

Ce projet a été réalisé dans le cadre d’un exercice académique.
