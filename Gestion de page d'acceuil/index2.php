<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
    <style type="text/css">
        <!--
        body {
            background-color: #FFFFFF;
        }

        .Style5 {
            font-size: 14px;
        }

        -->
    </style>
</head>

<body>
    <table width="940" border="0" align="left">
        <tr>
            <td width="150" valign="top">
                <?php include('frame_gauche.php'); ?>
            </td>

            <td>

                <table width="770" border="0" align="left">
                    <tr>
                        <td>
                            <?php
                            if (isset($_SESSION['loginOK'])) {
                                include('menus_session.htm');
                                echo "<BR><HR>";
                            } else {
                            ?>

                                <table width="770" border="0" align="left">

                                    <tr>

                                        <td>


                                            <div ALIGN="center" class="Style5">Afin d'encourager les économies d'énergie cette page propose de mettre en relation des conducteurs et des passagers. <br>
                                                Ce site de covoiturage vous permet de rentrer en contact facilement avec d'autres conducteurs
                                                afin d'organiser des trajets à plusieurs, d'une façon régulière ou ponctuelle.
                                            </div>

                                            <HR>

                                        </td>
                                    </tr>

                                    <?php } ?>


                                    <tr>
                                        <td>

                                            <table width="750" border="0" align="center">
                                                <tr>
                                                    <td>
                                                        <div align="left"><strong>Derniers trajets enregistrés:</strong></div>
                                                    </td>
                                                    <td>
                                                        <div align="right"><a href="trajets.php" TARGET="bas">Voir tous les trajets</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                                    </td>
                                                </tr>
                                            </table>

                                            <br>

                                            <table width="680" border="1" cellspacing="0" align="center">

                                                <tr>
                                                    <th width="130">
                                                        <div align="center">Ville de départ </div>
                                                    </th>
                                                    <th width="130">
                                                        <div align="center">Ville d'arrivée </div>
                                                    </th>
                                                    <th width="120">
                                                        <div align="center">Heure de départ </div>
                                                    </th>
                                                    <th width="125">
                                                        <div align="center">Type de trajet </div>
                                                    </th>
                                                    <th width="115">
                                                        <div align="center">Voir les détails </div>
                                                    </th>
                                                </tr>
                                                <?php
                                                include('connexion_SQL.php');

                                                $reponse = pg_query($connexion, "SELECT * FROM trajets ORDER BY date DESC LIMIT 10") or die(pg_last_error($connexion));

                                                while ($donnees = pg_fetch_array($reponse)) {
                                                    $num_T = $donnees['num_trajet'];
                                                    $ident = $donnees['ID'];
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

                                                    echo "<td> <div align=\"center\"><a href=\"contact.php?num_trajet=$num_T\" >voir les détails</a> </div></td>";
                                                    echo "</tr>";
                                                }

                                                pg_close($connexion);
                                                ?>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>

                                            <br>

                                            <?php
                                            $depart = "peu importe";
                                            $arrivee = "peu importe";
                                            include('recherche_trajet.php');
                                            ?>

                                            <HR>
                                            <strong>
                                                Statistiques:
                                            </strong>

                                            <BR><BR>

                                            <?php
                                            include('connexion_SQL.php');

                                            $reponse = pg_query($connexion, "SELECT COUNT(*) AS n_inscrits FROM conducteurs");
                                            $retour = pg_query($connexion, "SELECT COUNT(*) AS n_trajets FROM trajets");

                                            $trajets_compt = pg_fetch_array($retour);
                                            $inscrits_compt = pg_fetch_array($reponse);

                                            $n_incrits = $inscrits_compt['n_inscrits'];
                                            $n_traj = $trajets_compt['n_trajets'];

                                            pg_close($connexion);

                                            include('compteur.php');
                                            echo "<BR></BR>";
                                            echo $n_incrits . " inscrits sur le site, " . $n_traj . " trajets enregistrés.";
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </table>
            </td>
        </tr>
    </table>

</body>

</html>
