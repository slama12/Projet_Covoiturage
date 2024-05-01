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
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// formulaire de modification de profil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // champs du formulaire
    $username = $_POST['username'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];

    // Mettre à jour les informations de l'utilisateur dans la base de données
    $query = "UPDATE users SET username = ?, email = ?, firstname = ?, lastname = ?, phone = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username, $email, $firstname, $lastname, $phone, $user_id]);

    // si l'utilisateur souhaite modifier le mot de passe
    if(!empty($_POST['old_password']) && !empty($_POST['new_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];

        // Vérifier si l'ancien mot de passe est correct
        $query = "SELECT password FROM users WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id]);
        $stored_password = $stmt->fetchColumn();

        if(password_verify($old_password, $stored_password)) {
            // si Le mot de passe actuel est correct, hasher le nouveau mot de passe
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
  
            // Mettre à jour le mot de passe dans la base de données
            $query = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$hashed_password, $user_id]);

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
