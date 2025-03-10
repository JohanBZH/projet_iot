<?php
include '../Backend/functions.php';
include '../Backend/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('/home/jomayo/www/Frontend');
$dotenv->load();

$deb = 0;

$temperature = isset($_GET['temperature']) ? $_GET['temperature'] : null;
$humidity = isset($_GET['humidity']) ? $_GET['humidity'] : null;
$time_stamp = date('Y-m-d H:i:s');
$mail = isset($_POST['mail']) ? $_POST['mail'] : null;
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



} catch(PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo "Erreur de la base de données : " . $e->getMessage() . "<br>";
}
?>