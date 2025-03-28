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
<?php include 'header.php' ?>
    <div class="container">
        <div class="center" id="sousmenu">
            <h1 class="justify">Bienvenue sur le site JOMAYO, la météo du campus de CESI Brest en temps réel !</h1>
        </div>
        <div id="center">
            <div id="content">
                <div class="superpose">
                    <div class="imgCenter">
                        <img class="img" src="img/thermoBlanc.png">
                    </div>
                    <span id="temp">
                        <?php 
                            echo $lastGet[0]['Temperature_value'], "°C";
                        ?>
                    </span>
                </div>
                <div class="superpose">
                    <div class="imgCenter">
                        <img class="img" src="img/goutte.png">
                    </div>
                    <span id="hum">
                    <?php 
                            echo $lastGet[0]['Humidity_value'],"%";
                        ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="center">
            <h2>Heure du dernier relevé :</h2>
        </div>
        <div id="heure" class="center">
            <img class="img" src="img/reveil.png">
            <span id="time">
                <?php 
                    $time = substr($lastGet[0]['Time_stamp'],11, -3);
                    echo $time;
                ?>
            </span>
        </div>
        <div class="center">
            <h2 id="warning" class="justify">Si vous voulez accéder à plus de données, vous devez être connecté !</h2>
        </div>
    </div>
    <?php include 'footer.php' ?>
    <script src="script.js"></script>
</body>
</html>