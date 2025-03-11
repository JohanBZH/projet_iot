<?php

session_start();

include '../Backend/db_conn.php';

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

function queryAllData($db){
    $query = "SELECT Time_stamp, Temperature_value, Humidity_value FROM Data ORDER BY Time_stamp ASC";
    $result = $db->query($query);
    return $result->fetchAll(); // Get data in an associative array
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
        
            return $averageTable;
        }
    
    return false;
}

function insertInTable($DataToInsert){

    if (!empty($DataToInsert)) {
        echo "<table>
                <tr>
                    <th class='stickyHeader'>Time</th>
                    <th class='stickyHeader'>Temperature (°C)</th>
                    <th class='stickyHeader'>Humidité (%)</th>
                </tr>";
        
        foreach ($DataToInsert as $entry) {
            echo "<tr>
                    <td>{$entry['time']}</td>
                    <td>{$entry['temperature']}</td>
                    <td>{$entry['humidite']}</td>
                </tr>";
        }
        echo "</table>";
    }
        
}

// -------------------------------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] == "POST"
    && isset($_POST['export'])){
        //get the data saved in the session
        $data = $_SESSION['data_to_export'] ?? [];
        exportData($data);
        header("Location: ../Frontend/data.php");
    }

function exportData($data){
$debug='Error here';
    // echo $debug;

    $filename = 'Weather_data_' . date('Y-m-d') . '.csv';
    $filepath = '../Docs/Exports/' . $filename;

    if (!file_exists('../Docs/Exports')) {
        mkdir('../Docs/Exports', 0777, true);
    }

    $file = fopen($filepath, 'w');

    fputcsv($file, ['Time_stamp', 'Temperature_value', 'Humidity_value']);

    foreach ($data as $row) {
        fputcsv($file, [
            $row['Time_stamp'],
            $row['Temperature_value'],
            $row['Humidity_value']
        ]);
    }

    fclose($file);

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    readfile($filepath);

    unlink($filepath);

    exit;
}

function clearDataExports(){

}

?>


    
   