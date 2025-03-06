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

function averageData($data){
    
    if (!empty($data)) {

        //Size of dataset used to calculate the average
        $avgSize = 5;

        $lastFiveData = array_slice($data, -$avgSize);
        
        
        if (count($lastFiveData) == $avgSize) {
            $time = array_slice($data, -1);
            $temperature = array_sum(array_column($lastFiveData, 'Temperature_value')/ $avgSize);
            $humidity = array_sum(array_column($lastFiveData, 'Humidity_value')/ $avgSize);

            foreach ($data as $row) {
                echo "<tr>
                    <td data-label='rowTime'>{$row['Time_stamp']}</td>
                </tr>";
            }
            echo "<tr>
                <td data-label='rowTemp'>Temperature: .($temperature). °C</td>
                <td data-label='rowHumidity'>Humidity: .($humidity). %</td>
                </tr>";
        } else {
            echo "<tr><td colspan='4'>Not enough data</td></tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Aucune donnée disponible</td></tr>";
    }
}

?>


    
   