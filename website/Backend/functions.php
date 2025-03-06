<?php

function insertUser($login1, $password1, $db){

    $insertStmt = $db->prepare("INSERT INTO App_user (Login, Password) VALUES (:llogin, :ppassword)");
    
    $insertStmt->bindParam('llogin',$login1);
    $insertStmt->bindParam('ppassword',$password1);
    $insertStmt->execute();

}

function controlUser($login1, $password1, $db){


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
        // Get the last five datas
        $lastFiveData = array_slice($data, -$averageSize);
        
for($i=0;$i<=$dataLength)

        // Calculer les moyennes
        $temperatureColumn = array_column($lastFiveData, 'Temperature_value');
        $temperatureAverage = round(array_sum($temperatureColumn) / $averageSize, 2);
        
        $humidityColumn = array_column($lastFiveData, 'Humidity_value');
        $humidityAverage = round(array_sum($humidityColumn) / $averageSize, 2);
        
        // Récupérer le timestamp de la dernière mesure
        $lastTimestamp = $data[0]['Time_stamp'];
        
        // Ajouter les données dans le tableau passé par référence
        $averageTable[] = [
            'time' => $lastTimestamp,
            'temperature' => $temperatureAverage,
            'humidite' => $humidityAverage
        ];
        
        
        return true;
    }
    
    return false;
}


// function averageData($data) {
//     if (!empty($data)) {
//         // Size of dataset used to calculate the average
//         $avgSize = 5;
//         $lastFiveData = array_slice($data, -$avgSize);
        
//         if (count($lastFiveData) == $avgSize) {



//             // Récupère le dernier timestamp
//             $time = array_slice($data, -1)[0]['Time_stamp'];

//             $lastTimeStamp = $time;

//             ou ne faudrait-il pas recréer un tableau avec les 3 données récupérées ? et le foreach ?

//             $temperatureColumn = array_column($lastFiveData, 'Temperature_value');
//             $temperature = array_sum($temperatureColumn) / $avgSize;
            
//             $humidityColumn = array_column($lastFiveData, 'Humidity_value');
//             $humidity = array_sum($humidityColumn) / $avgSize;
            
//             // Sortie des données

//             echo "<tr>
//                 <td data-label='rowTime'>{$time}</td>
//                 <td data-label='rowTemp'>Temperature: " . number_format($temperature, 2) . " °C</td>
//                 <td data-label='rowHumidity'>Humidity: " . number_format($humidity, 2) . " %</td>
//             </tr>";
//         } else {
//             echo "<tr><td colspan='4'>Not enough data</td></tr>";
//         }
//     } else {
//         echo "<tr><td colspan='4'>Aucune donnée disponible</td></tr>";
//     }
// }

?>


    
   