
<?php
// Début de la session de connexion de l´utilisateur
session_start();

$_SESSION["Utilisateur"]="Bienvenue cher Client ";

echo $_SESSION["Utilisateur"] . "<br/>";

// Etablissement de la connexion avec la BD :
$connexion = pg_connect("host=localhost port= 5432 dbname= Projet_Covoiturage user= postgres password =rami02");

// Checker la connexion :
if (!$connexion){
echo "Connection Failed" . "<br/>";
}
else {
echo "Connected successfully" . "<br/>";
}


// Formulaire en PHP :

// Le formulaire a été soumis, traiter les données ici
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
// Récupération des données avec la méthode POST :
$heure_depart =pg_escape_string($connexion, $_POST["Heure_de_depart"]);
$date_trajet=pg_escape_string($connexion, $_POST["Date_Trajet"]);
$places_disponibles =pg_escape_string($connexion, $_POST["Places_disponibles"]);
$lieu_de_rendez_vous =pg_escape_string($connexion, $_POST["Lieu_de_rendez_vous"]); 
}
else {
echo " Formulaire non soumis pour traitement ! " ;
}


echo "Heure de depart:" . " ". $heure_depart . "<br/>";
echo "Date de trajet:" . " ". $date_trajet . "<br/>";
echo "Places disponibles:" . " ". $places_disponibles . "<br/>";
echo"Lieu de rdv:" . " ". $lieu_de_rendez_vous . "<br/>";

// Requete SQL:
$query="INSERT INTO trajet (heure_depart, date_trajet, places_disponibles, lieu_de_rendez_vous) VALUES ('$heure_depart','$date_trajet','$places_disponibles', '$lieu_de_rendez_vous')";

// Execution de la requete SQL :
$result = pg_query($connexion, $query);

if (!$result){
echo "Erreur lors de l'insertion des données dans votre BD :". pg_last_error($connexion);

} else {
echo " Trajet enregistré avec succès ! ";

}

// Fermeture de la connexion
pg_close($connexion);

// Détruire la session
session_destroy();


?>
