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
        <h1>Créer votre compte pour accéder aux données</h1>
    </div>
    </header>
    <main>
        <div class="horizontal" >
            <div id="loginform">
                
            <form action="account.php" method="POST">
                <input type="mail" name="mail" placeholder="jomayo@winners.fr">
                <input type="text" name="password" placeholder="Mot de passe hyper compliqué">
                <button type="submit" id="signin">Créer mon compte</button>
            </form>
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