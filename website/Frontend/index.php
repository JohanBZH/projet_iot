<?php
include '../Backend/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">
    <title>Station météo</title>
</head>
<body>
    <header>
        <div id="header">
        <h1>Bienvenue sur la micro-station météo du CESI de Brest</h1>
        <a href="login.php" id="openLogin">LOGIN</a>
        </div>
    </header>
    <main>
        <div id="container weather">
            <div class="horizontal" >
                <div class="emoji-container">
                    <img src="https://emojitool.com/img/google/15.1/15.1-2762.png" alt="" id="snowyemoji" class="emoji">
                    <!-- <img src="" alt="https://emojitool.com/img/google/15.1/15.1-1446.png"  id="rainyemoji" class="emoji">
                    <img src="https://emojitool.com/img/google/15.1/15.1-339.png" alt=""  id="sunnyemoji" class="emoji">
                    <img src="" alt="https://emojitool.com/img/messenger/1.0/cloud-5505.png"  id="cloudyemoji" class="emoji">   -->
                </div>
                <h2>Il fait actuellement</h2>
                <div class="horizontal" id="recentTable">
                    <table>
                        <tbody>
                        <?php
                            //Save the data averages
                            $averageTable = [];
                            queryAllData();
                            calculateSlidingAverage($data, $averageTable);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="graph">
            <canvas id="myChart"></canvas>
        </div>

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
    </footer>


    <!-- <script src="script.js"></script> -->
</body>
</html>