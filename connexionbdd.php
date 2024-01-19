<?php
// Paramètres de connexion à la base de données
$servername = "localhost"; // Nom du serveur
$username = "root"; // Nom d'utilisateur MySQL
$password = ""; // Mot de passe MySQL
$dbname = "ohinfo"; // Nom de la base de données

// Connexion à la base de données
$db = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion
if (!$db) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Définir le jeu de caractères des requêtes
mysqli_set_charset($db, "utf8");
?>
<?php
// Paramètres de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$basededonnees = "ohinfo";

$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

// Vérifier la connexion
if (!$db) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Définir le jeu de caractères des requêtes
mysqli_set_charset($db, "utf8");
?>
