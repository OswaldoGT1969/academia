# Bitácora de Desarrollo - Academia Buenfil

## [2026-04-23] - Sesión de Estabilización y Despliegue
*Sesión enfocada en la separación de entornos, corrección de accesos y sistema de notificaciones.*

### Funcionalidades Añadidas
- **Visibilidad de Contraseñas (UI):** Se agregó un botón de "ojo" en todos los campos de contraseña (Login, Registro, Reset) utilizando Alpine.js para mejorar la UX.
  - *Archivos:* `auth/login.blade.php`, `auth/register.blade.php`, `auth/reset-password.blade.php`.
- **Sistema de Notificaciones Dual:**
  - **Email Admin:** Aviso de nuevos pedidos con depósito bancario.
  - **Email Alumno:** Confirmación automática cuando se autoriza un curso.
  - **Campanita (Filament):** Notificación interna en el panel administrativo cuando hay nuevos pedidos.
  - *Archivos:* `App/Mail/*.php`, `App/Observers/OrderObserver.php`, `App/Http/Controllers/CheckoutController.php`.
- **Migración a Correo Corporativo:** Configuración del servidor SMTP de Orange Host (`notificaciones@soportetecnicobuenfil.com`) para todos los envíos del sistema.
  - *Archivos:* `.env`, `config/app.php`.

### Mejoras Técnicas y Correcciones
- **Separación de Entornos:** Creación de la base de datos `academia_dev` para aislar el desarrollo de la producción.
- **Corrección de Acceso Admin (403):** Se resolvió un error de acceso prohibido al panel Filament migrando la lógica de `env()` a `config()` y añadiendo insensibilidad a mayúsculas en el correo del administrador.
  - *Archivos:* `App/Models/User.php`, `config/app.php`.
- **Rediseño de Correos:** Ajuste del tamaño del logo de la academia a 180px para mayor elegancia y compatibilidad.
- **Acceso Dual:** Se habilitó el acceso al panel administrativo tanto para el correo personal del administrador como para la cuenta corporativa de notificaciones.

### Tareas de Mantenimiento
- Creación de archivos `RULES.md`, `bitacora.md` y `auditoria.md` para documentación.
- Limpieza de usuarios de prueba y sesiones huérfanas en el entorno de desarrollo.
