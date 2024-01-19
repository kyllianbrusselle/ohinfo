<?php
// Récupérer les données du formulaire
$client = $_POST;

// Connexion à la base de données MySQL
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$basededonnees = "ohinfo";

$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Erreur de connexion à la base de données: " . $connexion->connect_error);
}

// Préparer et exécuter la requête d'insertion
$sql = "INSERT INTO client (prenom, nom, mail, adresse, ville, cp, telephone, statut) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $connexion->prepare($sql);
$stmt->bind_param("ssssssss", $client['prenom'], $client['nom'], $client['mail'], $client['adresse'], $client['ville'], $client['cp'], $client['telephone'], $client['statut']);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Le client a été créé avec succès.";
} else {
    echo "Erreur lors de la création du client.";
}

// Fermer la connexion et libérer les ressources
$stmt->close();
$connexion->close();
?>
