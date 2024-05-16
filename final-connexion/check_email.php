<?php
include '../bd/db_connect.php';

if(isset($_POST['password'])) {
    $email = $_POST['email'];
    $query = "SELECT * FROM Utilisateur WHERE Adresse_EMail = '$email'";
    $result = pg_query($dbconn, $query);

    if (pg_num_rows($result) > 0) {
        echo json_encode(array("exists" => true));
    } else {
        echo json_encode(array("exists" => false));
    }

    pg_free_result($result);
    pg_close($dbconn);
}
?>