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


# Database - MariaDB

Container name : project_iot_server
Port : localhost:3308

Database name : project_iot_database

## Set up from scratch

Create the docker
    docker run -d --name project_iot_server     
    -p 0.0.0.0:3308:3306/tcp     
    -e MARIADB_ROOT_PASSWORD=toor     
    mariadb:latest  
Access the container
    docker exec -it project_iot_server bash  
Access to mariadb
    mariadb -u root -p  
Create database
    create database project_iot_database;  
Control
    show databases;  

## User
Create your first user  
login : admin  
pass : toor  

## Connexion to beekeeper
Host : localhost  
Port : 3308  
User : root  
Pass : toor  


For more info : https://mariadb.com/kb/en/installing-and-using-mariadb-via-docker/

## Set up from our image

docker pull jmons29/mariadb:latest

docker run --hostname=c6633cfa15b8 --env=MARIADB_ROOT_PASSWORD=toor --env=PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin --env=GOSU_VERSION=1.17 --env=LANG=C.UTF-8 --env=MARIADB_VERSION=1:11.6.2+maria~ubu2404 --volume=/var/lib/mysql --network=bridge -p 3308:3306 --restart=no --label='org.opencontainers.image.authors=MariaDB Community' --label='org.opencontainers.image.base.name=docker.io/library/ubuntu:noble' --label='org.opencontainers.image.description=MariaDB Database for relational SQL' --label='org.opencontainers.image.documentation=https://hub.docker.com/_/mariadb/' --label='org.opencontainers.image.licenses=GPL-2.0' --label='org.opencontainers.image.ref.name=ubuntu' --label='org.opencontainers.image.source=https://github.com/MariaDB/mariadb-docker' --label='org.opencontainers.image.title=MariaDB Database' --label='org.opencontainers.image.url=https://github.com/MariaDB/mariadb-docker' --label='org.opencontainers.image.vendor=MariaDB Community' --label='org.opencontainers.image.version=11.6.2' --runtime=runc -d mariadb:latest