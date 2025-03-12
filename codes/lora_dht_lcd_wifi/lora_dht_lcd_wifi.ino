#include <DHT.h>
#include <WiFi.h>
#include <LiquidCrystal.h>
#include <HTTPClient.h>
#include <NTPClient.h>
#include <WiFiUdp.h>

#define brocheDeBranchementDHT 19
#define typeDeDHT DHT22

DHT dht(brocheDeBranchementDHT, typeDeDHT);
LiquidCrystal lcd(7, 6, 5, 4, 3, 2);

// unsigned long previousMillis = 0;  // Compteur pour la gestion du temps
// const long interval = 1000;        // Intervalle de 1 seconde (1000 ms)

const String site = "https://jomayo.alwaysdata.net/Frontend/data.php";

// Define NTP Client to get time
WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP);

// Variables to save date and time
String formattedDate;
String dayStamp;
String timeStamp;


const char* ssid = "iPhone (9)";    // Remplace par ton SSID
const char* password = "aaaaaaaa";  // Remplace par ton mot de passe

void setup() {

  Serial.begin(9600);

  WiFi.begin(ssid, password);
  lcd.begin(16, 2);

  Serial.print("\nConnexion au WiFi...");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nConnecté !");
  Serial.print("Adresse IP : ");
  Serial.println(WiFi.localIP());

  dht.begin();

  // Initialize a NTPClient to get time
  timeClient.begin();
  // Set offset time in seconds to adjust for your timezone, for example:
  // GMT +1 = 3600
  // GMT +8 = 28800
  // GMT -1 = -3600
  // GMT 0 = 0
  timeClient.setTimeOffset(3600);
}

void loop() {

  lcd.clear();

  float tauxHumidite = dht.readHumidity();
  float temperatureEnCelsius = dht.readTemperature();


  if (isnan(tauxHumidite) || isnan(temperatureEnCelsius)) {
    Serial.println("Aucune valeur retournée par le DHT22. Est-il bien branché ?");
    delay(2000);
    return;
  }

  Serial.print("Humidité = ");
  Serial.print(tauxHumidite);
  Serial.println(" %");
  Serial.print("Température = ");
  Serial.print(temperatureEnCelsius);
  Serial.println(" °C");
  Serial.print("Température ressentie = ");
  Serial.println(" °C");
  Serial.println();

  HTTPClient http;
  temperatureEnCelsius = temperatureEnCelsius*100;
  tauxHumidite = tauxHumidite*100;
  String url = site + "?temperature=" + String(temperatureEnCelsius) + "&humidity=" + String(tauxHumidite);


  http.begin(url);
  int httpResponseCode = http.GET();

  if (httpResponseCode > 0) {
    String payload = http.getString();
    Serial.println("Réponse du serveur: ");
    Serial.println(payload);
  } else {
    Serial.print("Erreur de la requête GET: ");
    Serial.println(httpResponseCode);
  }

  http.end();  // Libérer la ressource

  timeClient.forceUpdate();

  // The formattedDate comes with the following format:
  // 2018-05-28T16:00:13Z
  // We need to extract date and time
  formattedDate = timeClient.getFormattedTime();
  Serial.println(formattedDate);

  // Extract date
  int splitT = formattedDate.indexOf("T");
  dayStamp = formattedDate.substring(0, splitT);
  Serial.print("HOUR: ");
  Serial.println(dayStamp);
  delay(1000);

  temperatureEnCelsius = temperatureEnCelsius/100;
  tauxHumidite = tauxHumidite/100;

  lcd.setCursor(0, 0);
  lcd.print("Temp: " + String(temperatureEnCelsius) + "C");
  lcd.setCursor(0, 1);
  lcd.print("Hum: " + String(tauxHumidite) + " %");
  delay(5000);
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print(WiFi.localIP());
  delay(5000);
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print(dayStamp);
  delay(5000);
}