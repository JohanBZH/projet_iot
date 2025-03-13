<?php
include '../Backend/functions.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Station météo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div id="header">
        <h1>Connectez-vous pour accéder aux données</h1>
    </div>
    </header>
    <main>
        <div class="horizontal" >
            <div id="loginform">
                
            <form action="user_check.php" method="POST">
                <input type="email" name="email" id="email" placeholder="jomayo@winners.fr">
                <div id="wrongmail"></div>
                <input type="password" name="password" placeholder="Mot de passe hyper compliqué">
                <button type="submit" id="signup">Se connecter</button>
            </form>
            <a href="account.php">S'inscrire</a>
         
            </div>
        </div>
    </main>
    
    <footer>
        <a href="https://github.com/JohanBZH/">Johan Mons</a>
        <a href="https://github.com/MarieEustace">Marie Eustace</a>
        <a href="https://github.com/yoannmey/">Yoann Meynsan</a>

        <script src="script.js"></script>
    </footer>
</body>
</html>