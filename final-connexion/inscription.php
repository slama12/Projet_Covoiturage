<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="menu.css"> <!-- Link to your existing menu bar CSS file -->
    <link rel="stylesheet" href="style.css"> <!-- Link to the new login page CSS file -->
</head>
<body>
    <div id="menu-container"></div>
    <script>
        window.onload = function() {
            fetch('menuBar.html')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('menu-container').innerHTML = html;
                })
                .catch(error => console.error('Error loading the menu:', error));
        };
    </script>

    <div class="overlay">
        <form action="c_compte.php" method="POST">
            <div class="con">
                <header class="head-form">
                    <h2>Inscrivez-vous</h2>
                    <p>Veuillez saisir vos informations pour que nous puissions créer votre compte.</p>                    
                </header>
                <div class="field-set">
                    <!-- Last Name Input-->
                    <span class="input-item">
                        <i class="fa fa-user"></i>
                    </span>
                    <input class="form-input" id="txt-input" name="nom" type="text" placeholder="Nom" required>
                    <br>
                    <!-- First Name Input-->
                    <span class="input-item">
                        <i class="fa fa-user"></i>
                    </span>
                    <input class="form-input" id="txt-input" name="prenom" type="text" placeholder="Prenom" required>
                    <br>
                    <!--Phone Input-->
                    <span class="input-item">
                        <i class="fa fa-phone"></i>
                    </span>
                    <input class="form-input" id="txt-input" name="phone" type="text" placeholder="Phone" required>
                    <br>
                    <!--Email -->
                    <input type="hidden" name="email" value= "<?php echo htmlspecialchars($_GET['email']); ?>">
                    <!-- <span class="input-item">
                        <i class="fa fa-envelope"></i>
                    </span> -->
                    <!--Email Input-->
                    <!-- <input class="form-input" id="txt-input" name="email" type="text" placeholder="@Email" required>
                    <br> -->
                    <!-- Password -->
                    <span class="input-item">
                        <i class="fa fa-lock"></i>
                    </span>
                    <!-- Password Input-->
                    <input class="form-input" type="password" placeholder="New Password" id="pwd" name="password" required>
                    <span>
                        <i class="fa fa-eye" aria-hidden="true" type="button" id="eye"></i>
                    </span>
                    <br>
                    <!-- Submit Button -->
                    <!-- <button class="submit-button" type="submit">Reset Password</button> -->
                    <button class="submit-button" type="submit" name="signup" >Valider</button>
                </div>
            </div>
        </form>
    </div>
    <script src="script.js"></script> <!-- Ensure this script handles any dynamic elements like password visibility toggle -->
</body>
</html>
