DESCRIPTION: 
Voici une description de chaque partie et fonction du projet :
Ces fichiers constituent une application web simple pour la gestion des patients dans un hôpital, avec des fonctionnalités d'inscription, de connexion, de création de patients et d'affichage de la liste des patients.

hospital.html : Ce fichier représente la page de connexion de l'hôpital. Il contient un formulaire où les utilisateurs peuvent saisir leur nom d'utilisateur et leur mot de passe pour se connecter. Si l'utilisateur n'a pas de compte, il peut également cliquer sur le lien "Créer un compte" pour être redirigé vers la page d'inscription.

register.html : Ce fichier représente la page d'inscription de l'hôpital. Il contient un formulaire où les utilisateurs peuvent saisir leurs informations personnelles telles que le prénom, le nom, l'identifiant, la date de naissance, le code postal et le nom du médecin.

register.css : Ce fichier contient les styles CSS pour la page d'inscription. Il définit la mise en page, les couleurs et les styles des éléments du formulaire.

styles.css : Ce fichier contient les styles CSS partagés utilisés à la fois pour la page de connexion et la page d'inscription. Il définit la mise en page, les couleurs et les styles généraux des éléments.

script.js : Ce fichier contient le script JavaScript pour la page de connexion. Il gère les interactions utilisateur, telles que la soumission du formulaire de connexion, l'envoi des données au serveur pour l'authentification, la gestion des réponses du serveur et l'affichage de la liste des patients après une connexion réussie.

script.php : Ce fichier contient le script PHP pour le traitement des données de formulaire d'inscription. Il se connecte à la base de données PostgreSQL, récupère les données saisies par l'utilisateur, les insère dans la table des utilisateurs après avoir haché le mot de passe, et renvoie un message de succès ou d'erreur à l'utilisateur.

hospital.php : Ce fichier contient le script PHP pour le backend de l'application hospitalière. Il se connecte à la base de données PostgreSQL, définit des fonctions pour créer des patients, obtenir la liste des patients, authentifier les administrateurs et gérer les routes API RESTful pour les opérations CRUD sur les patients. Il inclut également des vérifications d'authentification pour chaque requête.

hospital.sql : Ce fichier contient le script SQL pour la création des tables de la base de données PostgreSQL. Il crée les tables pour stocker les informations des patients, des administrateurs, des utilisateurs et des logs. Il ajoute également un administrateur avec un mot de passe haché et définit des contraintes de clé étrangère lorsque cela est nécessaire.

