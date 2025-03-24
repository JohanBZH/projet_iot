<?php
// Connect to the .env to get the login credentials that is stored on your localhost
include '../Backend/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/projet_iot/website/Frontend'); //pour always data /home/jomayo/www/Frontend
$dotenv->load();

// Get the data from the ESP32 through GET
$temperature = isset($_GET['temperature']) ? $_GET['temperature'] : null;
$humidity = isset($_GET['humidity']) ? $_GET['humidity'] : null;
$time_stamp = date('Y-m-d H:i:s');
$email = isset($_POST['email']) ? $_POST['email'] : null;
$password1 = isset($_POST['password1']) ? $_POST['password1'] : null;
$password2 = isset($_POST['password2']) ? $_POST['password2'] : null;

try {
    $dsn = "mysql:host={$_ENV['MYSQL_HOST']};dbname={$_ENV['MYSQL_DATABASE']};charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $db = new PDO($dsn, $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $options);

    return $db;

} catch(PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo "Erreur de la base de données : " . $e->getMessage() . "<br>";
}
?>