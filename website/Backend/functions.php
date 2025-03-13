<?php
//Start a session to send data through different files (here data to functions)
session_start();

include '../Backend/db_conn.php';

require_once '../Backend/vendor/autoload.php';

//php mailer
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// require_once "vendor/phpmailer/Exception.php";
// require_once "vendor/phpmailer/PHPmailer.php";
// require_once "vendor/phpmailer/SMTP.php";

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

// -----------------------------------------------------

// Calculate the average data by batch of 5 rows, with a shift of 1 rows, to smoothen the measures
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

//Get the data displayed in data.php
if ($_SERVER["REQUEST_METHOD"] == "POST"
    && isset($_POST['export'])){

        $data = $_SESSION['data_to_export'] ?? [];
        // exportData($data);
        downloadData($data);
        header("Location: ../Frontend/data.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST"
    && isset($_POST['exportMail'])){
        $data = $_SESSION['data_to_export'] ?? [];
        sendMail($data);
        // header("Location: ../Frontend/data.php");
}

//Export the data displayed in data.php in a .csv file.
function downloadData($data){

    //Create the file
    $filename = 'Weather_data_' . date('Y-m-d') . '.csv';
    $filepath = '../Docs/Exports/' . $filename;
    //Check if the repository exists and has the correct permissions
    if (!file_exists('../Docs/Exports')) {
        mkdir('../Docs/Exports', 0777, true);
    }

    //Complete the file
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

    //Force the download
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    readfile($filepath);

    // //Delete the temporary file
    unlink($filepath);

    exit;
}

function sendMail($data){

        //Create the file
    $filename = 'Weather_data_' . date('Y-m-d') . '.csv';
    $filepath = '../Docs/Exports/' . $filename;
    //Check if the repository exists and has the correct permissions
    if (!file_exists('../Docs/Exports')) {
        mkdir('../Docs/Exports', 0777, true);
    }

    //Complete the file
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

    $mail = new PHPMailer(true);

    try{
        //Configuration
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; //infos de débug

        //Simple Mail Tranfer Protocol
        $mail->isSMTP();
        $mail->Host = 'smtp-jomayo.alwaysdata.net'; //For our host on alwaysdata, use "smtp-jomayo.alwaysdata.net" //for local testing : 'localhost'
        $mail->Port = 465; //Ou 587 //To test on MailHog 1025
        
        //Dans le cas d'une connexion via MailHog
        //$mail->SMTPAuth = false;

        //Authentification to alwaysdata
        $mail->SMTPAuth = true;
        $mail->Username = 'jomayo@alwaysdata.net';
        $mail->Password = 'jomayo29200!'; //check in always data that de password is set and complex enough

        if ($mail->Port == 465) {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Pour le port 587
        }

        //Set waiting time at 10s
        $mail->Timeout = 10;

        //charset
        $mail->Charset = "utf-8";

        //recipients
        $mail->addAddress("trscl.29@gmail.com"); //ajout d'autant d'adresses que nécessaire

        //sender
        $mail->setFrom("no-reply@jomayo.fr");

        //content
        $mail->Subject = "Your weather datas";
        $mail->Body = "Thank you for your trust in JoMaYo weather observations.";

        //Attachment
        $mail->addAttachment($filepath, $filename);

        //send
        $mail->send();
        echo "message envoyé";

    }catch (Exception){
        echo "Mail non envoyé. Erreur: {$mail->ErrorInfo}";
    }
}

?>


    
   