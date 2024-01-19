<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['search'])) {
        $search = $_POST['search'];

        // Connexion à la base de données
        $connexion = new PDO('mysql:host=localhost;dbname=ohinfo', 'root', '');

        // Requête pour rechercher le client par les initiales du prénom
        $requete = $connexion->prepare('SELECT * FROM client WHERE prenom LIKE :search');
        $requete->execute(array('search' => $search . '%'));

        // Afficher les résultats de la recherche
        if ($requete->rowCount() > 0) {
            echo '<h2>Résultats de la recherche :</h2>';
            echo '<ul>';
            while ($client = $requete->fetch(PDO::FETCH_ASSOC)) {
                echo '<li><a href="pec.php?id_client=' . $client['id_client'] . '">' . $client['nom'] . ' ' . $client['prenom'] . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo 'Aucun client trouvé avec les initiales du prénom : ' . $search;
        }

        // Fermeture de la connexion à la base de données
        $connexion = null;
    }
}
?>
