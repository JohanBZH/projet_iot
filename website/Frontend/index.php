<?php
include '../Backend/functions.php';
include '../Backend/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('/home/jomayo/www/Frontend');
$dotenv->load();

$deb = 0;

$temperature = isset($_GET['temperature']) ? $_GET['temperature'] : null;
$humidity = isset($_GET['humidity']) ? $_GET['humidity'] : null;
$time_stamp = date('Y-m-d H:i:s');

try {
    $dsn = "mysql:host={$_ENV['MYSQL_HOST']};dbname={$_ENV['MYSQL_DATABASE']};charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $db = new PDO($dsn, $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $options);
    echo "Connexion réussie !<br>";

    if ($temperature !== null && $humidity !== null && is_numeric($temperature) && is_numeric($humidity)) {
        $floatTemperature = (float)$temperature;
        $floatHumidity = (float)$humidity;
        echo "Température: " . $floatTemperature . " °C<br>";
        echo "Humidité: " . $floatHumidity . " %<br>";
        $floatTemperature = $floatTemperature/100;
        $floatHumidity = $floatHumidity/100;
        echo "Température: " . $floatTemperature . " °C<br>";
        echo "Humidité: " . $floatHumidity . " %<br>";
        $stmt = $db->prepare("INSERT INTO Data (Temperature_value, Humidity_value, Time_stamp) VALUES (:temperature, :humidity, :time_stamp)");
        $stmt->bindParam(':temperature', $floatTemperature);
        $stmt->bindParam(':humidity', $floatHumidity);
        $stmt->bindParam(':time_stamp', $time_stamp);
        $stmt->execute();
        echo "Données insérées avec succès !<br>";
    } else {
        echo "Données manquantes ou invalides, insertion annulée.<br>";
    }

} catch(PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo "Erreur de la base de données : " . $e->getMessage() . "<br>";
}
?>

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
                        <tbody>
                        <?php
                            //Save the data averages
                            $averageTable = [];

                            $query = "SELECT Time_stamp, Temperature_value, Humidity_value FROM Data ORDER BY Time_stamp DESC LIMIT 10";
                            $result = $db->query($query);
                            $data = $result->fetchAll(); // Récupère les données sous forme de tableau associatif

                            calculateSlidingAverage($data, $averageTable);

                            // Print table
                            if (!empty($averageTable)) {
                                echo "<table border='1'>
                                        <tr>
                                            <th>Time</th>
                                            <th>Temperature (°C)</th>
                                            <th>Humidité (%)</th>
                                        </tr>";
                                
                                foreach ($averageTable as $entry) {
                                    echo "<tr>
                                            <td>{$entry['time']}</td>
                                            <td>{$entry['temperature']}</td>
                                            <td>{$entry['humidite']}</td>
                                        </tr>";
                                }
                                
                                echo "</table>";
                            } else {
                                echo "Aucune donnée disponible.";
                            }

                            ?>
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

    <script src="script.js"></script>
</body>
</html>