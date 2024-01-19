

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de prise en charge</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="signature_pad.min.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="createclient.html">Créer un client</a></li>
                <li class="active"><a href="pec.php">PEC</a></li>
                <li class="active"><a href="PageListePriseEnCharge.php">Liste Prise en charge</a></li>
            </ul>
        </nav>
    </header>

    <?php
    // Si l'id_client est présent dans l'URL, afficher le bouton "Générer le PDF"
    if (isset($_GET['id_client'])) {
        $id_client = $_GET['id_client'];
        echo '<form action="confirmation.php?id_client=' . $id_client . '" method="post">';
        echo '<h2>Formulaire de prise en charge</h2>';
        echo '<label for="type">Type :</label>';
        echo '<select name="type" id="type">';
        echo '<option value="ordinateur">Ordinateur</option>';
        echo '<option value="telephone">Téléphone</option>';
        echo '<option value="montre">Montre</option>';
        echo '<option value="imprimante">Imprimante</option>';
        echo '<option value="tablette">Tablette</option>';
        echo '</select><br><br>';
        echo '<label for="marque_modele">Marque et modèle :</label>';
        echo '<input type="text" name="marque_modele" id="marque_modele" required><br><br>';
        echo '<label for="etat">État du matériel :</label>';
        echo '<input type="text" name="etat" id="etat" required><br><br>';
        echo '<label for="details">Détails de la panne :</label>';
        echo '<textarea name="details" id="details" required></textarea><br><br>';
        echo '<label for="accessoires">Accessoires :</label>';
        echo '<input type="text" name="accessoires" id="accessoires" required><br><br>';
        echo '<label for="mot_de_passe">Mot de passe :</label>';
        echo '<input type="text" name="mot_de_passe" id="mot_de_passe" required><br><br>';
        echo '<div id="signature-container">';
        echo '<canvas id="signature-pad" width="500" height="200"></canvas>';
        echo '</div>';
        echo '<button type="button" id="clear-signature">Effacer la signature</button><br><br>';
        echo '<input type="hidden" name="signature_data" id="signature_data">';
        echo '<input type="submit" value="Générer le PDF">';
        echo '</form>';
    }
    ?>

    <!-- Inclure le code JavaScript pour la bibliothèque -->
    <script src="signature_pad.min.js"></script>
    <script>
        // Attendre que la page soit complètement chargée
        window.addEventListener('load', function() {
            // Initialiser le pad de signature
            var canvas = document.getElementById('signature-pad');
            var signaturePad = new SignaturePad(canvas);

            // Effacer la signature
            document.getElementById('clear-signature').addEventListener('click', function() {
                signaturePad.clear();
            });
        });
    </script>
</body>
</html>
