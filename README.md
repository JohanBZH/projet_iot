# Projet_iot
Collecter, stocker et traiter des données de température et d'humidité

## Votre projet “open-source” :
[Github - Projet IOT](https://github.com/JohanBZH/projet_iot)

## L'application est disponible :
[jomayo.alwaysdata.net](jomayo.alwaysdata.net)

    • D’une interface web consultable à travers un simple navigateur  
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
### MariaDB for localhosting
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

For this project, our goal was to capture the temperature and the percentage of humidity in the room. 

* **Hardware requirements:**
  - Lora32 Wifi V3
  - DHT22
  - Liquid crystal LCD 16,2

* **Software requirements:**
  - Arduino IDE
  - Filezilla
  - phpMyAdmin

## Hardware

### LoRa32 Wifi V3

The LoRa32 is a wireless communication module. It's based on the ESP32.

### DHT22 

The DHT22 is a temperature and humity sensor that can be connected to an Arduino or an ESP32.

### Liquid crystal LCD 16,2

The Liquid crystal LCD is a screen that can display information from the ESP32.

## Software

### Boards and libs

To connect the ESP to the Arduino IDE, you have to use a specific board, the **LoRa32 Wifi v3**, and select the right **port COM**.

In order to install the **Heltec ESP32 Series Dev-boards** on the Arduino IDE, follow the next steps:

- In File -> Preferences -> Additional boards manager URLs, add this url: https://resource.heltec.cn/download/package_heltec_esp32_index.json
if you have an "Error downloading" on the IDE for this URL, use this one instead: https://github.com/Heltec-Aaron-Lee/WiFi_Kit_series/releases/download/0.0.1/package_heltec_esp32_index.json

- In Tools -> Board:"" -> Boards Manager, type ESP32, click install on the Heltec ESP32 Series Dev-Boards.

- Select the LoRa32 Wifi V3 model in:
    Tools -> Board :"" -> Heltec ESP32 Series Dev-boards

- Connect the LoRa to your computer.

* **on Windows:**
To get the right port com, open the **Windows device manager** and check the line **Ports (COM and LPT)**. This line won't appear if the LoRa isn't connect to your computer.

* **on Linux:**
Open a terminal and type:
`cd /` and then 
`ls /dev/tty*`
find a port named /dev/ttyUSB* or /dev/ttyACM* (for example, /dev/ttyUSB0) and use it as the value of Port input argument while creating the Arduino object to establish connection to ESP32 board.

In the Arduino IDE, select the right board and the right COM in Tools.

To program the different devices connected to the LoRa, use these libraries on the IDE: 
- WiFi.h --> to connect the LoRa32 to the wifi
- HTTPClient.h --> 
- LiquidCrystal.h --> for the LCD screen 
- DHT.h --> for the DHT22 sensor

You might have to install some of these libraries (LiquidCrystal and DHT sensor library) through Tools -> Manage libraries.


## Host - Alwaysdata

To deploy your website through Alwaysdata (for free if you need < 100Mb of disk space):
- create an account on https://www.alwaysdata.com/en/
- pick an available website address

### Connection to the website through Alwaysdata:

login: yoann.meynsan@viacesi.fr
password: jomayo29200

### Connection to the FTP through Filezilla:

We chose the FTP client Filezilla.
Open Filezilla and connect to the FTP from your newly created website in order to send your files.

login: jomayo
password: Jomayo29200BREST

host: ftp-jomayo.alwaysdata.net
port: default

website URL: https://jomayo.alwaysdata.net/Frontend/


## Database Administration

We chose to administrate our database through PHPMyAdmin

### Connect to phpMyAdmin

account: https://phpmyadmin.alwaysdata.com/
login: jomayo
password: Jomayo29200BREST

## Mail client

We chose to use the SMTP provided with the host and use PHPMailer to manage mail.

### Connexion to SMTP

Checks in always-data settings that the parameters are correctly set up.

Host : smtp-jomayo.alwaysdata.net
Port : 465   //The port 587 is also available
Username : jomayo@alwaysdata.net
password : jomayo29200!

## Server administration

Checks in always-data settings that the SSH parameters are correctly set up :
    You have a SSH user, with a password and "Password connection" is ticked.

To connect from the client :
```
ssh jomayo@ssh-jomayo.alwaysdata.net
```
