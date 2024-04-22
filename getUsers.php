<?php
$host = 'localhost';
$port = '5432';
$dbname = 'Projet';
$user = 'postgres';
$password = '';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
$pdo = new PDO($dsn);

$sql = "SELECT u.id_utilisateur AS id, u.nom_utilisateur || ' ' || u.prenom_utilisateur AS name, r.libellerole AS role 
FROM utilisateur u
LEFT JOIN affecte a ON u.id_utilisateur = a.id_utilisateur
LEFT JOIN role r ON r.libellerole = r.libellerole;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($users);
?>
