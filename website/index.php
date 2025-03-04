<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project iot</title>
</head>
<body>
    <p>Accès granted</p>
    <!-- <?php
        //DSN de connexion
        $dsn = "mysql:dbname=".$_ENV['MYSQL_DATABASE'].";"host="".$_ENV['MYSQL_HOST'].";

        //Connexion a la base
        try{
            //On crée une instance PDO (un élément qu'on mets dans une var)
            $db = new PDO(
                $dsn, //DBUSER,DBPASS);
                $_ENV['MYSQL_USER'],
                $_ENV['MYSQL_PASSWORD']);

            // on s'assure d'envoyer les données en UTF8
            $db->exec("SET NAMES utf8");

            //on défini le mode de fetch par défaut (ici assoc soit tableau associatif)
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            die($e->getMessage());
        }

        //Dès ici on est connecté et on peut faire des requêtes.

        //préparation de la requête
        $sql = "SELECT * FROM iot_table";
        //execution de la requête
        $requete = $db->query($sql);

        //on récupère les données (fetch ou fetchAll)
        $data = $requete->fetchAll();

        echo "<pre>";
        var_dump($data);
        echo "</pre>";

        //Ajouter des data avec une requête préparée
        $sql = "INSERT INTO app_user (`login`, `password`)
        VALUES (:login, :password)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':login' => 'First user',
            ':password' => '1234'
        ]);

    ?>     -->
    
</body>
</html>