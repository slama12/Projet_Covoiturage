<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation du mot de passe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="style.css">
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
        <form action="reset_password.php" method="POST">
            <div class="con">
                <header class="head-form">
                    <h2>Changez votre mot de passe</h2>
                    <p>Veuillez saisir un nouveau mot de passe pour le modifier.</p>
                </header>
                <div class="field-set">
                    <input type="hidden" name="email" value= "<?php echo htmlspecialchars($_GET['email']); ?>">
                    <!-- Password -->
                    <span class="input-item">
                        <i class="fa fa-lock"></i>
                        </span>
                    <input class="form-input" type="password" placeholder="New Password" id="new_password" name="new_password" required>
                    <span>
                        <i class="fa fa-eye" aria-hidden="true" type="button" id="eye" onclick="togglePassword('new_password', 'eye')"></i>
                    </span>
                    <br>
                    <!-- Confirm Password -->
                    <span class="input-item">
                        <i class="fa fa-lock"></i>
                        </span>
                    <input class="form-input" type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password" required>
                    <span>
                        <i class="fa fa-eye" aria-hidden="true" type="button" id="eye" onclick="togglePassword('confirm_password', 'eye')"></i>
                    </span>
                    <br>
                    <!-- Submit Button -->
                    <button class="submit-button" type="submit">Réinitialiser</button>
                </div>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
