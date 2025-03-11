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
                <h2>Affichage live</h2>
                <div class="horizontal" id="recentTable">
                        <?php
                            //Save the data averages
                            $averageTable = [];

                            $query = "SELECT Time_stamp, Temperature_value, Humidity_value FROM Data ORDER BY Time_stamp DESC";
                            $result = $db->query($query);
                            $data = $result->fetchAll(); // Get data in an associative array

                            calculateSlidingAverage($data, $averageTable);

                            insertInTable($averageTable);

                            $db = null; //Ferme la connexion
                            ?>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

    var averageTemperature= <?php echo json_encode(array_column($averageTable, 'temperature')); ?>;
    var averageHumidity = <?php echo json_encode(array_column($averageTable, 'humidite')); ?>;
    var labels = <?php echo json_encode(array_column($averageTable, 'time')); ?>;
    
        for(let key in labels){
            labels[key] = labels[key].slice(5,16)
        }
        console.log(labels);

        const dataTemp = {
        labels: labels,
        datasets: [{
            label: 'Temperature',
            data: averageTemperature,
            fill: false,
            borderColor: 'rgb(253, 108, 158)',
            tension: 0.3
        },
        {
            label: 'Humidité',
            data: averageHumidity,
            fill: false,
            borderColor: 'rgb(64,224,208)',
            tension: 0.3
        }]
        };

        const config = {
            type: 'line',
            data: dataTemp,
        };
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
</body>
</html>