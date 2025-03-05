<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Station météo</title>
</head>
<body>
    <header>
        <div id="header">
        <h1>Bienvenue sur la micro-station météo du CESI de Brest</h1>
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
                <h2>Affichage live / graphs sur les 10 dernières min</h2>
                <div class="horizontal" id="recentTable">
                    <table>
                        <thead>
                            <tr>
                                <th class="headerTime">Heure</th>
                                <th class="headerTemp">Température</th>
                                <th class="headerXPTemp">Température <br>ressentie</th>
                                <th class="headerHumidity">Humidité</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="rowTime">14h</td>
                                <td data-label="rowTemp">15</td>
                                <td data-label="rowXPTemp">13</td>
                                <td data-label="rowHumidity">24</td>
                            </tr>
                            <tr>
                                <td data-label="rowTime">14h</td>
                                <td data-label="rowTemp">15</td>
                                <td data-label="rowXPTemp">13</td>
                                <td data-label="rowHumidity">24</td>
                            </tr>
                            <tr>
                                <td data-label="rowTime">14h</td>
                                <td data-label="rowTemp">15</td>
                                <td data-label="rowXPTemp">13</td>
                                <td data-label="rowHumidity">24</td>
                            </tr>
                            <tr>
                                <td data-label="rowTime">14h</td>
                                <td data-label="rowTemp">15</td>
                                <td data-label="rowXPTemp">13</td>
                                <td data-label="rowHumidity">24</td>
                            </tr>
                            <tr>
                                <td data-label="rowTime">14h</td>
                                <td data-label="rowTemp">15</td>
                                <td data-label="rowXPTemp">13</td>
                                <td data-label="rowHumidity">24</td>
                            </tr>
                            </tbody>
                    </table>
                </div>
                <div class="graph">
                    <img src="https://weather-and-climate.com/uploads/average-rainfall-france-brest-fr.png" alt="">
                </div>
            </div>
        </div>
    </main>
    <footer>
        <a href="https://github.com/JohanBZH/">Johan Mons</a>
        <a href="https://github.com/MarieEustace">Marie Eustace</a>
        <a href="https://github.com/yoannmey/">Yoann Meynsan</a>
    </footer>

    <?php

    include '../Backend/functions.php';

    include '../Backend/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable('/home/jomayo/www/Frontend'); //
    $dotenv->load();

    $deb=0;

    try {

        $dsn = "mysql:host={$_ENV['MYSQL_HOST']};dbname={$_ENV['MYSQL_DATABASE']};charset=utf8mb4";
        
$deb=1;

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
$deb=2;
        $db = new PDO($dsn, $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $options);

        //insertUser(<'login'>,<'password'>,$db);
        //insertData(<'time_val'>, <'temperature_val'>, <'humidity_val'>, $db);

        echo "Connexion réussie !<br>";

    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());

        echo $deb;
        die("Une erreur s'est produite.");
    }
    ?>
    <script src="script.js"></script>
</body>
</html>

<!-- <'login'> , <'password'> -->