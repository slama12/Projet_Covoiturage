<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from the database
    $query = "SELECT * FROM Utilisateur WHERE Nom_Utilisateur = '$username'";
    $result = pg_query($dbconn, $query);
    $user = pg_fetch_assoc($result);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['user_id'] = $user['id_utilisateur'];
        echo "Login successful. Welcome, " . htmlspecialchars($username) . "!";
        // Redirect to dashboard or home page
        header("Location: index.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }

    pg_close($dbconn);
}
?>

