/* 
How to print temperature and humidity on the LCD screen :

  Set up :
  - Arduino uno R3
  - LCD screen
  - DHT 22
  - potentiometer

  Libs :
  - DHT sensor library 
    - includes adafruit Unified Sensor
  - LiquidCrystal

  The circuit:
 * LCD RS pin to digital pin 12
 * LCD Enable pin to digital pin 11
 * LCD D4 pin to digital pin 5
 * LCD D5 pin to digital pin 4
 * LCD D6 pin to digital pin 3
 * LCD D7 pin to digital pin 2
 * LCD R/W pin to ground
 * LCD VSS pin to ground
 * LCD VCC pin to 5V
 * 10K resistor:
 * ends to +5V and ground
 * wiper to LCD VO pin (pin 3)

See : https://docs.arduino.cc/learn/electronics/lcd-displays/
*/

#include "DHT.h"
#include <LiquidCrystal.h>

#define DHTPIN 10
#define DHTTYPE DHT22

const int rs = 12, en = 11, d4 = 5, d5 = 4, d6 = 3, d7 = 2;
LiquidCrystal lcd(rs, en, d4, d5, d6, d7);
DHT dht(10, 22);

void setup() {
  Serial.begin(9600);
  
  // Initialise la capteur DHT22
  dht.begin();

  // set up the LCD's number of columns and rows:
  lcd.begin(16, 2);
  // Print a message to the LCD.
  lcd.setCursor(0, 0);
  lcd.print("Ready for");
  lcd.setCursor(0, 1);
  lcd.print("the heat ?");
}

void loop() {

  // Recupere la temperature et l'humidite du capteur et l'affiche
  // sur le moniteur serie
  Serial.println("Temperature = " + String(dht.readTemperature())+" °C");
  Serial.println("Humidite = " + String(dht.readHumidity())+" %");

  float temperature = dht.readTemperature();
  float humidity = dht.readHumidity();
  // Attend 10 secondes avant de reboucler
  delay(10000);

  // set the cursor to column 0, line 1
  // (note: line 1 is the second row, since counting begins with 0):
  lcd.setCursor(0, 0);
  // print the number of seconds since reset:
  lcd.print("Temp = " + String(temperature)+" C");
  lcd.setCursor(0, 1);
  // print the number of seconds since reset:
  lcd.print("Humi = " + String(humidity)+" %");

}