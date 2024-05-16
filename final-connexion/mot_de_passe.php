<?php
include '../bd/db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST[''])) {
    
    $email = pg_escape_string($dbconn, $_POST['email']);
    $token = bin2hex(random_bytes(50)); // Générer un token unique

    // Vérifier si l'email existe dans la base de données
    $sql = "SELECT * FROM Utilisateur WHERE Adresse_EMail = '$email'";
    $result = pg_query_params($conn, $sql, array($email));

    if (pg_num_rows($result) > 0) {
        // Insérer le token dans la base de données
        $sql = "UPDATE users SET reset_token = $1, reset_token_expires = NOW() + INTERVAL '1 hour' WHERE email = $2";
        pg_query_params($conn, $sql, array($token, $email));

        // Envoyer le lien de réinitialisation par email
        $reset_link = "http://yourdomain.com/new_pwd.php?token=$token";
        $subject = "Réinitialisation de votre mot de passe";
        $message = "Cliquez sur le lien suivant pour réinitialiser votre mot de passe : $reset_link";
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "Un lien de réinitialisation a été envoyé à votre adresse email.";
        } else {
            echo "Erreur lors de l'envoi de l'email.";
        }
    } else {
        echo "Cet email n'existe pas.";
    }

    pg_close($conn);
}
?>