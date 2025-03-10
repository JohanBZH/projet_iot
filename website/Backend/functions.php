<?php

function insertUser($login1, $password1, $db){

    $insertStmt = $db->prepare("INSERT INTO App_user (Login, Password) VALUES (:llogin, :ppassword)");
    
    $insertStmt->bindParam('llogin',$login1);
    $insertStmt->bindParam('ppassword',$password1);
    $insertStmt->execute();

}

function insertData($time_val, $temperature_val, $humidity_val, $db){

    $insertStmt = $db->prepare("INSERT INTO Data (Time_stamp, Temperature_value, Humidity_value) VALUES (:time_val, :temperature_val, :humidity_val)");
    
    $insertStmt->bindParam('time_val',$time_val);
    $insertStmt->bindParam('temperature_val',$temperature_val);
    $insertStmt->bindParam('humidity_val',$humidity_val);
    $insertStmt->execute();
    
}

// ---------------------------------------------------

function calculateSlidingAverage($data, &$averageTable) {
    $averageSize=5;
    $dataLength = count($data);

    // Check for data availability
    if ($dataLength >= $averageSize) {
        
    for($i = 0; $i <= ($dataLength-$averageSize); $i++){

        // Get the last five datas
        $lastFiveData = array_slice($data, $i, $averageSize);

        // Calculate average
        $temperatureColumn = array_column($lastFiveData, 'Temperature_value');
        $temperatureAverage = round(array_sum($temperatureColumn) / $averageSize, 2);

        $humidityColumn = array_column($lastFiveData, 'Humidity_value');
        $humidityAverage = round(array_sum($humidityColumn) / $averageSize, 2);

        // Get unique timestamp for each 5 datas
        $lastTimestamp = $lastFiveData[0]['Time_stamp'];

        // Add datas to an array
        $averageTable[] = [
            'time' => $lastTimestamp,
            'temperature' => $temperatureAverage,
            'humidite' => $humidityAverage
        ];
        }    

        // Print table
        if (!empty($averageTable)) {
            echo "<table border='1'>
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Temperature (°C)</th>
                            <th>Humidité (%)</th>
                        </tr>
                    </thead>";
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
            
            return true;
        }
    
    return false;
}

?>


    
   