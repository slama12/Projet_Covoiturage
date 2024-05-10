<?php
session_start();
// Vérifier si l'utilisateur est connecté,sinon le rediriger vers la page de connexion 
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: login.php");
    exit;
}

// Récupérer les informations de l'utilisateur à partir de la base de données
$id_utilisateur = $_SESSION['id_utilisateur'];
$query = "SELECT * FROM utilisateur WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id_utilisateur]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

// formulaire de modification de profil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // champs du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // Mettre à jour les informations de l'utilisateur dans la base de données
    $query = "UPDATE utilisateur SET nom = ?, prenom = ?, email = ?, telephone = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$nom, $prenom, $email, $telephone, $id_utilisateur]);

    // si l'utilisateur souhaite modifier le mot de passe
    if (!empty($_POST['ancien_mot_de_passe']) && !empty($_POST['nouveau_mot_de_passe'])) {
        $ancien_mot_de_passe = $_POST['ancien_mot_de_passe'];
        $nouveau_mot_de_passe = $_POST['nouveau_mot_de_passe'];

        // Vérifier si l'ancien mot de passe est correct
        $query = "SELECT mot_de_passe FROM utilisateur WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_utilisateur]);
        $stored_password = $stmt->fetchColumn();

        if (password_verify($ancien_mot_de_passe, $stored_password)) {
            // si Le mot de passe actuel est correct, hasher le nouveau mot de passe
            $hashed_password = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);

            // Mettre à jour le mot de passe dans la base de données
            $query = "UPDATE utilisateur SET mot_de_passe = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$hashed_password, $id_utilisateur]);

            // Rediriger vers la page de profil après la modification
            header("Location: profile.php");
            exit;
        } else {
            $error_message = "L'ancien mot de passe est incorrect.";
        }
    }
    // Rediriger vers la page de profil après la modification
    header("Location: profile.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil</title>
</head>
<body>

<h2>Modifier votre profil</h2>

<form action="" method="POST">
    <label for="nom">Nom:</label><br>
    <input type="text" id="nom" name="nom" value="<?php echo $utilisateur['nom']; ?>"><br>
    <label for="prenom">Prénom:</label><br>
    <input type="text" id="prenom" name="prenom" value="<?php echo $utilisateur['prenom']; ?>"><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?php echo $utilisateur['email']; ?>"><br>
    <label for="telephone">Téléphone:</label><br>
    <input type="tel" id="telephone" name="telephone" value="<?php echo $utilisateur['telephone']; ?>"><br>

    <h3>Changer le mot de passe</h3>
    <label for="ancien_mot_de_passe">Ancien mot de passe:</label><br>
    <input type="password" id="ancien_mot_de_passe" name="ancien_mot_de_passe"><br>
    <label for="nouveau_mot_de_passe">Nouveau mot de passe:</label><br>
    <input type="password" id="nouveau_mot_de_passe" name="nouveau_mot_de_passe"><br>

    <input type="submit" value="Enregistrer les modifications">
</form>

<?php
if (isset($error_message)) {
    echo "<p>$error_message</p>";
}
?>

</body>
</html>
