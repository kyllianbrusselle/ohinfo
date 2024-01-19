<?php
require_once('fpdf.php');

// Démarrer la session
session_start();

// Vérifier si l'ID du client est présent dans l'URL
if (isset($_GET['id_client'])) {
    // Récupérer l'ID du client à partir de l'URL
    $clientId = $_GET['id_client'];

    // Connexion à la base de données
    $connexion = new PDO('mysql:host=localhost;dbname=ohinfo', 'root', '');

    // Requête pour récupérer les informations du client
    $requeteClient = $connexion->prepare('SELECT * FROM client WHERE id_client = :id_client');
    $requeteClient->execute(array('id_client' => $clientId));

    // Fermeture de la connexion à la base de données
    $connexion = null;

    // Vérifier si des résultats ont été retournés par la requête
    if ($requeteClient->rowCount() > 0) {
        $clientInfo = $requeteClient->fetch(PDO::FETCH_ASSOC);

        // Génération du contenu du PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $pdfContent = "Informations du client:\n";
        $pdfContent .= "Nom: " . $clientInfo['nom'] . "\n";
        $pdfContent .= "Prénom: " . $clientInfo['prenom'] . "\n";

        // Ajouter les informations du formulaire s'il y en a
        if (isset($_SESSION['form_data'][$clientId])) {
            $form_data = $_SESSION['form_data'][$clientId];
            $pdfContent .= "\nInformations du formulaire:\n";
            $pdfContent .= "Type: " . $form_data['type'] . "\n";
            $pdfContent .= "Marque et modèle: " . $form_data['marque_modele'] . "\n";
            $pdfContent .= "État du matériel: " . $form_data['etat'] . "\n";
            $pdfContent .= "Détails de la panne: " . $form_data['details'] . "\n";
            $pdfContent .= "Accessoires: " . $form_data['accessoires'] . "\n";
            $pdfContent .= "Mot de passe: " . $form_data['mot_de_passe'] . "\n";
        } else {
            echo "Aucune donnée de formulaire pour l'id_client: $clientId";
        }

        $pdf->MultiCell(0, 10, $pdfContent);

        // Sauvegarde du PDF sur le serveur
        $pdfFileName = 'Prise_en_charge_' . date('YmdHis') . '.pdf';
        $pdf->Output($pdfFileName, 'F');

        // Afficher le lien vers le PDF
        echo '<a href="' . $pdfFileName . '" target="_blank">Télécharger le PDF</a>';
    } else {
        // Gérer le cas où aucun résultat n'a été trouvé (éventuellement rediriger l'utilisateur ou afficher un message)
        echo "Aucun client trouvé avec l'id_client: $clientId";
    }
}

// Effacer les variables de session spécifiques à l'id_client après utilisation
unset($_SESSION['form_data'][$clientId]);
?>
