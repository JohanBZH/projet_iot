<?php
include '../Backend/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Profil</title>
</head>
<body>
    <?php include 'header.php'?>
    <div class="container">
        <div class="center">
            <h1>Informations du profil :</h1>
        </div>
        <div class="center">
            <div id="profilContent">
                <h2>Adresse mail : <?php echo $_SESSION['login'];?></h2>
                <div id="changePwd">
                    <h2>Changer de mot de passe :</h2>
                    <form id="formPwd" action="../Backend/change_pwd.php" method="POST">
                        <input type="password" name="lastPwd" placeholder="Votre ancien mot de passe">
                        <input type="password" name="newPwd" placeholder="Nouveau mot de passe">
                        <input type="password" name="newPwd2" placeholder="Retapez le nouveau mot de passe">
                        <button type="submit">Change</button>
                    </form>
                </div>
                <div id="delAcc">
                    <h2>Supprimer votre compte :</h2>
                    <form id="formDel" action="../Backend/delete_account.php" method="POST">
                        <input type="text" name="confirm" placeholder="Veuillez écrire confirmer">
                        <button type="submit" id="btnDel">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>