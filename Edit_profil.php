<?php
session_start();
// Vérifier si l'utilisateur est connecté,sinon le rediriger vers la page de connexion 
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Inclure le fichier de configuration de la base de données
include_once "config/db.php";

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
    $query = "UPDATE utilisateur SET  nom = ?, prenom = ?, email = ?, telephone = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([ $nom, $prenom,$email, $telehone, $id_utilisateur]);

    // si l'utilisateur souhaite modifier le mot de passe
    if(!empty($_POST['ancien_mot_de_passe']) && !empty($_POST['nouveau_mot_de_passe'])) {
        $ancien_mot_de_passe = $_POST['ancien_mot_de_passe'];
        $nouveau_mot_de_passe = $_POST['nouveau_mot_de_passe'];

        // Vérifier si l'ancien mot de passe est correct
        $query = "SELECT mot_de_passe FROM utilisateur WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_utilisateur]);
        $stored_password = $stmt->fetchColumn();

        if(password_verify($ancien_mot_de_passe, $stored_password)) {
            // si Le mot de passe actuel est correct, hasher le nouveau mot de passe
            $hashed_password = password_hash($nouveau_mot_de_psse, PASSWORD_DEFAULT);
  
            // Mettre à jour le mot de passe dans la base de données
            $query = "UPDATE utilisateurs SET mot_de_passe = ? WHERE id = ?";
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
