<?php
$host = "localhost";  // Host name
$port = "5432";       // PostgreSQL port
$dbname = "web_php";    // Database name
$user = "postgres";  // Database username
$password = "postgres";  // Database password

$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
$dbconn = pg_connect($conn_string);

if (!$dbconn) {
    die("Connection failed: " . pg_last_error());
}
?>