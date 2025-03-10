<?php
include '../Backend/db_conn.php';
// include '../Backend/functions.php';
// include '../Backend/vendor/autoload.php';

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
                
            <form action="data.php" method="POST">
                <input type="email" name="email" placeholder="jomayo@winners.fr">
                <div id="wrongmail"></div>
                <input type="text" name="password1" placeholder="Mot de passe hyper compliqué">
                <input type="text" name="password2" placeholder="Confirmez le mot de passe">
                <button type="submit" id="signup">Créer mon compte</button>
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