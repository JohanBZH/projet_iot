<!-- <?php
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
        <h1>Créer votre compte pour accéder aux données</h1>
    </div>
    <main>
        <div class="horizontal" >
            <div id="loginform">
                
            <form action="create_user.php" method="POST">
                <input type="email" name="email" placeholder="jomayo@winners.fr">
                <div id="wrongmail"></div>
                <input type="password" name="password" placeholder="Mot de passe hyper compliqué">
                <input type="password" name="passwordcheck" placeholder="Confirmez le mot de passe">
                <button type="submit" id="signup">Créer mon compte</button>
            </form>
            </div>
        </div>
    </main>
    
    <?php include 'footer.php' ?>
    <script src="script.js"></script>
</body>
</html> -->