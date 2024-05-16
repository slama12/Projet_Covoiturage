<?php
include '../bd/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = pg_escape_string($dbconn, $_POST['email']);

    // Vérifier si l'email existe dans la base de données
    $query = "SELECT * FROM Utilisateur WHERE Adresse_EMail = $1";
    $result = pg_query_params($dbconn, $query, array($email));

    if (pg_num_rows($result) > 0) {
        // Rediriger vers la page de réinitialisation du mot de passe avec l'email en paramètre
        header("Location: new_pwd.php?email=" . urlencode($email));
        exit();
    } else {
        echo "Cet email n'existe pas.";
    }

    pg_free_result($result);
    pg_close($dbconn);
} else {
    echo "Veuillez entrer une adresse email.";
}
?>
