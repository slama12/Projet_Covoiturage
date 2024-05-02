<?php
include 'db_connect.php';

$sql = "SELECT u.id_utilisateur AS id, u.nom_utilisateur || ' ' || u.prenom_utilisateur AS name, r.libellerole AS role 
FROM utilisateur u
LEFT JOIN affecte a ON u.id_utilisateur = a.id_utilisateur
LEFT JOIN role r ON r.libellerole = r.libellerole;";

$result = pg_query($dbconn, $sql);
if (!$result) {
    echo "An error occurred.\n";
    exit;
}

$users = pg_fetch_all($result);
echo json_encode($users);

pg_close($dbconn);
?>

