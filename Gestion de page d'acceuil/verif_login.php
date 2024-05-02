<?php
session_start();
?>
<?php
include('connexion_SQL.php');

// Vérifier si les champs pseudo et password existent dans $_POST
if (isset($_POST['pseudo']) && isset($_POST['password'])) {
    $pseudo = mysqli_real_escape_string($connexion, htmlspecialchars($_POST['pseudo']));
    $password = mysqli_real_escape_string($connexion, htmlspecialchars($_POST['password']));

    // Vérifier si les champs pseudo et password ne sont pas vides
    if (!empty($pseudo) && !empty($password)) {
        $query = "SELECT * FROM conducteurs WHERE pseudo='$pseudo'";
        $result = mysqli_query($connexion, $query);

        if ($result) {
            // Vérifier si un résultat a été retourné
            if (mysqli_num_rows($result) == 1) {
                $donnees = mysqli_fetch_assoc($result);

                // Vérifier si le mot de passe correspond
                if ($password == $donnees['mdp']) {
                    $_SESSION['pseudo'] = $donnees['pseudo'];
                    $_SESSION['id'] = $donnees['id_conducteur'];
                    $_SESSION['mail'] = $donnees['mail'];
                    $_SESSION['loginOK'] = true;

                    header('Location: index.php'); // Redirection vers la page d'accueil
                    exit();
                } else {
                    $error_message = "Mot de passe incorrect !";
                }
            } else {
                $error_message = "Désolé, ce pseudo n'existe pas !";
            }
        } else {
            $error_message = "Une erreur est survenue, veuillez réessayer !";
        }

        // Libérer le résultat de la requête
        mysqli_free_result($result);
    } else {
        $error_message = "Veuillez remplir tous les champs !";
    }
} else {
    $error_message = "Une erreur est survenue, veuillez réessayer !";
}

// Inclure index.php et afficher un message d'erreur s'il y a lieu
include('index.php');
if (isset($error_message)) {
    echo "<script>alert('" . addslashes($error_message) . "')</script>";
}

// Fermer la connexion à la base de données
mysqli_close($connexion);
?>