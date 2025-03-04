# Projet_iot
Collecter, stocker et traiter des données de température et d'humidité

## Votre projet “open-source” :
    • Devra être accessible sur git - Github
    • Vous devrez soumettre ce git à votre direction avant votre présentation afin qu’il puisse auditer le travail de votre équipe  

## Votre application devra :
    • Disposer d’une interface web consultable à travers un simple navigateur  
    • Être “responsive”  
    • Inclure un graphique des données température/humidité  
    • BONUS : un bouton de “partage” du graphique ou du dernier relevé vous permettra d’envoyer facilement les données à vos amis/familles (mail, réseaux sociaux, autres ?)  

## La collecte et la base de données
    • Méthode CRUD sur toute la base de donnée    
    • Base de donnée sur un serveur   
    • BONUS : gérer l’authentification des utilisateurs  
## Serveur
    • Il héberge le serveur web  
    • Il héberge le SGBDR correctement configuré  
    • Il sera administrable via SSH  
## Sonde de température
    • Correctement câblée avec les capteurs de température/humidité  
    • Elle sera programmée avec le langage de votre choix  
    • Afin d’éviter les relevés imprécis le capteur fera des relevés toutes les quelques secondes et vous en réaliserez une moyenne d’au moins 5 relevés afin d’envoyer des données “lissées” à la BDD  
    • Elle disposera d’un écran afin d’afficher : son adresse IP, la date et heure, et fera défiler les derniers relevés des sondes  

## Date d’évaluation 
    • 25/03/2025 (prévisionnel)  

------------------------------------------------------------------------------------------------------------------

# Database
## Dependencies
### MariaDB
- Set up MariaDB following [step 2](https://github.com/JohanBZH/Hebergement_web_php) :
- create the database and a user with full privileges
    Use <'iot'> for all the names

- Import the tables :
```sudo mariadb <iot> < <iot_db.sql>```

### To connect via PDO
Install php-mysql
```sudo aptitude install php-mysql```

Install and set up composer to install vlucas/phpdotenv to be able to use a .env
```sudo aptitude install composer```

    Initialize composer
    Place yourself in your index.php repository
    ```
    composer init -n
    composer require vlucas/phpdotenv
    composer install
    ```