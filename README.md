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
- Base de données relationnelle MySQL

# Comment utiliser ce site:

### Voyageurs

1. Accédez au site via votre navigateur (URL à compléter).
2. Rempliser une reclamation ou connectez-vous.
3. Soumettez une réclamation :
   - Sélectionnez le type de problème (retard, comportement du personnel, propreté, etc.).
   - Décrivez les faits de manière claire et précise.
   - Ajoutez des fichiers ou images si nécessaire.
4. Suivez l’état de votre réclamation depuis votre espace personnel :
   - `En attente`, `En cours`, `Résolue`.

# Technologies :

- PHP
- HTML / CSS
- MySQL
- GitHub
- Outils de maquettage : Figma (maquette)
- Outils de documentation : Latex
- Tests unitaires :
- Tests fonctionnels :

# Documentation :

Lien vers la documentation technique : https://documentation.org
La Documetation Php a etais generer avec phpdocumentor
La Documentatione st dans `docs/`.
veuiller ouvrire `docs/index.html` dans votre navigateur pour la consuler.

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

# Auteur :

Ce projet a été réalisé dans le cadre d’un exercice académique.
