# Seguridad

Las contraseñas se almacenan con el hash de Laravel; las rutas administrativas usan middleware de autorización; los formularios usan CSRF; las entradas se validan; las consultas usan Eloquent/Query Builder; las sesiones se regeneran al iniciar sesión; no se incluyen `.env`, credenciales reales ni `vendor`.
