<?php
session_start();
include_once "config/db.php";

$message = ""; // Initialisez le message vide

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $marque_vehicule = $_POST['marque_vehicule'];
    $modele_vehicule = $_POST['modele_vehicule'];

    // Insérer les données dans la base de données
    $query = "INSERT INTO conducteurs (nom, prenom, email, telephone, marque_vehicule, modele_vehicule) 
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    if ($stmt->execute([$nom, $prenom, $email, $telephone, $marque_vehicule, $modele_vehicule])) {
        // Le conducteur a été ajouté avec succès
        $message = "Le conducteur a été ajouté avec succès.";
    } else {
        // Une erreur s'est produite lors de l'ajout du conducteur
        $message = "Une erreur s'est produite. Veuillez réessayer.";
    }
}
?>
