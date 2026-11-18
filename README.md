# BOTON-PANICO — ETAPA 1

Sistema hospitalario Laravel 13 para Windows/XAMPP. Esta etapa implementa autenticación, roles, dashboard, administración de usuarios, perfil y recuperación de contraseña. No incluye todavía pacientes, habitaciones, botones físicos, alertas ni ESP32.

## Instalación
1. Descomprime en `C:\xampp\htdocs\boton-panico`.
2. Abre la carpeta en VS Code.
3. Ejecuta `composer install`.
4. `copy .env.example .env`
5. Configura MySQL en `.env` (por defecto 127.0.0.1:3307).
6. `php artisan key:generate`
7. `php artisan migrate --seed`
8. `npm install`
9. `npm run build`
10. `php artisan serve`

`migrate --seed` conserva las tablas y registros existentes. Usa `migrate:fresh --seed` únicamente en una base de datos nueva o desechable, porque elimina las tablas anteriores.

## Recuperación de contraseña
La pantalla de recuperación ofrece tres alternativas: enlace de restablecimiento por correo, código de seis dígitos (vence en 10 minutos y permite hasta cinco intentos) y archivo `.txt` cifrado. Para este último, escribe el correo en la opción **Archivo de recuperación**; el archivo se envía como adjunto y luego se sube para validarlo. También se puede generar desde **Seguridad → Generar y enviar archivo** mientras la cuenta está abierta. Cada archivo nuevo invalida el anterior y cada archivo se puede usar una sola vez. Para enviar correos, configura `MAIL_MAILER=smtp`, el host, puerto, usuario, contraseña y remitente en `.env`.

Para ejecutar las pruebas automatizadas: `php artisan test`. PHPUnit usa SQLite en memoria y no utiliza la base MySQL de desarrollo.

Si Composer genera un `composer.lock`, consérvalo para futuras instalaciones. El ZIP fuente no incluye `vendor`, `node_modules` ni `.env`.

## Usuarios
- admin@example.com / Admin12345!
- doctor@example.com / Doctor12345!
- enfermero@example.com / Enfermero12345!

El registro público crea usuarios como `nurse`; nunca permite registrar un administrador.
# Botón de pánico ESP32

El ESP32 puede crear alertas desde el botón conectado entre GPIO 4 y GND. El dashboard muestra una notificación al recibir una alerta y actualiza las secciones **Alertas** e **Historial** cada cinco segundos.

1. Define `ESP32_DEVICE_TOKEN` en `.env` con una clave larga aleatoria y reinicia Laravel para que cargue la configuración. Usa el mismo valor como `DEVICE_TOKEN` en el sketch.
2. Ejecuta las migraciones: `php artisan migrate`.
3. Inicia Laravel para que sea accesible en tu red local, por ejemplo: `php artisan serve --host=0.0.0.0 --port=8001`.
4. En `esp32/esp32_boton_panico.ino`, completa WiFi y reemplaza la URL por `http://IP_DEL_COMPUTADOR:8001/api/esp32/alerts`.
5. Conecta el botón entre GPIO 4 y GND, carga el sketch al ESP32 y abre el monitor serial a 115200 baudios.

El ESP32 y el computador deben estar en la misma red y el firewall debe permitir conexiones al puerto de Laravel. Cada pulsación estable envía una alerta; mantener el botón presionado no genera alertas repetidas. El historial se guarda en la tabla `panic_alerts`.

En **Pacientes → Nuevo paciente**, registra al paciente y asigna en **ID del pulsador ESP32** el mismo `DEVICE_ID` del sketch (por defecto `esp32-boton-1`). Las alertas de ese dispositivo mostrarán nombre, edad, habitación, cama y diagnóstico. En **Alertas**, el personal puede tomar una alerta; al dejar reporte se cierra y queda guardado en **Historial**.

En el dashboard, pulsa el icono de notificaciones de la esquina superior derecha para habilitar el sonido del navegador. Déjalo abierto en el computador receptor; las nuevas alertas muestran una notificación y reproducen un tono.
