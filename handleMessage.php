<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender = pg_escape_string($dbconn, $_POST['sender']);
    $receiver = pg_escape_string($dbconn, $_POST['receiver']);
    $content = pg_escape_string($dbconn, $_POST['message']);

    $sql = "INSERT INTO message (contenu_message, date_d_envoie, id_utilisateur, id_utilisateur_1) VALUES ('$content', now(), '$sender', '$receiver')";
    $result = pg_query($dbconn, $sql);
    
    if (!$result) {
        echo "An error occurred.\n";
    } else {
        echo "Message sent successfully.";
    }
}

pg_close($dbconn);
?>
