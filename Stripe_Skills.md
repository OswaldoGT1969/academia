# Requerimientos para Stripe Producción (Live Mode) 💳

Para activar los pagos reales en la Academia Buenfil, necesitas obtener y configurar los siguientes datos desde tu [Dashboard de Stripe](https://dashboard.stripe.com/).

### 1. Llaves de API (Live Mode)
En tu cuenta de Stripe, ve a **Developers > API Keys** y asegúrate de estar en modo **Live**:
- **STRIPE_KEY**: Esta es la llave pública. Suele empezar con `pk_live_...`.
- **STRIPE_SECRET**: Esta es la llave secreta. Suele empezar con `sk_live_...`. *¡No compartas esta llave con nadie!*

### 2. Configuración del Webhook
El Webhook es lo que permite que Stripe le avise a tu academia que un pago fue exitoso para que el curso se libere automáticamente.
1. Ve a **Developers > Webhooks**.
2. Haz clic en **Add endpoint**.
3. **Endpoint URL**: `https://academia.elrincondeoswaldo.com/stripe/webhook`
4. **Select events**: Elige el evento `checkout.session.completed`.
5. Una vez guardado, haz clic en **Reveal** bajo la sección "Signing secret".
- **STRIPE_WEBHOOK_SECRET**: Esta llave empieza con `whsec_...`.

### 3. Dónde poner estos datos
Debes editar el archivo `.env` en la carpeta de producción del servidor:
Ruta: `/var/www/academia-prod/.env`

---
*Nota: Cuando tengas estos 3 datos listos, avísame y yo me encargaré de configurarlos y hacer una prueba final en el servidor.*
