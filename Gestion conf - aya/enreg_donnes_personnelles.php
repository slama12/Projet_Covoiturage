<?php
session_start();
// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];

// Récupérer l'identifiant de l'utilisateur
$utilisateur_id = $_SESSION['id'];

// Mettre à jour les informations de l'utilisateur dans la base de données
$query = "UPDATE utilisateur SET nom = ?, prenom = ?, email = ?, telephone = ? WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$nom, $prenom, $email, $telephone, $utilisateur_id]);

// Rediriger l'utilisateur vers une page de confirmation
header("Location: confirmation.php");
exit;
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
