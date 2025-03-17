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
<?php include 'header.php' ?>
        <div id="header">
        <h1>Connectez-vous pour accéder aux données</h1>
    </div>
    <main>
        <div class="horizontal" >
            <div id="loginform">
                
            <form action="../Backend/user_check.php" method="POST">
                <input type="email" name="email" id="email" placeholder="jomayo@winners.fr">
                <div id="wrongmail"></div>
                <input type="password" name="password" placeholder="Mot de passe hyper compliqué">
                <button type="submit" id="signup">Se connecter</button>
            </form>
            <a href="account.php">S'inscrire</a>
         
            </div>
        </div>
    </main>
    
    <?php include 'footer.php' ?>
    <script src="script.js"></script>
</body>
</html>