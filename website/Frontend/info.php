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

    <!-- <?php
    // Connect to the database
    $conn = new mysqli('your_host', 'your_username', 'your_password', 'your_database');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve data from the table
    $query = "SELECT Time_stamp, Temperature_value, ExperiencedTemperature_value, Humidity_value FROM Data";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        foreach ($result as $row) {
            echo "<tr>
                    <td data-label="rowTime">" . $row['Time_stamp'] . "</td>
                    <td data-label="rowTemp">" . $row['Temperature_value'] . "</td>
                    <td data-label="rowXPTemp">" . $row['ExperiencedTemperature_value'] . "</td> . 
                    <td data-label="rowHumidity">" . $row['Humidity_value'] . "</td>
                </tr>"
                </tr>";
        }
    } else {
        echo "0 results";
    }

    // Close the database connection
    $conn->close();
?> -->


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

        <script src="script.js"></script>
    </footer>
</body>
</html>