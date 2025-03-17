<?php
include '../Backend/functions.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Historique</title>
</head>
<body>
    <?php include 'header.php' ?>
    <div class="container">
        <div class="center" >
            <h2>Affichage live</h2>
        </div>
        <div class="center">
            <div id="tab">
                    <?php
                        //Get all the data
                        $averageTable = [];
                        $data = queryAllData($db);

                        //Calculate by batches of 5 data set the average to smoothen the datas
                        calculateSlidingAverage($data, $averageTable);
                        insertInTable($averageTable);

                        //Save the data in the session opened in functions.php
                        $_SESSION['data_to_export'] = $data;
                        ?>
            </div>
        </div>
        <!-- Data export -->
        <div class="center">
            <form action="../Backend/functions.php" method="POST">
                <input type="submit" id="exportBtn" name="export" value="Télécharger les données">
            </form>
            <form action="../Backend/functions.php" method="POST">
                <input type="submit" id="exportBtn" name="exportMail" value="Envoyer par mail">
            </form>
        </div>
        <div class="center">
            <div id="graph">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>
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