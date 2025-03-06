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
        <h1>Bienvenue sur la micro-station météo du CESI de Brest</h1>
    </div>
    </header>
    <main>
        <div class="horizontal" >
            <div id="loginform">
                <h2>Connectez-vous pour accéder aux données</h2>
            <form action="account.php" method="POST">
                <input type="text" name="login" placeholder="Nom d'utilisateur">
                <input type="text" name="password" placeholder="Mot de passe">
                <button type="submit" id="signin">Se connecter</button>
                <button type="submit" id="signup">S'inscrire</button>
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