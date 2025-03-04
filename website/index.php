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

    //Charge le .env
    require_once __DIR__ . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

        //DSN de connexion
        
        $dsn = "mysql:dbname=" . $_ENV['MYSQL_DATABASE'] . ";host=" . $_ENV['MYSQL_HOST'] . ";charset=utf8mb4";

        // Options PDO pour une meilleure gestion des erreurs
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        //Connexion a la base
        try{
            //On crée une instance PDO (un élément qu'on mets dans une var)
            $db = new PDO(
                $dsn, //DBUSER,DBPASS);
                $_ENV['MYSQL_USER'],
                $_ENV['MYSQL_PASSWORD']);

            // on s'assure d'envoyer les données en UTF8mb4
            $db->exec("SET NAMES utf8mb4");

            //on défini le mode de fetch par défaut (ici assoc soit tableau associatif)
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC);

            echo 'Connexion success';

        }catch(PDOException $e){
            die($e->getMessage());
        }

        //Dès ici on est connecté et on peut faire des requêtes.

        // //préparation de la requête
        // $sql = "SELECT * FROM iot_table";
        // //execution de la requête
        // $requete = $db->query($sql);

        // //on récupère les données (fetch ou fetchAll)
        // $data = $requete->fetchAll();

        // echo "<pre>";
        // var_dump($data);
        // echo "</pre>";

        // //Ajouter des data avec une requête préparée
        // $sql = "INSERT INTO app_user (`login`, `password`)
        // VALUES (:login, :password)";
        // $stmt = $db->prepare($sql);
        // $stmt->execute([
        //     ':login' => 'First user',
        //     ':password' => '1234'
        // ]);

        ?>      
    
</body>
</html>