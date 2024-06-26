<?php
session_start();
?>

<table width="920" border="0" align="left">
    <tr>
        <td width="150" valign="top">
            <?php include('frame_gauche.php'); ?>
        </td>

        <td width="770">

            <?php

            if (isset($_SESSION['loginOK']) && $_SESSION['loginOK'] == true) {
                include('menus_session.htm');
                echo "</br></br>";
            }
            $ord = "";
            if (isset($_GET['ord'])) {
                $ord = $_GET['ord'];
                if ($ord == "") {
                    $ord = 2;
                }
            }
            ?>
            <html>
            <div align="center"><strong>Liste des trajets enregistrés sur le site </strong><br /> (cliquer sur une rubrique pour changer l'ordre de tri)<br /></div>

            <table width="730" border="1" align="center" cellspacing="0">
                <caption>&nbsp;</caption>
                <tr>
                    <th width="140">
                        <div align="center"><a href="trajets.php?ord=1">
                                <?php if ($ord == 1) {
                                    echo ">&nbsp;";
                                }
                                echo "Ville de départ";
                                if ($ord == 1) {
                                    echo "&nbsp;<";
                                } ?></a></div>
                    </th>

                    <th width="140">
                        <div align="center"><a href="trajets.php?ord=2">
                                <?php if ($ord == 2) {
                                    echo ">&nbsp;";
                                }
                                echo "Ville d'arrivée";
                                if ($ord == 2) {
                                    echo "&nbsp;<";
                                } ?> </a></div>
                    </th>

                    <th width="140">
                        <div align="center"><a href="trajets.php?ord=3">
                                <?php if ($ord == 3) {
                                    echo ">&nbsp;";
                                }
                                echo "Heure de départ";
                                if ($ord == 3) {
                                    echo "&nbsp;<";
                                } ?> </a></div>
                    </th>

                    <th width="140">
                        <div align="center"><a href="trajets.php?ord=4">
                                <?php if ($ord == 4) {
                                    echo ">&nbsp;";
                                }
                                echo "Type de trajet";
                                if ($ord == 4) {
                                    echo "&nbsp;<";
                                } ?> </a></div>
                    </th>

                    <th width="120">
                        <div align="center">Voir les détails </div>
                    </th>
                </tr>
                <tr>
                    <?php

                    $classer = "date";
                    if ($ord == 1) {
                        $classer = "ville1";
                    } elseif ($ord == 2) {
                        $classer = "ville2";
                    } elseif ($ord == 3) {
                        $classer = "heure";
                    } elseif ($ord == 4) {
                        $classer = "type_trajet";
                    }

                    include('connexion_SQL.php');

                    $reponse = mysqli_query($connexion, "SELECT * FROM trajets ORDER BY $classer ") or die(mysqli_error($connexion));

                    while ($donnees = mysqli_fetch_array($reponse)) {
                        $num_T = $donnees['num_trajet'];
                        $ident = $donnees['ID'];
                        $ville1 = $donnees['ville1'];
                        $ville2 = $donnees['ville2'];
                        $heure = $donnees['heure'];
                        $type_trajet = $donnees['type_trajet'];
                        $date_trajet = $donnees['date_trajet'];
                        $date = $donnees['date'];

                        echo "<TR>";
                        echo "<TD><div align=\"center\"> $ville1 </div></TD>";
                        echo "<TD><div align=\"center\"> $ville2 </div></TD>";
                        echo "<TD><div align=\"center\"> $heure </div></TD>";

                        echo "<TD><div align=\"center\"> $type_trajet";
                        if ($type_trajet == "ponctuel") {
                            echo ": " . $date_trajet;
                        }
                        echo "</div></TD>";

                        echo "<TD><div align=\"center\"> <a href=\"contact.php?num_trajet=$num_T\" >voir les détails</a><div align=\"center\"> </TD>";
                        echo "</TR>";
                    }

                    mysqli_close($connexion);

                    ?>
            </table>

        </td>
    </tr>

</table>

</html>
