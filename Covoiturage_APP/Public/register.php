<?php
include 'src/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from form
    $username = pg_escape_string($dbconn, $_POST['username']);
    $firstname = pg_escape_string($dbconn, $_POST['firstname']);
    $email = pg_escape_string($dbconn, $_POST['email']);
    $password = pg_escape_string($dbconn, $_POST['password']);
    $phone = pg_escape_string($dbconn, $_POST['phone']);

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $query = "INSERT INTO Utilisateur (Nom_Utilisateur, Prenom_Utilisateur, Adresse_EMail, Mot_de_Passe, Numero_Telephone) VALUES ('$username', '$firstname', '$email', '$hashed_password', '$phone')";
    $result = pg_query($dbconn, $query);

    if ($result) {
        echo "Registration successful!";
    } else {
        echo "Error: " . pg_last_error($dbconn);
    }

    pg_close($dbconn);
}
?>
