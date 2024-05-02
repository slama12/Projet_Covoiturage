<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<table width="940" border="0" align="left">
    <tr>
        <td width="150" valign="top">
            <?php include('frame_gauche.php'); ?>
        </td>

        <td width="770" valign="top">

            <?php

            if (isset($_SESSION['loginOK']) && $_SESSION['loginOK'] == true) {
                include('menus_session.htm');
                echo "</br></br>";
                echo "Vos trajets : ";
                echo $_SESSION['pseudo'];

                echo "</br></br>";
                echo "<a href=\"saisir_trajet.php\">Saisir un nouveau trajet</a>";

                echo "</br></br></br>";

                $id_cond = $_SESSION['id'];

                include('connexion_SQL.php');

                $retour = mysqli_query($connexion, "SELECT COUNT(*) AS nbre_entrees FROM trajets WHERE ID='$id_cond'");
                $donnees_compt = mysqli_fetch_array($retour);
                $i = $donnees_compt['nbre_entrees'];

                $reponse = mysqli_query($connexion, "SELECT * FROM trajets WHERE ID='$id_cond'") or die(mysqli_error($connexion));


                if ($i == 0) {
                    echo "pas de trajet enregistré";
                    echo "</br></br>";
                } else {
                    ?>
                    <table width="710" border="1" align="center" cellspacing="0">
                        <tr>
                            <th width="130"> <div align="center">Ville de départ </div></th>
                            <th width="130"><div align="center">Ville d'arrivée </div></th>
                            <th width="120"><div align="center">Heure de départ </div></th>
                            <th width="120"><div align="center">Type de trajet</div></th>
                            <th width="100"><div align="center">Modifier</div></th>
                            <th width="100"><div align="center">Supprimer</div></th>
                        </tr>
                        <?php

                        while ($donnees = mysqli_fetch_array($reponse)) {
                            $num_trajet = $donnees['num_trajet'];
                            $ville1 = $donnees['ville1'];
                            $ville2 = $donnees['ville2'];
                            $heure = $donnees['heure'];
                            $type_trajet = $donnees['type_trajet'];
                            $date_trajet = $donnees['date_trajet'];

                            echo "<tr>";
                            echo "<td><div align=\"center\"> $ville1 </div></td>";
                            echo "<td><div align=\"center\"> $ville2 </div></td>";
                            echo "<td><div align=\"center\"> $heure </div></td>";

                            echo "<td><div align=\"center\"> $type_trajet";
                            if ($type_trajet == "ponctuel") {
                                echo ": " . $date_trajet;
                            }
                            echo "</div></td>";

                            echo "<td><div align=\"center\"><a href=\"saisir_trajet.php?modif=1&num_trajet=$num_trajet\">modifier</a></div></td>";
                            echo "<td><div align=\"center\"><a href=\"supprimer_trajet.php?num_trajet=$num_trajet\">supprimer</a></div></td>";
                            echo "</tr>";

                        }
                        echo "</table>";
                    }

            } else {
                echo "Merci de vous identifier pour accéder à cette page";
                include('index2.php');
            }

            ?>

        </td>
    </tr>

</table>

</body>
</html>




