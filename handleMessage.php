<?php
$host = 'localhost';
$port = '5432';
$dbname = 'Projet';
$user = 'postgres';
$password = '';

// Connexion à la base de données
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
$pdo = new PDO($dsn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $content = $_POST['message'];

    $sql = "INSERT INTO message (contenu_message, date_d_envoie, id_utilisateur, id_utilisateur_1) VALUES (?, now(), ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$content, $sender, $receiver]);

    echo "Message envoyé avec succès.";
}
?>