<?php

session_start();

include '../Backend/db_conn.php';
include '../Backend/db_conn.php';

$msg="";

function checkEmail($email){ // checks email address
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($POST['email'])) { // checks address is not null when sent

    $email_ToFilter = $_POST['email'];
    } else {
        $msg = "Error, please try again.";
    exit();
    }

$email = filter_var($email_ToFilter, FILTER_VALIDATE_EMAIL);

    if($email == false) { // checks if email address is valid

        $msg = "Invalid email address.";
        exit();
    }
    if ($msg !== "") {
        echo $msg;
    }
}

function insertUser($email, $password1, $password2, $db){
    
    checkEmail();
    
    if (isset($POST['password1']) && isset($POST['password2'])){ // checks passwords are not null

        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        if ($password1 === $password2) { // checks both passwords are the same
            
            // checks the table for identical email address
            $stmt = $db->prepare("SELECT * FROM App_user WHERE Login = :llogin");
            $stmt->bindParam(':llogin',$email);
            $stmt->execute();
            $row = $stmt->fetch();

            if (rowCount($row) > 0){
                $msg = "Account already exists. Please sign in instead.";
            } else {

                // insert new user into table
                echo "Valid email address.";
                $stmt = $db->prepare("INSERT INTO App_user ('Login', 'Password') VALUES (:llogin, :ppassword)");
                $stmt->bindParam(':llogin',$email);
                $stmt->bindParam(':ppassword',$password1);
                $stmt->execute();
                $check=1;
            }
        } else {
            $msg = "Passwords don't match.";
        }
    }
    if ($msg == "") { // new account allows you access to the graph and data table
        header("Location: data.php?email=".$email . "&msg=".$msg); 
        exit();
    } else {
        echo $msg;
        exit();
    }
}

function insertData($time_val, $temperature_val, $humidity_val, $db){
    if ($temperature !== null && $humidity !== null && is_numeric($temperature) && is_numeric($humidity)) {
        $floatTemperature = (float)$temperature;
        $floatHumidity = (float)$humidity;

        $floatTemperature = $floatTemperature/100;
        $floatHumidity = $floatHumidity/100;

        $stmt = $db->prepare("INSERT INTO Data (Temperature_value, Humidity_value, Time_stamp) VALUES (:temperature, :humidity, :time_stamp)");
        $stmt->bindParam(':temperature', $floatTemperature);
        $stmt->bindParam(':humidity', $floatHumidity);
        $stmt->bindParam(':time_stamp', $time_stamp);
        $stmt->execute();
    }
    
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


    
   