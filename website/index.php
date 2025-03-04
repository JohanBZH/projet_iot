<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project iot</title>
</head>
<body>
    <p>HTML du php ok</p>

    <?php
    require_once 'vendor/autoload.php';

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

        // // Exemple de requête préparée sécurisée
        // $stmt = $db->prepare("SELECT * FROM iot_table WHERE id = :id");
        // $stmt->execute(['id' => 1]);
        // $result = $stmt->fetch();

        // // Exemple d'insertion sécurisée
        // $insertStmt = $db->prepare("INSERT INTO app_user (login, password) VALUES (:login, :password)");
        // $insertStmt->execute([
        //     ':login' => 'newuser',
        //     ':password' => password_hash('securepassword', PASSWORD_DEFAULT)
        // ]);

        echo "Connexion réussie !<br>";

    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        die("Une erreur s'est produite.");
    }
    ?>
    
</body>
</html>