<?php
$host = "localhost";
$port = "5432";  // Port par défaut de PostgreSQL
$user = "postgres";
$password = "Robbenarjen12#";
$dbname = "Projet_covoiturage";

// Ajout du port dans la chaîne de connexion
$conn = pg_connect("host=$host port=$port user=$user password=$password dbname=$dbname");

if (!$conn) {
    // Utilisation de pg_last_error() pour obtenir des détails sur l'erreur si la connexion échoue
    echo "Connection failed: " . pg_last_error($conn);
} else {
    echo "Connection successful";
}
?>
