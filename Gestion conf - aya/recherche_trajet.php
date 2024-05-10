<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de trajets</title>
</head>
<body>
    <h1>Recherche de trajets</h1>

    <form action="index.php" method="post">
        <label for="depart">Ville de départ :</label>
        <input type="text" id="depart" name="depart" required><br>

        <label for="arrivee">Ville d'arrivée :</label>
        <input type="text" id="arrivee" name="arrivee" required><br>

        <label for="date">Date du trajet :</label>
        <input type="date" id="date" name="date" required><br>

        <input type="submit" value="Rechercher">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Connexion à la base de données (à adapter selon votre configuration)
        $pdo = new PDO('mysql:host=localhost;dbname=votre_base_de_donnees', 'votre_nom_utilisateur', 'votre_mot_de_passe');

        // Récupération des critères de recherche
        $depart = $_POST['depart'];
        $arrivee = $_POST['arrivee'];
        $date = $_POST['date'];

        // Requête SQL pour rechercher les trajets correspondants
        $query = "SELECT * FROM trajets WHERE ville_depart = ? AND ville_arrivee = ? AND date_trajet = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$depart, $arrivee, $date]);
        $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Affichage des résultats de recherche
        if (count($trajets) > 0) {
            echo "<h2>Résultats de la recherche :</h2>";
            echo "<ul>";
            foreach ($trajets as $trajet) {
                echo "<li>Trajet de ".$trajet['ville_depart']." à ".$trajet['ville_arrivee']." le ".$trajet['date_trajet'].".</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Aucun trajet trouvé pour les critères de recherche spécifiés.</p>";
        }
    }
    ?>

</body>
</html>

