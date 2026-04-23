<x-mail::message>
# Nuevo Pedido con Depósito

Hola Administrador,

Se ha recibido un nuevo pedido mediante **Transferencia Bancaria** que requiere tu validación.

**Detalles del Pedido:**
- **Alumno:** {{ $order->user->name }} ({{ $order->user->email }})
- **Curso:** {{ $order->course->title }}
- **Monto:** ${{ number_format($order->amount, 2) }} MXN
- **Fecha:** {{ $order->created_at->format('d/m/Y H:i') }}

<x-mail::button :url="config('app.url') . '/admin/orders/' . $order->id">
Ver Pedido en el Panel
</x-mail::button>

Recuerda verificar el comprobante de pago adjunto en el panel antes de autorizar el acceso.

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
