<x-mail::message>
# ¡Felicidades, {{ $order->user->name }}!

Tu pago ha sido validado con éxito y ya tienes acceso total a tu curso.

**Detalles del Acceso:**
- **Curso:** {{ $order->course->title }}
- **Estado:** Activado
- **Acceso:** De por vida

Estamos emocionados de acompañarte en tu proceso de aprendizaje en la reparación de laptops.

<x-mail::button :url="config('app.url') . '/aula/' . $order->course->slug">
Ir al Aula Virtual
</x-mail::button>

Si tienes alguna duda durante el curso, no dudes en contactarnos.

¡Mucho éxito en tus estudios!,<br>
{{ config('app.name') }}
</x-mail::message>
