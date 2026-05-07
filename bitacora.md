# Bitácora de Desarrollo - Academia Buenfil

## [2026-05-06] - Modernización del Reproductor y Estabilización del Panel Admin
*Sesión técnica para implementar Plyr.io y corregir errores críticos de base de datos y UI.*

### Funcionalidades Añadidas
- **Integración de Plyr.io:** Sustitución de iframe por reproductor premium con controles corporativos.
- **Ajuste de Video:** Implementación de altura máxima (`70vh`) y eliminación de proporciones fijas para mejorar la visualización técnica.
- **Formato de Precio Dinámico:** Implementación de máscara Alpine.js en Filament para formateo de miles automático (`1,000.00`).
- **Persistencia de Imágenes:** Optimización de `FileUpload` con `live()` para evitar pérdida de archivos temporales.
- **Rediseño Visual Hero (IA):** Generación de imagen principal personalizada y reestructuración de la sección Hero en dos columnas para evitar solapamiento.
- **Activos Técnicos de Beneficios:** Creación de imágenes HD para Boardview, Electrónica de potencia y Herramientas profesionales.
- **Fase de Profesionalización y Arquitectura:**
    - **Nueva Vista Nosotros:** Creación de `/nosotros` para alojar biografía, testimonios y FAQ.
    - **Identidad Realista:** Generación de retrato auténtico de Arturo Buenfil en su taller.
    - **Navegación Unificada:** Implementación de enlace "Inicio" global y sincronización de headers.
    - **Ajuste de Políticas:** Actualización de acceso vitalicio a acceso por un año (FAQ).

### Mejoras Técnicas y Correcciones
- **Error 500 (Fatal PHP):** Restauración de la carpeta `vendor` mediante `composer install` y limpieza de caché.
- **Permisos de Servidor:** Corrección de propiedad y permisos (`chown/chmod`) en carpetas de `storage`.
- **Recuperación de Datos:** Restauración de la cuenta administrativa tras borrado accidental de la base de datos.
- **Casteo Decimal:** Implementación de `dehydrateStateUsing` para limpiar comas de miles antes de guardar en DB.


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
