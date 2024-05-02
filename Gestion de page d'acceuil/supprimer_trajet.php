<?php
session_start();

$num = $_GET['num_trajet'];
$id_session = $_SESSION['id'];

if (isset($_SESSION['loginOK']) && $_SESSION['loginOK'] == true) {

    include('connexion_SQL.php');

    $reponse = mysqli_query($connexion, "SELECT * FROM trajets WHERE num_trajet='$num'") or die(mysqli_error($connexion));

    // On vérifie l'identité du créateur de la fiche :
    while ($donnees = mysqli_fetch_array($reponse)) {
        $id_trajet = $donnees['ID'];
    }

    if ($id_trajet == $id_session) {
        mysqli_query($connexion, "DELETE FROM trajets WHERE num_trajet='$num'");
        echo "</br>";
        echo "<h3 style='color:green'>Trajet supprimé avec succès !</h3>";
    } else {
        echo "<h3 style='color:red'>Une erreur est survenue</h3>";
        echo "</br>";
        echo "<a href=\"index.php?gestion_mes_trajets\">Retour à l'accueil</a>";
    }

} else {
    echo "Merci de vous identifier pour accéder à cette page";
}

mysqli_close($connexion);

?>
