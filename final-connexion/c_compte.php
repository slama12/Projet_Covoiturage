<?php
include '../bd/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["signup"])) {
        // Retrieve data from form
        $username = pg_escape_string($dbconn, $_POST['nom']);
        $firstname = pg_escape_string($dbconn, $_POST['prenom']);
        $email = pg_escape_string($dbconn, $_POST['email']);
        $password = pg_escape_string($dbconn, $_POST['password']);
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $phone = pg_escape_string($dbconn, $_POST['phone']);

        $query = "INSERT INTO Utilisateur (Nom_Utilisateur, Prenom_Utilisateur, Adresse_EMail, Mot_de_Passe, Numero_Telephone) VALUES ('$username', '$firstname', '$email', '$hashed_password', '$phone')";
        $result = pg_query($dbconn, $query);

        if ($result) {
            echo "Registration successful!";
        } else {
            echo "Error: " . pg_last_error($dbconn);
        }


        pg_close($dbconn);
    } elseif (isset($_POST["login"])) {
        $email = pg_escape_string($dbconn, $_POST['email']);
        $password = $_POST['password'];

        // Fetch user from the database
        $query = "SELECT * FROM Utilisateur WHERE Adresse_EMail = '$email'";
        $result = pg_query($dbconn, $query);
        $user = pg_fetch_assoc($result);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
            $username = $user['nom_utilisateur'];
            echo "Login successful. Welcome, " . htmlspecialchars($username) . "!";
            // Redirect to dashboard or home page
            // header("Location: dashboard.php");
            // exit();
        } else {
            echo "<script>alert('Invalid username or password.'); window.location='login.html'</script>";
        }

        pg_close($dbconn);
    }
}
