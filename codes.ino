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
DHT dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(9600);
  
  // Initialize DHT22 sensor
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

  // Print temperature and humidity on the computer screen to check
  Serial.println("Temperature = " + String(dht.readTemperature())+" °C");
  Serial.println("Humidite = " + String(dht.readHumidity())+" %");

  float temperature = dht.readTemperature();
  float humidity = dht.readHumidity();
  // Wait 2.5 seconds to refresh
  delay(2500);

  // Set the cursor to start writing on the LCD screen in column 0, line 0
  // (note: line 1 is the second row, since counting begins with 0):
  lcd.setCursor(0, 0);
  // print the number of seconds since reset:
  lcd.print("Temp = " + String(temperature)+" C");
  lcd.setCursor(0, 1);
  // print the number of seconds since reset:
  lcd.print("Humi = " + String(humidity)+" %");
}