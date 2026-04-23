# Auditoría Técnica del Sistema - Academia Buenfil

## 1. Arquitectura General
- **Framework:** Laravel 12.x (Última versión estable).
- **Entorno PHP:** 8.3+ recomendado.
- **Base de Datos:** MySQL / MariaDB.
- **Frontend:** Blade + Tailwind CSS 4.0 + Alpine.js.
- **Administración:** Filament PHP 5.x.

## 2. Dependencias y Paquetes (Composer)
- `filament/filament`: Corazón del panel administrativo.
- `stripe/stripe-php`: Integración de pasarela de pagos.
- `laravel/framework`: Motor del sistema.
- `laravel/tinker`: Herramienta de depuración por consola.

## 3. Estructura de Datos (Tablas Clave)
| Tabla | Propósito |
|-------|-----------|
| `users` | Usuarios (Administradores y Alumnos). |
| `courses` | Catálogo de cursos disponibles. |
| `lessons` | Contenido de video/texto de los cursos. |
| `orders` | Registro de compras (Stripe, Transferencia). |
| `pending_registrations` | Almacén temporal de registros pre-confirmación de email. |
| `notifications` | Historial de alertas de la campanita en el admin. |
| `quizzes` | Evaluaciones finales por curso. |
| `quiz_attempts` | Seguimiento de intentos y aprobaciones de exámenes. |

## 4. Mapa de Rutas Principales
### Frontend (Alumno)
- `/`: Inicio / Landing Page.
- `/login` & `/register`: Autenticación.
- `/dashboard`: Perfil del alumno y sus cursos.
- `/aula/{slug}`: Visualizador de lecciones (Protegido por compra).
- `/checkout/{id}`: Pasarela de selección de pago.

### Administración (Admin)
- `/admin`: Dashboard de Filament.
- `/admin/users`: Gestión de alumnos.
- `/admin/orders`: Validación de pagos y órdenes.
- `/admin/courses`: Editor de cursos y lecciones.

## 5. Integraciones de Terceros
- **Stripe:** Configurado en modo `test` (Llaves en `.env`). Usa webhooks en `/stripe/webhook`.
- **Servidor de Correo:** SMTP corporativo en Orange Host vía SSL (Puerto 465).
- **Almacenamiento:** Disco `public` local para comprobantes de pago e imágenes de cursos.

## 6. Seguridad
- Acceso administrativo validado por email en `User.php`.
- Protección CSRF habilitada globalmente (excepto en webhooks de Stripe).
- Contraseñas cifradas con algoritmos de hash modernos (`bcrypt`/`hashed`).

---
*Auditoría generada el: 2026-04-23*
