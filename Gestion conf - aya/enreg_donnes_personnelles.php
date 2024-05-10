<?php
session_start();

// Vérifier si les données du formulaire ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';

    // Vérifier si $_SESSION['id'] est défini
    if (isset($_SESSION['id'])) {
        $utilisateur_id = $_SESSION['id'];

        // Vérifier si la connexion PDO est définie
        if (isset($pdo)) {
            // Mettre à jour les informations de l'utilisateur dans la base de données
            $query = "UPDATE utilisateur SET nom = ?, prenom = ?, email = ?, telephone = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$nom, $prenom, $email, $telephone, $utilisateur_id]);

            // Rediriger l'utilisateur vers une page de confirmation
            header("Location: confirmation.php");
            exit;
        } else {
            ?>
            Erreur: La connexion PDO n'est pas définie.
            <?php
        }
    } else {
        ?>
        Erreur: $_SESSION['id'] n'est pas défini.
        <?php
    }
} else {
    ?>
    Erreur: Les données du formulaire n'ont pas été soumises.
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saisir vos informations personnelles</title>
</head>
<body>
    <h1>Saisir vos informations personnelles</h1>
    
    <form action="enregistrer_donnees_personne.php" method="post">
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom" required><br>
        
        <label for="prenom">Prénom :</label><br>
        <input type="text" id="prenom" name="prenom" required><br>
        
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <label for="telephone">Numéro de téléphone :</label><br>
        <input type="text" id="telephone" name="telephone"><br>
        
        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>
