<?php
include '../bd/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
    $email = pg_escape_string($dbconn, $_POST['email']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE Utilisateur SET Mot_de_Passe = $1 WHERE Adresse_EMail = $2";
        $result = pg_query_params($dbconn, $query, array($hashed_password, $email));

        if ($result) {
            echo "Votre mot de passe a été réinitialisé avec succès.";
        } else {
            echo "Erreur lors de la réinitialisation du mot de passe : " . pg_last_error($dbconn);
        }
    } else {
        echo "Les mots de passe ne correspondent pas.";
    }

    pg_close($dbconn);
} else {
    echo "Tous les champs sont requis.";
}
?>
