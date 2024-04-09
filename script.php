<?php
// Connexion à la base de données
$dbconn = pg_connect("host=localhost dbname=Hospital_triage user=utilisateur password=mot_de_passe");

// Vérification des données envoyées depuis le formulaire d'inscription
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hachage du mot de passe avant de le stocker dans la base de données
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertion des données dans la table des utilisateurs
    $query = "INSERT INTO Utilisateurs (username, password_hash) VALUES ('$username', '$hashed_password')";
    $result = pg_query($dbconn, $query);

    if($result) {
        echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
    } else {
        echo "Une erreur s'est produite lors de l'inscription.";
    }
}

// Fermeture de la connexion à la base de données
pg_close($dbconn);
?>
