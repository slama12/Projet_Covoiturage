<?php
session_start();

$id = $_SESSION['id'];

if (isset($_SESSION['loginOK']) && $_SESSION['loginOK'] == true) {

    include('connexion_SQL.php');

    mysqli_query($connexion, "DELETE FROM trajets WHERE ID='$id'");

    mysqli_query($connexion, "DELETE FROM conducteurs WHERE ID='$id'");

    mysqli_close($connexion);

    $_SESSION = array();

    session_destroy();

    include('index2.php');
}


	