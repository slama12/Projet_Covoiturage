<?php
session_start();
include 'src/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = pg_escape_string($dbconn, $_POST['username']);
    $password = $_POST['password'];

    // Fetch user from the database
    $query = "SELECT * FROM Utilisateur WHERE Nom_Utilisateur = '$username'";
    $result = pg_query($dbconn, $query);
    $user = pg_fetch_assoc($result);

    if ($user && password_verify($password, $user['Mot_de_Passe'])) {
        $_SESSION['user_id'] = $user['ID_Utilisateur'];
        echo "Login successful. Welcome, " . htmlspecialchars($username) . "!";
        // Redirect to dashboard or home page
        // header("Location: dashboard.php");
        // exit();
    } else {
        echo "Invalid username or password.";
    }

    pg_close($dbconn);
}
?>
