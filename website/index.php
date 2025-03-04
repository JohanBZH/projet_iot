<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project iot</title>
</head>
<body>

    <?php

    include 'functions.php';

    include 'vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    try {

        $dsn = "mysql:host={$_ENV['MYSQL_HOST']};dbname={$_ENV['MYSQL_DATABASE']};charset=utf8mb4";
        
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $db = new PDO($dsn, $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $options);

        $deb=0;

        insertUser('NAME','PASSSS',$db);

        $deb=2;

        echo "Connexion réussie !<br>";

    } catch(PDOException $e) {
        echo $deb;
        error_log("Database error: " . $e->getMessage());
        die("Une erreur s'est produite.");
    }
    ?>
    
</body>
</html>

<!-- <'login'> , <'password'> -->