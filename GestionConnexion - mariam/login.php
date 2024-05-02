<?php
session_start();
include '../bd/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = pg_escape_string($dbconn, $_POST['username']);
    $password = $_POST['password'];

    // Fetch user from the database
    $query = "SELECT * FROM Utilisateur WHERE Nom_Utilisateur = '$username'";
    $result = pg_query($dbconn, $query);
    $user = pg_fetch_assoc($result);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
        echo "Login successful. Welcome, " . htmlspecialchars($username) . "!";
        // Redirect to dashboard or home page
        // header("Location: dashboard.php");
        // exit();
    } else {
        echo "<script>alert('Invalid username or password.'); window.location='login.html'</script>";
    }

    pg_close($dbconn);
}
?>
