<?php
// Connexion à la base de données
$host = "localhost";
$dbname = "Hospital_triage";
$user = "utilisateur";
$password = "mot_de_passe";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Fonction pour hacher les mots de passe
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Fonction pour vérifier le mot de passe haché
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Fonction pour créer un nouvel admin
function createAdmin($username, $password) {
    global $pdo;
    $hashedPassword = hashPassword($password);
    $stmt = $pdo->prepare("INSERT INTO Admins (username, password_hash) VALUES (?, ?)");
    $stmt->execute([$username, $hashedPassword]);
}

// Fonction pour authentifier un admin
function authenticateAdmin($username, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM Admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($admin && verifyPassword($password, $admin['password_hash'])) {
        // Authentification réussie
        session_start();
        $_SESSION['admin_id'] = $admin['admin_id'];
        return true;
    }
    return false;
}

// Fonction pour créer un nouveau patient
function createPatient($nom, $code_3_lettres, $gravite_blessure) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Patients (nom, code_3_lettres, gravite_blessure) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $code_3_lettres, $gravite_blessure]);
}

// Fonction pour obtenir la liste des patients
function getPatients() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM Patients");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Vérifier l'authentification pour chaque requête
session_start();
if (!isset($_SESSION['admin_id'])) {
    // Rediriger vers la page de connexion
    header("Location: login.php");
    exit();
}

// Routes pour les API RESTful
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Créer un nouveau patient
    if ($_POST['action'] === 'create_patient') {
        createPatient($_POST['nom'], $_POST['code_3_lettres'], $_POST['gravite_blessure']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtenir la liste des patients
    if ($_GET['action'] === 'get_patients') {
        $patients = getPatients();
        echo json_encode($patients);
    }
}
?>
