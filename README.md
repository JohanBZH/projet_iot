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

# Hardware and Software 

For this project, we had to get the temperature and the percent of humidty in the classroom. So, to catch those datas we used some hardware devices: 

- Lora32 Wifi V3
- DHT22
- Liquid crystal LCD 16,2

We also use the Arduino IDE for programming and send the code to the hardware part.

## The hardware

### LoRa32 Wifi V3

The LoRa32 is a wireless communication module. It's based on the ESP32.

### DHT22 

The DHT22 is a temperature and humity sensor that can be connected to an Arduino or an ESP32.

### Liquid crystal LCD 16,2

The Liquid crystal LCD is a screen that can display informations from the ESP32.

## The software

### Boards and libs

To connect the ESP to the Arduino IDE we had to use a specific board, the **LoRa32 Wifi v3** and select the right **port COM**.

To use this board you have to install the **Heltec ESP32 Series Dev-boards** on the Arduino IDE, follow this few steps to add it to the Arduino IDE:

- In File -> Preferences -> Additional boards manager URLs, add this url: http://arduino.esp8266.com/stable/package_esp8266com_index.json

- Go to the Boards Manager, type ESP32, click install for the Heltec ESP32 Series Dev-Boards.

- After that you just have to select the LoRa32 Wifi V3 model in:
    Tools -> Board :"" -> Heltec ESP32 Series Dev-boards

To get the right port com you have to the **windows device manager** and check the line **Ports (COM and LPT)**. This line won't appear if the LoRa isn't connect to your computer.

Now, in the Arduino IDE you can select the right board and the right COM.

For programming the different devices who's connected to the LoRa you have to use some libs. 

For this project we used:

- DHT.h --> for the DHT22 sensor
- WiFi.h --> to connect the LoRa32 to the wifi
- LiquidCrystal.h --> for the LCD screen 

