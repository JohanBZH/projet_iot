<?php
// Start a session to send data through different files (here data to functions)
session_start();

if (!isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = false;
    $_SESSION['login'] = "";
}

include '../Backend/db_conn.php';

insertData($time_stamp, $temperature, $humidity, $db);
$lastGet = getLastInsert($db);

//php mailer
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function insertData($time_stamp, $temperature, $humidity, $db){
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
    return $result->fetchAll();
}

// -----------------------------------------------------

// Calculate the average data by batch of 5 rows, with a shift of 1 row every time to smoothen the measures
function calculateSlidingAverage($data, &$averageTable) {
    $averageSize=5;
    $dataLength = count($data);

    // Check for data availability
    if ($dataLength >= $averageSize) {
        
        for($i = 0; $i <= ($dataLength-$averageSize); $i++){

            // Get the last five rows of data
            $lastFiveData = array_slice($data, $i, $averageSize);

            // Calculate average
            $temperatureColumn = array_column($lastFiveData, 'Temperature_value');
            $temperatureAverage = round(array_sum($temperatureColumn) / $averageSize, 2);

            $humidityColumn = array_column($lastFiveData, 'Humidity_value');
            $humidityAverage = round(array_sum($humidityColumn) / $averageSize, 2);

            // Get unique timestamp for each batch
            $lastTimestamp = $lastFiveData[0]['Time_stamp'];

            // Add data to an array
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

// Display the data in HTML if it is available
function insertInTable($DataToInsert){

    // Insert data into data.php 

    if (!empty($DataToInsert)) {
        echo "<table>
                <tr>
                    <th class='stickyHeader'>Date et heure</th>
                    <th class='stickyHeader'>Température (°C)</th>
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

// Select the action for the data export (download or send through mail).

if ($_SERVER["REQUEST_METHOD"] == "POST"
    && isset($_POST['export'])){

        $data = $_SESSION['data_to_export'] ?? [];
        downloadData($data);
        header("Location: ../Frontend/data.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST"
    && isset($_POST['exportMail'])){
        $data = $_SESSION['data_to_export'] ?? [];
        sendMail($data);
}

// Export the data displayed in the table from data.php in a .csv file.
function downloadData($data){
    // Use tmp to avoid permission issues
    $exportDir = sys_get_temp_dir() . '/';

    // Create and open the file
    $filename = 'Weather_data_' . date('Y-m-d') . '.csv';
    $filepath = $exportDir . $filename;
    $file = fopen($filepath, 'w');

    // Check if file opens
    if ($file === false) {
        die("Impossible de créer le fichier CSV. Vérifiez les permissions.");
    }

    // Complete the file
    fputcsv($file, ['Time_stamp', 'Temperature_value', 'Humidity_value']);

    foreach ($data as $row) {
        fputcsv($file, [
            $row['Time_stamp'],
            $row['Temperature_value'],
            $row['Humidity_value']
        ]);
    }

    fclose($file);

    // Force the download
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    readfile($filepath);

    // Delete the temporary file
    unlink($filepath);

    exit;
}

// Send the data through mail as a .csv file 
function sendMail($data){

    // Use tmp to avoid permission issues
    $exportDir = sys_get_temp_dir() . '/';

    // Create and open the file
    $filename = 'Weather_data_' . date('Y-m-d') . '.csv';
    $filepath = $exportDir . $filename;
    $file = fopen($filepath, 'w');

    // Check if file opens
    if ($file === false) {
        die("Impossible de créer le fichier CSV. Vérifiez les permissions.");
    }

    // Complete the file
    fputcsv($file, ['Time_stamp', 'Temperature_value', 'Humidity_value']);

    foreach ($data as $row) {
        fputcsv($file, [
            $row['Time_stamp'],
            $row['Temperature_value'],
            $row['Humidity_value']
        ]);
    }

    fclose($file);

    // PHPMailer settings.
    $mail = new PHPMailer(true);

    try{
        // If needed to debug, use MailHog to simulate a SMTP server and intercept the mails and add :
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $mail->isSMTP();
        $mail->Host = 'smtp-jomayo.alwaysdata.net'; // For our host on alwaysdata, use "smtp-jomayo.alwaysdata.net" // for local testing : 'localhost'
        $mail->Port = 465; // or 587 // To test locally on MailHog 1025
        
        // With MailHog
        // $mail->SMTPAuth = false;

        // Authentification to alwaysdata
        $mail->SMTPAuth = true;
        $mail->Username = 'jomayo@alwaysdata.net';
        $mail->Password = 'jomayo29200!'; // check in alwaysdata that the password is set and complex enough

        if ($mail->Port == 465) {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // the second option is set for the port 587
        }

        // Set waiting time at 10s to avoid getting stuck in the event of network problems
        $mail->Timeout = 10;

        // Mails parameters
        $mail->Charset = "utf-8";
        $mail->addAddress($_SESSION['login']); // add as many email addresses as necessary
        $mail->setFrom("no-reply@jomayo.fr");
        // content
        $mail->Subject = "Your weather data";
        $mail->Body = "Thank you for your trust in JoMaYo weather observations.";

        // Attachment
        $mail->addAttachment($filepath, $filename);

        // send - wait and redirect
        $mail->send();
        echo "Message envoyé <br>";
        echo '<a href="../Frontend/data.php">Retour à la station météo.</a>';
        header('Refresh:2; URL=../Frontend/data.php');

    }catch (Exception){
        echo "Mail non envoyé. Erreur: {$mail->ErrorInfo} <br>";
        echo '<a href="../Frontend/data.php">Retour à la station météo.</a>';
    }
}

function getLastInsert($db){
    
    // Selecting the last intertion in the database for "real time" display

    $query = "SELECT * FROM Data ORDER BY id_data DESC LIMIT 1";
    $last = $db->query($query);
    return $last->fetchAll();
}
?>