#include <WiFi.h>
#include <HTTPClient.h>

// Completa estos datos. Usa la IP local del computador donde corre Laravel.
const char* WIFI_SSID = ".";
const char* WIFI_PASSWORD = "KJRO1210";
const char* ALERT_URL = "http://10.138.128.70:8001/api/esp32/alerts";
const char* DEVICE_TOKEN = "63ec9a2adffd25940ea338fcb8385b0e6cb5904ec943ce9fcacec0c2dfcc84d5";
const char* DEVICE_ID = "esp32-boton-1";

const int PIN_BOTON = 4; // Botón entre GPIO 4 y GND
const unsigned long REBOTE_MS = 50;

int lecturaAnterior = HIGH;
int estadoEstable = HIGH;
unsigned long cambioEn = 0;
unsigned long ultimoIntentoWifi = 0;

void enviarAlerta() {
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("Sin WiFi; no se pudo enviar la alerta.");
    return;
  }

  HTTPClient http;
  http.begin(ALERT_URL);
  http.addHeader("Content-Type", "application/json");
  http.addHeader("Accept", "application/json");
  http.addHeader("X-Device-Token", DEVICE_TOKEN);
  String body = String("{\"device_id\":\"") + DEVICE_ID +
                "\",\"message\":\"Botón de pánico presionado\"}";
  int status = http.POST(body);
  Serial.printf("Respuesta del servidor: %d\n", status);
  if (status > 0) {
    Serial.println(http.getString());
  } else {
    Serial.printf("Error HTTP: %s\n", http.errorToString(status).c_str());
  }
  http.end();
}

void setup() {
  Serial.begin(115200);
  pinMode(PIN_BOTON, INPUT_PULLUP);
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  Serial.printf("Conectando a WiFi: %s\n", WIFI_SSID);
  unsigned long inicio = millis();
  while (WiFi.status() != WL_CONNECTED && millis() - inicio < 15000) {
    delay(500);
    Serial.print('.');
  }
  if (WiFi.status() == WL_CONNECTED) {
    Serial.printf("\nWiFi conectado. IP del ESP32: %s\n", WiFi.localIP().toString().c_str());
  } else {
    Serial.println("\nNo conectó a WiFi. Revisar SSID y clave; el botón seguirá detectándose.");
  }
}

void loop() {
  if (WiFi.status() != WL_CONNECTED && millis() - ultimoIntentoWifi > 10000) {
    ultimoIntentoWifi = millis();
    Serial.println("Intentando reconectar WiFi...");
    WiFi.reconnect();
  }

  int lectura = digitalRead(PIN_BOTON);
  if (lectura != lecturaAnterior) cambioEn = millis();

  if (millis() - cambioEn > REBOTE_MS && lectura != estadoEstable) {
    estadoEstable = lectura;
    if (estadoEstable == LOW) {
      Serial.println("¡Botón presionado! Enviando alerta...");
      enviarAlerta();
    }
  }

  lecturaAnterior = lectura;
  delay(5);
}
