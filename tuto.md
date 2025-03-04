PREPARATION CAPTEUR

1 - télécharger Arduino (disponible sur tous les OS -- en .exe sur Windows ou apt install arduino sur Linux (version antérieure))
2 - suivre ce tutoriel https://tutoduino.fr/debuter/capteur-temperature/
3 - attention : nous utilisons un capteur DHT22, il faut faire la modif
4 - bien changer le DHTPIN en fonction de la broche de l'Arduino choisie
5 - suivre ce tutoriel pour rajouter l'écran LCD https://ledisrupteurdimensionnel.com/arduino/comment-relier-lecran-lcd-a-l-arduino-uno/

Exemple d'affichage LCD : https://www.arduino.cc/en/Tutorial/LibraryExamples/HelloWorld

code
 To display the date and time and the IP address from your sensor using this code, you need to:

1.  Get the current date and time: You can use the `millis()` function to get the current time in milliseconds, then convert it to a `tm` struct using `localtime()`.

2.  Get the IP address of your device: You can use the `WiFi.localIP()` function from the ESP32 library to get the local IP address of your device.

Here is an updated version of your code that includes these features:

```cpp
// Capteur de temperature et d'humidite DHT22
#include <LiquidCrystal.h>
#include "DHT.h"
#include <WiFi.h> // For WiFi.localIP()

LiquidCrystal lcd(7, 8, 9, 10, 11, 12);  //Pins où on va connecter l'écran (RS, E, D4, D5, D6, D7)

// Definit la broche de l'Arduino sur laquelle la
// broche DATA du capteur est reliee
#define DHTPIN 2

// Definit le type de capteur utilise
#define DHTTYPE DHT22

// Declare un objet de type DHT
// Il faut passer en parametre du constructeur
// de l'objet la broche et le type de capteur
DHT dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(9600);
  lcd.begin(16, 2);   //on initialise l'écran
  
  // Initialise la capteur DHT22
  dht.begin();
  
  // Connect to Wi-Fi network
  WiFi.mode(WIFI_STA);
  WiFi.begin("your_wifi_ssid", "your_wifi_password");
}

void loop() {
  // Recupere la temperature et l'humidite du capteur et l'affiche
  // sur le moniteur serie
  
  // Get current time in milliseconds
  unsigned long currentTimeMs = millis();
  
  // Convert current time to tm struct
  struct tm *currentTime = localtime(&currentTimeMs);
  
  // Print current date and time
  Serial.print("Date/Time: ");
  char currentDate[20];
  strftime(currentDate, sizeof(currentDate), "%Y-%m-%d %H:%M:%S", currentTime);
  Serial.println(currentDate);
  
  // Get IP address of device
  char ipAddress[15];
  WiFi.localIP().toCharArray(ipAddress, sizeof(ipAddress));
  Serial.print("IP Address: ");
  Serial.println(ipAddress);
  
  // Recupere la temperature et l'humidite du capteur et l'affiche
  // sur le moniteur serie
  Serial.println("Temperature = " + String(dht.readTemperature())+" °C");
  Serial.println("Humidite = " + String(dht.readHumidity())+" %");
  
  // Attend 10 secondes avant de reboucler
  //Message 1
  lcd.setCursor(0, 0);          //Place le pointeur sur la colonne 0, ligne 0
  lcd.write("Temperature = " + String(dht.readTemperature())+" °C");      //écrit le message
  lcd.setCursor(0, 1);         //Place le pointeur sur la colonne 0, ligne 1
  lcd.write("Humidite = " + String(dht.readHumidity())+" %");    //écrit le message
  
  delay(3500);                 //attente 3.5 secondes
  
  lcd.clear();                 //efface le message affiché
  delay(10000);
}
```

In this code:

*   We added the necessary `#include` directives to include the Wi-Fi library.
*   In the `setup()` function, we connected to a Wi-Fi network using `WiFi.begin()`.
*   In the `loop()` function, we used `millis()` to get the current time in milliseconds and converted it to a `tm` struct using `localtime()`. Then, we printed the current date and time.
*   We also used `WiFi.localIP()` to get the IP address of our device.
```

In this code:

*   We added the necessary `#include` directives to include the Wi-Fi library.
*   In the `setup()` function, we connected to a Wi-Fi network using `WiFi.begin()`.
*   In the `loop()` function, we used `millis()` to get the current time in milliseconds and converted it to a `tm` struct using `localtime()`. Then, we printed the current date and time.
*   We also used `WiFi.localIP()` to get the IP address of our device.```


