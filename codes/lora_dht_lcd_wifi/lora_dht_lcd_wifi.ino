#include <DHT.h>
#include <WiFi.h>
#include <LiquidCrystal.h>
#include <HTTPClient.h>

#define brocheDeBranchementDHT 19
#define typeDeDHT DHT22

DHT dht(brocheDeBranchementDHT, typeDeDHT);
LiquidCrystal lcd(7, 6, 5, 4, 3, 2);

unsigned long previousMillis = 0;  // Compteur pour la gestion du temps
const long interval = 1000;        // Intervalle de 1 seconde (1000 ms)

const String site = "https://jomayo.alwaysdata.net/Frontend/index.php";

int seconds = 0;
int minutes = 0;
int hours = 0;


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

  previousMillis = millis();
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

  unsigned long currentMillis = millis();

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

  // Vérifier si une seconde s'est écoulée
  if (currentMillis - previousMillis >= interval) {
    // Sauvegarder le dernier moment où l'événement a eu lieu
    previousMillis = currentMillis;

    // Incrémenter les secondes
    seconds++;

    // Si plus de 59 secondes, réinitialiser les secondes et incrémenter les minutes
    if (seconds >= 60) {
      seconds = 0;
      minutes++;
    }

    // Si plus de 59 minutes, réinitialiser les minutes et incrémenter les heures
    if (minutes >= 60) {
      minutes = 0;
      hours++;
    }
  }

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
  lcd.print(hours);
  lcd.print(":");
  if (minutes < 10) lcd.print("0");  // Ajouter un zéro devant les minutes < 10
  lcd.print(minutes);
  lcd.print(":");
  if (seconds < 10) lcd.print("0");  // Ajouter un zéro devant les secondes < 10
  lcd.print(seconds);
  delay(5000);
}