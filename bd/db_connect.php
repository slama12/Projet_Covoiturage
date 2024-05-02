<?php
$host = "localhost";  // Host name
$dbname = "web_php";    // Database name
$user = "postgres";  // Database username
$password = "postgres";  // Database password


$dbconn = pg_connect("host=$host user=$user password=$password dbname=$dbname");

if (!$dbconn) {
    die("Connection failed: " . pg_last_error());
    
}else{
    print("Connection succès");
}

?>