# Reglas y Estructura del Proyecto - Academia Buenfil

> [!IMPORTANT]
> ## 1. Reglas de Oro y Comunicación (MANDATORIO)
> - **NO se hace ningún `git push` o `git pull` sin autorización explícita del usuario.**
> - **Planificación Obligatoria:** Antes de realizar cualquier cambio significativo, el agente DEBE:
>   1. Presentar un plan de implementación detallado.
>   2. Confirmar que ha entendido perfectamente el requerimiento.
>   3. Consultar sobre opciones extra o detalles de manejo antes de proceder.
> - **Documentación Continua:**
>   - Cada cambio realizado debe registrarse en `bitacora.md` con fecha y detalles técnicos.
>   - Si hay cambios estructurales (tablas, paquetes, rutas), se debe actualizar `auditoria.md`.
> - **Entornos:** Siempre trabajar en **Desarrollo** primero y pedir autorización antes de sincronizar a **Producción**.

## 2. Descripción del Proyecto
**Academia Buenfil** es una plataforma de e-learning (LMS) especializada en capacitación técnica para la reparación de laptops a nivel componente.

## 3. Stack Tecnológico
- **Framework:** Laravel 12
- **Panel Administrativo:** Filament 5
- **Estilos:** Tailwind CSS (Diseño Premium Dark/Orange)
- **Frontend:** Blade + Alpine.js
- **Pagos:** Stripe (API de PHP) + Transferencias Bancarias manuales.

## 4. Estructura de Entornos
El proyecto se divide en dos carpetas totalmente independientes:
- **Desarrollo (Dev):** `/var/www/academia`
  - URL: `https://academia.elrincondeoswaldo.com`
  - Base de Datos: `academia_dev`
  - Modo: `APP_DEBUG=true` / `APP_ENV=local`
- **Producción (Prod):** `/var/www/academia-prod`
  - URL: `https://academia.soportetecnicobuenfil.com`
  - Base de Datos: `academia_db`
  - Modo: `APP_DEBUG=false` / `APP_ENV=production`

## 5. Funcionalidades de Interfaz (UI)
- **Visibilidad de Contraseñas:** Se ha implementado un toggle (icono de ojo) en todos los campos de tipo password (Login, Registro, Recuperación) usando **Alpine.js** para mejorar la experiencia de usuario.

## 6. Flujo de Autenticación y Usuarios
- **Registro en Dos Pasos:** Los datos se guardan temporalmente en `pending_registrations` hasta que el usuario confirma su correo.
- **Acceso Administrativo:** Restringido en `App\Models\User.php` mediante `canAccessPanel`. Solo el correo en `FILAMENT_ADMIN_EMAIL` tiene acceso al `/admin`.

## 7. Módulos Principales
### LMS (Cursos y Lecciones)
- Los cursos tienen un `slug` único.
- El acceso está restringido a usuarios con orden `completed`.
- Seguimiento de progreso en `lesson_user`.

### Sistema de Pagos y Notificaciones
- **Stripe:** Automático vía Webhooks.
- **Transferencia:** Manual vía Filament. El administrador valida el comprobante.
- **Notificaciones (Email):**
  - **Admin:** Aviso de nuevo depósito pendiente.
  - **Alumno:** Aviso de acceso activado (al pasar a `completed`).
  - **Implementación:** `OrderObserver` gestiona los disparos de correo.

## 8. Procedimiento de Despliegue (Deployment)
1. Los cambios se prueban siempre primero en la carpeta de **Desarrollo**.
2. Una vez validados por el usuario, el agente solicita permiso para sincronizar.
3. El flujo estándar es: `git push` (desde Dev) -> `git pull` (en Prod) -> `migrations` -> `clear cache`.

---
*Última actualización: 2026-04-23*
