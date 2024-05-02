
		
<?php
session_start();

if (isset($_SESSION['loginOK']) && $_SESSION['loginOK'] == true) {		
    
    $num = $_GET['num_trajet'];
    
    include('connexion_SQL.php');
    
    $reponse = pg_query_params($connexion, "SELECT * FROM trajets WHERE num_trajet=$1", array($num));
    
    while ($donnees = pg_fetch_assoc($reponse)) {
        $id2 = $donnees['id_conducteur'];
        $ville1 = $donnees['ville1'];
        $ville2 = $donnees['ville2'];
        $places_dsipo = $donnees['nbr_places'];
        $heure = $donnees['heure'];
        $type_trajet = $donnees['type_trajet'];
        $date_trajet = $donnees['date_trajet'];
        $coment = $donnees['coment'];
        $date_heure_saisie = $donnees['date_heure_saisie'];
    }
    
    $reponse3 = pg_query_params($connexion, "SELECT * FROM reservations WHERE num_trajet=$1", array($num));
    $places_rest = $places_dsipo - pg_num_rows($reponse3);
    
    $reponse2 = pg_query_params($connexion, "SELECT * FROM conducteurs WHERE id_conducteur=$1", array($id2));
    
    while ($donnees2 = pg_fetch_assoc($reponse2)) {
        $nom = $donnees2['nom'];
        $prenom = $donnees2['prenom'];
        $tel = $donnees2['tel'];
    } 
?>
<form name="formulaire" action="index.php?reserver&num_trajet=<?php echo "$num"; ?>"  method="post">
<?php 		
    echo "D&eacute;tails du trajet : ";
    echo "<strong>";
    echo $ville1; 
    echo "   =>   "; 
    echo $ville2; 
    echo "</strong>";
    echo "</br></br> Type de trajet : ";
    echo "$type_trajet";
    
    if ($type_trajet == "ponctuel") {
        echo "</br> Date du trajet :&nbsp;";
        echo "<strong>";
        echo "$date_trajet";
        echo "</strong>";
    }
    echo "</br></br> Places disponibles :&nbsp;";
    echo $places_dsipo;
    echo "</br></br> Places restantes :&nbsp;";
    echo $places_rest;
    echo "</br></br> Date de saisie :&nbsp;";
    echo $date_heure_saisie; 
    echo "<br /><br />Départ à : ";
    echo "<strong>";
    echo $heure; 
    echo "</strong>";
    echo "<br /><br /> Conducteur : ";
    echo "<strong>";
    echo $nom; 
    echo " ";
    echo $prenom;
    echo "</strong>";			
    echo "<br /><br />";
    echo "Téléphone : ";
    echo "<strong>";
    echo $tel; 
    echo "</strong>";
    echo "<br /><br />Commentaires : ";
    echo "<strong>";
    echo $coment;
    echo "</strong>";
    
    pg_close($connexion);

echo "</br></br>";	

echo "<table border=\"0\">";
    echo "<tr><td>";
        echo "<a href=\"contact.php?num_trajet=$num\" onClick=\"javascript:window.open('rediger_message.php?id=$id2','message','width = 400, height = 350, scrollbars = yes' )\" >";
        echo "<img src=\"images/enveloppe.jpg\" border=\"0\" width=\"60\" height=\"50\">";
        echo "</a>";
    echo "</td><td>";
        echo "<a href=\"contact.php?num_trajet=$num\" onClick=\"javascript:window.open('rediger_message.php?id=$id2','message','width = 400, height = 350, scrollbars = yes' )\" >";
        echo "Envoyer un message à ce conducteur";
        echo "</a>";
    echo "</td></tr>";
echo "</table>";

if ($places_rest > 0) {?>
<input type="submit" name="soumettre"  class="styled-button-12" value="réserver" />
<?php
} else {?>
<h4 style='color:red'>Ce trajet est complet ! </h4><br />

<?php }?>
</form>

<?php } else {
echo "</br></br></br></br>";
echo "<div align=\"center\">";
echo "Merci de vous identifier pour accéder à cette page.";
echo "</br></br><BR>";
echo "Vous n'êtes pas inscrits? <a href=\"saisir_donnees_perso.php\" TARGET=\"bas\">Formulaire d'inscription</a>";
echo "</div>";
}
?>
