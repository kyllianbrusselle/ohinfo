<?php
// Récupérer les données du formulaire
$formulaire = $_POST;

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
$sql = "INSERT INTO prise_en_charge (id_client, type, marque_modele, etat, details, accessoires, mot_de_passe, signature_data) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $connexion->prepare($sql);
$stmt->bind_param(
    "ssssssss",
    $formulaire['id_client'],
    $formulaire['type'],
    $formulaire['marque_modele'],
    $formulaire['etat'],
    $formulaire['details'],
    $formulaire['accessoires'],
    $formulaire['mot_de_passe'],
    $formulaire['signature_data']
);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Les données du formulaire ont été enregistrées avec succès.";
} else {
    echo "Erreur lors de l'enregistrement des données du formulaire.";
}

// Fermer la connexion et libérer les ressources
$stmt->close();
$connexion->close();
?>
